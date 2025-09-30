# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a WordPress installation with a custom Arabic educational theme for Qudrat100.com, a platform for cognitive ability test preparation (القدرة المعرفية). The site features course registration, quiz functionality, and an admin panel.

## Architecture

### WordPress Core Structure
- Standard WordPress 6.7.1 installation
- Custom theme: `wp-content/themes/custom-theme/`
- Database: MySQL with custom tables for quiz functionality

### Custom Components
1. **Quiz System** - Standalone PHP application integrated with WordPress
   - `/quiz.php` - Main quiz interface
   - `/demo.php` - Free demo quiz
   - `/admin.php` - Custom admin panel for quiz management
   - `/api/get_questions.php` - REST API endpoint for quiz questions

2. **Database Tables** (auto-created on theme activation)
   - `wp_quiz_questions` - Quiz questions storage
   - `wp_quiz_results` - Student results tracking
   - `wp_course_registrations` - Course registration submissions

3. **Form Handlers** (in theme functions.php)
   - Contact form with nonce verification
   - Newsletter subscription
   - Email notifications

## Development Commands

### Local Development
- **Start local server**: Use XAMPP/WAMP/MAMP with Apache and MySQL
- **Access site**: `http://localhost:8080/` (or configured port)
- **Admin panel**: `http://localhost:8080/wp-admin/`
- **Custom quiz admin**: `http://localhost:8080/admin.php`

### Database
- **Connection file**: `/includes/db_connection.php`
- Uses WordPress database credentials from `wp-config.php`
- Default local: `DB_NAME='wordpress_db'`, `DB_USER='root'`, `DB_PASSWORD=''`

## Key Files

### Theme Files
- `wp-content/themes/custom-theme/front-page.php` - Homepage template
- `wp-content/themes/custom-theme/functions.php` - Theme functionality and form handlers
- `wp-content/themes/custom-theme/style.css` - Complete theme styling (blue/indigo design)

### Standalone Applications
- `/admin.php` - Quiz admin panel (login: admin/admin123 - change in production)
- `/quiz.php` - Main quiz application
- `/demo.php` - Free demo quiz
- `/includes/db_connection.php` - Database connection handler

## Deployment

### Recommended: All-in-One WP Migration Plugin
1. Already installed in `wp-content/plugins/all-in-one-wp-migration/`
2. Export locally: All-in-One WP Migration → Export
3. Import on live site: All-in-One WP Migration → Import

### Post-Deployment Configuration
1. Update `/includes/db_connection.php` with production credentials
2. Change admin password in `/admin.php`
3. Set static homepage: Settings → Reading → "A static page"
4. Refresh permalinks: Settings → Permalinks → Save Changes

## Theme Features

- **RTL Support**: Full Arabic language support with Cairo font
- **Responsive Design**: Mobile-first approach with breakpoints at 320px, 480px, 768px, 1024px
- **Color Scheme**: Primary blue (#2563EB), Secondary indigo (#6366F1)
- **Security**: WordPress nonces, prepared statements, input sanitization
- **Custom Forms**: Contact form and newsletter with database storage

## Important Notes

- Theme activates custom database tables automatically
- Quiz system uses standalone PHP but shares WordPress database
- Admin panel (`/admin.php`) is separate from WordPress admin
- All form submissions are stored in database and emailed to admin
- File editing disabled for production security (`DISALLOW_FILE_EDIT`)