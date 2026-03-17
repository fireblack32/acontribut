#!/usr/bin/env bash
#
# Script de despliegue - Autenticación Azure + portales (Contabilidad, Auditoría, Legales)
# Uso: desde la raíz del proyecto ejecutar: bash scripts/deploy.sh
# Requisitos: PHP, Composer; .env de producción ya configurado en el servidor.
#

set -e

# Ir a la raíz del proyecto (donde está artisan)
SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
ROOT_DIR="$(cd "$SCRIPT_DIR/.." && pwd)"
cd "$ROOT_DIR"

echo "=== Despliegue Sistema de Gestión (raíz: $ROOT_DIR) ==="

# 1. Modo mantenimiento (opcional; descomentar si usas php artisan down)
# php artisan down --message="Despliegue en curso"

# 2. Actualizar código (si se usa Git en el servidor)
if [ -d .git ]; then
  echo "Actualizando código desde Git..."
  git pull
fi

# 3. Dependencias PHP
echo "Instalando dependencias Composer (sin dev)..."
composer install --no-dev --optimize-autoloader --no-interaction

# 4. Cache de configuración y rutas
echo "Generando caché de configuración..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 5. Migraciones (solo conexión por defecto; para portales ejecutar a mano si aplica)
echo "Ejecutando migraciones (conexión por defecto)..."
php artisan migrate --force

# Migraciones por portal (descomentar y ajustar si cada entorno tiene sus BDs)
# php artisan migrate --database=contabilidad --force
# php artisan migrate --database=auditoria --force
# php artisan migrate --database=legales --force

# 6. Permisos (ajustar usuario/grupo según el servidor)
echo "Ajustando permisos storage y bootstrap/cache..."
chmod -R 775 storage bootstrap/cache
# Si el servidor web corre como www-data:
# chown -R www-data:www-data storage bootstrap/cache

# 7. Salir de mantenimiento (si se usó php artisan down)
# php artisan up

echo "=== Despliegue finalizado ==="
echo "Revisa que APP_URL y redirect_uri en Azure coincidan con la URL de este servidor."
