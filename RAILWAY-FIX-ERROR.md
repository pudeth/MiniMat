# 🔧 Fix Railway "Application failed to respond" Error

## Quick Fixes

### Fix 1: Check Environment Variables (Most Common)

1. Go to Railway Dashboard → Your Laravel Service → Variables
2. Make sure you have ALL these variables set:

**Required:**
```
APP_KEY=base64:T9kkVNXNFa+mIS46SsczmW5Ltizpu+bH0Zy5k+kKmVw=
APP_ENV=production
APP_DEBUG=false
DB_CONNECTION=mysql
DB_HOST=yamanote.proxy.rlwy.net
DB_PORT=59771
DB_DATABASE=railway
DB_USERNAME=root
DB_PASSWORD=WyPIbklfTJprYBpdWtNMooiGFDchLuLM
```

3. Click "Save" and wait for redeploy

### Fix 2: Check Build Logs

1. Go to Railway Dashboard → Your Laravel Service
2. Click on "Deployments" tab
3. Click on the latest deployment
4. Check the build logs for errors

Common errors:
- Missing APP_KEY
- Database connection failed
- Composer install failed
- PHP version mismatch

### Fix 3: Redeploy

1. Go to Railway Dashboard → Your Laravel Service
2. Click "Settings"
3. Scroll down and click "Redeploy"

### Fix 4: Check Start Command

The start command should be:
```
bash start.sh
```

To verify:
1. Go to Settings → Start Command
2. Should show: `bash start.sh`
3. If different, update and redeploy

---

## Detailed Troubleshooting

### Step 1: Verify Database Connection

In Railway shell, run:
```bash
php artisan tinker
DB::connection()->getPdo();
exit
```

If this fails, your database credentials are wrong.

### Step 2: Check APP_KEY

In Railway shell, run:
```bash
php artisan key:generate --show
```

Copy the output and add it to your environment variables as `APP_KEY`.

### Step 3: Clear All Caches

In Railway shell, run:
```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

### Step 4: Check File Permissions

In Railway shell, run:
```bash
chmod -R 775 storage bootstrap/cache
ls -la storage
```

### Step 5: Test the Application

In Railway shell, run:
```bash
php artisan serve --host=0.0.0.0 --port=8000
```

If this works, the issue is with the start command.

---

## Common Issues & Solutions

### Issue: "Class 'App\...' not found"

**Solution:**
```bash
composer dump-autoload
php artisan config:clear
```

### Issue: "No application encryption key has been specified"

**Solution:**
Add `APP_KEY` to environment variables:
```
APP_KEY=base64:T9kkVNXNFa+mIS46SsczmW5Ltizpu+bH0Zy5k+kKmVw=
```

### Issue: "SQLSTATE[HY000] [2002] Connection refused"

**Solution:**
Check database credentials in environment variables match your MySQL service.

### Issue: "The stream or file could not be opened"

**Solution:**
```bash
chmod -R 775 storage bootstrap/cache
```

### Issue: "419 Page Expired" or CSRF Token Mismatch

**Solution:**
1. Check `APP_URL` matches your Railway domain
2. Clear cache: `php artisan config:clear`

---

## Environment Variables Checklist

Copy this to Railway Variables (Raw Editor):

```env
APP_NAME=MiniMat
APP_ENV=production
APP_KEY=base64:T9kkVNXNFa+mIS46SsczmW5Ltizpu+bH0Zy5k+kKmVw=
APP_DEBUG=false
APP_URL=https://your-app.railway.app

DB_CONNECTION=mysql
DB_HOST=yamanote.proxy.rlwy.net
DB_PORT=59771
DB_DATABASE=railway
DB_USERNAME=root
DB_PASSWORD=WyPIbklfTJprYBpdWtNMooiGFDchLuLM

BAKONG_API_URL=https://api-bakong.nbc.gov.kh
BAKONG_TOKEN=your_token

TELEGRAM_BOT_TOKEN=your_token
TELEGRAM_CHAT_ID=your_chat_id

MERCHANT_BAKONG_ID=your_id
MERCHANT_NAME="Your Store"
MERCHANT_CITY="Your City"
ACQUIRING_BANK="Your Bank"

GOOGLE_CLIENT_ID=your_client_id
GOOGLE_CLIENT_SECRET=your_secret
GOOGLE_REDIRECT_URI=https://your-app.railway.app/auth/google/callback

SESSION_DRIVER=file
SESSION_SECURE_COOKIE=true
SESSION_HTTP_ONLY=true
SESSION_SAME_SITE=lax
```

**Don't forget to:**
1. Replace `your-app.railway.app` with your actual Railway domain
2. Add your actual API tokens and credentials
3. Click "Save"

---

## Still Not Working?

### Option 1: Check Railway Logs

```bash
# In Railway dashboard
Click on your service → Logs tab
Look for error messages
```

### Option 2: Use Railway CLI

```bash
# Install Railway CLI
npm i -g @railway/cli

# Login
railway login

# Link to your project
railway link

# View logs
railway logs

# Open shell
railway shell
```

### Option 3: Start Fresh

1. Delete the current Railway service
2. Create new service from GitHub
3. Add environment variables
4. Deploy

---

## Quick Test Script

Save this as `test-railway.php` and run in Railway shell:

```php
<?php
echo "PHP Version: " . phpversion() . "\n";
echo "Laravel: " . app()->version() . "\n";
echo "Environment: " . env('APP_ENV') . "\n";
echo "Debug: " . (env('APP_DEBUG') ? 'true' : 'false') . "\n";
echo "Database: " . env('DB_CONNECTION') . "\n";

try {
    DB::connection()->getPdo();
    echo "✅ Database connected\n";
} catch (Exception $e) {
    echo "❌ Database error: " . $e->getMessage() . "\n";
}
```

---

## Need More Help?

1. Check Railway logs for specific error messages
2. Share the error message for more specific help
3. Visit Railway Discord: https://discord.gg/railway
4. Check Laravel logs: `storage/logs/laravel.log`

---

**Most common fix:** Add all environment variables from `.env.railway.complete` and redeploy!
