FROM php:8.0-apache

# Instala dependencias para o PHP, Postgres, ICU e outros
RUN apt update \
        && apt install -y \
            g++ \
            libicu-dev \
            libpq-dev \
            libzip-dev \
            zip \
            zlib1g-dev \
        && docker-php-ext-install \
            intl \
            opcache \
            pdo \
            pdo_pgsql \
            pgsql

WORKDIR /var/www/teste-tecnico-giovani-kill

# Baixa e instala o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Ativa o módulo rewrite do apache
RUN a2enmod rewrite | service apache2 restart