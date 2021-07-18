FROM php:8-fpm-alpine

# Install packages and remove default server definition
RUN apk --no-cache add nginx supervisor curl postgresql-dev $PHPIZE_DEPS && \
    rm -rf /var/cache/apk/*

RUN docker-php-ext-install opcache pgsql pdo_pgsql -j$(nproc)
RUN pecl install apcu && docker-php-ext-enable apcu

# Install PHP tools
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN mkdir -p /.composer/

# Setup document root
RUN mkdir -p /app
RUN mkdir -p /tmp/opcache

# Make sure files/folders needed by the processes are accessable when they run under the nobody user
RUN chown -R nobody.nobody /app && \
  chown -R nobody.nobody /run && \
  chown -R nobody.nobody /var/lib/nginx && \
  chown -R nobody.nobody /var/log/nginx && \
  chown -R nobody.nobody /.composer/ && \
  chown -R nobody.nobody /tmp/opcache

# Switch to use a non-root user from here on
USER nobody

# Add application
WORKDIR /app

# Expose the port nginx is reachable on
EXPOSE 80 9000

# Let supervisord start nginx & php-fpm
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]

# Configure a healthcheck to validate that everything is up&running
HEALTHCHECK --timeout=10s CMD curl --silent --fail http://127.0.0.1:80/fpm-ping
