<?php
$page_title = "الاستعداد للقدرات - دورات احترافية في القدرة المعرفية";
$page_description = "دورات احترافية ومتخصصة في القدرة المعرفية والقدرات العامة مع أفضل المدربين المعتمدين";

include 'includes/header.php';
?>

<style>
/* Hero Section */
.hero-section {
    background: #2563EB;
    color: white;
    padding: 100px 0;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.hero-content h1 {
    font-size: 3.5rem;
    margin-bottom: 20px;
    font-weight: 700;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
}

.hero-content p {
    font-size: 1.3rem;
    margin-bottom: 40px;
    opacity: 0.95;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
    line-height: 1.8;
}

.hero-buttons {
    display: flex;
    gap: 20px;
    justify-content: center;
    flex-wrap: wrap;
    margin-top: 40px;
}

/* Features Section */
.features-section {
    padding: 80px 0;
    background: white;
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 40px;
    margin-top: 60px;
}

.feature-card {
    background: white;
    padding: 40px 30px;
    border-radius: 20px;
    text-align: center;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    border-top: 5px solid #2563EB;
}

.feature-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

.feature-icon {
    font-size: 3.5rem;
    color: #2563EB;
    margin-bottom: 25px;
    display: block;
}

.feature-card h3 {
    font-size: 1.5rem;
    margin-bottom: 20px;
    color: #1e293b;
    font-weight: 600;
}

.feature-card p {
    color: #64748b;
    line-height: 1.8;
    font-size: 1.1rem;
}

/* Stats Section */
.stats-section {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    padding: 80px 0;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 40px;
    margin-top: 60px;
}

.stat-card {
    text-align: center;
    background: white;
    padding: 40px 20px;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.stat-number {
    font-size: 3rem;
    font-weight: 700;
    color: #60A5FA;
    margin-bottom: 10px;
    display: block;
}

.stat-label {
    font-size: 1.2rem;
    color: #1e293b;
    font-weight: 600;
}

/* CTA Section */
.cta-section {
    background: #6366F1;
    color: white;
    padding: 80px 0;
    text-align: center;
}

.cta-content h2 {
    font-size: 2.5rem;
    margin-bottom: 20px;
    font-weight: 700;
}

.cta-content p {
    font-size: 1.2rem;
    margin-bottom: 40px;
    opacity: 0.9;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.contact-buttons {
    display: flex;
    gap: 20px;
    justify-content: center;
    flex-wrap: wrap;
    margin-top: 40px;
}

/* Responsive Design */
@media (max-width: 768px) {
    .hero-content h1 {
        font-size: 2.5rem;
    }
    
    .hero-content p {
        font-size: 1.1rem;
    }
    
    .hero-buttons,
    .contact-buttons {
        flex-direction: column;
        align-items: center;
    }
    
    .features-grid,
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .cta-content h2 {
        font-size: 2rem;
    }
}
</style>

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
                        <span class="stat-number">5000+</span>
                        <span class="stat-label">طالب متدرب</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">10+</span>
                        <span class="stat-label">سنوات خبرة</span>
                    </div>
                </div>
                <div class="hero-buttons">
                    <a href="#pricing" class="btn btn-primary btn-lg pulse">
                        <i class="fas fa-rocket"></i> ابدأ الآن - 290 ريال
                    </a>
                    <a href="quiz.php" class="btn btn-secondary btn-lg">
                        <i class="fas fa-play"></i> اختبار مجاني
                    </a>
                </div>
                <div class="hero-guarantee">
                    <i class="fas fa-shield-alt"></i>
                    <span>ضمان استرداد المبلغ خلال 7 أيام</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Course Brochure Section -->
    <section class="course-brochure">
        <div class="container">
            <div class="brochure-content">
                <div class="brochure-text">
                    <h2>دليل دورة القدرة المعرفية</h2>
                    <p>اطلع على المنهج التفصيلي والمحتوى الشامل لدورة القدرة المعرفية. دليل متكامل يوضح جميع المواضيع والمهارات التي ستتقنها خلال الدورة.</p>
                    <div class="brochure-features">
                        <div class="feature-item">
                            <i class="fas fa-book-open"></i>
                            <span>منهج شامل ومتدرج</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-chart-line"></i>
                            <span>استراتيجيات متقدمة</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-target"></i>
                            <span>تدريب مكثف على الأسئلة</span>
                        </div>
                    </div>
                </div>
                <div class="brochure-image">
                    <img src="assets/images/بروشور-دورة-القدرة-المعرفية-ج47.jpg" alt="دليل دورة القدرة المعرفية" class="brochure-img">
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="pricing">
        <div class="container">
            <div class="section-header">
                <h2>اختر الباقة المناسبة لك</h2>
                <p>باقات مصممة خصيصاً لضمان نجاحك في اختبار القدرات</p>
            </div>
            
            <div class="pricing-grid">
                <!-- Basic Package -->
                <div class="pricing-card">
                    <div class="card-header">
                        <h3>الباقة الأساسية</h3>
                        <div class="price">
                            <span class="currency">ريال</span>
                            <span class="amount">190</span>
                        </div>
                        <p class="duration">لمدة شهر واحد</p>
                    </div>
                    <div class="card-body">
                        <ul class="features">
                            <li><i class="fas fa-check"></i> 20 ساعة تدريبية</li>
                            <li><i class="fas fa-check"></i> 500+ سؤال تدريبي</li>
                            <li><i class="fas fa-check"></i> اختبارات تجريبية</li>
                            <li><i class="fas fa-check"></i> دعم فني</li>
                            <li><i class="fas fa-times"></i> جلسات فردية</li>
                            <li><i class="fas fa-times"></i> ضمان النتيجة</li>
                        </ul>
                    </div>
                    <div class="card-footer">
                        <a href="#contact" class="btn btn-outline">اختر هذه الباقة</a>
                    </div>
                </div>

                <!-- Premium Package (Most Popular) -->
                <div class="pricing-card featured">
                    <div class="popular-badge">الأكثر طلباً</div>
                    <div class="card-header">
                        <h3>الباقة المتميزة</h3>
                        <div class="price">
                            <span class="currency">ريال</span>
                            <span class="amount">290</span>
                            <span class="old-price">350</span>
                        </div>
                        <p class="duration">لمدة شهرين</p>
                    </div>
                    <div class="card-body">
                        <ul class="features">
                            <li><i class="fas fa-check"></i> 35 ساعة تدريبية</li>
                            <li><i class="fas fa-check"></i> 1000+ سؤال تدريبي</li>
                            <li><i class="fas fa-check"></i> اختبارات تجريبية متقدمة</li>
                            <li><i class="fas fa-check"></i> دعم فني 24/7</li>
                            <li><i class="fas fa-check"></i> 3 جلسات فردية</li>
                            <li><i class="fas fa-check"></i> ضمان تحسن الدرجة</li>
                        </ul>
                    </div>
                    <div class="card-footer">
                        <a href="#contact" class="btn btn-primary">ابدأ الآن</a>
                    </div>
                </div>

                <!-- VIP Package -->
                <div class="pricing-card">
                    <div class="card-header">
                        <h3>الباقة الذهبية</h3>
                        <div class="price">
                            <span class="currency">ريال</span>
                            <span class="amount">450</span>
                        </div>
                        <p class="duration">لمدة 3 أشهر</p>
                    </div>
                    <div class="card-body">
                        <ul class="features">
                            <li><i class="fas fa-check"></i> 60 ساعة تدريبية</li>
                            <li><i class="fas fa-check"></i> 2000+ سؤال تدريبي</li>
                            <li><i class="fas fa-check"></i> اختبارات محاكاة كاملة</li>
                            <li><i class="fas fa-check"></i> دعم فني مخصص</li>
                            <li><i class="fas fa-check"></i> جلسات فردية مفتوحة</li>
                            <li><i class="fas fa-check"></i> ضمان الدرجة المطلوبة</li>
                        </ul>
                    </div>
                    <div class="card-footer">
                        <a href="#contact" class="btn btn-outline">اختر هذه الباقة</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials">
        <div class="container">
            <div class="section-header">
                <h2>ماذا يقول طلابنا</h2>
                <p>شهادات حقيقية من طلاب حققوا نتائج متميزة</p>
            </div>
            
            <div class="testimonials-grid">
                <div class="testimonial-card">
                    <div class="testimonial-content">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p>"حصلت على 89 في اختبار القدرات بعد التدريب هنا. المدربين ممتازين والمنهج شامل ومفيد جداً"</p>
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="author-info">
                            <h4>أحمد محمد</h4>
                            <span>طالب ثانوي - الرياض</span>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card">
                    <div class="testimonial-content">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p>"الدورة ساعدتني كثيراً في فهم أنواع الأسئلة وطرق الحل السريع. نصيحتي لكل طالب يسجل هنا"</p>
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="author-info">
                            <h4>فاطمة العلي</h4>
                            <span>طالبة ثانوي - جدة</span>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card">
                    <div class="testimonial-content">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p>"تحسنت درجتي من 65 إلى 92 في شهرين فقط! شكراً لفريق العمل المتميز"</p>
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="author-info">
                            <h4>خالد السعد</h4>
                            <span>طالب ثانوي - الدمام</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact/Registration Section -->
    <section id="contact" class="contact">
        <div class="container">
            <div class="contact-content">
                <div class="contact-info">
                    <h2>ابدأ رحلتك نحو النجاح</h2>
                    <p>سجل الآن واحصل على استشارة مجانية لتحديد الباقة المناسبة لك</p>
                    
                    <div class="contact-features">
                        <div class="feature-item">
                            <i class="fas fa-phone"></i>
                            <div>
                                <h4>اتصل بنا</h4>
                                <p>+966 50 123 4567</p>
                            </div>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-whatsapp"></i>
                            <div>
                                <h4>واتساب</h4>
                                <p>متاح 24/7 للاستفسارات</p>
                            </div>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <div>
                                <h4>الموقع</h4>
                                <p>الرياض - حي الملك فهد</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="contact-form">
                    <form id="registrationForm">
                        <h3>سجل الآن</h3>
                        <div class="form-group">
                            <input type="text" id="name" name="name" placeholder="الاسم الكامل" required>
                        </div>
                        <div class="form-group">
                            <input type="tel" id="phone" name="phone" placeholder="رقم الجوال" required>
                        </div>
                        <div class="form-group">
                            <input type="email" id="email" name="email" placeholder="البريد الإلكتروني" required>
                        </div>
                        <div class="form-group">
                            <select id="package" name="package" required>
                                <option value="">اختر الباقة</option>
                                <option value="basic">الباقة الأساسية - 190 ريال</option>
                                <option value="premium">الباقة المتميزة - 290 ريال</option>
                                <option value="vip">الباقة الذهبية - 450 ريال</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <textarea id="message" name="message" placeholder="ملاحظات إضافية (اختياري)" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-paper-plane"></i> إرسال الطلب
                        </button>
                        <p class="form-note">
                            <i class="fas fa-lock"></i>
                            بياناتك محمية ولن يتم مشاركتها مع أطراف أخرى
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="container">
            <div class="text-center">
                <h2 style="font-size: 2.5rem; color: #2563EB; margin-bottom: 20px; font-weight: 700;">لماذا تختار دوراتنا؟</h2>
                <p style="font-size: 1.2rem; color: #64748b; max-width: 600px; margin: 0 auto;">نقدم تجربة تعليمية متميزة تجمع بين الخبرة الأكاديمية والتطبيق العملي</p>
            </div>

            <div class="features-grid">
                <div class="feature-card">
                    <i class="fas fa-user-graduate feature-icon"></i>
                    <h3>مدربون معتمدون</h3>
                    <p>فريق من أفضل المدربين المعتمدين والمتخصصين في اختبارات القدرات مع سنوات من الخبرة في التدريب</p>
                </div>

                <div class="feature-card">
                    <i class="fas fa-chart-line feature-icon"></i>
                    <h3>نتائج مضمونة</h3>
                    <p>برامج تدريبية مثبتة الفعالية مع ضمان تحسن الدرجات وتحقيق النتائج المرجوة في الاختبارات الفعلية</p>
                </div>

                <div class="feature-card">
                    <i class="fas fa-laptop feature-icon"></i>
                    <h3>تعلم تفاعلي</h3>
                    <p>منصة تعليمية متطورة مع اختبارات تفاعلية وتقييم فوري لضمان فهم أفضل وتطبيق عملي</p>
                </div>

                <div class="feature-card">
                    <i class="fas fa-clock feature-icon"></i>
                    <h3>مرونة في التوقيت</h3>
                    <p>جدولة مرنة تناسب ظروفك مع إمكانية الوصول للمحتوى في أي وقت ومن أي مكان</p>
                </div>

                <div class="feature-card">
                    <i class="fas fa-headset feature-icon"></i>
                    <h3>دعم مستمر</h3>
                    <p>فريق دعم متاح على مدار الساعة للإجابة على استفساراتك ومساعدتك في رحلتك التعليمية</p>
                </div>

                <div class="feature-card">
                    <i class="fas fa-certificate feature-icon"></i>
                    <h3>شهادات معتمدة</h3>
                    <p>احصل على شهادات معتمدة عند إتمام الدورات تضيف قيمة لسيرتك الذاتية ومسيرتك المهنية</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="text-center">
                <h2 style="font-size: 2.5rem; color: #2563EB; margin-bottom: 20px; font-weight: 700;">إنجازاتنا بالأرقام</h2>
                <p style="font-size: 1.2rem; color: #64748b;">أرقام تتحدث عن جودة خدماتنا ونجاح طلابنا</p>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <span class="stat-number">5000+</span>
                    <span class="stat-label">طالب متدرب</span>
                </div>

                <div class="stat-card">
                    <span class="stat-number">95%</span>
                    <span class="stat-label">معدل النجاح</span>
                </div>

                <div class="stat-card">
                    <span class="stat-number">50+</span>
                    <span class="stat-label">مدرب معتمد</span>
                </div>

                <div class="stat-card">
                    <span class="stat-number">10+</span>
                    <span class="stat-label">سنوات خبرة</span>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <h2>ابدأ رحلتك نحو التميز</h2>
                <p>انضم إلى آلاف الطلاب الذين حققوا أحلامهم الأكاديمية والمهنية معنا</p>
                
                <div class="contact-buttons">
                    <a href="https://wa.me/966501234567" target="_blank" class="btn btn-whatsapp">
                        <i class="fab fa-whatsapp"></i> تواصل عبر واتساب
                    </a>
                    <a href="https://t.me/readiness_abilities" target="_blank" class="btn btn-telegram">
                        <i class="fab fa-telegram"></i> انضم لقناة تليجرام
                    </a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>

<script>
    // Smooth scrolling for navigation links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Fade in animation on scroll (using observerOptions from footer.php)
    const pageObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('fade-in');
            }
        });
    }, observerOptions);

    document.querySelectorAll('.card, .feature-card, .stat-card, .pricing-card, .testimonial-card').forEach(el => {
        pageObserver.observe(el);
    });

    // Registration form handling
    document.getElementById('registrationForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Get form data
        const formData = new FormData(this);
        const data = {
            name: formData.get('name'),
            phone: formData.get('phone'),
            email: formData.get('email'),
            package: formData.get('package'),
            message: formData.get('message')
        };
        
        // Validate required fields
        if (!data.name || !data.phone || !data.email || !data.package) {
            alert('يرجى ملء جميع الحقول المطلوبة');
            return;
        }
        
        // Show loading state
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> جاري الإرسال...';
        submitBtn.disabled = true;
        
        // Simulate form submission (replace with actual API call)
        setTimeout(() => {
            // Create WhatsApp message
            const packageNames = {
                'basic': 'الباقة الأساسية - 190 ريال',
                'premium': 'الباقة المتميزة - 290 ريال',
                'vip': 'الباقة الذهبية - 450 ريال'
            };
            
            const whatsappMessage = `مرحباً، أريد التسجيل في دورة القدرات
            
الاسم: ${data.name}
الجوال: ${data.phone}
البريد الإلكتروني: ${data.email}
الباقة المختارة: ${packageNames[data.package]}
${data.message ? `ملاحظات: ${data.message}` : ''}`;
            
            const whatsappUrl = `https://wa.me/966501234567?text=${encodeURIComponent(whatsappMessage)}`;
            
            // Reset form
            this.reset();
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
            
            // Show success message
            alert('تم إرسال طلبك بنجاح! سيتم توجيهك إلى واتساب لإكمال التسجيل.');
            
            // Redirect to WhatsApp
            window.open(whatsappUrl, '_blank');
            
        }, 2000);
    });

    // Counter animation for stats
    function animateCounters() {
        const counters = document.querySelectorAll('.stat-number');
        
        counters.forEach(counter => {
            const target = parseInt(counter.textContent.replace(/[^\d]/g, ''));
            const increment = target / 100;
            let current = 0;
            
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    counter.textContent = counter.textContent.replace(/\d+/, target);
                    clearInterval(timer);
                } else {
                    counter.textContent = counter.textContent.replace(/\d+/, Math.floor(current));
                }
            }, 20);
        });
    }

    // Trigger counter animation when hero section is visible
    const heroObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounters();
                heroObserver.unobserve(entry.target);
            }
        });
    });

    const heroSection = document.querySelector('.hero');
    if (heroSection) {
        heroObserver.observe(heroSection);
    }
</script>
