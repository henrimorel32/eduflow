
# 2. Dockerfile PHP
php_dockerfile = '''FROM php:8.2-fpm-alpine

# Installation des extensions PHP nécessaires
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Installation de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configuration PHP pour le développement
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

# Création du répertoire de travail
WORKDIR /var/www/html

# Permissions
RUN chown -R www-data:www-data /var/www/html
'''

with open('/Users/henri/Documents/GitHub/ESchool/php/Dockerfile', 'w') as f:
    f.write(php_dockerfile)

print("✅ Dockerfile PHP créé")
