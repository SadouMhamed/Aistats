#!/bin/bash

# Vercel build script for Laravel (frontend assets pre-built)

echo "🚀 Building Laravel application for Vercel..."

# Create required directories
echo "📁 Creating required directories..."
mkdir -p storage/framework/{cache,sessions,views}
mkdir -p storage/logs
mkdir -p bootstrap/cache

# Set proper permissions
echo "🔐 Setting permissions..."
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# Install PHP dependencies only
echo "📦 Installing Composer dependencies..."
composer install --optimize-autoloader --no-dev --no-scripts --no-progress

# Verify frontend assets exist
echo "🎨 Checking frontend assets..."
if [ -d "public/build" ]; then
    echo "✅ Frontend assets found in public/build/"
else
    echo "⚠️ Warning: Frontend assets not found!"
fi

# Generate application key if not exists
if [ ! -f .env ]; then
    echo "🔑 Generating application key..."
    php artisan key:generate --no-interaction
fi

# Clear and optimize for serverless
echo "🧹 Clearing caches..."
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Cache config for production
echo "⚡ Caching configuration..."
php artisan config:cache

echo "✅ Laravel build completed successfully!" 