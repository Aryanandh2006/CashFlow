#!/usr/bin/env bash

# Clear all previous structural caches safely
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Build optimal production performance caches at runtime
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run database migrations securely over Aiven SSL
php artisan migrate --force

# Execute the primary container entrypoint wrapper
exec /opt/docker/bin/entrypoint.sh supervisord
