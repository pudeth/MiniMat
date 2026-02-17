#!/bin/bash

echo "Starting Laravel application..."

# Set permissions
chmod -R 775 storage bootstrap/cache

# Clear any cached config that might cause issues
php artisan config:clear
php artisan cache:clear

# Create storage link if it doesn't exist
php artisan storage:link || true

echo "Starting PHP built-in server on port ${PORT:-8000}..."
php -S 0.0.0.0:${PORT:-8000} -t public
