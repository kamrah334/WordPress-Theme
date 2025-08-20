
</main>

<!-- Footer -->
<footer class="site-footer bg-gradient-to-br from-gray-900 via-gray-800 to-black text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Main Footer Content -->
        <div class="py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Company Info -->
                <div class="col-span-1 lg:col-span-2">
                    <div class="flex items-center space-x-3 text-2xl font-bold mb-6">
                        <div class="w-12 h-12 bg-gradient-to-r from-purple-600 to-indigo-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-shopping-bag text-white text-xl"></i>
                        </div>
                        <span><?php echo esc_html(get_theme_mod('site_title_text', get_bloginfo('name'))); ?></span>
                    </div>
                    <p class="text-gray-300 mb-6 max-w-md leading-relaxed">
                        <?php echo esc_html(get_theme_mod('footer_description', 'Your trusted partner for premium products and exceptional customer service. We bring you the latest in technology and design.')); ?>
                    </p>
                    
                    <!-- Newsletter Signup -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold mb-4">Stay Updated</h3>
                        <form class="flex flex-col sm:flex-row gap-3 max-w-md">
                            <input type="email" 
                                   placeholder="Enter your email" 
                                   class="flex-1 px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent text-white placeholder-gray-400">
                            <button type="submit" 
                                    class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-6 py-3 rounded-lg font-semibold hover:from-purple-700 hover:to-indigo-700 transition-all transform hover:scale-105">
                                Subscribe
                            </button>
                        </form>
                    </div>
                    
                    <!-- Social Links -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Follow Us</h3>
                        <div class="flex space-x-4">
                            <?php
                            $social_networks = array(
                                'facebook' => ['icon' => 'fab fa-facebook-f', 'color' => 'hover:bg-blue-600'],
                                'twitter' => ['icon' => 'fab fa-twitter', 'color' => 'hover:bg-blue-400'],
                                'instagram' => ['icon' => 'fab fa-instagram', 'color' => 'hover:bg-pink-600'],
                                'linkedin' => ['icon' => 'fab fa-linkedin-in', 'color' => 'hover:bg-blue-700'],
                                'youtube' => ['icon' => 'fab fa-youtube', 'color' => 'hover:bg-red-600'],
                            );
                            
                            foreach ($social_networks as $network => $data) :
                                $url = get_theme_mod("social_{$network}");
                                if ($url) :
                            ?>
                                <a href="<?php echo esc_url($url); ?>" 
                                   target="_blank" 
                                   rel="noopener noreferrer"
                                   class="w-12 h-12 bg-gray-800 rounded-xl flex items-center justify-center text-gray-300 <?php echo esc_attr($data['color']); ?> transition-all transform hover:scale-110 hover:text-white">
                                    <i class="<?php echo esc_attr($data['icon']); ?>"></i>
                                </a>
                            <?php 
                                endif;
                            endforeach; 
                            ?>
                        </div>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-semibold mb-6">Quick Links</h3>
                    <ul class="space-y-3">
                        <li><a href="/shop" class="text-gray-300 hover:text-white hover:translate-x-1 transition-all duration-200 inline-block">Shop All</a></li>
                        <li><a href="/about" class="text-gray-300 hover:text-white hover:translate-x-1 transition-all duration-200 inline-block">About Us</a></li>
                        <li><a href="/contact" class="text-gray-300 hover:text-white hover:translate-x-1 transition-all duration-200 inline-block">Contact</a></li>
                        <li><a href="/blog" class="text-gray-300 hover:text-white hover:translate-x-1 transition-all duration-200 inline-block">Blog</a></li>
                        <li><a href="/faq" class="text-gray-300 hover:text-white hover:translate-x-1 transition-all duration-200 inline-block">FAQ</a></li>
                    </ul>
                </div>
                
                <!-- Customer Service -->
                <div>
                    <h3 class="text-lg font-semibold mb-6">Customer Service</h3>
                    <ul class="space-y-3">
                        <li><a href="/shipping" class="text-gray-300 hover:text-white hover:translate-x-1 transition-all duration-200 inline-block">Shipping Info</a></li>
                        <li><a href="/returns" class="text-gray-300 hover:text-white hover:translate-x-1 transition-all duration-200 inline-block">Returns</a></li>
                        <li><a href="/warranty" class="text-gray-300 hover:text-white hover:translate-x-1 transition-all duration-200 inline-block">Warranty</a></li>
                        <li><a href="/support" class="text-gray-300 hover:text-white hover:translate-x-1 transition-all duration-200 inline-block">Support</a></li>
                        <li><a href="/track-order" class="text-gray-300 hover:text-white hover:translate-x-1 transition-all duration-200 inline-block">Track Order</a></li>
                    </ul>
                    
                    <!-- Contact Info -->
                    <div class="mt-8 space-y-3">
                        <div class="flex items-center space-x-3 text-gray-300">
                            <i class="fas fa-phone text-purple-400"></i>
                            <span>+1 (555) 123-4567</span>
                        </div>
                        <div class="flex items-center space-x-3 text-gray-300">
                            <i class="fas fa-envelope text-purple-400"></i>
                            <span>support@shopora.com</span>
                        </div>
                        <div class="flex items-center space-x-3 text-gray-300">
                            <i class="fas fa-clock text-purple-400"></i>
                            <span>24/7 Support</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Footer Bottom -->
        <div class="border-t border-gray-800 py-8">
            <div class="flex flex-col lg:flex-row justify-between items-center space-y-4 lg:space-y-0">
                <p class="text-gray-400 text-sm">
                    <?php echo esc_html(get_theme_mod('footer_copyright', '© 2024 Shopora Premium Commerce. All rights reserved.')); ?>
                </p>
                
                <!-- Payment Methods -->
                <div class="flex items-center space-x-4">
                    <span class="text-gray-400 text-sm">We Accept:</span>
                    <div class="flex space-x-2">
                        <div class="w-8 h-6 bg-gray-700 rounded flex items-center justify-center">
                            <i class="fab fa-cc-visa text-blue-400"></i>
                        </div>
                        <div class="w-8 h-6 bg-gray-700 rounded flex items-center justify-center">
                            <i class="fab fa-cc-mastercard text-red-400"></i>
                        </div>
                        <div class="w-8 h-6 bg-gray-700 rounded flex items-center justify-center">
                            <i class="fab fa-cc-paypal text-blue-500"></i>
                        </div>
                        <div class="w-8 h-6 bg-gray-700 rounded flex items-center justify-center">
                            <i class="fab fa-cc-apple-pay text-white"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Footer Menu -->
                <?php if (has_nav_menu('footer')) : ?>
                    <nav>
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'footer',
                            'container' => false,
                            'menu_class' => 'flex space-x-6',
                            'link_before' => '<span class="text-gray-400 hover:text-white text-sm transition-colors">',
                            'link_after' => '</span>',
                            'depth' => 1,
                        ));
                        ?>
                    </nav>
                <?php else : ?>
                    <div class="flex space-x-6 text-sm">
                        <a href="/privacy" class="text-gray-400 hover:text-white transition-colors">Privacy Policy</a>
                        <a href="/terms" class="text-gray-400 hover:text-white transition-colors">Terms of Service</a>
                        <a href="/cookies" class="text-gray-400 hover:text-white transition-colors">Cookies</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</footer>

