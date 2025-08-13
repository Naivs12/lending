# Set PHP and Composer versions
ARG PHP_VERSION=8.2
ARG COMPOSER_VERSION=latest

###########################################
# NODE
###########################################
FROM node:23.11.0-alpine AS frontend

WORKDIR /frontend

COPY package.json package-lock.json /frontend/
RUN npm install

COPY artisan tailwind.config.js postcss.config.js vite.config.js /frontend/
COPY app ./app
COPY bootstrap ./bootstrap
COPY public ./public
COPY resources ./resources
COPY vendor ./vendor

RUN npm run build

###########################################
# PHP dependencies
###########################################

FROM composer:${COMPOSER_VERSION} AS vendor

WORKDIR /var/www/html
COPY composer* ./
ENV COMPOSER_MEMORY_LIMIT=-1

RUN composer install \
  --no-dev \
  --no-interaction \
  --prefer-dist \
  --ignore-platform-reqs \
  --optimize-autoloader \
  --apcu-autoloader \
  --ansi \
  --no-scripts \
  --audit

###########################################
# PHP runtime
###########################################

FROM php:${PHP_VERSION}-cli-bookworm

LABEL maintainer="Seyed Morteza Ebadi <seyed.me720@gmail.com>"

ARG WWWUSER=1000
ARG WWWGROUP=1000
ARG TZ=UTC

ARG CONTAINER_MODE=app
ARG APP_WITH_HORIZON=false
ARG APP_WITH_SCHEDULER=false

ENV DEBIAN_FRONTEND=noninteractive \
    TERM=xterm-color \
    CONTAINER_MODE=${CONTAINER_MODE} \
    APP_WITH_HORIZON=${APP_WITH_HORIZON} \
    APP_WITH_SCHEDULER=${APP_WITH_SCHEDULER}

ENV ROOT=/var/www/html
WORKDIR $ROOT

SHELL ["/bin/bash", "-eou", "pipefail", "-c"]

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime \
    && echo $TZ > /etc/timezone

# System dependencies
RUN apt-get update -yqq && \
    apt-get install -yqq --no-install-recommends \
        apt-utils \
        gnupg \
        gosu \
        git \
        curl \
        wget \
        libcurl4-openssl-dev \
        ca-certificates \
        supervisor \
        libmemcached-dev \
        libz-dev \
        libbrotli-dev \
        libpq-dev \
        libjpeg-dev \
        libpng-dev \
        libfreetype6-dev \
        libssl-dev \
        libwebp-dev \
        libonig-dev \
        libzip-dev zip unzip \
        libargon2-1 \
        libidn2-0 \
        libpcre2-8-0 \
        libpcre3 \
        libxml2 \
        libzstd1 \
        procps

# PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring pcntl bcmath zip \
    && docker-php-ext-configure zip \
    && docker-php-ext-configure gd --with-jpeg --with-webp --with-freetype \
    && docker-php-ext-install gd

# Opcache
ARG INSTALL_OPCACHE=true
RUN if [ ${INSTALL_OPCACHE} = true ]; then \
      docker-php-ext-install opcache; \
  fi

# Redis
ARG INSTALL_PHPREDIS=true
RUN if [ ${INSTALL_PHPREDIS} = true ]; then \
      pecl install -o -f redis && docker-php-ext-enable redis; \
  fi

# Kafka
ARG INSTALL_RDKAFKA=true
RUN if [ ${INSTALL_RDKAFKA} = true ]; then \
      apt-get install -yqq librdkafka-dev && \
      pecl install -o -f rdkafka && \
      docker-php-ext-enable rdkafka; \
  fi

# OpenSwoole
ARG INSTALL_SWOOLE=true
RUN if [ ${INSTALL_SWOOLE} = true ]; then \
      apt-get install -yqq \
        libc-ares-dev \
        libcurl4-openssl-dev \
        libssl-dev \
        libnghttp2-dev \
        pkg-config \
        re2c \
        autoconf \
        build-essential \
        git && \
      git clone --depth=1 https://github.com/openswoole/swoole-src.git /usr/src/openswoole && \
      cd /usr/src/openswoole && \
      phpize && \
      ./configure --enable-openssl --enable-http2 --enable-swoole-curl --enable-mysqlnd --enable-cares && \
      make -j"$(nproc)" && make install && \
      docker-php-ext-enable openswoole && \
      rm -rf /usr/src/openswoole; \
  fi

# Intl
ARG INSTALL_INTL=true
RUN if [ ${INSTALL_INTL} = true ]; then \
      apt-get install -yqq zlib1g-dev libicu-dev g++ && \
      docker-php-ext-configure intl && \
      docker-php-ext-install intl; \
  fi

# PostgreSQL
ARG INSTALL_PDO_PGSQL=true
ARG INSTALL_PGSQL=true
RUN if [ ${INSTALL_PDO_PGSQL} = true ]; then docker-php-ext-install pdo_pgsql; fi
RUN if [ ${INSTALL_PGSQL} = true ]; then docker-php-ext-install pgsql; fi

# PostgreSQL client + PostGIS
ARG INSTALL_PG_CLIENT=true
ARG INSTALL_POSTGIS=true
RUN if [ ${INSTALL_PG_CLIENT} = true ]; then \
        apt-get install -yqq gnupg && \
        . /etc/os-release && \
        echo "deb http://apt.postgresql.org/pub/repos/apt ${VERSION_CODENAME}-pgdg main" > /etc/apt/sources.list.d/pgdg.list && \
        curl -sL https://www.postgresql.org/media/keys/ACCC4CF8.asc | apt-key add - && \
        apt-get update -yqq && \
        apt-get install -yqq postgresql-client-12 postgis && \
        apt-get purge -yqq gnupg; \
  fi

# Laravel scheduler
RUN if [ ${CONTAINER_MODE} = 'scheduler' ] || [ ${APP_WITH_SCHEDULER} = true ]; then \
      wget -q "https://github.com/aptible/supercronic/releases/download/v0.2.1/supercronic-linux-amd64" \
        -O /usr/bin/supercronic && \
      chmod +x /usr/bin/supercronic && \
      mkdir -p /etc/supercronic && \
      echo "*/1 * * * * php ${ROOT}/artisan schedule:run --verbose --no-interaction" > /etc/supercronic/laravel; \
  fi

# Create user
RUN groupadd --force -g $WWWGROUP octane && \
    useradd -ms /bin/bash --no-log-init --no-user-group -g $WWWGROUP -u $WWWUSER octane

# Cleanup
RUN apt-get clean && \
    docker-php-source delete && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* && \
    rm /var/log/lastlog /var/log/faillog

# Copy application code
COPY . .
COPY --from=frontend --chown=www-data:www-data /frontend/public ./public

RUN mkdir -p \
  storage/framework/{sessions,views,cache} \
  storage/logs \
  bootstrap/cache && \
  chown -R octane:octane storage bootstrap/cache && \
  chmod -R ug+rwx storage bootstrap/cache && \
  chmod -R 775 storage/framework/sessions

COPY deployment/octane/supervisord* /etc/supervisor/conf.d/
COPY deployment/octane/php.ini /usr/local/etc/php/conf.d/octane.ini
COPY deployment/octane/opcache.ini /usr/local/etc/php/conf.d/opcache.ini

RUN chmod +x deployment/octane/entrypoint.sh
RUN cat deployment/octane/utilities.sh >> ~/.bashrc

EXPOSE 9000

ENTRYPOINT ["deployment/octane/entrypoint.sh"]

HEALTHCHECK --start-period=5s --interval=2s --timeout=5s --retries=8 CMD php artisan octane:status || exit 1
