#!/usr/bin/env bash

php artisan config:clear

php artisan migrate --force

exec /entrypoint.sh supervisord
