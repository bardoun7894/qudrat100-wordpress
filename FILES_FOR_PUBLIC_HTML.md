# 📁 Files to Upload to public_html on qudrat100.com

## 🎯 IMPORTANT: Your Custom Files Only!

Since qudrat100.com already has WordPress installed, you only need to upload:

### 1️⃣ **Custom Theme (MOST IMPORTANT)**
```
wp-content/themes/custom-theme/
├── style.css          ✅ (Your custom styles)
├── functions.php      ✅ (Updated with new functions)
├── front-page.php     ✅ (Your new homepage)
├── header.php         ✅ (Custom header)
├── footer.php         ✅ (Custom footer)
├── index.php          ✅
├── page.php           ✅
├── single.php         ✅
└── images/
    ├── iconword.png   ✅
    └── بروشور-دورة-القدرة-المعرفية-ج47.jpg ✅
```

### 2️⃣ **Custom PHP Applications**
```
/admin.php             ✅ (Quiz admin panel)
/demo.php              ✅ (Free quiz demo)
/quiz.php              ✅ (Main quiz application)
```

### 3️⃣ **API and Includes**
```
/api/
└── get_questions.php  ✅ (Quiz API endpoint)

/includes/
├── db_connection.php  ⚠️ (Update with live DB credentials)
├── header.php         ✅
└── footer.php         ✅
```

### 4️⃣ **Assets**
```
/assets/
├── css/
│   └── style.css      ✅ (Global styles)
└── images/
    ├── iconword.png   ✅
    └── بروشور-دورة-القدرة-المعرفية-ج47.jpg ✅
```

---

## ❌ DO NOT Upload These (Already on Server)

- ❌ WordPress core files (wp-admin/, wp-includes/)
- ❌ wp-config.php (use the live one already there)
- ❌ Other themes (twentytwentyfive, etc.)
- ❌ .git/ folder
- ❌ Documentation files (.md files)
- ❌ Local backups (.wpress files)

---

## 📤 How to Upload via Hostinger File Manager

### Step 1: Access File Manager
1. Login to: https://hpanel.hostinger.com
2. Go to: **Files** → **File Manager**
3. Navigate to: **public_html**

### Step 2: Upload Theme
1. Navigate to: `public_html/wp-content/themes/`
2. **Create folder:** `custom-theme`
3. **Upload all theme files** into this folder

### Step 3: Upload Custom PHP Files
1. Go back to: `public_html/`
2. **Upload directly:**
   - admin.php
   - demo.php
   - quiz.php

### Step 4: Create Folders & Upload
1. In `public_html/`, create:
   - **Folder:** `api`
   - **Folder:** `includes`
   - **Folder:** `assets`
2. Upload respective files to each folder

### Step 5: Update Database Connection
1. Edit: `includes/db_connection.php`
2. Update with live database credentials:
```php
define('DB_NAME', 'u336527051_PpH8D');
define('DB_USER', 'u336527051_oLmgA');
define('DB_PASSWORD', '5r8PofeOK9');
define('DB_HOST', '127.0.0.1');
```

---

## 🎯 Quick Upload Option: ZIP Method

### Create a ZIP file locally:
1. **Create folder:** `qudrat100-upload`
2. **Add these folders/files:**
   - `wp-content/themes/custom-theme/` (entire folder)
   - `admin.php`
   - `demo.php`
   - `quiz.php`
   - `api/` folder
   - `includes/` folder
   - `assets/` folder

3. **ZIP the folder**
4. **Upload ZIP to public_html**
5. **Extract in File Manager**

---

## ✅ After Upload Checklist

1. **Activate Theme:**
   - Go to: https://qudrat100.com/wp-admin
   - Appearance → Themes
   - Activate: "الاستعداد للقدرات - Qudrat100"

2. **Set Homepage:**
   - Settings → Reading
   - Homepage: Static page → "Front Page"

3. **Update Database Connection:**
   - Edit `includes/db_connection.php` with live credentials

4. **Test Features:**
   - Homepage: https://qudrat100.com
   - Demo Quiz: https://qudrat100.com/demo.php
   - Admin Panel: https://qudrat100.com/admin.php

---

## 📁 File Structure After Upload

```
public_html/
├── wp-content/
│   └── themes/
│       └── custom-theme/    ✅ YOUR THEME
├── admin.php                ✅ YOUR FILE
├── demo.php                 ✅ YOUR FILE
├── quiz.php                 ✅ YOUR FILE
├── api/
│   └── get_questions.php    ✅ YOUR FILE
├── includes/
│   ├── db_connection.php    ✅ YOUR FILE (update credentials)
│   ├── header.php           ✅ YOUR FILE
│   └── footer.php           ✅ YOUR FILE
├── assets/
│   ├── css/
│   │   └── style.css        ✅ YOUR FILE
│   └── images/              ✅ YOUR FILES
└── [WordPress core files - already there]
```

---

## 🚀 Ready to Upload?

**Total files to upload: ~15 files**
**Total size: ~2-3 MB**

**Method 1:** Upload individually via File Manager
**Method 2:** Create ZIP and extract
**Method 3:** Use All-in-One WP Migration (easiest!)

**Which method do you prefer?**