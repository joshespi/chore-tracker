FROM php:8.4-apache

# Install system dependencies and PHP extensions
RUN apt-get update && \
    apt-get install -y git unzip libzip-dev && \
    docker-php-ext-install pdo pdo_mysql && \
    docker-php-ext-install zip


# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set the working directory
WORKDIR /var/www/html

# Copy custom php.ini configuration
COPY ./php.ini /usr/local/etc/php/

# Copy in Composer config
COPY src/composer.json ./
COPY src/composer.lock ./

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer install

# Expose port 80
EXPOSE 80

# Start the Apache server
CMD ["apache2-foreground"]