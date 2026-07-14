FROM php:8.3-cli

# System dependencies + PHP extensions Laravel ke liye zaroori hain
RUN apt-get update && apt-get install -y \
    git unzip libpq-dev libzip-dev libonig-dev \
    && docker-php-ext-install pdo pdo_pgsql pdo_mysql mbstring zip \
    && rm -rf /var/lib/apt/lists/*

# Composer install karna
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Project files copy karna
COPY . .

# Composer dependencies install (production mode)
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Storage aur cache folders writable banana
RUN chmod -R 777 storage bootstrap/cache

# Render start script ko executable banana
COPY start.sh /var/www/start.sh
RUN chmod +x /var/www/start.sh

EXPOSE 8000

CMD ["/var/www/start.sh"]
