#!/bin/bash

# 🚀 Laravel Deployment Preparation Script
# This script prepares your Laravel project for production deployment

echo "🚀 Preparing Laravel project for deployment..."

# Change to project directory
cd "$(dirname "$0")"

echo "📂 Current directory: $(pwd)"

# 1. Install Composer dependencies (production)
echo "📦 Installing Composer dependencies (production mode)..."
composer install --optimize-autoloader --no-dev --no-interaction

# 2. Install NPM dependencies
echo "🎨 Installing NPM dependencies..."
npm install

# 3. Build frontend assets
echo "🔨 Building frontend assets with Vite..."
npm run build

# 4. Generate app key if not exists
if ! grep -q "^APP_KEY=" .env 2>/dev/null; then
    echo "🔑 Generating application key..."
    php artisan key:generate
fi

# 5. Link storage directory
echo "🔗 Linking storage directory..."
php artisan storage:link

# 6. Clear all caches
echo "🧹 Clearing caches..."
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

# 7. Cache configuration for production
echo "💾 Caching configuration..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 8. Test database connection
echo "🗄️ Testing database connection..."
if php artisan migrate:status > /dev/null 2>&1; then
    echo "✅ Database connection successful!"
else
    echo "⚠️ Database connection failed. Please check your .env file."
fi

# 9. Check if build assets exist
if [ -d "public/build" ]; then
    echo "✅ Frontend assets built successfully!"
    echo "📁 Assets location: public/build/"
    ls -la public/build/
else
    echo "❌ Frontend assets not found. Build may have failed."
fi

echo ""
echo "🎉 Deployment preparation complete!"
echo ""
echo "📋 Next steps:"
echo "1. Commit and push your changes to GitHub"
echo "2. Go to railway.app and connect your repository"
echo "3. Add your environment variables"
echo "4. Deploy!"
echo ""
echo "🌐 Your app will be available at: https://your-app.railway.app" 