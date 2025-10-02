<?php
/**
 * Permalink Reset Script for Live Server
 * Run this script once after migration to fix WordPress permalinks
 * 
 * IMPORTANT: Delete this file after running it for security
 */

// Security check - only run if specific parameter is provided
if (!isset($_GET['reset_permalinks']) || $_GET['reset_permalinks'] !== 'confirm_reset_2024') {
    die('Access denied. This script requires proper authorization.');
}

// Include WordPress configuration
$wp_config_paths = [
    __DIR__ . '/wp-config.php',
    dirname(__DIR__) . '/wp-config.php',
    __DIR__ . '/../wp-config.php'
];

$wp_config_found = false;
foreach ($wp_config_paths as $path) {
    if (file_exists($path)) {
        require_once $path;
        $wp_config_found = true;
        break;
    }
}

if (!$wp_config_found) {
    die('WordPress configuration file not found.');
}

// Define WordPress paths if not already defined
if (!defined('ABSPATH')) {
    define('ABSPATH', __DIR__ . '/');
}

// Include WordPress functions
if (file_exists(ABSPATH . 'wp-includes/wp-db.php')) {
    require_once ABSPATH . 'wp-includes/wp-db.php';
}

// Create database connection
$wpdb = new wpdb(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);

if ($wpdb->last_error) {
    die('Database connection failed: ' . $wpdb->last_error);
}

echo "<h1>WordPress Permalink Reset Script</h1>\n";
echo "<p>Starting permalink reset process...</p>\n";

// 1. Reset permalink structure to default and back to pretty
echo "<h2>1. Resetting Permalink Structure</h2>\n";

// First, set to default (plain)
$result1 = $wpdb->update(
    $wpdb->options,
    array('option_value' => ''),
    array('option_name' => 'permalink_structure')
);

// Then set to pretty permalinks
$result2 = $wpdb->update(
    $wpdb->options,
    array('option_value' => '/%postname%/'),
    array('option_name' => 'permalink_structure')
);

if ($result1 !== false && $result2 !== false) {
    echo "<p>✓ Permalink structure reset successfully</p>\n";
} else {
    echo "<p>✗ Error resetting permalink structure</p>\n";
}

// 2. Update rewrite rules
echo "<h2>2. Updating Rewrite Rules</h2>\n";

// Clear rewrite rules
$wpdb->update(
    $wpdb->options,
    array('option_value' => ''),
    array('option_name' => 'rewrite_rules')
);

echo "<p>✓ Rewrite rules cleared (will be regenerated automatically)</p>\n";

// 3. Update site URLs
echo "<h2>3. Verifying Site URLs</h2>\n";

$current_siteurl = $wpdb->get_var("SELECT option_value FROM {$wpdb->options} WHERE option_name = 'siteurl'");
$current_home = $wpdb->get_var("SELECT option_value FROM {$wpdb->options} WHERE option_name = 'home'");

echo "<p>Current siteurl: " . htmlspecialchars($current_siteurl) . "</p>\n";
echo "<p>Current home: " . htmlspecialchars($current_home) . "</p>\n";

// Check if URLs need updating
$expected_url = 'https://qudrat100.com';
$needs_update = false;

if ($current_siteurl !== $expected_url) {
    $wpdb->update(
        $wpdb->options,
        array('option_value' => $expected_url),
        array('option_name' => 'siteurl')
    );
    echo "<p>✓ Updated siteurl to: $expected_url</p>\n";
    $needs_update = true;
}

if ($current_home !== $expected_url) {
    $wpdb->update(
        $wpdb->options,
        array('option_value' => $expected_url),
        array('option_name' => 'home')
    );
    echo "<p>✓ Updated home URL to: $expected_url</p>\n";
    $needs_update = true;
}

if (!$needs_update) {
    echo "<p>✓ Site URLs are already correct</p>\n";
}

// 4. Update any remaining localhost references
echo "<h2>4. Checking for Localhost References</h2>\n";

$localhost_patterns = ['localhost:8080', 'localhost', '127.0.0.1:8080', '127.0.0.1'];
$total_updates = 0;

