# ==========================================
# STAGE 1: Ultra-lightweight Frontend Builder
# ==========================================
FROM node:22-alpine AS frontend-builder
WORKDIR /build

COPY package*.json vite.config.js ./
COPY resources/ ./resources/
COPY public/ ./public/

RUN npm ci --no-audit --no-fund && \
    NODE_OPTIONS="--max-old-space-size=350" npm run build

# ==========================================
# STAGE 2: Core Production PHP-Nginx Runtime
# ==========================================
FROM webdevops/php-nginx:8.4

ENV WEB_DOCUMENT_ROOT=/app/public
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV PORT=80

# CRITICAL: Prevent Composer from exhausting Free Tier resources
ENV COMPOSER_PROCESS_TIMEOUT=600
ENV COMPOSER_MAX_PARALLEL_HTTP=1

WORKDIR /app

COPY . .

RUN chmod 644 /app/ca.pem
RUN chmod +x /app/render-deploy.sh

# Install PHP dependencies step-by-step with zero cache bloat
RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-cache \
    --prefer-dist \
    --no-interaction

# Pull pre-compiled assets directly
COPY --from=frontend-builder /build/public/build ./public/build

RUN chown -R application:application /app/storage /app/bootstrap/cache /app/public
EXPOSE 80

CMD ["/app/render-deploy.sh"]
