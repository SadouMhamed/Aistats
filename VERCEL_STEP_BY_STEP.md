# 🚀 **Vercel Deployment - Step by Step Guide**

## 🏁 **Prerequisites Check**

-   ✅ Your code is pushed to GitHub (SadouMhamed/Aistats)
-   ✅ Supabase project created (hrjjjaxmdvhabzbkwbgg)
-   ✅ All configuration files ready

---

## 📋 **Method 1: Git Integration (Recommended)**

### **Step 1: Get Your Database Password**

1. Go to [Supabase Dashboard](https://supabase.com/dashboard/project/hrjjjaxmdvhabzbkwbgg)
2. Click **Settings** (gear icon) in sidebar
3. Click **Database**
4. Look for **Connection parameters** or **Connection pooling**
5. **Copy your database password** (you set this when creating the project)

_If you forgot it:_

-   Go to **Settings** → **Database** → **Reset database password**

### **Step 2: Login to Vercel**

1. Go to [vercel.com](https://vercel.com)
2. Click **"Login"**
3. Choose **"Continue with GitHub"**
4. Authorize Vercel to access your repositories

### **Step 3: Create New Project**

1. Click **"New Project"** button
2. You'll see your GitHub repositories
3. Find **"SadouMhamed/Aistats"**
4. Click **"Import"** next to it

### **Step 4: Configure Project**

**Configure these settings:**

-   **Project Name**: `nvaistat-prod` (or your preferred name)
-   **Framework Preset**: Select **"Other"**
-   **Root Directory**: Leave as `./` (default)
-   **Build Command**: Leave empty (we have vercel-build.sh)
-   **Output Directory**: Leave empty
-   **Install Command**: Leave empty

### **Step 5: Add Environment Variables**

**BEFORE clicking Deploy**, click **"Environment Variables"** and add these **ONE BY ONE**:

#### **Required Variables** (copy from VERCEL_ENV_VARS.txt):

| Variable Name               | Value                                                                    |
| --------------------------- | ------------------------------------------------------------------------ |
| `APP_NAME`                  | `nvaistat`                                                               |
| `APP_ENV`                   | `production`                                                             |
| `APP_KEY`                   | `base64:TRhxbxF89CizRUWfQiOsx0Rx8lq+jNiVTjLhcoCIJL8=`                    |
| `APP_DEBUG`                 | `false`                                                                  |
| `APP_URL`                   | `https://your-project-name.vercel.app` ⚠️ _Update this after deployment_ |
| `DB_CONNECTION`             | `pgsql`                                                                  |
| `DB_HOST`                   | `aws-0-eu-west-3.pooler.supabase.com`                                    |
| `DB_PORT`                   | `5432`                                                                   |
| `DB_DATABASE`               | `postgres`                                                               |
| `DB_USERNAME`               | `postgres.hrjjjaxmdvhabzbkwbgg`                                          |
| `DB_PASSWORD`               | **YOUR_ACTUAL_SUPABASE_PASSWORD**                                        |
| `SUPABASE_URL`              | `https://hrjjjaxmdvhabzbkwbgg.supabase.co`                               |
| `SUPABASE_ANON_KEY`         | `eyJhbGciOiJIUzI...` (full key from file)                                |
| `SUPABASE_SERVICE_ROLE_KEY` | `eyJhbGciOiJIUzI...` (full key from file)                                |
| `SESSION_DRIVER`            | `database`                                                               |
| `CACHE_DRIVER`              | `database`                                                               |
| `QUEUE_CONNECTION`          | `database`                                                               |

### **Step 6: Deploy**

1. After adding all environment variables
2. Click **"Deploy"**
3. Wait for build to complete (2-5 minutes)
4. 🎉 **Your site will be live!**

### **Step 7: Update App URL**

1. After deployment, copy your Vercel URL (e.g., `https://nvaistat-prod.vercel.app`)
2. Go to project **Settings** → **Environment Variables**
3. Edit `APP_URL` variable
4. Replace with your actual Vercel URL
5. **Redeploy**: Go to **Deployments** → Click **"..."** → **"Redeploy"**

### **Step 8: Configure Supabase URLs**

1. Go to [Supabase Dashboard](https://supabase.com/dashboard/project/hrjjjaxmdvhabzbkwbgg)
2. Go to **Authentication** → **Settings**
3. Update **Site URL** to: `https://your-vercel-url.vercel.app`
4. Add to **Additional Redirect URLs**:
    - `https://your-vercel-url.vercel.app/*`
    - `https://your-vercel-url.vercel.app/auth/callback`

---

## 📱 **Method 2: CLI Deployment**

### **Alternative: Quick CLI Deploy**

```bash
# Install Vercel CLI
npm install -g vercel

# Login
vercel login

# Deploy
vercel --prod

# Follow prompts and add environment variables later in dashboard
```

---

## 🧪 **Testing Your Deployment**

### **After deployment, test these:**

1. **Homepage Loading**: Visit your Vercel URL
2. **Database Connection**: Try to register a user
3. **Authentication**: Test login/logout
4. **File Upload**: Test file functionality
5. **Admin Features**: Test admin login

---

## 🚨 **Troubleshooting Common Issues**

### **"APP_KEY not set" Error**

-   Make sure you added `APP_KEY` environment variable
-   Value should be: `base64:TRhxbxF89CizRUWfQiOsx0Rx8lq+jNiVTjLhcoCIJL8=`

### **Database Connection Failed**

-   Verify `DB_PASSWORD` is correct
-   Check Supabase project is active
-   Ensure all DB\_\* variables are set correctly

### **Build Failed**

-   Check build logs in Vercel dashboard
-   Ensure `vercel-build.sh` is executable
-   Verify `composer.json` is valid

### **404 Errors**

-   Check `vercel.json` configuration
-   Ensure `api/index.php` exists
-   Verify routes in `vercel.json`

### **CORS Errors**

-   Update Supabase Site URL
-   Add your Vercel domain to redirect URLs
-   Check Supabase Auth settings

---

## 🔄 **Future Updates**

### **To deploy updates:**

1. **Push to GitHub**: `git push origin main`
2. **Automatic Deployment**: Vercel will automatically deploy
3. **Manual Redeploy**: Use Vercel dashboard if needed

---

## 📊 **Monitoring**

### **Check these after deployment:**

-   **Vercel Dashboard**: Monitor deployments and performance
-   **Supabase Dashboard**: Monitor database and auth
-   **Browser Console**: Check for JavaScript errors
-   **Network Tab**: Verify API calls work

---

## 🎯 **Success Checklist**

-   [ ] Database password obtained from Supabase
-   [ ] Project imported to Vercel from GitHub
-   [ ] All environment variables added
-   [ ] Successful deployment
-   [ ] APP_URL updated with actual domain
-   [ ] Supabase URLs configured
-   [ ] Homepage loads successfully
-   [ ] Database connection works
-   [ ] User registration/login works

---

## 📞 **Need Help?**

**If you encounter issues:**

1. Check Vercel build logs
2. Verify environment variables
3. Test locally first: `bash vercel-build.sh`
4. Check Supabase project status

**Your deployment should work perfectly if you follow each step!** 🎉