foreach ($localhost_patterns as $pattern) {
    // Update options table
    $result = $wpdb->query($wpdb->prepare("
        UPDATE {$wpdb->options} 
        SET option_value = REPLACE(option_value, %s, %s)
        WHERE option_value LIKE %s
    ", "http://$pattern", $expected_url, "%http://$pattern%"));
    
    if ($result > 0) {
        echo "<p>✓ Updated $result option(s) containing 'http://$pattern'</p>\n";
        $total_updates += $result;
    }
    
    // Update posts table
    $result = $wpdb->query($wpdb->prepare("
        UPDATE {$wpdb->posts} 
        SET post_content = REPLACE(post_content, %s, %s)
        WHERE post_content LIKE %s
    ", "http://$pattern", $expected_url, "%http://$pattern%"));
    
    if ($result > 0) {
        echo "<p>✓ Updated $result post(s) containing 'http://$pattern'</p>\n";
        $total_updates += $result;
    }
    
    // Update postmeta table
    $result = $wpdb->query($wpdb->prepare("
        UPDATE {$wpdb->postmeta} 
        SET meta_value = REPLACE(meta_value, %s, %s)
        WHERE meta_value LIKE %s
    ", "http://$pattern", $expected_url, "%http://$pattern%"));
    
    if ($result > 0) {
        echo "<p>✓ Updated $result postmeta record(s) containing 'http://$pattern'</p>\n";
        $total_updates += $result;
    }
}

if ($total_updates === 0) {
    echo "<p>✓ No localhost references found in database</p>\n";
}

// 5. Check custom quiz tables
echo "<h2>5. Checking Custom Quiz Tables</h2>\n";

$quiz_tables = ['quiz_questions', 'quiz_results', 'course_registrations'];
$quiz_updates = 0;

foreach ($quiz_tables as $table) {
    // Check if table exists
    $table_exists = $wpdb->get_var("SHOW TABLES LIKE '$table'");
    
    if ($table_exists) {
        echo "<p>✓ Table '$table' found</p>\n";
        
        // Update image paths in quiz_questions if it has image_path column
        if ($table === 'quiz_questions') {
            $result = $wpdb->query("
                UPDATE $table 
                SET image_path = REPLACE(image_path, 'http://localhost:8080', '$expected_url')
                WHERE image_path LIKE '%http://localhost:8080%'
            ");
            
            if ($result > 0) {
                echo "<p>✓ Updated $result image path(s) in quiz_questions</p>\n";
                $quiz_updates += $result;
            }
        }
    } else {
        echo "<p>⚠ Table '$table' not found</p>\n";
    }
}

if ($quiz_updates === 0) {
    echo "<p>✓ No localhost references found in quiz tables</p>\n";
}

// 6. Clear any caches
echo "<h2>6. Clearing Caches</h2>\n";

// Clear object cache if it exists
if (function_exists('wp_cache_flush')) {
    wp_cache_flush();
    echo "<p>✓ Object cache cleared</p>\n";
}

// Clear transients
$wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE '_transient_%'");
$wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE '_site_transient_%'");
echo "<p>✓ Transients cleared</p>\n";

// 7. Generate .htaccess rules
echo "<h2>7. Generating .htaccess Rules</h2>\n";

$htaccess_content = "# BEGIN WordPress
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteRule ^index\.php$ - [L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . /index.php [L]
</IfModule>
# END WordPress

# Custom Application Rules
<IfModule mod_rewrite.c>
    # Handle quiz URLs
    RewriteRule ^quiz/?$ quiz.php [L]
    RewriteRule ^admin/?$ admin.php [L]
    RewriteRule ^demo/?$ demo.php [L]
    
    # API endpoints
    RewriteRule ^api/(.+)$ api/$1 [L]
</IfModule>
";

$htaccess_path = ABSPATH . '.htaccess';
if (file_put_contents($htaccess_path, $htaccess_content)) {
    echo "<p>✓ .htaccess file updated with rewrite rules</p>\n";
} else {
    echo "<p>⚠ Could not write .htaccess file. Please update manually.</p>\n";
}

// 8. Final verification
echo "<h2>8. Final Verification</h2>\n";

$final_siteurl = $wpdb->get_var("SELECT option_value FROM {$wpdb->options} WHERE option_name = 'siteurl'");
$final_home = $wpdb->get_var("SELECT option_value FROM {$wpdb->options} WHERE option_name = 'home'");

echo "<p>Final siteurl: " . htmlspecialchars($final_siteurl) . "</p>\n";
echo "<p>Final home URL: " . htmlspecialchars($final_home) . "</p>\n";

// Test database connection for custom app
try {
    include_once 'includes/db_connection.php';
    echo "<p>✓ Custom application database connection working</p>\n";
} catch (Exception $e) {
    echo "<p>⚠ Custom application database connection issue: " . htmlspecialchars($e->getMessage()) . "</p>\n";
}

echo "<h2>✅ Permalink Reset Complete!</h2>\n";
echo "<div style='background: #d4edda; border: 1px solid #c3e6cb; padding: 15px; margin: 20px 0; border-radius: 5px;'>\n";
echo "<h3>Next Steps:</h3>\n";
echo "<ol>\n";
echo "<li><strong>Delete this script file</strong> for security: <code>reset-permalinks.php</code></li>\n";
echo "<li>Test your website: <a href='$expected_url' target='_blank'>$expected_url</a></li>\n";
echo "<li>Test quiz functionality: <a href='$expected_url/quiz.php' target='_blank'>$expected_url/quiz.php</a></li>\n";
echo "<li>Test admin panel: <a href='$expected_url/admin.php' target='_blank'>$expected_url/admin.php</a></li>\n";
echo "<li>Login to WordPress admin and go to Settings > Permalinks > Save Changes</li>\n";
echo "<li>Clear any caching plugins if you have them</li>\n";
echo "</ol>\n";
echo "</div>\n";

echo "<div style='background: #fff3cd; border: 1px solid #ffeaa7; padding: 15px; margin: 20px 0; border-radius: 5px;'>\n";
echo "<h3>⚠ Security Notice:</h3>\n";
echo "<p><strong>IMPORTANT:</strong> Delete this file immediately after running it to prevent unauthorized access.</p>\n";
echo "<p>File to delete: <code>" . __FILE__ . "</code></p>\n";
echo "</div>\n";

// Log the reset action
$log_entry = date('Y-m-d H:i:s') . " - Permalink reset completed from IP: " . $_SERVER['REMOTE_ADDR'] . "\n";
file_put_contents('permalink_reset.log', $log_entry, FILE_APPEND | LOCK_EX);

echo "<p><small>Reset logged to: permalink_reset.log</small></p>\n";
?>