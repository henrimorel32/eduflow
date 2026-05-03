FROM php:8.2-fpm-alpine

# Installation des extensions PHP nécessaires
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Driver PostgreSQL pour les écoles Next.js
RUN apk add --no-cache postgresql-dev git unzip \
    && docker-php-ext-install pdo_pgsql pgsql

# Installation de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configuration PHP pour la production
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# Création du répertoire de travail
WORKDIR /var/www/html

# Copie du composer.json et installation des dépendances
COPY src/composer.json .
RUN composer install --no-dev --optimize-autoloader 2>/dev/null || true

# Permissions
RUN chown -R www-data:www-data /var/www/html
