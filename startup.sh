#!/bin/bash

echo "Starting Laravel application setup..."

# Set working directory
cd /home/site/wwwroot

# Ensure storage and cache directories exist
mkdir -p storage/framework/{sessions,views,cache}
mkdir -p storage/logs
mkdir -p bootstrap/cache

# Set proper permissions
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# Copy environment file
if [ -f .env.azure ]; then
    echo "Copying .env.azure to .env..."
    cp .env.azure .env
fi

# Clear and cache configurations
echo "Clearing configuration cache..."
php artisan config:clear

echo "Caching configurations..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

echo "Caching views..."
php artisan view:cache

# Optional: Run migrations (uncomment if you want auto-migration)
# echo "Running database migrations..."
# php artisan migrate --force

echo "Laravel application setup completed!"

# Start PHP-FPM (Azure handles this, but included for completeness)
# php-fpm
