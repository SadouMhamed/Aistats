FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev zip libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql zip

RUN a2enmod rewrite

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copier tout le projet Laravel
COPY . /var/www/html

# Surcharger la configuration Apache pour pointer vers /public
COPY apache.conf /etc/apache2/sites-available/000-default.conf

# Donner les bons droits à Apache
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html

WORKDIR /var/www/html

EXPOSE 80
