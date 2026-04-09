# ACONTRIBUT — Documentación del Sistema, Repositorio y Evidencias

**Proyecto:** Acontribut — Sistema de Gestión Contable y Tributaria  
**Framework:** Laravel 6.x (PHP)  
**Base de datos:** MySQL  
**Frontend:** AdminLTE + Bootstrap + jQuery  
**Repositorio:** https://github.com/fireblack32/acontribut  
**Fecha de documentación:** Abril 2026  

---

## 1. Estructuración del Repositorio Git

### 1.1 Ramas

| Rama | Propósito |
|------|-----------|
| `main` | Rama principal de producción. Código estable. |
| `acontribut_auteniticacion` | Desarrollo del módulo de autenticación personalizado. |
| `acontribut_local` | Entorno de desarrollo local / pruebas. |

### 1.2 Historial de commits principales

| Hash | Descripción |
|------|-------------|
| `c53c8a8` | Initial commit: Laravel Acontribut con AdminLTE |
| `32cec15` | docs: agregar guía de configuración para GitHub |
| `a18805f` | Primer commit (HEAD main) |

### 1.3 Estructura de carpetas (nivel 2)

```
acontribut/
├── app/
│   ├── Console/              # Comandos Artisan personalizados
│   ├── Exceptions/           # Manejo de excepciones
│   ├── Helpers/              # Funciones auxiliares (biblioteca.php, funciontabla.php)
│   ├── Http/
│   │   ├── Controllers/      # Controladores públicos (TimeManager, Checklist, Reportes...)
│   │   │   ├── Admin/        # Controladores del panel admin (23 controladores)
│   │   │   ├── Auth/         # Controladores de autenticación Laravel
│   │   │   └── Seguridad/    # LoginController personalizado
│   │   └── Middleware/       # Middleware (auth, superadmin, CSRF, etc.)
│   ├── Imports/              # Importación de Excel (Tarifas, Costos, Otros)
│   ├── Models/
│   │   ├── Admin/            # 14 modelos (Client, User, Rol, Menu, obligaciones...)
│   │   └── Seguridad/        # Modelo Usuario.php
│   ├── Providers/            # Service Providers
│   └── Rules/                # Reglas de validación (ValidarCampourl)
├── bootstrap/                # Arranque de la aplicación
├── config/                   # Archivos de configuración Laravel
├── database/
│   ├── factories/            # Model factories
│   ├── migrations/           # 24 migraciones (2020–2023)
│   └── seeds/                # UsuarioAdministradorSeeder
├── dist/                     # Assets compilados (AdminLTE)
├── public/                   # Punto de entrada web, assets públicos
│   └── Assets/               # Recursos estáticos adicionales
├── resources/
│   ├── js/                   # JavaScript fuente
│   ├── lang/                 # Traducciones
│   ├── sass/                 # Estilos SASS
│   └── views/                # Vistas Blade (33+ directorios)
├── routes/                   # Definición de rutas (web.php)
├── storage/                  # Logs, cache, sesiones
└── tests/                    # Tests Feature y Unit
```

---

## 2. Documentación Técnica — Arquitectura del Sistema

### 2.1 Descripción general

Acontribut es un sistema de gestión contable y tributaria construido en Laravel 6 que permite:

- **Gestión de obligaciones tributarias** (IVA, Renta, ICA, Retenciones, etc.) por cliente
- **TimeManager** — control de actividades y tiempos de trabajo por usuario
- **Checklist de obligaciones** — seguimiento de estados (pendiente, en proceso, no aplica, finalizado)
- **Reportes** — Base Check, Consolidado, Financiero con exportación a Excel
- **Administración** — CRUD de clientes, usuarios, roles, permisos, menús dinámicos
- **Gestión de tarifas y costos** — importación masiva desde Excel, copia entre meses
- **Auditoría** — seguimiento de checklist por usuario y fechas

### 2.2 Patrón arquitectónico

- **MVC (Model-View-Controller)** estándar de Laravel
- **Autenticación personalizada** en `Seguridad\LoginController` (no usa `Auth::routes()` por defecto)
- **Autorización por roles** mediante middleware `superadmin` (`PermisoAdministrador.php`)
- **Menús dinámicos** — los menús se cargan desde la BD según el rol del usuario
- **Sistema de permisos granular** — tablas `permiso`, `permiso_rol`, `usuario_rol`

### 2.3 Flujo de autenticación

