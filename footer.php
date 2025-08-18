
</main>

<!-- Footer -->
<footer class="site-footer">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Company Info -->
            <div class="col-span-1 lg:col-span-2">
                <div class="flex items-center space-x-2 text-2xl font-bold text-white mb-4">
                    <i class="fas fa-shopping-bag text-purple-400"></i>
                    <span><?php echo esc_html(get_theme_mod('site_title_text', get_bloginfo('name'))); ?></span>
                </div>
                <p class="text-gray-300 mb-6 max-w-md">
                    <?php echo esc_html(get_theme_mod('footer_description', 'Your trusted partner for premium products and exceptional customer service.')); ?>
                </p>
                
                <!-- Social Links -->
                <div class="flex space-x-4">
                    <?php
                    $social_networks = array(
                        'facebook' => 'fab fa-facebook-f',
                        'twitter' => 'fab fa-twitter',
                        'instagram' => 'fab fa-instagram',
                        'linkedin' => 'fab fa-linkedin-in',
                        'youtube' => 'fab fa-youtube',
                    );
                    
                    foreach ($social_networks as $network => $icon) :
                        $url = get_theme_mod("social_{$network}");
                        if ($url) :
                    ?>
                        <a href="<?php echo esc_url($url); ?>" 
                           target="_blank" 
                           rel="noopener noreferrer"
                           class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center text-gray-300 hover:bg-purple-600 hover:text-white transition-colors">
                            <i class="<?php echo esc_attr($icon); ?>"></i>
                        </a>
                    <?php 
                        endif;
                    endforeach; 
                    ?>
                </div>
            </div>
            
            <!-- Footer Widget Areas -->
            <?php for ($i = 1; $i <= 2; $i++) : ?>
                <?php if (is_active_sidebar("footer-{$i}")) : ?>
                    <div class="footer-widget-area">
                        <?php dynamic_sidebar("footer-{$i}"); ?>
                    </div>
                <?php endif; ?>
            <?php endfor; ?>
        </div>
        
        <!-- Footer Bottom -->
        <div class="border-t border-gray-800 mt-8 pt-8 flex flex-col md:flex-row justify-between items-center">
            <p class="text-gray-400 text-sm">
                <?php echo esc_html(get_theme_mod('footer_copyright', '© 2024 Shopora Premium Commerce. All rights reserved.')); ?>
            </p>
            
            <!-- Footer Menu -->
            <?php if (has_nav_menu('footer')) : ?>
                <nav class="mt-4 md:mt-0">
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
            <?php endif; ?>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

<script>
// Mobile menu toggle
document.getElementById('mobile-menu-toggle')?.addEventListener('click', function() {
    const mobileMenu = document.getElementById('mobile-menu');
    mobileMenu.classList.toggle('hidden');
});

// Search toggle
document.getElementById('search-toggle')?.addEventListener('click', function() {
    const searchForm = document.getElementById('search-form');
    searchForm.classList.toggle('hidden');
    if (!searchForm.classList.contains('hidden')) {
        searchForm.querySelector('input').focus();
    }
});

// Smooth scroll for anchor links
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

// Add animation classes on scroll
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
</script>

</body>
</html>
