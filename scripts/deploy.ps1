# Script de despliegue - Autenticación Azure + portales (Contabilidad, Auditoría, Legales)
# Uso: desde la raíz del proyecto en PowerShell: .\scripts\deploy.ps1
# Requisitos: PHP, Composer; .env de producción ya configurado.

$ErrorActionPreference = "Stop"
$RootDir = Split-Path -Parent (Split-Path -Parent $PSScriptRoot)
Set-Location $RootDir

Write-Host "=== Despliegue Sistema de Gestión (raíz: $RootDir) ===" -ForegroundColor Cyan

# 1. Modo mantenimiento (opcional)
# php artisan down --message="Despliegue en curso"

# 2. Actualizar código (si se usa Git)
if (Test-Path .git) {
    Write-Host "Actualizando código desde Git..." -ForegroundColor Yellow
    git pull
}

# 3. Dependencias PHP
Write-Host "Instalando dependencias Composer (sin dev)..." -ForegroundColor Yellow
composer install --no-dev --optimize-autoloader --no-interaction

# 4. Cache de configuración y rutas
Write-Host "Generando caché de configuración..." -ForegroundColor Yellow
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 5. Migraciones
Write-Host "Ejecutando migraciones (conexión por defecto)..." -ForegroundColor Yellow
php artisan migrate --force

# Migraciones por portal (descomentar si aplica):
# php artisan migrate --database=contabilidad --force
# php artisan migrate --database=auditoria --force
# php artisan migrate --database=legales --force

# 6. Salir de mantenimiento (si se usó)
# php artisan up

Write-Host "=== Despliegue finalizado ===" -ForegroundColor Green
Write-Host "Revisa que APP_URL y redirect_uri en Azure coincidan con la URL de este servidor."
