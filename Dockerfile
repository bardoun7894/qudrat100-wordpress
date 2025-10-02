# Production Dockerfile for WordPress with Custom Quiz Application
FROM wordpress:6.7.1-php8.2-apache

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    curl \
    wget \
    nano \
    && docker-php-ext-install mysqli pdo pdo_mysql zip \
    && rm -rf /var/lib/apt/lists/*

# Enable Apache modules for production
RUN a2enmod rewrite ssl headers expires deflate

# Set working directory
WORKDIR /var/www/html

# Copy custom application files
COPY . /var/www/html/

# Copy custom Apache configuration
COPY docker/apache-config.conf /etc/apache2/sites-available/000-default.conf

# Create necessary directories
RUN mkdir -p /var/www/html/uploads/questions \
    && mkdir -p /var/www/html/wp-content/uploads

# Set proper permissions for WordPress and custom app
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 775 /var/www/html/uploads \
    && chmod -R 775 /var/www/html/wp-content/uploads

# Security: Remove sensitive files in production
RUN rm -f /var/www/html/wp-config-sample.php \
    && rm -f /var/www/html/readme.html \
    && rm -f /var/www/html/license.txt

# Health check
HEALTHCHECK --interval=30s --timeout=10s --start-period=5s --retries=3 \
    CMD curl -f http://localhost/ || exit 1

# Expose port 80 and 443
EXPOSE 80 443
