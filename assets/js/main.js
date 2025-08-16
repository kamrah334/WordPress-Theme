/**
 * Main JavaScript file for Shopora Premium Commerce theme
 */

(function($) {
    'use strict';

    // Document ready
    $(document).ready(function() {
        
        // Initialize theme functions
        initSearchToggle();
        initSmoothScrolling();
        initAnimations();
        initMobileMenu();
        initFormValidation();
        
    });

    /**
     * Search toggle functionality
     */
    function initSearchToggle() {
        const searchToggle = $('#search-toggle');
        const searchContainer = $('#search-form-container');
        
        searchToggle.on('click', function(e) {
            e.preventDefault();
            searchContainer.slideToggle(300);
            setTimeout(function() {
                searchContainer.find('.search-field').focus();
            }, 350);
        });
        
        // Close search when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.search-toggle, #search-form-container').length) {
                searchContainer.slideUp(300);
            }
        });
    }

    /**
     * Smooth scrolling for anchor links
     */
    function initSmoothScrolling() {
        $('a[href^="#"]').on('click', function(e) {
            const target = $(this.getAttribute('href'));
            
            if (target.length) {
                e.preventDefault();
                $('html, body').stop().animate({
                    scrollTop: target.offset().top - 80
                }, 1000);
            }
        });
    }

    /**
     * Initialize scroll animations
     */
    function initAnimations() {
        // Add fade-in animation to elements as they come into view
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('fade-in');
                }
            });
        }, observerOptions);

        // Observe elements for animation
        const animateElements = document.querySelectorAll('.product-card, .testimonial-card, .about-text, .about-image');
        animateElements.forEach(function(element) {
            observer.observe(element);
        });
    }

    /**
     * Mobile menu functionality
     */
    function initMobileMenu() {
        // Create mobile menu toggle if it doesn't exist
        if (!$('.mobile-menu-toggle').length) {
            $('.main-navigation').before('<button class="mobile-menu-toggle" aria-label="Toggle Menu"><span></span><span></span><span></span></button>');
        }
        
        $('.mobile-menu-toggle').on('click', function() {
            $(this).toggleClass('active');
            $('.main-navigation').toggleClass('active');
        });
        
        // Close mobile menu when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.main-navigation, .mobile-menu-toggle').length) {
                $('.mobile-menu-toggle').removeClass('active');
                $('.main-navigation').removeClass('active');
            }
        });
    }

    /**
     * Form validation
     */
    function initFormValidation() {
        $('form').on('submit', function(e) {
            const form = $(this);
            let isValid = true;
            
            // Clear previous error states
            form.find('.error').removeClass('error');
            form.find('.error-message').remove();
            
            // Validate required fields
            form.find('[required]').each(function() {
                const field = $(this);
                const value = field.val().trim();
                
                if (!value) {
                    field.addClass('error');
                    field.after('<span class="error-message">This field is required</span>');
                    isValid = false;
                }
                
                // Email validation
                if (field.attr('type') === 'email' && value) {
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailRegex.test(value)) {
                        field.addClass('error');
                        field.after('<span class="error-message">Please enter a valid email address</span>');
                        isValid = false;
                    }
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                
                // Scroll to first error
                const firstError = form.find('.error').first();
                if (firstError.length) {
                    $('html, body').animate({
                        scrollTop: firstError.offset().top - 100
                    }, 500);
                }
            }
        });
    }

    /**
     * Cart functionality (if WooCommerce is active)
     */
    if (typeof wc_add_to_cart_params !== 'undefined') {
        // Update cart count when product is added
        $(document.body).on('added_to_cart', function(event, fragments, cart_hash, $button) {
            // Update cart count in header
            if (fragments && fragments['.cart-count']) {
                $('.cart-count').html(fragments['.cart-count']);
            }
            
            // Show success message
            showNotification('Product added to cart!', 'success');
        });
    }

    /**
     * Show notification
     */
    function showNotification(message, type) {
        const notification = $('<div class="notification notification-' + type + '">' + message + '</div>');
        
        $('body').append(notification);
        
        setTimeout(function() {
            notification.addClass('show');
        }, 100);
        
        setTimeout(function() {
            notification.removeClass('show');
            setTimeout(function() {
                notification.remove();
            }, 300);
        }, 3000);
    }

    /**
     * Scroll to top functionality
     */
    $(window).scroll(function() {
        if ($(this).scrollTop() > 300) {
            if (!$('.scroll-to-top').length) {
                $('body').append('<button class="scroll-to-top" aria-label="Scroll to top"><i class="fas fa-arrow-up"></i></button>');
            }
            $('.scroll-to-top').fadeIn();
        } else {
            $('.scroll-to-top').fadeOut();
        }
    });
    
    $(document).on('click', '.scroll-to-top', function() {
        $('html, body').animate({
            scrollTop: 0
        }, 800);
    });

    /**
     * Lazy loading for images
     */
    function initLazyLoading() {
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver(function(entries, observer) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.classList.remove('lazy');
                        imageObserver.unobserve(img);
                    }
                });
            });

            document.querySelectorAll('img[data-src]').forEach(function(img) {
                imageObserver.observe(img);
            });
        }
    }

    // Initialize lazy loading
    initLazyLoading();

})(jQuery);

// Vanilla JavaScript for non-jQuery functionality
document.addEventListener('DOMContentLoaded', function() {
    
    // Add loading states to buttons
    const buttons = document.querySelectorAll('.btn');
    buttons.forEach(function(button) {
        button.addEventListener('click', function() {
            if (this.type === 'submit') {
                this.classList.add('loading');
                this.disabled = true;
                
                setTimeout(function() {
                    button.classList.remove('loading');
                    button.disabled = false;
                }, 2000);
            }
        });
    });
    
    // Parallax effect for hero section
    window.addEventListener('scroll', function() {
        const scrolled = window.pageYOffset;
        const parallax = document.querySelector('.hero-section');
        
        if (parallax) {
            const speed = scrolled * 0.5;
            parallax.style.transform = 'translateY(' + speed + 'px)';
        }
    });
    
});
