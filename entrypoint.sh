#!/bin/bash
set -e

if [ ! -f "composer.json" ]; then
    echo ">> Nenhum projeto encontrado. Criando Laravel 13..."
    composer create-project laravel/laravel:^13.0 /tmp/laravel-app
    cp -a /tmp/laravel-app/. .
    rm -rf /tmp/laravel-app
fi

composer install --no-interaction

chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

exec "$@"