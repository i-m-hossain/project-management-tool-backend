#!/bin/bash
set -e

echo "📁 Preparing Laravel permissions..."
mkdir -p storage/logs/nginx
# Only attempt chown if running as root (production or build context)
if [ "$(id -u)" = "0" ]; then
    echo "🔧 Running as root — adjusting permissions..."
    chown -R www-data:www-data storage bootstrap/cache
else
    echo "ℹ️ Running as non-root (development), skipping chown..."
fi

echo "🚀 Starting PHP-FPM..."
exec php-fpm