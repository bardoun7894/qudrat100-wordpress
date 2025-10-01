# 🔧 WordPress Homepage Not Working - Fix Guide

## 🎯 Current Status
- ✅ **Standalone files work:** demo.php, quiz.php, admin.php
- ❌ **WordPress homepage fails:** https://qudrat100.com

## 🔍 Possible Issues

### Issue 1: Theme Not Activated
**Problem:** Custom theme not active in WordPress admin

**Fix:** Activate the theme
1. **Login:** https://qudrat100.com/wp-admin
2. **Go to:** Appearance → Themes
3. **Find:** "الاستعداد للقدرات - Qudrat100"
4. **Click:** Activate

### Issue 2: Homepage Not Set
**Problem:** WordPress showing default posts page instead of custom homepage

**Fix:** Set static homepage
1. **In WordPress admin:** Settings → Reading
2. **Select:** "A static page" (not "Your latest posts")
3. **Homepage:** Create/select "Front Page"
4. **Save Changes**

### Issue 3: Theme Files Missing
**Problem:** Custom theme not properly uploaded

**Fix:** Check theme location
- **Should be:** `wp-content/themes/custom-theme/`
- **Must have:** `style.css`, `front-page.php`, `functions.php`

### Issue 4: Permalink Issues
**Problem:** WordPress URLs not working properly

**Fix:** Flush permalinks
1. **WordPress admin:** Settings → Permalinks
2. **Click:** Save Changes (don't change settings)

---

## 🚀 Step-by-Step Fix

### Step 1: Login to WordPress Admin
- **URL:** https://qudrat100.com/wp-admin
- **Use your WordPress login credentials**

### Step 2: Check Active Theme
- **Go to:** Appearance → Themes
- **Look for:** "الاستعداد للقدرات - Qudrat100"
- **Status:** Should show "Active"
- **If not active:** Click "Activate"

### Step 3: Check Reading Settings
- **Go to:** Settings → Reading
- **Your homepage displays:** Should be "A static page"
- **Homepage:** Should be set to a page (create one if needed)

### Step 4: Create Homepage if Missing
If no homepage exists:
1. **Go to:** Pages → Add New
2. **Title:** "Front Page" or "الصفحة الرئيسية"
3. **Template:** Should auto-select "Front Page"
4. **Publish**
5. **Go back to:** Settings → Reading
6. **Set homepage** to this new page

### Step 5: Test and Debug
- **Visit:** https://qudrat100.com
- **Should show:** Your custom blue design
- **If still not working:** Check next steps

---

## 🛠️ Advanced Troubleshooting

### Check 1: Theme Files Uploaded Correctly
**Via Hostinger File Manager:**
- **Path:** `public_html/wp-content/themes/custom-theme/`
- **Must have files:**
  - `style.css` (theme info)
  - `front-page.php` (homepage template)
  - `functions.php` (theme functions)
  - `header.php`, `footer.php`

### Check 2: Database Tables Created
**The theme should auto-create tables when activated:**
- `wp_quiz_questions`
- `wp_quiz_results`
- `wp_course_registrations`

**If tables missing:**
1. **Switch to another theme** (twentytwentyfive)
2. **Switch back** to custom theme
3. **This triggers** table creation

### Check 3: File Permissions
**Should be:**
- **Folders:** 755
- **Files:** 644

### Check 4: WordPress Debug
**Temporarily enable debug:**
1. **Edit:** `wp-config.php` on server
2. **Change:** `define('WP_DEBUG', false);`
3. **To:** `define('WP_DEBUG', true);`
4. **Visit site** to see error messages
5. **Change back** to `false` after debugging

---

## 🎯 Quick Diagnostic

### Test These URLs:
1. **WordPress Admin:** https://qudrat100.com/wp-admin ✅ Should work
2. **Homepage:** https://qudrat100.com ❌ Currently not working
3. **Demo:** https://qudrat100.com/demo.php ✅ Working now
4. **Quiz:** https://qudrat100.com/quiz.php ✅ Working now

### Common Error Messages:
- **"Theme not found"** → Re-upload theme files
- **"Database error"** → Update database credentials
- **"Page not found"** → Set static homepage
- **"Internal server error"** → Check file permissions

---

## 🚨 Emergency Backup Plan

### If WordPress Still Not Working:
1. **Use All-in-One Migration:**
   - Export from your local WordPress
   - Import to live site
   - This replaces everything including database

2. **Manual Theme Activation:**
   - Access database via phpMyAdmin
   - Find `wp_options` table
   - Look for `template` and `stylesheet` options
   - Set both to `custom-theme`

---

## 📋 Action Checklist

**Try these in order:**

- [ ] Login to https://qudrat100.com/wp-admin
- [ ] Go to Appearance → Themes
- [ ] Activate "الاستعداد للقدرات - Qudrat100" theme
- [ ] Go to Settings → Reading
- [ ] Set "A static page" as homepage
- [ ] Create new page if needed
- [ ] Save changes
- [ ] Visit https://qudrat100.com
- [ ] Check if working

---

**Start with theme activation - that's the most likely fix! 🎯**