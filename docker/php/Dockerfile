# Use the official PHP 8.3.4 FPM image
FROM php:8.3.4-fpm

# Install necessary PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mbstring json

# Install system dependencies
RUN apt-get update && apt-get install -y composer


# Install Composer
#RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set the working directory to /var/www/html
WORKDIR /var/www/html

# Copy the htmllication files into the Docker image
COPY . /var/www/html

# Install the htmllication dependencies
RUN composer install --no-dev --optimize-autoloader

# Expose the port that the FPM server will listen on
EXPOSE 9000

# Start the PHP-FPM server
CMD ["php", "artisan", "serve"]