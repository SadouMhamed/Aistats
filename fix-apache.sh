#!/bin/bash

# 🔧 Laravel Apache Fix Script
# This script fixes common Apache issues with Laravel

echo "🔧 Fixing Apache configuration for Laravel..."

# 1. Set proper permissions
echo "📁 Setting proper directory permissions..."
chmod -R 755 .
chmod -R 775 storage bootstrap/cache
chmod -R 644 .env

# 2. Clear all Laravel caches
echo "🧹 Clearing Laravel caches..."
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

# 3. Regenerate cached files
echo "💾 Regenerating cache files..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 4. Check if mod_rewrite is enabled
echo "🔄 Checking Apache modules..."
if ! apache2ctl -M 2>/dev/null | grep -q rewrite_module; then
    echo "⚠️  mod_rewrite not enabled. Please enable it:"
    echo "   sudo a2enmod rewrite"
    echo "   sudo systemctl restart apache2"
fi

# 5. Test PHP configuration
echo "🐘 Testing PHP configuration..."
if ! php -m | grep -q pdo_pgsql; then
    echo "⚠️  PostgreSQL PDO extension not found. Install it:"
    echo "   sudo apt-get install php-pgsql (Ubuntu/Debian)"
    echo "   brew install php@8.3 (macOS with Homebrew)"
fi

# 6. Check .env file
echo "⚙️  Checking .env configuration..."
if ! grep -q "APP_KEY=" .env || grep -q "APP_KEY=$" .env; then
    echo "🔑 Generating new application key..."
    php artisan key:generate
fi

# 7. Test database connection
echo "🗄️  Testing database connection..."
if php artisan migrate:status > /dev/null 2>&1; then
    echo "✅ Database connection successful!"
else
    echo "❌ Database connection failed. Check your .env settings."
fi

# 8. Check Laravel installation
echo "🚀 Testing Laravel installation..."
if php artisan --version > /dev/null 2>&1; then
    echo "✅ Laravel is working correctly!"
    php artisan --version
else
    echo "❌ Laravel has issues. Check composer dependencies."
fi

echo ""
echo "🎯 Next Steps:"
echo "1. Add the virtual host configuration to your Apache config"
echo "2. Add '127.0.0.1 nvaistat.local' to your /etc/hosts file"
echo "3. Restart Apache"
echo "4. Visit http://nvaistat.local"
echo ""
echo "🔍 If you still get 500 errors, check:"
echo "   - Apache error logs: tail -f /Applications/XAMPP/xamppfiles/logs/error_log"
echo "   - Laravel logs: tail -f storage/logs/laravel.log"
echo "   - PHP errors: Visit http://nvaistat.local/debug.php" 