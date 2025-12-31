FROM php:8.3-cli

## Dependencias do sistema
RUN apt-get update && apt-get install -y \
    git \
    unzip \ 
    libzip-dev \
    && docker-php-ext-install zip pdo pdo_mysql

## Composer

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/

COPY . .

RUN composer install

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]