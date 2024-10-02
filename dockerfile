# Usa la imagen oficial de PHP con Apache
FROM php:8.1-apache

# Instala las extensiones necesarias
RUN apt-get update && apt-get install -y libzip-dev \
    && docker-php-ext-install zip \
    && apt-get clean

# Instala Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copia el contenido de tu proyecto al contenedor
COPY . /var/www/html/

# Cambia la propiedad de los archivos a www-data
RUN chown -R www-data:www-data /var/www/html

# Exponer el puerto 80
EXPOSE 80

# El contenedor se ejecutará usando Apache
CMD ["apache2-foreground"]
