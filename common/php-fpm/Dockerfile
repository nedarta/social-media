FROM php:7.4.13-fpm
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"
#RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
RUN apt-get update && apt-get install -y libpq-dev libsqlite3-dev zlib1g-dev libzip-dev libpng-dev libfreetype6-dev libjpeg62-turbo-dev
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install zip pdo pdo_mysql pdo_pgsql pdo_sqlite gd
RUN  echo "setting socket" \
     && sed -ri 's/(^daemonize\s*=\s*).*$/\1on/' /usr/local/etc/php-fpm.d/www.conf \
     #&& sed -ri 's/(^daemonize\s*=\s*).*$/\1on/' /usr/local/etc/php-fpm.d/zz-docker.conf \
     #&& sed -ri 's|(^listen\s*=\s*).*$|\1/var/run/php-fpm.sock|' /usr/local/etc/php-fpm.d/www.conf \
     && sed -ri 's|(^listen\s*=\s*).*$|\1/socket/php-fpm.sock|' /usr/local/etc/php-fpm.d/zz-docker.conf \
     && sed -ri 's|^;(listen\.mode\s*=\s*).*$|\10666|' /usr/local/etc/php-fpm.d/www.conf
