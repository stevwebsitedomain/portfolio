# Render — Portfolio (Yii2 frontend). Build context = project root.

FROM yiisoftware/yii2-php:8.4-apache

WORKDIR /app

# 1) Dependencies first (better cache)
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction --ignore-platform-reqs

# 2) Application code
COPY . .

# 3) Production config + entry scripts
RUN php init --env=Production --overwrite=All

# 4) Apache → frontend/web
RUN sed -i -e 's|/app/web|/app/frontend/web|g' /etc/apache2/sites-available/000-default.conf \
    && a2enmod rewrite \
    && chown -R www-data:www-data \
        frontend/runtime \
        frontend/web/assets \
        backend/runtime \
        console/runtime

ENV YII_ENV=prod
ENV YII_DEBUG=0

EXPOSE 80
