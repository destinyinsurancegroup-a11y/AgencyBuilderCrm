# ──────────────────────────────────────────────
# Agency Builder CRM – Production Dockerfile
# Fixes SSL PostgreSQL connectivity on DigitalOcean
# ──────────────────────────────────────────────
FROM php:8.2-fpm

# Install system libraries needed for SSL + PostgreSQL
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libssl-dev \
    ca-certificates \
    unzip \
    curl \
 && docker-php-ext-configure pdo_pgsql --with-pgsql \
 && docker-php-ext-install pdo_pgsql \
 && update-ca-certificates

# Set working directory
WORKDIR /var/www/html

# Copy application files into the container
COPY . .

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php && \
    php composer.phar install --no-dev --optimize-autoloader && \
    rm -f composer.phar

# Give Laravel proper permissions for storage + cache
RUN chown -R www-data:www-data storage bootstrap/cache && \
    chmod -R 775 storage bootstrap/cache

# Expose PHP-FPM port
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]
