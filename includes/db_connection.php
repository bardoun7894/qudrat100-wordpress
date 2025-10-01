<?php
/**
 * Database Connection
 * Uses WordPress database configuration
 */

// Load the WordPress environment
if (file_exists(dirname(__FILE__) . '/../wp-load.php')) {
    require_once(dirname(__FILE__) . '/../wp-load.php');
} else {
    die('Could not find wp-load.php');
}

global $wpdb;



