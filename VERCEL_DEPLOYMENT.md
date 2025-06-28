# 🚀 Vercel Deployment Guide

## ✅ **Prerequisites - COMPLETED**

-   ✅ Supabase cloud project created and configured
-   ✅ Database migrated to production
-   ✅ Vercel configuration files created

## 📋 **Step-by-Step Deployment**

### 1. **Install Vercel CLI** (if not already installed)

```bash
npm install -g vercel
```

### 2. **Login to Vercel**

```bash
vercel login
```

### 3. **Deploy Your Application**

```bash
# From your project root directory
vercel --prod
```

### 4. **Configure Environment Variables**

After your first deployment, you need to add environment variables in the Vercel dashboard:

1. Go to your project on Vercel dashboard
2. Navigate to **Settings** → **Environment Variables**
3. Add the following variables:

#### **Required Environment Variables:**

```env
# App Configuration
APP_NAME=nvaistat
APP_ENV=production
APP_KEY=base64:YOUR_APP_KEY_HERE
APP_DEBUG=false
APP_URL=https://your-vercel-domain.vercel.app

# Database Configuration (Supabase)
DB_CONNECTION=pgsql
DB_HOST=aws-0-eu-west-3.pooler.supabase.com
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=postgres.hrjjjaxmdvhabzbkwbgg
DB_PASSWORD=YOUR_SUPABASE_DB_PASSWORD

# Supabase Configuration
SUPABASE_URL=https://hrjjjaxmdvhabzbkwbgg.supabase.co
SUPABASE_ANON_KEY=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImhyampqYXhtZHZoYWJ6Ymt3YmdnIiwicm9sZSI6ImFub24iLCJpYXQiOjE3NTEwNjI4NjQsImV4cCI6MjA2NjYzODg2NH0.m_6Ruc9k0Js6Nu4PSjUG86BDnEm5YXOb81ldBDE5hb8
SUPABASE_SERVICE_ROLE_KEY=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImhyampqYXhtZHZoYWJ6Ymt3YmdnIiwicm9sZSI6InNlcnZpY2Vfcm9sZSIsImlhdCI6MTc1MTA2Mjg2NCwiZXhwIjoyMDY2NjM4ODY0fQ.m51UsEoq3eLOQLjQy06tDfEli9s7J87RGMYHtuqCMpM

# Session Configuration
SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

# Cache Configuration
CACHE_DRIVER=database
QUEUE_CONNECTION=database

# Mail Configuration (configure as needed)
MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

# File Storage (use Supabase Storage)
FILESYSTEM_DISK=public
```

### 5. **Generate Application Key**

If you don't have an APP_KEY, generate one locally:

```bash
php artisan key:generate --show
```

Copy the output and add it to your Vercel environment variables.

### 6. **Redeploy After Environment Variables**

After adding all environment variables:

```bash
vercel --prod
```

## 🔧 **File Structure Created**

Your project now includes these Vercel-specific files:

```
├── api/
│   └── index.php          # Vercel serverless entry point
├── vercel.json            # Vercel configuration
├── .vercelignore          # Files to ignore during deployment
├── vercel-build.sh        # Build script for production
```

## 🚀 **Deployment Commands**

```bash
# Deploy to production
vercel --prod

# Deploy to preview (staging)
vercel

# Check deployment status
vercel ls

# View deployment logs
vercel logs [deployment-url]

# Remove deployment
vercel rm [deployment-name]
```

## ⚡ **Performance Optimizations**

The build script automatically:

-   ✅ Installs optimized Composer dependencies
-   ✅ Creates required directories
-   ✅ Sets proper permissions
-   ✅ Clears development caches
-   ✅ Generates production caches
-   ✅ Optimizes autoloader

## 🔒 **Security Configuration**

### Required Supabase Settings:

1. **Go to Supabase Dashboard**: https://supabase.com/dashboard/project/hrjjjaxmdvhabzbkwbgg
2. **Navigate to Authentication → Settings**
3. **Add your Vercel domain to Site URL**:
    ```
    https://your-vercel-domain.vercel.app
    ```
4. **Add to Additional Redirect URLs**:
    ```
    https://your-vercel-domain.vercel.app/*
    ```

## 🐛 **Troubleshooting**

### Common Issues:

1. **"APP_KEY not set" Error**:

    ```bash
    php artisan key:generate --show
    ```

    Add the generated key to Vercel environment variables.

2. **Database Connection Error**:

    - Verify database credentials in Vercel dashboard
    - Check Supabase project status
    - Ensure DB_PASSWORD is set

3. **Static Assets Not Loading**:

    - Ensure assets are in `public/` directory
    - Check `vercel.json` routes configuration

4. **Build Failures**:

    ```bash
    # Test build locally
    bash vercel-build.sh
    ```

5. **Permission Errors**:
    ```bash
    # Make sure build script is executable
    chmod +x vercel-build.sh
    ```

## 📊 **Monitoring**

### Vercel Dashboard:

-   **Deployments**: Monitor deployment status
-   **Functions**: View serverless function performance
-   **Analytics**: Track usage and performance

### Supabase Dashboard:

-   **Database**: Monitor queries and performance
-   **Auth**: Track user authentication
-   **Storage**: Monitor file uploads

## 🔄 **Continuous Deployment**

### Option 1: Git Integration

1. Connect your GitHub repository to Vercel
2. Enable automatic deployments on push
3. Set production branch (usually `main` or `master`)

### Option 2: CLI Deployment

```bash
# Quick deployment
vercel --prod

# With specific domain
vercel --prod --target production
```

## 🎯 **Testing Your Deployment**

1. **Basic Functionality**:

    - Visit your Vercel URL
    - Test homepage loading
    - Check database connectivity

2. **Authentication**:

    - Test user registration
    - Test user login
    - Verify session management

3. **File Operations**:
    - Test file uploads
    - Test file downloads
    - Verify Supabase storage integration

## 📚 **Resources**

-   [Vercel PHP Runtime](https://vercel.com/docs/runtimes/php)
-   [Laravel Deployment](https://laravel.com/docs/deployment)
-   [Supabase Integration](https://supabase.com/docs)

## 🎉 **Next Steps**

1. ✅ Deploy to Vercel
2. ⚠️ Configure custom domain (optional)
3. ⚠️ Set up monitoring and alerts
4. ⚠️ Configure CORS settings
5. ⚠️ Set up backup strategy

Your Laravel application is ready for Vercel deployment! 🚀
