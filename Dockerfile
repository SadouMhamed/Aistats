FROM php:8.2-apache

# Installer dépendances système
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev zip libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql zip

# Activer mod_rewrite pour Laravel
RUN a2enmod rewrite

# Copier Composer depuis l'image officielle
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copier tous les fichiers Laravel dans le container
COPY . /var/www/html

# Copier la configuration Apache personnalisée
COPY apache.conf /etc/apache2/sites-available/000-default.conf

# Définir le bon dossier de travail
WORKDIR /var/www/html

# Installer les dépendances Laravel automatiquement
RUN composer install --no-dev --optimize-autoloader

# Donner les bons droits à Apache
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html

# Exposer le port
EXPOSE 80
