FROM php:7.4-apache

# Installation des extensions et outils nécessaires
RUN apt-get update && \
    apt-get install -y libzip-dev zip unzip git && \
    docker-php-ext-install zip pdo pdo_mysql

# Installation de Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"

# Copie de l'application dans le conteneur
COPY . /var/www/html/

# Installation des dépendances PHP
RUN composer install --no-dev --working-dir=/var/www/html

EXPOSE 80
