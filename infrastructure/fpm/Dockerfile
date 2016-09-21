FROM realpage/php:7.0-fpm
LABEL application="laravel" \
      com.realpage.php.version="7.0" \
      com.realpage.php.type="fpm"

# Copy the application files to the container
ADD . /var/www/html

WORKDIR /var/www/html

# Install Composer dependencies
RUN apt-get update
RUN apt-get install -y git zip unzip
RUN rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Install Composer
RUN php /var/www/html/infrastructure/install_composer.php

# Manually create a directory for the 'composer global' install.
# ~www-data = /var/www, which is owned by root.
RUN mkdir ~www-data/.composer

# Ownership of the app dir for www-data
RUN chown -R www-data:www-data /var/www/html ~www-data/.composer

# Run composer as www-data
USER www-data

# parallel dependency installation
RUN composer global require hirak/prestissimo

# production-ready dependencies
RUN composer install --no-interaction --optimize-autoloader --no-dev --prefer-dist

# Switch back to root
USER root

# Remove composer installation dependencies
RUN apt-get remove -y git zip unzip
