FROM php:8.3-fpm-alpine

RUN apk add --no-cache \
    nginx \
    bash \
    curl \
    git \
    php83-mbstring \
    php83-opcache \
    php83-pdo \
    php83-pdo_mysql \
    php83-tokenizer \
    php83-ctype \
    php83-json \
    php83-xml \
    php83-curl \
    php83-dom \
    php83-phar \
    php83-session \
    php83-fileinfo \
    php83-zip \
    php83-iconv \
    php83-simplexml \
    php83-gd \
    php83-intl \
    && rm -rf /var/cache/apk/*

WORKDIR /var/www/html

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Настройка PHP-FPM
RUN sed -i 's|listen = 127.0.0.1:9000|listen = /run/php/php8.4-fpm.sock|' /usr/local/etc/php-fpm.d/www.conf && \
    sed -i 's|;listen.owner = nobody|listen.owner = nginx|' /usr/local/etc/php-fpm.d/www.conf && \
    sed -i 's|;listen.group = nobody|listen.group = nginx|' /usr/local/etc/php-fpm.d/www.conf

# Даем права для nginx
RUN chown -R nginx:nginx /var/www/html

# Открываем порт для PHP-FPM
EXPOSE 9000

# Запуск PHP-FPM
CMD ["/usr/bin/env", "php-fpm"]
