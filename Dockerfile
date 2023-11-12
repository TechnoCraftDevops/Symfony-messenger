FROM php:8.2.6-apache

# user args
ARG USERNAME=app
ARG USER_UID=1000
ARG USER_GID=$USER_UID

# create non root user
RUN groupadd --gid $USER_GID $USERNAME \
    && useradd --uid $USER_UID --gid $USER_GID -m $USERNAME

# enable rewrite on apâche2
RUN a2enmod rewrite

# install tools
RUN apt-get update -qq && \
    apt-get install -qy \
    git \
    gnupg \
    libicu-dev \
    libzip-dev \
    unzip \
    zip \
    zlib1g-dev

# install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer  
ENV COMPOSER_ALLOW_SUPERUSER=1

# install php dependency
RUN docker-php-ext-configure zip && \
    docker-php-ext-install -j$(nproc) intl opcache mysqli pdo pdo_mysql zip

# php & apache config
COPY ./apache_config/micro-service.conf /etc/apache2/sites-enabled/000-default.conf
COPY ./apache_php_config/php.ini /usr/local/etc/php/conf.d/app.ini

# copy project
COPY ./bin /var/www/html/bin
COPY ./config /var/www/html/config
COPY ./public /var/www/html/public
COPY ./src /var/www/html/src
# COPY ./templates /var/www/html/templates
COPY ./composer.json /var/www/html
COPY ./composer.lock /var/www/html

WORKDIR /var/www/html

RUN composer install --no-scripts

EXPOSE 80

USER $USERNAME

CMD ["apache2-foreground"]
