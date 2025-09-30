/**
 * Custom Theme JavaScript
 * Add interactive features and animations
 */

jQuery(document).ready(function($) {
    
    // Smooth scrolling for anchor links
    $('a[href^="#"]').on('click', function(event) {
        var target = $(this.getAttribute('href'));
        if (target.length) {
            event.preventDefault();
            $('html, body').stop().animate({
                scrollTop: target.offset().top - 100
            }, 1000);
        }
    });
    
    // Add animation on scroll
    function animateOnScroll() {
        $('.feature-item, .registration-card').each(function() {
            var elementTop = $(this).offset().top;
            var elementBottom = elementTop + $(this).outerHeight();
            var viewportTop = $(window).scrollTop();
            var viewportBottom = viewportTop + $(window).height();
            
            if (elementBottom > viewportTop && elementTop < viewportBottom) {
                $(this).addClass('animate-in');
            }
        });
    }
    
    // Run animation on scroll
    $(window).on('scroll', animateOnScroll);
    animateOnScroll(); // Run on page load
    
    // Add hover effects for buttons
    $('.btn-whatsapp, .btn-telegram, .btn-primary, .btn-secondary').hover(
        function() {
            $(this).addClass('btn-hover');
        },
        function() {
            $(this).removeClass('btn-hover');
        }
    );
    
    // Add click tracking for registration buttons
    $('.btn-whatsapp').on('click', function() {
        // Track WhatsApp clicks
        if (typeof gtag !== 'undefined') {
            gtag('event', 'click', {
                'event_category': 'Registration',
                'event_label': 'WhatsApp'
            });
        }
    });
    
    $('.btn-telegram').on('click', function() {
        // Track Telegram clicks
        if (typeof gtag !== 'undefined') {
            gtag('event', 'click', {
                'event_category': 'Registration',
                'event_label': 'Telegram'
            });
        }
    });
    
    // Add loading animation for images
    $('img').on('load', function() {
        $(this).addClass('image-loaded');
    });
    
    // Mobile menu toggle
    $('.mobile-menu-toggle').on('click', function() {
        $('.nav-menu').toggleClass('mobile-open');
        $(this).toggleClass('active');
    });
    
    // Add parallax effect to hero section
    $(window).scroll(function() {
        var scrolled = $(this).scrollTop();
        var parallax = $('.hero-section');
        var speed = 0.5;
        
        parallax.css('transform', 'translateY(' + (scrolled * speed) + 'px)');
    });
    
    // Add counter animation for badges
    function animateCounters() {
        $('.badge').each(function() {
            var $this = $(this);
            var countTo = $this.text().match(/\d+/);
            
            if (countTo && !$this.hasClass('counted')) {
                $this.addClass('counted');
                var countNum = parseInt(countTo[0]);
                
                $({ countNum: 0 }).animate({
                    countNum: countNum
                }, {
                    duration: 2000,
                    easing: 'swing',
                    step: function() {
                        $this.text($this.text().replace(/\d+/, Math.floor(this.countNum)));
                    },
                    complete: function() {
                        $this.text($this.text().replace(/\d+/, countNum));
                    }
                });
            }
        });
    }
    
    // Run counter animation when badges are visible
    $(window).on('scroll', function() {
        var $badges = $('.hero-badges');
        if ($badges.length > 0) {
            var badgesTop = $badges.offset().top;
            var windowBottom = $(window).scrollTop() + $(window).height();
            
            if (windowBottom > badgesTop) {
                animateCounters();
            }
        }
    });
    
    // Add form validation (if forms are added later)
    $('form').on('submit', function(e) {
        var isValid = true;
        
        $(this).find('input[required], textarea[required]').each(function() {
            if (!$(this).val().trim()) {
                isValid = false;
                $(this).addClass('error');
            } else {
                $(this).removeClass('error');
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            alert('يرجى ملء جميع الحقول المطلوبة');
        }
    });
    
    // Add copy to clipboard functionality for links
    $('.copy-link').on('click', function(e) {
        e.preventDefault();
        var link = $(this).attr('href');
        
        if (navigator.clipboard) {
            navigator.clipboard.writeText(link).then(function() {
                alert('تم نسخ الرابط بنجاح!');
            });
        } else {
            // Fallback for older browsers
            var textArea = document.createElement('textarea');
            textArea.value = link;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand('copy');
            document.body.removeChild(textArea);
            alert('تم نسخ الرابط بنجاح!');
        }
    });
    
    // Example: Mobile menu toggle
    $('.menu-toggle').on('click', function() {
        $('.navigation-menu').toggleClass('active');
        $(this).toggleClass('active');
    });
    
    // Example: Back to top button
    $(window).scroll(function() {
        if ($(this).scrollTop() > 100) {
            $('.back-to-top').fadeIn();
        } else {
            $('.back-to-top').fadeOut();
        }
    });
    
    $('.back-to-top').on('click', function() {
        $('html, body').animate({scrollTop: 0}, 800);
        return false;
    });
    
    // Example: Image lazy loading
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.remove('lazy');
                    imageObserver.unobserve(img);
                }
            });
        });
        
        document.querySelectorAll('img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });
    }
    
    // Example: Form validation
    $('form').on('submit', function(e) {
        let isValid = true;
        
        $(this).find('input[required], textarea[required]').each(function() {
            if ($(this).val().trim() === '') {
                isValid = false;
                $(this).addClass('error');
            } else {
                $(this).removeClass('error');
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            alert('Please fill in all required fields.');
        }
    });
    
    // Example: AJAX functionality
    $('.ajax-load-more').on('click', function(e) {
        e.preventDefault();
        
        const button = $(this);
        const page = button.data('page') || 1;
        
        $.ajax({
            url: ajax_object.ajax_url, // WordPress AJAX URL
            type: 'POST',
            data: {
                action: 'load_more_posts',
                page: page,
                nonce: ajax_object.nonce
            },
            beforeSend: function() {
                button.text('Loading...');
            },
            success: function(response) {
                if (response.success) {
                    $('.posts-container').append(response.data.html);
                    button.data('page', page + 1);
                    button.text('Load More');
                    
                    if (!response.data.has_more) {
                        button.hide();
                    }
                } else {
                    button.text('No more posts');
                }
            },
            error: function() {
                button.text('Error loading posts');
            }
        });
    });
    
    // Example: Custom animations
    function animateOnScroll() {
        $('.animate-on-scroll').each(function() {
            const elementTop = $(this).offset().top;
            const elementBottom = elementTop + $(this).outerHeight();
            const viewportTop = $(window).scrollTop();
            const viewportBottom = viewportTop + $(window).height();
            
            if (elementBottom > viewportTop && elementTop < viewportBottom) {
                $(this).addClass('animated');
            }
        });
    }
    
    $(window).on('scroll', animateOnScroll);
    animateOnScroll(); // Run on page load
    
    // Example: Cookie consent
    if (!localStorage.getItem('cookieConsent')) {
        $('body').append('<div class="cookie-notice">This website uses cookies. <button class="accept-cookies">Accept</button></div>');
    }
    
    $(document).on('click', '.accept-cookies', function() {
        localStorage.setItem('cookieConsent', 'true');
        $('.cookie-notice').fadeOut();
    });
    
    console.log('Custom theme JavaScript loaded successfully!');
});

// Example: Custom function outside jQuery
function customFunction(param) {
    // Your custom JavaScript function
    console.log('Custom function called with parameter:', param);
    return param;
}

// Example: WordPress specific JavaScript
if (typeof wp !== 'undefined' && wp.customize) {
    // Customizer preview JavaScript
    wp.customize('blogname', function(value) {
        value.bind(function(newval) {
            $('.site-title a').text(newval);
        });
    });
}