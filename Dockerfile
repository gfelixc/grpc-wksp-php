FROM php:7.4.11

RUN apt-get update && \
    apt-get install -y zlib1g-dev unzip && \
    pecl install grpc && \
    docker-php-ext-enable grpc

RUN curl -sS https://getcomposer.org/installer -o composer-setup.php && \
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer