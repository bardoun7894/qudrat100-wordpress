<?php
/**
 * Production Database Migration Script for WordPress + Custom Quiz App
 * 
 * This script migrates data from localhost to production environment
 * Run this script AFTER deploying to production server
 * 
 * Usage: docker exec -it wordpress_app php /var/www/html/docker/migrate-to-production.php
 */

// Security check - only run in CLI mode
if (php_sapi_name() !== 'cli') {
    die('This script can only be run from command line for security reasons.');
}

// Configuration
$config = [
    'old_url' => 'http://localhost',
    'new_url' => getenv('SITE_URL') ?: 'https://qudrat100.com',
    'db_host' => getenv('WORDPRESS_DB_HOST') ?: 'db:3306',
    'db_name' => getenv('WORDPRESS_DB_NAME') ?: 'wordpress_prod',
    'db_user' => getenv('WORDPRESS_DB_USER') ?: 'wordpress_user',
    'db_pass' => getenv('WORDPRESS_DB_PASSWORD') ?: '',
];

echo "=== WordPress + Custom Quiz App Production Migration ===\n";
echo "Old URL: {$config['old_url']}\n";
echo "New URL: {$config['new_url']}\n";
echo "Database: {$config['db_name']}\n";
echo "========================================================\n\n";

try {
    // Connect to database
    $pdo = new PDO(
        "mysql:host={$config['db_host']};dbname={$config['db_name']};charset=utf8mb4",
        $config['db_user'],
        $config['db_pass'],
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
    
    echo "✓ Database connection established\n";
    
    // Start transaction
    $pdo->beginTransaction();
    
    // 1. Update WordPress options table
    echo "\n1. Updating WordPress options...\n";
    
    $wp_options_updates = [
        'home' => $config['new_url'],
        'siteurl' => $config['new_url'],
        'upload_url_path' => $config['new_url'] . '/wp-content/uploads',
    ];
    
    foreach ($wp_options_updates as $option_name => $option_value) {
        $stmt = $pdo->prepare("UPDATE wp_options SET option_value = ? WHERE option_name = ?");
        $stmt->execute([$option_value, $option_name]);
        echo "  ✓ Updated {$option_name} to {$option_value}\n";
    }
    
    // 2. Update post content URLs
    echo "\n2. Updating post content URLs...\n";
    
    $stmt = $pdo->prepare("
        UPDATE wp_posts 
        SET post_content = REPLACE(post_content, ?, ?)
        WHERE post_content LIKE ?
    ");
    $stmt->execute([$config['old_url'], $config['new_url'], '%' . $config['old_url'] . '%']);
    $affected = $stmt->rowCount();
    echo "  ✓ Updated {$affected} posts with URL references\n";
    
    // 3. Update post excerpts
    $stmt = $pdo->prepare("
        UPDATE wp_posts 
        SET post_excerpt = REPLACE(post_excerpt, ?, ?)
        WHERE post_excerpt LIKE ?
    ");
    $stmt->execute([$config['old_url'], $config['new_url'], '%' . $config['old_url'] . '%']);
    $affected = $stmt->rowCount();
    echo "  ✓ Updated {$affected} post excerpts with URL references\n";
    
    // 4. Update meta values
    echo "\n3. Updating meta values...\n";
    
    $stmt = $pdo->prepare("
        UPDATE wp_postmeta 
        SET meta_value = REPLACE(meta_value, ?, ?)
        WHERE meta_value LIKE ?
    ");
    $stmt->execute([$config['old_url'], $config['new_url'], '%' . $config['old_url'] . '%']);
    $affected = $stmt->rowCount();
    echo "  ✓ Updated {$affected} post meta values\n";
    
    $stmt = $pdo->prepare("
        UPDATE wp_usermeta 
        SET meta_value = REPLACE(meta_value, ?, ?)
        WHERE meta_value LIKE ?
    ");
    $stmt->execute([$config['old_url'], $config['new_url'], '%' . $config['old_url'] . '%']);
    $affected = $stmt->rowCount();
    echo "  ✓ Updated {$affected} user meta values\n";
    
    // 5. Update comments
    echo "\n4. Updating comments...\n";
    
    $stmt = $pdo->prepare("
        UPDATE wp_comments 
        SET comment_content = REPLACE(comment_content, ?, ?)
        WHERE comment_content LIKE ?
    ");
    $stmt->execute([$config['old_url'], $config['new_url'], '%' . $config['old_url'] . '%']);
    $affected = $stmt->rowCount();
    echo "  ✓ Updated {$affected} comments\n";
    
    $stmt = $pdo->prepare("
        UPDATE wp_comments 
        SET comment_author_url = REPLACE(comment_author_url, ?, ?)
        WHERE comment_author_url LIKE ?
    ");
    $stmt->execute([$config['old_url'], $config['new_url'], '%' . $config['old_url'] . '%']);
    $affected = $stmt->rowCount();
    echo "  ✓ Updated {$affected} comment author URLs\n";
    
    // 6. Update custom quiz tables
    echo "\n5. Updating custom quiz application data...\n";
    
    // Check if questions table exists
    $stmt = $pdo->query("SHOW TABLES LIKE 'questions'");
    if ($stmt->rowCount() > 0) {
        // Update image paths in questions table
        $stmt = $pdo->prepare("
            UPDATE questions 
            SET image_path = REPLACE(image_path, ?, ?)
            WHERE image_path LIKE ?
        ");
        $stmt->execute([$config['old_url'], $config['new_url'], '%' . $config['old_url'] . '%']);
        $affected = $stmt->rowCount();
        echo "  ✓ Updated {$affected} question image paths\n";
        
        // Update any localhost references in question text
        $stmt = $pdo->prepare("
            UPDATE questions 
            SET question_text = REPLACE(question_text, ?, ?)
            WHERE question_text LIKE ?
        ");
        $stmt->execute([$config['old_url'], $config['new_url'], '%' . $config['old_url'] . '%']);
        $affected = $stmt->rowCount();
        echo "  ✓ Updated {$affected} question texts with URL references\n";
    } else {
        echo "  ! Questions table not found, skipping quiz data migration\n";
    }
    
    // 7. Update serialized data
    echo "\n6. Updating serialized data...\n";
    
    $stmt = $pdo->query("
        SELECT option_id, option_name, option_value 
        FROM wp_options 
        WHERE option_value LIKE '%{$config['old_url']}%'
    ");
    
    $serialized_updates = 0;
    while ($row = $stmt->fetch()) {
        $old_value = $row['option_value'];
        $new_value = str_replace($config['old_url'], $config['new_url'], $old_value);
        
        // Handle serialized data
        if (is_serialized($old_value)) {
            $unserialized = @unserialize($old_value);
            if ($unserialized !== false) {
                $updated_data = update_serialized_urls($unserialized, $config['old_url'], $config['new_url']);
                $new_value = serialize($updated_data);
            }
        }
        
        if ($new_value !== $old_value) {
            $update_stmt = $pdo->prepare("UPDATE wp_options SET option_value = ? WHERE option_id = ?");
            $update_stmt->execute([$new_value, $row['option_id']]);
            $serialized_updates++;
        }
    }
    echo "  ✓ Updated {$serialized_updates} serialized options\n";
    
    // 8. Clear caches and update permalinks
    echo "\n7. Clearing caches and updating permalinks...\n";
    
    // Delete transients
    $stmt = $pdo->prepare("DELETE FROM wp_options WHERE option_name LIKE '_transient_%'");
    $stmt->execute();
    echo "  ✓ Cleared transients\n";
    
    // Update rewrite rules
    $stmt = $pdo->prepare("UPDATE wp_options SET option_value = '' WHERE option_name = 'rewrite_rules'");
    $stmt->execute();
    echo "  ✓ Reset rewrite rules\n";
    
    // 9. Update .htaccess file
    echo "\n8. Updating .htaccess file...\n";
    
    $htaccess_path = '/var/www/html/.htaccess';
    if (file_exists($htaccess_path)) {
        $htaccess_content = file_get_contents($htaccess_path);
        $updated_htaccess = str_replace($config['old_url'], $config['new_url'], $htaccess_content);
        file_put_contents($htaccess_path, $updated_htaccess);
        echo "  ✓ Updated .htaccess file\n";
    } else {
        echo "  ! .htaccess file not found\n";
    }
    
    // 10. Verify migration
    echo "\n9. Verifying migration...\n";
    
    $verification_queries = [
        "SELECT COUNT(*) as count FROM wp_options WHERE option_value LIKE '%{$config['old_url']}%'",
        "SELECT COUNT(*) as count FROM wp_posts WHERE post_content LIKE '%{$config['old_url']}%'",
        "SELECT COUNT(*) as count FROM wp_postmeta WHERE meta_value LIKE '%{$config['old_url']}%'",
    ];
    
    $remaining_references = 0;
    foreach ($verification_queries as $query) {
        $stmt = $pdo->query($query);
        $result = $stmt->fetch();
        $remaining_references += $result['count'];
    }
    
    if ($remaining_references > 0) {
        echo "  ⚠ Warning: {$remaining_references} localhost references still found\n";
        echo "  These may be in serialized data or require manual review\n";
    } else {
        echo "  ✓ No remaining localhost references found\n";
    }
    
    // Commit transaction
    $pdo->commit();
    
    echo "\n=== Migration Completed Successfully ===\n";
    echo "Next steps:\n";
    echo "1. Test your website: {$config['new_url']}\n";
    echo "2. Test quiz functionality: {$config['new_url']}/quiz.php\n";
    echo "3. Test admin panel: {$config['new_url']}/admin.php\n";
    echo "4. Check WordPress admin: {$config['new_url']}/wp-admin/\n";
    echo "5. Update permalinks in WordPress admin\n";
    echo "6. Test all functionality thoroughly\n";
    
} catch (Exception $e) {
    // Rollback transaction on error
    if ($pdo->inTransaction()) {
        $pdo->rollback();
    }
    
    echo "\n❌ Migration failed: " . $e->getMessage() . "\n";
    echo "Transaction rolled back. Database unchanged.\n";
    exit(1);
}

/**
 * Check if a value is serialized
 */
function is_serialized($data) {
    if (!is_string($data)) {
        return false;
    }
    $data = trim($data);
    if ('N;' == $data) {
        return true;
    }
    if (strlen($data) < 4) {
        return false;
    }
    if (':' !== $data[1]) {
        return false;
    }
    $lastc = substr($data, -1);
    if (';' !== $lastc && '}' !== $lastc) {
        return false;
    }
    $token = $data[0];
    switch ($token) {
        case 's':
            if ('"' !== substr($data, -2, 1)) {
                return false;
            }
        case 'a':
        case 'O':
            return (bool) preg_match("/^{$token}:[0-9]+:/s", $data);
        case 'b':
        case 'i':
        case 'd':
            $end = substr($data, 2, -1);
            return (bool) preg_match("/^{$end}$/", $end);
    }
    return false;
}

/**
 * Recursively update URLs in serialized data
 */
function update_serialized_urls($data, $old_url, $new_url) {
    if (is_string($data)) {
        return str_replace($old_url, $new_url, $data);
    } elseif (is_array($data)) {
        foreach ($data as $key => $value) {
            $data[$key] = update_serialized_urls($value, $old_url, $new_url);
        }
    } elseif (is_object($data)) {
        foreach ($data as $key => $value) {
            $data->$key = update_serialized_urls($value, $old_url, $new_url);
        }
    }
    return $data;
}
?>