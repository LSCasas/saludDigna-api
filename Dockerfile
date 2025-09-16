FROM php:8.2-apache

# Install dependencies and extensions
RUN apt-get update && apt-get install -y unzip git libzip-dev zip libpq-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql pgsql zip


# Enable mod_rewrite
RUN a2enmod rewrite

# Configure ServerName to remove warning
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Copy code to the container
COPY . /var/www/html

# Change Apache DocumentRoot to /var/www/html/public
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Set permissions for storage and cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --working-dir=/var/www/html

# Expose port 80
EXPOSE 80

# Run Apache in the foreground
CMD ["apache2-foreground"]

