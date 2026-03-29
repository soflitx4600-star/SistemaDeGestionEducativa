#!/bin/sh
# set -e: Salir inmediatamente si un comando falla.
# set -x: Imprimir cada comando en el log antes de ejecutarlo.
set -ex

echo "--- Creando directorios necesarios ---"
mkdir -p storage/framework/sessions storage/framework/views storage/framework/cache storage/logs bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

echo "--- Ejecutando migraciones de base de datos ---"
php artisan migrate --force

echo "--- Creando enlace simbólico de storage ---"
php artisan storage:link || true

echo "--- Limpiando y optimizando caché ---"
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "--- Iniciando PHP-FPM en modo daemon ---"
php-fpm -D

echo "--- Verificando la configuración de Nginx ---"
nginx -t

echo "--- Iniciando Nginx en primer plano ---"
# Usamos comillas simples para evitar cualquier problema de interpretación
nginx -g 'daemon off;'