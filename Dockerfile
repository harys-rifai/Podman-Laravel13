FROM php:8.3-cli

# Install dependencies
RUN apt-get update && apt-get install -y \
    unzip git libpq-dev nodejs npm \
    && docker-php-ext-install pdo pdo_pgsql \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html/nextwave

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=808"]
