# 📋 Pre-Deployment Checklist for qudrat100.com

## Before You Start

**Date:** _________________  
**Deployed by:** _________________  
**Server:** qudrat100.com

---

## ✅ Phase 1: Preparation (CRITICAL)

### Local Environment
- [ ] All features tested locally
- [ ] Quiz loads questions correctly
- [ ] Admin panel works properly
- [ ] Images upload successfully
- [ ] Database connection working
- [ ] Forms submit correctly
- [ ] No console errors in browser (F12)

### Backup Current Site (MANDATORY!)
- [ ] Full website backup downloaded from cPanel
- [ ] Current database exported from phpMyAdmin
- [ ] Backup stored safely offline
- [ ] Verified backup files can be restored
- [ ] Current `index.php` backed up separately
- [ ] `wp-config.php` backed up (contains DB credentials)

### Access Credentials Ready
- [ ] cPanel login credentials available
- [ ] FTP/SFTP credentials available
- [ ] MySQL/phpMyAdmin access confirmed
- [ ] Domain registrar access (if DNS changes needed)
- [ ] Hosting support contact information available

---

## ✅ Phase 2: File Preparation

### Update Configuration Files
- [ ] Opened `includes/db_connection.php`
- [ ] Updated `$username` with live DB user
- [ ] Updated `$password` with live DB password
- [ ] Updated `$dbname` with live DB name
- [ ] Confirmed `$servername` (usually "localhost")
- [ ] File saved with UTF-8 encoding

### Verify All Required Files Present
- [ ] `index.php` ✓
- [ ] `demo.php` ✓
- [ ] `quiz.php` ✓
- [ ] `admin.php` ✓
- [ ] `assets/css/style.css` ✓
- [ ] `assets/images/iconword.png` ✓
- [ ] `assets/images/بروشور-دورة-القدرة-المعرفية-ج47.jpg` ✓
- [ ] `includes/header.php` ✓
- [ ] `includes/footer.php` ✓
- [ ] `includes/db_connection.php` ✓
- [ ] `api/get_questions.php` ✓
- [ ] `database_setup.sql` ✓

### Run Deployment Package Script (Optional)
- [ ] Ran `prepare_deployment.bat`
- [ ] Verified deployment_package folder created
- [ ] All files copied successfully
- [ ] Updated db_connection.php in deployment package

---

## ✅ Phase 3: Upload Files

### Via FTP/FileZilla
- [ ] Connected to FTP successfully
- [ ] Navigated to `/public_html/` directory
- [ ] Created `/public_html/api/` folder
- [ ] Created `/public_html/includes/` folder if not exists
- [ ] Created `/public_html/assets/css/` folders if not exist
- [ ] Created `/public_html/assets/images/` folders if not exist
- [ ] Created `/public_html/uploads/questions/` folder
- [ ] Uploaded `index.php` (REPLACES current homepage)
- [ ] Uploaded `demo.php`
- [ ] Uploaded `quiz.php`
- [ ] Uploaded `admin.php`
- [ ] Uploaded all `/assets/` files
- [ ] Uploaded all `/includes/` files
- [ ] Uploaded all `/api/` files
- [ ] Verified all files uploaded (check file sizes)

### Set Correct Permissions
- [ ] `/uploads/questions/` set to 755 or 775
- [ ] `admin.php` set to 644
- [ ] All PHP files set to 644
- [ ] All folders set to 755
- [ ] All image files set to 644
- [ ] CSS files set to 644

---

## ✅ Phase 4: Database Setup

### Get Live Database Credentials
- [ ] Logged into cPanel
- [ ] Opened File Manager
- [ ] Located `wp-config.php` in root
- [ ] Noted `DB_NAME` value: __________________
- [ ] Noted `DB_USER` value: __________________
- [ ] Noted `DB_PASSWORD` value: __________________
- [ ] Noted `DB_HOST` value: __________________

### Execute SQL Setup
- [ ] Opened phpMyAdmin from cPanel
- [ ] Selected correct WordPress database
- [ ] Clicked "SQL" tab
- [ ] Pasted contents of `database_setup.sql`
- [ ] Clicked "Go" to execute
- [ ] Verified success message received
- [ ] Checked "Structure" tab for new tables:
  - [ ] `quiz_questions` table created
  - [ ] `quiz_results` table created
  - [ ] `course_registrations` table created

