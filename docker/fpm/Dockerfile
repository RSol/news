FROM alpine:latest

RUN echo 'http://dl-cdn.alpinelinux.org/alpine/edge/testing' >> /etc/apk/repositories && \
    apk --update add \
        php7 \
        php7-bcmath \
        php7-dom \
        php7-ctype \
        php7-curl \
        php7-fileinfo \
        php7-fpm \
        php7-gd \
        php7-iconv \
        php7-intl \
        php7-json \
        php7-mbstring \
        php7-mcrypt \
        php7-mysqlnd \
        php7-opcache \
        php7-openssl \
        php7-pdo \
        php7-pdo_mysql \
        php7-phar \
        php7-posix \
        php7-session \
        php7-zip \
        php7-memcache \
    && rm -rf /var/cache/apk/* \
    && sed -i "/;clear_env = .*/c\clear_env = no" /etc/php7/php-fpm.d/www.conf \
    && sed -i "/;catch_workers_output = .*/c\catch_workers_output = yes" /etc/php7/php-fpm.d/www.conf \
#    && sed -i "/pid = .*/c\;pid = /run/php/php7.3-fpm.pid" /etc/php7/php-fpm.d/www.conf \
    && sed -i "/;daemonize = .*/c\daemonize = no" /etc/php7/php-fpm.d/www.conf \
    && sed -i "/error_log = .*/c\error_log = /proc/self/fd/2" /etc/php7/php-fpm.d/www.conf \
    && sed -i "/pm.max_children = .*/c\pm.max_children = 15" /etc/php7/php-fpm.d/www.conf

COPY php.ini /etc/php7/conf.d/50-setting.ini
COPY php-fpm.conf /etc/php7/php-fpm.conf

EXPOSE 9000

CMD ["php-fpm7", "-F"]
