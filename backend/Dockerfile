# =============================================================================
# Yii2 Advanced — Backend API (Render / Docker)
#
# REQUIRED Render settings:
#   Root Directory:         (EMPTY — do NOT set "backend")
#   Dockerfile Path:        backend/Dockerfile
#   Docker Build Context:   .
#
# Why: composer.json lives at repo root. Root Directory "backend" breaks composer.
# =============================================================================

# --- Stage 1: Composer (isolated; no php init) ---
FROM composer:2.2 AS vendor

WORKDIR /app

ENV COMPOSER_MEMORY_LIMIT=-1 \
    COMPOSER_ALLOW_SUPERUSER=1 \
    COMPOSER_NO_INTERACTION=1 \
    COMPOSER_CACHE_DIR=/tmp/cache

COPY composer.json composer.lock ./

RUN composer install \
    --no-dev \
    --prefer-dist \
    --optimize-autoloader \
    --ignore-platform-reqs \
    --no-scripts \
    --no-progress \
    || (echo "composer install failed; retrying with update..." \
        && composer update \
        --no-dev \
        --prefer-dist \
        --optimize-autoloader \
        --ignore-platform-reqs \
        --no-scripts \
        --no-progress)

# --- Stage 2: PHP 8.2 + Apache (backend/web entry) ---
FROM yiisoftware/yii2-php:8.2-apache

WORKDIR /app

COPY --from=vendor /app/vendor /app/vendor
COPY composer.json composer.lock ./

COPY common /app/common
COPY backend /app/backend
COPY console /app/console

RUN sed -i 's|/app/web|/app/backend/web|g' /etc/apache2/sites-available/000-default.conf \
    && a2enmod rewrite headers \
    && mkdir -p \
        backend/runtime \
        backend/web/assets \
        console/runtime \
    && chown -R www-data:www-data \
        backend/runtime \
        backend/web/assets \
        console/runtime

ENV YII_ENV=prod \
    YII_DEBUG=0

EXPOSE 80

CMD ["apache2-foreground"]
