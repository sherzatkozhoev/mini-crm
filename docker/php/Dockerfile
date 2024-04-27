FROM php:8.3-fpm-alpine3.18

RUN apk add --no-cache --update \
  bzip2-dev \
  enchant2-dev \
  gmp-dev \
  imap-dev \
  icu-dev \
  openldap-dev \
  freetds-dev \
  libxml2-dev \
  tidyhtml-dev  \
  libxslt-dev \
  libzip-dev \
  musl-dev \
  jpeg-dev \
  libpng-dev \
  oniguruma-dev \
  freetype  \
  libpng  \
  libpq-dev \
  libjpeg-turbo  \
  freetype-dev  \
  libjpeg-turbo-dev \
  libmcrypt-dev \
  bash \
  openrc
  #supervisor

RUN docker-php-ext-configure intl --enable-intl
RUN docker-php-ext-configure gd --with-freetype --with-jpeg

RUN docker-php-ext-install -j$(nproc) gd \
    pdo \
    mysqli  \
    pdo_mysql  \
    pdo_pgsql  \
    intl  \
    mbstring  \
    zip  \
    pcntl \
    exif  \
    opcache \
    soap \
    && docker-php-source delete

#Installing composer
RUN curl -sS https://getcomposer.org/installer -o composer-setup.php
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN rm -rf composer-setup.php

#Installing redis
RUN apk add --no-cache pcre-dev $PHPIZE_DEPS \
        && pecl install redis \
        && docker-php-ext-enable redis.so

RUN rm -rf /tmp/* /var/cache/apk/*

WORKDIR /var/www/project

ARG docker_user
ENV user=${docker_user}

RUN adduser -D -u 1000 ${user}
RUN addgroup ${user} www-data

RUN chown -R www-data:www-data /var/www/

RUN chmod 777 -R /tmp && chmod o+t -R /tmp
RUN chmod 777 -R /var/log && chmod o+t -R /var/log
RUN chmod 777 -R /var/run && chmod o+t -R /var/run

RUN mv /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini

COPY ./conf.d /usr/local/etc/php/conf.d

USER ${user}