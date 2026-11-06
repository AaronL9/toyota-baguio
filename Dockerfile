###################################################
################  BACKEND STAGES  #################
###################################################

###################################################
# Stage: Development
#
# This stage is intended to be the final "development" image. It sets up the
# backend and and run the dev server
###################################################

# Use official PHP CLI image
FROM php:8.3.6-cli AS backend-dev

WORKDIR /var/www/html

# Install system dependencies, PHP extensions, then clean up in one layer
RUN apt-get update && apt-get install -y \
    unzip git zip libzip-dev libicu-dev libonig-dev && \
    docker-php-ext-install intl mbstring zip mysqli pcntl

# Install Composer
COPY --from=composer:lts /usr/bin/composer /usr/bin/composer

# Copy composer files first (better caching)
COPY composer.json composer.lock ./

# Install PHP dependencies
RUN composer install --no-interaction

# Copy app files with correct ownership
COPY . .

# EXPOSE 8080

###################################################
# Stage: final
#
# This stage is intended to be the final "production" image. It sets up the
# backend and copies the built client application from the client-build stage.
###################################################
FROM backend-dev AS backend-build
WORKDIR /var/www/html
RUN composer install --no-dev --no-interaction
 
# CMD ["php", "spark", "serve", "--host", "0.0.0.0", "--port", "8081"]