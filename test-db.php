<?php
// Test database connection and create WordPress database if needed
$host = 'localhost';
$username = 'root';
$password = '';

try {
    // Connect to MySQL server (without specifying database)
    $pdo = new PDO("mysql:host=$host", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "✅ Connected to MySQL server successfully!\n";
    
    // Check if WordPress database exists
    $stmt = $pdo->query("SHOW DATABASES LIKE 'wordpress'");
    $database_exists = $stmt->rowCount() > 0;
    
    if ($database_exists) {
        echo "✅ WordPress database already exists!\n";
    } else {
        echo "❌ WordPress database does not exist. Creating it...\n";
        
        // Create WordPress database
        $pdo->exec("CREATE DATABASE wordpress CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        echo "✅ WordPress database created successfully!\n";
    }
    
    // Test connection to WordPress database
    $pdo_wp = new PDO("mysql:host=$host;dbname=wordpress", $username, $password);
    $pdo_wp->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "✅ Connected to WordPress database successfully!\n";
    
    // Show existing tables
    $stmt = $pdo_wp->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    if (count($tables) > 0) {
        echo "📋 Existing tables in WordPress database:\n";
        foreach ($tables as $table) {
            echo "   - $table\n";
        }
    } else {
        echo "📋 WordPress database is empty (no tables found)\n";
        echo "💡 You may need to run WordPress installation at http://localhost:8080\n";
    }
    
} catch (PDOException $e) {
    echo "❌ Database connection failed: " . $e->getMessage() . "\n";
    exit(1);
}
?>