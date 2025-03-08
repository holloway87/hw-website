FROM php:8.4-apache

ARG WWW_DATA_USER_ID

COPY --from=composer /usr/bin/composer /usr/local/bin/composer

# install needed software

RUN apt-get update

# PHP extensions

RUN apt-get install -y \
        libfreetype-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

RUN apt-get install -y \
        libicu-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl

RUN apt-get install -y \
        zlib1g-dev \
        libzip-dev \
    && docker-php-ext-install zip

# php configuration

RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini" \
    && echo "memory_limit = 512M" > "$PHP_INI_DIR/conf.d/memory.ini" \
    && echo "date.timezone = Europe/Berlin" > "$PHP_INI_DIR/conf.d/timezone.ini" \
    && echo "upload_max_filesize = 50M" > "$PHP_INI_DIR/conf.d/file-upload.ini" \
    && echo "post_max_size = 50M" >> "$PHP_INI_DIR/conf.d/file-upload.ini"

ENV WEB_DOCUMENT_ROOT /var/www/html

RUN sed -ri -e 's!/var/www/html!${WEB_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${WEB_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

RUN usermod -u $WWW_DATA_USER_ID www-data \
    && chsh -s /bin/bash www-data
RUN a2enmod rewrite

EXPOSE 80
