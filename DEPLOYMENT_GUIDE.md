# 🚀 Deployment Guide for qudrat100.com

## Overview
This guide will help you deploy the new educational course design to your live WordPress site at qudrat100.com, replacing the current homepage while keeping the WordPress infrastructure.

---

## 📋 Pre-Deployment Checklist

- [ ] Backup current WordPress site (files + database)
- [ ] Have FTP/cPanel access credentials
- [ ] Have MySQL/phpMyAdmin access
- [ ] Test all features locally (quiz, forms, admin panel)
- [ ] Prepare admin credentials for production

---

## 🗂️ Files to Upload

### 1. Core Application Files
Upload these files to your WordPress root directory (usually `public_html` or `www`):

```
/qudrat100.com/
├── index.php                    (NEW - replaces current homepage)
├── demo.php                     (NEW - free quiz demo)
├── quiz.php                     (NEW - main quiz)
├── admin.php                    (NEW - admin panel)
├── /assets/
│   ├── /css/
│   │   └── style.css           (NEW - all styles)
│   └── /images/
│       ├── iconword.png        (NEW)
│       └── بروشور-دورة-القدرة-المعرفية-ج47.jpg (NEW)
├── /includes/
│   ├── header.php              (NEW)
│   ├── footer.php              (NEW)
│   └── db_connection.php       (NEW - database config)
├── /api/
│   └── get_questions.php       (NEW - quiz API)
└── /uploads/
    └── questions/              (NEW - create empty folder, chmod 755)
```

### 2. WordPress Integration Files
These will integrate with your existing WordPress:

```
/wp-content/
└── /themes/
    └── /custom-theme/          (Existing - may need updates)
```

---

## 📤 Step-by-Step Deployment

### Step 1: Backup Current Site

