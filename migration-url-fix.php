<?php
/**
 * WordPress URL Migration Script
 * 
 * INSTRUCTIONS:
 * 1. Upload this file to your live server's root directory
 * 2. Update the database credentials below
 * 3. Update the $live_url variable to your domain
 * 4. Run this script ONCE by visiting: https://yourdomain.com/migration-url-fix.php
 * 5. DELETE this file after running it successfully
 * 
 * WARNING: Always backup your database before running this script!
 */

// Configuration
$live_url = 'https://qudrat100.com';  // UPDATE THIS TO YOUR LIVE DOMAIN
$old_urls = [
    'http://localhost:8080',
    'http://localhost',
    'http://127.0.0.1:8080',
    'http://127.0.0.1'
];

// Database credentials - UPDATE THESE
$servername = "localhost";           // Usually 'localhost'
$username = "your_db_user";          // Your database username
$password = "your_db_password";      // Your database password
$dbname = "your_db_name";           // Your database name

// Security check - only run if accessed directly
if (basename($_SERVER['PHP_SELF']) !== 'migration-url-fix.php') {
    die('This script must be run directly.');
}

// Simple password protection (optional)
$script_password = 'migration123';  // Change this password
if (!isset($_GET['password']) || $_GET['password'] !== $script_password) {
    die('Access denied. Add ?password=' . $script_password . ' to the URL.');
}

