<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "Testing connection...\n";
echo "Host: " . getenv('WORDPRESS_DB_HOST') . "\n";
echo "User: " . getenv('WORDPRESS_DB_USER') . "\n";
echo "DB: " . getenv('WORDPRESS_DB_NAME') . "\n\n";

$host = getenv('WORDPRESS_DB_HOST') ?: '172.18.0.2';
$user = getenv('WORDPRESS_DB_USER') ?: 'wordpress';
$pass = getenv('WORDPRESS_DB_PASSWORD') ?: 'password';
$db = getenv('WORDPRESS_DB_NAME') ?: 'wordpress';

// Remove port from host if present
$host = explode(':', $host)[0];

echo "Connecting to: $host\n";

try {
    $mysqli = new mysqli($host, $user, $pass, $db);
    if ($mysqli->connect_error) {
        echo "FAILED: " . $mysqli->connect_error . "\n";
    } else {
        echo "SUCCESS! Connected to MySQL " . $mysqli->server_info . "\n";
        $mysqli->close();
    }
} catch (Exception $e) {
    echo "EXCEPTION: " . $e->getMessage() . "\n";
}
?>
