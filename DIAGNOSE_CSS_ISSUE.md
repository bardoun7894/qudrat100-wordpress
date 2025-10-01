# 🔍 Complete CSS Diagnosis - SSH Commands

## 🎯 Let's Find the Real Problem

Run these commands via SSH to diagnose exactly what's happening:

```bash
ssh -p 65002 u336527051@82.29.185.27
```

---

## Step 1: Check if CSS File Exists

```bash
# Check if assets/css/style.css exists
ls -lah ~/public_html/assets/css/style.css

# If not found, check what's in assets folder
ls -lah ~/public_html/assets/

# Check entire directory structure
find ~/public_html -name "style.css" -type f
```

---

## Step 2: Check What demo.php Actually Uses

```bash
# View demo.php header to see CSS path
grep -A 5 -B 5 "stylesheet" ~/public_html/demo.php

# Or check includes/header.php
grep -A 5 -B 5 "stylesheet" ~/public_html/includes/header.php
```

---

## Step 3: Test CSS File Accessibility

```bash
# Try to access CSS via curl
curl -I https://qudrat100.com/assets/css/style.css

# Should return "200 OK" if file exists
# Will return "404 Not Found" if missing
```

---

## Step 4: Check WordPress Theme CSS Loading

```bash
# View current functions.php CSS loading
sed -n '30,45p' ~/public_html/wp-content/themes/custom-theme/functions.php
```

---

## Step 5: Check File Permissions

```bash
# Check permissions on assets folder
ls -lah ~/public_html/ | grep assets

# Check permissions on CSS file
ls -lah ~/public_html/assets/css/
```

---

## 🔧 Based on Results, Do This:

### If CSS file is MISSING:
```bash
# Create assets folder structure
mkdir -p ~/public_html/assets/css
mkdir -p ~/public_html/assets/images

# Check if it's in a different location
find ~/public_html -name "style.css" -ls
```

### If CSS file EXISTS but has wrong permissions:
```bash
chmod 755 ~/public_html/assets
chmod 755 ~/public_html/assets/css
chmod 644 ~/public_html/assets/css/style.css
```

### If CSS file is in wrong location:
```bash
# Find where it actually is
find ~/public_html -name "style.css" -type f

# Copy theme's style.css to assets if needed
cp ~/public_html/wp-content/themes/custom-theme/style.css ~/public_html/assets/css/style.css
```

---

## 🎯 Most Likely Issues:

### Issue 1: Assets folder not uploaded
**Fix:**
```bash
# Check what you have
ls -la ~/public_html/

# If assets folder is missing, you need to upload it
```

### Issue 2: CSS file in wrong location
**Fix:**
```bash
# Find all CSS files
find ~/public_html -name "*.css" -type f | grep -v "wp-"

# This shows where your CSS files actually are
```

### Issue 3: WordPress using cached version
**Fix:**
```bash
# Change version number to force reload
sed -i "s|, '2.0')|, '2.1')|g" ~/public_html/wp-content/themes/custom-theme/functions.php
```

---

## 📊 Quick Diagnostic Report

Run this complete diagnostic:
```bash
echo "=== CSS File Check ==="
ls -lah ~/public_html/assets/css/style.css

echo "=== Assets Folder Check ==="
ls -lah ~/public_html/assets/

echo "=== All CSS Files ==="
find ~/public_html -name "*.css" -type f | grep -v "wp-content/themes/twenty" | head -20

echo "=== Demo.php CSS Include ==="
grep "stylesheet" ~/public_html/includes/header.php

echo "=== Functions.php CSS Loading ==="
sed -n '35,42p' ~/public_html/wp-content/themes/custom-theme/functions.php

echo "=== Test CSS URL ==="
curl -I https://qudrat100.com/assets/css/style.css 2>&1 | head -5
```

---

## 📝 What to Share

After running the diagnostic, share the output so I can see:
1. Does `/assets/css/style.css` exist?
2. What CSS is demo.php actually loading?
3. What's the exact error (404, 403, etc.)?

---

**Run the diagnostic and let me know what you find! 🔍**