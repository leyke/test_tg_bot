FROM phpdockerio/php:8.0-fpm

# Обновляем пакеты и устанавливаем необходимые библиотеки
RUN apt-get update \
    && apt-get -y --no-install-recommends install \
    php8.0-memcached \
    php8.0-memcache \
    php8.0-mbstring \
    php8.0-mysql \
    php8.0-intl \
    php8.0-interbase \
    php8.0-redis \
    php8.0-soap \
    php8.0-gd \
    php8.0-imagick \
    php8.0-opcache \
    php8.0-zip \
    php-pear php8.0-dev libmcrypt-dev gcc make autoconf libc-dev pkg-config \
    && pecl install mcrypt-1.0.6 \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

RUN apt-get update
RUN apt-get install -y cron nginx supervisor gettext-base

RUN usermod -u 1000 www-data

COPY ./docker/web/crontab /etc/cron.d/crontab
COPY ./docker/web/supervisord.conf /etc/supervisord.conf

RUN chmod 0644 /etc/cron.d/crontab && \
    crontab -u root /etc/cron.d/crontab && \
    touch /var/log/cron.log && \
    chmod 777 /var/log/cron.log

# Установка Composer
ENV COMPOSER_HOME=/composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN chown -R www-data:www-data /composer

WORKDIR "/app"

CMD ["/usr/bin/supervisord", "-c",  "/etc/supervisord.conf"]