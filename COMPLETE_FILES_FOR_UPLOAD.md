# 📂 Complete File List for qudrat100.com Upload

## 🎯 ALL Files to Upload to public_html

### ✅ MUST UPLOAD - Your Custom Files

#### 1. Custom Theme Files
**Location on server:** `public_html/wp-content/themes/custom-theme/`
```
📁 wp-content/themes/custom-theme/
├── style.css              ✅ UPLOAD
├── functions.php          ✅ UPLOAD (updated version)
├── front-page.php         ✅ UPLOAD
├── header.php             ✅ UPLOAD
├── footer.php             ✅ UPLOAD
├── index.php              ✅ UPLOAD
├── page.php               ✅ UPLOAD
├── single.php             ✅ UPLOAD
├── page-landing.php       ✅ UPLOAD
└── images/
    ├── iconword.png       ✅ UPLOAD
    └── بروشور-دورة...jpg  ✅ UPLOAD
```

#### 2. Custom PHP Applications
**Location on server:** `public_html/` (root)
```
admin.php                  ✅ UPLOAD
demo.php                   ✅ UPLOAD
quiz.php                   ✅ UPLOAD
```

#### 3. API Folder
**Location on server:** `public_html/api/`
```
📁 api/
└── get_questions.php      ✅ UPLOAD
```

#### 4. Includes Folder
**Location on server:** `public_html/includes/`
```
📁 includes/
├── db_connection.php      ✅ UPLOAD (update credentials after)
├── header.php             ✅ UPLOAD
└── footer.php             ✅ UPLOAD
```

#### 5. Assets Folder
**Location on server:** `public_html/assets/`
```
📁 assets/
├── css/
│   └── style.css          ✅ UPLOAD
└── images/
    ├── iconword.png       ✅ UPLOAD
    └── بروشور-دورة...jpg  ✅ UPLOAD
```

---

## ❌ DO NOT UPLOAD - These Files

### Documentation & Git Files
```
❌ .git/                   (Git repository)
❌ .github/                (GitHub workflows)
❌ .gitignore              (Git ignore file)
❌ *.md files              (All documentation)
❌ *.txt files             (Text documentation)
❌ .claude/                (Claude settings)
```

### WordPress Core (Already on Server)
```
❌ wp-admin/               (WordPress admin - already exists)
❌ wp-includes/            (WordPress core - already exists)
❌ wp-*.php                (WordPress core files)
❌ index.php               (WordPress index - already exists)
❌ xmlrpc.php              (WordPress file)
❌ license.txt             (WordPress license)
❌ readme.html             (WordPress readme)
```

### Configuration Files
```
❌ wp-config.php           (Use live server's config)
❌ wp-config-sample.php    (Sample config)
❌ .htaccess               (Server config - if exists on server)
❌ .user.ini               (PHP config)
```

### Backup & Temporary Files
```
❌ wp-content/ai1wm-backups/    (All-in-One backups)
❌ deployment_package/           (Deployment folder)
❌ Desktop/                      (Desktop folder)
❌ *.sql files                   (Database files)
❌ *.zip files                   (Archive files)
❌ *.bat files                   (Windows batch files)
❌ *.ps1 files                   (PowerShell scripts)
```

### Other Themes & Plugins
```
❌ wp-content/themes/twentytwentyfive/
❌ wp-content/themes/twentytwentyfour/
❌ wp-content/themes/twentytwentythree/
❌ wp-content/plugins/akismet/
❌ wp-content/plugins/all-in-one-wp-migration/
❌ wp-content/plugins/hello.php
```

### Language Files
```
❌ wp-content/languages/    (Use server's language files)
```

---

## 📦 Easy Upload Method - Create ZIP

### Step 1: Create Upload Folder
Create a new folder called `qudrat100-files` with this structure:

```
qudrat100-files/
├── wp-content/
│   └── themes/
│       └── custom-theme/     (entire folder)
├── admin.php
├── demo.php
├── quiz.php
├── api/
│   └── get_questions.php
├── includes/
│   ├── db_connection.php
│   ├── header.php
│   └── footer.php
└── assets/
    ├── css/
    │   └── style.css
    └── images/
```

### Step 2: Upload to Hostinger
1. ZIP the `qudrat100-files` folder
2. Login to Hostinger File Manager
3. Upload ZIP to `public_html`
4. Extract ZIP
5. Move files to correct locations

---

## 📝 Summary - What You're Uploading

| Category | Files | Size |
|----------|-------|------|
| Custom Theme | 11 files | ~500 KB |
| PHP Applications | 3 files | ~100 KB |
| API | 1 file | ~5 KB |
| Includes | 3 files | ~20 KB |
| Assets | 3 files | ~1.5 MB |
| **TOTAL** | **~21 files** | **~2.2 MB** |

---

## ⚠️ Important After Upload

1. **Update Database Connection:**
   Edit `includes/db_connection.php`:
   ```php
   define('DB_NAME', 'u336527051_PpH8D');
   define('DB_USER', 'u336527051_oLmgA');
   define('DB_PASSWORD', '5r8PofeOK9');
   define('DB_HOST', '127.0.0.1');
   ```

2. **Activate Theme:**
   - WordPress Admin → Appearance → Themes
   - Activate "الاستعداد للقدرات - Qudrat100"

3. **Set Homepage:**
   - Settings → Reading → Static page

4. **Test Everything:**
   - Homepage
   - Quiz demo
   - Admin panel

---

**Ready to upload these ~21 files to public_html?**