FROM php:8.3.10-fpm

RUN pecl install xdebug && \
    docker-php-ext-enable xdebug

# Update package list and install git
RUN apt update && \
    apt install -y git unzip libzip-dev && \
    docker-php-ext-install zip && \
    rm -rf /var/lib/apt/lists/*

COPY --from=composer:2.7 /usr/bin/composer /usr/local/bin/composer

WORKDIR /usr/src/app