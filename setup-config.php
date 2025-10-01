<?php
// Check if the form has been submitted
if (isset($_POST['submit'])) {
    // Get the database credentials from the form
    $db_name = $_POST['db_name'];
    $db_user = $_POST['db_user'];
    $db_password = $_POST['db_password'];
    $db_host = $_POST['db_host'];

    // Create the wp-config.php file content
    $config_content = "<?php\n";
    $config_content .= "define( 'DB_NAME', '" . $db_name . "' );\n";
    $config_content .= "define( 'DB_USER', '" . $db_user . "' );\n";
    $config_content .= "define( 'DB_PASSWORD', '" . $db_password . "' );\n";
    $config_content .= "define( 'DB_HOST', '" . $db_host . "' );\n";
    $config_content .= "define( 'DB_CHARSET', 'utf8mb4' );\n";
    $config_content .= "define( 'DB_COLLATE', '' );\n\n";

    // Add the authentication keys and salts
    $config_content .= "define('AUTH_KEY',         'put your unique phrase here');\n";
    $config_content .= "define('SECURE_AUTH_KEY',  'put your unique phrase here');\n";
    $config_content .= "define('LOGGED_IN_KEY',    'put your unique phrase here');\n";
    $config_content .= "define('NONCE_KEY',        'put your unique phrase here');\n";
    $config_content .= "define('AUTH_SALT',        'put your unique phrase here');\n";
    $config_content .= "define('SECURE_AUTH_SALT', 'put your unique phrase here');\n";
    $config_content .= "define('LOGGED_IN_SALT',   'put your unique phrase here');\n";
    $config_content .= "define('NONCE_SALT',       'put your unique phrase here');\n\n";

    // Add the table prefix
    $config_content .= "$table_prefix = 'wp_';\n\n";

    // Add the debug mode
    $config_content .= "define( 'WP_DEBUG', false );\n\n";

    // Add the ABSPATH definition
    $config_content .= "if ( ! defined( 'ABSPATH' ) ) {\n";
    $config_content .= "\tdefine( 'ABSPATH', __DIR__ . '/' );\n";
    $config_content .= "}\n\n";

    // Add the wp-settings.php require
    $config_content .= "require_once ABSPATH . 'wp-settings.php';\n";

    // Write the content to the wp-config.php file
    file_put_contents('wp-config.php', $config_content);

    // Display a success message
    echo "<h1>wp-config.php created successfully!</h1>";
    echo "<p>Please delete this file (setup-config.php) immediately.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>WordPress Configuration Setup</title>
</head>
<body>
    <h1>WordPress Configuration Setup</h1>
    <p>Please enter your database credentials below to create the wp-config.php file.</p>
    <form method="post">
        <label for="db_name">Database Name:</label><br>
        <input type="text" id="db_name" name="db_name" required><br><br>
        <label for="db_user">Database User:</label><br>
        <input type="text" id="db_user" name="db_user" required><br><br>
        <label for="db_password">Database Password:</label><br>
        <input type="password" id="db_password" name="db_password"><br><br>
        <label for="db_host">Database Host:</label><br>
        <input type="text" id="db_host" name="db_host" value="localhost" required><br><br>
        <input type="submit" name="submit" value="Create wp-config.php">
    </form>
</body>
</html>
