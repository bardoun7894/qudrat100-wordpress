# 🚀 Simple FTP Deployment (No Plugin Needed!)

## Why This Method?

- ✅ No file size limits
- ✅ No download issues
- ✅ Faster than plugin
- ✅ More control

---

## Step 1: Prepare Theme Folder (1 minute)

Your theme is ready at:
```
C:\Users\Chairi\wordpress\wp-content\themes\custom-theme\
```

---

## Step 2: Connect to Your Live Site via FTP

### Option A: Using FileZilla (Recommended)

1. **Download FileZilla** (if you don't have it):
   - https://filezilla-project.org/download.php?type=client

2. **Get FTP Credentials:**
   - From your hosting provider (cPanel/email)
   - You need:
     - Host: ftp.qudrat100.com (or IP address)
     - Username: your FTP username
     - Password: your FTP password
     - Port: 21 (or 22 for SFTP)

3. **Connect:**
   - Open FileZilla
   - Enter Host, Username, Password, Port
   - Click "Quickconnect"

### Option B: Using cPanel File Manager

1. Login to your hosting cPanel
2. Click "File Manager"
3. Navigate to: `/public_html/wp-content/themes/`

---

## Step 3: Upload Theme Files

### Via FileZilla:

1. **Left side:** Navigate to `C:\Users\Chairi\wordpress\wp-content\themes\custom-theme\`
2. **Right side:** Navigate to `/public_html/wp-content/themes/`
3. **Drag and drop** the entire `custom-theme` folder from left to right
4. Click "OK" when asked about overwriting files
5. Wait for upload to complete (2-5 minutes)

### Via cPanel File Manager:

1. Navigate to: `/public_html/wp-content/themes/`
2. Click "Upload"
3. Zip your theme folder first:
   - Right-click `custom-theme` folder
   - Send to → Compressed (zipped) folder
4. Upload the zip file
5. After upload, select it and click "Extract"

---

## Step 4: Activate Theme on Live Site

1. **Go to:** https://qudrat100.com/wp-admin/
2. **Login** with your credentials
3. **Go to:** Appearance → Themes
4. **Find:** "الاستعداد للقدرات - Qudrat100"
5. **Click:** "Activate"

---

## Step 5: Set Homepage

1. **Go to:** Settings → Reading
2. **Select:** "A static page"
3. **Create "Front Page" if needed:**
   - Pages → Add New
   - Title: "Front Page"
   - Publish
4. **Set as homepage** in Settings → Reading
5. **Save Changes**

---

## Step 6: Update Database Connection

**Via FTP/cPanel File Manager:**

1. **Edit file:** `/public_html/includes/db_connection.php`
2. **Update with live database credentials:**
   ```php
   $servername = "localhost";
   $username = "your_live_db_user";      // From wp-config.php
   $password = "your_live_db_password";  // From wp-config.php
   $dbname = "your_live_db_name";        // From wp-config.php
   ```

3. **Get credentials from:** `/public_html/wp-config.php`
   - Look for: DB_NAME, DB_USER, DB_PASSWORD

---

## Step 7: Create Database Tables

**Via phpMyAdmin:**

1. **Login to cPanel**
2. **Click "phpMyAdmin"**
3. **Select your WordPress database** (from wp-config.php)
4. **Click "SQL" tab**
5. **Paste this code:**

```sql
CREATE TABLE IF NOT EXISTS wp_quiz_questions (
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

CREATE TABLE IF NOT EXISTS wp_quiz_results (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    score DECIMAL(5,2),
    correct_count INT,
    wrong_count INT,
    time_taken_seconds INT,
    quiz_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS wp_course_registrations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    phone VARCHAR(50) NOT NULL,
    email VARCHAR(255) NOT NULL,
    package VARCHAR(100) NOT NULL,
    message TEXT,
    registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

6. **Click "Go"**

---

## Step 8: Upload Additional Files (Optional)

These files work alongside WordPress:

**Via FTP, upload to `/public_html/`:**
- `admin.php` (admin panel)
- `demo.php` (demo quiz)
- `quiz.php` (main quiz)

**Upload folders:**
- `/api/` folder → `/public_html/api/`
- `/uploads/` folder → `/public_html/uploads/`

**Set folder permissions:**
- `uploads/questions/` → 755

---

## Step 9: Test Everything

1. **Visit:** https://qudrat100.com/
2. **Check:**
   - ✅ New blue design shows
   - ✅ Navigation works
   - ✅ Images display
   - ✅ Mobile responsive
3. **Test pages:**
   - https://qudrat100.com/demo.php
   - https://qudrat100.com/quiz.php
   - https://qudrat100.com/admin.php

---

## ✅ Done!

Your new design should now be live on qudrat100.com!

This method is simpler and avoids the plugin download issues.

---

**Estimated Time:** 15-20 minutes  
**Difficulty:** Easy  
**Requirements:** FTP access or cPanel access


