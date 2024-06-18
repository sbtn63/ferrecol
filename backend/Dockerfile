FROM richarvey/nginx-php-fpm:1.7.2

WORKDIR /var/www/html

COPY . .

# Image config
ENV SKIP_COMPOSER 1
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1

# Laravel config
ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr

# Allow composer to run as root
ENV COMPOSER_ALLOW_SUPERUSER 1

# Actualizar Composer a la versión 2
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer && \
    php -r "unlink('composer-setup.php');" && \
    composer self-update --2

# Instalar dependencias de Composer (si composer.json existe)
RUN if [ -f "composer.json" ]; then composer install --no-dev --no-scripts --no-progress; fi

CMD ["/start.sh"]