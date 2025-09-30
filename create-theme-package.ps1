# Create WordPress Theme Package for qudrat100.com
# This ensures CSS, images, and all files are properly included

$themePath = "c:\Users\Chairi\wordpress\wp-content\themes\custom-theme"
$outputPath = "c:\Users\Chairi\Desktop\qudrat100-theme-complete.zip"

Write-Host "Creating WordPress theme package..." -ForegroundColor Cyan

# Remove old zip if exists
if (Test-Path $outputPath) {
    Remove-Item $outputPath -Force
    Write-Host "Removed old package" -ForegroundColor Yellow
}

# Create zip file
Add-Type -AssemblyName System.IO.Compression.FileSystem
[System.IO.Compression.ZipFile]::CreateFromDirectory($themePath, $outputPath)

Write-Host "`n✅ Theme package created successfully!" -ForegroundColor Green
Write-Host "Location: $outputPath" -ForegroundColor Cyan
Write-Host "`nThis package includes:" -ForegroundColor Yellow
Write-Host "  ✓ style.css (complete CSS with animations)" -ForegroundColor White
Write-Host "  ✓ All PHP template files" -ForegroundColor White
Write-Host "  ✓ Images folder with all images" -ForegroundColor White
Write-Host "  ✓ functions.php" -ForegroundColor White
Write-Host "`nNext steps:" -ForegroundColor Yellow
Write-Host "1. Delete old theme from qudrat100.com" -ForegroundColor White
Write-Host "2. Upload this package" -ForegroundColor White
Write-Host "3. Activate it" -ForegroundColor White

