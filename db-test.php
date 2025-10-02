<?php
$host = '172.18.0.2';
$user = 'wordpress';
$pass = 'password';
$db = 'wordpress';

echo "Connecting to: $host\n";

$mysqli = @new mysqli($host, $user, $pass, $db);

if ($mysqli->connect_error) {
    echo "FAILED: " . $mysqli->connect_error . "\n";
} else {
    echo "SUCCESS!\n";
    $mysqli->close();
}
?>
