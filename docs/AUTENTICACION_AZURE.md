# Implementación: Autenticación con Microsoft Azure AD

Este documento describe todos los cambios realizados en el proyecto para integrar el inicio de sesión con Microsoft (Azure AD) y el flujo de selección de portales (Contabilidad, Auditoría, Legales).

---

## 1. Resumen del flujo

1. El usuario entra a la pantalla de login y puede elegir:
   - **Iniciar sesión con Microsoft** → redirige a Azure AD (OAuth 2.0 / OpenID Connect).
2. Tras autenticarse en Microsoft, Azure redirige de vuelta a la aplicación con un código de autorización.
3. La aplicación intercambia el código por tokens y obtiene el **email** del usuario desde el **id_token** (JWT).
4. Se consulta en las **tres bases de datos** (Contabilidad, Auditoría, Legales) en qué portales existe ese usuario (tabla `usuario_web`, `email` y `estado = 1`).
5. Se muestra el **hub de portales**: el usuario elige Contabilidad, Auditoría o Legales.
6. Al elegir un portal se carga el usuario y sus roles desde la BD de ese portal, se establece la sesión de Laravel y se redirige a `/admin`.
7. El middleware `SetPortalConnection` fija la conexión de BD por defecto según el portal elegido.

---

## 2. Archivos creados o modificados

### 2.1 Configuración

| Archivo | Descripción |
|---------|-------------|
| `config/azure.php` | Configuración de Azure AD: tenant, client_id, client_secret, redirect_uri, URLs de authorize/token, scopes. |
| `config/database.php` | Tres conexiones adicionales: `contabilidad`, `auditoria`, `legales` (además de `mysql` por defecto). |
| `.env` / `.env.example` | Variables `AZURE_*` y `DB_CONTABILIDAD_*`, `DB_AUDITORIA_*`, `DB_LEGALES_*`. |

### 2.2 Controladores

| Archivo | Descripción |
|---------|-------------|
| `app/Http/Controllers/Auth/AzureController.php` | `redirect()`: redirige a Azure con state. `callback()`: recibe code, intercambia por tokens, decodifica id_token, obtiene email, llama a PortalResolver, guarda sesión y redirige al hub. Incluye logging del error de Azure cuando falla el canje de tokens y mensaje detallado si `APP_DEBUG=true`. |
| `app/Http/Controllers/PortalController.php` | `hub()`: muestra la vista de selección de portal. `entrar($portal)`: valida acceso, establece `portal_actual`, carga usuario y roles de la BD del portal, hace login y redirige a `/admin`. |
| `app/Http/Controllers/Seguridad/LoginController.php` | En `logout()` se añadió limpieza de `portales_permitidos`, `portal_actual`, `azure_email`, `azure_name`. |

### 2.3 Servicios

| Archivo | Descripción |
|---------|-------------|
| `app/Services/PortalResolver.php` | `portalesPermitidosPorEmail($email)`: para cada conexión (contabilidad, auditoria, legales) consulta `usuario_web` donde `email` y `estado = 1`; devuelve el array de nombres de portales donde el usuario existe. |

### 2.4 Middleware

| Archivo | Descripción |
|---------|-------------|
| `app/Http/Middleware/SetPortalConnection.php` | Establece `database.default` según `session('portal_actual')`. Si el usuario está autenticado y tiene `portales_permitidos` pero no `portal_actual`, redirige al hub. |
| `app/Http/Kernel.php` | Registro del alias `portal.connection` → `SetPortalConnection`. |

### 2.5 Rutas

En `routes/web.php`:

- `GET auth/azure` → `AzureController@redirect` (nombre: `auth.azure.redirect`).
- `GET auth/azure/callback` → `AzureController@callback` (nombre: `auth.azure.callback`).
- `GET portal/hub` → `PortalController@hub` (nombre: `portal.hub`).
- `GET portal/entrar/{portal}` → `PortalController@entrar` (nombre: `portal.entrar`), `portal` = contabilidad|auditoria|legales.

El grupo de rutas `admin` usa los middlewares `auth`, `portal.connection` y `superadmin`.

### 2.6 Vistas

| Archivo | Descripción |
|---------|-------------|
| `resources/views/seguridad/index.blade.php` | Botón "Iniciar sesión con Microsoft" que enlaza a `route('auth.azure.redirect')`, y formulario tradicional de usuario/contraseña. |
| `resources/views/portal/hub.blade.php` | Pantalla de selección de portal: muestra nombre y email del usuario de Azure y botones para Contabilidad, Auditoría, Legales (solo los que estén en `portales_permitidos`). Incluye script de debug en consola (claims de Azure y resultado de BD). |
| `resources/views/theme/lte/layout.blade.php` | Script que muestra en consola el debug de entrada a portal (usuario y roles cargados de la BD) si existe `session('debug_entrar_portal')`. |

### 2.7 Modelo

