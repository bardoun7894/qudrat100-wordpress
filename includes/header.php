<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title : 'الاستعداد للقدرات'; ?></title>
    <meta name="description" content="<?php echo isset($page_description) ? $page_description : 'دورات احترافية في القدرة المعرفية والقدرات العامة'; ?>">
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <?php if(isset($additional_css)): ?>
        <?php foreach($additional_css as $css): ?>
            <link rel="stylesheet" href="<?php echo $css; ?>">
        <?php endforeach; ?>
    <?php endif; ?>
    
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPGRlZnM+CjxsaW5lYXJHcmFkaWVudCBpZD0icGFpbnQwX2xpbmVhcl8xXzEiIHgxPSIzMCIgeTE9IjAiIHgyPSIzMCIgeTI9IjYwIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSI+CjxzdG9wIHN0b3AtY29sb3I9IiM0QTkwRTIiLz4KPHN0b3Agb2Zmc2V0PSIxIiBzdG9wLWNvbG9yPSIjOUI1OUI2Ii8+CjwvbGluZWFyR3JhZGllbnQ+CjwvZGVmcz4KPHBhdGggZD0iTTMwIDVMNTAgMjBMNDUgNDBMMTUgNDBMMTAgMjBMMzAgNVoiIGZpbGw9InVybCgjcGFpbnQwX2xpbmVhcl8xXzEpIi8+CjxwYXRoIGQ9Ik0zMCAxNUw0MCAyNUwzNSAzNUwyNSAzNUwyMCAyNUwzMCAxNVoiIGZpbGw9IiNGRkZGRkYiIGZpbGwtb3BhY2l0eT0iMC4zIi8+Cjwvc3ZnPg==">
</head>
<body>
    <!-- Top Bar -->
    <div class="top-bar">
        <div class="container">
            <div class="top-bar-content">
                <div class="contact-info">
                    <span><i class="fas fa-phone"></i> +966 50 123 4567</span>
                    <span><i class="fas fa-envelope"></i> info@qudurat.com</span>
                </div>
                <div class="social-links">
                    <a href="#" title="واتساب"><i class="fab fa-whatsapp"></i></a>
                    <a href="#" title="تويتر"><i class="fab fa-twitter"></i></a>
                    <a href="#" title="إنستغرام"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <div class="logo-icon">
                        <img src="assets/images/iconword.png" alt="شعار الاستعداد للقدرات" class="brand-icon">
                    </div>
                    <div class="logo-text">
                        <h1>الاستعداد للقدرات</h1>
                        <span class="tagline">طريقك نحو التميز</span>
                    </div>
                </div>
                <nav class="nav-menu">
                    <ul>
                        <li><a href="index.php" class="nav-link"><i class="fas fa-home"></i> الرئيسية</a></li>
                        <li><a href="quiz.php" class="nav-link"><i class="fas fa-brain"></i> الاختبارات</a></li>
                        <li><a href="demo.php" class="nav-link"><i class="fas fa-play"></i> عرض تجريبي</a></li>
                        <li><a href="#pricing" class="nav-link"><i class="fas fa-tags"></i> الباقات</a></li>
                        <li><a href="#contact" class="nav-link"><i class="fas fa-envelope"></i> التواصل</a></li>
                    </ul>
                </nav>
                <div class="header-cta">
                    <a href="#contact" class="btn btn-primary btn-sm">
                        <i class="fas fa-rocket"></i> ابدأ الآن
                    </a>
                </div>
                <div class="mobile-menu-toggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
    </header>

    <script>
        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            const mobileToggle = document.querySelector('.mobile-menu-toggle');
            const navMenu = document.querySelector('.nav-menu');
            
            if (mobileToggle && navMenu) {
                mobileToggle.addEventListener('click', function() {
                    this.classList.toggle('active');
                    navMenu.classList.toggle('active');
                });
                
                // Close menu when clicking on a link
                const navLinks = document.querySelectorAll('.nav-link');
                navLinks.forEach(link => {
                    link.addEventListener('click', function() {
                        mobileToggle.classList.remove('active');
                        navMenu.classList.remove('active');
                    });
                });
                
                // Close menu when clicking outside
                document.addEventListener('click', function(e) {
                    if (!mobileToggle.contains(e.target) && !navMenu.contains(e.target)) {
                        mobileToggle.classList.remove('active');
                        navMenu.classList.remove('active');
                    }
                });
            }
        });
    </script>

    <!-- Main Content -->Start -->