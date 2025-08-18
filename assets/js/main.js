// Vanilla JS for performance-critical functions
document.addEventListener('DOMContentLoaded', function() {
    
    // Header scroll effect
    const header = document.querySelector('.site-header');
    let lastScrollTop = 0;

    if (header) { // Check if header exists
        window.addEventListener('scroll', function() {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

            if (scrollTop > 100) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }

            // Hide header on scroll down, show on scroll up
            if (scrollTop > lastScrollTop && scrollTop > 200) {
                header.style.transform = 'translateY(-100%)';
            } else {
                header.style.transform = 'translateY(0)';
            }
            lastScrollTop = scrollTop;
        });
    }

    // Mobile menu toggle
    const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
    const mainNavigation = document.querySelector('.main-navigation');
    const body = document.body;

    if (mobileMenuBtn && mainNavigation) {
        mobileMenuBtn.addEventListener('click', function() {
            const isExpanded = this.getAttribute('aria-expanded') === 'true';
            this.setAttribute('aria-expanded', !isExpanded);
            mainNavigation.classList.toggle('mobile-open');
            body.classList.toggle('menu-open');
        });
    }
    
    // Close menu when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.main-navigation, .mobile-menu-btn') && body.classList.contains('menu-open')) {
            mobileMenuBtn.setAttribute('aria-expanded', 'false');
            mainNavigation.classList.remove('mobile-open');
            body.classList.remove('menu-open');
        }
    });

    // Close menu on window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth > 768) {
            if (mobileMenuBtn) mobileMenuBtn.setAttribute('aria-expanded', 'false');
            if (mainNavigation) mainNavigation.classList.remove('mobile-open');
            if (body) body.classList.remove('menu-open');
        }
    });


    // Search toggle
    const searchToggle = document.querySelector('.search-toggle-btn');
    const searchContainer = document.querySelector('.search-form-container');

    if (searchToggle && searchContainer) {
        searchToggle.addEventListener('click', function(e) {
            e.preventDefault();
            const isExpanded = this.getAttribute('aria-expanded') === 'true';
            this.setAttribute('aria-expanded', !isExpanded);
            searchContainer.style.display = isExpanded ? 'none' : 'block';
            
            if (!isExpanded) {
                setTimeout(function() {
                    const searchField = searchContainer.querySelector('.search-field');
                    if (searchField) {
                        searchField.focus();
                    }
                }, 50); // Small delay to ensure display is block
            }
        });

        // Close search when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.search-toggle-btn, .search-form-container') && searchContainer.style.display === 'block') {
                searchToggle.setAttribute('aria-expanded', 'false');
                searchContainer.style.display = 'none';
            }
        });
    }

    // Smooth scroll for anchor links
    const anchorLinks = document.querySelectorAll('a[href^="#"]:not([href="#"])');
    anchorLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const target = document.querySelector(targetId);
            if (target) {
                const headerElement = document.querySelector('.site-header');
                const headerHeight = headerElement ? headerElement.offsetHeight : 0;
                const targetOffsetTop = target.getBoundingClientRect().top + window.pageYOffset - headerHeight - 20;

                window.scrollTo({
                    top: targetOffsetTop,
                    behavior: 'smooth'
                });
            }
        });
    });

    // Fade in animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target); // Unobserve after it becomes visible
            }
        });
    }, observerOptions);

    // Observe elements with fade-in class
    document.querySelectorAll('.fade-in, .slide-up').forEach(el => {
        observer.observe(el);
    });

    // Counter animation
    const counters = document.querySelectorAll('.counter');
    counters.forEach(counter => {
        const observer = new IntersectionObserver(function(entries) {
            if (entries[0].isIntersecting) {
                const countTo = counter.getAttribute('data-count');
                let countNum = parseInt(counter.textContent) || 0;

                const animateCount = () => {
                    if (countNum < countTo) {
                        countNum += Math.ceil((countTo - countNum) / 20); // Simple animation
                        counter.textContent = countNum;
                        setTimeout(animateCount, 20);
                    } else {
                        counter.textContent = countTo;
                    }
                };
                animateCount();
                observer.unobserve(counter);
            }
        }, { threshold: 0.5 });
        observer.observe(counter);
    });


    // Product quick view functionality
    const quickViewButtons = document.querySelectorAll('.product-quick-view');
    quickViewButtons.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            
            const productId = this.dataset.productId;
            
            // Create modal
            const modal = document.createElement('div');
            modal.className = 'quick-view-modal';
            modal.innerHTML = `
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
            `;
            document.body.appendChild(modal);
            
            // Load product data via AJAX
            // This part needs actual AJAX implementation using fetch or XMLHttpRequest
            // For now, a placeholder:
            setTimeout(() => {
                modal.querySelector('.modal-body').innerHTML = `<p>Details for product ${productId}</p>`;
            }, 1000);

            // Close modal functionality
            modal.querySelector('.modal-close, .modal-overlay').addEventListener('click', function() {
                modal.remove();
            });
        });
    });

    // Enhanced cart functionality
    // Update cart count on add to cart
    document.addEventListener('added_to_cart', function(event, fragments, cart_hash, $button) {
        // Update cart count in header
        const cartCountElement = document.querySelector('.cart-count');
        if (cartCountElement && fragments && fragments['.cart-count']) {
            cartCountElement.innerHTML = fragments['.cart-count'];
        }
        
        // Show success message (requires a notification system)
        // For now, a console log:
        console.log('Product added to cart!');
    });
    
    // Quantity input handlers
    document.querySelectorAll('.quantity-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const input = this.closest('.quantity').querySelector('input[type="number"]');
            const currentVal = parseInt(input.value) || 0;
            const min = parseInt(input.min) || 1;
            const max = parseInt(input.max) || 999;
            
            if (this.classList.contains('quantity-plus') && currentVal < max) {
                input.value = currentVal + 1;
                input.dispatchEvent(new Event('change'));
            } else if (this.classList.contains('quantity-minus') && currentVal > min) {
                input.value = currentVal - 1;
                input.dispatchEvent(new Event('change'));
            }
        });
    });

    // Auto-update cart on quantity change
    let updateTimer;
    document.querySelectorAll('.woocommerce-cart-form input[type="number"]').forEach(input => {
        input.addEventListener('change', function() {
            clearTimeout(updateTimer);
            updateTimer = setTimeout(function() {
                document.querySelector('[name="update_cart"]').click();
            }, 1000);
        });
    });

    // Image lazy loading
    if ('IntersectionObserver' in window) {
        const lazyImages = document.querySelectorAll('img[data-src]');
        
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.remove('lazy');
                    // Optionally load srcset too if present
                    if (img.dataset.srcset) {
                        img.srcset = img.dataset.srcset;
                    }
                    observer.unobserve(img);
                }
            });
        });
        
        lazyImages.forEach(img => imageObserver.observe(img));
    }

    // Initialize tooltips
    document.querySelectorAll('[data-tooltip]').forEach(element => {
        const tooltipText = element.dataset.tooltip;
        
        element.addEventListener('mouseenter', function() {
            const tooltip = document.createElement('div');
            tooltip.className = 'tooltip';
            tooltip.textContent = tooltipText;
            document.body.appendChild(tooltip);
            
            const elementRect = this.getBoundingClientRect();
            const tooltipRect = tooltip.getBoundingClientRect();

            tooltip.style.position = 'fixed';
            tooltip.style.top = `${elementRect.top - tooltipRect.height - 10}px`;
            tooltip.style.left = `${elementRect.left + (elementRect.width / 2) - (tooltipRect.width / 2)}px`;
            tooltip.style.zIndex = '10000';
        });
        
        element.addEventListener('mouseleave', function() {
            const tooltip = document.querySelector('.tooltip');
            if (tooltip) {
                tooltip.remove();
            }
        });
    });

    // Notification system (basic implementation)
    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `notification notification-${type}`;
        notification.innerHTML = `
            <span class="notification-message">${message}</span>
            <button class="notification-close">&times;</button>
        `;
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.classList.add('show');
        }, 100);
        
        // Auto hide after 5 seconds
        setTimeout(() => {
            hideNotification(notification);
        }, 5000);
        
        // Manual close
        notification.querySelector('.notification-close').addEventListener('click', () => {
            hideNotification(notification);
        });
        
        function hideNotification($notification) {
            $notification.classList.remove('show');
            setTimeout(() => {
                $notification.remove();
            }, 300);
        }
    }

    // Parallax effect for hero section
    const heroSection = document.querySelector('.hero-section');
    if (heroSection) {
        window.addEventListener('scroll', function() {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            const rate = scrollTop * -0.5;
            heroSection.style.transform = `translateY(${rate}px)`;
        });
    }

    // Back to top button
    const backToTopBtn = document.createElement('button');
    backToTopBtn.innerHTML = '<i class="fas fa-arrow-up"></i>';
    backToTopBtn.className = 'back-to-top';
    backToTopBtn.setAttribute('aria-label', 'Back to top');
    document.body.appendChild(backToTopBtn);

    backToTopBtn.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 300) {
            backToTopBtn.classList.add('visible');
        } else {
            backToTopBtn.classList.remove('visible');
        }
    });

    // Form validation
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const requiredFields = form.querySelectorAll('[required]');
            let isValid = true;

            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.classList.add('error');
                    // Add error message if not already present
                    if (!field.nextElementSibling || !field.nextElementSibling.classList.contains('error-message')) {
                        const errorMessage = document.createElement('div');
                        errorMessage.className = 'error-message';
                        errorMessage.style.color = 'var(--error-color)'; // Assuming this CSS variable exists
                        errorMessage.style.fontSize = '0.875rem';
                        errorMessage.style.marginTop = '0.25rem';
                        errorMessage.textContent = 'This field is required.';
                        field.after(errorMessage);
                    }
                    isValid = false;
                } else {
                    field.classList.remove('error');
                    if (field.nextElementSibling && field.nextElementSibling.classList.contains('error-message')) {
                        field.nextElementSibling.remove();
                    }
                }
            });

            // Email validation
            const emailField = form.querySelector('input[type="email"]');
            if (emailField && emailField.value.trim()) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(emailField.value.trim())) {
                    emailField.classList.add('error');
                     if (!emailField.nextElementSibling || !emailField.nextElementSibling.classList.contains('error-message')) {
                        const errorMessage = document.createElement('div');
                        errorMessage.className = 'error-message';
                        errorMessage.style.color = 'var(--error-color)';
                        errorMessage.style.fontSize = '0.875rem';
                        errorMessage.style.marginTop = '0.25rem';
                        errorMessage.textContent = 'Please enter a valid email address.';
                        emailField.after(errorMessage);
                    }
                    isValid = false;
                } else {
                    emailField.classList.remove('error');
                    if (emailField.nextElementSibling && emailField.nextElementSibling.classList.contains('error-message')) {
                        emailField.nextElementSibling.remove();
                    }
                }
            }

            if (!isValid) {
                e.preventDefault();
            } else {
                // Simulate form submission success for demonstration
                if (form.id === 'contact-form') {
                    e.preventDefault(); // Prevent actual submission for this example
                    const submitBtn = form.querySelector('button[type="submit"]');
                    const originalText = submitBtn.innerHTML;

                    submitBtn.innerHTML = '<span class="loading"></span> Sending...';
                    submitBtn.disabled = true;

                    setTimeout(() => {
                        submitBtn.innerHTML = '<i class="fas fa-check"></i> Message Sent!';
                        submitBtn.className = 'btn-success'; // Assuming a class for success state
                        setTimeout(() => {
                            form.reset();
                            submitBtn.innerHTML = originalText;
                            submitBtn.className = 'btn-primary'; // Assuming a class for primary state
                            submitBtn.disabled = false;
                        }, 3000);
                    }, 2000);
                }
            }
        });

        // Remove error classes and messages on input/focus
        form.querySelectorAll('[required], input[type="email"]').forEach(field => {
            field.addEventListener('input', function() {
                this.classList.remove('error');
                if (this.nextElementSibling && this.nextElementSibling.classList.contains('error-message')) {
                    this.nextElementSibling.remove();
                }
            });
            field.addEventListener('focus', function() {
                 this.classList.remove('error');
                if (this.nextElementSibling && this.nextElementSibling.classList.contains('error-message')) {
                    this.nextElementSibling.remove();
                }
            });
        });
    });
});

