FROM dunglas/frankenphp:1.0.1

WORKDIR /app

COPY . /app

RUN apt update && apt install -y zip libzip-dev && \
    docker-php-ext-install zip && \
    docker-php-ext-enable zip

COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

RUN composer install --no-interaction --prefer-dist --optimize-autoloader
