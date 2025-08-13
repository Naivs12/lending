#!/usr/bin/env bash
set -e

container_mode=${CONTAINER_MODE:-app}
echo "Container mode: $container_mode"

php() {
  su octane -c "php $*"
}

initialStuff() {
    echo "Clearing caches before running migrations..."
    php artisan config:clear
    php artisan cache:clear
    php artisan route:clear
    php artisan view:clear

    echo "Rebuilding config cache..."
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    php artisan event:cache
    php artisan package:discover --ansi

    echo "Running migrations..."
    php artisan migrate:fresh --seed
}

if [ "$1" != "" ]; then
    exec "$@"
elif [ "$container_mode" = "app" ]; then
    initialStuff
    exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.app.conf
elif [ "$container_mode" = "horizon" ]; then
    initialStuff
    exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.horizon.conf
elif [ "$container_mode" = "scheduler" ]; then
    initialStuff
    exec supercronic /etc/supercronic/laravel
else
    echo "Container mode mismatched."
    exit 1
fi