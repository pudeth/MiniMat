# 🚀 DEPLOY NOW - Quick Guide

Your MySQL database is ready! Follow these exact steps:

---

## ✅ Step 1: Deploy Laravel App to Railway (5 minutes)

1. Go to **https://railway.app**
2. Click **"New Project"**
3. Select **"Deploy from GitHub repo"**
4. Choose **"pudeth/MiniMat"** repository
5. Wait for initial deployment (3-5 minutes)

---

## ✅ Step 2: Add Environment Variables (3 minutes)

1. In Railway, click on your **Laravel service** (not MySQL)
2. Go to **"Variables"** tab
3. Click **"Raw Editor"** button
4. Open the file **`.env.railway.complete`** in your editor
5. **Copy EVERYTHING** from that file
6. **Paste** into Railway Raw Editor
7. Click **"Add"** or **"Save"**
8. Railway will automatically redeploy (wait 2-3 minutes)

---

## ✅ Step 3: Get Your App URL (1 minute)

1. In Railway, click on your Laravel service
2. Go to **"Settings"** tab
3. Scroll to **"Domains"** section
4. Click **"Generate Domain"**
5. Copy the URL (something like: `minimat-production-xxxx.up.railway.app`)

---

## ✅ Step 4: Update URLs (2 minutes)

1. Go back to **"Variables"** tab
2. Find and update these two variables:
   - `APP_URL` = your Railway URL (from step 3)
   - `GOOGLE_REDIRECT_URI` = your Railway URL + `/auth/google/callback`
3. Click **"Save"**
4. Wait for redeploy

---

## ✅ Step 5: Run Database Migrations (2 minutes)

1. In Railway, click on your Laravel service
2. Click **"Shell"** or **"Terminal"** button (top right)
3. Wait for shell to open
4. Run this command:
```bash
php artisan migrate --force
```
5. You should see: "Migration table created successfully" and all 14 migrations running

---

## ✅ Step 6: Create Admin User (1 minute)

In the same Railway shell, run:
```bash
php create-admin.php
```

You should see:
```
✅ Admin user created successfully!
Email: admin@minimat.com
Password: Admin@123
```

---

## ✅ Step 7: Test Your App (2 minutes)

1. Open your Railway URL in browser
2. You should see the login page
3. Login with:
   - **Email:** admin@minimat.com
   - **Password:** Admin@123
4. You should see the dashboard!

---

## ✅ Step 8: Update Google OAuth (3 minutes)

1. Go to **https://console.cloud.google.com**
2. Select your project
3. Go to **"Credentials"**
4. Click on your OAuth 2.0 Client ID
5. Under **"Authorized redirect URIs"**, add:
   ```
   https://your-railway-url.up.railway.app/auth/google/callback
   ```
6. Click **"Save"**

---

## ✅ Step 9: Load Sample Data (Optional - 1 minute)

If you want sample products and categories, in Railway shell:
```bash
php artisan db:seed --class=BilingualProductSeeder
```

---

## 🎉 DONE!

Your POS system is now live at: **https://your-railway-url.up.railway.app**

**Login:**
- Email: admin@minimat.com
- Password: Admin@123

**⚠️ IMPORTANT:** Change the password after first login!

---

## 🔧 Troubleshooting

### Build Fails?
- Check Railway logs for errors
- Verify all files are pushed to GitHub
- Try redeploying

### Database Connection Error?
- Verify environment variables are correct
- Check MySQL service is running
- Test connection: `php artisan tinker` then `DB::connection()->getPdo();`

### 500 Error?
- Check Railway logs
- Run: `php artisan config:clear`
- Run: `php artisan cache:clear`

### Can't Login?
- Make sure you ran `php create-admin.php`
- Check if migrations ran successfully
- Verify APP_KEY is set in environment variables

---

## 📊 Your Setup Summary

**MySQL Database:**
- ✅ Host: yamanote.proxy.rlwy.net
- ✅ Port: 59771
- ✅ Database: railway
- ✅ Status: ACTIVE

**Laravel App:**
- Repository: https://github.com/pudeth/MiniMat
- Environment: Production
- PHP Version: 8.3

**Features:**
- ✅ POS System
- ✅ KHQR Payment
- ✅ Telegram Notifications
- ✅ Google OAuth
- ✅ Multi-language (EN/KH)
- ✅ Customer Loyalty Points

---

**Total Time: ~20 minutes**

**Let's go! Start with Step 1.** 🚀
