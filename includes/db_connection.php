<?php
/**
 * Database Connection
 * Uses WordPress database configuration
 */

// Include WordPress config if available
if (file_exists('../wp-config.php')) {
    require_once('../wp-config.php');
} else {
    // Fallback configuration
    define('DB_NAME', 'wordpress_db');
    define('DB_USER', 'root');
    define('DB_PASSWORD', '');
    define('DB_HOST', 'localhost');
    define('DB_CHARSET', 'utf8mb4');
}

// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set charset
$conn->set_charset(DB_CHARSET);

// Return connection
return $conn;
?>

