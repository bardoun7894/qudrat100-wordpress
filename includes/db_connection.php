<?php
/**
 * Database Connection
 * Uses WordPress database configuration with live server support
 */

// Try to include WordPress config from multiple possible locations
$wp_config_loaded = false;

// Check for wp-config.php in parent directory (common for custom files)
if (file_exists('../wp-config.php')) {
    require_once('../wp-config.php');
    $wp_config_loaded = true;
} 
// Check for wp-config.php in current directory
elseif (file_exists('wp-config.php')) {
    require_once('wp-config.php');
    $wp_config_loaded = true;
}
// Check for wp-config.php in root directory (for subdirectory installations)
elseif (file_exists('../../wp-config.php')) {
    require_once('../../wp-config.php');
    $wp_config_loaded = true;
}

// If no WordPress config found, use environment variables or fallback
if (!$wp_config_loaded) {
    // Try environment variables first (for hosting providers)
    define('DB_NAME', getenv('DB_NAME') ?: 'wordpress_db');
    define('DB_USER', getenv('DB_USER') ?: 'root');
    define('DB_PASSWORD', getenv('DB_PASSWORD') ?: '');
    define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
    define('DB_CHARSET', getenv('DB_CHARSET') ?: 'utf8mb4');
}

// Ensure charset is defined
if (!defined('DB_CHARSET')) {
    define('DB_CHARSET', 'utf8mb4');
}

// Create connection with error handling
try {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    
    // Check connection
    if ($conn->connect_error) {
        error_log("Database connection failed: " . $conn->connect_error);
        throw new Exception("Database connection failed: " . $conn->connect_error);
    }
    
    // Set charset
    if (!$conn->set_charset(DB_CHARSET)) {
        error_log("Error setting charset: " . $conn->error);
    }
    
} catch (Exception $e) {
    // Log error for debugging
    error_log("Database connection error: " . $e->getMessage());
    
    // Show user-friendly error message
    if (defined('WP_DEBUG') && WP_DEBUG) {
        die("Database connection failed: " . $e->getMessage());
    } else {
        die("Database connection failed. Please check your configuration.");
    }
}

// Return connection
return $conn;
?>

