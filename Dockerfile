# ----------------------------------------------------------
#  AgencyBuilderCRM – Secure Production Dockerfile
#  Compatible with: PHP 8.2 / Laravel 10 / PostgreSQL / SSL
# ----------------------------------------------------------

# 🧩 Base image (PHP 8.2 with FPM)
FROM php:8.5-fpm

# ----------------------------------------------------------
# 1️⃣ Install system dependencies and PHP extensions
# ----------------------------------------------------------
RUN apt-get update && apt-get install -y \
    libpq-dev \ 
    libssl-dev \ 
    ca-certificates \ 
    unzip \ 
    curl \ 
    git && \
    docker-php-ext-install pdo_pgsql && \
    update-ca-certificates && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

# ----------------------------------------------------------
# 2️⃣ Set working directory
# ----------------------------------------------------------
WORKDIR /var/www/html

# ----------------------------------------------------------
# 3️⃣ Copy Laravel source code into the container
# ----------------------------------------------------------
COPY . .

# ----------------------------------------------------------
# 4️⃣ Install Composer and PHP dependencies
# ----------------------------------------------------------
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# ----------------------------------------------------------
# 5️⃣ Set proper permissions for Laravel
# ----------------------------------------------------------
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache && \
    chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# ----------------------------------------------------------
# 6️⃣ Expose PHP-FPM port
# ----------------------------------------------------------
EXPOSE 9000

# ----------------------------------------------------------
# 7️⃣ Set default command to run PHP-FPM
# ----------------------------------------------------------
CMD ["php-fpm"]
