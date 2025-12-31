#!/bin/sh
set -e

echo "Aguardando MySQL..."

until php -r "
try {
    new PDO(
        'mysql:host=' . getenv('DB_HOST') . ';dbname=' . getenv('DB_DATABASE'),
        getenv('DB_USERNAME'),
        getenv('DB_PASSWORD')
    );
    echo 'MySQL conectado\n';
} catch (Exception \$e) {
    exit(1);
}
"; do
  sleep 2
done

echo "> Rodando migrations e seeds..."
php artisan migrate --force
php artisan db:seed --force || true

echo "> Subindo aplicação..."
exec php artisan serve --host=0.0.0.0 --port=8000