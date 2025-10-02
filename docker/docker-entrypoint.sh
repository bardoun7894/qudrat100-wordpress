#!/bin/bash
set -euo pipefail

# Function to wait for MySQL to be ready
wait_for_mysql() {
    echo "Waiting for MySQL to be ready..."
    while ! mysqladmin ping -h"$WORDPRESS_DB_HOST" --silent; do
        sleep 1
    done
    echo "MySQL is ready!"
}

# Function to setup WordPress if not already installed
setup_wordpress() {
    if [ ! -f /var/www/html/wp-config.php ]; then
        echo "Setting up WordPress..."
        
        # Copy wp-config.php from our custom location
        if [ -f /usr/src/wordpress/wp-config.php ]; then
            cp /usr/src/wordpress/wp-config.php /var/www/html/
        fi
        
        # Download WordPress core if not present
        if [ ! -f /var/www/html/wp-load.php ]; then
            echo "Downloading WordPress core..."
            wp core download --allow-root --path=/var/www/html
        fi
        
        # Wait for database
        wait_for_mysql
        
        # Install WordPress if not already installed
        if ! wp core is-installed --allow-root --path=/var/www/html 2>/dev/null; then
            echo "Installing WordPress..."
            wp core install \
                --allow-root \
                --path=/var/www/html \
                --url="${WORDPRESS_URL:-http://localhost}" \
                --title="${WORDPRESS_TITLE:-Qudrat100}" \
                --admin_user="${WORDPRESS_ADMIN_USER:-admin}" \
                --admin_password="${WORDPRESS_ADMIN_PASSWORD:-admin123}" \
                --admin_email="${WORDPRESS_ADMIN_EMAIL:-admin@example.com}" \
                --skip-email
        fi
    fi
}

# Function to copy custom theme and plugins
copy_custom_content() {
    echo "Copying custom theme and plugins..."
    
    # Create wp-content directories if they don't exist
    mkdir -p /var/www/html/wp-content/themes
    mkdir -p /var/www/html/wp-content/plugins
    mkdir -p /var/www/html/wp-content/uploads
    
    # Copy custom theme if it exists in the source
    if [ -d /usr/src/wordpress/wp-content/themes/custom-theme ]; then
        cp -r /usr/src/wordpress/wp-content/themes/custom-theme /var/www/html/wp-content/themes/
    fi
    
    # Copy plugins if they exist
    if [ -d /usr/src/wordpress/wp-content/plugins ]; then
        cp -r /usr/src/wordpress/wp-content/plugins/* /var/www/html/wp-content/plugins/ 2>/dev/null || true
    fi
    
    # Copy uploads if they exist
    if [ -d /usr/src/wordpress/wp-content/uploads ]; then
        cp -r /usr/src/wordpress/wp-content/uploads/* /var/www/html/wp-content/uploads/ 2>/dev/null || true
    fi
}

# Function to copy quiz application files
copy_quiz_files() {
    echo "Copying quiz application files..."
    
    # Copy quiz files to document root
    if [ -f /usr/src/wordpress/quiz.php ]; then
        cp /usr/src/wordpress/quiz.php /var/www/html/
    fi
    
    if [ -f /usr/src/wordpress/admin.php ]; then
        cp /usr/src/wordpress/admin.php /var/www/html/
    fi
    
    if [ -f /usr/src/wordpress/demo.php ]; then
        cp /usr/src/wordpress/demo.php /var/www/html/
    fi
    
    # Copy includes directory
    if [ -d /usr/src/wordpress/includes ]; then
        cp -r /usr/src/wordpress/includes /var/www/html/
    fi
    
    # Copy API directory
    if [ -d /usr/src/wordpress/api ]; then
        cp -r /usr/src/wordpress/api /var/www/html/
    fi
    
    # Copy assets directory
    if [ -d /usr/src/wordpress/assets ]; then
        cp -r /usr/src/wordpress/assets /var/www/html/
    fi
    
    # Create uploads/questions directory for quiz images
    mkdir -p /var/www/html/uploads/questions
}

# Function to set proper permissions
set_permissions() {
    echo "Setting proper permissions..."
    
    # Set ownership
    chown -R www-data:www-data /var/www/html
    
    # Set directory permissions
    find /var/www/html -type d -exec chmod 755 {} \;
    
    # Set file permissions
    find /var/www/html -type f -exec chmod 644 {} \;
    
    # Make wp-config.php readable only by owner
    if [ -f /var/www/html/wp-config.php ]; then
        chmod 600 /var/www/html/wp-config.php
    fi
    
    # Set special permissions for uploads
    chmod -R 755 /var/www/html/wp-content/uploads
    chmod -R 755 /var/www/html/uploads 2>/dev/null || true
}

# Function to activate theme and plugins
activate_wordpress_components() {
    if wp core is-installed --allow-root --path=/var/www/html 2>/dev/null; then
        echo "Activating WordPress components..."
        
        # Activate custom theme if it exists
        if [ -d /var/www/html/wp-content/themes/custom-theme ]; then
            wp theme activate custom-theme --allow-root --path=/var/www/html || true
        fi
        
        # Activate plugins
        wp plugin activate akismet --allow-root --path=/var/www/html || true
        wp plugin activate all-in-one-wp-migration --allow-root --path=/var/www/html || true
        
        # Update permalink structure
        wp rewrite structure '/%postname%/' --allow-root --path=/var/www/html || true
        wp rewrite flush --allow-root --path=/var/www/html || true
    fi
}

# Main execution
echo "Starting WordPress Docker container..."

# Install WP-CLI if not present
if ! command -v wp &> /dev/null; then
    echo "Installing WP-CLI..."
    curl -O https://raw.githubusercontent.com/wp-cli/wp-cli/v2.8.1/utils/wp-cli.phar
    chmod +x wp-cli.phar
    mv wp-cli.phar /usr/local/bin/wp
fi

# Wait for MySQL to be ready
wait_for_mysql

# Setup WordPress
setup_wordpress

# Copy custom content
copy_custom_content

# Copy quiz application files
copy_quiz_files

# Set proper permissions
set_permissions

# Activate WordPress components
activate_wordpress_components

echo "WordPress setup complete!"

# Start Apache
exec "$@"