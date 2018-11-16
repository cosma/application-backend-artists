FROM php:7.2

RUN apt-get update \
    && apt-get install -y \
        procps \
        git \
        devscripts \
        build-essential \
        lintian \
        libicu-dev \
        libzip-dev \
        nano \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && rm /etc/localtime \
    && ln -s /usr/share/zoneinfo/UTC /etc/localtime \
    && docker-php-ext-install pdo pdo_mysql pcntl zip \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl

WORKDIR /usr/share/code
