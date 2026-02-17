# ✅ Railway Deployment Checklist

Use this checklist to ensure smooth deployment to Railway.

---

## 📦 Pre-Deployment (Local)

- [x] All migrations created (14 migrations)
- [x] Local database tested and working
- [x] Sample data available
- [x] Git repository initialized
- [x] Code pushed to GitHub
- [x] nixpacks.toml configured
- [x] Procfile created
- [x] .env.railway template created
- [x] Deployment scripts ready

---

## 🚀 Railway Setup

### 1. MySQL Database (Already Done ✅)

- [x] MySQL 9.4 deployed
- [x] Database is ACTIVE
- [x] Connection details available
- [ ] Copy MYSQLHOST, MYSQLPORT, MYSQLDATABASE, MYSQLUSER, MYSQLPASSWORD

### 2. Deploy Laravel Application

- [ ] Go to https://railway.app
- [ ] Click "New Project"
- [ ] Select "Deploy from GitHub repo"
- [ ] Choose your MiniMat repository
- [ ] Wait for initial deployment

### 3. Configure Environment Variables

- [ ] Go to Laravel service → Variables tab
- [ ] Click "Raw Editor"
- [ ] Copy content from `.env.railway` file
- [ ] Replace placeholders:
  - [ ] DB_HOST (from MySQL service)
  - [ ] DB_PORT (from MySQL service)
  - [ ] DB_DATABASE (from MySQL service)
  - [ ] DB_USERNAME (from MySQL service)
  - [ ] DB_PASSWORD (from MySQL service)
  - [ ] APP_URL (your Railway app URL)
  - [ ] GOOGLE_REDIRECT_URI (your Railway app URL + /auth/google/callback)
- [ ] Save variables
- [ ] Wait for automatic redeploy

### 4. Run Database Migrations

- [ ] Open Railway shell (click "Shell" button)
- [ ] Run: `php artisan migrate --force`
- [ ] Verify: All 14 migrations should run successfully
- [ ] Check tables: `php artisan tinker` then `DB::select('SHOW TABLES');`

### 5. Create Admin User

Option A - Using script:
- [ ] In Railway shell, run: `php create-admin.php`
- [ ] Note the credentials displayed

Option B - Manual:
- [ ] In Railway shell, run: `php artisan tinker`
- [ ] Paste and run:
```php
$user = new App\Models\User();
$user->name = 'Admin';
$user->email = 'admin@minimat.com';
$user->password = bcrypt('Admin@123');
$user->role = 'admin';
$user->is_active = 1;
$user->save();
echo "Admin created!\n";
exit
```

### 6. Load Sample Data (Optional)

Option A - Via Seeder:
- [ ] In Railway shell: `php artisan db:seed --class=BilingualProductSeeder`

Option B - Via SQL:
- [ ] Go to MySQL service → Database tab
- [ ] Copy content from `insert-sample-data.sql`
- [ ] Paste and execute

### 7. Update Google OAuth

- [ ] Go to https://console.cloud.google.com
- [ ] Select your project
- [ ] Navigate to Credentials
- [ ] Edit OAuth 2.0 Client ID
- [ ] Add authorized redirect URI: `https://your-app.railway.app/auth/google/callback`
- [ ] Save

---

## 🧪 Testing

### Basic Tests

- [ ] Visit your Railway app URL
- [ ] Homepage loads without errors
- [ ] Login page accessible
- [ ] Login with admin credentials works
- [ ] Dashboard displays correctly

### Feature Tests

- [ ] POS interface loads
- [ ] Products display correctly
- [ ] Can add products to cart
- [ ] Can create a sale
- [ ] KHQR QR code generates
- [ ] Telegram notification sent (check your Telegram)
- [ ] Google OAuth login works
- [ ] Admin panel accessible
- [ ] Can manage products
- [ ] Can manage categories
- [ ] Can view sales history

### Security Tests

- [ ] HTTPS enabled (Railway default)
- [ ] APP_DEBUG is false
- [ ] APP_ENV is production
- [ ] Sensitive routes require authentication
- [ ] Admin routes require admin role

---

## 🔧 Troubleshooting

### Build Fails

- [ ] Check Railway build logs
- [ ] Verify nixpacks.toml is in root
- [ ] Ensure composer.json is valid
- [ ] Try rebuilding: Settings → Redeploy

### Database Connection Error

- [ ] Verify environment variables match MySQL service
- [ ] Test connection: `php artisan tinker` then `DB::connection()->getPdo();`
- [ ] Check MySQL service is running
- [ ] Verify database credentials

### 500 Internal Server Error

- [ ] Check Railway logs
- [ ] Clear cache: `php artisan config:clear`
- [ ] Check storage permissions
- [ ] Verify APP_KEY is set
- [ ] Check Laravel logs in Railway shell: `tail storage/logs/laravel.log`

### Migration Fails

- [ ] Check database connection first
- [ ] Run migrations one by one to identify issue
- [ ] Check if tables already exist
- [ ] Verify migration files are correct

### Google OAuth Not Working

- [ ] Verify GOOGLE_REDIRECT_URI matches Google Console
- [ ] Check GOOGLE_CLIENT_ID and GOOGLE_CLIENT_SECRET
- [ ] Ensure redirect URI is added in Google Console
- [ ] Check APP_URL is correct

---

## 📊 Post-Deployment

### Performance

- [ ] Test app response time
- [ ] Monitor Railway metrics
- [ ] Check database query performance
- [ ] Consider adding Redis for caching (optional)

### Monitoring

- [ ] Set up error notifications
- [ ] Monitor Railway logs regularly
- [ ] Check Laravel logs: `storage/logs/laravel.log`
- [ ] Monitor database usage

### Security

- [ ] Change default admin password
- [ ] Review user permissions
- [ ] Enable 2FA (if implemented)
- [ ] Regular security updates
- [ ] Monitor failed login attempts

### Backup

- [ ] Set up Railway database backups
- [ ] Export database regularly
- [ ] Keep code in GitHub
- [ ] Document any manual changes

---

## 💰 Cost Management

- [ ] Monitor Railway usage
- [ ] Check monthly costs
- [ ] Optimize resource usage
- [ ] Consider upgrading plan if needed

**Estimated Monthly Cost:**
- MySQL: ~$5
- Laravel App: ~$5-10
- Total: ~$10-15

---

## 📞 Support Resources

- Railway Docs: https://docs.railway.app
- Railway Discord: https://discord.gg/railway
- Laravel Docs: https://laravel.com/docs/10.x
- Project README: README.md
- Deployment Guide: RAILWAY-SETUP.md

---

## ✅ Deployment Complete!

Once all items are checked, your application is successfully deployed and ready for production use.

**Admin Login:**
- URL: https://your-app.railway.app/login
- Email: admin@minimat.com
- Password: Admin@123

**⚠️ IMPORTANT:** Change the default password immediately after first login!

---

**Last Updated:** February 17, 2026
**Status:** Ready for Deployment
