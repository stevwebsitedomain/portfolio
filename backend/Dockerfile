# Portfolio API only — no Yii2, no login page (Render)
# Render: Dockerfile Path = backend/Dockerfile, Docker Context = .

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
    && sed -ri 's!/var/www/!/var/www/html/public/!g' /etc/apache2/apache2.conf

EXPOSE 80
CMD ["apache2-foreground"]
