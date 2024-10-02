# Usa la imagen oficial de PHP con Apache
FROM php:8.1-apache

# Actualiza los repositorios de paquetes
RUN apt-get update && apt-get upgrade -y

# Instala dependencias del sistema y extensiones necesarias
RUN apt-get install -y \
    zip \
    unzip \
    git \
    curl \
    libpng-dev \
    libjpeg62-turbo-dev \  # Cambio en la librería de JPEG
    libfreetype6-dev \
    libonig-dev \
    libzip-dev \
    libxml2-dev \
    libpq-dev \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Configura e instala las extensiones de PHP, sin configurar GD
RUN docker-php-ext-install pdo pdo_mysql mbstring zip opcache tokenizer xml ctype

# Instalación básica de GD sin parámetros personalizados
RUN docker-php-ext-install gd

# Instala Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copia el contenido del proyecto al contenedor
COPY . /var/www/html/

# Instala las dependencias de Composer
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Cambia la propiedad de los archivos a www-data
RUN chown -R www-data:www-data /var/www/html

# Configura Apache para que use el directorio public de Laravel
RUN sed -i -e 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf

# Asegura que los directorios de almacenamiento tengan los permisos correctos
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Exponer el puerto 80
EXPOSE 80

# El contenedor se ejecutará usando Apache
CMD ["apache2-foreground"]