```
GET /seguridad/login  →  LoginController@index  →  Vista login
POST /seguridad/login →  LoginController@login   →  Valida credenciales → Sesión
GET /seguridad/logout →  LoginController@logout  →  Destruye sesión
```

### 2.4 Módulos del sistema

| Módulo | Ruta base | Controlador(es) | Descripción |
|--------|-----------|------------------|-------------|
| Inicio | `/` | `InicioController` | Dashboard principal |
| TimeManager | `/timemanager` | `TimeManagerController` | Registro y consulta de actividades/tiempos |
| Mis Pendientes | `/mispendientes` | `MispendientesController` | Obligaciones pendientes del usuario |
| Checklist | `/checklist/{id}` | `ChecklistController` | Estados de obligaciones por cliente |
| Cambio Password | `/cambiopassword` | `CambioPasswordController` | Cambio de contraseña del usuario |
| Repo Base Check | `/basecheck` | `RepoBaseCheckController` | Reporte base de checklist + Excel |
| Repo Consolidado | `/repoconsolid` | `RepoConsolidController` | Reporte consolidado + Excel |
| Repo Financiero | `/rep_financiero` | `RepoFinancieroController` | Reporte financiero + Excel |
| Auditoría Checklist | `/aud_checklist` | `AuditChecklistController` | Auditoría de checklist por usuario |
| Acta con Cliente | `/actaconcliente` | `ActaClienteController` | Gestión de actas + Excel |
| Actividad Eco. Cliente | `/acticliente` | `ActividadEcoClienteController` | Actividades económicas del cliente |
| Lista Accionistas | `/listaaccionistas` | `ListaAccionistasController` | CRUD accionistas por cliente |
| Personas Contacto | `/personascontacto` | `PersonasContactoController` | CRUD contactos por cliente |
| Claves Clientes | `/clavesclientes` | `ClavesClienteController` | Gestión de claves/accesos por cliente |

### 2.5 Módulos administrativos (prefijo `/admin`, middleware `auth` + `superadmin`)

| Módulo | Ruta | Controlador | Descripción |
|--------|------|-------------|-------------|
| Panel Admin | `/admin` | `AdminController` | Dashboard administrativo |
| Menús | `/admin/menu` | `MenuController` | CRUD menús dinámicos + ordenamiento |
| Menú-Rol | `/admin/menu-rol` | `MenuPerfilController` | Asignación de menús a roles |
| Clientes | `/admin/cliente` | `ClienteController` | CRUD de clientes |
| Usuarios | `/admin/user` | `UsuarioController` | CRUD de usuarios del sistema |
| Roles | `/admin/rol` | `RolController` | CRUD de roles |
| Permisos | `/admin/permiso` | `PermisoController` | CRUD de permisos |
| Permiso-Rol | `/admin/permiso_rol` | `MenurolController` | Asignación permisos a roles |
| Municipio-Cliente | `/admin/municipio_cliente` | `MunicipioClienteController` | Asignar municipios a clientes |
| Asignar Obligación | `/admin/asignaobligacion` | `AsignaObligController` | Asignación individual de obligaciones |
| Obligaciones Periód/Admin | `/admin/pgperioadmin` | `PgObliOcaPeriodAdminController` | Gestión obligaciones periódicas, ocasionales, administrables |
| Reagendar Dinámica | `/admin/asignadinamica` | `ReagendarDinaController` | Reagendamiento de obligaciones dinámicas |
| Reagendar Periódica | `/admin/asignaperiodica` | `ReagendarPerioController` | Reagendamiento de obligaciones periódicas |
| Crear Dinámica | `/admin/pgdinamica` | `CrearDinamicaController` | Creación de obligaciones dinámicas |
| Agenda Dinámica | `/admin/agendinamica` | `AgendaDinamicaController` | Visualización agenda dinámica |
| Eliminar Oblig. Cliente | `/admin/elimobcliente` | `ElimiObliClienController` | Eliminación de obligaciones por cliente |
| Tarifas | `/admin/tarifa` | `TarifaClienteController` | Import Excel, edición, copia/borrado por mes |
| Costo Usuario | `/admin/costusuar` | `CostUsuarClienteController` | Import Excel costos usuario, edición |
| Otros Costos | `/admin/otroscost` | `OtroscostController` | Import Excel otros costos, edición |
| Act. TimeManager | `/admin/acttimemanager` | `ActtimemanagerController` | CRUD actividades del TimeManager |

---

