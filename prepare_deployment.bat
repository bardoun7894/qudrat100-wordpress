@echo off
REM ================================================================
REM Deployment Package Preparation Script for qudrat100.com
REM ================================================================

echo.
echo ========================================================
echo   Preparing Deployment Package for qudrat100.com
echo ========================================================
echo.

REM Create deployment folder
set DEPLOY_FOLDER=deployment_package
if exist %DEPLOY_FOLDER% (
    echo Cleaning old deployment folder...
    rmdir /s /q %DEPLOY_FOLDER%
)

echo Creating deployment folder structure...
mkdir %DEPLOY_FOLDER%
mkdir %DEPLOY_FOLDER%\assets
mkdir %DEPLOY_FOLDER%\assets\css
mkdir %DEPLOY_FOLDER%\assets\images
mkdir %DEPLOY_FOLDER%\includes
mkdir %DEPLOY_FOLDER%\api
mkdir %DEPLOY_FOLDER%\uploads
mkdir %DEPLOY_FOLDER%\uploads\questions

echo.
echo Copying core files...
copy index.php %DEPLOY_FOLDER%\ >nul
copy demo.php %DEPLOY_FOLDER%\ >nul
copy quiz.php %DEPLOY_FOLDER%\ >nul
copy admin.php %DEPLOY_FOLDER%\ >nul

echo Copying assets...
copy assets\css\style.css %DEPLOY_FOLDER%\assets\css\ >nul
copy assets\images\iconword.png %DEPLOY_FOLDER%\assets\images\ >nul
copy "assets\images\بروشور-دورة-القدرة-المعرفية-ج47.jpg" %DEPLOY_FOLDER%\assets\images\ >nul

echo Copying includes...
copy includes\header.php %DEPLOY_FOLDER%\includes\ >nul
copy includes\footer.php %DEPLOY_FOLDER%\includes\ >nul
copy includes\db_connection.php %DEPLOY_FOLDER%\includes\ >nul

echo Copying API files...
copy api\get_questions.php %DEPLOY_FOLDER%\api\ >nul

echo Copying database setup...
copy database_setup.sql %DEPLOY_FOLDER%\ >nul

echo Copying documentation...
copy DEPLOYMENT_GUIDE.md %DEPLOY_FOLDER%\ >nul
copy DEPLOYMENT_FILES_LIST.txt %DEPLOY_FOLDER%\ >nul

echo.
echo ========================================================
echo   ✓ Deployment package created successfully!
echo ========================================================
echo.
echo Package location: %cd%\%DEPLOY_FOLDER%
echo.
echo ⚠️  IMPORTANT: Before uploading, please:
echo.
echo 1. Edit: %DEPLOY_FOLDER%\includes\db_connection.php
echo    - Update database credentials
echo.
echo 2. Review: DEPLOYMENT_GUIDE.md for full instructions
echo.
echo 3. Backup your current qudrat100.com site first!
echo.
echo ========================================================
echo.

REM Open the deployment folder
explorer %DEPLOY_FOLDER%

echo Press any key to exit...
pause >nul

