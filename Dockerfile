FROM php:8.2-apache

# Instalar librerías esenciales del sistema
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git \
    && docker-php-ext-install zip pdo pdo_mysql

# Habilitar el módulo de reescritura de Apache para Symfony
RUN a2enmod rewrite

# Instalar Composer oficial dentro del servidor
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Redireccionar Apache a la carpeta pública de Symfony
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Copiar el proyecto al contenedor
WORKDIR /var/www/html
COPY . .

# ¡LA LÍNEA CLAVE! Instalar las librerías evitando scripts conflictivos
RUN composer install --no-dev --optimize-autoloader --no-scripts

EXPOSE 80