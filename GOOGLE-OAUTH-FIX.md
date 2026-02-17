# 🔧 Fix Google OAuth - Error 400: redirect_uri_mismatch

## The Problem

Google is showing: **"Error 400: redirect_uri_mismatch"**

This means the redirect URI in your Google Cloud Console doesn't match your Railway app URL.

---

## ✅ THE FIX (5 Minutes)

### Step 1: Go to Google Cloud Console

Open: https://console.cloud.google.com

### Step 2: Select Your Project

Make sure you're in the correct project (the one with your OAuth credentials)

### Step 3: Go to Credentials

1. Click the menu (☰) in the top left
2. Go to **"APIs & Services"**
3. Click **"Credentials"**

### Step 4: Edit Your OAuth 2.0 Client ID

1. You'll see a list of credentials
2. Find your **OAuth 2.0 Client ID** (the one you're using)
3. Click the **pencil icon** (✏️) to edit it

### Step 5: Add Railway Redirect URI

Under **"Authorized redirect URIs"**, click **"+ ADD URI"**

Add this EXACT URL:
```
https://minimat-production.up.railway.app/auth/google/callback
```

**IMPORTANT:** 
- Must be HTTPS (not HTTP)
- Must end with `/auth/google/callback`
- No trailing slash
- Copy it exactly as shown above

### Step 6: Save

Click **"SAVE"** at the bottom

### Step 7: Wait 1-2 Minutes

Google needs a moment to propagate the changes (usually instant, but can take up to 2 minutes)

### Step 8: Test

1. Go to: https://minimat-production.up.railway.app/login
2. Click **"Sign in with Google"**
3. It should work now! ✅

---

## 📋 What Should Be in Google Console

Your OAuth 2.0 Client should have these redirect URIs:

✅ `http://localhost:8000/auth/google/callback` (for local development)
✅ `https://minimat-production.up.railway.app/auth/google/callback` (for Railway)

---

## 🔍 Verify Your Configuration

Your current Railway environment has:
- **GOOGLE_CLIENT_ID:** 298504334910-cagsl2v0d900onh9e5qpg2ftservda1f.apps.googleusercontent.com
- **GOOGLE_REDIRECT_URI:** https://minimat-production.up.railway.app/auth/google/callback

Make sure the redirect URI in Google Console EXACTLY matches the one above.

---

## 🆘 Still Not Working?

### Check 1: Verify the URL is Correct

The redirect URI must be:
```
https://minimat-production.up.railway.app/auth/google/callback
```

Common mistakes:
- ❌ `http://` instead of `https://`
- ❌ Missing `/auth/google/callback`
- ❌ Extra trailing slash
- ❌ Wrong domain

### Check 2: Make Sure You Saved

After adding the URI, you MUST click "SAVE" at the bottom of the page.

### Check 3: Wait a Moment

Sometimes Google takes 1-2 minutes to update. Wait and try again.

### Check 4: Clear Browser Cache

If it still doesn't work:
1. Clear your browser cache
2. Or use incognito/private mode
3. Try again

---

## 📸 Visual Guide

When you edit your OAuth Client in Google Console, you should see:

```
Authorized redirect URIs
┌─────────────────────────────────────────────────────────────┐
│ http://localhost:8000/auth/google/callback                  │
│ https://minimat-production.up.railway.app/auth/google/cal...│
└─────────────────────────────────────────────────────────────┘
                                                    [+ ADD URI]
```

---

## ✅ Success Criteria

After fixing, you should:
1. Click "Sign in with Google"
2. See Google's login page (not an error)
3. Select your Google account
4. Get redirected back to your app
5. Be logged in!

---

## 🎯 Quick Checklist

- [ ] Opened Google Cloud Console
- [ ] Selected correct project
- [ ] Went to APIs & Services → Credentials
- [ ] Clicked edit on OAuth 2.0 Client ID
- [ ] Added: `https://minimat-production.up.railway.app/auth/google/callback`
- [ ] Clicked SAVE
- [ ] Waited 1-2 minutes
- [ ] Tested Google login
- [ ] ✅ IT WORKS!

---

## 📞 Alternative - Use Email/Password

While you're setting this up, you can still login with:
- **Email:** admin@minimat.com
- **Password:** Admin@123

---

**This is a Google Cloud Console configuration issue, not a code issue. Just add the redirect URI and it will work immediately!** 🚀

**Time needed: 2 minutes**
