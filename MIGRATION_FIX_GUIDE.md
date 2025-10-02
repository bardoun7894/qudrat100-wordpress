# 🚀 WordPress Migration Fix Guide - Localhost to Live Server

## 🎯 Critical Issues to Fix Before Going Live

This guide addresses the most common WordPress migration issues that cause sites to break when moving from localhost to live servers.

---

## 🔧 Step 1: Database URL Updates (CRITICAL)

### A. WordPress Database URL Updates

**Run these SQL commands in your live server's phpMyAdmin:**

```sql
-- Update site URL in wp_options table
UPDATE wp_options SET option_value = 'https://qudrat100.com' WHERE option_name = 'home';
UPDATE wp_options SET option_value = 'https://qudrat100.com' WHERE option_name = 'siteurl';

-- Update all post content URLs
UPDATE wp_posts SET post_content = REPLACE(post_content, 'http://localhost:8080', 'https://qudrat100.com');
UPDATE wp_posts SET post_content = REPLACE(post_content, 'http://localhost', 'https://qudrat100.com');

-- Update post GUIDs
UPDATE wp_posts SET guid = REPLACE(guid, 'http://localhost:8080', 'https://qudrat100.com');
UPDATE wp_posts SET guid = REPLACE(guid, 'http://localhost', 'https://qudrat100.com');

-- Update meta values
UPDATE wp_postmeta SET meta_value = REPLACE(meta_value, 'http://localhost:8080', 'https://qudrat100.com');
UPDATE wp_postmeta SET meta_value = REPLACE(meta_value, 'http://localhost', 'https://qudrat100.com');

-- Update comments
UPDATE wp_comments SET comment_content = REPLACE(comment_content, 'http://localhost:8080', 'https://qudrat100.com');
UPDATE wp_comments SET comment_content = REPLACE(comment_content, 'http://localhost', 'https://qudrat100.com');
```

### B. Custom Database Tables (Your Quiz System)

```sql
-- Update any URLs in quiz_questions table if they exist
UPDATE quiz_questions SET question_text = REPLACE(question_text, 'http://localhost:8080', 'https://qudrat100.com');
UPDATE quiz_questions SET question_text = REPLACE(question_text, 'http://localhost', 'https://qudrat100.com');

-- Update image paths if they contain absolute URLs
UPDATE quiz_questions SET image_path = REPLACE(image_path, 'http://localhost:8080', 'https://qudrat100.com');
UPDATE quiz_questions SET image_path = REPLACE(image_path, 'http://localhost', 'https://qudrat100.com');
```

---

## 🔧 Step 2: Update Database Connection Files

### A. Update includes/db_connection.php

**Current file has localhost hardcoded. Update it to:**

```php
<?php
/**
 * Database Connection
 * Uses WordPress database configuration
 */

// Include WordPress config if available
if (file_exists('../wp-config.php')) {
    require_once('../wp-config.php');
} elseif (file_exists('wp-config.php')) {
    require_once('wp-config.php');
} else {
    // Live server configuration - UPDATE THESE VALUES
    define('DB_NAME', 'your_live_database_name');
    define('DB_USER', 'your_live_database_user');
    define('DB_PASSWORD', 'your_live_database_password');
    define('DB_HOST', 'localhost'); // or your hosting provider's DB host
    define('DB_CHARSET', 'utf8mb4');
}

// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check connection
if ($conn->connect_error) {
    error_log("Database connection failed: " . $conn->connect_error);
    die("Connection failed. Please check your database configuration.");
}

// Set charset
$conn->set_charset(DB_CHARSET);

// Return connection
return $conn;
?>
```

### B. Update wp-config.php for Live Server

**Create/update wp-config.php with live server credentials:**

```php
<?php
// Live server database configuration
define('DB_NAME', 'your_live_database_name');
define('DB_USER', 'your_live_database_user');
define('DB_PASSWORD', 'your_live_database_password');
define('DB_HOST', 'localhost'); // Check with your hosting provider

// WordPress URLs
define('WP_HOME','https://qudrat100.com');
define('WP_SITEURL','https://qudrat100.com');

// Security keys - Generate new ones at https://api.wordpress.org/secret-key/1.1/salt/
define('AUTH_KEY',         'put your unique phrase here');
define('SECURE_AUTH_KEY',  'put your unique phrase here');
define('LOGGED_IN_KEY',    'put your unique phrase here');
define('NONCE_KEY',        'put your unique phrase here');
define('AUTH_SALT',        'put your unique phrase here');
define('SECURE_AUTH_SALT', 'put your unique phrase here');
define('LOGGED_IN_SALT',   'put your unique phrase here');
define('NONCE_SALT',       'put your unique phrase here');

// Database table prefix
$table_prefix = 'wp_';

// Debug settings (turn off for live)
define('WP_DEBUG', false);
define('WP_DEBUG_LOG', false);
define('WP_DEBUG_DISPLAY', false);

// SSL settings
define('FORCE_SSL_ADMIN', true);

// File permissions
define('FS_METHOD', 'direct');

// That's all, stop editing!
if ( !defined('ABSPATH') )
    define('ABSPATH', dirname(__FILE__) . '/');

require_once(ABSPATH . 'wp-settings.php');
?>
```

---

## 🔧 Step 3: Fix File Paths and Resource Loading

### A. Update .htaccess File

**Create/update .htaccess in your root directory:**

