FROM php:8.2-fpm

# Install dependencies
RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    librdkafka-dev \
    zlib1g-dev \
    libssl-dev \
    libonig-dev \
    libxml2-dev \
    libcurl4-openssl-dev \
    pkg-config \
    libssl-dev \
    curl \
    && docker-php-ext-install pdo_mysql zip gd bcmath \
    && pecl install rdkafka \
    && docker-php-ext-enable rdkafka \
    && rm -rf /var/lib/apt/lists/*


ADD --chmod=0755 https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

# RUN docker-php-ext-install sockets
RUN chmod +x /usr/local/bin/install-php-extensions && install-php-extensions sockets

RUN pecl install mongodb-1.21.0 && docker-php-ext-enable mongodb
# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER=1

WORKDIR /var/www/html

# Copy only composer files first (for caching)
COPY composer.json composer.lock* ./

# Install PHP dependencies
RUN composer install --no-dev --no-interaction --optimize-autoloader  || true
# COPY custom_php.ini /usr/local/etc/php/conf.d/custom_php.ini

RUN php artisan config:clear \
    && php artisan cache:clear \
    && php artisan route:clear \
    && php artisan storage:link || true

    # # Copy custom php.ini file

# RUN pecl install redis \
#     && docker-php-ext-enable redis

# RUN pecl install rdkafka \
#     && docker-php-ext-enable rdkafka
# Copy the rest of the application
COPY . .
RUN php artisan storage:link || true


# Set permissions (important for Windows dev env)
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache
# RUN echo "memory_limit=256M" > /usr/local/etc/php/conf.d/memory-limit.ini
RUN composer require laravel/sanctum
# RUN composer require php-amqplib/php-amqplib
# Expose PHP-FPM port
# RUN composer require vladimir-yuldashev/laravel-queue-rabbitmq
EXPOSE 9000

CMD ["php-fpm"]
