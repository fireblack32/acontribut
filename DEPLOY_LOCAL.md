# Despliegue local – Acontribut

Guía para levantar el proyecto **acontribut** en local y validar su funcionamiento.

---

## 1. Resumen del proyecto

| Aspecto | Detalle |
|--------|---------|
| **Stack** | Laravel 6 (PHP 7.2+), MySQL/MariaDB, Blade + AdminLTE, Laravel Mix |
| **Base de datos** | Nombre: `acontrib_optimals` (dump en `D:\Acontribut\Bases de datos\acontrib_optimals.sql`) |
| **Punto de entrada** | `public/index.php` → rutas en `routes/web.php` y `routes/api.php` |
| **Login** | Ruta `/seguridad/login`; usuario por defecto: **Admin** / **qazxsw1234** (creado con `crear_admin.sql`) |

### Módulos principales (rutas)

- Inicio, login/logout
- TimeManager, checklist, mis pendientes
- Reportes (base check, consolidado, financiero, auditoría checklist, actas)
- Administración (clientes, obligaciones, usuarios, permisos, etc.)
- Cambio de contraseña, comunicados

---

## 2. Análisis de la base de datos

- **Ubicación del dump:** `D:\Acontribut\Bases de datos\acontrib_optimals.sql`
- **Origen:** phpMyAdmin / MariaDB 10.3, charset `utf8`/`utf8_spanish_ci`.
- **Contenido:** dump completo con estructura y datos (más de 40.000 líneas).

### Tablas principales (resumen)

- **Usuarios y seguridad:** `usuario_web`, `usuario_rol`, `rols`, `permiso`, `permiso_rol`, `menu`, `submenu`, `menu_perfil`, `menu_rol`, `perfil`, `area_usuario`, `submenu_hash_usuario`.
- **Clientes y obligaciones:** `cliente`, `cliente_has_obligaciones`, `obligaciones`, `asigna_obligacion`, `actividades_cliente`, `actividades_economicas`, `cliente_has_municipio`, `clientes_has_claves`, `sucursal_cliente`, `representante_cliente`, `tarifa_cliente`, `costo_usuario`.
- **Checklist y tiempos:** `checklist`, `detalle_checklist`, `pasos_checklist`, `item_checklist_estado`, `timemanager`, `Grupo_TimeManager`, `tipo_timemanager`.
- **Catálogos y controles:** `ciudad`, `depto`, `tipo_municipio`, `obligaciones_dinamicas_almacenadas`, `control_obl_tipo_1`, `control_obl_tipo_2`, múltiples tablas `obd_*`, `obp_*`, `ob_*`, tipos (`tipo_*`), etc.
- **Otros:** `comunicados`, `comunicadosint`, `migrations`, `caja`, `libros_cliente`, etc.

En total hay más de 170 tablas. La aplicación espera que la BD se llame **`acontrib_optimals`** y que ya existan estas tablas (el dump las crea todas).

---

## 3. Requisitos previos

- **PHP** ≥ 7.2 (extensiones: pdo_mysql, mbstring, openssl, tokenizer, xml, ctype, json, bcmath, fileinfo)
- **Composer**
- **Node.js** y **npm** (para compilar assets con Laravel Mix)
- **MySQL 5.7+** o **MariaDB 10.3+** (recomendado para coincidir con el dump)

---

## 4. Pasos para desplegar en local

### 4.1 Clonar / abrir el proyecto

El código debe estar en `d:\Acontribut\acontribut` (o la ruta que uses).

### 4.2 Base de datos MySQL/MariaDB

1. Iniciar MySQL/MariaDB (XAMPP, WAMP, servicio de Windows, etc.).
2. Crear la base de datos (si no existe):

