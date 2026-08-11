FROM webdevops/php-nginx:8.4

ENV WEB_DOCUMENT_ROOT=/app/public
ENV COMPOSER_ALLOW_SUPERUSER=1

# FIX: Force Nginx to listen on the standard container port mapping
ENV PORT=80

WORKDIR /app

COPY . .

RUN chmod 644 /app/ca.pem
RUN chmod +x /app/render-deploy.sh

RUN composer install --no-dev --optimize-autoloader && \
    php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache

RUN chown -R application:application /app/storage /app/bootstrap/cache

EXPOSE 80

CMD ["/app/render-deploy.sh"]
