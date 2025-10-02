# WordPress Migration Deployment Checklist

## Pre-Deployment Preparation

### 1. Database Preparation
- [ ] Export WordPress database from localhost
- [ ] Export custom quiz tables (`quiz_questions`, `quiz_results`, `course_registrations`)
- [ ] Run URL replacement script on database dump
- [ ] Replace all `localhost:8080` with `https://qudrat100.com`
- [ ] Replace all `http://localhost` with `https://qudrat100.com`

### 2. File Preparation
- [ ] Copy all WordPress core files
- [ ] Copy custom theme files
- [ ] Copy `admin.php`, `quiz.php`, `demo.php`
- [ ] Copy `assets/` directory (CSS, JS, images)
- [ ] Copy `api/` directory
- [ ] Copy `includes/` directory
- [ ] Copy `uploads/` directory (if exists)
- [ ] Ensure `.htaccess` file is included

### 3. Configuration Files
- [ ] Update `wp-config.php` with live database credentials
- [ ] Update `includes/db_connection.php` with live settings
- [ ] Verify `includes/config.php` is properly configured
- [ ] Check all file paths are relative, not absolute

## Live Server Setup

### 4. Server Requirements
- [ ] PHP 7.4 or higher
- [ ] MySQL 5.7 or higher
- [ ] Apache with mod_rewrite enabled
- [ ] SSL certificate installed
- [ ] Proper file permissions set (755 for directories, 644 for files)

### 5. Database Setup
- [ ] Create new database on live server
- [ ] Create database user with proper privileges
- [ ] Import WordPress database
- [ ] Import custom quiz tables
- [ ] Verify all tables are created successfully

### 6. File Upload
- [ ] Upload all files via FTP/SFTP
- [ ] Verify file structure is intact
- [ ] Check file permissions
- [ ] Ensure uploads directory is writable (755)

## Post-Deployment Configuration

### 7. WordPress Configuration
- [ ] Update `wp-config.php` with live database credentials:
  ```php
  define('DB_NAME', 'your_live_database');
  define('DB_USER', 'your_live_username');
  define('DB_PASSWORD', 'your_live_password');
  define('DB_HOST', 'localhost');
  ```
- [ ] Update site URLs in WordPress admin
- [ ] Reset permalinks in WordPress admin (Settings > Permalinks > Save)
- [ ] Clear any caching plugins

### 8. Custom Application Configuration
- [ ] Test admin panel access (`https://qudrat100.com/admin.php`)
- [ ] Verify quiz functionality (`https://qudrat100.com/quiz.php`)
- [ ] Test demo page (`https://qudrat100.com/demo.php`)
- [ ] Check API endpoints work correctly

### 9. Resource Path Verification
- [ ] Verify CSS files load correctly
- [ ] Verify JavaScript files load correctly
- [ ] Check all images display properly
- [ ] Test file uploads in admin panel
- [ ] Verify Font Awesome icons display
- [ ] Check Google Fonts load correctly

### 10. Database URL Updates
Run the migration script or manually update:
- [ ] WordPress options table (`siteurl`, `home`)
- [ ] Posts/pages with hardcoded URLs
- [ ] Custom quiz question images paths
- [ ] Widget content with URLs
- [ ] Theme customizer settings

## Testing Checklist

### 11. Functionality Testing
- [ ] Homepage loads correctly
- [ ] Navigation menu works
- [ ] Quiz system functions properly
- [ ] Admin panel login works
- [ ] Question management works
- [ ] File uploads work
- [ ] Contact forms work (if any)
- [ ] All internal links work

### 12. Performance Testing
- [ ] Page load speeds are acceptable
- [ ] Images are optimized and load quickly
- [ ] CSS/JS files are minified (if applicable)
- [ ] Caching is working (if enabled)

### 13. Security Testing
- [ ] Admin panel is secure
- [ ] File permissions are correct
- [ ] Sensitive files are protected
- [ ] SSL certificate is working
- [ ] Security headers are set

### 14. Mobile Testing
- [ ] Site is responsive on mobile devices
- [ ] Quiz works on mobile
- [ ] Navigation works on mobile
- [ ] Touch interactions work properly

## Common Issues and Solutions

### URL Issues
- **Problem**: Images not loading
- **Solution**: Check image paths in database and files
- **Command**: Run migration script to update URLs

### Database Connection Issues
- **Problem**: "Error establishing database connection"
- **Solution**: Verify database credentials in `wp-config.php`

### Permission Issues
- **Problem**: File upload errors
- **Solution**: Set proper permissions (755 for directories, 644 for files)

### CSS/JS Not Loading
- **Problem**: Styles or scripts not working
- **Solution**: Check file paths and verify files uploaded correctly

### Quiz Not Working
- **Problem**: Quiz questions not loading
- **Solution**: Verify API endpoints and database connection

## Final Verification

### 15. Complete Site Review
- [ ] All pages load without errors
- [ ] No broken links or images
- [ ] Quiz system fully functional
- [ ] Admin panel accessible and working
- [ ] Contact information updated
- [ ] Analytics/tracking codes added (if needed)
- [ ] Backup system in place

### 16. SEO and Analytics
- [ ] Update Google Analytics (if used)
- [ ] Submit sitemap to search engines
- [ ] Update social media links
- [ ] Verify meta tags and descriptions

## Emergency Rollback Plan
- [ ] Keep localhost version as backup
- [ ] Have database backup ready
- [ ] Document all changes made
- [ ] Have hosting support contact ready

## Post-Launch Monitoring
- [ ] Monitor error logs for first 24 hours
- [ ] Check site performance
- [ ] Monitor user feedback
- [ ] Test all functionality regularly

---

## Quick Migration Commands

### Database URL Replacement (MySQL)
```sql
UPDATE wp_options SET option_value = replace(option_value, 'http://localhost:8080', 'https://qudrat100.com');
UPDATE wp_posts SET post_content = replace(post_content, 'http://localhost:8080', 'https://qudrat100.com');
UPDATE wp_postmeta SET meta_value = replace(meta_value, 'http://localhost:8080', 'https://qudrat100.com');
UPDATE wp_comments SET comment_content = replace(comment_content, 'http://localhost:8080', 'https://qudrat100.com');
```

### File Permissions (Linux/Unix)
```bash
find /path/to/wordpress/ -type d -exec chmod 755 {} \;
find /path/to/wordpress/ -type f -exec chmod 644 {} \;
chmod 600 wp-config.php
```

### Test URLs
- Homepage: `https://qudrat100.com/`
- Quiz: `https://qudrat100.com/quiz.php`
- Admin: `https://qudrat100.com/admin.php`
- Demo: `https://qudrat100.com/demo.php`
- API Test: `https://qudrat100.com/api/get_questions.php`

---

**Note**: Always test on a staging environment before deploying to production!