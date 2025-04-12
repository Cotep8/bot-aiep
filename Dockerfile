# Imagen base con PHP y Apache
FROM php:8.2-apache

# Instala dependencias necesarias para instalar extensiones
RUN apt-get update && apt-get install -y \
    libcurl4-openssl-dev \
    pkg-config \
    libssl-dev \
    unzip \
    zip \
    curl \
    && docker-php-ext-install curl

# Copia el contenido de tu proyecto al contenedor
COPY . /var/www/html/

# Establece permisos apropiados
RUN chown -R www-data:www-data /var/www/html

# Habilita el módulo de reescritura de Apache (opcional)
RUN a2enmod rewrite
