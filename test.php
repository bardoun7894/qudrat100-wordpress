<?php
echo "PHP is working!\n";
echo "Current directory: " . __DIR__ . "\n";
echo "WordPress files check:\n";

$files_to_check = [
    'wp-config.php',
    'wp-load.php', 
    'wp-blog-header.php',
    'wp-settings.php',
    'wp-includes/version.php'
];

foreach ($files_to_check as $file) {
    if (file_exists($file)) {
        echo "✅ $file exists\n";
    } else {
        echo "❌ $file missing\n";
    }
}

echo "\nTrying to load WordPress...\n";

try {
    // Try to load WordPress
    define('WP_USE_THEMES', false);
    require_once 'wp-load.php';
    echo "✅ WordPress loaded successfully!\n";
    echo "WordPress version: " . get_bloginfo('version') . "\n";
    echo "Site URL: " . get_site_url() . "\n";
    echo "Home URL: " . get_home_url() . "\n";
} catch (Exception $e) {
    echo "❌ Error loading WordPress: " . $e->getMessage() . "\n";
} catch (Error $e) {
    echo "❌ Fatal error loading WordPress: " . $e->getMessage() . "\n";
}
?>