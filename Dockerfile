# Use the official PHP-FPM image as a base
FROM php:8.1-fpm-alpine

# Install WordPress dependencies
RUN apk add --no-cache \
    mysql-client \
    curl \
    libzip-dev \
    libpng-dev \
    jpeg-dev \
    git \
    autoconf \
    g++ \
    make

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql zip gd

# Set working directory
WORKDIR /var/www/html

# Copy WordPress files
COPY . /var/www/html

# Expose port 9000 for PHP-FPM
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]