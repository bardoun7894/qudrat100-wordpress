<?php
/**
 * Template Name: Front Page - Home Page
 * Template for displaying the homepage with our new design
 */

get_header(); ?>

<main class="main-content">
    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <div class="hero-badge">
                    <i class="fas fa-star"></i>
                    <span>الأول في المملكة</span>
                </div>
                <h1><i class="fas fa-graduation-cap"></i> الاستعداد للقدرات</h1>
                <p class="hero-subtitle">احصل على أعلى الدرجات في اختبار القدرات مع برنامجنا المتخصص</p>
                <div class="hero-stats">
                    <div class="stat-item">
                        <span class="stat-number">95%</span>
                        <span class="stat-label">نسبة النجاح</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">10,000+</span>
                        <span class="stat-label">طالب ناجح</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">5+</span>
                        <span class="stat-label">سنوات خبرة</span>
                    </div>
                </div>
                <div class="hero-buttons">
                    <a href="<?php echo home_url('/demo.php'); ?>" class="btn btn-primary">
                        <i class="fas fa-play-circle"></i>
                        جرب الآن مجاناً
                    </a>
                    <a href="<?php echo home_url('/quiz.php'); ?>" class="btn btn-secondary">
                        <i class="fas fa-clipboard-check"></i>
                        ابدأ التدريب
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Course Brochure Section -->
    <section class="course-brochure-section">
        <div class="container">
            <div class="section-title">
                <h2><i class="fas fa-book-open"></i> نبذة عن الدورة</h2>
                <p>اكتشف محتوى البرنامج التدريبي الشامل للاستعداد للقدرات</p>
            </div>
            <div class="brochure-image">
                <img src="<?php echo get_template_directory_uri(); ?>/images/course-brochure.jpg" 
                     alt="بروشور دورة القدرة المعرفية" 
                     class="course-brochure">
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="container">
            <div class="section-title">
                <h2><i class="fas fa-star"></i> لماذا نحن الأفضل؟</h2>
                <p>برنامج تدريبي متكامل مصمم خصيصاً لتحقيق أعلى الدرجات</p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <i class="fas fa-brain feature-icon"></i>
                    <h3>منهج علمي متخصص</h3>
                    <p>محتوى تدريبي مصمم بعناية من قبل خبراء متخصصين في اختبارات القدرات</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-user-graduate feature-icon"></i>
                    <h3>مدربون معتمدون</h3>
                    <p>فريق من المدربين ذوي الخبرة الواسعة في تدريب الطلاب على اختبارات القدرات</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-chart-line feature-icon"></i>
                    <h3>تتبع التقدم</h3>
                    <p>نظام متقدم لتتبع مستواك ومراقبة تطورك عبر التمارين والاختبارات التجريبية</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-clock feature-icon"></i>
                    <h3>مرونة في التعلم</h3>
                    <p>تدرب في أي وقت ومن أي مكان بما يناسب جدولك اليومي</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-trophy feature-icon"></i>
                    <h3>نتائج مضمونة</h3>
                    <p>95% من طلابنا حققوا درجات عالية في اختبار القدرات الفعلي</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-headset feature-icon"></i>
                    <h3>دعم فني مستمر</h3>
                    <p>فريق الدعم متواجد على مدار الساعة للإجابة على استفساراتك</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section class="pricing-section">
        <div class="container">
            <div class="section-title">
                <h2><i class="fas fa-tags"></i> الباقات التدريبية</h2>
                <p>اختر الباقة المناسبة لك وابدأ رحلتك نحو التميز</p>
            </div>
            <div class="pricing-grid">
                <div class="pricing-card">
                    <div class="pricing-header">
                        <h3>الباقة الأساسية</h3>
                        <div class="price">
                            <span class="amount">499</span>
                            <span class="currency">ريال</span>
                        </div>
                    </div>
                    <ul class="features-list">
                        <li><i class="fas fa-check"></i> 50 سؤال تدريبي</li>
                        <li><i class="fas fa-check"></i> 5 اختبارات تجريبية</li>
                        <li><i class="fas fa-check"></i> شرح مفصل للإجابات</li>
                        <li><i class="fas fa-check"></i> صلاحية لمدة شهر</li>
                        <li><i class="fas fa-times text-muted"></i> دعم فني</li>
                    </ul>
                    <a href="#contact" class="btn btn-primary">اشترك الآن</a>
                </div>
                <div class="pricing-card featured">
                    <div class="badge">الأكثر طلباً</div>
                    <div class="pricing-header">
                        <h3>الباقة المتقدمة</h3>
                        <div class="price">
                            <span class="amount">999</span>
                            <span class="currency">ريال</span>
                        </div>
                    </div>
                    <ul class="features-list">
                        <li><i class="fas fa-check"></i> 200 سؤال تدريبي</li>
                        <li><i class="fas fa-check"></i> 15 اختبار تجريبي</li>
                        <li><i class="fas fa-check"></i> شرح مفصل للإجابات</li>
                        <li><i class="fas fa-check"></i> صلاحية لمدة 3 أشهر</li>
                        <li><i class="fas fa-check"></i> دعم فني مباشر</li>
                    </ul>
                    <a href="#contact" class="btn btn-primary">اشترك الآن</a>
                </div>
                <div class="pricing-card">
                    <div class="pricing-header">
                        <h3>الباقة الشاملة</h3>
                        <div class="price">
                            <span class="amount">1,499</span>
                            <span class="currency">ريال</span>
                        </div>
                    </div>
                    <ul class="features-list">
                        <li><i class="fas fa-check"></i> أسئلة غير محدودة</li>
                        <li><i class="fas fa-check"></i> اختبارات تجريبية غير محدودة</li>
                        <li><i class="fas fa-check"></i> شرح مفصل للإجابات</li>
                        <li><i class="fas fa-check"></i> صلاحية لمدة 6 أشهر</li>
                        <li><i class="fas fa-check"></i> دعم فني VIP</li>
                    </ul>
                    <a href="#contact" class="btn btn-primary">اشترك الآن</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section">
        <div class="container">
            <div class="section-title">
                <h2><i class="fas fa-comments"></i> آراء الطلاب</h2>
                <p>تعرف على تجارب طلابنا الناجحين</p>
            </div>
            <div class="testimonials-grid">
                <div class="testimonial-card">
                    <div class="rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">"برنامج رائع ساعدني كثيراً في الاستعداد للاختبار. حصلت على 92 في القدرات بفضل التدريب المكثف!"</p>
                    <div class="student-info">
                        <h4>أحمد محمد</h4>
                        <span>طالب ثانوي</span>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">"الأسئلة شبيهة جداً بأسئلة الاختبار الحقيقي. أنصح الجميع بالاشتراك في هذه الدورة!"</p>
                    <div class="student-info">
                        <h4>فاطمة علي</h4>
                        <span>طالبة ثانوي</span>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">"المدربون محترفون والدعم الفني ممتاز. حققت هدفي بفضل هذا البرنامج المميز!"</p>
                    <div class="student-info">
                        <h4>خالد عبدالله</h4>
                        <span>طالب جامعي</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section" id="contact">
        <div class="container">
            <div class="section-title">
                <h2><i class="fas fa-envelope"></i> تواصل معنا</h2>
                <p>نحن هنا للإجابة على جميع استفساراتك</p>
            </div>
            <div class="contact-content">
                <div class="contact-info-box">
                    <div class="info-item">
                        <i class="fas fa-phone"></i>
                        <div>
                            <h4>الهاتف</h4>
                            <p><a href="tel:+966123456789">+966 12 345 6789</a></p>
                        </div>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-envelope"></i>
                        <div>
                            <h4>البريد الإلكتروني</h4>
                            <p><a href="mailto:info@qudrat100.com">info@qudrat100.com</a></p>
                        </div>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            <h4>العنوان</h4>
                            <p>الرياض، المملكة العربية السعودية</p>
                        </div>
                    </div>
                    <div class="social-links">
                        <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-youtube"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
                <div class="contact-form">
                    <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
                        <input type="hidden" name="action" value="contact_form">
                        <?php wp_nonce_field('contact_form_nonce'); ?>
                        
                        <div class="form-group">
                            <input type="text" name="name" placeholder="الاسم" required>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" placeholder="البريد الإلكتروني" required>
                        </div>
                        <div class="form-group">
                            <input type="tel" name="phone" placeholder="رقم الجوال" required>
                        </div>
                        <div class="form-group">
                            <select name="package" required>
                                <option value="">اختر الباقة</option>
                                <option value="basic">الباقة الأساسية</option>
                                <option value="advanced">الباقة المتقدمة</option>
                                <option value="premium">الباقة الشاملة</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <textarea name="message" rows="5" placeholder="رسالتك"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane"></i>
                            إرسال
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>

