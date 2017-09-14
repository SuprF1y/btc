FROM php:7.1-fpm
RUN apt-get update -y && apt-get install -y zip unzip zlib1g-dev git
RUN docker-php-ext-install zip mbstring

#composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer


# xdebug
RUN pecl install xdebug
COPY ./xdebug.ini /usr/local/etc/php/conf.d/

#user
COPY ./.bashrc /root
RUN groupadd -g 1001 bigtincan
RUN useradd -u 1001 -g 1001 -G sudo bigtincan
RUN mkdir /home/bigtincan
RUN chown bigtincan:bigtincan /home/bigtincan


##bigtincan homedir
USER bigtincan
ENV PATH "${PATH}:/home/bigtincan/.composer/vendor/bin"
RUN mkdir /home/bigtincan/app
RUN mkdir /home/bigtincan/.composer


USER root
#RUN ln -s /home/bigtincan/app /var/www/widgets

USER bigtincan
WORKDIR /home/bigtincan/app
# composer dependencies
#RUN composer require phpunit/phpunit
#RUN composer require guzzlehttp/guzzle

#RUN chown www-data:www-data /var/www/bigtincan
