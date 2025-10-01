# 🚀 UPLOAD COMPLETE CUSTOM-THEME - FINAL FIX

## 🎯 The Problem
The custom-theme on the server is **incomplete or corrupted**. It's missing the proper styling and layout that works on localhost:8080.

## ✅ Solution: Replace Entire Theme Folder

### Method 1: Via Hostinger File Manager (EASIEST)

#### Step 1: Download Theme ZIP
I'll create: `custom-theme-COMPLETE.zip`
Location: `C:\Users\Chairi\wordpress\custom-theme-COMPLETE.zip`

#### Step 2: Delete Old Theme on Server
1. Go to **Hostinger Control Panel → File Manager**
2. Navigate to: `domains/qudrat100.com/public_html/wp-content/themes/`
3. **Delete** the entire `custom-theme` folder
4. Make sure it's completely removed

#### Step 3: Upload New Theme
1. Stay in `wp-content/themes/` directory
2. Click **Upload** button
3. Upload `custom-theme-COMPLETE.zip`
4. After upload, **right-click** the ZIP → **Extract**
5. Delete the ZIP file after extraction

#### Step 4: Activate Theme
```bash
ssh -p 65002 u336527051@82.29.185.27
cd domains/qudrat100.com/public_html
wp theme activate custom-theme --allow-root
wp cache flush --allow-root
```

---

### Method 2: Via SCP Upload (FASTER)

```bash
# Upload theme folder directly
scp -P 65002 -r "C:\Users\Chairi\wordpress\wp-content\themes\custom-theme" u336527051@82.29.185.27:domains/qudrat100.com/public_html/wp-content/themes/

# Then activate
ssh -p 65002 u336527051@82.29.185.27
cd domains/qudrat100.com/public_html
wp theme activate custom-theme --allow-root
wp cache flush --allow-root
```

Password: `Myword11@@`

---

### Method 3: Via WordPress Admin Panel (SAFEST)

#### Step 1: Create Installable Theme ZIP
The ZIP must have this structure:
```
custom-theme.zip
└── custom-theme/
    ├── style.css
    ├── functions.php
    ├── front-page.php
    ├── header.php
    ├── footer.php
    ├── index.php
    ├── page.php
    ├── single.php
    ├── page-landing.php
    ├── images/
    └── js/
```

#### Step 2: Upload via WordPress
1. Go to: https://qudrat100.com/wp-admin/
2. Navigate to: **Appearance → Themes**
3. Click: **Add New → Upload Theme**
4. Choose: `custom-theme-COMPLETE.zip`
5. Click: **Install Now**
6. Click: **Activate**

---

## 🔍 What Should Happen

### Before (Current):
- ❌ White background, basic text
- ❌ No blue/indigo colors
- ❌ No hero section
- ❌ No course registration form
- ❌ Plain footer

### After (Like localhost:8080):
- ✅ Blue gradient header
- ✅ Hero section with icon
- ✅ Course details cards
- ✅ Registration form
- ✅ Styled footer with social links
- ✅ Exact same as http://localhost:8080/

---

## 📋 Files That Must Be in Theme

Your theme folder must contain:
- `style.css` (24KB) - Theme styles
- `functions.php` (9KB) - Theme functions and CSS loading
- `front-page.php` (15KB) - Homepage template
- `header.php` (5KB) - Header template
- `footer.php` (2KB) - Footer template
- `index.php` - Default template
- `page.php` - Page template
- `single.php` - Single post template
- `page-landing.php` - Landing page template
- `images/` folder with brochure image
- `js/` folder with scripts

---

## ⚡ Recommended: Use Method 1 (File Manager)

**It's the easiest and most reliable!**

1. Delete old `custom-theme` folder
2. Upload `custom-theme-COMPLETE.zip`
3. Extract it
4. Activate via SSH

**This will make your live site look EXACTLY like localhost:8080! 🎉**

---

Let me create the ZIP file now...
