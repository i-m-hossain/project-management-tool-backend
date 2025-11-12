FROM composer:latest AS composer

FROM php:8.3-fpm 

# RUN apt-get update && apt-get install \
#     libpng-dev libjpeg-dev libzip-dev unzip git libfreetype6-dev \
#     && docker-php-ext-configure gd --with-freetype --with-jpeg \
#     && docker-php-ext-install gd pdo pdo_mysql zip \
#     && apt-get clean && rm -rf /var/lib/apt/lists/*

# RUN apt-get update && apt-get install -y \
# 		libfreetype-dev \
# 		libjpeg62-turbo-dev \
# 		libpng-dev \
# 	&& docker-php-ext-configure gd --with-freetype --with-jpeg \
# 	&& docker-php-ext-install -j$(nproc) gd 

RUN apt-get update && apt-get install -y \
        git \
        libfreetype-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_mysql \
    && rm -rf /var/lib/apt/lists/*



RUN pecl install redis xdebug && docker-php-ext-enable redis xdebug

COPY --from=composer /usr/bin/composer /usr/local/bin/composer

WORKDIR /var/www/html


COPY . .

# Install Composer dependencies
RUN composer install --no-dev

# RUN chown -R www-data:www-data /var/www/html \
#     && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache



# Expose port 9000 for PHP-FPM
EXPOSE 9000

# USER www-data 
# Start PHP-FPM
CMD ["php-fpm"]

