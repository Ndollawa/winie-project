#!/usr/bin/env bash

# Check if vendor directory is missing, then run composer install
if [ ! -d "vendor" ]; then
  echo "Vendor directory is missing. Running composer install..."
  composer install --no-dev --optimize-autoloader
fi

# Run PHP-FPM
exec php-fpm

# echo 'Running composer'
# composer global require hirak/prestissimo
# composer install --no-dev --working-dir=/var/www/html
 
echo 'Caching config...'
php artisan config:cache
 
echo 'Caching routes...'
php artisan route:cache
 
echo 'Running migrations...'
php artisan migrate --force