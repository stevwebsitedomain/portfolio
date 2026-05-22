# Optional: separate Render service for frontend only. No php init.

FROM yiisoftware/yii2-php:8.4-apache

WORKDIR /app
COPY . .

RUN if [ -f composer.lock ]; then \
      composer install --no-dev --optimize-autoloader --no-interaction --ignore-platform-reqs; \
    else \
      composer update --no-dev --optimize-autoloader --no-interaction --ignore-platform-reqs; \
    fi

RUN sed -i -e 's|/app/web|/app/frontend/web|g' /etc/apache2/sites-available/000-default.conf \
    && a2enmod rewrite \
    && chown -R www-data:www-data frontend/runtime frontend/web/assets backend/runtime console/runtime

ENV YII_ENV=prod
ENV YII_DEBUG=0
EXPOSE 80
