#!/bin/bash

# Startup script untuk Laravel di Azure App Service

echo "Starting Laravel application setup..."

# Set working directory
cd /home/site/wwwroot

# Find PHP executable
PHP_PATH="/usr/local/bin/php"
if [ ! -f "$PHP_PATH" ]; then
    PHP_PATH="/opt/php/8.2/bin/php"
fi
if [ ! -f "$PHP_PATH" ]; then
    PHP_PATH="php"
fi

echo "Using PHP: $PHP_PATH"

# Ensure storage and cache directories exist
mkdir -p storage/framework/{sessions,views,cache}
mkdir -p storage/logs
mkdir -p bootstrap/cache

# Set proper permissions
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# Create .env from environment variables (Azure App Settings)
echo "Creating .env from Azure Application Settings..."
cat > .env << EOF
APP_NAME="${APP_NAME:-Laravel}"
APP_ENV="${APP_ENV:-production}"
APP_KEY="${APP_KEY}"
APP_DEBUG="${APP_DEBUG:-false}"
APP_URL="${APP_URL}"

LOG_CHANNEL="${LOG_CHANNEL:-stack}"
LOG_LEVEL="${LOG_LEVEL:-error}"

DB_CONNECTION="${DB_CONNECTION:-mysql}"
DB_HOST="${DB_HOST}"
DB_PORT="${DB_PORT:-3306}"
DB_DATABASE="${DB_DATABASE}"
DB_USERNAME="${DB_USERNAME}"
DB_PASSWORD="${DB_PASSWORD}"

CACHE_DRIVER="${CACHE_DRIVER:-file}"
SESSION_DRIVER="${SESSION_DRIVER:-file}"
QUEUE_CONNECTION="${QUEUE_CONNECTION:-sync}"
EOF

echo ".env file created successfully!"

# Clear and cache configurations
echo "Clearing caches..."
$PHP_PATH artisan config:clear
$PHP_PATH artisan cache:clear

echo "Caching configurations..."
$PHP_PATH artisan config:cache
$PHP_PATH artisan route:cache
$PHP_PATH artisan view:cache

# Optional: Run migrations (uncomment if you want auto-migration)
# echo "Running database migrations..."
# $PHP_PATH artisan migrate --force

echo "Laravel application setup completed!"

# Configure Apache/Nginx to use public folder
if [ -f /etc/apache2/sites-available/000-default.conf ]; then
    echo "Configuring Apache document root..."
    sed -i 's|DocumentRoot /home/site/wwwroot|DocumentRoot /home/site/wwwroot/public|g' /etc/apache2/sites-available/000-default.conf
    sed -i 's|<Directory /home/site/wwwroot>|<Directory /home/site/wwwroot/public>|g' /etc/apache2/sites-available/000-default.conf
    echo "Apache configured!"
fi

echo "Startup script completed successfully!"
