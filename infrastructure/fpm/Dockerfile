FROM realpage/php:7.1-fpm-alpine
LABEL application="laravel" \
      com.realpage.php.version="7.1" \
      com.realpage.php.type="fpm"

# Copy the application files to the container
ADD . /var/www/html

WORKDIR /var/www/html

# fix permissions in CI
RUN sed -ri 's/^www-data:x:82:82:/www-data:x:1000:1000:/' /etc/passwd \
    && sed -ri 's/^www-data:x:82:/www-data:x:1000:/' /etc/group

# Ownership of the app dir for www-data
RUN chown -R www-data:www-data /var/www/html

# Run composer as www-data
USER www-data