# Usa la imagen oficial de PHP
FROM php:8.1-apache

# Copia el contenido de tu proyecto al contenedor
COPY . /var/www/html/

# Instala las dependencias de Composer
RUN apt-get update && apt-get install -y libzip-dev \
    && docker-php-ext-install zip \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer install

# Exponer el puerto 80
EXPOSE 80