# Use the composer image to install the Laravel dependencies
FROM composer AS composer

WORKDIR /app

COPY composer.json composer.lock ./
COPY database ./database

RUN composer install --prefer-dist --optimize-autoloader --ignore-platform-reqs --no-scripts

# PHP-FPM base image with dependencies
FROM php:7.2-fpm-alpine

RUN apk add --no-cache \
    build-base autoconf \
    openssl-dev \
    libmcrypt-dev \
    libxml2-dev

RUN pecl install mcrypt-1.0.1 redis-5.2.0 \
    && docker-php-ext-enable mcrypt \
    && docker-php-ext-enable redis \
    && docker-php-ext-install pcntl \
    && docker-php-ext-install pdo pdo_mysql \
    && docker-php-ext-install bcmath

WORKDIR /app

COPY --from=composer /app/vendor ./vendor
COPY . .
RUN mkdir -p ./storage/app ./storage/framework ./storage/logs ./bootstrap/cache ./storage/app/public ./storage/app ./storage/framework/cache ./storage/framework/cache/data ./storage/framework/testing ./storage/framework/sessions ./storage/framework ./storage/framework/views ./storage/logs
RUN chown -R www-data:www-data ./storage ./bootstrap/cache