## 3. Modelo Entidad-Relación (Derivado de Migraciones y Modelos)

### 3.1 Tablas principales del sistema

```
┌─────────────────────┐     ┌──────────────────┐     ┌──────────────┐
│    usuario_web       │────▶│   usuario_rol    │◀────│     rols     │
│ (usuarios del sist.) │     │ (user_id, rol_id)│     │ (id, nombre) │
└─────────────────────┘     └──────────────────┘     └──────┬───────┘
                                                            │
                                                    ┌───────▼───────┐
                                                    │  permiso_rol  │
                                                    │(permiso,rol)  │
                                                    └───────┬───────┘
                                                            │
                                                    ┌───────▼───────┐
                                                    │    permiso    │
                                                    │ (id, nombre)  │
                                                    └───────────────┘

┌──────────────┐     ┌───────────────────────┐
│   cliente    │────▶│ cliente_has_municipio  │
│ (empresas)   │     │ (cliente_id, mun_id)  │
└──────┬───────┘     └───────────────────────┘
       │
       │  ┌────────────────────────────────────────────────────────┐
       ├──▶ obd_declaracion_renta, obd_iva, obd_rete_fuente,      │
       ├──▶ obd_rete_ica, obd_ica, obd_soi, obd_consumo,          │
       ├──▶ obd_medios_magneticos, obp_nomina, obp_balances,       │
       ├──▶ ob_revisor_fiscal, ob_libros, ob_administrable,        │
       └──▶ ... (+50 tablas de obligaciones tributarias)            │
           └────────────────────────────────────────────────────────┘

┌──────────────────┐     ┌───────────────────────┐
│   TimeManager    │────▶│ tipo_TimeManager      │
│ (registro horas) │     │ (tipos de actividad)  │
└──────────────────┘     └───────────────────────┘

┌──────────────────┐     ┌──────────────────┐
│     menu         │────▶│    menu_rol      │
│ (menús dinámicos)│     │ (menu_id, rol_id)│
└──────────────────┘     └──────────────────┘

┌──────────────────┐     ┌──────────────────┐     ┌──────────────────┐
│  tarifa_cliente  │     │  costo_usuario   │     │  otros_costos    │
│ (tarifas x mes)  │     │ (costos x mes)   │     │ (costos extras)  │
└──────────────────┘     └──────────────────┘     └──────────────────┘
```

### 3.2 Tablas de obligaciones tributarias identificadas (~60+ tablas)

**Obligaciones Dinámicas (obd_*):**
`obd_declaracion_renta` (3 variantes), `obd_iva`, `obd_iva_cua`, `obd_rete_fuente`, `obd_rete_ica`, `obd_rete_ica_mosquera`, `obd_ica`, `obd_ica_otros` (4 variantes: mensual, bimestral, trimestral), `obd_reteica_otros` (4 variantes), `obd_consumo`, `obd_soi`, `obd_medios_magneticos` (3 variantes + distritales + otros), `obd_impuesto_patrimonio`, `obd_actexteriorgrandcontr`, `obd_actexteriorpersjur`, `obd_actexteriorpersnat`, `obd_antiregsimple`, `obd_auto_cree`, `obd_cree`, `obd_creesegundacuota`, `obd_cree_cua`, `obd_cuentas_comp_dian`, `obd_declanualivaregsimp`, `obd_declanualregsimp`, `obd_preciostransf`, `obd_rentasegundacuota`, `obd_memeconregtribesp`, `obd_superenvdoc`, `obd_superintendencia_salud`, `obd_super_sociedades`, `obd_riquezasegcuota`

**Obligaciones Periódicas (obp_*):**
`obp_nomina`, `obp_balances`, `obp_inventario`, `obp_exp_cert_anuales`, `obp_exp_cert_bimensuales`, `obp_solic_cert_anuales`, `obp_solic_cert_bimensuales`, `obp_imp_predial_vehiculo`, `obp_renov_matric_merc`, `obp_renov_reg_inv_ext`, `obp_renov_socied_exterior`, `obp_solic_avaluos`

**Obligaciones Puntuales/Dinámicas (ob_*):**
`ob_revisor_fiscal`, `ob_libros`, `ob_firmas_digitales`, `ob_devoluciones`, `ob_correccion_declaraciones`, `ob_cancelar_oblig`, `ob_cambios_capital_inv_nac`, `ob_beneficio_auditoria`, `ob_actualizacion_obl`, `ob_en_causales_dis`, `ob_registro_contratos`, `ob_reg_inversion_ext`, `ob_renov_reg_endeud`, `ob_resolucion_facturacion`, `ob_administrable`

