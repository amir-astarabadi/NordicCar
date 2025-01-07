FROM php:8.2-fpm-alpine AS nordic-fpm-base

RUN deluser www-data && \
    addgroup -g 1000 www-data && \
    adduser -u 1000 -G www-data -g 'PHP Fpm and Nginx User' -s /bin/sh -h /var/www/html -H -D www-data

ADD --chmod=0755 https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN install-php-extensions \
    @composer apcu bcmath bz2 calendar exif ffi gd gettext igbinary imagick intl mongodb mysqli pcntl pdo_mysql \
    redis shmop soap sockets sysvmsg sysvsem sysvshm xsl zip opcache


FROM nordic-fpm-base

# required for executing schema dump and mysql commands written inside exec() function in the migration files
RUN apk add --no-cache mariadb-client mariadb-connector-c

RUN install-php-extensions xdebug

COPY 99-php.ini /usr/local/etc/php/conf.d/99-php.ini
COPY 99-xdebug.ini /usr/local/etc/php/conf.d/99-xdebug.ini
