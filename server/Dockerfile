FROM php:7.4-apache
RUN docker-php-ext-install -j$(nproc) mysqli 
RUN docker-php-ext-install -j$(nproc) pdo_mysql

