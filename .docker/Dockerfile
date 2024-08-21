FROM php:8.3-apache
RUN apt-get update && apt upgrade -y
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable mysqli
RUN apt-get install -y zip

# Next libreris for PHP
RUN apt-get install -y libicu-dev
RUN docker-php-ext-configure intl
RUN docker-php-ext-install intl

# Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN a2enmod rewrite headers

COPY .. /var/www/html
WORKDIR /var/www/html