<?php
/*
Template Name: صفحة الهبوط - دورة القدرة المعرفية
*/

get_header(); ?>

<div class="landing-page">
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content">
                <div class="logo-section">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="شعار الاستعداد للقدرات" class="site-logo" />
                </div>
                <h1 class="hero-title">مرحباً بكم في دورة القدرة المعرفية</h1>
                <p class="hero-subtitle">دورات احترافية في القدرة المعرفية والقدرات العامة</p>
                <div class="hero-badges">
                    <span class="badge">35 يوم</span>
                    <span class="badge">8 أيام مجانية</span>
                    <span class="badge">شهادة معتمدة</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Course Details Section -->
    <section class="course-details">
        <div class="container">
            <div class="course-info">
                <div class="course-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/course-brochure.jpg" alt="بروشور دورة القدرة المعرفية" />
                </div>
                <div class="course-content">
                    <h2>دورة القدرة المعرفية - الجزء 47</h2>
                    <p class="course-description">دورة شاملة مدتها 35 يوماً لتطوير قدراتكم المعرفية والذهنية بأحدث الطرق العلمية المثبتة.</p>
                    <div class="course-highlights">
                        <div class="highlight-item">
                            <i class="fas fa-clock"></i>
                            <span>35 يوم تدريب مكثف</span>
                        </div>
                        <div class="highlight-item">
                            <i class="fas fa-gift"></i>
                            <span>8 أيام مجانية للتجربة</span>
                        </div>
                        <div class="highlight-item">
                            <i class="fas fa-star"></i>
                            <span>تدريب على يد خبراء</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Registration Section -->
    <section class="registration-section">
        <div class="container">
            <h2>التسجيل والاشتراك</h2>
            
            <div class="registration-options">
                <div class="registration-card full-course">
                    <div class="card-header">
                        <i class="fas fa-crown"></i>
                        <h3>الدورة الكاملة</h3>
                    </div>
                    <div class="card-content">
                        <p class="duration">35 يوم</p>
                        <p class="description">للاشتراك في كامل الدورة</p>
                        <p class="contact-info">التواصل مع قسم التنسيق:</p>
                        <a href="https://wa.me/966502020353" class="btn btn-whatsapp" target="_blank">
                            <i class="fab fa-whatsapp"></i>
                            التواصل عبر واتساب
                        </a>
                    </div>
                </div>
                
                <div class="registration-card free-days">
                    <div class="card-header">
                        <i class="fas fa-gift"></i>
                        <h3>الأيام المجانية</h3>
                    </div>
                    <div class="card-content">
                        <p class="duration">8 أيام</p>
                        <p class="description">لحضور الأيام المجانية</p>
                        <p class="contact-info">يكفي الانضمام للقناة:</p>
                        <a href="https://t.me/estiedad3" class="btn btn-telegram" target="_blank">
                            <i class="fab fa-telegram"></i>
                            الانضمام للقناة
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="container">
            <h2>مميزات الدورة</h2>
            <div class="features-grid">
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-brain"></i>
                    </div>
                    <h3>تطوير القدرات المعرفية</h3>
                    <p>تحسين الذاكرة والتركيز والانتباه بطرق علمية مثبتة</p>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3>نتائج مضمونة</h3>
                    <p>طرق علمية مثبتة لتحسين الأداء والحصول على نتائج ملموسة</p>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3>مجتمع تفاعلي</h3>
                    <p>تفاعل مع المدربين والمشاركين في بيئة تعليمية محفزة</p>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-certificate"></i>
                    </div>
                    <h3>شهادة معتمدة</h3>
                    <p>احصل على شهادة إتمام الدورة معتمدة ومعترف بها</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <h2>ابدأ رحلتك نحو التميز الآن</h2>
                <p>لا تفوت الفرصة وانضم إلى آلاف المستفيدين من دوراتنا المتخصصة</p>
                <div class="cta-buttons">
                    <a href="https://wa.me/966502020353" class="btn btn-primary">
                        <i class="fab fa-whatsapp"></i>
                        اشترك الآن
                    </a>
                    <a href="https://t.me/estiedad3" class="btn btn-secondary">
                        <i class="fab fa-telegram"></i>
                        جرب مجاناً
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

<?php get_footer(); ?>