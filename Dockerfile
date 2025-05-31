# Dockerfile
FROM php:8.4-cli

# Systempakete installieren
RUN apt-get update && apt-get install -y \
    git unzip curl libpng-dev libonig-dev libxml2-dev zip libzip-dev libicu-dev \
    && docker-php-ext-install pdo pdo_mysql zip intl

# Composer installieren
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]