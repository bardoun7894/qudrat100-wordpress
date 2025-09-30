# 🔍 Getting Credentials from Your Live WordPress Site

## Method 1: From WordPress wp-config.php File

### If you have access to your live WordPress files:

1. **Login to your WordPress site:**
   - Go to: https://qudrat100.com/wp-admin
   - Use your WordPress admin username/password

2. **Access File Manager or FTP:**
   - **Option A:** Use Hostinger File Manager (hPanel → File Manager)
   - **Option B:** Use FTP client if you have credentials

3. **Find wp-config.php:**
   - Located in the root directory of your website
   - Path: `/public_html/wp-config.php`

4. **Look for these lines in wp-config.php:**
   ```php
   define('DB_NAME', 'u123456789_wordpress');     // Database name
   define('DB_USER', 'u123456789_wp');            // Database username
   define('DB_PASSWORD', 'your_db_password');     // Database password
   define('DB_HOST', 'localhost');                // Database host
   ```

---

## Method 2: From WordPress Admin (Limited Info)

### Check WordPress admin for hosting details:

1. **Go to:** https://qudrat100.com/wp-admin
2. **Navigate to:** Tools → Site Health → Info
3. **Look for:** Database and Server information

---

## Method 3: From Hostinger Directly

### Best method - Get everything from Hostinger:

1. **Login to Hostinger:**
   - Go to: https://hpanel.hostinger.com
   - Use your Hostinger account credentials (not WordPress)

2. **Select your domain:** qudrat100.com

3. **Get FTP Credentials:**
   - Navigate: **Files** → **FTP Accounts**
   - Copy: Server, Username, Password

4. **Get Database Credentials:**
   - Navigate: **Databases** → **MySQL Databases**
   - Copy: Database name, Username, Password

---

## Method 4: Check Email Records

### Search your email for Hostinger welcome messages:

**Search for emails from:**
- **From:** Hostinger, hosting, support
- **Subject containing:**
  - "Welcome to Hostinger"
  - "Your hosting account"
  - "Database credentials"
  - "FTP details"
  - "qudrat100.com"

---

## What We Need for GitHub Secrets

### FTP Credentials (for deployment):
```
FTP_SERVER: ftp.qudrat100.com (or from Hostinger)
FTP_USERNAME: u123456789 (from Hostinger)
FTP_PASSWORD: [your FTP password]
FTP_PORT: 21
FTP_SERVER_DIR: /public_html/
```

### Database Credentials (for wp-config.php):
```
DB_NAME: u123456789_wordpress
DB_USER: u123456789_wp
DB_PASSWORD: [database password]
DB_HOST: localhost
```

---

## Quick Steps to Try Now

### Step 1: Try WordPress Admin
- Go to: https://qudrat100.com/wp-admin
- Can you login? If yes, we can find more info

### Step 2: Check for Hosting Emails
- Search your email for "Hostinger" + "qudrat100"
- Look for welcome/setup emails

### Step 3: Contact Hostinger Support
- If you have a Hostinger account, use their live chat
- Say: "I need FTP and database credentials for qudrat100.com"

---

## Alternative: Use All-in-One Migration

### If we can't get FTP working:

1. **Export from local:**
   - Use All-in-One WP Migration plugin locally
   - Create backup file

2. **Upload manually:**
   - Login to qudrat100.com/wp-admin
   - Install All-in-One WP Migration plugin
   - Import the backup file

---

## Security Note

**Never share actual credentials in chat!**
Once you find them:
1. Add directly to GitHub Secrets
2. Don't paste them in messages
3. Keep them secure

---

## Need Help?

**Tell me:**
1. Can you access https://qudrat100.com/wp-admin?
2. Do you have a Hostinger account login?
3. Can you find any Hostinger emails?

**I'll guide you through whichever method works!**