**Via cPanel:**
1. Login to cPanel (usually: https://qudrat100.com:2083)
2. Go to "Backup Wizard" or "Backup"
3. Choose "Download a Full Website Backup"
4. Also backup database from phpMyAdmin

**Important Files to Backup:**
- Current `index.php`
- Current database (full export)
- `wp-config.php` (contains database credentials)

---

### Step 2: Upload Files via FTP/cPanel

#### Option A: Using FileZilla (FTP)

1. **Connect to FTP:**
   - Host: `ftp.qudrat100.com` or your server IP
   - Username: Your FTP username
   - Password: Your FTP password
   - Port: 21 (or 22 for SFTP)

2. **Navigate to WordPress root** (usually `/public_html/`)

3. **Upload files:**
   - Upload `index.php` (will replace current homepage)
   - Upload `demo.php`, `quiz.php`, `admin.php`
   - Upload `/assets/` folder
   - Upload `/includes/` folder
   - Upload `/api/` folder
   - Create `/uploads/questions/` folder

4. **Set Permissions:**
   - Right-click `/uploads/questions/` → Set to **755** or **775**
   - Right-click `admin.php` → Set to **644**

#### Option B: Using cPanel File Manager

1. Login to cPanel
2. Open "File Manager"
3. Navigate to `public_html`
4. Click "Upload" and upload all files
5. Use "New Folder" to create `/uploads/questions/`
6. Set folder permissions to **755**

---

### Step 3: Database Setup

#### A. Get Database Credentials from WordPress

1. In cPanel File Manager, open `wp-config.php`
2. Find these lines and note the values:
   ```php
   define('DB_NAME', 'your_db_name');
   define('DB_USER', 'your_db_user');
   define('DB_PASSWORD', 'your_db_password');
   define('DB_HOST', 'localhost');
   ```

#### B. Update Database Connection File

1. Open `/includes/db_connection.php` on the server
2. Update with your live database credentials:
   ```php
   <?php
   $servername = "localhost";
   $username = "your_db_user";      // From wp-config.php
   $password = "your_db_password";  // From wp-config.php
   $dbname = "your_db_name";        // From wp-config.php
   ```

#### C. Create Database Tables

1. Login to **phpMyAdmin** (via cPanel)
2. Select your WordPress database (same one in wp-config.php)
3. Click "SQL" tab
4. Copy and paste the contents of `database_setup.sql`:

```sql
CREATE TABLE IF NOT EXISTS quiz_questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question_text TEXT NOT NULL,
    image_path VARCHAR(255),
    option_a VARCHAR(255) NOT NULL,
    option_b VARCHAR(255) NOT NULL,
    option_c VARCHAR(255) NOT NULL,
    option_d VARCHAR(255) NOT NULL,
    correct_answer INT NOT NULL,
    explanation TEXT,
    category VARCHAR(100),
    difficulty VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS quiz_results (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    score DECIMAL(5,2),
    correct_count INT,
    wrong_count INT,
    time_taken_seconds INT,
    quiz_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS course_registrations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    phone VARCHAR(50) NOT NULL,
    email VARCHAR(255) NOT NULL,
    package VARCHAR(100) NOT NULL,
    message TEXT,
    registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

5. Click "Go" to execute
6. Verify tables are created by checking "Structure" tab

---

### Step 4: Configure Admin Access

1. **Set Admin Password:**
   - Edit `admin.php` (around line 10)
   - Change the default password hash or use the login with:
   - Username: `admin`
   - Password: `admin123` (CHANGE THIS IMMEDIATELY!)

2. **Change Admin Password After First Login:**
   - Go to: `https://qudrat100.com/admin.php`
   - Login with default credentials
   - You'll need to manually update the password in the code for now

3. **Secure Admin Panel:**
   - Add `.htaccess` protection (optional but recommended)
   - Create `.htaccess` in root:
   ```apache
   <Files "admin.php">
     Order Allow,Deny
     Allow from all
   </Files>
   ```

---

### Step 5: Test the Deployment

#### Test Checklist:

1. **Homepage:**
   - Visit: `https://qudrat100.com/`
   - ✅ Check if new design loads
   - ✅ Check all images display
   - ✅ Check CSS styling is correct
   - ✅ Test responsive design (mobile/tablet)

2. **Demo Quiz:**
   - Visit: `https://qudrat100.com/demo.php`
   - ✅ Quiz loads without errors
   - ✅ Can answer questions
   - ✅ Results page displays correctly

3. **Main Quiz:**
   - Visit: `https://qudrat100.com/quiz.php`
   - ✅ Loads questions from database
   - ✅ All functionality works

4. **Admin Panel:**
   - Visit: `https://qudrat100.com/admin.php`
   - ✅ Can login successfully
   - ✅ Can add new questions
   - ✅ Can upload images
   - ✅ Can delete questions
   - ✅ Can view analytics

5. **Database:**
   - Add a test question via admin
   - Check if it appears in quiz
   - Verify images upload correctly

---

## 🔧 Common Issues & Solutions

### Issue 1: CSS Not Loading
**Problem:** Page loads but styling is missing

**Solutions:**
- Check file path: `/assets/css/style.css` should be accessible
- Clear browser cache (Ctrl+F5)
- Verify file permissions (should be 644)
- Check .htaccess isn't blocking CSS files

### Issue 2: Database Connection Error
**Problem:** "Connection failed" message

**Solutions:**
- Verify credentials in `/includes/db_connection.php`
- Check database host (might be IP address instead of "localhost")
- Ensure database user has permissions
- Test connection in phpMyAdmin

### Issue 3: Images Not Uploading
**Problem:** Admin panel can't upload question images

**Solutions:**
- Check `/uploads/questions/` folder exists
- Set folder permissions to 755 or 775
- Check PHP upload_max_filesize in php.ini (should be at least 10M)
- Verify disk space available

### Issue 4: Admin Panel Not Accessible
**Problem:** 404 or blank page on admin.php

**Solutions:**
- Verify `admin.php` uploaded correctly
- Check file permissions (644)
- Look for PHP errors: Add to top of admin.php:
  ```php
  <?php
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  ```

### Issue 5: Quiz Questions Not Loading
**Problem:** Quiz shows "Loading..." indefinitely

**Solutions:**
- Check `/api/get_questions.php` exists
- Verify database tables created successfully
- Check browser console for JavaScript errors (F12)
- Test API directly: `https://qudrat100.com/api/get_questions.php`

### Issue 6: Arabic Text Shows as "??????"
**Problem:** Arabic characters display incorrectly

**Solutions:**
- Add to database connection:
  ```php
  $conn->set_charset("utf8mb4");
  ```
- Check database table collation is `utf8mb4_unicode_ci`
- Ensure files are saved with UTF-8 encoding

---

## 🔐 Security Recommendations

1. **Change Admin Password Immediately**
   - Default: `admin123` is NOT SECURE
   - Update in admin.php after first login

2. **Protect Admin Panel**
   - Add IP whitelist in .htaccess
   - Use strong passwords
   - Enable login attempt limiting (already implemented)

3. **File Permissions**
   - Files: 644
   - Folders: 755
   - Sensitive files: 600 (like db_connection.php)

4. **Database Security**
   - Use strong MySQL password
   - Don't use root user for application
   - Regular backups

5. **Hide Sensitive Files**
   Create `.htaccess` in `/includes/`:
   ```apache
   Order Deny,Allow
   Deny from all
   ```

---

## 📊 Post-Deployment Tasks

### Immediate (Day 1):
- [ ] Change admin password
- [ ] Add 10-20 real quiz questions
- [ ] Test all forms (registration, contact)
- [ ] Verify email notifications work
- [ ] Check on multiple devices/browsers

### Short-term (Week 1):
- [ ] Set up automated database backups
- [ ] Configure email settings properly
- [ ] Add SSL certificate if not already present
- [ ] Set up Google Analytics (optional)
- [ ] Monitor error logs

### Ongoing:
- [ ] Regular content updates
- [ ] Weekly database backups
- [ ] Monitor server resources
- [ ] Review analytics data
- [ ] Add more quiz questions

---

## 📱 Testing on Mobile

1. **Chrome DevTools:**
   - Press F12 → Toggle device toolbar
   - Test: iPhone SE, iPad, Desktop

2. **Real Devices:**
   - Test on actual mobile phones
   - Check touch interactions
   - Verify form submissions

3. **Responsive Breakpoints:**
   - Desktop: 1920px, 1440px, 1024px
   - Tablet: 768px
   - Mobile: 480px, 375px, 320px

---

## 🆘 Emergency Rollback

If something goes wrong:

1. **Quick Rollback:**
   - Rename `index.php` to `index-new.php`
   - Rename backup `index-backup.php` to `index.php`

2. **Full Rollback:**
   - Use cPanel backup restore
   - Restore database from backup
   - Restore files from backup

3. **Keep Backups:**
   - Always keep backups for at least 30 days
   - Store backups off-server

---

## 📞 Support & Maintenance

### Important Files to Track:
- `/includes/db_connection.php` - Database config
- `admin.php` - Admin panel
- `/api/get_questions.php` - Quiz API
- `/uploads/questions/` - Question images

### Regular Maintenance:
- Weekly: Check error logs
- Monthly: Review analytics
- Quarterly: Update dependencies
- Yearly: Security audit

---

## ✅ Final Checklist

Before announcing the site is live:

- [ ] All pages load correctly
- [ ] CSS and images display properly
- [ ] Database connection works
- [ ] Admin panel accessible and secured
- [ ] Quiz functionality tested
- [ ] Forms submit successfully
- [ ] Mobile responsive verified
- [ ] Browser compatibility checked (Chrome, Firefox, Safari)
- [ ] Arabic text displays correctly
- [ ] SSL certificate active (https://)
- [ ] Error reporting disabled in production
- [ ] Backup system in place
- [ ] Admin password changed from default
- [ ] Contact information updated
- [ ] Privacy policy/terms (if required)

---

## 🎉 You're Ready to Go Live!

Once all items are checked off, your new design is ready for users. Monitor the site closely for the first few days and gather user feedback.

**Good luck with your deployment! 🚀**

---

## Quick Reference: File Locations

| File | Local Path | Server Path |
|------|-----------|-------------|
| Homepage | `index.php` | `/public_html/index.php` |
| Demo Quiz | `demo.php` | `/public_html/demo.php` |
| Main Quiz | `quiz.php` | `/public_html/quiz.php` |
| Admin | `admin.php` | `/public_html/admin.php` |
| Styles | `assets/css/style.css` | `/public_html/assets/css/style.css` |
| DB Config | `includes/db_connection.php` | `/public_html/includes/db_connection.php` |
| Quiz API | `api/get_questions.php` | `/public_html/api/get_questions.php` |

---

**Last Updated:** September 30, 2025
**Version:** 1.0


