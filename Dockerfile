# Use the official PHP 8.2 image as the base
FROM php:8.2-fpm

# Set the working directory inside the container
WORKDIR /var/www/

# Install system dependencies
RUN apt-get update && apt-get install -y \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy the composer.json and composer.lock files to the container
COPY composer.json composer.lock ./

# Install project dependencies
RUN composer install --no-scripts --no-autoloader --ignore-platform-reqs

# Copy the rest of the application code to the container
COPY . .

# Generate the autoload files
RUN composer dump-autoload --optimize

# Set permissions for Laravel storage and bootstrap cache folders
RUN chown -R www-data:www-data storage bootstrap/cache

# Set the correct permissions for the application files
RUN chmod -R 777 storage bootstrap/cache

# Expose the container port
EXPOSE 9000

# Start the PHP FPM server
CMD ["php-fpm"]
