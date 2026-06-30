FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git \
    && docker-php-ext-install zip pdo pdo_mysql

RUN a2enmod rewrite

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf


WORKDIR /var/www/html
COPY . .


RUN composer install --no-dev --optimize-autoloader --no-scripts

EXPOSE 80