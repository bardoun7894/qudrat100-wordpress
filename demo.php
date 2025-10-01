<?php
$page_title = "الاستعداد للقدرات - دورة القدرة المعرفية";
$page_description = "دورة شاملة للاستعداد لاختبار القدرات المعرفية مع أمثلة تطبيقية ونماذج اختبارات";
$additional_css = [];
$additional_js = [];

include 'includes/header.php';
?>

<style>
/* Demo Page Specific Styles */
.demo-hero {
    background: linear-gradient(135deg, #4f46e5 0%, #1e293b 100%);
    color: white;
    padding: 100px 0;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.demo-hero h1 {
    font-size: 3.5rem;
    font-weight: 700;
    margin-bottom: 20px;
    text-shadow: 2px 2px 8px rgba(0,0,0,0.3);
}

.demo-hero p {
    font-size: 1.3rem;
    margin-bottom: 40px;
    opacity: 0.9;
}

.course-info {
    padding: 80px 0;
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 40px;
}

.info-card {
    background: white;
    padding: 40px;
    border-radius: 20px;
    text-align: center;
    border: 1px solid #e2e8f0;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.info-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(15, 23, 42, 0.08);
}

.info-card i {
    font-size: 3rem;
    color: #4f46e5;
    margin-bottom: 20px;
    display: block;
}

.info-card h3 {
    font-size: 1.5rem;
    color: #1e293b;
    margin-bottom: 15px;
    font-weight: 600;
}

.course-content {
    padding: 80px 0;
}

.section-title {
    font-size: 2.5rem;
    color: #1e293b;
    text-align: center;
    margin-bottom: 60px;
    font-weight: 700;
    position: relative;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: -15px;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 4px;
    background: #4f46e5;
    border-radius: 2px;
}

.modules-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 30px;
}

.module-card {
    background: white;
    border-radius: 20px;
    padding: 30px;
    box-shadow: 0 10px 30px rgba(15, 23, 42, 0.04);
    border: 1px solid #e2e8f0;
    transition: transform 0.3s ease;
}

.module-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(15, 23, 42, 0.08);
}

.module-header {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
}

.module-icon {
    background: #4f46e5;
    color: white;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    margin-left: 20px;
}

.module-title {
    font-size: 1.3rem;
    color: #1e293b;
    font-weight: 600;
}

.quiz-demo {
    padding: 80px 0;
}

.demo-container {
    max-width: 800px;
    margin: 0 auto;
}

.demo-question {
    background: white;
    border-radius: 15px;
    padding: 30px;
    margin-bottom: 30px;
    border: 1px solid #e2e8f0;
}

.question-number {
    background: #4f46e5;
    color: white;
    padding: 8px 16px;
    border-radius: 20px;
    font-weight: 600;
}

.question-category {
    background: #eef2ff;
    color: #4f46e5;
    padding: 6px 12px;
    border-radius: 15px;
    font-size: 0.9rem;
    font-weight: 600;
}

.option:hover {
    background: #eef2ff;
    border-color: #4f46e5;
}

.option.selected {
    background: #4f46e5;
    color: white;
    border-color: #4f46e5;
}

.option-letter {
    background: white;
    color: #4f46e5;
    width: 35px;
    height: 35px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    flex-shrink: 0;
}

.option.selected .option-letter {
    background: white;
    color: #4f46e5;
}

.cta-section {
    background: #1e293b;
    color: white;
    padding: 80px 0;
    text-align: center;
}
</style>

