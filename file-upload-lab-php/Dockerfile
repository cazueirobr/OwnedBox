FROM php:8.2-apache

WORKDIR /var/www/html

COPY index.php /var/www/html/index.php
COPY entrypoint.sh /usr/local/bin/lab-entrypoint

RUN mkdir -p /var/www/html/uploads \
    && chown -R www-data:www-data /var/www/html/uploads \
    && chmod -R 755 /var/www/html/uploads \
    && chmod +x /usr/local/bin/lab-entrypoint

EXPOSE 80

ENTRYPOINT ["lab-entrypoint"]
