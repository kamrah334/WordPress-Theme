
/**
 * Shopora Premium Commerce Theme JavaScript
 */

(function($) {
    'use strict';

    // DOM Ready
    $(document).ready(function() {
        initializeTheme();
        initializeMobileMenu();
        initializeSearchToggle();
        initializeScrollEffects();
        initializeAnimations();
        initializeWooCommerce();
        initializeCustomizer();
    });

    /**
     * Initialize theme functionality
     */
    function initializeTheme() {
        console.log('Shopora Premium Commerce Theme Loaded');
        
        // Handle window resize
        $(window).on('resize', function() {
            handleResponsiveElements();
        });
        
        // Handle scroll events
        $(window).on('scroll', function() {
            handleHeaderScroll();
            handleScrollAnimations();
        });
    }

    /**
     * Mobile menu functionality
     */
    function initializeMobileMenu() {
        $('#mobile-menu-toggle').on('click', function(e) {
            e.preventDefault();
            const mobileMenu = $('#mobile-menu');
            const isHidden = mobileMenu.hasClass('hidden');
            
            if (isHidden) {
                mobileMenu.removeClass('hidden').addClass('block');
                $(this).attr('aria-expanded', 'true');
            } else {
                mobileMenu.removeClass('block').addClass('hidden');
                $(this).attr('aria-expanded', 'false');
            }
        });

        // Close mobile menu when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('#mobile-menu, #mobile-menu-toggle').length) {
                $('#mobile-menu').removeClass('block').addClass('hidden');
                $('#mobile-menu-toggle').attr('aria-expanded', 'false');
            }
        });
    }

    /**
     * Search toggle functionality
     */
    function initializeSearchToggle() {
        $('#search-toggle').on('click', function(e) {
            e.preventDefault();
            const searchForm = $('#search-form');
            const isHidden = searchForm.hasClass('hidden');
            
            if (isHidden) {
                searchForm.removeClass('hidden').addClass('block');
                searchForm.find('input[type="search"]').focus();
            } else {
                searchForm.removeClass('block').addClass('hidden');
            }
        });

        // Close search when pressing escape
        $(document).on('keydown', function(e) {
            if (e.key === 'Escape') {
                $('#search-form').removeClass('block').addClass('hidden');
            }
        });
    }

    /**
     * Header scroll effects
     */
    function handleHeaderScroll() {
        const header = $('.site-header');
        const scrollTop = $(window).scrollTop();
        
        if (scrollTop > 100) {
            header.addClass('scrolled');
        } else {
            header.removeClass('scrolled');
        }
    }

    /**
     * Scroll effects and animations
     */
    function initializeScrollEffects() {
        // Smooth scroll for anchor links
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
     * Initialize animations
     */
    function initializeAnimations() {
        // Intersection Observer for fade-in animations
        if ('IntersectionObserver' in window) {
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            // Observe all animation elements
            document.querySelectorAll('.fade-in, .slide-up').forEach(function(el) {
                observer.observe(el);
            });
        }
    }

    /**
     * WooCommerce specific functionality
     */
    function initializeWooCommerce() {
        // Add to cart AJAX
        $(document).on('click', '.ajax_add_to_cart', function(e) {
            const $button = $(this);
            const productId = $button.data('product_id');
            
            $button.addClass('loading').attr('disabled', true);
            
            // Simulate AJAX request for development
            setTimeout(function() {
                $button.removeClass('loading').attr('disabled', false);
                updateCartCount();
                showNotification('Product added to cart!', 'success');
            }, 1000);
        });

        // Quantity buttons
        $(document).on('click', '.quantity-btn', function(e) {
            e.preventDefault();
            const $input = $(this).siblings('input[type="number"]');
            const currentVal = parseInt($input.val()) || 0;
            const isIncrement = $(this).hasClass('plus');
            
            if (isIncrement) {
                $input.val(currentVal + 1);
            } else if (currentVal > 1) {
                $input.val(currentVal - 1);
            }
            
            $input.trigger('change');
        });

        // Product image gallery
        initializeProductGallery();
        
        // Quick view functionality
        initializeQuickView();
    }

    /**
     * Product gallery functionality
     */
    function initializeProductGallery() {
        $('.product-gallery img').on('click', function() {
            const $this = $(this);
            const $mainImage = $('.product-main-image img');
            const newSrc = $this.attr('src');
            const newAlt = $this.attr('alt');
            
            $mainImage.fadeOut(200, function() {
                $(this).attr('src', newSrc).attr('alt', newAlt).fadeIn(200);
            });
            
            $('.product-gallery img').removeClass('active');
            $this.addClass('active');
        });
    }

    /**
     * Quick view functionality
     */
    function initializeQuickView() {
        $(document).on('click', '.quick-view-btn', function(e) {
            e.preventDefault();
            const productId = $(this).data('product-id');
            
            // Show loading modal
            showQuickViewModal(productId);
        });
    }

    /**
     * Show quick view modal
     */
    function showQuickViewModal(productId) {
        const modalHTML = `
            <div id="quick-view-modal" class="fixed inset-0 z-50 overflow-y-auto">
                <div class="flex items-center justify-center min-h-screen px-4">
                    <div class="fixed inset-0 bg-black opacity-50"></div>
                    <div class="relative bg-white rounded-xl shadow-xl max-w-4xl w-full p-8">
                        <button class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                        <div class="text-center py-8">
                            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-purple-600 mx-auto"></div>
                            <p class="mt-4 text-gray-600">Loading product...</p>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        $('body').append(modalHTML);
        
        // Close modal functionality
        $('#quick-view-modal').on('click', function(e) {
            if (e.target === this || $(e.target).closest('.fa-times').length) {
                $(this).remove();
            }
        });
    }

    /**
     * Update cart count
     */
    function updateCartCount() {
        if (typeof shopora_ajax !== 'undefined') {
            $.ajax({
                url: shopora_ajax.ajax_url,
                type: 'POST',
                data: {
                    action: 'get_cart_count',
                    nonce: shopora_ajax.nonce
                },
                success: function(response) {
                    if (response.success) {
                        $('.cart-count').text(response.data.count);
                        if (response.data.count > 0) {
                            $('.cart-count').show();
                        } else {
                            $('.cart-count').hide();
                        }
                    }
                }
            });
        }
    }

    /**
     * Show notification
     */
    function showNotification(message, type = 'info') {
        const notificationHTML = `
            <div class="notification fixed top-4 right-4 z-50 px-6 py-4 rounded-lg shadow-lg text-white ${type === 'success' ? 'bg-green-600' : 'bg-blue-600'} transform translate-x-full transition-transform duration-300">
                <div class="flex items-center">
                    <i class="fas ${type === 'success' ? 'fa-check' : 'fa-info'} mr-3"></i>
                    <span>${message}</span>
                </div>
            </div>
        `;
        
        const $notification = $(notificationHTML);
        $('body').append($notification);
        
        // Animate in
        setTimeout(function() {
            $notification.removeClass('translate-x-full');
        }, 100);
        
        // Auto remove
        setTimeout(function() {
            $notification.addClass('translate-x-full');
            setTimeout(function() {
                $notification.remove();
            }, 300);
        }, 3000);
    }

    /**
     * Handle responsive elements
     */
    function handleResponsiveElements() {
        const windowWidth = $(window).width();
        
        // Close mobile menu on larger screens
        if (windowWidth >= 1024) {
            $('#mobile-menu').removeClass('block').addClass('hidden');
            $('#mobile-menu-toggle').attr('aria-expanded', 'false');
        }
    }

    /**
     * Handle scroll animations
     */
    function handleScrollAnimations() {
        $('.fade-in:not(.visible)').each(function() {
            const elementTop = $(this).offset().top;
            const windowBottom = $(window).scrollTop() + $(window).height();
            
            if (elementTop < windowBottom - 100) {
                $(this).addClass('visible');
            }
        });
    }

    /**
     * Initialize customizer functionality
     */
    function initializeCustomizer() {
        // Live preview updates
        if (typeof wp !== 'undefined' && wp.customize) {
            // Color updates
            wp.customize('primary_color', function(value) {
                value.bind(function(newval) {
                    $(':root').css('--primary-color', newval);
                });
            });
            
            wp.customize('secondary_color', function(value) {
                value.bind(function(newval) {
                    $(':root').css('--secondary-color', newval);
                });
            });
            
            // Typography updates
            wp.customize('heading_font_family', function(value) {
                value.bind(function(newval) {
                    $(':root').css('--heading-font', `'${newval}', sans-serif`);
                });
            });
            
            wp.customize('body_font_family', function(value) {
                value.bind(function(newval) {
                    $(':root').css('--body-font', `'${newval}', sans-serif`);
                });
            });
            
            // Footer content updates
            wp.customize('footer_copyright', function(value) {
                value.bind(function(newval) {
                    $('.footer-copyright').text(newval);
                });
            });
        }
    }

    /**
     * Initialize on page load
     */
    $(window).on('load', function() {
        // Remove loading classes
        $('body').removeClass('loading');
        
        // Initialize any load-dependent functionality
        handleResponsiveElements();
    });

})(jQuery);
