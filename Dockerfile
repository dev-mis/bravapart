# Default Dockerfile
#
# @link     https://www.hyperf.io
# @document https://hyperf.wiki
# @contact  group@hyperf.io
# @license  https://github.com/hyperf/hyperf/blob/master/LICENSE

FROM hyperf/hyperf:8.1-alpine-v3.15-swoole
LABEL maintainer="Hyperf Developers <group@hyperf.io>" version="1.0" license="MIT" app.name="Hyperf"

##
# ---------- env settings ----------
##
# --build-arg timezone=Asia/Shanghai
ARG timezone

ENV TIMEZONE=${timezone:-"Asia/Jakarta"} \
    APP_ENV=prod \
    SCAN_CACHEABLE=(true)

RUN apk add --no-cache $PHPIZE_DEPS && apk add --no-cache php8-pgsql php8-pdo_pgsql gnupg nano curl-dev openssl-dev \
&& pecl config-set php_ini /etc/php8/php.ini
RUN apk add --no-cache build-base libssh2-dev libssh2 autoconf && pecl install ssh2-1.3.1 && printf "extension=ssh2.so" > /etc/php8/conf.d/60_ssh2.ini
RUN apk add --update linux-headers
RUN pecl install mongodb && printf "extension=mongodb.so" > /etc/php8/conf.d/20_mongodb.ini && pecl config-set php_ini /etc/php8/php.ini
RUN rm -rf /var/cache/apk/* && apk del $PHPIZE_DEPS

# update
RUN set -ex  \
    # show php version and extensions
    && php -v \
    && php -m \
    && php --ri swoole \
    #  ---------- some config ----------
    && cd /etc/php8 \
    # - config PHP
    && { \
        echo "upload_max_filesize=128M"; \
        echo "post_max_size=128M"; \
        echo "memory_limit=1G"; \
        echo "date.timezone=${TIMEZONE}"; \
    } | tee conf.d/99_overrides.ini \
    # - config timezone
    && ln -sf /usr/share/zoneinfo/${TIMEZONE} /etc/localtime \
    && echo "${TIMEZONE}" > /etc/timezone \
    # ---------- clear works ----------
    && rm -rf /var/cache/apk/* /tmp/* /usr/share/man \
    && echo -e "\033[42;37m Build Completed :).\033[0m\n"

WORKDIR /opt/www

# Composer Cache
# COPY ./composer.* /opt/www/
# RUN composer install --no-dev --no-scripts

COPY . /opt/www
RUN cp .env.example .env
RUN composer install && php bin/hyperf.php

EXPOSE 9501

ENTRYPOINT ["php", "/opt/www/bin/hyperf.php", "start"]
