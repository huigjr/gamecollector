FROM php:7.1.33-apache-stretch

RUN apt update && apt install -y \
    rsync ssh sshpass mysql-client git \
    libfreetype6-dev libpng-dev libjpeg-dev \
    zip libzip-dev
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable mysqli && docker-php-ext-enable pdo_mysql
RUN docker-php-ext-configure gd \
    --with-freetype-dir=/usr/include/ \
    --with-jpeg-dir=/usr/include/ \
    --with-png-dir=/usr/include/ \
    && docker-php-ext-install gd \
    && apt-get purge -y libfreetype6-dev libpng-dev libjpeg-dev
RUN docker-php-ext-configure zip --with-libzip \
    && docker-php-ext-install zip
RUN docker-php-ext-install bcmath exif
RUN pecl install xdebug-2.9.8 && docker-php-ext-enable xdebug

RUN a2enmod rewrite headers ssl

# Install MailHog
# https://phauer.com/2017/test-mail-server-php-docker-container/
RUN apt-get update && apt-get install \
    --no-install-recommends --assume-yes --quiet ca-certificates curl git \
    && rm -rf /var/lib/apt/lists/*
RUN curl -Lsf 'https://storage.googleapis.com/golang/go1.8.3.linux-amd64.tar.gz' \
    | tar -C '/usr/local' -xvzf -
ENV PATH /usr/local/go/bin:$PATH
RUN go get github.com/mailhog/mhsendmail
RUN cp /root/go/bin/mhsendmail /usr/bin/mhsendmail

# update php settings and apache
COPY docker/php.ini /usr/local/etc/php/
COPY docker/apache-config.conf /etc/apache2/sites-enabled/000-default.conf

# set timezone
RUN echo "Europe/Amsterdam" > /etc/timezone
RUN dpkg-reconfigure -f noninteractive tzdata

# set up ssl
RUN mkdir /etc/apache2/ssl
COPY docker/ssl/* /etc/apache2/ssl/
COPY docker/ssl/*.crt /usr/local/share/ca-certificates/
RUN update-ca-certificates

# set up testing
WORKDIR /testing
COPY --from=composer:2.2 /usr/bin/composer /usr/bin/composer
COPY composer.json phpunit.xml ./
COPY tests tests
RUN composer install

# update script to sync changes to dev server and dev database
COPY docker/update.sh docker/import-db.sh docker/server.cnf docker/local.cnf /root/
RUN chmod a+x /root/
RUN chmod a+x /root/update.sh
RUN chmod a+x /root/import-db.sh

# create tmp directory for plupload
RUN mkdir -m 777 /tmp/plupload

RUN usermod -u 1000 www-data
RUN groupmod -g 1000 www-data

WORKDIR /home/www

# copy source code
RUN mkdir dv01.allunited.nl website legacy_restful_api

COPY --chown=www-data:www-data ./backoffice dv01.allunited.nl
COPY --chown=www-data:www-data ./website website
COPY --chown=www-data:www-data ./legacy_restful_api legacy_restful_api

# install dependencies and generate autoloader
RUN composer install -d dv01.allunited.nl

# create symlink for local development
RUN ln -s website website.allunited.localhost
RUN ln -s legacy_restful_api api-dv01.allunited.localhost

# set up dirs for temporary system files
RUN mkdir emailcache emailcache/allunited generaldata log sessioncache
RUN chmod 777 emailcache emailcache/allunited generaldata log /home/www/sessioncache
