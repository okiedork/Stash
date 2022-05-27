FROM php:8.1.5-cli-alpine3.15

WORKDIR /usr/src

COPY ["composer.json", "composer.lock", "/usr/src"]
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN docker-php-source extract && \
    wget -O redis.tar.gz https://github.com/phpredis/phpredis/archive/refs/tags/5.3.7.tar.gz && \
    mkdir /usr/src/php/ext/redis && \
    tar --extract --file redis.tar.gz --directory /usr/src/php/ext/redis --strip 1 && \
    docker-php-ext-install -j$(nproc) redis && \
    docker-php-source delete

RUN composer install --no-progress --ignore-platform-reqs --no-dev --prefer-dist --optimize-autoloader --no-interaction

COPY ["test.php", "/usr/src"]
