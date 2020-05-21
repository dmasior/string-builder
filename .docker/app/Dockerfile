FROM php:7.4-fpm

ENV APP_DIR=/php/src/string-builder

RUN apt update && apt install -y \
    git \
    libicu-dev

RUN docker-php-ext-configure intl \
    && docker-php-ext-install intl

COPY .docker/app/php.ini $PHP_INI_DIR/conf.d/

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add group and user to avoid read/write permission issues
ENV USER_ID=1000
ENV GROUP_ID=1000

RUN groupadd --gid $GROUP_ID app \
    && useradd --create-home \
    --home-dir /home/app \
    --shell /bin/bash \
    --uid $USER_ID \
    --gid $GROUP_ID \
    app

WORKDIR $APP_DIR

COPY . .

# Using USER directive before WORKDIR would not create app directory belonging to user so we must change owner here
RUN chown -R $USER_ID:$GROUP_ID $APP_DIR

USER app
