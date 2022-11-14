FROM php:8.1.0-fpm
ENV DEBIAN_FRONTEND noninteractive
RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        # libmcrypt-dev \
        libpng-dev \
    # && pecl install mcrypt-1.0.4 \
    # && docker-php-ext-enable mcrypt \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd
	
RUN  apt-get update \
	&& docker-php-ext-install pdo pdo_mysql \
    && apt-get install libzip-dev -y \
	&& docker-php-ext-install zip \
	&& curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
    
RUN  echo 'export PATH="$PATH:$HOME/.composer/vendor/bin"' >> ~/.bashrc

RUN usermod -u 1000 www-data
RUN groupmod -g 1000 www-data
RUN chown www-data /var/www

USER www-data

WORKDIR /code