```apache
# BEGIN WordPress
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteBase /
RewriteRule ^index\.php$ - [L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . /index.php [L]
</IfModule>
# END WordPress

# Security headers
<IfModule mod_headers.c>
Header always set X-Content-Type-Options nosniff
Header always set X-Frame-Options DENY
Header always set X-XSS-Protection "1; mode=block"
</IfModule>

# Gzip compression
<IfModule mod_deflate.c>
AddOutputFilterByType DEFLATE text/plain
AddOutputFilterByType DEFLATE text/html
AddOutputFilterByType DEFLATE text/xml
AddOutputFilterByType DEFLATE text/css
AddOutputFilterByType DEFLATE application/xml
AddOutputFilterByType DEFLATE application/xhtml+xml
AddOutputFilterByType DEFLATE application/rss+xml
AddOutputFilterByType DEFLATE application/javascript
AddOutputFilterByType DEFLATE application/x-javascript
</IfModule>
```

### B. Fix Image and Asset Paths

**Check these files for relative paths:**

1. **quiz.php** - Ensure CSS/JS paths are relative:
```php
$additional_css = ['assets/css/quiz.css'];
$additional_js = ['assets/js/quiz.js'];
```

2. **admin.php** - Ensure upload paths are relative:
```php
$upload_dir = 'uploads/questions/';
```

3. **Custom theme files** - Check all asset references

---

## 🔧 Step 4: WordPress Admin Fixes

### A. Reset Permalinks (CRITICAL)

**After migration, ALWAYS do this:**

1. Login to WordPress admin: `https://qudrat100.com/wp-admin/`
2. Go to **Settings > Permalinks**
3. Click **Save Changes** (even without changing anything)
4. This regenerates the .htaccess file with correct paths

### B. Update Theme Settings

1. Go to **Appearance > Themes**
2. Activate your custom theme if not active
3. Go to **Appearance > Customize**
4. Check all theme settings and save

---

## 🔧 Step 5: Security and Performance Fixes

### A. Update Admin Password

**Change the default admin password in admin.php:**

```php
// Line 9 in admin.php - CHANGE THIS
$admin_password = "your_secure_password_here"; // Use a strong password
```

### B. File Permissions

**Set correct file permissions on live server:**

```bash
# Directories should be 755
find /path/to/wordpress/ -type d -exec chmod 755 {} \;

# Files should be 644
find /path/to/wordpress/ -type f -exec chmod 644 {} \;

# wp-config.php should be 600
chmod 600 wp-config.php
```

### C. Remove Development Files

**Delete these files from live server:**

- All `.md` documentation files (except README if needed)
- `docker-compose.yml`
- `Dockerfile`
- `check-env.php`
- `db-test.php`
- `pdo-test.php`
- `test-connection.php`
- `info.php`

---

## 🔧 Step 6: Testing Checklist

### A. Critical Tests

- [ ] **Homepage loads**: `https://qudrat100.com/`
- [ ] **WordPress admin works**: `https://qudrat100.com/wp-admin/`
- [ ] **Quiz system works**: `https://qudrat100.com/quiz.php`
- [ ] **Admin panel works**: `https://qudrat100.com/admin.php`
- [ ] **Demo page works**: `https://qudrat100.com/demo.php`
- [ ] **Images display correctly**
- [ ] **CSS styles load properly**
- [ ] **JavaScript functions work**
- [ ] **Database connections work**
- [ ] **Forms submit correctly**

### B. Performance Tests

- [ ] **Page load speed < 3 seconds**
- [ ] **Mobile responsiveness**
- [ ] **SSL certificate working**
- [ ] **All links work (no 404 errors)**

---

## 🚨 Common Error Solutions

### Error: "Error establishing a database connection"

**Solution:**
1. Check wp-config.php database credentials
2. Verify database exists on live server
3. Check database host (might not be 'localhost')
4. Contact hosting provider for correct DB settings

### Error: "Page not found" or 404 errors

**Solution:**
1. Reset permalinks in WordPress admin
2. Check .htaccess file exists and is correct
3. Verify file permissions

### Error: Images not displaying

**Solution:**
1. Check image paths in database
2. Verify uploads folder exists and has correct permissions
3. Update image URLs in database

### Error: CSS/JS not loading

**Solution:**
1. Check file paths in theme files
2. Verify assets folder uploaded correctly
3. Check for hardcoded localhost URLs

---

## 🎯 Quick Migration Script

**Create this PHP script to run on your live server:**

```php
<?php
// migration-fix.php - Run this ONCE on your live server

$live_url = 'https://qudrat100.com';
$old_urls = ['http://localhost:8080', 'http://localhost'];

// Database connection
$servername = "localhost"; // Update if needed
$username = "your_db_user";
$password = "your_db_password";
$dbname = "your_db_name";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Starting URL migration...\n";

foreach ($old_urls as $old_url) {
    // Update wp_options
    $sql = "UPDATE wp_options SET option_value = REPLACE(option_value, '$old_url', '$live_url')";
    $conn->query($sql);
    
    // Update wp_posts
    $sql = "UPDATE wp_posts SET post_content = REPLACE(post_content, '$old_url', '$live_url')";
    $conn->query($sql);
    
    // Update wp_posts GUID
    $sql = "UPDATE wp_posts SET guid = REPLACE(guid, '$old_url', '$live_url')";
    $conn->query($sql);
    
    // Update wp_postmeta
    $sql = "UPDATE wp_postmeta SET meta_value = REPLACE(meta_value, '$old_url', '$live_url')";
    $conn->query($sql);
    
    echo "Updated URLs from $old_url to $live_url\n";
}

echo "Migration completed!\n";
echo "Don't forget to:\n";
echo "1. Reset permalinks in WordPress admin\n";
echo "2. Check all pages work correctly\n";
echo "3. Delete this migration script\n";

$conn->close();
?>
```

---

## 📞 Support

If you encounter issues:

1. **Check error logs** on your hosting server
2. **Contact hosting support** for server-specific issues
3. **Use WordPress debugging** by enabling WP_DEBUG
4. **Test each component** individually

---

**Remember:** Always backup your database before making changes!

**Last Updated:** January 2025