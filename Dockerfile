# Production Dockerfile for WordPress on Ubuntu Server
FROM wordpress:6.7.1-php8.2-apache

# Install required PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache modules
RUN a2enmod rewrite

# Set working directory to /var/www/public_html
WORKDIR /var/www/public_html

# Configure Apache to use /var/www/public_html
RUN sed -i 's|/var/www/html|/var/www/public_html|g' /etc/apache2/sites-available/000-default.conf && \
    sed -i 's|/var/www/html|/var/www/public_html|g' /etc/apache2/apache2.conf

# Set proper permissions
RUN chown -R www-data:www-data /var/www/public_html
