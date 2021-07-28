FROM php:8.0-apache

RUN apt-get update

RUN apt-get install -y \
    git nano \
    zip \
    curl \
    sudo \
    unzip \
    libzip-dev \
    libicu-dev \
    libbz2-dev \
    libpng-dev \
    libjpeg-dev \
    libmcrypt-dev \
    libreadline-dev \
    libfreetype6-dev \
    g++ \
    libedit-dev \
    libreadline-dev \
    libxml2-dev libonig-dev \
    libpq-dev \
    tdsodbc freetds-common unixodbc-dev \
    software-properties-common libcurl4-gnutls-dev

RUN (curl -sL https://deb.nodesource.com/setup_14.x | bash -) 

RUN apt-get install -y \
    nodejs libc-client-dev libkrb5-dev

RUN a2enmod rewrite headers

RUN docker-php-ext-install \
    curl\
    bz2 mbstring \
    intl \
    bcmath \
    opcache \
    calendar \
    zip \
    gd xml \
    pgsql pdo_pgsql \
    tokenizer ctype 
    #json 

RUN docker-php-ext-configure imap --with-kerberos --with-imap-ssl && docker-php-ext-install imap

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY virtualhost.conf /etc/apache2/sites-available/

RUN (cd /etc/apache2/sites-available ; a2ensite virtualhost.conf)

ARG uid=1000
RUN useradd -G www-data,root -u $uid -d /home/tecnologia tecnologia
RUN mkdir -p /home/tecnologia/.composer && \
    chown -R tecnologia:tecnologia /home/tecnologia

RUN chmod 777 -R /var/www \
    && chown -R www-data:www-data /var/www \
    && chsh -s /bin/bash www-data

RUN ln -sf /dev/stdout /var/log/apache2/access.log \
    && ln -sf /dev/stderr /var/log/apache2/error.log
