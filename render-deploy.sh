#!/usr/bin/env bash

# Clear configurations to read runtime Render environment variables safely
php artisan config:clear

# Run database migrations securely over Aiven SSL
php artisan migrate --force

# FIX: Execute the webdevops entrypoint using its correct path
exec /opt/docker/bin/entrypoint.sh supervisord