**Obligaciones Periódicas/Dinámicas (obpd_*):**
`obpd_contribucion_supersoc`, `obpd_contribucion_turism`, `obpd_encuesta_dane`, `obpd_estados_financieros`

### 3.3 Tablas de soporte

| Tabla | Descripción |
|-------|-------------|
| `usuario_web` | Usuarios del sistema (login, datos personales) |
| `rols` | Roles del sistema |
| `permiso` | Permisos granulares |
| `usuario_rol` | Relación M:N usuario ↔ rol |
| `permiso_rol` | Relación M:N permiso ↔ rol |
| `cliente` | Empresas/clientes contables |
| `cliente_has_municipio` | Municipios asociados a cada cliente |
| `menu` | Menús del sistema (dinámicos) |
| `submenu` | Submenús |
| `menu_rol` | Asignación menú ↔ rol |
| `submenu_hash_usuario` | Relación submenú ↔ usuario |
| `TimeManager` | Registro de horas/actividades |
| `tipo_TimeManager` | Catálogo de tipos de actividad |
| `tarifa_cliente` | Tarifas por cliente y mes |
| `costo_usuario` | Costos de usuario por mes |
| `cache` | Cache de Laravel |

---

## 4. Matriz de Configuraciones

### 4.1 Variables de entorno (`.env`)

| Variable | Valor esperado | Descripción |
|----------|---------------|-------------|
| `APP_NAME` | `Acontribut` | Nombre de la aplicación |
| `APP_ENV` | `local` / `production` | Entorno de ejecución |
| `APP_KEY` | `base64:...` | Clave de encriptación (generar con `php artisan key:generate`) |
| `APP_DEBUG` | `true` / `false` | Modo debug (false en producción) |
| `APP_URL` | `http://localhost` / URL prod | URL base de la aplicación |
| `DB_CONNECTION` | `mysql` | Driver de base de datos |
| `DB_HOST` | `127.0.0.1` | Host MySQL (XAMPP: localhost) |
| `DB_PORT` | `3306` | Puerto MySQL |
| `DB_DATABASE` | `acontribut` | Nombre de la BD |
| `DB_USERNAME` | `root` | Usuario MySQL |
| `DB_PASSWORD` | *(vacío en XAMPP)* | Contraseña MySQL |
| `CACHE_DRIVER` | `file` | Driver de caché |
| `SESSION_DRIVER` | `file` | Driver de sesiones |
| `SESSION_LIFETIME` | `120` | Duración sesión (minutos) |
| `MAIL_DRIVER` | `smtp` | Driver de correo |
| `MAIL_HOST` | `smtp.mailtrap.io` | Host SMTP |
| `MAIL_PORT` | `2525` | Puerto SMTP |

### 4.2 URLs y rutas principales

| Tipo | URL / Ruta | Descripción |
|------|-----------|-------------|
| Inicio | `/` | Landing / Dashboard |
| Login | `/seguridad/login` | Formulario de ingreso |
| Logout | `/seguridad/logout` | Cerrar sesión |
| Admin | `/admin` | Panel administrativo (requiere rol superadmin) |
| TimeManager | `/timemanager` | Gestión de tiempos |
| Checklist | `/checklist/{id}` | Checklist de obligaciones |
| Reportes | `/basecheck`, `/repoconsolid`, `/rep_financiero` | Reportes con export Excel |

### 4.3 Middleware

| Middleware | Archivo | Función |
|-----------|---------|---------|
| `auth` | `Authenticate.php` | Verifica sesión activa |
| `superadmin` | `PermisoAdministrador.php` | Verifica rol de administrador |
| `guest` | `RedirectIfAuthenticated.php` | Redirige usuarios autenticados |
| `csrf` | `VerifyCsrfToken.php` | Protección CSRF |

### 4.4 Requisitos del servidor

| Componente | Versión recomendada |
|-----------|-------------------|
| PHP | 7.2 – 7.4 |
| MySQL | 5.7+ / MariaDB 10.3+ |
| Composer | 2.x |
| Node.js | 12+ (para compilar assets) |
| Servidor | XAMPP / Apache + mod_rewrite |
| Laravel | 6.x |

---

## 5. Bitácora de Evidencias (Pruebas / Entregables)

### 5.1 Módulos implementados y verificados

