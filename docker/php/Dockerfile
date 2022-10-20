FROM php:8.1.3-fpm AS base

WORKDIR /var/www/html

ENV COMPOSER_ALLOW_SUPERUSER=1 \
	COMPOSER_HOME=/composer

COPY --from=composer:2.1 /usr/bin/composer /usr/bin/composer

RUN apt-get update && \
    apt-get -y install git zip unzip libzip-dev libicu-dev libonig-dev && \
    docker-php-ext-install pdo_mysql intl zip bcmath

FROM base AS local

FROM base AS prod

COPY ./src .

RUN composer install --ansi --quiet --no-interaction --no-dev --no-scripts --prefer-dist

RUN php artisan cache:clear && \
    php artisan config:clear && \
    php artisan route:clear && \
    chown -R www-data:www-data storage bootstrap/cache
