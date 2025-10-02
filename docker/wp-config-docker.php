<?php
/**
 * The base configuration for WordPress
 * Docker Environment Configuration
 * This file matches the XAMPP localhost environment
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', getenv('WORDPRESS_DB_NAME') ?: 'wordpress' );

/** MySQL database username */
define( 'DB_USER', getenv('WORDPRESS_DB_USER') ?: 'wordpress' );

/** MySQL database password */
define( 'DB_PASSWORD', getenv('WORDPRESS_DB_PASSWORD') ?: 'wordpress' );

/** MySQL hostname */
define( 'DB_HOST', getenv('WORDPRESS_DB_HOST') ?: 'db' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 */
define( 'AUTH_KEY',         getenv('WORDPRESS_AUTH_KEY') ?: 'put your unique phrase here' );
define( 'SECURE_AUTH_KEY',  getenv('WORDPRESS_SECURE_AUTH_KEY') ?: 'put your unique phrase here' );
define( 'LOGGED_IN_KEY',    getenv('WORDPRESS_LOGGED_IN_KEY') ?: 'put your unique phrase here' );
define( 'NONCE_KEY',        getenv('WORDPRESS_NONCE_KEY') ?: 'put your unique phrase here' );
define( 'AUTH_SALT',        getenv('WORDPRESS_AUTH_SALT') ?: 'put your unique phrase here' );
define( 'SECURE_AUTH_SALT', getenv('WORDPRESS_SECURE_AUTH_SALT') ?: 'put your unique phrase here' );
define( 'LOGGED_IN_SALT',   getenv('WORDPRESS_LOGGED_IN_SALT') ?: 'put your unique phrase here' );
define( 'NONCE_SALT',       getenv('WORDPRESS_NONCE_SALT') ?: 'put your unique phrase here' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 */
$table_prefix = getenv('WORDPRESS_TABLE_PREFIX') ?: 'wp_';

/**
 * For developers: WordPress debugging mode.
 * Change this to true to enable the display of notices during development.
 */
define( 'WP_DEBUG', getenv('WORDPRESS_DEBUG') === 'true' ? true : false );
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', false );

/**
 * WordPress Memory Limit
 */
define( 'WP_MEMORY_LIMIT', '256M' );

/**
 * File Upload Settings
 */
define( 'ALLOW_UNFILTERED_UPLOADS', true );

/**
 * Security Settings
 */
define( 'DISALLOW_FILE_EDIT', true );
define( 'FORCE_SSL_ADMIN', false ); // Set to true in production with SSL

/**
 * WordPress Cache Settings
 */
define( 'WP_CACHE', true );

/**
 * Redis Cache Configuration (if available)
 */
if (getenv('REDIS_HOST')) {
    define( 'WP_REDIS_HOST', getenv('REDIS_HOST') );
    define( 'WP_REDIS_PORT', getenv('REDIS_PORT') ?: 6379 );
    define( 'WP_REDIS_PASSWORD', getenv('REDIS_PASSWORD') );
    define( 'WP_REDIS_DATABASE', 0 );
}

/**
 * Custom Upload Directory (matches XAMPP structure)
 */
define( 'UPLOADS', 'wp-content/uploads' );

/**
 * WordPress URLs (will be set automatically)
 */
if (isset($_SERVER['HTTP_HOST'])) {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
    define( 'WP_HOME', $protocol . $_SERVER['HTTP_HOST'] );
    define( 'WP_SITEURL', $protocol . $_SERVER['HTTP_HOST'] );
}

/**
 * Quiz Application Configuration
 * These settings ensure the quiz app works the same as in XAMPP
 */
define( 'QUIZ_UPLOAD_DIR', ABSPATH . 'uploads/' );
define( 'QUIZ_UPLOAD_URL', home_url('/uploads/') );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';