// AJAX functionality for WordPress
window.ShoporaTheme = {
    ajaxUrl: window.location.origin + '/wp-admin/admin-ajax.php',

    // Load more posts
    loadMorePosts: function(button) {
        const page = parseInt(button.dataset.page) + 1;
        const maxPages = parseInt(button.dataset.maxPages);

        if (page > maxPages) {
            button.style.display = 'none';
            return;
        }

        button.innerHTML = '<span class="loading"></span> Loading...';
        button.disabled = true;

        // AJAX request using fetch
        fetch(this.ajaxUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                action: 'shopora_load_more_posts',
                page: page,
                // Add other parameters like nonce, category, etc. as needed
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success && data.html) {
                const postsContainer = button.closest('.posts-container') || document.querySelector('.posts-container'); // Adjust selector as needed
                if (postsContainer) {
                    postsContainer.insertAdjacentHTML('beforeend', data.html);
                }
                button.dataset.page = page;
            }
            button.innerHTML = 'Load More';
            button.disabled = false;
            if (page >= maxPages) {
                button.style.display = 'none';
            }
        })
        .catch(error => {
            console.error('Error loading more posts:', error);
            button.innerHTML = 'Load More';
            button.disabled = false;
        });
    },

    // Update cart count
    updateCartCount: function(count) {
        const cartCountElement = document.querySelector('.cart-count');
        if (cartCountElement) {
            cartCountElement.textContent = count;
            cartCountElement.style.display = count > 0 ? 'flex' : 'none';
        }
    },

    // Placeholder for quick view AJAX
    fetchProductQuickView: function(productId, callback) {
        fetch(this.ajaxUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                action: 'shopora_product_quick_view',
                product_id: productId,
                // nonce: shopora_ajax.nonce // Add nonce if available
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success && data.data) {
                callback(null, data.data);
            } else {
                callback(data.data || 'An error occurred');
            }
        })
        .catch(error => {
            callback(error);
        });
    }
};

