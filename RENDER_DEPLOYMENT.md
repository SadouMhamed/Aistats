# 🚀 **Render Deployment Guide**

## 📋 **Prerequisites**

✅ **GitHub repository**: `SadouMhamed/Aistats` (public/private)  
✅ **Supabase project**: `nvaistat-prod` setup complete  
✅ **Laravel application**: Ready with pre-built assets  
✅ **Updated render.yaml**: Configuration file updated

## 🎯 **Step-by-Step Deployment**

### **1. Create Render Account**

1. Go to [render.com](https://render.com)
2. **Sign up** with GitHub account
3. **Connect your GitHub** repository

### **2. Deploy Web Service**

#### **Option A: Via Dashboard (Recommended)**

1. **Click "New +"** → **"Web Service"**
2. **Connect Repository**: Select `SadouMhamed/Aistats`
3. **Configure Service**:
    ```
    Name: nvaistat-laravel
    Branch: main
    Root Directory: Aistats
    Runtime: PHP
    Build Command: (auto-detected from render.yaml)
    Start Command: (auto-detected from render.yaml)
    ```

#### **Option B: Via render.yaml (Automatic)**

1. **Push updated render.yaml** to GitHub
2. Render will **auto-detect** the configuration
3. **Deploy automatically**

### **3. Monitor Deployment**

#### **Build Process** (Expected ~5-10 minutes):

```bash
🔄 Cloning repository...
📦 Installing PHP dependencies (composer install)
🎨 Building frontend assets (npm run build)
🔗 Linking storage directory
💾 Caching Laravel configuration
🗄️ Running database migrations
🚀 Starting PHP server
✅ Deployment successful!
```

#### **Build Logs to Watch For**:

```
✓ Composer dependencies installed
✓ NPM packages installed
✓ Frontend assets built
✓ Storage linked
✓ Configuration cached
✓ Routes cached
✓ Views cached
✓ Database migrated
✓ Server started on port $PORT
```

## 🌐 **Access Your Application**

**Your app will be available at**:

```
https://nvaistat-laravel.onrender.com
```

**First visit checklist**:

-   [ ] Home page loads
-   [ ] CSS/JS assets load correctly
-   [ ] Database connection works
-   [ ] User registration/login works
-   [ ] File upload functionality works

## ⚙️ **Configuration Details**

### **🐘 PHP Environment**

```yaml
env: php
runtime: PHP 8.2
```

### **🗄️ Database Connection**

```yaml
DB_HOST: aws-0-eu-west-3.pooler.supabase.com
DB_PORT: 6543
DB_DATABASE: postgres
DB_USERNAME: postgres.hrjjjaxmdvhabzbkwbgg
```

### **🔐 Supabase Integration**

```yaml
SUPABASE_URL: https://hrjjjaxmdvhabzbkwbgg.supabase.co
SUPABASE_ANON_KEY: [Production Key]
SUPABASE_SERVICE_ROLE_KEY: [Service Key]
```

## 🐛 **Troubleshooting**

### **Common Issues & Solutions**

#### **1. Build Fails on NPM**

```bash
Error: npm: command not found
```

**Solution**: Render PHP environment includes Node.js ✅

#### **2. Database Connection Error**

```bash
SQLSTATE[08006] Connection refused
```

**Solution**: Check Supabase database is running

```bash
# Test connection from Render logs
php artisan migrate:status
```

#### **3. Assets Not Loading**

```bash
404 errors for CSS/JS files
```

**Solution**:

```bash
# Check if assets built correctly
ls -la public/build/assets/
```

#### **4. Permission Errors**

```bash
The stream or file could not be opened
```

**Solution**: Storage linking issue

```bash
# Check build logs for:
php artisan storage:link
```

#### **5. Environment Variables**

```bash
APP_KEY not set or invalid
```

**Solution**: Verify in Render dashboard:

-   **Environment** → **Environment Variables**
-   Confirm `APP_KEY` = `base64:TRhxbxF89CizRUWfQiOsx0Rx8lq+jNiVTjLhcoCIJL8=`

## 🔄 **Managing Updates**

### **Deploy New Changes**:

1. **Make changes locally**
2. **Commit and push** to GitHub:
    ```bash
    git add .
    git commit -m "Update feature"
    git push origin main
    ```
3. **Render auto-deploys** from main branch
4. **Monitor build logs** in Render dashboard

### **Manual Redeploy**:

-   Go to **Render Dashboard**
-   **Services** → **nvaistat-laravel**
-   Click **"Manual Deploy"** → **"Deploy latest commit"**

## 📊 **Monitoring**

### **Render Dashboard Features**:

-   📈 **Metrics**: CPU, Memory, Response times
-   📋 **Logs**: Application and build logs
-   🔄 **Deployments**: History and status
-   ⚙️ **Settings**: Environment variables, domains

### **Laravel Logs**:

```bash
# View logs in Render dashboard
# Or check Laravel logs:
tail -f storage/logs/laravel.log
```

## 🎉 **Success Checklist**

-   [ ] ✅ **Deployment completed** without errors
-   [ ] 🌐 **Application accessible** at render URL
-   [ ] 🗄️ **Database connected** to Supabase
-   [ ] 🎨 **Assets loading** (CSS, JS, images)
-   [ ] 🔐 **Authentication working** (login/register)
-   [ ] 📄 **File operations** working
-   [ ] 👤 **Admin panel** accessible
-   [ ] 📧 **Email features** configured (if used)

## 💡 **Render vs Vercel Comparison**

| Feature           | Render                      | Vercel                       |
| ----------------- | --------------------------- | ---------------------------- |
| **PHP Support**   | ✅ Native                   | ⚠️ Serverless only           |
| **Database**      | ✅ Direct connection        | ⚠️ Connection pooling needed |
| **Build Process** | ✅ Traditional              | ⚠️ Complex for Laravel       |
| **File Storage**  | ✅ Persistent               | ❌ Ephemeral                 |
| **Pricing**       | 💰 $7/month after free tier | 💰 Pay per request           |
| **Ease of Setup** | ✅ Straightforward          | ⚠️ Requires configuration    |

## 🎯 **Next Steps After Deployment**

1. **🌐 Custom Domain** (Optional):

    - Purchase domain
    - Configure DNS in Render
    - Set up SSL certificate

2. **📧 Email Configuration**:

    - Configure SMTP service
    - Update mail environment variables

3. **🔒 Security Hardening**:

    - Review environment variables
    - Set up monitoring alerts
    - Configure backup strategy

4. **🚀 Performance Optimization**:
    - Enable OPcache
    - Configure Redis (if needed)
    - Set up CDN for assets

Your Laravel + Supabase application should now be live on Render! 🎉
