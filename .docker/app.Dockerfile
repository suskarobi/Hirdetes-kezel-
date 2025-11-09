FROM php:8.1-apache-bullseye

# Arguments defined in docker-compose.yml
ARG user
ARG uid

# Install system dependencies
RUN apt-get update
RUN apt-get install -y curl libpng-dev libonig-dev libxml2-dev libzip-dev zip unzip libxslt-dev \
    bwm-ng htop nano mc wget rsync watch net-tools aptitude locales npm libz-dev libgd-dev \
    screen iputils-ping nmap supervisor redis-server \
    libwebp-dev

# Apache enable mods
RUN a2enmod rewrite headers expires deflate actions alias include

# Setup locale
RUN locale-gen hu_HU.UTF-8

# Pecl packages
RUN pecl install xdebug \
    inotify

RUN docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg --with-webp
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Installing php extensions on docker
RUN docker-php-ext-install pdo_mysql \
    && docker-php-ext-install mysqli \
    && docker-php-ext-install mbstring \
    && docker-php-ext-install zip \
    && docker-php-ext-install xsl \
    && docker-php-ext-install pcntl \
    && docker-php-ext-install exif

# Enabling php extensions
RUN docker-php-ext-enable mysqli \
    xsl \
    inotify \
    exif

# Installing and configuring imagick
RUN apt-get update && apt-get install -y \
    libmagickwand-dev --no-install-recommends \
    && pecl install imagick \
	&& docker-php-ext-enable imagick

RUN apt-get -y update \
    && apt-get install -y libicu-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl \
    && docker-php-ext-install bcmath

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN mkdir -p /home/$user/.composer
# COPY .docker/composer-auth.json /home/$user/.composer/auth.json
# COPY .docker/composer-auth.json /root/.composer/auth.json
RUN chown -R $user:$user /home/$user

# using composer v2 latest stable
RUN composer self-update --2

COPY .docker/worker.conf /etc/supervisor/conf.d/worker.conf

# php.ini
COPY .docker/php.ini /usr/local/etc/php/php.ini

# vhost
RUN a2dissite 000-default.conf
RUN rm /etc/apache2/sites-available/000-default.conf
COPY .docker/site.conf /etc/apache2/sites-available/000-default.conf
RUN a2ensite 000-default.conf

# npm packages
RUN npm cache clean -f
RUN npm install -g n
RUN npm install -g npm@10.1.0
RUN n stable

# permissions
RUN mkdir -p /var/www/html/bootstrap/cache /var/www/html/storage
RUN chown -R www-data:www-data /var/www/html/
RUN chmod -R o+rw /var/www/html/bootstrap/cache /var/www/html/storage

# enable apache logging
RUN rm /var/log/apache2/access.log
RUN rm /var/log/apache2/error.log
RUN service apache2 restart

# Set working directory
WORKDIR /var/www/html/

USER $user

COPY .docker/app-entrypoint.sh /docker-entrypoint.sh
RUN chmod +x /docker-entrypoint.sh
ENTRYPOINT ["/docker-entrypoint.sh"]
