FROM php:8.3.7-fpm

RUN install-php-extensions \
    pcntl \
    pdo_mysql \
    sodium \
    curl \
    dom \
    fileinfo \
    filter \
    ctype \
    hash \
    mbstring \
    openssl \
    pcre \
    session \
    tokenizer \
    xml 

ENTRYPOINT ["php", "artisan", "octane:frankenphp"]
