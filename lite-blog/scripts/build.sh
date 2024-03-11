#!/bin/bash
composer install

if [ ! -f .env ]; then
  cp .env.example .env
fi

php artisan key:generate
php artisan migrate --seed
php artisan test
php artisan serve
