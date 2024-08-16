FROM dunglas/frankenphp

RUN install-php-exension \
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

COPY . /app

ENTRYPOINT ["php", "artisan", "octane:frankenphp"]
