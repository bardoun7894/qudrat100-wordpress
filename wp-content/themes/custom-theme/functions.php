<?php
/**
 * Custom Theme Functions - Qudrat100
 * Add your custom PHP code here
 */

// Theme Setup
function custom_theme_setup() {
    // Add theme support for various features
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 100,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => 'Primary Menu',
        'footer' => 'Footer Menu'
    ));
}
add_action('after_setup_theme', 'custom_theme_setup');

// Enqueue styles and scripts
function custom_theme_scripts() {
    // Enqueue theme stylesheet
    wp_enqueue_style('custom-theme-style', get_stylesheet_uri(), array(), '2.0');
    
    // Enqueue Font Awesome
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');
    
    // Enqueue Google Fonts for Arabic
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;800&display=swap');
    
    // Enqueue jQuery (if needed)
    wp_enqueue_script('jquery');
    
    // Add custom JavaScript file
    if (file_exists(get_template_directory() . '/js/custom.js')) {
        wp_enqueue_script('custom-theme-script', get_template_directory_uri() . '/js/custom.js', array('jquery'), '2.0', true);
    }
}
add_action('wp_enqueue_scripts', 'custom_theme_scripts');

// Handle Contact Form Submission
add_action('admin_post_nopriv_contact_form', 'handle_contact_form');
add_action('admin_post_contact_form', 'handle_contact_form');

function handle_contact_form() {
    // Verify nonce
    if (!isset($_POST['_wpnonce']) || !wp_verify_nonce($_POST['_wpnonce'], 'contact_form_nonce')) {
        wp_die('Security check failed');
    }
    
    // Sanitize input
    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_email($_POST['email']);
    $phone = sanitize_text_field($_POST['phone']);
    $package = sanitize_text_field($_POST['package']);
    $message = sanitize_textarea_field($_POST['message']);
    
    // Insert into database (using WordPress database)
    global $wpdb;
    $table_name = $wpdb->prefix . 'course_registrations';
    
    $wpdb->insert(
        $table_name,
        array(
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'package' => $package,
            'message' => $message,
            'registration_date' => current_time('mysql')
        )
    );
    
    // Send email notification (optional)
    $to = get_option('admin_email');
    $subject = 'تسجيل جديد في الدورة';
    $body = "اسم: $name\nبريد إلكتروني: $email\nجوال: $phone\nالباقة: $package\nرسالة: $message";
    $headers = array('Content-Type: text/plain; charset=UTF-8');
    
    wp_mail($to, $subject, $body, $headers);
    
    // Redirect back with success message
    wp_redirect(home_url('/?registration=success'));
    exit;
}

// Handle Newsletter Subscription
add_action('admin_post_nopriv_newsletter_subscribe', 'handle_newsletter_subscribe');
add_action('admin_post_newsletter_subscribe', 'handle_newsletter_subscribe');

function handle_newsletter_subscribe() {
    // Verify nonce
    if (!isset($_POST['_wpnonce']) || !wp_verify_nonce($_POST['_wpnonce'], 'newsletter_nonce')) {
        wp_die('Security check failed');
    }
    
    $email = sanitize_email($_POST['email']);
    
    // Save to database or send to email service
    // For now, just send notification
    $to = get_option('admin_email');
    $subject = 'اشتراك جديد في النشرة البريدية';
    $body = "بريد إلكتروني جديد: $email";
    
    wp_mail($to, $subject, $body);
    
    wp_redirect(home_url('/?newsletter=success'));
    exit;
}

// Create custom database tables on theme activation
function create_custom_tables() {
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    
    // Quiz Questions Table
    $table_name = $wpdb->prefix . 'quiz_questions';
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id INT AUTO_INCREMENT PRIMARY KEY,
        question_text TEXT NOT NULL,
        image_path VARCHAR(255),
        option_a VARCHAR(255) NOT NULL,
        option_b VARCHAR(255) NOT NULL,
        option_c VARCHAR(255) NOT NULL,
        option_d VARCHAR(255) NOT NULL,
        correct_answer INT NOT NULL,
        explanation TEXT,
        category VARCHAR(100),
        difficulty VARCHAR(50),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) $charset_collate;";
    
    // Quiz Results Table
    $table_name_results = $wpdb->prefix . 'quiz_results';
    $sql .= "CREATE TABLE IF NOT EXISTS $table_name_results (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT,
        score DECIMAL(5,2),
        correct_count INT,
        wrong_count INT,
        time_taken_seconds INT,
        quiz_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) $charset_collate;";
    
    // Course Registrations Table
    $table_name_registrations = $wpdb->prefix . 'course_registrations';
    $sql .= "CREATE TABLE IF NOT EXISTS $table_name_registrations (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        phone VARCHAR(50) NOT NULL,
        email VARCHAR(255) NOT NULL,
        package VARCHAR(100) NOT NULL,
        message TEXT,
        registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) $charset_collate;";
    
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

