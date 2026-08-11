FROM webdevops/php-nginx:8.4

ENV WEB_DOCUMENT_ROOT=/app/public
ENV COMPOSER_ALLOW_SUPERUSER=1

WORKDIR /app

COPY . .

# Ensure secure file permissions for the database CA certificate
RUN chmod 644 /app/ca.pem

# FIX: Force execution permissions for the Render startup script inside the container
RUN chmod +x /app/render-deploy.sh

# Install production dependencies and cache configurations
RUN composer install --no-dev --optimize-autoloader && \
    php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache

# Set permissions for Laravel directories
RUN chown -R application:application /app/storage /app/bootstrap/cache

EXPOSE 80

CMD ["/app/render-deploy.sh"]
