FROM php:7.2-fpm

RUN apt-get update \
&& apt-get install -y dos2unix libmagickwand-dev --no-install-recommends\
    libwebp-dev libjpeg62-turbo-dev libpng-dev libonig-dev libxpm-dev libfreetype6-dev\
    zlib1g-dev netcat libzip-dev\
&& docker-php-ext-install pdo pdo_mysql mbstring zip\
&& pecl install imagick \
&& docker-php-ext-enable imagick\
&& docker-php-ext-configure gd --with-gd --with-webp-dir --with-jpeg-dir \
    --with-png-dir --with-zlib-dir --with-xpm-dir --with-freetype-dir\
&& docker-php-ext-install gd\
&& curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer\
&& docker-php-ext-install exif


COPY ./entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh
RUN dos2unix /entrypoint.sh && apt-get --purge remove -y dos2unix && rm -rf /var/lib/apt/lists/*
RUN chmod -R 775 /var/www/html/

ENTRYPOINT ["/entrypoint.sh"]

