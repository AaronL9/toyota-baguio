
###################################################
################  BACKEND STAGES  #################
###################################################

FROM php:8.3.6-cli AS backend-dev

WORKDIR /var/www/html

# Host user and group IDs
ARG HOST_UID=1000
ARG HOST_GID=1000

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    zip \
    libzip-dev \
    libicu-dev \
    libonig-dev \
    && docker-php-ext-install intl mbstring zip mysqli pcntl \
    && rm -rf /var/lib/apt/lists/*

# Create application user matching the host UID/GID
RUN groupadd --non-unique --gid ${HOST_GID} app \
    && useradd --non-unique --uid ${HOST_UID} \
       --gid ${HOST_GID} \
       --create-home \
       --shell /bin/bash app

# Install Composer
COPY --from=composer:lts /usr/bin/composer /usr/bin/composer

# Copy Composer files with correct ownership
COPY --chown=app:app composer.json composer.lock ./

# Run Composer as application user
USER app

RUN composer install --no-interaction

# Copy application files with correct ownership
COPY --chown=app:app . .

###################################################
################  BACKEND BUILD  ##################
###################################################

FROM backend-dev AS backend-build

WORKDIR /var/www/html

RUN composer install --no-dev --no-interaction
