
Copiar código
FROM php:8.1-fpm

# Instalar extensiones necesarias
RUN apt-get update && apt-get install -y \
    nginx \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Configurar Nginx
RUN rm /etc/nginx/sites-available/default
COPY conf/nginx/nginx.site.config /etc/nginx/sites-available/default

WORKDIR /var/www/html

COPY . .

# Configurar permisos y propiedad
RUN chown -R www-data:www-data /var/www/html

# Instalar Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer && \
    php -r "unlink('composer-setup.php');"

# Instalar dependencias de Composer (si composer.json existe)
RUN if [ -f "composer.json" ]; then composer install --no-dev --no-scripts --no-progress; fi

# Copiar configuración de PHP-FPM
COPY conf/php-fpm.conf /usr/local/etc/php-fpm.d/zzz-custom.conf

CMD ["php-fpm"]