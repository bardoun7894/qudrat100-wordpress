<!-- Main Content End -->

    <!-- Footer -->
    <footer class="site-footer">
        <div class="container">
            <div class="footer-content">
                <!-- About Section -->
                <div class="footer-section">
                    <h3><i class="fas fa-graduation-cap"></i> الاستعداد للقدرات</h3>
                    <p>نحن نقدم دورات احترافية ومتخصصة في القدرة المعرفية والقدرات العامة، مع فريق من أفضل المدربين المعتمدين.</p>
                    <p>هدفنا هو مساعدتك في تحقيق أفضل النتائج في اختبارات القدرات والوصول إلى أهدافك الأكاديمية والمهنية.</p>
                </div>

                <!-- Quick Links -->
                <div class="footer-section">
                    <h3><i class="fas fa-link"></i> روابط سريعة</h3>
                    <ul>
                        <li><a href="index.php"><i class="fas fa-home"></i> الرئيسية</a></li>
                        <li><a href="quiz.php"><i class="fas fa-brain"></i> الاختبار التجريبي</a></li>
                        <li><a href="courses.php"><i class="fas fa-graduation-cap"></i> الدورات المتاحة</a></li>
                        <li><a href="about.php"><i class="fas fa-info-circle"></i> من نحن</a></li>
                        <li><a href="contact.php"><i class="fas fa-envelope"></i> تواصل معنا</a></li>
                    </ul>
                </div>

                <!-- Services -->
                <div class="footer-section">
                    <h3><i class="fas fa-star"></i> خدماتنا</h3>
                    <ul>
                        <li><a href="#"><i class="fas fa-check"></i> دورة القدرة المعرفية</a></li>
                        <li><a href="#"><i class="fas fa-check"></i> دورة القدرات العامة</a></li>
                        <li><a href="#"><i class="fas fa-check"></i> اختبارات تجريبية</a></li>
                        <li><a href="#"><i class="fas fa-check"></i> متابعة شخصية</a></li>
                        <li><a href="#"><i class="fas fa-check"></i> مراجعات مكثفة</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div class="footer-section">
                    <h3><i class="fas fa-phone"></i> تواصل معنا</h3>
                    <p><i class="fas fa-envelope"></i> info@readiness-abilities.com</p>
                    <p><i class="fas fa-phone"></i> +966 50 123 4567</p>
                    <p><i class="fas fa-map-marker-alt"></i> الرياض، المملكة العربية السعودية</p>
                    
                    <div class="social-links">
                        <a href="https://wa.me/966501234567" target="_blank" title="واتساب">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <a href="https://t.me/readiness_abilities" target="_blank" title="تليجرام">
                            <i class="fab fa-telegram"></i>
                        </a>
                        <a href="https://twitter.com/readiness_abilities" target="_blank" title="تويتر">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://instagram.com/readiness_abilities" target="_blank" title="انستجرام">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://youtube.com/readiness_abilities" target="_blank" title="يوتيوب">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> الاستعداد للقدرات. جميع الحقوق محفوظة.</p>
                <p>تم التطوير بواسطة فريق الاستعداد للقدرات</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // Smooth scrolling for anchor links
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

        // Add fade-in animation to elements when they come into view
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('fade-in');
                }
            });
        }, observerOptions);

        // Observe all cards and sections
        document.querySelectorAll('.card, .footer-section').forEach(el => {
            observer.observe(el);
        });

        // Mobile menu toggle (if needed)
        const navToggle = document.querySelector('.nav-toggle');
        const navMenu = document.querySelector('.nav-menu');
        
        if (navToggle) {
            navToggle.addEventListener('click', () => {
                navMenu.classList.toggle('active');
            });
        }
    </script>

    <?php if(isset($additional_js)): ?>
        <?php foreach($additional_js as $js): ?>
            <?php 
            // Handle both relative and absolute paths
            if (strpos($js, 'http') === 0) {
                echo '<script src="' . $js . '"></script>' . "\n";
            } else {
                // Remove 'assets/js/' prefix if present and use our function
                $js_file = str_replace('assets/js/', '', $js);
                include_js($js_file, '1.0', true);
            }
            ?>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>