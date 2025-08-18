/**
 * Shopora Premium Commerce Theme JavaScript
 *
 * @package Shopora_Premium_Commerce
 */

// Wait for jQuery to be available
function initShopora() {
    'use strict';

    // Use $ safely within this scope
    const $ = jQuery;

    $(document).ready(function() {

        // Initialize theme functionality
        initMobileMenu();
        initSearchToggle();
        initSmoothScroll();
        initScrollAnimations();
        initHeaderScroll();

        // WooCommerce specific
        if (typeof wc_add_to_cart_params !== 'undefined') {
            initWooCommerce();
        }
    });

    /**
     * Mobile Menu Toggle
     */
    function initMobileMenu() {
        $('#mobile-menu-toggle').on('click', function(e) {
            e.preventDefault();
            $('#mobile-menu').toggleClass('hidden');
            $(this).toggleClass('active');
        });

        // Close mobile menu when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('#mobile-menu-toggle, #mobile-menu').length) {
                $('#mobile-menu').addClass('hidden');
                $('#mobile-menu-toggle').removeClass('active');
            }
        });
    }

    /**
     * Search Toggle
     */
    function initSearchToggle() {
        $('#search-toggle').on('click', function(e) {
            e.preventDefault();
            const $searchForm = $('#search-form');
            $searchForm.toggleClass('hidden');

            if (!$searchForm.hasClass('hidden')) {
                $searchForm.find('input[type="search"]').focus();
            }
        });

        // Close search when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('#search-toggle, #search-form').length) {
                $('#search-form').addClass('hidden');
            }
        });
    }

    /**
     * Smooth Scroll for Anchor Links
     */
    function initSmoothScroll() {
        $('a[href^="#"]').on('click', function(e) {
            const target = $(this.getAttribute('href'));

            if (target.length) {
                e.preventDefault();
                $('html, body').animate({
                    scrollTop: target.offset().top - 100
                }, 600);
            }
        });
    }

    /**
     * Scroll Animations
     */
    function initScrollAnimations() {
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);

        $('.fade-in, .slide-up').each(function() {
            observer.observe(this);
        });
    }

    /**
     * Header Scroll Effect
     */
    function initHeaderScroll() {
        const $header = $('.site-header');
        let lastScrollTop = 0;

        $(window).on('scroll', function() {
            const scrollTop = $(this).scrollTop();

            if (scrollTop > 100) {
                $header.addClass('scrolled');
            } else {
                $header.removeClass('scrolled');
            }

            lastScrollTop = scrollTop;
        });
    }

    /**
     * WooCommerce Integration
     */
    function initWooCommerce() {
        // Add to cart button enhancement
        $(document.body).on('adding_to_cart', function(event, $button, data) {
            $button.addClass('loading');
        });

        $(document.body).on('added_to_cart', function(event, fragments, cart_hash, $button) {
            $button.removeClass('loading');

            // Update cart count in header
            if (fragments && fragments['div.widget_shopping_cart_content']) {
                updateCartCount();
            }
        });

        // Quantity input enhancement
        $('.quantity input[type=number]').each(function() {
            const $input = $(this);
            const $wrapper = $('<div class="quantity-wrapper flex items-center border border-gray-300 rounded-lg"></div>');
            const $minus = $('<button type="button" class="quantity-btn minus px-3 py-2 text-gray-600 hover:text-purple-600">-</button>');
            const $plus = $('<button type="button" class="quantity-btn plus px-3 py-2 text-gray-600 hover:text-purple-600">+</button>');

            $input.wrap($wrapper);
            $input.before($minus);
            $input.after($plus);
            $input.addClass('text-center border-0 flex-1 px-2 py-2 focus:outline-none');

            // Plus button
            $plus.on('click', function() {
                const currentVal = parseInt($input.val()) || 0;
                const max = parseInt($input.attr('max')) || 999;
                if (currentVal < max) {
                    $input.val(currentVal + 1).trigger('change');
                }
            });

            // Minus button
            $minus.on('click', function() {
                const currentVal = parseInt($input.val()) || 0;
                const min = parseInt($input.attr('min')) || 1;
                if (currentVal > min) {
                    $input.val(currentVal - 1).trigger('change');
                }
            });
        });
    }

    /**
     * Update Cart Count
     */
    function updateCartCount() {
        $.ajax({
            type: 'POST',
            url: shopora_ajax.ajax_url,
            data: {
                action: 'get_cart_count',
                nonce: shopora_ajax.nonce
            },
            success: function(response) {
                if (response.success) {
                    $('.cart-count').text(response.data.count);

                    if (response.data.count > 0) {
                        $('.cart-count').removeClass('hidden');
                    } else {
                        $('.cart-count').addClass('hidden');
                    }
                }
            }
        });
    }

    /**
     * Form Validation
     */
    function initFormValidation() {
        $('form').on('submit', function(e) {
            const $form = $(this);
            let isValid = true;

            // Remove previous error messages
            $form.find('.error-message').remove();

            // Check required fields
            $form.find('[required]').each(function() {
                const $field = $(this);
                const value = $field.val().trim();

                if (!value) {
                    isValid = false;
                    showFieldError($field, 'This field is required.');
                }
            });

            // Email validation
            $form.find('input[type="email"]').each(function() {
                const $field = $(this);
                const email = $field.val().trim();
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                if (email && !emailRegex.test(email)) {
                    isValid = false;
                    showFieldError($field, 'Please enter a valid email address.');
                }
            });

            if (!isValid) {
                e.preventDefault();
            }
        });
    }

    /**
     * Show Field Error
     */
    function showFieldError($field, message) {
        const $error = $('<div class="error-message text-red-600 text-sm mt-1">' + message + '</div>');
        $field.addClass('border-red-500').after($error);
    }

    /**
     * Utility: Debounce Function
     */
    function debounce(func, wait, immediate) {
        let timeout;
        return function() {
            const context = this;
            const args = arguments;
            const later = function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            const callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    }

    /**
     * Lazy Loading for Images
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

            $('img[data-src]').each(function() {
                imageObserver.observe(this);
            });
        }
    }

    // Initialize additional features
    initFormValidation();
    initLazyLoading();

}

// Initialize when jQuery is available
if (typeof jQuery !== 'undefined') {
    initShopora();
} else {
    // Wait for jQuery to load
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof jQuery !== 'undefined') {
            initShopora();
        } else {
            // Fallback for basic functionality without jQuery
            initBasicFeatures();
        }
    });
}

// Basic features that don't require jQuery
function initBasicFeatures() {
    // Mobile menu toggle
    const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');

    if (mobileMenuToggle && mobileMenu) {
        mobileMenuToggle.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });
    }

    // Search toggle
    const searchToggle = document.getElementById('search-toggle');
    const searchForm = document.getElementById('search-form');

    if (searchToggle && searchForm) {
        searchToggle.addEventListener('click', function() {
            searchForm.classList.toggle('hidden');
        });
    }
}

/**
 * AJAX Cart Count Update (WordPress AJAX Handler)
 */
if (typeof shopora_ajax !== 'undefined') {
    // This function would be handled by WordPress AJAX
    // Add this to functions.php as an AJAX handler
}