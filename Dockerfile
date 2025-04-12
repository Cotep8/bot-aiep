FROM php:8.4.0RC1-apache-slim
COPY . /var/www/html/
RUN docker-php-ext-install curl
EXPOSE 80
