#!/bin/bash
php artisan migrate:fresh

php artisan db:seed

npm run dev &
php artisan serve