# Build context = project root (not backend/ alone)

FROM yiisoftware/yii2-php:8.4-apache

WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction --ignore-platform-reqs

COPY . .

RUN php init --env=Production --overwrite=All

RUN sed -i -e 's|/app/web|/app/backend/web|g' /etc/apache2/sites-available/000-default.conf \
    && a2enmod rewrite \
    && chown -R www-data:www-data \
        frontend/runtime \
        backend/runtime \
        console/runtime

ENV YII_ENV=prod
ENV YII_DEBUG=0

EXPOSE 80
