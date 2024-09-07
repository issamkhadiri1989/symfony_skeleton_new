FROM lavoweb/php-8.3

RUN a2enmod rewrite && \
    apt-get update && \
    apt-get install -y git unzip zip

WORKDIR /var/www/html

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

RUN install-php-extensions gd pdo_mysql bcmath zip intl opcache

COPY --from=composer:2.7.2 /usr/bin/composer /usr/local/bin/composer

RUN composer self-update && \
     apt update  && \
     apt install nano

# install the PHP APCu extension
RUN mkdir -p /usr/src/php/ext/apcu && \
    curl -fsSL https://pecl.php.net/get/apcu | tar xvz -C "/usr/src/php/ext/apcu" --strip 1 && \
    docker-php-ext-install apcu

# Install xsl extension
RUN apt install -y libxslt-dev && \
    docker-php-ext-install xsl

# Install Xdebug
RUN pecl install xdebug-3.3.1 && \
    docker-php-ext-enable xdebug

# Install Symfony cli
RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' | bash
RUN apt install symfony-cli