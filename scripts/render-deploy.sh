#!/bin/bash

# 🚀 Render Deployment Script for Laravel + Supabase
# This script runs during Render deployment

set -e  # Exit on any error

echo "🚀 Starting Render deployment for Laravel application..."

# Check PHP version
echo "📋 Checking PHP version..."
php -v

# Check Node.js version
echo "📋 Checking Node.js version..."
node -v
npm -v

# Install Composer dependencies
echo "📦 Installing Composer dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction

# Install NPM dependencies and build assets
echo "🎨 Installing NPM dependencies..."
npm ci --production=false

echo "🏗️ Building frontend assets..."
npm run build

# Create necessary directories
echo "📁 Creating storage directories..."
mkdir -p storage/logs
mkdir -p storage/framework/cache
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p storage/app/public

# Set proper permissions
echo "🔐 Setting proper permissions..."
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# Create storage link
echo "🔗 Creating storage link..."
php artisan storage:link --force

# Generate application key if not set
if [ -z "$APP_KEY" ] || [ "$APP_KEY" = "base64:" ]; then
    echo "🔑 Generating application key..."
    php artisan key:generate --force
else
    echo "✅ Application key already set"
fi

# Clear and cache configuration
echo "💾 Optimizing Laravel configuration..."
php artisan config:clear
php artisan config:cache

echo "🚏 Caching routes..."
php artisan route:clear
php artisan route:cache

echo "👀 Caching views..."
php artisan view:clear
php artisan view:cache

# Test database connection
echo "🗄️ Testing database connection..."
php artisan migrate:status || echo "⚠️ Database connection test failed - will retry during migration"

# Run database migrations
echo "🗄️ Running database migrations..."
php artisan migrate --force

# Clear application cache
echo "🧹 Clearing application caches..."
php artisan cache:clear

# Optimize application
echo "⚡ Optimizing application..."
php artisan optimize

# Verify critical files exist
echo "🔍 Verifying deployment..."
if [ ! -f "public/index.php" ]; then
    echo "❌ ERROR: public/index.php not found!"
    exit 1
fi

if [ ! -d "public/build" ]; then
    echo "❌ ERROR: Frontend assets not built!"
    exit 1
fi

if [ ! -f "vendor/autoload.php" ]; then
    echo "❌ ERROR: Composer dependencies not installed!"
    exit 1
fi

echo "✅ Deployment verification complete!"

# Display deployment info
echo ""
echo "🎉 Laravel deployment completed successfully!"
echo "📊 Deployment Summary:"
echo "   • PHP Version: $(php -v | head -n 1)"
echo "   • Laravel Version: $(php artisan --version)"
echo "   • Node.js Version: $(node -v)"
echo "   • Composer Packages: $(composer show | wc -l) packages installed"
echo "   • NPM Packages: $(npm list --depth=0 | grep -c "├──\|└──") packages installed"
echo "   • Frontend Assets: $(ls -1 public/build/assets/ | wc -l) files built"
echo "   • Database: Migrations completed"
echo "   • Cache: Optimized and ready"
echo ""
echo "🌐 Your Laravel application is ready to serve requests!"
echo "🔗 Storage linked: $(readlink public/storage)"
echo "📱 Visit your application at the Render URL" 