<main class="main-content">
    <!-- Hero Section -->
    <section class="demo-hero">
        <div class="container">
            <h1><i class="fas fa-graduation-cap"></i> دورة القدرة المعرفية</h1>
            <p>استعد لاختبار القدرات بأحدث الطرق والأساليب التعليمية المتطورة</p>
            <a href="quiz.php" class="btn btn-primary btn-lg">
                <i class="fas fa-play"></i> ابدأ الاختبار التجريبي
            </a>
        </div>
    </section>

    <!-- Course Information -->
    <section class="course-info">
        <div class="container">
            <div class="info-grid">
                <div class="info-card">
                    <i class="fas fa-clock"></i>
                    <h3>مدة الدورة</h3>
                    <p>35 يوم تدريبي مكثف مع جلسات يومية مدتها ساعة ونصف لضمان الاستيعاب الكامل</p>
                </div>
                <div class="info-card">
                    <i class="fas fa-users"></i>
                    <h3>المدرب</h3>
                    <p>عبدالله الغامدي - خبير في اختبارات القدرات مع أكثر من 10 سنوات خبرة</p>
                </div>
                <div class="info-card">
                    <i class="fas fa-calendar"></i>
                    <h3>التاريخ</h3>
                    <p>من 28 أبريل إلى 1 يونيو 2024 - جلسات مسائية من 8:00 إلى 9:30</p>
                </div>
                <div class="info-card">
                    <i class="fas fa-map-marker-alt"></i>
                    <h3>المكان</h3>
                    <p>قاعة التدريب الرئيسية - مركز الاستعداد للقدرات</p>
                </div>
                <div class="info-card">
                    <i class="fas fa-money-bill-wave"></i>
                    <h3>الرسوم</h3>
                    <p>290 ريال شامل جميع المواد التدريبية والاختبارات التجريبية</p>
                </div>
                <div class="info-card">
                    <i class="fas fa-certificate"></i>
                    <h3>الشهادة</h3>
                    <p>شهادة معتمدة من مركز الاستعداد للقدرات عند إتمام الدورة</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Course Content -->
    <section class="course-content">
        <div class="container">
            <div class="content-section">
                <h2 class="section-title">محتوى الدورة</h2>
                <div class="modules-grid">
                    <div class="module-card">
                        <div class="module-header">
                            <div class="module-icon">
                                <i class="fas fa-calculator"></i>
                            </div>
                            <h3 class="module-title">القدرة الكمية</h3>
                        </div>
                        <p class="module-description">
                            تطوير المهارات الرياضية والحسابية اللازمة لحل المسائل الكمية بطريقة سريعة ودقيقة
                        </p>
                        <ul class="module-features">
                            <li>الحساب الذهني والتقدير</li>
                            <li>الجبر والمعادلات</li>
                            <li>الهندسة والقياس</li>
                            <li>الإحصاء والاحتمالات</li>
                            <li>حل المسائل اللفظية</li>
                        </ul>
                    </div>

                    <div class="module-card">
                        <div class="module-header">
                            <div class="module-icon">
                                <i class="fas fa-language"></i>
                            </div>
                            <h3 class="module-title">القدرة اللفظية</h3>
                        </div>
                        <p class="module-description">
                            تنمية المهارات اللغوية والفهم القرائي وإثراء المفردات العربية
                        </p>
                        <ul class="module-features">
                            <li>فهم المقروء والاستيعاب</li>
                            <li>المفردات والمرادفات</li>
                            <li>التناظر اللفظي</li>
                            <li>إكمال الجمل</li>
                            <li>الخطأ السياقي</li>
                        </ul>
                    </div>

                    <div class="module-card">
                        <div class="module-header">
                            <div class="module-icon">
                                <i class="fas fa-brain"></i>
                            </div>
                            <h3 class="module-title">التفكير المنطقي</h3>
                        </div>
                        <p class="module-description">
                            تطوير مهارات التفكير النقدي والتحليل المنطقي لحل المشكلات المعقدة
                        </p>
                        <ul class="module-features">
                            <li>الأنماط والتسلسل</li>
                            <li>الاستنتاج المنطقي</li>
                            <li>التفكير النقدي</li>
                            <li>حل المشكلات</li>
                            <li>التحليل والتركيب</li>
                        </ul>
                    </div>

                    <div class="module-card">
                        <div class="module-header">
                            <div class="module-icon">
                                <i class="fas fa-stopwatch"></i>
                            </div>
                            <h3 class="module-title">إدارة الوقت</h3>
                        </div>
                        <p class="module-description">
                            استراتيجيات فعالة لإدارة الوقت أثناء الاختبار وتحسين الأداء
                        </p>
                        <ul class="module-features">
                            <li>تقسيم الوقت بفعالية</li>
                            <li>ترتيب الأولويات</li>
                            <li>تقنيات الحل السريع</li>
                            <li>التعامل مع ضغط الوقت</li>
                            <li>استراتيجيات التخمين الذكي</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Quiz Demo -->
    <section class="quiz-demo">
        <div class="container">
            <h2 class="section-title">نموذج اختبار تجريبي</h2>
            <div class="demo-container">
                <div class="demo-question">
                    <div class="question-header">
                        <span class="question-number">السؤال 1</span>
                        <span class="question-category">القدرة الكمية</span>
                    </div>
                    <div class="question-text">
                        ما هو الرقم التالي في هذه السلسلة: 2, 6, 18, 54, ؟
                    </div>
                    <div class="options">
                        <div class="option" onclick="selectOption(this)">
                            <div class="option-letter">أ</div>
                            <span>108</span>
                        </div>
                        <div class="option" onclick="selectOption(this)">
                            <div class="option-letter">ب</div>
                            <span>162</span>
                        </div>
                        <div class="option" onclick="selectOption(this)">
                            <div class="option-letter">ج</div>
                            <span>216</span>
                        </div>
                        <div class="option" onclick="selectOption(this)">
                            <div class="option-letter">د</div>
                            <span>324</span>
                        </div>
                    </div>
                </div>

                <div class="demo-question">
                    <div class="question-header">
                        <span class="question-number">السؤال 2</span>
                        <span class="question-category">القدرة اللفظية</span>
                    </div>
                    <div class="question-text">
                        ما هو المرادف الأقرب لكلمة "متقن"؟
                    </div>
                    <div class="options">
                        <div class="option" onclick="selectOption(this)">
                            <div class="option-letter">أ</div>
                            <span>مهمل</span>
                        </div>
                        <div class="option" onclick="selectOption(this)">
                            <div class="option-letter">ب</div>
                            <span>ماهر</span>
                        </div>
                        <div class="option" onclick="selectOption(this)">
                            <div class="option-letter">ج</div>
                            <span>بطيء</span>
                        </div>
                        <div class="option" onclick="selectOption(this)">
                            <div class="option-letter">د</div>
                            <span>ضعيف</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <h2>ابدأ رحلتك نحو النجاح</h2>
                <p>انضم إلى آلاف الطلاب الذين حققوا نتائج متميزة في اختبار القدرات</p>
                <div class="cta-buttons">
                    <a href="quiz.php" class="btn btn-primary btn-lg">
                        <i class="fas fa-play"></i> ابدأ الاختبار التجريبي
                    </a>
                    <a href="index.php" class="btn btn-secondary btn-lg">
                        <i class="fas fa-home"></i> العودة للرئيسية
                    </a>
                </div>
            </div>
        </div>
    </section>
</main>

<script>
function selectOption(element) {
    // Remove selection from siblings
    const siblings = element.parentNode.children;
    for (let sibling of siblings) {
        sibling.classList.remove('selected');
    }
    
    // Add selection to clicked option
    element.classList.add('selected');
}

// Add smooth scrolling for anchor links
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

// Add fade-in animation for cards
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
        }
    });
}, observerOptions);

// Observe all cards
document.addEventListener('DOMContentLoaded', () => {
    const cards = document.querySelectorAll('.info-card, .module-card, .demo-question');
    cards.forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(card);
    });
});
</script>

<?php include 'includes/footer.php'; ?>