#
# STAGE 1: Build PHP dependencies with Composer
#
FROM composer:2 as vendor

WORKDIR /app

# Copy only the files needed to install dependencies
COPY database/ database/
COPY composer.json composer.json
COPY composer.lock composer.lock

# Install production dependencies
RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist \
    --no-dev


#
# STAGE 2: Build Node.js frontend assets
#
FROM node:18-alpine as frontend

WORKDIR /app

# Copy only the files needed to build assets
COPY package.json package.json
COPY package-lock.json package-lock.json
COPY vite.config.js vite.config.js
COPY tailwind.config.js tailwind.config.js
COPY postcss.config.js postcss.config.js
COPY resources/ resources/

# Install dependencies and build assets
RUN npm ci && npm run build


#
# STAGE 3: Create the final PHP-FPM production image
#
FROM php:8.2-fpm-alpine

WORKDIR /var/www/html

# Install system dependencies and PHP extensions required for Laravel
RUN apk add --no-cache \
        libpng-dev \
        libzip-dev \
        jpeg-dev \
        freetype-dev \
        oniguruma-dev \
        postgresql-dev \
        libxml2-dev \
        curl-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        gd \
        zip \
        pdo_mysql \
        pdo_pgsql \
        exif \
        pcntl \
        bcmath \
        opcache \
        intl \
        mbstring \
        xml \
        curl \
    && apk del --no-cache libpng-dev libzip-dev jpeg-dev freetype-dev

# Install Redis extension
RUN apk add --no-cache pcre-dev $PHPIZE_DEPS \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && apk del pcre-dev $PHPIZE_DEPS

# Configure PHP-FPM for production
RUN { \
    echo 'opcache.enable=1'; \
    echo 'opcache.memory_consumption=128'; \
    echo 'opcache.interned_strings_buffer=8'; \
    echo 'opcache.max_accelerated_files=10000'; \
    echo 'opcache.revalidate_freq=2'; \
    echo 'opcache.fast_shutdown=1'; \
    } > /usr/local/etc/php/conf.d/opcache-recommended.ini

# Configure PHP for production
RUN { \
    echo 'upload_max_filesize=10M'; \
    echo 'post_max_size=10M'; \
    echo 'memory_limit=256M'; \
    echo 'max_execution_time=300'; \
    echo 'date.timezone=UTC'; \
    } > /usr/local/etc/php/conf.d/laravel.ini

# Copy application code
COPY --chown=www-data:www-data . /var/www/html

# Copy vendor dependencies from the 'vendor' stage
COPY --from=vendor --chown=www-data:www-data /app/vendor/ ./vendor/

# Copy frontend assets from the 'frontend' stage
COPY --from=frontend --chown=www-data:www-data /app/public/build ./public/build/

# Set correct permissions for storage and bootstrap cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Expose PHP-FPM port
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]
