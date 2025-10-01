FROM wordpress:latest

# Copy the custom theme and plugins to the container
COPY ./wp-content/themes/ /var/www/html/wp-content/themes/
COPY ./wp-content/plugins/ /var/www/html/wp-content/plugins/

# Copy the custom PHP files
COPY ./demo.php /var/www/html/demo.php
COPY ./quiz.php /var/www/html/quiz.php
COPY ./admin.php /var/www/html/admin.php
COPY ./api/ /var/www/html/api/
COPY ./includes/ /var/www/html/includes/

# Set the permissions of the files
RUN chown -R www-data:www-data /var/www/html/