| # | Módulo | Estado | Evidencia |
|---|--------|--------|-----------|
| 1 | Autenticación (Login/Logout) | ✅ Implementado | `Seguridad/LoginController.php`, vista `seguridad/` |
| 2 | CRUD Usuarios | ✅ Implementado | `Admin/UsuarioController.php`, vistas `admin/user/` |
| 3 | CRUD Roles | ✅ Implementado | `Admin/RolController.php`, vistas `admin/rol/` |
| 4 | CRUD Permisos | ✅ Implementado | `Admin/PermisoController.php`, vistas `admin/permiso/` |
| 5 | Asignación Menú-Rol | ✅ Implementado | `Admin/MenuPerfilController.php` |
| 6 | Asignación Permiso-Rol | ✅ Implementado | `Admin/MenurolController.php` |
| 7 | CRUD Clientes | ✅ Implementado | `Admin/ClienteController.php`, vistas `admin/cliente/` |
| 8 | CRUD Menús dinámicos | ✅ Implementado | `Admin/MenuController.php` con ordenamiento drag&drop |
| 9 | TimeManager | ✅ Implementado | `TimeManagerController.php`, búsqueda, CRUD, consulta |
| 10 | Mis Pendientes | ✅ Implementado | `MispendientesController.php`, filtro por fecha |
| 11 | Checklist de obligaciones | ✅ Implementado | `ChecklistController.php`, estados: pendiente→proceso→finalizado/no aplica |
| 12 | Reporte Base Check | ✅ Implementado | `RepoBaseCheckController.php` + export Excel |
| 13 | Reporte Consolidado | ✅ Implementado | `RepoConsolidController.php` + export Excel |
| 14 | Reporte Financiero | ✅ Implementado | `RepoFinancieroController.php` + export Excel |
| 15 | Auditoría de Checklist | ✅ Implementado | `AuditChecklistController.php`, filtro por usuario/fechas |
| 16 | Gestión Actas con Cliente | ✅ Implementado | `ActaClienteController.php` + export Excel |
| 17 | Actividades Eco. Cliente | ✅ Implementado | `ActividadEcoClienteController.php`, CRUD |
| 18 | Lista Accionistas | ✅ Implementado | `ListaAccionistasController.php`, CRUD completo |
| 19 | Personas de Contacto | ✅ Implementado | `PersonasContactoController.php`, CRUD completo |
| 20 | Claves de Clientes | ✅ Implementado | `ClavesClienteController.php`, CRUD |
| 21 | Cambio de Contraseña | ✅ Implementado | `CambioPasswordController.php` |
| 22 | Asignación de Obligaciones | ✅ Implementado | `AsignaObligController.php` |
| 23 | Obligaciones Periód./Ocas./Admin. | ✅ Implementado | 3 controladores (Periódica, Ocasional, Administrable) |
| 24 | Reagendamiento (Dinámica/Periódica) | ✅ Implementado | `ReagendarDinaController`, `ReagendarPerioController` |
| 25 | Crear Obligación Dinámica | ✅ Implementado | `CrearDinamicaController.php` |
| 26 | Agenda Dinámica | ✅ Implementado | `AgendaDinamicaController.php` |
| 27 | Eliminar Oblig. por Cliente | ✅ Implementado | `ElimiObliClienController.php` |
| 28 | Importación Tarifas (Excel) | ✅ Implementado | `TarifaClienteController.php` + `TarifaClienteImport.php` |
| 29 | Importación Costos Usuario (Excel) | ✅ Implementado | `CostUsuarClienteController.php` + `CostoUsuarioImport.php` |
| 30 | Importación Otros Costos (Excel) | ✅ Implementado | `OtroscostController.php` + `OtrosCostosImport.php` |
| 31 | Municipio-Cliente | ✅ Implementado | `MunicipioClienteController.php` |
| 32 | Actividades TimeManager (Admin) | ✅ Implementado | `ActtimemanagerController.php`, CRUD |
| 33 | Seed Administrador | ✅ Implementado | `UsuarioAdministradorSeeder.php` |

### 5.2 Archivos de soporte

| Archivo | Propósito |
|---------|-----------|
| `app/Helpers/biblioteca.php` | Funciones helper globales del sistema |
| `app/Helpers/funciontabla.php` | Funciones auxiliares para manejo de tablas de obligaciones |
| `app/Rules/ValidarCampourl.php` | Regla de validación personalizada para URLs |
| `app/Imports/TarifaClienteImport.php` | Mapeo de importación Excel → `tarifa_cliente` |
| `app/Imports/CostoUsuarioImport.php` | Mapeo de importación Excel → `costo_usuario` |
| `app/Imports/OtrosCostosImport.php` | Mapeo de importación Excel → `otros_costos` |