El modelo `App\Models\Seguridad\Usuario` usa la tabla `usuario_web` y la relación `roles()` con `usuario_rol`. No se crearon modelos nuevos; se usa el existente con `Usuario::on($portal)` para cada conexión.

---

## 3. Variables de entorno

### 3.1 Azure AD

```env
AZURE_TENANT_ID=        # Directorio (tenant) de Azure AD
AZURE_CLIENT_ID=        # Application (client) ID del registro de la app
AZURE_CLIENT_SECRET=    # Valor del secreto (no el Id. de secreto)
```

El **redirect_uri** se construye en código como: `rtrim(APP_URL, '/') . '/auth/azure/callback'`. Debe coincidir exactamente con el configurado en Azure (Autenticación → URI de redirección).

### 3.2 Bases de datos por portal

```env
DB_CONTABILIDAD_HOST=
DB_CONTABILIDAD_PORT=3306
DB_CONTABILIDAD_DATABASE=acontrib_contabilidad
DB_CONTABILIDAD_USERNAME=
DB_CONTABILIDAD_PASSWORD=

DB_AUDITORIA_HOST=
DB_AUDITORIA_PORT=3306
DB_AUDITORIA_DATABASE=acontrib_auditoria
DB_AUDITORIA_USERNAME=
DB_AUDITORIA_PASSWORD=

DB_LEGALES_HOST=
DB_LEGALES_PORT=3306
DB_LEGALES_DATABASE=acontrib_legales
DB_LEGALES_USERNAME=
DB_LEGALES_PASSWORD=
```

---

## 4. Configuración en Azure Portal

1. **Microsoft Entra ID** (Azure Active Directory) → **Registros de aplicaciones** → Nueva inscripción (o usar una existente).
2. **Autenticación**:
   - Plataforma: **Web**.
   - URI de redirección: por ejemplo `https://tudominio.com/auth/azure/callback` (producción) y/o `http://localhost:8000/auth/azure/callback` (desarrollo). Debe coincidir con `APP_URL` + `/auth/azure/callback`.
3. **Certificados y secretos**: crear un secreto de cliente y copiar el **Valor** (no el Id.) a `AZURE_CLIENT_SECRET`.
4. Anotar **Application (client) ID** → `AZURE_CLIENT_ID` y **Directory (tenant) ID** → `AZURE_TENANT_ID`.

---

## 5. Depuración y errores de Azure

- **Log cuando falla el canje de tokens**: en `storage/logs/laravel.log` se registra el código HTTP, el `redirect_uri` enviado, el error parseado de Azure y el cuerpo de la respuesta.
- **Mensaje en pantalla**: si `APP_DEBUG=true`, se muestra el detalle del error de Azure (p. ej. invalid_client, redirect_uri mismatch). Si `APP_DEBUG=false`, se indica revisar el log.
- **Debug en consola del navegador**: en la vista del hub se imprimen en consola los claims del id_token y el resultado del PortalResolver; en el layout de admin, el usuario y roles cargados al entrar al portal (datos en sesión de debug).

---

## 6. Requisitos en base de datos

- En cada base de portal (contabilidad, auditoria, legales) deben existir las tablas `usuario_web` y `usuario_rol` (y la de roles correspondiente).
- Para que un usuario vea un portal en el hub, debe existir una fila en `usuario_web` con su **email** (el mismo que devuelve Azure, p. ej. `preferred_username`) y **estado = 1**, y al menos un rol asignado en `usuario_rol`.

---

## 7. Despliegue en servidores

- Asegurar que en el servidor el `.env` de producción tenga `APP_ENV=production`, `APP_DEBUG=false`, `APP_URL` con la URL pública (ej. `https://gestioncontabilidad.optimalsolutions.com.co`) y las variables Azure y BD correctas.
- En Azure, tener registrado el redirect URI de producción (HTTPS).
- Ejecutar migraciones por conexión si aplica: `php artisan migrate --database=contabilidad --force`, y análogo para auditoria y legales.
- Cache de config: `php artisan config:cache`.
- Ver scripts de despliegue:
  - **Linux / macOS**: `bash scripts/deploy.sh`
  - **Windows (PowerShell)**: `.\scripts\deploy.ps1`

---

## 8. Changelog de la implementación

- Añadida autenticación OAuth 2.0 / OpenID Connect con Azure AD (sin dependencias Guzzle/Http; uso de `file_get_contents` + `stream_context_create` para el canje de tokens).
- Tres conexiones de BD para portales Contabilidad, Auditoría, Legales.
- Servicio PortalResolver para determinar portales permitidos por email.
- Hub de selección de portal y flujo "entrar" al portal con carga de usuario/rol desde la BD correspondiente.
- Middleware SetPortalConnection para fijar la conexión de BD según el portal elegido.
- Logout que limpia variables de sesión de Azure y portal.
- Logging del error de Azure cuando falla el canje de tokens y mensaje detallado en modo debug.
- Debug en consola del navegador (claims de id_token, resultado de BD, usuario/roles al entrar al portal).
