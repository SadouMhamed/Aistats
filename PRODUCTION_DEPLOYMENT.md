# 🚀 Production Deployment Guide

## ✅ **Supabase Cloud Setup - COMPLETED**

Your Supabase cloud project has been successfully created and configured!

-   **Project Name**: nvaistat-prod
-   **Project ID**: hrjjjaxmdvhabzbkwbgg
-   **Region**: West EU (Paris)
-   **Dashboard**: https://supabase.com/dashboard/project/hrjjjaxmdvhabzbkwbgg

## 🔑 **Production Environment Variables**

### Add these to your production `.env` file:

```env
# ============================================================================
# PRODUCTION SUPABASE CONFIGURATION
# ============================================================================

# Supabase Project URL
SUPABASE_URL=https://hrjjjaxmdvhabzbkwbgg.supabase.co

# Supabase API Keys
SUPABASE_ANON_KEY=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImhyampqYXhtZHZoYWJ6Ymt3YmdnIiwicm9sZSI6ImFub24iLCJpYXQiOjE3NTEwNjI4NjQsImV4cCI6MjA2NjYzODg2NH0.m_6Ruc9k0Js6Nu4PSjUG86BDnEm5YXOb81ldBDE5hb8

SUPABASE_SERVICE_ROLE_KEY=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImhyampqYXhtZHZoYWJ6Ymt3YmdnIiwicm9sZSI6InNlcnZpY2Vfcm9sZSIsImlhdCI6MTc1MTA2Mjg2NCwiZXhwIjoyMDY2NjM4ODY0fQ.m51UsEoq3eLOQLjQy06tDfEli9s7J87RGMYHtuqCMpM

# Database Configuration (Supabase PostgreSQL)
DB_CONNECTION=pgsql
DB_HOST=aws-0-eu-west-3.pooler.supabase.com
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=postgres.hrjjjaxmdvhabzbkwbgg
DB_PASSWORD=YOUR_DATABASE_PASSWORD

# App Configuration
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com

# Add your other production settings here...
```

## 🌐 **Deployment Options**

### Option 1: Deploy on Vercel (Recommended for Laravel)

1. **Install Vercel CLI**:

    ```bash
    npm install -g vercel
    ```

2. **Prepare your Laravel app**:

    ```bash
    # Install dependencies
    composer install --optimize-autoloader --no-dev

    # Generate app key
    php artisan key:generate

    # Clear and cache config
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    ```

3. **Create `vercel.json`**:

    ```json
    {
        "version": 2,
        "functions": {
            "api/index.php": { "runtime": "vercel-php@0.6.0" }
        },
        "routes": [
            {
                "src": "/(.*)",
                "dest": "/api/index.php"
            }
        ],
        "env": {
            "APP_ENV": "production",
            "APP_DEBUG": "false",
            "APP_URL": "https://your-domain.vercel.app"
        }
    }
    ```

4. **Deploy**:
    ```bash
    vercel --prod
    ```

### Option 2: Deploy on DigitalOcean App Platform

1. Connect your GitHub repository
2. Configure build settings:

    - **Build Command**: `composer install --optimize-autoloader --no-dev`
    - **Run Command**: `php artisan serve --host=0.0.0.0 --port=$PORT`

3. Add environment variables in the DigitalOcean dashboard

### Option 3: Deploy on Railway

1. **Install Railway CLI**:

    ```bash
    npm install -g @railway/cli
    ```

2. **Login and deploy**:

    ```bash
    railway login
    railway init
    railway up
    ```

3. Add environment variables in Railway dashboard

### Option 4: Traditional VPS/Server

1. **Install PHP 8.1+, Composer, Nginx/Apache**
2. **Clone your repository**
3. **Install dependencies**:
    ```bash
    composer install --optimize-autoloader --no-dev
    ```
4. **Configure web server to point to `public/` directory**
5. **Set up SSL certificate**

## 🔄 **Database Migration Commands**

### For future database changes:

```bash
# Create new migration
supabase migration new migration_name

# Apply migrations to production
supabase db push

# Check migration status
supabase projects list
```

## 🔒 **Security Checklist**

-   ✅ Database migrated to Supabase Cloud
-   ✅ Row Level Security (RLS) enabled
-   ✅ Environment variables secured
-   ⚠️ **TODO**: Set up proper RLS policies for production
-   ⚠️ **TODO**: Configure CORS settings
-   ⚠️ **TODO**: Set up SSL certificate
-   ⚠️ **TODO**: Configure rate limiting

## 📊 **Monitoring & Management**

### Supabase Dashboard

-   **URL**: https://supabase.com/dashboard/project/hrjjjaxmdvhabzbkwbgg
-   **Features**: Database management, Auth, Storage, Analytics

### Key Monitoring Points:

-   Database performance
-   API response times
-   User authentication
-   File upload/download
-   Error rates

## 🛠️ **Production Commands**

```bash
# Check application status
php artisan about

# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Generate optimized files
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Check database connection
php artisan tinker
# Then run: DB::connection()->getPdo()
```

## 🔧 **Troubleshooting**

### Common Issues:

1. **Database Connection Issues**:

    - Verify DB credentials
    - Check Supabase project status
    - Test connection with: `php artisan migrate:status`

2. **Authentication Issues**:

    - Verify SUPABASE_ANON_KEY
    - Check CORS settings in Supabase dashboard

3. **File Upload Issues**:
    - Configure Supabase Storage policies
    - Check file size limits

## 📚 **Next Steps**

1. **Deploy your Laravel application** using one of the options above
2. **Test all functionality** in production
3. **Set up domain and SSL**
4. **Configure monitoring and backups**
5. **Set up CI/CD pipeline** for automatic deployments

## 🎯 **Important Notes**

-   Your database is already set up and migrated ✅
-   Admin user created: `admin@example.com` / `password`
-   All tables and relationships are ready ✅
-   RLS policies are basic - refine them for production security

## 📞 **Support Resources**

-   [Supabase Documentation](https://supabase.com/docs)
-   [Laravel Deployment Guide](https://laravel.com/docs/deployment)
-   [Production Checklist](https://laravel.com/docs/deployment#optimization)

Your Laravel application is ready for production deployment! 🎉
