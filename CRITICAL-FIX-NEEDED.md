# 🚨 CRITICAL: App Not Starting - Environment Variables Missing

## The Problem

Your app shows "Application failed to respond" because **Railway doesn't have the environment variables**.

Without these variables, Laravel cannot start.

---

## THE FIX (2 Minutes)

### Step 1: Go to Railway Dashboard

Open: https://railway.app

### Step 2: Click Your Laravel Service

You should see 2 services:
- **MySQL** (green/working)
- **MiniMat** or **Laravel** (red/failing) ← Click this one

### Step 3: Click "Variables" Tab

At the top menu, click **"Variables"**

### Step 4: Click "RAW EDITOR" Button

You'll see a button that says **"RAW EDITOR"** - click it

### Step 5: Copy These Variables

Copy EVERYTHING below (from APP_NAME to SESSION_SAME_SITE):

```
APP_NAME=MiniMat
APP_ENV=production
APP_KEY=base64:T9kkVNXNFa+mIS46SsczmW5Ltizpu+bH0Zy5k+kKmVw=
APP_DEBUG=false
APP_URL=https://minimat-production.up.railway.app
DB_CONNECTION=mysql
DB_HOST=yamanote.proxy.rlwy.net
DB_PORT=59771
DB_DATABASE=railway
DB_USERNAME=root
DB_PASSWORD=WyPIbklfTJprYBpdWtNMooiGFDchLuLM
BAKONG_API_URL=https://api-bakong.nbc.gov.kh
BAKONG_TOKEN=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJkYXRhIjp7ImlkIjoiYmE4M2QwZGEyYTYxNDg1MCJ9LCJpYXQiOjE3NjU5NzA4ODIsImV4cCI6MTc3Mzc0Njg4Mn0.Ws1pR87ayAm9lQtGepZBEuM_AGO_vC5neNaFuFSFBGE
TELEGRAM_BOT_TOKEN=8516986555:AAH3enGgrbjWPKnQRPwXRQHKVfGgqiQ2Rhw
TELEGRAM_CHAT_ID=-5216036558
MERCHANT_BAKONG_ID=deth_peak3@aclb
MERCHANT_NAME="PuDeth Smart-PAY"
MERCHANT_CITY="PHNOM PENH"
ACQUIRING_BANK="FAMILY PHONE"
GOOGLE_CLIENT_ID=your_google_client_id_from_COPY_TO_RAILWAY_txt
GOOGLE_CLIENT_SECRET=your_google_secret_from_COPY_TO_RAILWAY_txt
GOOGLE_REDIRECT_URI=https://minimat-production.up.railway.app/auth/google/callback
SESSION_DRIVER=file
SESSION_SECURE_COOKIE=true
SESSION_HTTP_ONLY=true
SESSION_SAME_SITE=lax
```

### Step 6: Paste in Railway

1. In the RAW EDITOR, **DELETE everything** (if anything is there)
2. **PASTE** what you copied above
3. Click **"Add"** or **"Save"** button

### Step 7: Wait for Redeploy

Railway will automatically redeploy (2-3 minutes)

Watch the progress in the "Deployments" tab

### Step 8: Test

After 3 minutes, visit: https://minimat-production.up.railway.app

You should see the login page!

---

## Why This Happens

Railway doesn't automatically copy your local `.env` file. You must manually add environment variables through the Railway dashboard.

Without `APP_KEY`, `DB_HOST`, etc., Laravel cannot start.

---

## Visual Guide

```
Railway Dashboard
    ↓
Click "MiniMat" service (the one that's failing)
    ↓
Click "Variables" tab at top
    ↓
Click "RAW EDITOR" button
    ↓
Paste the variables from above
    ↓
Click "Save"
    ↓
Wait 3 minutes
    ↓
App works! ✅
```

---

## Verification

After adding variables and waiting for redeploy:

1. **Health check:** https://minimat-production.up.railway.app/health.php
   - Should show: `"status": "ok"`

2. **Main app:** https://minimat-production.up.railway.app
   - Should show: Login page

3. **Login:**
   - Email: admin@minimat.com
   - Password: Admin@123

---

## Common Mistakes

❌ Adding variables one by one (too slow)
✅ Use RAW EDITOR and paste all at once

❌ Forgetting to click "Save"
✅ Always click "Save" after pasting

❌ Not waiting for redeploy
✅ Wait 2-3 minutes for Railway to redeploy

❌ Adding to wrong service (MySQL instead of Laravel)
✅ Make sure you're in the Laravel/MiniMat service

---

## Still Not Working?

### Check 1: Are Variables Actually There?

Go to Variables tab and verify you see:
- APP_KEY
- APP_ENV
- DB_HOST
- DB_PORT
- etc.

If not, they didn't save. Try again.

### Check 2: Check Deployment Logs

1. Click "Deployments" tab
2. Click latest deployment
3. Look for errors

Common errors:
- "APP_KEY is not set" → Variables didn't save
- "Connection refused" → Database credentials wrong
- "Class not found" → Build issue (redeploy)

### Check 3: Manual Redeploy

1. Go to "Settings" tab
2. Scroll down
3. Click "Redeploy"

---

## I Cannot DO THIS FOR YOU

I cannot access your Railway dashboard. You MUST add the environment variables yourself through the Railway web interface.

**This is the ONLY thing preventing your app from working.**

---

## Summary

1. ✅ Code is ready
2. ✅ Database is ready
3. ✅ All fixes are deployed
4. ❌ **Environment variables are NOT in Railway** ← YOU MUST FIX THIS

**Time needed: 2 minutes**

**Steps: 8 simple steps above**

---

**DO THIS NOW:**
1. Open Railway dashboard
2. Click your Laravel service
3. Variables → RAW EDITOR
4. Paste the variables from above
5. Save
6. Wait 3 minutes
7. Your app will work!

**This is the ONLY thing you need to do!** 🚀
