<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php wp_head(); ?>
    <!-- Google Fonts - Cairo for Arabic -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Top Bar -->
<div class="top-bar">
    <div class="container">
        <div class="top-bar-content">
            <div class="contact-info">
                <span><i class="fas fa-phone"></i> +966 123 456 789</span>
                <span><i class="fas fa-envelope"></i> info@qudrat100.com</span>
            </div>
            <div class="social-links">
                <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
    </div>
</div>

<!-- Header -->
<header class="header">
    <div class="container">
        <div class="header-content">
            <div class="logo">
                <?php if (has_custom_logo()) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <a href="<?php echo esc_url(home_url('/')); ?>">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/iconword.png" alt="<?php bloginfo('name'); ?>" class="logo-img">
                        <span class="logo-text"><?php bloginfo('name'); ?></span>
                    </a>
                <?php endif; ?>
            </div>
            <nav class="nav-menu">
                <ul>
                    <li><a href="<?php echo home_url('/'); ?>" class="nav-link"><i class="fas fa-home"></i> الرئيسية</a></li>
                    <li><a href="<?php echo home_url('/demo.php'); ?>" class="nav-link"><i class="fas fa-play-circle"></i> تجربة مجانية</a></li>
                    <li><a href="<?php echo home_url('/quiz.php'); ?>" class="nav-link"><i class="fas fa-clipboard-check"></i> الاختبارات</a></li>
                    <li><a href="#contact" class="nav-link"><i class="fas fa-envelope"></i> تواصل معنا</a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>
