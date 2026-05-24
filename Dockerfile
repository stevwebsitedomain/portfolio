# Same as backend/Dockerfile — minimal API only (no Yii2)
# Render: Dockerfile Path = backend/Dockerfile OR ./Dockerfile

FROM composer:2 AS vendor
WORKDIR /app
COPY backend/composer.json ./
RUN composer install --no-dev --prefer-dist --optimize-autoloader --no-interaction --no-progress

FROM php:8.2-apache
WORKDIR /var/www/html

RUN apt-get update \
    && apt-get install -y --no-install-recommends libzip-dev unzip libcurl4-openssl-dev \
    && docker-php-ext-install zip \
    && docker-php-ext-install curl \
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
        && a2enconf portfolio-api

EXPOSE 80
CMD ["apache2-foreground"]