```sql
CREATE DATABASE IF NOT EXISTS acontrib_optimals
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

3. Importar el dump (en consola, ajustando usuario y ruta):

```bash
mysql -u root -p acontrib_optimals < "D:\Acontribut\Bases de datos\acontrib_optimals.sql"
```

O desde **HeidiSQL / phpMyAdmin**: crear la BD `acontrib_optimals` y ejecutar/importar el archivo `acontrib_optimals.sql`.

4. (Opcional) Crear o actualizar el usuario administrador:

Ejecutar en la BD `acontrib_optimals` el contenido del archivo **`crear_admin.sql`** (en la raíz del proyecto):

- Usuario: **Admin**
- Contraseña: **qazxsw1234**

### 4.3 Variables de entorno

1. Copiar el ejemplo de entorno:

```bash
cd d:\Acontribut\acontribut
copy .env.example .env
```

2. Editar **`.env`** y configurar la base de datos:

```env
APP_NAME=Laravel
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=acontrib_optimals
DB_USERNAME=root
DB_PASSWORD=tu_password_mysql
```

Ajusta `DB_USERNAME` y `DB_PASSWORD` según tu instalación de MySQL/MariaDB.

### 4.4 Dependencias PHP y clave de aplicación

```bash
cd d:\Acontribut\acontribut
composer install
php artisan key:generate
```

### 4.5 Dependencias frontend y compilación de assets

```bash
npm install
npm run dev
```

Para desarrollo con recarga: `npm run watch`.

### 4.6 Permisos y almacenamiento

En Windows suele no ser necesario, pero si usas WSL o Linux:

```bash
# Opcional en Linux/WSL
mkdir -p storage/framework/{sessions,views,cache}
mkdir -p storage/logs
mkdir -p bootstrap/cache
# Ajustar permisos si hace falta
```

### 4.7 Migraciones de Laravel (opcional)

El proyecto tiene migraciones en `database/migrations/` (renombrado de tablas, tablas de cache, etc.). La BD ya viene completa con el dump, por lo que **no es obligatorio** ejecutar migraciones para una primera validación. Si quieres alinear con el código:

```bash
php artisan migrate
```

Si alguna migración falla por que la tabla ya existe o el nombre es distinto, puedes revisar migración por migración o usar `--force` con cuidado.

### 4.8 Servidor de desarrollo

```bash
php artisan serve
```

Se abrirá en **http://localhost:8000**.

- **Inicio:** http://localhost:8000/
- **Login:** http://localhost:8000/seguridad/login  
  Usuario: **Admin**, contraseña: **qazxsw1234** (si ejecutaste `crear_admin.sql`).

---

## 5. Versión de PHP recomendada

Usa **PHP 7.4** (p. ej. 7.4.3) para coincidir con Laravel 6 y con entornos de producción típicos. Con **MySQL 8** puede aparecer el error *"The server requested authentication method unknown to the client"* (2054). Prueba en MySQL: `ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY '';` (si el plugin está cargado). Si no, usa **MySQL 5.7** en local o un servidor donde sí esté disponible `mysql_native_password`.

## 6. Resolución de problemas frecuentes

| Problema | Qué revisar |
|----------|-------------|
| Error de conexión a BD | `.env`: `DB_DATABASE=acontrib_optimals`, `DB_USERNAME`, `DB_PASSWORD`, que MySQL esté levantado. |
| Error 2054 (auth method unknown) | Cambiar usuario MySQL a `mysql_native_password` si el servidor lo permite, o usar MySQL 5.7 en local. |
| `APP_KEY` no definida | Ejecutar `php artisan key:generate`. |
| Página en blanco o 500 | Revisar `storage/logs/laravel.log`; permisos de `storage/` y `bootstrap/cache/`. |
| CSS/JS no cargan | Ejecutar `npm run dev` (o `npm run prod`) y recargar con caché limpia. |
| Login incorrecto | Ejecutar `crear_admin.sql` en la BD `acontrib_optimals` y usar Admin / qazxsw1234. |
| Charset / collation | El dump usa `utf8`/`utf8_spanish_ci`; Laravel usa `utf8mb4`. Si hay errores de caracteres, revisar collation de la BD y de las tablas. |
| Errores de tipos o compatibilidad PHP | Usar **PHP 7.4**; Laravel 6 no está soportado oficialmente en PHP 8.1+. |

---

## 7. Estructura de carpetas relevante

```
acontribut/
├── app/                 # Lógica: Controladores, Modelos, Middleware
├── config/              # database.php, app.php, etc.
├── database/migrations/ # Migraciones Laravel (opcional con dump)
├── public/              # index.php, assets compilados, .htaccess
├── resources/views/     # Vistas Blade (incl. theme AdminLTE)
├── routes/              # web.php, api.php
├── .env                 # Variables de entorno (no en Git)
├── .env.example         # Plantilla
├── crear_admin.sql      # Script usuario Admin
└── DEPLOY_LOCAL.md      # Esta guía
```

Base de datos externa:

```
D:\Acontribut\Bases de datos\
└── acontrib_optimals.sql   # Dump completo a importar
```

Con estos pasos puedes desplegar el proyecto en local y validar su funcionamiento usando la base de datos proporcionada.
