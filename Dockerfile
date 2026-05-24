# Same as backend/Dockerfile — minimal API only (no Yii2)
# Render: Dockerfile Path = backend/Dockerfile OR ./Dockerfile

FROM composer:2 AS vendor
WORKDIR /app
COPY backend/composer.json ./
RUN composer install --no-dev --prefer-dist --optimize-autoloader --no-interaction --no-progress

FROM php:8.2-apache
WORKDIR /var/www/html

RUN apt-get update \
    && apt-get install -y --no-install-recommends libzip-dev unzip \
    && docker-php-ext-install zip \
    && a2enmod rewrite headers \
    && rm -rf /var/lib/apt/lists/*

COPY --from=vendor /app/vendor ./vendor
COPY backend/config.php ./config.php
COPY backend/data ./data
COPY backend/src ./src
COPY backend/public ./public

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri 's!/var/www/!/var/www/html/public/!g' /etc/apache2/apache2.conf \
    && sed -ri 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf \
    && printf '%s\n' \
        '<Directory /var/www/html/public>' \
        '    Options -Indexes +FollowSymLinks' \
        '    AllowOverride All' \
        '    Require all granted' \
        '    FallbackResource /index.php' \
        '</Directory>' \
        > /etc/apache2/conf-available/portfolio-api.conf \
        && a2enconf portfolio-api \
    && printf '%s\n' \
        '<IfModule mod_headers.c>' \
        '  SetEnvIf Origin "^https://([a-zA-Z0-9-]+\\.)*vercel\\.app$" CORS_ORIGIN=$0' \
        '  SetEnvIf Origin "^http://(localhost|127\\.0\\.0\\.1)(:[0-9]+)?$" CORS_ORIGIN=$0' \
        '  Header always set Access-Control-Allow-Origin "%{CORS_ORIGIN}e" env=CORS_ORIGIN' \
        '  Header always set Access-Control-Allow-Methods "GET, POST, OPTIONS"' \
        '  Header always set Access-Control-Allow-Headers "Content-Type, Accept, X-Portfolio-Debug"' \
        '  Header always set Access-Control-Max-Age "86400"' \
        '  Header always set Vary "Origin"' \
        '</IfModule>' \
        > /etc/apache2/conf-available/portfolio-cors.conf \
    && a2enconf portfolio-cors

EXPOSE 80
CMD ["apache2-foreground"]
