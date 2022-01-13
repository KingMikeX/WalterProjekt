FROM php:7.4.16-fpm

RUN apt-get update && apt-get install -y \
        apt-utils \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng-dev \
        libzip-dev \
        zlib1g-dev \
        libicu-dev \
        libxslt-dev \
        unzip \
        zip \
        wget \
        g++ \
        supervisor \
    && docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ \
    && docker-php-ext-configure intl \
    && docker-php-ext-configure hash --with-mhash \
    && pecl install redis-5.1.1 xdebug-2.8.1 \
    && docker-php-ext-install -j$(nproc) opcache zip bcmath intl iconv pdo pdo_mysql gd xsl zip exif \
    && docker-php-ext-enable redis xdebug \
    && php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin/ --filename=composer \
    && php -r "unlink('composer-setup.php');" \
    && curl -LsS https://symfony.com/installer -o /usr/local/bin/symfony \
    && chmod a+x /usr/local/bin/symfony \
    && chown -R www-data:www-data /var/www/html \
    && echo "xdebug.idekey=xdebug-base" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    # Xdebug 2
    && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_autostart=off" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_port=9000" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_handler=dbgp" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_connect_back=0" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_log=/usr/local/var/log/xdebug.log" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    # Xdebug 3
    && echo "xdebug.log=/usr/local/var/log/xdebug.log" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.discover_client_host=true" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_port=9003" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# added all relevant root certificates - exported from mac osx keychain
ADD certificates /usr/local/share/ca-certificates
RUN update-ca-certificates

RUN groupadd -g 1010 deploy && useradd -u 1010 -m -r -g deploy deploy \
    && chown -R deploy:deploy /var/www/html
RUN curl -sL https://deb.nodesource.com/setup_15.x | bash - \
    && apt-get update && apt-get install -y nodejs
RUN npm install -g yarn
RUN npm install -g grunt-cli
RUN apt-get install -y git
RUN apt-get install -y libldap2-dev
RUN docker-php-ext-configure ldap  --with-libdir=lib/x86_64-linux-gnu/ \
    && docker-php-ext-install -j$(nproc) ldap
RUN docker-php-ext-install -j$(nproc) calendar

#Add Cf
RUN  curl -L "https://packages.cloudfoundry.org/stable?release=linux64-binary&version=v7&source=github" | tar -zx \
  && mv cf7 /bin \
  && mv cf /bin



HEALTHCHECK CMD php -v || exit 1
