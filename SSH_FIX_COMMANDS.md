# 🚀 SSH Commands to Fix WordPress CSS

## 🔐 SSH Connection

**Command:**
```bash
ssh -p 65002 u336527051@82.29.185.27
```

**Password:** [Your Hostinger password]

---

## 🔧 Commands to Run After SSH Login

### Step 1: Navigate to Theme Directory
```bash
cd ~/public_html/wp-content/themes/custom-theme/
```

### Step 2: Backup Current functions.php
```bash
cp functions.php functions.php.backup
```

### Step 3: Edit functions.php
```bash
nano functions.php
```

### Step 4: Find and Replace (in nano editor)
1. **Press:** `Ctrl + W` (search)
2. **Search for:** `get_template_directory_uri() . '/../../../assets/css/style.css'`
3. **Press:** `Ctrl + W` then `Ctrl + R` (replace)
4. **Replace with:** `site_url('/assets/css/style.css')`
5. **Press:** `Y` to confirm
6. **Press:** `Ctrl + X` to exit
7. **Press:** `Y` to save
8. **Press:** `Enter` to confirm filename

### OR Use sed (Faster):
```bash
sed -i "s|get_template_directory_uri() . '/../../../assets/css/style.css'|site_url('/assets/css/style.css')|g" functions.php
```

### Step 5: Verify the Change
```bash
grep -n "site_url('/assets/css/style.css')" functions.php
```

**Expected output:** Should show line 38 with the new code

### Step 6: Check CSS File Exists
```bash
cd ~/public_html/
ls -la assets/css/style.css
```

**Expected:** Should show the file exists with proper permissions

---

## ✅ After Making Changes

### Test the Site:
1. **Visit:** https://qudrat100.com
2. **Hard refresh:** Ctrl + F5
3. **Should now match:** demo.php and quiz.php styling

### If Still Not Working:
```bash
# Check file permissions
chmod 644 ~/public_html/wp-content/themes/custom-theme/functions.php
chmod 644 ~/public_html/assets/css/style.css

# Check WordPress can read the CSS
ls -la ~/public_html/assets/css/
```

---

## 🔍 Debugging Commands

### Check what CSS WordPress is trying to load:
```bash
# View the functions.php lines 36-40
sed -n '36,40p' ~/public_html/wp-content/themes/custom-theme/functions.php
```

### Check if assets CSS exists:
```bash
curl -I https://qudrat100.com/assets/css/style.css
```

**Expected:** Should return `200 OK`

### View WordPress errors (if any):
```bash
tail -f ~/public_html/wp-content/debug.log
```

---

## 📝 Quick Reference

**SSH Login:**
```bash
ssh -p 65002 u336527051@82.29.185.27
```

**Edit File:**
```bash
nano ~/public_html/wp-content/themes/custom-theme/functions.php
```

**Exit SSH:**
```bash
exit
```

---

## 🎯 The Exact Change Needed

**Line 37-38 in functions.php should be:**

```php
// Enqueue main assets CSS (same styling used by standalone files)
// Use site_url for clean absolute path
wp_enqueue_style('main-assets-css', site_url('/assets/css/style.css'), array(), '2.0');
```

---

**Connect via SSH and run these commands to fix the issue directly on the server! 🚀**