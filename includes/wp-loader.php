<?php
/**
 * Load WordPress Environment
 */

// Path to wp-load.php
$wp_load_path = __DIR__ . '/../wp-load.php';

// Check if wp-load.php exists
if (file_exists($wp_load_path)) {
    require_once($wp_load_path);
} else {
    // If wp-load.php is not found, try to find it by traversing up the directory tree
    $path = __DIR__;
    while (strpos($path, 'wp-content') === false && strlen($path) > 1) {
        $path = dirname($path);
    }
    $wp_load_path = $path . '/wp-load.php';
    if (file_exists($wp_load_path)) {
        require_once($wp_load_path);
    } else {
        die('Could not find wp-load.php');
    }
}