// Event listener for AJAX 'added_to_cart'
document.addEventListener('added_to_cart', function(event, fragments, cart_hash, $button) {
    if (window.ShoporaTheme && window.ShoporaTheme.updateCartCount) {
        const cartCountElement = document.querySelector('.cart-count');
        if (cartCountElement) {
            window.ShoporaTheme.updateCartCount(cartCountElement.textContent); // Or get count from fragments
        }
    }
    // Basic notification
    const notification = document.createElement('div');
    notification.className = 'notification notification-success show';
    notification.innerHTML = '<span class="notification-message">Product added to cart!</span><button class="notification-close">&times;</button>';
    document.body.appendChild(notification);

    setTimeout(() => {
        notification.classList.remove('show');
        setTimeout(() => notification.remove(), 300);
    }, 5000);
    notification.querySelector('.notification-close').addEventListener('click', () => {
        notification.classList.remove('show');
        setTimeout(() => notification.remove(), 300);
    });
});

// Initialize features that need to run on load
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
            .then(registration => console.log('SW registered: ', registration))
            .catch(error => console.log('SW registration failed: ', error));
    }

    // Initialize Load More button if it exists
    document.querySelectorAll('.load-more-btn').forEach(button => {
        button.addEventListener('click', function() {
            window.ShoporaTheme.loadMorePosts(this);
        });
    });

    // Initialize Quick View buttons
    document.querySelectorAll('.product-quick-view').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const productId = this.dataset.productId;
            
            const modal = document.createElement('div');
            modal.className = 'quick-view-modal';
            modal.innerHTML = `
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
            `;
            document.body.appendChild(modal);

            const closeModal = () => modal.remove();
            modal.querySelector('.modal-close, .modal-overlay').addEventListener('click', closeModal);

            window.ShoporaTheme.fetchProductQuickView(productId, (error, data) => {
                if (error) {
                    modal.querySelector('.modal-body').innerHTML = `<p>${error}</p>`;
                } else {
                    modal.querySelector('.modal-body').innerHTML = data;
                    // Re-initialize any scripts needed for the modal content if necessary
                }
            });
        });
    });
});