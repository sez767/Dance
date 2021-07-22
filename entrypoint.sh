#!/usr/bin/env bash
while ! nc -z mysql 3306; do sleep 3; done
composer install --ignore-platform-reqs

php artisan route:clear
php artisan config:clear
php artisan cache:clear

php artisan migrate
php artisan db:seed
docker-compose exec fpm chmod -R 777 /var/www/html/public/
docker-compose exec fpm chmod -R 777 /var/www/html/storage/
docker-php-entrypoint php-fpm
