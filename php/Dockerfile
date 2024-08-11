FROM php:8.3.10-fpm

RUN pecl install xdebug && \
    docker-php-ext-enable xdebug

# Update package list and install git
RUN apt-get update && \
    apt-get install -y git unzip libzip-dev sqlite3 libsqlite3-dev && \
    docker-php-ext-install zip && \
    rm -rf /var/lib/apt/lists/*

COPY --from=composer:2.7 /usr/bin/composer /usr/local/bin/composer

COPY --chmod=744 ./entrypoint.sh /usr/local/bin/php-entrypoint.sh
CMD ["/usr/local/bin/php-entrypoint.sh"]

WORKDIR /usr/src/app