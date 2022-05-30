FROM php:8.1-apache
ENV APACHE_DOCUMENT_ROOT /var/www/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
RUN a2enmod rewrite
RUN a2enmod headers

RUN apt-get update -y && apt-get upgrade -y && apt-get install -y curl git zip unzip vim \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libtidy-dev \
        libzip-dev \
        librdkafka-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd mysqli pdo_mysql exif tidy zip

RUN pecl install rdkafka \
  && docker-php-ext-enable rdkafka

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN useradd -ms /bin/bash westore

USER westore
WORKDIR /var/www