// Run on theme switch
add_action('after_switch_theme', 'create_custom_tables');

// Add admin menu for quiz management
function add_quiz_admin_menu() {
    add_menu_page(
        'إدارة الاختبارات',
        'الاختبارات',
        'manage_options',
        'quiz-admin',
        'quiz_admin_page',
        'dashicons-clipboard',
        25
    );
    
    add_submenu_page(
        'quiz-admin',
        'التسجيلات',
        'التسجيلات',
        'manage_options',
        'registrations-admin',
        'registrations_admin_page'
    );
}
add_action('admin_menu', 'add_quiz_admin_menu');

function quiz_admin_page() {
    echo '<div class="wrap">';
    echo '<h1>إدارة الاختبارات</h1>';
    echo '<p>استخدم صفحة <a href="' . home_url('/admin.php') . '">لوحة التحكم المخصصة</a> لإدارة الأسئلة.</p>';
    echo '</div>';
}

function registrations_admin_page() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'course_registrations';
    $registrations = $wpdb->get_results("SELECT * FROM $table_name ORDER BY registration_date DESC");
    
    echo '<div class="wrap">';
    echo '<h1>التسجيلات في الدورة</h1>';
    
    if ($registrations) {
        echo '<table class="wp-list-table widefat fixed striped">';
        echo '<thead><tr><th>الاسم</th><th>البريد</th><th>الجوال</th><th>الباقة</th><th>التاريخ</th></tr></thead>';
        echo '<tbody>';
        foreach ($registrations as $reg) {
            echo '<tr>';
            echo '<td>' . esc_html($reg->name) . '</td>';
            echo '<td>' . esc_html($reg->email) . '</td>';
            echo '<td>' . esc_html($reg->phone) . '</td>';
            echo '<td>' . esc_html($reg->package) . '</td>';
            echo '<td>' . esc_html($reg->registration_date) . '</td>';
            echo '</tr>';
        }
        echo '</tbody></table>';
    } else {
        echo '<p>لا توجد تسجيلات حتى الآن.</p>';
    }
    
    echo '</div>';
}

// Add custom body classes
function custom_body_classes($classes) {
    if (is_front_page()) {
        $classes[] = 'front-page';
    }
    return $classes;
}
add_filter('body_class', 'custom_body_classes');

// Remove WordPress version from head (security)
remove_action('wp_head', 'wp_generator');

// Disable file editing in admin (security)
if (!defined('DISALLOW_FILE_EDIT')) {
    define('DISALLOW_FILE_EDIT', true);
}

// Custom excerpt length
function custom_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'custom_excerpt_length');

// Custom excerpt more text
function custom_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'custom_excerpt_more');

// Show success messages
function show_registration_messages() {
    if (isset($_GET['registration']) && $_GET['registration'] == 'success') {
        echo '<div class="notice notice-success" style="position: fixed; top: 50px; right: 20px; z-index: 9999; background: #25D366; color: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 20px rgba(0,0,0,0.2);">';
        echo '<p><i class="fas fa-check-circle"></i> تم إرسال طلبك بنجاح! سنتواصل معك قريباً.</p>';
        echo '</div>';
    }
    if (isset($_GET['newsletter']) && $_GET['newsletter'] == 'success') {
        echo '<div class="notice notice-success" style="position: fixed; top: 50px; right: 20px; z-index: 9999; background: #2563EB; color: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 20px rgba(0,0,0,0.2);">';
        echo '<p><i class="fas fa-check-circle"></i> تم الاشتراك في النشرة البريدية بنجاح!</p>';
        echo '</div>';
    }
}
add_action('wp_footer', 'show_registration_messages');

?>
