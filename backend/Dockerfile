FROM php:8.1-apache                             

RUN apt-get update && apt-get install -y \
    libpq-dev \
    gnupg \
    unzip \
    zip \
    libzip-dev \
    && docker-php-ext-install pdo pdo_pgsql

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN a2enmod rewrite

RUN sed -i 's/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

COPY . /var/www/html/
 
EXPOSE 80

