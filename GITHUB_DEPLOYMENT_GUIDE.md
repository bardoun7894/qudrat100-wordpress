# 🚀 GitHub Deployment Guide for WordPress Site

## Overview
This guide explains how to deploy your WordPress site to qudrat100.com using GitHub and automated CI/CD workflows.

---

## 📋 Prerequisites

- [ ] GitHub account
- [ ] FTP/SFTP access to your hosting server
- [ ] Live server database credentials
- [ ] SSL certificate configured on server
- [ ] Backup of current live site

---

## 🔧 Initial Setup

### Step 1: Create GitHub Repository

1. Go to [GitHub.com](https://github.com)
2. Click "New Repository"
3. Name it: `qudrat100-wordpress`
4. Set as **Private** repository (important for security)
5. Don't initialize with README (we already have files)

### Step 2: Connect Local to GitHub

```bash
# Add GitHub as remote origin
git remote add origin https://github.com/YOUR_USERNAME/qudrat100-wordpress.git

# Add all files
git add .

# Create first commit
git commit -m "Initial WordPress site with custom theme"

# Push to GitHub
git push -u origin main
```

---

## 🔐 Configure GitHub Secrets

### Navigate to Repository Settings

1. Go to your repository on GitHub
2. Click **Settings** → **Secrets and variables** → **Actions**
3. Click **New repository secret**

### Required Secrets for FTP Deployment

Add these secrets (get values from your hosting provider):

| Secret Name | Description | Example Value |
|------------|-------------|---------------|
| `FTP_SERVER` | FTP server address | `ftp.qudrat100.com` or IP address |
| `FTP_USERNAME` | FTP username | `your-ftp-user` |
| `FTP_PASSWORD` | FTP password | `your-ftp-password` |
| `FTP_PORT` | FTP port (usually 21) | `21` |
| `FTP_SERVER_DIR` | Remote directory path | `/public_html/` or `/www/` |

### Required Secrets for SFTP/SSH Deployment

If using SFTP instead:

| Secret Name | Description | Example Value |
|------------|-------------|---------------|
| `SSH_HOST` | Server hostname/IP | `qudrat100.com` |
| `SSH_USERNAME` | SSH username | `your-ssh-user` |
| `SSH_PORT` | SSH port (usually 22) | `22` |
| `SSH_PRIVATE_KEY` | Your SSH private key | Full private key content |
| `REMOTE_PATH` | Remote directory path | `/home/user/public_html/` |

---

## 📦 Deployment Workflows

### We've created two deployment options:

1. **FTP Deployment** (`.github/workflows/deploy.yml`)
   - Uses FTP protocol
   - Simpler setup
   - Works with most shared hosting

2. **SFTP Deployment** (`.github/workflows/deploy-sftp.yml`)
   - More secure
   - Uses SSH keys
   - Preferred for VPS/dedicated servers

### Choose Your Workflow

Delete the workflow file you won't use:
- If using FTP: Delete `deploy-sftp.yml`
- If using SFTP: Delete `deploy.yml`

---

## 🚀 Deployment Process

### Step 1: Prepare Production Config

1. **Create production wp-config.php on your server:**
   - Copy `wp-config-sample-production.php`
   - Rename to `wp-config.php`
   - Update with your database credentials
   - Generate new salts from [WordPress Salt Generator](https://api.wordpress.org/secret-key/1.1/salt/)

2. **Update includes/db_connection.php on server:**
   ```php
   define('DB_NAME', 'your_production_db');
   define('DB_USER', 'your_production_user');
   define('DB_PASSWORD', 'your_production_password');
   define('DB_HOST', 'localhost');
   ```

### Step 2: Initial Manual Setup

**First time only - Upload these manually via FTP:**

1. `wp-config.php` (with production credentials)
2. `includes/db_connection.php` (with production credentials)
3. Create `wp-content/uploads/` directory (chmod 755)

### Step 3: Deploy via GitHub

```bash
# Make changes locally
git add .
git commit -m "Update site features"
git push origin main
```

**GitHub Actions will automatically:**
1. Trigger deployment workflow
2. Connect to your server
3. Upload changed files
4. Skip sensitive files (wp-config.php, uploads, etc.)

### Step 4: Monitor Deployment

1. Go to GitHub repository
2. Click **Actions** tab
3. Watch deployment progress
4. Check for any errors

---

## 📁 What Gets Deployed

### ✅ Deployed Files:
- Custom theme (`wp-content/themes/custom-theme/`)
- Custom PHP files (`admin.php`, `demo.php`, `quiz.php`)
- API endpoints (`api/`)
- Includes (`includes/`)
- Assets (CSS, JS, images in theme)

### ❌ NOT Deployed (Security):
- `wp-config.php`
- `wp-content/uploads/`
- Database files (`*.sql`)
- Log files (`*.log`)
- Git files (`.git/`, `.github/`)
- Cache files
- Node modules

---

## 🗄️ Database Migration

### Export Local Database:

```bash
# Using phpMyAdmin
1. Go to http://localhost:8080/phpmyadmin
2. Select your database
3. Click Export
4. Choose SQL format
5. Download file
```

### Import to Production:

1. Login to your hosting cPanel/phpMyAdmin
2. Select production database
3. Click Import
4. Upload SQL file
5. Execute import

### Update URLs in Database:

```sql
-- Update site URL
UPDATE wp_options SET option_value = 'https://qudrat100.com'
WHERE option_name = 'siteurl' OR option_name = 'home';

-- Update content URLs
UPDATE wp_posts SET post_content = REPLACE(post_content, 'http://localhost:8080', 'https://qudrat100.com');
UPDATE wp_posts SET guid = REPLACE(guid, 'http://localhost:8080', 'https://qudrat100.com');
```

---

## 🔄 Continuous Deployment Workflow

### Development Cycle:

1. **Make changes locally**
   ```bash
   # Edit files
   # Test locally
   ```

2. **Commit changes**
   ```bash
   git add .
   git commit -m "Description of changes"
   ```

3. **Push to GitHub**
   ```bash
   git push origin main
   ```

4. **Automatic deployment**
   - GitHub Actions deploys to live server
   - Check Actions tab for status

### Branch Strategy:

- `main` branch → Production (qudrat100.com)
- `staging` branch → Staging site (optional)
- `develop` branch → Development (local only)

---

## 🛠️ Post-Deployment Tasks

### After First Deployment:

1. **WordPress Admin Tasks:**
   - Login: `https://qudrat100.com/wp-admin`
   - Go to Settings → Permalinks → Save (flush rewrite rules)
   - Go to Settings → Reading → Set static homepage
   - Activate custom theme if not active

2. **Security Tasks:**
   - Change admin password in `/admin.php`
   - Update WordPress admin password
   - Test login systems

3. **Testing:**
   - Test contact form submission
   - Test newsletter signup
   - Test quiz functionality (`/demo.php`)
   - Test admin panel (`/admin.php`)
   - Check all pages load correctly

4. **Performance:**
   - Enable caching plugin if needed
   - Configure CDN if applicable
   - Test site speed

---

## 🚨 Troubleshooting

### Deployment Failed:

1. **Check GitHub Actions logs:**
   - Go to Actions tab
   - Click on failed workflow
   - Read error messages

2. **Common issues:**
   - Wrong FTP credentials → Update GitHub secrets
   - Connection timeout → Check server firewall
   - Permission denied → Check folder permissions (755)

### Site Not Working:

1. **Database connection error:**
   - Verify wp-config.php credentials
   - Check database exists
   - Verify database user permissions

2. **404 errors:**
   - Flush permalinks in WordPress admin
   - Check .htaccess file exists
   - Verify mod_rewrite is enabled

3. **White screen:**
   - Enable debug mode in wp-config.php
   - Check PHP error logs
   - Verify PHP version compatibility

### Rollback Changes:

```bash
# Revert to previous commit
git revert HEAD
git push origin main

# Or reset to specific commit
git reset --hard <commit-hash>
git push --force origin main
```

---

## 📊 Monitoring

### GitHub Insights:

- View deployment history in Actions tab
- Set up email notifications for failures
- Monitor deployment duration trends

### Server Monitoring:

- Check error logs regularly
- Monitor disk space
- Track database size
- Review security logs

---

## 🔒 Security Best Practices

1. **Never commit sensitive files:**
   - wp-config.php
   - .env files
   - Database dumps
   - Password files

2. **Use GitHub secrets:**
   - All credentials in secrets
   - Rotate passwords regularly
   - Use strong passwords

3. **Repository settings:**
   - Keep repository private
   - Limit collaborator access
   - Enable 2FA on GitHub

4. **Server security:**
   - Regular backups
   - SSL certificate
   - Firewall rules
   - Security plugins

---

## 📝 Maintenance

### Regular Tasks:

- **Weekly:**
  - Check deployment logs
  - Review error logs
  - Test critical functions

- **Monthly:**
  - Update WordPress core
  - Update plugins/themes
  - Database optimization
  - Backup verification

- **Quarterly:**
  - Security audit
  - Performance review
  - Credential rotation

---

## 🆘 Getting Help

### Resources:

- [GitHub Actions Documentation](https://docs.github.com/en/actions)
- [WordPress Deployment Guide](https://wordpress.org/support/article/deploying-wordpress/)
- [FTP Deploy Action](https://github.com/SamKirkland/FTP-Deploy-Action)

### Support Contacts:

- Hosting provider support
- GitHub community forums
- WordPress.org forums

---

## ✅ Deployment Checklist

Before each deployment:

- [ ] Test all changes locally
- [ ] Backup production database
- [ ] Commit with descriptive message
- [ ] Verify GitHub secrets are set
- [ ] Monitor Actions tab during deployment
- [ ] Test live site after deployment
- [ ] Check error logs

---

## 🎯 Quick Commands Reference

```bash
# Initialize repository
git init
git remote add origin <your-repo-url>

# Daily workflow
git add .
git commit -m "Update: description"
git push origin main

# View deployment status
# Go to: https://github.com/YOUR_USERNAME/qudrat100-wordpress/actions

# Emergency rollback
git revert HEAD
git push origin main
```

---

**Document Version:** 1.0
**Created:** October 2024
**For:** qudrat100.com WordPress Deployment

---

## Next Steps

1. Create GitHub repository
2. Configure secrets
3. Push code to GitHub
4. Monitor first deployment
5. Test live site thoroughly

**You're ready to deploy! 🚀**