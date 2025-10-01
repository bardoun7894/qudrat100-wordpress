# 🚀 ACTIVATE CUSTOM-THEME ON LIVE SERVER NOW

## 🎯 The Problem
The live site is showing **Astra theme** instead of your **custom-theme** (the one working on localhost:8080)

## ✅ The Solution - Run These Commands

### Step 1: Connect to SSH
```bash
ssh -p 65002 u336527051@82.29.185.27
```
**Password:** `Myword11@@`

---

### Step 2: Navigate to WordPress Directory
```bash
cd domains/qudrat100.com/public_html
```

---

### Step 3: Activate Your Custom Theme
```bash
wp theme activate custom-theme --allow-root
```

**Expected output:** `Success: Switched to 'الاستعداد للقدرات - Qudrat100' theme.`

---

### Step 4: Clear All Caches
```bash
wp cache flush --allow-root
```

```bash
wp transient delete --all --allow-root
```

```bash
wp rewrite flush --allow-root
```

---

### Step 5: Verify Theme is Active
```bash
wp theme list --allow-root
```

**You should see:**
```
name         status   update   version
custom-theme active   none     2.0
```

---

### Step 6: Test CSS Loading
```bash
curl -s https://qudrat100.com/ | grep -i 'stylesheet' | grep -i 'assets'
```

**Expected:** Should show `assets/css/style.css` being loaded

---

## 🔍 Quick One-Line Fix (Copy-Paste All Commands)

```bash
ssh -p 65002 u336527051@82.29.185.27 "cd domains/qudrat100.com/public_html && wp theme activate custom-theme --allow-root && wp cache flush --allow-root && wp transient delete --all --allow-root && wp rewrite flush --allow-root && wp theme list --allow-root"
```

**Password:** `Myword11@@`

---

## ✅ After Running Commands

1. **Clear browser cache** (Ctrl + Shift + Delete)
2. **Visit:** https://qudrat100.com
3. **Compare with:** http://localhost:8080/

**They should now look IDENTICAL! ✨**

---

## 🎯 What This Does

- **Activates** your custom-theme (the one from localhost:8080)
- **Clears** all WordPress caches
- **Forces** WordPress to use new theme files
- **Loads** `/assets/css/style.css` (same as demo.php and quiz.php)

---

## 📋 Troubleshooting

### If site still shows Astra theme:

#### Option 1: Clear Hostinger Cache
1. Go to **Hostinger Control Panel**
2. **Advanced → Performance → Cache Manager**
3. Click **"Clear All Cache"**
4. Wait 2-3 minutes

#### Option 2: Force Database Update
```bash
cd domains/qudrat100.com/public_html
wp option update template 'custom-theme' --allow-root
wp option update stylesheet 'custom-theme' --allow-root
wp cache flush --allow-root
```

---

**Run Step 3 command now to activate your theme! 🚀**
