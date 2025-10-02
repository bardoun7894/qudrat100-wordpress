<?php
echo "DB_HOST from env: " . getenv('WORDPRESS_DB_HOST') . "\n";
echo "DB_NAME from env: " . getenv('WORDPRESS_DB_NAME') . "\n";
echo "DB_USER from env: " . getenv('WORDPRESS_DB_USER') . "\n";
echo "DB_PASS from env: " . getenv('WORDPRESS_DB_PASSWORD') . "\n";
echo "\n";

$host = getenv('WORDPRESS_DB_HOST') ?: 'localhost';
echo "Will use host: $host\n";

// Test gethostbyname
echo "gethostbyname('db'): " . gethostbyname('db') . "\n";
?>