### Verify Database Connection
- [ ] Updated `/includes/db_connection.php` on server (if not done before upload)
- [ ] Credentials match wp-config.php values
- [ ] Character set set to `utf8mb4`

---

## ✅ Phase 5: Initial Testing

### Homepage Test
- [ ] Visited: `https://qudrat100.com/`
- [ ] Page loads without errors
- [ ] New design displays correctly
- [ ] All images load properly
- [ ] CSS styling applied correctly
- [ ] Navigation menu works
- [ ] Links point to correct pages
- [ ] Responsive design works (test mobile view)

### Demo Quiz Test
- [ ] Visited: `https://qudrat100.com/demo.php`
- [ ] Quiz page loads
- [ ] Sample questions display
- [ ] Can select answers
- [ ] Submit button works
- [ ] Results page displays
- [ ] Score calculates correctly
- [ ] "Back" buttons work

### Main Quiz Test
- [ ] Visited: `https://qudrat100.com/quiz.php`
- [ ] Quiz loads (may be empty if no questions yet)
- [ ] No JavaScript errors in console (F12)
- [ ] API endpoint working: `https://qudrat100.com/api/get_questions.php`

### Admin Panel Test
- [ ] Visited: `https://qudrat100.com/admin.php`
- [ ] Login page displays
- [ ] Can login with credentials:
  - Username: `admin`
  - Password: `admin123` (default)
- [ ] Dashboard loads after login
- [ ] All tabs accessible (Questions, Analytics, Stats)

---

## ✅ Phase 6: Admin Panel Configuration

### Change Admin Password (CRITICAL!)
- [ ] Logged into admin panel
- [ ] **⚠️ IMPORTANT:** Change default password immediately!
- [ ] (Currently requires manual code edit - will be improved)
- [ ] New password documented securely
- [ ] Tested logout and login with new password

### Add Test Question
- [ ] Clicked "Add New Question" tab
- [ ] Filled in all question fields
- [ ] Selected correct answer
- [ ] Uploaded test image
- [ ] Clicked "Add Question"
- [ ] Success message received
- [ ] Question appears in "Manage Questions" tab

### Verify Question in Quiz
- [ ] Visited: `https://qudrat100.com/quiz.php`
- [ ] Test question appears in quiz
- [ ] Image displays correctly
- [ ] All options visible
- [ ] Can answer and submit

---

## ✅ Phase 7: Comprehensive Testing

### Browser Compatibility
- [ ] Tested in Chrome
- [ ] Tested in Firefox
- [ ] Tested in Safari (if Mac available)
- [ ] Tested in Edge

### Device Responsiveness
- [ ] Desktop (1920px)
- [ ] Laptop (1366px)
- [ ] Tablet (768px)
- [ ] Mobile (375px)
- [ ] Mobile (320px - small phones)

### Form Testing
- [ ] Registration form submits
- [ ] Contact form works (if present)
- [ ] Form validation works
- [ ] Thank you messages display

### Arabic Text Display
- [ ] Arabic headings display correctly
- [ ] Arabic questions display correctly
- [ ] Right-to-left layout works
- [ ] No ???????? characters appear
- [ ] Font rendering is clear

### Image Loading
- [ ] Logo/icon displays
- [ ] Course brochure image loads
- [ ] Question images load
- [ ] No broken image icons
- [ ] Images scale correctly on mobile

### Performance Check
- [ ] Page loads in under 3 seconds
- [ ] Images are optimized
- [ ] CSS loads without delay
- [ ] No 404 errors in Network tab (F12)

---

## ✅ Phase 8: Security Check

### File Permissions
- [ ] No files set to 777 (security risk)
- [ ] Sensitive files have restricted access
- [ ] `.htaccess` file present in root (WordPress default)

### Admin Security
- [ ] Default password changed
- [ ] Admin URL not easily guessable (consider renaming)
- [ ] Login attempts limited (already implemented)
- [ ] Session timeout active (2 hours - already implemented)

### Database Security
- [ ] Not using 'root' MySQL user
- [ ] Strong database password
- [ ] Database prefix uses 'wp_' or custom (check wp-config.php)

### SSL Certificate
- [ ] Site loads with https://
- [ ] No mixed content warnings
- [ ] SSL certificate valid and not expired

---

## ✅ Phase 9: Content Population

