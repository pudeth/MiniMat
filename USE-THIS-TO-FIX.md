# 🔧 USE THIS TO FIX YOUR APP

Your app shows "Application failed to respond" because environment variables are missing.

---

## ✅ EASIEST METHOD: Use Railway CLI Script

### Step 1: Install Railway CLI (if not installed)

Open PowerShell or Command Prompt and run:
```bash
npm install -g @railway/cli
```

### Step 2: Run the Setup Script

**Option A - PowerShell (Recommended):**
```powershell
.\railway-setup-env.ps1
```

**Option B - Command Prompt:**
```cmd
railway-setup-env.bat
```

### Step 3: Follow the prompts

The script will:
1. Login to Railway (opens browser)
2. Link to your project
3. Set all environment variables automatically
4. Trigger redeploy

### Step 4: Wait 3 minutes

Your app will be live at: https://minimat-production.up.railway.app

---

## 🌐 ALTERNATIVE: Use Railway Web Interface

If you don't want to use CLI:

### Step 1: Copy Environment Variables

Open `COPY-TO-RAILWAY.txt` and copy everything from `APP_NAME` to `SESSION_SAME_SITE`

### Step 2: Go to Railway

1. Open https://railway.app
2. Click your project
3. Click your Laravel service (NOT MySQL)
4. Click "Variables" tab
5. Click "RAW EDITOR" button
6. Paste what you copied
7. Click "Save"

### Step 3: Wait 3 minutes

Railway will redeploy automatically.

---

## 🎯 What Each Method Does

Both methods do the SAME thing - they add environment variables to Railway.

**CLI Method:**
- ✅ Automated
- ✅ Faster
- ✅ Less chance of error
- ❌ Requires npm/node installed

**Web Method:**
- ✅ No installation needed
- ✅ Visual interface
- ❌ Manual copy/paste
- ❌ More steps

---

## 📋 Quick Start

**If you have npm installed:**
```bash
npm install -g @railway/cli
.\railway-setup-env.ps1
```

**If you don't have npm:**
Use the web interface method above.

---

## ✅ How to Know It Worked

After 3 minutes:

1. Visit: https://minimat-production.up.railway.app
2. You should see the LOGIN PAGE (not error)
3. Login with:
   - Email: admin@minimat.com
   - Password: Admin@123

---

## 🆘 Troubleshooting

### "railway: command not found"

Install Railway CLI:
```bash
npm install -g @railway/cli
```

If you don't have npm, install Node.js from: https://nodejs.org

### "Cannot link to project"

The script will ask you to select your project. Choose the one with "MiniMat" or your Laravel app.

### Still showing error after 5 minutes

1. Check Railway logs: Dashboard → Deployments → Latest → Logs
2. Verify variables were set: Dashboard → Variables tab
3. Try manual redeploy: Settings → Redeploy

---

## 🎉 Success!

Once it works:
- ✅ Login page appears
- ✅ Can login with admin credentials
- ✅ Dashboard loads
- ✅ POS system works

---

**Choose your method and run it now!** 🚀

**Recommended:** Use the PowerShell script - it's automated and takes 2 minutes.
