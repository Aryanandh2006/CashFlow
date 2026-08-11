FROM webdevops/php-nginx:8.4

ENV WEB_DOCUMENT_ROOT=/app/public
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV PORT=80

WORKDIR /app

# Copy application files
COPY . .

# Secure permissions for variables and scripts
RUN chmod 644 /app/ca.pem
RUN chmod +x /app/render-deploy.sh

# 1. Install Composer dependencies
RUN composer install --no-dev --optimize-autoloader

# 2. Add NodeSource repository for Node 22 (LTS) and install Node + NPM
RUN apt-get update && apt-get install -y curl && \
    curl -fsSL https://nodesource.com | bash - && \
    apt-get install -y nodejs && \
    npm install && \
    npm run build && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

# 3. Give full storage and asset permissions to the web app user
RUN chown -R application:application /app/storage /app/bootstrap/cache /app/public
EXPOSE 80

CMD ["/app/render-deploy.sh"]
