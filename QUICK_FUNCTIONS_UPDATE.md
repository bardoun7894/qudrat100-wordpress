# ⚡ Quick Fix - Just Upload Updated functions.php

## 🎯 Yes! Much Easier - Just Replace One File

**You only need to replace:** `functions.php` in your WordPress theme

---

## 📂 File Location

**Upload this file to:**
```
public_html/wp-content/themes/custom-theme/functions.php
```

**Replace the existing functions.php with the updated version from your local folder:**
```
C:\Users\Chairi\wordpress\wp-content\themes\custom-theme\functions.php
```

---

## 🚀 Quick Upload Steps

### Method 1: Hostinger File Manager
1. **Login:** https://hpanel.hostinger.com
2. **Go to:** Files → File Manager
3. **Navigate to:** `public_html/wp-content/themes/custom-theme/`
4. **Delete:** Existing `functions.php`
5. **Upload:** New `functions.php` from your computer
6. **Location:** `C:\Users\Chairi\wordpress\wp-content\themes\custom-theme\functions.php`

### Method 2: Edit Directly (Advanced)
1. **In File Manager:** Edit existing `functions.php`
2. **Replace lines 30-43** with the new CSS loading code
3. **Save**

---

## 🔧 What Changed in functions.php

**Key change in the `custom_theme_scripts()` function:**

**Old code:**
```php
wp_enqueue_style('custom-theme-style', get_stylesheet_uri(), array(), '2.0');
```

**New code:**
```php
// Load main assets CSS (same as standalone files)
wp_enqueue_style('main-assets-css', get_template_directory_uri() . '/../../../assets/css/style.css', array(), '2.0');

// Load theme CSS after
wp_enqueue_style('custom-theme-style', get_stylesheet_uri(), array('main-assets-css'), '2.0');
```

---

## ✅ After Upload

1. **Clear browser cache** (Ctrl+F5)
2. **Visit:** https://qudrat100.com
3. **Should now match:** http://localhost:8080/

**No need to reactivate theme - WordPress will automatically use the new functions.php!**

---

## 🎯 Why This Works

**Before:** WordPress theme uses its own basic CSS
**After:** WordPress theme uses the same rich CSS as demo.php

**Result:** WordPress homepage gets all the styling that makes demo.php look perfect!

---

**Just upload the one file and test! 🚀**