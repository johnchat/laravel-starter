# This container should be used for any/all CLI processes
# including cron, queues, etc.
FROM realpage/php:7.1-alpine
LABEL application="laravel" \
      com.realpage.php.version="7.1" \
      com.realpage.php.type="cli"

# Copy the application files to the container
ADD . /var/www/html

WORKDIR /var/www/html

# fix permissions in CI
RUN sed -ri 's/^www-data:x:82:82:/www-data:x:1000:1000:/' /etc/passwd \
    && sed -ri 's/^www-data:x:82:/www-data:x:1000:/' /etc/group

# Ownership of the app dir for www-data
RUN chown -R www-data:www-data /var/www/html

# Put php artisan schedule:run in a crontab
RUN echo "*       *       *       *       *       php /var/www/html/artisan schedule:run" > /etc/crontabs/www-data

# Run composer as www-data
USER www-data

# Make sure when users get into the container they aren't root
USER www-data
