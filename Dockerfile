FROM php:8.2-apache

# Installer les extensions nécessaires
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git curl libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql zip

# Activer mod_rewrite pour Apache
RUN a2enmod rewrite

# Copier les fichiers du projet
COPY . /var/www/html

# Définir les permissions
RUN chown -R www-data:www-data /var/www/html

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Aller dans le dossier de l'application
WORKDIR /var/www/html

# Exposer le port
EXPOSE 80
