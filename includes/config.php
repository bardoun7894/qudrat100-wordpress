<?php
/**
 * Configuration file for resource paths and URLs
 * This file ensures proper path handling for both localhost and live server
 */

// Detect if we're on localhost or live server
function is_localhost() {
    $localhost_ips = ['127.0.0.1', '::1', 'localhost'];
    $server_ip = $_SERVER['SERVER_ADDR'] ?? $_SERVER['LOCAL_ADDR'] ?? '';
    $server_name = $_SERVER['SERVER_NAME'] ?? '';
    
    return in_array($server_ip, $localhost_ips) || 
           in_array($server_name, $localhost_ips) ||
           strpos($server_name, 'localhost') !== false ||
           strpos($server_name, '127.0.0.1') !== false;
}

// Define base URLs and paths
if (is_localhost()) {
    // Localhost configuration
    define('SITE_URL', 'http://localhost:8080');
    define('BASE_PATH', '/');
} else {
    // Live server configuration
    define('SITE_URL', 'https://qudrat100.com');
    define('BASE_PATH', '/');
}

// Define asset paths
define('ASSETS_URL', SITE_URL . BASE_PATH . 'assets');
define('CSS_URL', ASSETS_URL . '/css');
define('JS_URL', ASSETS_URL . '/js');
define('IMAGES_URL', ASSETS_URL . '/images');
define('UPLOADS_URL', SITE_URL . BASE_PATH . 'uploads');

// Define API paths
define('API_URL', SITE_URL . BASE_PATH . 'api');

// Define file system paths
define('ROOT_PATH', dirname(__DIR__));
define('ASSETS_PATH', ROOT_PATH . '/assets');
define('UPLOADS_PATH', ROOT_PATH . '/uploads');
define('INCLUDES_PATH', ROOT_PATH . '/includes');

/**
 * Get asset URL with proper path
 */
function get_asset_url($path) {
    return ASSETS_URL . '/' . ltrim($path, '/');
}

/**
 * Get CSS file URL
 */
function get_css_url($filename) {
    return CSS_URL . '/' . ltrim($filename, '/');
}

/**
 * Get JS file URL
 */
function get_js_url($filename) {
    return JS_URL . '/' . ltrim($filename, '/');
}

/**
 * Get image URL
 */
function get_image_url($filename) {
    return IMAGES_URL . '/' . ltrim($filename, '/');
}

/**
 * Get upload URL
 */
function get_upload_url($filename) {
    return UPLOADS_URL . '/' . ltrim($filename, '/');
}

/**
 * Get API endpoint URL
 */
function get_api_url($endpoint) {
    return API_URL . '/' . ltrim($endpoint, '/');
}

/**
 * Include CSS file with proper path
 */
function include_css($filename, $version = '1.0') {
    $url = get_css_url($filename);
    echo '<link rel="stylesheet" href="' . $url . '?v=' . $version . '">' . "\n";
}

/**
 * Include JS file with proper path
 */
function include_js($filename, $version = '1.0', $defer = false) {
    $url = get_js_url($filename);
    $defer_attr = $defer ? ' defer' : '';
    echo '<script src="' . $url . '?v=' . $version . '"' . $defer_attr . '></script>' . "\n";
}

/**
 * Get current page URL
 */
function get_current_url() {
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'];
    $uri = $_SERVER['REQUEST_URI'];
    return $protocol . '://' . $host . $uri;
}

/**
 * Redirect to URL
 */
function redirect_to($url) {
    if (!headers_sent()) {
        header('Location: ' . $url);
        exit;
    } else {
        echo '<script>window.location.href = "' . $url . '";</script>';
        exit;
    }
}

/**
 * Check if file exists in uploads directory
 */
function upload_file_exists($filename) {
    return file_exists(UPLOADS_PATH . '/' . ltrim($filename, '/'));
}

/**
 * Get safe upload path for file
 */
function get_safe_upload_path($filename) {
    $filename = basename($filename);
    $filename = preg_replace('/[^a-zA-Z0-9._-]/', '', $filename);
    return UPLOADS_PATH . '/' . $filename;
}

/**
 * Create uploads directory if it doesn't exist
 */
function ensure_uploads_directory() {
    if (!file_exists(UPLOADS_PATH)) {
        mkdir(UPLOADS_PATH, 0755, true);
    }
    
    // Create .htaccess for security
    $htaccess_path = UPLOADS_PATH . '/.htaccess';
    if (!file_exists($htaccess_path)) {
        $htaccess_content = "# Prevent direct access to PHP files\n";
        $htaccess_content .= "<Files *.php>\n";
        $htaccess_content .= "Order Deny,Allow\n";
        $htaccess_content .= "Deny from all\n";
        $htaccess_content .= "</Files>\n";
        file_put_contents($htaccess_path, $htaccess_content);
    }
}

/**
 * Get WordPress database configuration if available
 */
function get_wp_config() {
    $wp_config_paths = [
        ROOT_PATH . '/wp-config.php',
        dirname(ROOT_PATH) . '/wp-config.php',
        ROOT_PATH . '/../wp-config.php'
    ];
    
    foreach ($wp_config_paths as $path) {
        if (file_exists($path)) {
            return $path;
        }
    }
    
    return false;
}

/**
 * Load WordPress configuration if available
 */
function load_wp_config() {
    $wp_config_path = get_wp_config();
    if ($wp_config_path) {
        // Define ABSPATH to prevent WordPress from trying to load
        if (!defined('ABSPATH')) {
            define('ABSPATH', dirname($wp_config_path) . '/');
        }
        
        // Include wp-config.php
        include_once $wp_config_path;
        return true;
    }
    
    return false;
}

// Initialize uploads directory
ensure_uploads_directory();

// Load WordPress config if available
load_wp_config();

// Set timezone
if (!ini_get('date.timezone')) {
    date_default_timezone_set('Asia/Riyadh');
}

// Define additional constants for the quiz system
define('QUIZ_QUESTIONS_PER_TEST', 20);
define('QUIZ_TIME_LIMIT', 30 * 60); // 30 minutes in seconds
define('QUIZ_PASS_PERCENTAGE', 70);

// Error reporting (disable on live server)
if (is_localhost()) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}
?>