### Add Real Quiz Questions
- [ ] Added at least 10 real questions
- [ ] Each question has:
  - [ ] Clear question text
  - [ ] 4 options (A, B, C, D)
  - [ ] Correct answer marked
  - [ ] Category assigned
  - [ ] Difficulty level set
  - [ ] Explanation (optional but helpful)
- [ ] Questions vary in difficulty
- [ ] Images uploaded where relevant

### Verify Quiz Functionality
- [ ] Took complete quiz with real questions
- [ ] All questions load properly
- [ ] Timer works correctly
- [ ] Score calculates accurately
- [ ] Results save to database
- [ ] Can review answers

---

## ✅ Phase 10: Final Verification

### Live Site Check
- [ ] No PHP errors visible on any page
- [ ] No JavaScript console errors
- [ ] All links work (no 404s)
- [ ] Contact information correct
- [ ] Social media links correct (if present)
- [ ] Copyright year correct (2025)

### Analytics & Monitoring (Optional)
- [ ] Google Analytics installed (if desired)
- [ ] Search Console configured (if desired)
- [ ] Uptime monitoring set up (optional)
- [ ] Error logging configured

### Documentation
- [ ] Admin credentials documented securely
- [ ] Database credentials documented securely
- [ ] Server/hosting details documented
- [ ] Backup schedule established
- [ ] Maintenance plan created

---

## ✅ Phase 11: Go Live Preparation

### Announcement Preparation
- [ ] Tested all features one final time
- [ ] Prepared social media announcements (if applicable)
- [ ] Informed stakeholders of launch
- [ ] Support plan ready for user questions

### Monitoring Plan
- [ ] Plan to check site hourly for first day
- [ ] Error log monitoring set up
- [ ] User feedback collection method ready
- [ ] Bug tracking system ready (even if just a notebook)

### Emergency Contacts
- [ ] Hosting provider support number: __________________
- [ ] Developer contact: __________________
- [ ] Database admin contact: __________________

---

## ✅ Phase 12: Post-Launch (First 24 Hours)

### Immediate Monitoring (First Hour)
- [ ] Check site loads correctly
- [ ] Monitor for any error reports
- [ ] Test from multiple locations/networks
- [ ] Verify admin panel still accessible

### First Day Checklist
- [ ] Check site every 2-3 hours
- [ ] Monitor user registrations (if any)
- [ ] Review any error logs
- [ ] Respond to any user issues quickly
- [ ] Track site performance/speed

### Within 24 Hours
- [ ] Verify email notifications working (if configured)
- [ ] Check quiz submissions in database
- [ ] Review admin analytics for any issues
- [ ] Document any bugs found
- [ ] Plan fixes for any issues discovered

---

## 🚨 Emergency Rollback Plan

If critical issues occur:

### Quick Rollback Steps
1. [ ] Rename new `index.php` to `index-new.php`
2. [ ] Restore backup `index.php`
3. [ ] Clear browser cache and test
4. [ ] Notify users if necessary

### Full Rollback Steps
1. [ ] Access cPanel
2. [ ] Use Backup Restore feature
3. [ ] Select backup from before deployment
4. [ ] Restore database from phpMyAdmin backup
5. [ ] Verify old site is working
6. [ ] Investigate issues offline before re-deploying

---

## 📞 Emergency Contacts

| Contact | Name | Phone | Email |
|---------|------|-------|-------|
| Hosting Support | _____________ | _____________ | _____________ |
| Developer | _____________ | _____________ | _____________ |
| Database Admin | _____________ | _____________ | _____________ |
| Domain Registrar | _____________ | _____________ | _____________ |

---

## ✅ Final Sign-Off

**Deployment completed successfully:** ☐ YES ☐ NO

**Date deployed:** _________________

**Deployed by:** _________________

**All critical issues resolved:** ☐ YES ☐ NO

**Known issues (if any):**
_____________________________________________
_____________________________________________
_____________________________________________

**Site is ready for production:** ☐ YES ☐ NO

---

## 🎉 Congratulations!

If all items above are checked, your site is live and ready for users!

**Post-deployment recommendations:**
- Monitor closely for first week
- Gather user feedback
- Make iterative improvements
- Regular backups (weekly recommended)
- Keep quiz content fresh and updated

---

**Document Version:** 1.0  
**Last Updated:** September 30, 2025  
**For Site:** qudrat100.com

