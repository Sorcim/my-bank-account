# Stage 1 : Build Stage
FROM php:8.2-fpm-alpine AS build

# Installe les dépendances nécessaires pour Laravel
RUN apk add --no-cache \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    oniguruma-dev \
    bash \
    shadow \
    icu-dev \
    g++ \
    make \
    autoconf \
    openssl-dev \
    nodejs \
    npm


# Configuration des extensions PHP nécessaires
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd intl mbstring pdo pdo_mysql opcache
RUN pecl install redis && docker-php-ext-enable redis

# Installe Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copie les fichiers du projet Laravel
WORKDIR /var/www
COPY . .

# Installe les dépendances PHP
RUN composer install --optimize-autoloader --no-dev \
    && npm install \
    && npm run build  # Compile les assets front-end (Vite/Webpack)\

# Stage 2 : Production Image
FROM php:8.2-fpm-alpine

# Installe les dépendances nécessaires uniquement pour l'exécution
RUN apk add --no-cache \
    curl \
    libpng \
    libjpeg-turbo \
    freetype \
    oniguruma \
    icu \
    openssl

# Copie l'intégralité du projet depuis le build
WORKDIR /var/www
COPY --from=build /var/www /var/www

# Configuration utilisateur
RUN addgroup -g 82 -S www-data \
    && adduser -u 82 -D -S -G www-data www-data \
    && chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage /var/www/bootstrap/cache

# Expose le port pour PHP-FPM
EXPOSE 9000

CMD ["php-fpm"]
