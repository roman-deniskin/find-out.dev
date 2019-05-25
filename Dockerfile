FROM php:7.3-fpm

MAINTAINER Roman Deniskin <roman-deniskin@yandex.ru>

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
        nano \
        htop \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        wget \
        libzip-dev \
        zip \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install -j$(nproc) pdo_mysql \
    && docker-php-ext-configure zip --with-libzip \
    && docker-php-ext-install -j$(nproc) zip \
    && pecl install xdebug-2.7.1 \
    && docker-php-ext-enable xdebug \
    && mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini" \
    && rm -rf /var/lib/apt/lists/*
RUN chown -R $USER:www-data /var/www/html/
RUN chmod -R 775 /var/www/html/
RUN apt-get update && apt-get install -y \
        git