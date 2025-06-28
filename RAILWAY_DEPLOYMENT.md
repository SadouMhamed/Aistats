# 🚀 **Railway Deployment Guide for Laravel**

## 🎯 **Why Railway is Perfect for Your Laravel Project**

✅ **Zero Configuration**: Railway automatically detects Laravel projects  
✅ **Vite Support**: Properly handles CSS/JS asset building  
✅ **PHP 8.2+**: Full Laravel 12 support  
✅ **Supabase Integration**: Works seamlessly with your existing database  
✅ **Free Tier**: $5/month worth of usage included  
✅ **Custom Domains**: Free SSL certificates

## 📋 **Step-by-Step Deployment**

### **1. Prepare Your Project**

First, let's ensure your project is ready:

```bash
# Make sure you're in your project directory
cd Aistats

# Install dependencies
composer install --optimize-autoloader --no-dev
npm install
npm run build

# Test locally first
php artisan serve
```

### **2. Create Railway Account & Deploy**

1. **Go to**: [railway.app](https://railway.app)
2. **Sign up** with GitHub
3. **Connect your repository**: Select your GitHub repo
4. **Choose deployment**: Select "Deploy from GitHub repo"
5. **Select the `Aistats` folder** as your root directory

### **3. Configure Environment Variables**

In Railway dashboard, add these environment variables:

```env
# App Configuration
APP_NAME="AIStats"
APP_ENV=production
APP_KEY=base64:TRhxbxF89CizRUWfQiOsx0Rx8lq+jNiVTjLhcoCIJL8=
APP_DEBUG=false
APP_TIMEZONE=UTC
APP_URL=https://your-app.railway.app

# Database (Your Supabase Config)
DB_CONNECTION=pgsql
DB_HOST=aws-0-eu-west-3.pooler.supabase.com
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=postgres.hrjjjaxmdvhabzbkwbgg
DB_PASSWORD=YOUR_SUPABASE_PASSWORD

# Supabase
SUPABASE_URL=https://hrjjjaxmdvhabzbkwbgg.supabase.co
SUPABASE_ANON_KEY=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImhyampqYXhtZHZoYWJ6Ymt3YmdnIiwicm9sZSI6ImFub24iLCJpYXQiOjE3NTEwNjI4NjQsImV4cCI6MjA2NjYzODg2NH0.m_6Ruc9k0Js6Nu4PSjUG86BDnEm5YXOb81ldBDE5hb8

# Session & Cache
SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database

# Mail (optional)
MAIL_MAILER=log
```

### **4. Railway Will Automatically:**

```bash
🔄 Detect Laravel project
📦 Run composer install
🎨 Run npm install && npm run build
🔗 Link storage directory
💾 Cache Laravel configuration
🗄️ Run database migrations
🚀 Start PHP server
✅ Deploy successfully!
```

### **5. Custom Build Script (Optional)**

Create `railway.toml` in your project root:

```toml
[build]
builder = "nixpacks"

[deploy]
startCommand = "php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=$PORT"

[variables]
NODE_VERSION = "18"
PHP_VERSION = "8.2"
```

## 🎯 **Expected Result**

Your app will be available at: `https://your-app-name.railway.app`

✅ **Full CSS/JS loading**  
✅ **Database connection working**  
✅ **File uploads functional**  
✅ **Authentication working**

---

## 🔧 **Alternative: PlanetScale + Vercel**

If Railway doesn't work, here's another excellent option:

### **Vercel for Frontend + API**

```json
// vercel.json
{
    "version": 2,
    "functions": {
        "api/index.php": {
            "runtime": "vercel-php@0.6.0"
        }
    },
    "routes": [
        {
            "src": "/build/(.*)",
            "dest": "/public/build/$1"
        },
        {
            "src": "/(.*)",
            "dest": "/api/index.php"
        }
    ]
}
```

---

## 🌟 **Alternative: Hostinger VPS**

**Budget-friendly option with full control:**

1. **Get Hostinger VPS**: $3.99/month
2. **Install Laravel Stack**:
    ```bash
    # One-click Laravel installation
    # Or manual: PHP 8.2 + Nginx + Composer
    ```
3. **Deploy via Git**:
    ```bash
    git clone your-repo
    composer install --no-dev
    npm run build
    ```

---

## 🚀 **Quick Start with Railway (Recommended)**

1. **Push your code** to GitHub
2. **Go to Railway.app** → Sign up with GitHub
3. **New Project** → Deploy from GitHub
4. **Select your repo** → Choose `Aistats` folder
5. **Add environment variables** (copy from above)
6. **Deploy** → Get your URL in 2-3 minutes!

**Railway handles everything automatically** - no complex configs needed!

## 🔧 **Why Railway > Render**

| Feature             | Railway            | Render          |
| ------------------- | ------------------ | --------------- |
| Laravel Detection   | ✅ Automatic       | ❌ Manual setup |
| Vite Asset Building | ✅ Works perfectly | ❌ CSS issues   |
| PHP Version         | ✅ 8.2+            | ✅ 8.2+         |
| Free Tier           | ✅ $5/month usage  | ✅ 750 hours    |
| Setup Complexity    | ✅ Zero config     | ❌ Complex      |
| Asset Serving       | ✅ Perfect         | ❌ Problems     |

**Railway = Deploy in 2 minutes with working CSS!** 🎨
