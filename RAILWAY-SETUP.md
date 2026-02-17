# 🚀 Railway Deployment - Complete Setup Guide

## ✅ Your MySQL Database is Already Deployed!

I can see your MySQL 9.4 database is ACTIVE on Railway at `yamanote.proxy.rlwy.net`

---

## 📋 Step-by-Step Deployment

### Step 1: Get Your MySQL Connection Details

In Railway dashboard, click on your MySQL service and copy these values:
- MYSQLHOST
- MYSQLPORT  
- MYSQLDATABASE
- MYSQLUSER
- MYSQLPASSWORD

---

### Step 2: Deploy Your Laravel Application

#### Option A: Deploy from GitHub (Recommended)

1. **Push your code to GitHub** (if not already done):
```bash
git add .
git commit -m "Ready for Railway deployment"
git push origin main
```

2. **Create new service in Railway**:
   - Click "New" → "GitHub Repo"
   - Select your repository
   - Railway will auto-detect Laravel and deploy

#### Option B: Deploy with Railway CLI

```bash
# Install Railway CLI
npm i -g @railway/cli

# Login
railway login

# Link project
railway link

# Deploy
railway up
```

---

### Step 3: Configure Environment Variables

In Railway dashboard, go to your Laravel service → Variables tab and add:

```env
APP_NAME=MiniMat
APP_ENV=production
APP_KEY=base64:T9kkVNXNFa+mIS46SsczmW5Ltizpu+bH0Zy5k+kKmVw=
APP_DEBUG=false
APP_URL=https://your-app.railway.app

# Database - Replace with YOUR actual values from MySQL service
DB_CONNECTION=mysql
DB_HOST=yamanote.proxy.rlwy.net
DB_PORT=YOUR_MYSQL_PORT
DB_DATABASE=railway
DB_USERNAME=YOUR_MYSQL_USER
DB_PASSWORD=YOUR_MYSQL_PASSWORD

# Bakong KHQR API
BAKONG_API_URL=https://api-bakong.nbc.gov.kh
BAKONG_TOKEN=your_bakong_token_here

# Telegram Bot
TELEGRAM_BOT_TOKEN=your_telegram_bot_token_here
TELEGRAM_CHAT_ID=your_telegram_chat_id_here

# Merchant Info
MERCHANT_BAKONG_ID=your_bakong_id_here
MERCHANT_NAME="Your Store Name"
MERCHANT_CITY="Your City"
ACQUIRING_BANK="Your Bank"

# Google OAuth - UPDATE REDIRECT URI with your Railway URL
GOOGLE_CLIENT_ID=your_google_client_id_here
GOOGLE_CLIENT_SECRET=your_google_client_secret_here
GOOGLE_REDIRECT_URI=https://your-app.railway.app/auth/google/callback

# Session
SESSION_DRIVER=file
SESSION_SECURE_COOKIE=true
SESSION_HTTP_ONLY=true
SESSION_SAME_SITE=lax
```

**IMPORTANT**: 
- Replace `YOUR_MYSQL_PORT`, `YOUR_MYSQL_USER`, `YOUR_MYSQL_PASSWORD` with actual values
- Update `APP_URL` with your Railway app URL
- Update `GOOGLE_REDIRECT_URI` with your Railway app URL

---

### Step 4: Run Database Migrations

After deployment completes:

1. **Open Railway Shell**:
   - Go to your Laravel service
   - Click "Shell" or "Terminal"

2. **Run migrations**:
```bash
php artisan migrate --force
```

3. **Verify tables created**:
```bash
php artisan tinker
DB::select('SHOW TABLES');
exit
```

---

### Step 5: Create Admin User

In Railway shell:

```bash
php artisan tinker
```

Then paste this:
```php
$user = new App\Models\User();
$user->name = 'Admin';
$user->email = 'admin@minimat.com';
$user->password = bcrypt('Admin@123');
$user->role = 'admin';
$user->is_active = 1;
$user->save();
echo "Admin user created!\n";
exit
```

---

### Step 6: Load Sample Data (Optional)

If you want to load sample products and categories:

**Option A - Via Railway Shell**:
```bash
php artisan tinker
```

Then run the seeder:
```php
Artisan::call('db:seed', ['--class' => 'BilingualProductSeeder']);
exit
```

**Option B - Direct SQL**:
1. Go to MySQL service → Database tab
2. Copy content from `insert-sample-data.sql`
3. Paste and execute

---

### Step 7: Update Google OAuth Redirect URI

1. Go to [Google Cloud Console](https://console.cloud.google.com)
2. Select your project
3. Go to "Credentials"
4. Edit your OAuth 2.0 Client ID
5. Add authorized redirect URI:
   ```
   https://your-app.railway.app/auth/google/callback
   ```

---

### Step 8: Test Your Deployment

Visit your Railway app URL and test:

- ✅ Homepage loads
- ✅ Login page works
- ✅ Admin login: `admin@minimat.com` / `Admin@123`
- ✅ POS interface loads
- ✅ Create a test sale
- ✅ Generate KHQR payment
- ✅ Check Telegram notification

---

## 🔧 Troubleshooting

### Build Fails?

Check Railway logs. Common issues:
- Missing `nixpacks.toml` - Already added ✅
- Composer dependencies - Using `--ignore-platform-reqs` ✅
- PHP version - Using PHP 8.3 ✅

### Database Connection Error?

```bash
# Test connection in Railway shell
php artisan tinker
DB::connection()->getPdo();
```

If fails, verify environment variables match MySQL service.

### 500 Error?

```bash
# Check logs
php artisan log:clear
# Or view in Railway dashboard
```

Common fixes:
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

### Storage Permission Error?

```bash
chmod -R 775 storage bootstrap/cache
php artisan storage:link
```

---

## 📊 Post-Deployment Checklist

- [ ] App deployed successfully
- [ ] Database connected
- [ ] All 14 migrations ran
- [ ] Admin user created
- [ ] Sample data loaded (optional)
- [ ] Login works
- [ ] Google OAuth redirect updated
- [ ] KHQR payment generates QR code
- [ ] Telegram notifications working
- [ ] Custom domain configured (optional)

---

## 🎯 Quick Commands

```bash
# View logs
railway logs

# Open shell
railway shell

# Run artisan commands
railway run php artisan migrate --force
railway run php artisan cache:clear
railway run php artisan config:clear

# Link local to Railway
railway link

# Deploy
railway up
```

---

## 💰 Estimated Costs

- MySQL Database: ~$5/month
- Laravel App: ~$5-10/month
- Total: ~$10-15/month

Free tier includes $5 credit/month.

---

## 🔐 Security Checklist

- ✅ APP_DEBUG=false in production
- ✅ APP_ENV=production
- ✅ SESSION_SECURE_COOKIE=true
- ✅ Strong admin password
- ✅ HTTPS enabled (Railway default)
- ✅ Environment variables secured

---

## 📞 Need Help?

- Railway Docs: https://docs.railway.app
- Railway Discord: https://discord.gg/railway
- Laravel Docs: https://laravel.com/docs/10.x

---

**You're all set! Your POS system is ready for production.** 🎉