---

## 6. Documentación Final de Cambios Implementados

### 6.1 Migraciones ejecutadas (orden cronológico)

| Fecha | Migración | Acción |
|-------|-----------|--------|
| 2020-04-06 | `create_menu_table` | Crear tabla `menu` (menús dinámicos) |
| 2020-04-06 | `create_submenu_table` | Crear tabla `submenu` |
| 2020-04-07 | `create_submenu_hash_usuario` | Crear relación submenú-usuario |
| 2020-06-11 | `renameid_table_menu_perfil` | Renombrar campos en `menu_perfil` |
| 2020-06-11 | `create_rols_table` | Crear tabla `rols` |
| 2020-06-14 | `renameid_table_user` | Ajustar IDs en `usuario_web` |
| 2020-06-15 | `rename_id_cliente` | Ajustar IDs en `cliente` |
| 2020-06-15 | `rename_id_acttimemanager` | Ajustar IDs en actividades TimeManager |
| 2020-06-16 | `rename_has_menu_perfil` | Ajustar tabla de relación menú-perfil |
| 2020-06-16 | `rename_tabla_perfil → menu_rol` | Renombrar tabla a `menu_rol` |
| 2020-06-20 | `crear_tabla_usuario_rol` | Crear tabla `usuario_rol` (M:N) |
| 2020-07-01 | `crear_tabla_usuario_permiso` | Crear tabla `permiso` |
| 2020-07-02 | `crear_tabla_permiso_rol` | Crear tabla `permiso_rol` (M:N) |
| 2020-07-03 | `renameid_table_timemanager` | Ajustar IDs en `TimeManager` |
| 2020-07-16 | `renameid_table_costo_usuario` | Ajustar IDs en `costo_usuario` |
| 2020-07-16 | `renameid_table_tarifa_cliente` | Ajustar IDs en `tarifa_cliente` |
| 2020-08-02 a 2020-08-05 | `renameid_table_obligaciones` (×6) | Ajustar IDs en +60 tablas de obligaciones tributarias |
| 2020-10-07 | `renameid_table_tipo_municipio` | Ajustar tabla `cliente_has_municipio` |
| 2023-01-20 | `create_cache_table` | Crear tabla `cache` de Laravel |

### 6.2 Patrones de diseño utilizados

- **Repository implícito**: Los modelos Eloquent actúan como repositorios de datos
- **Menús dinámicos por BD**: No hardcodeados; se cargan según rol del usuario logueado
- **Importación masiva Excel**: Usa paquete `maatwebsite/excel` con clases Import dedicadas
- **Exportación Excel**: Controladores de reportes generan archivos Excel para descarga
- **Middleware de autorización**: `superadmin` protege todo el panel `/admin`
- **Helpers globales**: Funciones transversales en `app/Helpers/`

### 6.3 Tecnologías y dependencias clave

| Paquete | Uso |
|---------|-----|
| Laravel 6.x | Framework backend |
| AdminLTE | Template del panel de administración |
| Bootstrap 4 | Framework CSS |
| jQuery | Interactividad frontend |
| maatwebsite/excel | Importación/exportación de Excel |
| Blade | Motor de plantillas |

---

## 7. Instrucciones de Instalación Local (XAMPP)

```bash
# 1. Clonar repositorio
git clone https://github.com/fireblack32/acontribut.git
cd acontribut

# 2. Instalar dependencias PHP
composer install

# 3. Copiar y configurar .env
cp .env.example .env
# Editar DB_DATABASE, DB_USERNAME, DB_PASSWORD

# 4. Generar clave de aplicación
php artisan key:generate

# 5. Crear la base de datos en MySQL (phpMyAdmin o CLI)
# CREATE DATABASE acontribut;

# 6. Ejecutar migraciones
php artisan migrate

# 7. Ejecutar seeder del administrador
php artisan db:seed --class=UsuarioAdministradorSeeder

# 8. Compilar assets (opcional)
npm install && npm run dev

# 9. Iniciar servidor
php artisan serve
# O configurar VirtualHost en XAMPP apuntando a /public
```

---

*Documento generado como parte del entregable #12: Repository, System Documentation & Evidence Pack.*
