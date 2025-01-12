# Étape 1 : Image PHP avec FPM
FROM php:8.2-fpm

# Étape 2 : Installer les dépendances
RUN apt-get update && apt-get install -y \
    zip \
    unzip \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Étape 3 : Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Étape 4 : Définir le répertoire de travail
WORKDIR /var/www

# Étape 5 : Copier le projet Laravel dans le conteneur
COPY . .

# Étape 6 : Installer les dépendances avec Composer
RUN composer install --no-dev --optimize-autoloader

# Étape 7 : Donner les permissions au dossier de stockage et cache
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Étape 8 : Exposer le port pour PHP-FPM
EXPOSE 9000

# Étape 9 : Démarrer PHP-FPM
CMD ["php-fpm"]
