FROM webdevops/php-nginx:8.4

ENV WEB_DOCUMENT_ROOT=/app/public
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV PORT=80

WORKDIR /app

COPY . .

RUN chmod 644 /app/ca.pem
RUN chmod +x /app/render-deploy.sh

# ONLY install code dependencies here. Do NOT build configuration caches during build time.
RUN composer install --no-dev --optimize-autoloader

# Set absolute directory write ownership permissions
RUN chown -R application:application /app/storage /app/bootstrap/cache

EXPOSE 80

CMD ["/app/render-deploy.sh"]
