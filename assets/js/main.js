
/**
 * Main JavaScript file for Shopora Premium Commerce theme
 */

(function($) {
    'use strict';

    // Document ready
    $(document).ready(function() {
        initStickyHeader();
        initSmoothScrolling();
        initAnimations();
        initMobileMenu();
        initSearchToggle();
        initFormValidation();
        initProductQuickView();
        initCartFunctionality();
        initImageLazyLoading();
        initTooltips();
    });

    /**
     * Sticky Header
     */
    function initStickyHeader() {
        const header = $('.site-header');
        const headerHeight = header.outerHeight();
        let lastScrollTop = 0;
        
        $(window).scroll(function() {
            const scrollTop = $(this).scrollTop();
            
            if (scrollTop > headerHeight) {
                header.addClass('scrolled');
                
                // Hide header on scroll down, show on scroll up
                if (scrollTop > lastScrollTop && scrollTop > headerHeight * 2) {
                    header.addClass('hidden');
                } else {
                    header.removeClass('hidden');
                }
            } else {
                header.removeClass('scrolled hidden');
            }
            
            lastScrollTop = scrollTop;
        });
    }

    /**
     * Smooth scrolling for anchor links
     */
    function initSmoothScrolling() {
        $('a[href*="#"]:not([href="#"])').click(function() {
            if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && 
                location.hostname === this.hostname) {
                let target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                
                if (target.length) {
                    const headerHeight = $('.site-header').outerHeight();
                    
                    $('html, body').animate({
                        scrollTop: target.offset().top - headerHeight - 20
                    }, 1000, 'easeInOutCubic');
                    
                    return false;
                }
            }
        });
    }

    /**
     * Initialize scroll animations
     */
    function initAnimations() {
        // Intersection Observer for fade-in animations
        if ('IntersectionObserver' in window) {
            const animatedElements = document.querySelectorAll('.fade-in, .slide-up');
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });
            
            animatedElements.forEach(el => observer.observe(el));
        } else {
            // Fallback for older browsers
            $('.fade-in, .slide-up').addClass('visible');
        }
        
        // Counter animation
        $('.counter').each(function() {
            const $this = $(this);
            const countTo = $this.attr('data-count');
            
            const observer = new IntersectionObserver((entries) => {
                if (entries[0].isIntersecting) {
                    $({ countNum: $this.text() }).animate({
                        countNum: countTo
                    }, {
                        duration: 2000,
                        easing: 'linear',
                        step: function() {
                            $this.text(Math.floor(this.countNum));
                        },
                        complete: function() {
                            $this.text(this.countNum);
                        }
                    });
                    observer.unobserve($this[0]);
                }
            });
            
            observer.observe($this[0]);
        });
    }

    /**
     * Mobile menu functionality
     */
    function initMobileMenu() {
        const $mobileMenuBtn = $('.mobile-menu-btn');
        const $navigation = $('.main-navigation');
        const $body = $('body');
        
        $mobileMenuBtn.on('click', function() {
            $(this).toggleClass('active');
            $navigation.toggleClass('mobile-active');
            $body.toggleClass('menu-open');
            
            // Toggle aria-expanded
            const expanded = $(this).attr('aria-expanded') === 'true';
            $(this).attr('aria-expanded', !expanded);
        });
        
        // Close menu when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.main-navigation, .mobile-menu-btn').length) {
                $mobileMenuBtn.removeClass('active');
                $navigation.removeClass('mobile-active');
                $body.removeClass('menu-open');
                $mobileMenuBtn.attr('aria-expanded', 'false');
            }
        });
        
        // Close menu on window resize
        $(window).resize(function() {
            if ($(window).width() > 768) {
                $mobileMenuBtn.removeClass('active');
                $navigation.removeClass('mobile-active');
                $body.removeClass('menu-open');
                $mobileMenuBtn.attr('aria-expanded', 'false');
            }
        });
    }

    /**
     * Search toggle functionality
     */
    function initSearchToggle() {
        const $searchToggle = $('.search-toggle-btn');
        const $searchContainer = $('.search-form-container');
        
        $searchToggle.on('click', function(e) {
            e.preventDefault();
            $searchContainer.slideToggle(300);
            
            setTimeout(function() {
                $searchContainer.find('.search-field').focus();
            }, 350);
        });
        
        // Close search when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.search-toggle, .search-form-container').length) {
                $searchContainer.slideUp(300);
            }
        });
    }

    /**
     * Form validation
     */
    function initFormValidation() {
        // Contact form validation
        $('#contact-form').on('submit', function(e) {
            e.preventDefault();
            
            const $form = $(this);
            const $submitBtn = $form.find('button[type="submit"]');
            const originalText = $submitBtn.html();
            
            // Show loading state
            $submitBtn.html('<span class="loading"></span> Sending...');
            $submitBtn.prop('disabled', true);
            
            // Remove previous error messages
            $form.find('.error-message').remove();
            
            let isValid = true;
            
            // Validate required fields
            $form.find('[required]').each(function() {
                const $field = $(this);
                const value = $field.val().trim();
                
                if (!value) {
                    showFieldError($field, 'This field is required.');
                    isValid = false;
                }
            });
            
            // Validate email
            const $email = $form.find('input[type="email"]');
            const email = $email.val().trim();
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            
            if (email && !emailRegex.test(email)) {
                showFieldError($email, 'Please enter a valid email address.');
                isValid = false;
            }
            
            if (isValid) {
                // Simulate form submission
                setTimeout(function() {
                    $submitBtn.html('<i class="fas fa-check"></i> Message Sent!');
                    $submitBtn.removeClass('btn-primary').addClass('btn-success');
                    
                    setTimeout(function() {
                        $form[0].reset();
                        $submitBtn.html(originalText);
                        $submitBtn.removeClass('btn-success').addClass('btn-primary');
                        $submitBtn.prop('disabled', false);
                    }, 3000);
                }, 2000);
            } else {
                $submitBtn.html(originalText);
                $submitBtn.prop('disabled', false);
            }
        });
        
        function showFieldError($field, message) {
            $field.addClass('error');
            $field.after('<div class="error-message" style="color: var(--error-color); font-size: 0.875rem; margin-top: 0.25rem;">' + message + '</div>');
            
            $field.on('input focus', function() {
                $(this).removeClass('error');
                $(this).siblings('.error-message').remove();
            });
        }
    }

    /**
     * Product quick view functionality
     */
    function initProductQuickView() {
        $('.product-quick-view').on('click', function(e) {
            e.preventDefault();
            
            const productId = $(this).data('product-id');
            
            // Create modal
            const modal = $(`
                <div class="quick-view-modal">
                    <div class="modal-overlay"></div>
                    <div class="modal-content">
                        <button class="modal-close">&times;</button>
                        <div class="modal-body">
                            <div class="loading-spinner">
                                <span class="loading"></span>
                                Loading product details...
                            </div>
                        </div>
                    </div>
                </div>
            `);
            
            $('body').append(modal);
            
            // Load product data via AJAX
            $.ajax({
                url: shopora_ajax.ajax_url,
                type: 'POST',
                data: {
                    action: 'shopora_product_quick_view',
                    product_id: productId,
                    nonce: shopora_ajax.nonce
                },
                success: function(response) {
                    if (response.success) {
                        modal.find('.modal-body').html(response.data);
                    } else {
                        modal.find('.modal-body').html('<p>Error loading product details.</p>');
                    }
                },
                error: function() {
                    modal.find('.modal-body').html('<p>Error loading product details.</p>');
                }
            });
            
            // Close modal functionality
            modal.find('.modal-close, .modal-overlay').on('click', function() {
                modal.fadeOut(300, function() {
                    modal.remove();
                });
            });
        });
    }

    /**
     * Enhanced cart functionality
     */
    function initCartFunctionality() {
        // Update cart count on add to cart
        $(document).on('added_to_cart', function(event, fragments, cart_hash, $button) {
            // Update cart count in header
            if (fragments && fragments['.cart-count']) {
                $('.cart-count').html(fragments['.cart-count']);
            }
            
            // Show success message
            showNotification('Product added to cart!', 'success');
        });
        
        // Quantity input handlers
        $(document).on('click', '.quantity-btn', function() {
            const $btn = $(this);
            const $input = $btn.siblings('input[type="number"]');
            const currentVal = parseInt($input.val()) || 0;
            const min = parseInt($input.attr('min')) || 1;
            const max = parseInt($input.attr('max')) || 999;
            
            if ($btn.hasClass('quantity-plus') && currentVal < max) {
                $input.val(currentVal + 1).trigger('change');
            } else if ($btn.hasClass('quantity-minus') && currentVal > min) {
                $input.val(currentVal - 1).trigger('change');
            }
        });
        
        // Auto-update cart on quantity change
        let updateTimer;
        $(document).on('change', '.woocommerce-cart-form input[type="number"]', function() {
            clearTimeout(updateTimer);
            updateTimer = setTimeout(function() {
                $('[name="update_cart"]').trigger('click');
            }, 1000);
        });
    }

    /**
     * Image lazy loading
     */
    function initImageLazyLoading() {
        if ('IntersectionObserver' in window) {
            const lazyImages = document.querySelectorAll('img[data-src]');
            
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
            
            lazyImages.forEach(img => imageObserver.observe(img));
        }
    }

    /**
     * Initialize tooltips
     */
    function initTooltips() {
        $('[data-tooltip]').each(function() {
            const $element = $(this);
            const tooltipText = $element.data('tooltip');
            
            $element.on('mouseenter', function() {
                const tooltip = $('<div class="tooltip">' + tooltipText + '</div>');
                $('body').append(tooltip);
                
                const elementRect = this.getBoundingClientRect();
                tooltip.css({
                    position: 'fixed',
                    top: elementRect.top - tooltip.outerHeight() - 10,
                    left: elementRect.left + (elementRect.width / 2) - (tooltip.outerWidth() / 2),
                    zIndex: 10000
                });
            });
            
            $element.on('mouseleave', function() {
                $('.tooltip').remove();
            });
        });
    }

    /**
     * Show notification
     */
    function showNotification(message, type = 'info') {
        const notification = $(`
            <div class="notification notification-${type}">
                <span class="notification-message">${message}</span>
                <button class="notification-close">&times;</button>
            </div>
        `);
        
        $('body').append(notification);
        
        setTimeout(() => {
            notification.addClass('show');
        }, 100);
        
        // Auto hide after 5 seconds
        setTimeout(() => {
            hideNotification(notification);
        }, 5000);
        
        // Manual close
        notification.find('.notification-close').on('click', () => {
            hideNotification(notification);
        });
        
        function hideNotification($notification) {
            $notification.removeClass('show');
            setTimeout(() => {
                $notification.remove();
            }, 300);
        }
    }

    /**
     * Parallax effect for hero section
     */
    function initParallax() {
        const $heroSection = $('.hero-section');
        
        if ($heroSection.length) {
            $(window).on('scroll', function() {
                const scrollTop = $(window).scrollTop();
                const rate = scrollTop * -0.5;
                
                $heroSection.css('transform', 'translateY(' + rate + 'px)');
            });
        }
    }

    /**
     * Back to top button
     */
    function initBackToTop() {
        const backToTop = $('<button class="back-to-top" aria-label="Back to top"><i class="fas fa-arrow-up"></i></button>');
        $('body').append(backToTop);
        
        $(window).on('scroll', function() {
            if ($(window).scrollTop() > 300) {
                backToTop.addClass('show');
            } else {
                backToTop.removeClass('show');
            }
        });
        
        backToTop.on('click', function() {
            $('html, body').animate({
                scrollTop: 0
            }, 1000, 'easeInOutCubic');
        });
    }

    // Initialize additional features
    initParallax();
    initBackToTop();

    // Custom easing function
    $.easing.easeInOutCubic = function(x, t, b, c, d) {
        if ((t /= d / 2) < 1) return c / 2 * t * t * t + b;
        return c / 2 * ((t -= 2) * t * t + 2) + b;
    };

})(jQuery);

// Vanilla JS for performance-critical functions
document.addEventListener('DOMContentLoaded', function() {
    
    // Preload critical images
    const criticalImages = [
        '/wp-content/themes/shopora-premium-commerce/assets/images/hero-bg.jpg'
    ];
    
    criticalImages.forEach(src => {
        const img = new Image();
        img.src = src;
    });
    
    // Service Worker registration for PWA features
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/sw.js')
            .then(registration => console.log('SW registered'))
            .catch(error => console.log('SW registration failed'));
    }
});
