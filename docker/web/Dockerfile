FROM phpdockerio/php:8.2-fpm

# Обновляем пакеты и устанавливаем необходимые библиотеки
RUN apt-get update \
    && apt-get -y --no-install-recommends install \
    php8.2-memcached \
    php8.2-memcache \
    php8.2-mbstring \
    php8.2-mysql \
    php8.2-intl \
    php8.2-interbase \
    php8.2-redis \
    php8.2-soap \
    php8.2-gd \
    php8.2-imagick \
    php8.2-opcache \
    php8.2-zip \
    php-pear php8.2-dev libmcrypt-dev gcc make autoconf libc-dev pkg-config \
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
RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /bin/composer

WORKDIR "/app"

CMD ["/usr/bin/supervisord", "-c",  "/etc/supervisord.conf"]