<!-- Back to Top Button -->
<button id="back-to-top" class="fixed bottom-8 right-8 w-12 h-12 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-full shadow-lg hover:shadow-xl transition-all transform hover:scale-110 opacity-0 invisible">
    <i class="fas fa-chevron-up"></i>
</button>

<?php wp_footer(); ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu toggle
    const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    
    if (mobileMenuToggle && mobileMenu) {
        mobileMenuToggle.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });
    }

    // Search overlay
    const searchToggle = document.getElementById('search-toggle');
    const searchOverlay = document.getElementById('search-overlay');
    const closeSearch = document.getElementById('close-search');
    
    if (searchToggle && searchOverlay) {
        searchToggle.addEventListener('click', function() {
            searchOverlay.classList.remove('hidden');
            searchOverlay.querySelector('input').focus();
        });
    }
    
    if (closeSearch && searchOverlay) {
        closeSearch.addEventListener('click', function() {
            searchOverlay.classList.add('hidden');
        });
        
        searchOverlay.addEventListener('click', function(e) {
            if (e.target === searchOverlay) {
                searchOverlay.classList.add('hidden');
            }
        });
    }

    // Back to top button
    const backToTop = document.getElementById('back-to-top');
    
    if (backToTop) {
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                backToTop.classList.remove('opacity-0', 'invisible');
                backToTop.classList.add('opacity-100', 'visible');
            } else {
                backToTop.classList.add('opacity-0', 'invisible');
                backToTop.classList.remove('opacity-100', 'visible');
            }
        });
        
        backToTop.addEventListener('click', function() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Intersection Observer for animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, observerOptions);

    document.querySelectorAll('.fade-in, .slide-up').forEach(el => {
        observer.observe(el);
    });
});
</script>

</body>
</html>
