@echo off
echo ========================================
echo GitHub Repository Setup for WordPress
echo ========================================
echo.

echo Step 1: Configuring Git user...
git config --global user.email "ghamdixyz@gmail.com"
git config --global user.name "Ghamdi"
echo Git user configured!
echo.

echo Step 2: Initializing repository...
git init
echo Repository initialized!
echo.

echo Step 3: Adding all files...
git add .
echo Files added to staging!
echo.

echo Step 4: Creating initial commit...
git commit -m "Initial WordPress site with custom theme for Qudrat100"
echo Commit created!
echo.

echo ========================================
echo IMPORTANT: Manual steps required:
echo ========================================
echo.
echo 1. Login to GitHub.com with:
echo    Email: ghamdixyz@gmail.com
echo.
echo 2. Create a new PRIVATE repository named: qudrat100-wordpress
echo.
echo 3. Get a Personal Access Token from:
echo    Settings - Developer settings - Personal access tokens
echo.
echo 4. Run this command (replace YOUR_USERNAME):
echo    git remote add origin https://github.com/YOUR_USERNAME/qudrat100-wordpress.git
echo.
echo 5. Push to GitHub:
echo    git push -u origin main
echo    (Use your Personal Access Token as password)
echo.
echo ========================================
pause