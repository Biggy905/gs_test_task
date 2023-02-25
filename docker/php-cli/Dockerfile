FROM php:8.1-cli-alpine

RUN apk add --update linux-headers

# Install dependencies
RUN apk add --no-cache --update\
      autoconf g++ make \
      freetype \
      libjpeg-turbo \
      libpng \
      freetype-dev \
      libjpeg-turbo-dev \
      libpng-dev \
    && pecl install redis \
    && docker-php-ext-configure gd \
      --with-freetype=/usr/include/ \
      --with-jpeg=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-enable gd redis\
    && apk del --no-cache \
      freetype-dev \
      libjpeg-turbo-dev \
      libpng-dev

RUN apk add libzip-dev

RUN docker-php-ext-install pdo pdo_mysql zip bcmath

RUN apk add --no-cache imagemagick imagemagick-dev

RUN pecl install -o -f imagick\
    &&  docker-php-ext-enable imagick

# Copy configs
COPY ./docker/php/config /usr/local/etc/php/conf.d

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Update user
RUN apk add -U shadow

ARG user_id=1000
RUN usermod -u $user_id www-data

# Set default directory
WORKDIR /app/src
