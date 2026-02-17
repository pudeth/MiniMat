# Railway/Cloud Platform Deployment Guide

## Quick Fix for "Railpack" Error

The error occurs because the platform is misdetecting your Laravel project. The configuration files have been added to fix this.

## Files Added
- ✅ `nixpacks.toml` - Tells the platform this is a PHP/Laravel project
- ✅ `Procfile` - Defines how to start the application
- ✅ `railway.json` - Railway-specific configuration
- ✅ `Dockerfile` - Alternative Docker-based deployment
- ✅ `nginx.conf` - Production web server configuration

## Deployment Steps

### Step 1: Configure Environment Variables

In your Railway/platform dashboard, add these environment variables:

```env
APP_NAME=MiniMat
APP_ENV=production
APP_KEY=base64:YOUR_KEY_HERE
APP_DEBUG=false
APP_URL=https://your-app.railway.app

# Database (Railway will provide these)
DB_CONNECTION=mysql
DB_HOST=${MYSQLHOST}
DB_PORT=${MYSQLPORT}
DB_DATABASE=${MYSQLDATABASE}
DB_USERNAME=${MYSQLUSER}
DB_PASSWORD=${MYSQLPASSWORD}

# Bakong KHQR API
BAKONG_API_URL=https://api-bakong.nbc.gov.kh
BAKONG_TOKEN=your_bakong_token

# Telegram Bot
TELEGRAM_BOT_TOKEN=your_telegram_bot_token
TELEGRAM_CHAT_ID=your_telegram_chat_id

# Merchant Info
MERCHANT_BAKONG_ID=your_bakong_id
MERCHANT_NAME="Your Store Name"
MERCHANT_CITY="Your City"
ACQUIRING_BANK="Your Bank"

# Google OAuth
GOOGLE_CLIENT_ID=your_google_client_id
GOOGLE_CLIENT_SECRET=your_google_client_secret
GOOGLE_REDIRECT_URI=https://your-app.railway.app/auth/google/callback

# Session
SESSION_DRIVER=file
SESSION_SECURE_COOKIE=true
SESSION_HTTP_ONLY=true
```

### Step 2: Generate APP_KEY

Run locally and copy the key:
```bash
php artisan key:generate --show
```

Or generate online: https://generate-random.org/laravel-key-generator

### Step 3: Add MySQL Database

1. In Railway dashboard, click "New" → "Database" → "Add MySQL"
2. Railway will automatically set the database environment variables
3. Note: Use the variable references like `${MYSQLHOST}` in your env vars

### Step 4: Push to GitHub

```bash
git add .
git commit -m "Add Railway deployment configuration"
git push origin main
```

### Step 5: Deploy on Railway

1. Go to [Railway.app](https://railway.app)
2. Click "New Project"
3. Select "Deploy from GitHub repo"
4. Choose your `MiniMat` repository
5. Railway will automatically detect the configuration and deploy

### Step 6: Run Migrations

After first deployment, open the Railway shell and run:

```bash
php artisan migrate --force
```

Or add a deploy command in Railway settings:
```bash
php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=$PORT
```

### Step 7: Create Admin User

In Railway shell:
```bash
php artisan tinker
```

Then:
```php
$user = new App\Models\User();
$user->name = 'Admin';
$user->email = 'admin@example.com';
$user->password = bcrypt('your-secure-password');
$user->role = 'admin';
$user->save();
exit
```

## Alternative: Docker Deployment

If you prefer Docker:

1. Railway will automatically detect the Dockerfile
2. Or manually select "Docker" as build method
3. Set environment variables as above
4. Deploy

## Troubleshooting

### Build Still Failing?

1. **Check Builder**: In Railway settings, ensure builder is set to "Nixpacks" or "Docker"
2. **Check Logs**: View build logs for specific errors
3. **Verify Files**: Ensure `nixpacks.toml` and `Procfile` are in root directory

### Database Connection Issues?

```bash
# In Railway shell, test connection:
php artisan tinker
DB::connection()->getPdo();
```

### Storage Permissions?

Railway handles this automatically, but if needed:
```bash
chmod -R 775 storage bootstrap/cache
```

### App Not Starting?

Check the start command in Railway settings:
```bash
php artisan serve --host=0.0.0.0 --port=$PORT
```

## Post-Deployment Checklist

- [ ] App loads successfully
- [ ] Database connected
- [ ] Migrations run
- [ ] Admin user created
- [ ] Login works
- [ ] Google OAuth configured (update redirect URI)
- [ ] KHQR payment test
- [ ] Telegram notifications test

## Custom Domain Setup

1. In Railway, go to Settings → Domains
2. Add your custom domain
3. Update DNS records as instructed
4. Update `APP_URL` and `GOOGLE_REDIRECT_URI` environment variables

## Monitoring

- View logs in Railway dashboard
- Check Laravel logs: `storage/logs/laravel.log`
- Monitor database usage
- Set up alerts for errors

## Scaling

Railway automatically scales based on usage. For manual scaling:
- Adjust replicas in settings
- Upgrade plan for more resources
- Consider Redis for caching (add Redis service)

## Cost Optimization

- Free tier: $5 credit/month
- Estimated cost: $5-20/month depending on usage
- Database: ~$5/month
- App: ~$5-10/month

## Support

- Railway Docs: https://docs.railway.app
- Railway Discord: https://discord.gg/railway
- Laravel Docs: https://laravel.com/docs

## Quick Commands Reference

```bash
# View logs
railway logs

# Run migrations
railway run php artisan migrate --force

# Clear cache
railway run php artisan cache:clear

# Access shell
railway shell

# Link local project
railway link
```

---

**Your deployment should now work!** 🚀

If you still see the Railpack error, try:
1. Delete the service in Railway
2. Create new service
3. Ensure `nixpacks.toml` is committed to GitHub
4. Redeploy
