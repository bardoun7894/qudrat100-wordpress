<!-- Social Media Section -->
<section class="social-media-section">
    <div class="container">
        <div class="social-content">
            <h2><i class="fas fa-share-alt"></i> تواصل معنا على وسائل التواصل الاجتماعي</h2>
            <p>انضم إلى مجتمعنا واحصل على آخر التحديثات والنصائح</p>
            <div class="social-buttons">
                <a href="https://wa.me/966123456789" class="social-btn whatsapp-btn" target="_blank" rel="noopener">
                    <i class="fab fa-whatsapp"></i>
                    <span>واتساب</span>
                    <small>للاستفسارات السريعة</small>
                </a>
                <a href="https://t.me/qudrat100" class="social-btn telegram-btn" target="_blank" rel="noopener">
                    <i class="fab fa-telegram-plane"></i>
                    <span>تليجرام</span>
                    <small>قناة النصائح والتحديثات</small>
                </a>
                <a href="https://twitter.com/qudrat100" class="social-btn twitter-btn" target="_blank" rel="noopener">
                    <i class="fab fa-twitter"></i>
                    <span>تويتر</span>
                    <small>آخر الأخبار والإعلانات</small>
                </a>
                <a href="https://instagram.com/qudrat100" class="social-btn instagram-btn" target="_blank" rel="noopener">
                    <i class="fab fa-instagram"></i>
                    <span>إنستجرام</span>
                    <small>صور ومقاطع تحفيزية</small>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="site-footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-col">
                <h3>عن الموقع</h3>
                <p><?php bloginfo('description'); ?></p>
                <div class="footer-social">
                    <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                    <a href="#" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>
            <div class="footer-col">
                <h3>روابط سريعة</h3>
                <ul>
                    <li><a href="<?php echo home_url('/'); ?>"><i class="fas fa-chevron-left"></i> الرئيسية</a></li>
                    <li><a href="<?php echo home_url('/demo.php'); ?>"><i class="fas fa-chevron-left"></i> تجربة مجانية</a></li>
                    <li><a href="<?php echo home_url('/quiz.php'); ?>"><i class="fas fa-chevron-left"></i> الاختبارات</a></li>
                    <li><a href="#contact"><i class="fas fa-chevron-left"></i> تواصل معنا</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h3>تواصل معنا</h3>
                <ul class="contact-list">
                    <li><i class="fas fa-phone"></i> <a href="tel:+966123456789">+966 123 456 789</a></li>
                    <li><i class="fas fa-envelope"></i> <a href="mailto:info@qudrat100.com">info@qudrat100.com</a></li>
                    <li><i class="fas fa-map-marker-alt"></i> الرياض، المملكة العربية السعودية</li>
                </ul>
            </div>
            <div class="footer-col">
                <h3>النشرة البريدية</h3>
                <p>اشترك في نشرتنا البريدية لتصلك أحدث العروض والأخبار</p>
                <form class="newsletter-form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
                    <input type="hidden" name="action" value="newsletter_subscribe">
                    <?php wp_nonce_field('newsletter_nonce'); ?>
                    <input type="email" name="email" placeholder="بريدك الإلكتروني" required>
                    <button type="submit"><i class="fas fa-paper-plane"></i></button>
                </form>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. جميع الحقوق محفوظة.</p>
            <p>تم التطوير بواسطة <a href="https://qudrat100.com" style="color: #60A5FA;">موقع الاستعداد العربي</a></p>
        </div>
    </div>
</footer>

<!-- Back to Top Button -->
<div class="back-to-top" title="العودة للأعلى">
    <i class="fas fa-arrow-up"></i>
</div>

<?php wp_footer(); ?>
</body>
</html>