?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WordPress Migration URL Fix</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 50px auto; padding: 20px; }
        .success { color: green; background: #f0f8f0; padding: 10px; border-radius: 5px; margin: 10px 0; }
        .error { color: red; background: #f8f0f0; padding: 10px; border-radius: 5px; margin: 10px 0; }
        .info { color: blue; background: #f0f0f8; padding: 10px; border-radius: 5px; margin: 10px 0; }
        .warning { color: orange; background: #f8f8f0; padding: 10px; border-radius: 5px; margin: 10px 0; }
        pre { background: #f5f5f5; padding: 15px; border-radius: 5px; overflow-x: auto; }
        .step { margin: 20px 0; padding: 15px; border-left: 4px solid #2563EB; background: #f9f9f9; }
    </style>
</head>
<body>
    <h1>🚀 WordPress Migration URL Fix</h1>
    <p><strong>Live Domain:</strong> <?php echo htmlspecialchars($live_url); ?></p>
    
    <?php
    // Create database connection
    try {
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        if ($conn->connect_error) {
            throw new Exception("Connection failed: " . $conn->connect_error);
        }
        
        echo '<div class="success">✅ Database connection successful!</div>';
        
        // Set charset
        $conn->set_charset("utf8mb4");
        
        $total_updates = 0;
        
        echo '<div class="step">';
        echo '<h2>🔄 Starting URL Migration Process...</h2>';
        
        foreach ($old_urls as $old_url) {
            echo "<h3>Updating URLs from: <code>$old_url</code> to <code>$live_url</code></h3>";
            
            // 1. Update wp_options table
            echo "<p><strong>1. Updating wp_options table...</strong></p>";
            $sql = "UPDATE wp_options SET option_value = REPLACE(option_value, ?, ?) WHERE option_value LIKE ?";
            $stmt = $conn->prepare($sql);
            $like_pattern = '%' . $old_url . '%';
            $stmt->bind_param("sss", $old_url, $live_url, $like_pattern);
            $stmt->execute();
            $affected = $stmt->affected_rows;
            echo "<div class='info'>Updated $affected rows in wp_options</div>";
            $total_updates += $affected;
            
            // 2. Update wp_posts content
            echo "<p><strong>2. Updating wp_posts content...</strong></p>";
            $sql = "UPDATE wp_posts SET post_content = REPLACE(post_content, ?, ?) WHERE post_content LIKE ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $old_url, $live_url, $like_pattern);
            $stmt->execute();
            $affected = $stmt->affected_rows;
            echo "<div class='info'>Updated $affected rows in wp_posts content</div>";
            $total_updates += $affected;
            
            // 3. Update wp_posts GUID
            echo "<p><strong>3. Updating wp_posts GUID...</strong></p>";
            $sql = "UPDATE wp_posts SET guid = REPLACE(guid, ?, ?) WHERE guid LIKE ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $old_url, $live_url, $like_pattern);
            $stmt->execute();
            $affected = $stmt->affected_rows;
            echo "<div class='info'>Updated $affected rows in wp_posts GUID</div>";
            $total_updates += $affected;
            
            // 4. Update wp_postmeta
            echo "<p><strong>4. Updating wp_postmeta...</strong></p>";
            $sql = "UPDATE wp_postmeta SET meta_value = REPLACE(meta_value, ?, ?) WHERE meta_value LIKE ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $old_url, $live_url, $like_pattern);
            $stmt->execute();
            $affected = $stmt->affected_rows;
            echo "<div class='info'>Updated $affected rows in wp_postmeta</div>";
            $total_updates += $affected;
            
            // 5. Update wp_comments
            echo "<p><strong>5. Updating wp_comments...</strong></p>";
            $sql = "UPDATE wp_comments SET comment_content = REPLACE(comment_content, ?, ?) WHERE comment_content LIKE ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $old_url, $live_url, $like_pattern);
            $stmt->execute();
            $affected = $stmt->affected_rows;
            echo "<div class='info'>Updated $affected rows in wp_comments</div>";
            $total_updates += $affected;
            
            // 6. Update custom quiz tables if they exist
            echo "<p><strong>6. Updating custom quiz tables...</strong></p>";
            
            // Check if quiz_questions table exists
            $result = $conn->query("SHOW TABLES LIKE 'quiz_questions'");
            if ($result->num_rows > 0) {
                $sql = "UPDATE quiz_questions SET question_text = REPLACE(question_text, ?, ?) WHERE question_text LIKE ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sss", $old_url, $live_url, $like_pattern);
                $stmt->execute();
                $affected = $stmt->affected_rows;
                echo "<div class='info'>Updated $affected rows in quiz_questions (question_text)</div>";
                $total_updates += $affected;
                
                $sql = "UPDATE quiz_questions SET image_path = REPLACE(image_path, ?, ?) WHERE image_path LIKE ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sss", $old_url, $live_url, $like_pattern);
                $stmt->execute();
                $affected = $stmt->affected_rows;
                echo "<div class='info'>Updated $affected rows in quiz_questions (image_path)</div>";
                $total_updates += $affected;
            } else {
                echo "<div class='warning'>quiz_questions table not found - skipping</div>";
            }
            
            echo "<hr>";
        }
        
        // Update specific WordPress options
        echo "<h3>🔧 Updating specific WordPress options...</h3>";
        
        $options_to_update = [
            'home' => $live_url,
            'siteurl' => $live_url
        ];
        
        foreach ($options_to_update as $option_name => $option_value) {
            $sql = "UPDATE wp_options SET option_value = ? WHERE option_name = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $option_value, $option_name);
            $stmt->execute();
            $affected = $stmt->affected_rows;
            echo "<div class='info'>Updated $option_name to $option_value ($affected rows affected)</div>";
            $total_updates += $affected;
        }
        
        echo '</div>';
        
        echo '<div class="success">';
        echo "<h2>✅ Migration Completed Successfully!</h2>";
        echo "<p><strong>Total database updates:</strong> $total_updates</p>";
        echo '</div>';
        
        // Show next steps
        echo '<div class="step">';
        echo '<h2>📋 Next Steps (IMPORTANT):</h2>';
        echo '<ol>';
        echo '<li><strong>Delete this script file</strong> from your server for security</li>';
        echo '<li><strong>Login to WordPress admin:</strong> <a href="' . $live_url . '/wp-admin/" target="_blank">' . $live_url . '/wp-admin/</a></li>';
        echo '<li><strong>Reset permalinks:</strong> Go to Settings > Permalinks and click "Save Changes"</li>';
        echo '<li><strong>Test all pages:</strong>';
        echo '<ul>';
        echo '<li><a href="' . $live_url . '/" target="_blank">Homepage</a></li>';
        echo '<li><a href="' . $live_url . '/quiz.php" target="_blank">Quiz System</a></li>';
        echo '<li><a href="' . $live_url . '/admin.php" target="_blank">Admin Panel</a></li>';
        echo '<li><a href="' . $live_url . '/demo.php" target="_blank">Demo Page</a></li>';
        echo '</ul>';
        echo '</li>';
        echo '<li><strong>Check for broken images</strong> and fix any remaining path issues</li>';
        echo '<li><strong>Test all functionality</strong> including forms and database operations</li>';
        echo '</ol>';
        echo '</div>';
        
        $conn->close();
        
    } catch (Exception $e) {
        echo '<div class="error">❌ Error: ' . htmlspecialchars($e->getMessage()) . '</div>';
        echo '<div class="warning">';
        echo '<h3>Troubleshooting:</h3>';
        echo '<ul>';
        echo '<li>Check your database credentials in this script</li>';
        echo '<li>Make sure your database exists and is accessible</li>';
        echo '<li>Verify your hosting provider\'s database settings</li>';
        echo '<li>Contact your hosting support if the issue persists</li>';
        echo '</ul>';
        echo '</div>';
    }
    ?>
    
    <div class="warning">
        <h3>⚠️ Security Notice:</h3>
        <p><strong>DELETE THIS FILE</strong> after running it successfully. It contains database credentials and should not remain on your server.</p>
    </div>
    
    <div class="info">
        <h3>📞 Need Help?</h3>
        <p>If you encounter any issues:</p>
        <ul>
            <li>Check your hosting provider's error logs</li>
            <li>Verify all file permissions are correct</li>
            <li>Contact your hosting support for server-specific issues</li>
            <li>Make sure SSL certificate is properly configured</li>
        </ul>
    </div>
</body>
</html>