# Usa la imagen oficial de PHP con Apache
FROM php:8.1-apache

# Instala las extensiones necesarias para Laravel y MySQL
RUN apt-get update && apt-get install -y \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    zip \
    unzip \
    git \
    curl \
    libxml2-dev \
    libpq-dev \
    libonig-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql mbstring zip opcache tokenizer xml ctype

# Instala Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copia todo el contenido del proyecto Laravel al contenedor
COPY . /var/www/html

# Cambia el directorio de trabajo
WORKDIR /var/www/html

# Instala las dependencias de Composer
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Asegúrate de que los directorios de almacenamiento tengan los permisos correctos
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Configura Apache para que apunte al directorio public de Laravel
RUN sed -i -e 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf

# Habilitar el mod_rewrite de Apache (necesario para Laravel)
RUN a2enmod rewrite

# Exponer el puerto 80 para el tráfico HTTP
EXPOSE 80

# El contenedor se ejecutará usando Apache
CMD ["apache2-foreground"]