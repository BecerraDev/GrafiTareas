# Usa la imagen oficial de PHP con Apache
FROM php:8.1-apache

# Instala las extensiones necesarias
RUN apt-get update && apt-get install -y \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql mbstring zip opcache tokenizer xml ctype \
    && apt-get clean

# Instala Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copia todo el contenido del proyecto al contenedor
COPY . /var/www/html/

# Instala las dependencias de Composer
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Cambia la propiedad de los archivos a www-data
RUN chown -R www-data:www-data /var/www/html

# Configura el DocumentRoot para apuntar al directorio public de Laravel
RUN sed -i -e 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf

# Asegúrate de que los directorios de almacenamiento tengan los permisos correctos
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Exponer el puerto 80
EXPOSE 80

# El contenedor se ejecutará usando Apache
CMD ["apache2-foreground"]
