# 🚀 Setup Instructions

## Database Setup for Quiz System

### Step 1: Start XAMPP Services
1. Open **XAMPP Control Panel**
2. Click **Start** on **Apache**
3. Click **Start** on **MySQL**

### Step 2: Create Database
1. Open your browser and go to: **http://localhost/phpmyadmin/**
2. Click on **"New"** in the left sidebar
3. Database name: `wordpress_db`
4. Collation: `utf8mb4_unicode_ci`
5. Click **"Create"**

### Step 3: Import Database Schema
1. In phpMyAdmin, select the `wordpress_db` database
2. Click on **"SQL"** tab
3. Open the file `database_setup.sql` from your project folder
4. Copy all the SQL code
5. Paste it into the SQL query box
6. Click **"Go"** to execute

**OR** you can import the file directly:
1. Click on **"Import"** tab
2. Click **"Choose File"**
3. Select `database_setup.sql`
4. Click **"Go"**

### Step 4: Verify Tables Created
After running the SQL, you should see 3 new tables:
- ✅ `quiz_questions` - Stores quiz questions and answers
- ✅ `quiz_results` - Stores student quiz scores (optional)
- ✅ `course_registrations` - Stores registration form submissions

---

## 🎨 UI Color Scheme

### Primary Color (Cyan)
- **Color Code:** `#00D4FF`
- **Usage:** Buttons, headings, icons, primary elements
- **Examples:** Primary buttons, top bar, hero section

### Secondary Color (Purple)
- **Color Code:** `#C77DFF`
- **Usage:** Secondary buttons, accents, alternate sections
- **Examples:** Secondary buttons, module icons, footer CTA

### No Gradients
- All colors are **solid** (no gradients)
- Clean, modern, professional look
- Better performance and easier maintenance

---

## 📝 Admin Panel Usage

### Login
1. Go to: **http://localhost:8080/admin.php**
2. Default password: `admin123`
3. **⚠️ IMPORTANT:** Change this password in production!

### Add Questions
1. Login to admin panel
2. Enter question text
3. Upload an image (optional)
4. Enter all 4 options (A, B, C, D)
5. Select correct answer
6. Choose category (verbal, quantitative, logical, spatial)
7. Select difficulty level
8. Add explanation (optional)
9. Click **"Save Question"**

### Manage Questions
1. Switch to **"Manage Questions"** tab
2. View all questions with:
   - Question text
   - Options (correct answer highlighted in green)
   - Category and difficulty
   - Creation date
3. Delete unwanted questions with the red **"Delete"** button

---

## 🎯 Quiz System

### How It Works
1. Questions are loaded from **MySQL database**
2. Random selection of 20 questions
3. 30-minute timer
4. Instant results and scoring
5. Performance tracking

### Quiz URL
**http://localhost:8080/quiz.php**

---

## 📁 Project Structure

```
wordpress/
├── api/
│   └── get_questions.php     # API to fetch questions from database
├── assets/
│   ├── css/
│   │   └── style.css         # Main stylesheet (solid colors, no gradients)
│   └── images/
│       └── iconword.png       # Logo
├── includes/
│   ├── db_connection.php     # Database connection
│   ├── header.php            # Header template
│   └── footer.php            # Footer template
├── uploads/                   # Question images uploaded via admin
├── index.php                  # Homepage
├── quiz.php                   # Quiz page
├── demo.php                   # Demo page
├── admin.php                  # Admin panel
├── database_setup.sql         # Database schema
└── SETUP_INSTRUCTIONS.md      # This file
```

---

## 🎨 Color Reference

| Element | Color | Hex Code |
|---------|-------|----------|
| Primary (Cyan) | 🔵 | `#00D4FF` |
| Secondary (Purple) | 🟣 | `#C77DFF` |
| Text Dark | ⚫ | `#1e293b` |
| Text Medium | ⚫ | `#475569` |
| Text Light | ⚫ | `#64748b` |
| Background | ⚪ | `#fafbfc` |
| Success | 🟢 | `#28a745` |
| WhatsApp | 🟢 | `#25D366` |
| Telegram | 🔵 | `#0088cc` |

---

## ⚙️ Configuration

### Database Settings
Edit `includes/db_connection.php` if needed:
```php
define('DB_NAME', 'wordpress_db');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost');
```

### Admin Password
Change in `admin.php` line 9:
```php
$admin_password = "admin123"; // Change this!
```

---

## 🔧 Troubleshooting

### Database Connection Error
- ✅ Make sure MySQL is running in XAMPP
- ✅ Check database exists: `wordpress_db`
- ✅ Verify credentials in `includes/db_connection.php`

### No Questions in Quiz
- ✅ Login to admin panel and add questions
- ✅ Check tables exist in phpMyAdmin
- ✅ Check browser console for errors (F12)

### Images Not Uploading
- ✅ Create `uploads/` folder with write permissions
- ✅ Check PHP `upload_max_filesize` in php.ini
- ✅ Verify image format is supported (PNG, JPG, GIF)

---

## 🌐 URLs

| Page | URL |
|------|-----|
| Homepage | http://localhost:8080/index.php |
| Quiz | http://localhost:8080/quiz.php |
| Demo | http://localhost:8080/demo.php |
| Admin Panel | http://localhost:8080/admin.php |
| phpMyAdmin | http://localhost/phpmyadmin/ |

---

## ✅ Features

- ✨ Modern, clean UI with solid colors
- 📊 MySQL database storage
- 🖼️ Image support for questions
- 👨‍💼 Admin panel for managing questions
- ⏱️ Timed quiz system (30 minutes)
- 📈 Instant scoring and results
- 📱 Fully responsive design
- 🎨 Cyan & Purple color scheme (no gradients)
- 🔒 Simple authentication system

---

## 🚀 Getting Started

1. Start XAMPP (Apache + MySQL)
2. Create database `wordpress_db`
3. Import `database_setup.sql`
4. Access admin panel: http://localhost:8080/admin.php
5. Add questions via admin panel
6. Test quiz: http://localhost:8080/quiz.php
7. View homepage: http://localhost:8080/index.php

**That's it! Your quiz system is ready! 🎉**


