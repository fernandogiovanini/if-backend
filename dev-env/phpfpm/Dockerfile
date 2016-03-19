FROM php:7.0-fpm

MAINTAINER Fernando Giovanini <fernando@bdata.it>

# Install PHP extensions dependencies
RUN apt-get update;

# Install zip, curl, zlib, PDO MySQL, git
RUN apt-get install -y libmcrypt-dev \
                      libcurl4-gnutls-dev \
                      zlib1g-dev \
                      git \
                      && docker-php-ext-install mcrypt \
                      && docker-php-ext-install curl \
                      && docker-php-ext-install zip \
                      && docker-php-ext-install pdo_mysql;

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Symfony3
RUN curl -LsS https://symfony.com/installer -o /usr/local/bin/symfony && chmod a+x /usr/local/bin/symfony

