#!/usr/bin/env bash

php artisan config:clear

php artisan migrate --force

/usr/bin/supervisord -n -c /etc/supervisor/supervisord.conf
