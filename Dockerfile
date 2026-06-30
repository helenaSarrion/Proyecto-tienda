FROM php:8.2-apache

# Instalar extensiones necesarias para Symfony
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git \
    && docker-php-ext-install zip pdo pdo_mysql

# Habilitar mod_rewrite para Apache (esencial para Symfony)
RUN a2enmod rewrite

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurar la raíz de Apache hacia la carpeta public/ de Symfony
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Copiar el proyecto
WORKDIR /var/www/html
COPY . .

# Instalar dependencias de Composer
RUN composer install --no-dev --optimize-autoloader

# Permisos para las carpetas de Symfony
RUN chown -R www-data:www-data /var/www/html/var

EXPOSE 80