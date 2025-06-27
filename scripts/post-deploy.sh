#!/bin/bash

echo "🚀 Starting post-deployment setup..."

# Create storage directories if they don't exist
mkdir -p storage/app/public/uploads
mkdir -p storage/app/public/admin_files
mkdir -p storage/framework/cache
mkdir -p storage/framework/sessions
mkdir -p storage/framework/testing
mkdir -p storage/framework/views
mkdir -p storage/logs

# Set proper permissions
chmod -R 755 storage
chmod -R 755 bootstrap/cache

# Create symbolic link for storage (if not exists)
if [ ! -L public/storage ]; then
    php artisan storage:link
fi

# Clear and cache configurations
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "✅ Post-deployment setup completed!" 