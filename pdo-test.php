<?php
try {
    $pdo = new PDO('mysql:host=172.18.0.2;dbname=wordpress', 'wordpress', 'password');
    echo "PDO SUCCESS!\n";
    echo "MySQL version: " . $pdo->getAttribute(PDO::ATTR_SERVER_VERSION) . "\n";
} catch (PDOException $e) {
    echo "PDO FAILED: " . $e->getMessage() . "\n";
}
?>
