
<!-- Footer -->
<footer class="site-footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-section">
                <h3><?php echo esc_html(get_theme_mod('header_logo_text', get_bloginfo('name'))); ?></h3>
                <p><?php echo esc_html(get_theme_mod('footer_text', 'Your trusted partner for premium products and exceptional customer service.')); ?></p>
                
                <!-- Social Media -->
                <div class="social-links">
                    <?php
                    $social_networks = array('facebook', 'twitter', 'instagram', 'linkedin', 'youtube', 'pinterest');
                    foreach ($social_networks as $network) :
                        $url = get_theme_mod("social_{$network}");
                        if ($url) :
                    ?>
                        <a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener" class="social-link">
                            <i class="fab fa-<?php echo esc_attr($network); ?>"></i>
                        </a>
                    <?php 
                        endif;
                    endforeach; 
                    ?>
                </div>
            </div>
            
            <?php if (is_active_sidebar('footer-1')) : ?>
                <div class="footer-section">
                    <?php dynamic_sidebar('footer-1'); ?>
                </div>
            <?php endif; ?>
            
            <?php if (is_active_sidebar('footer-2')) : ?>
                <div class="footer-section">
                    <?php dynamic_sidebar('footer-2'); ?>
                </div>
            <?php endif; ?>
            
            <?php if (is_active_sidebar('footer-3')) : ?>
                <div class="footer-section">
                    <?php dynamic_sidebar('footer-3'); ?>
                </div>
            <?php endif; ?>
            
            <div class="footer-section">
                <h3><?php esc_html_e('Contact Information', 'shopora-premium-commerce'); ?></h3>
                <div class="contact-info">
                    <?php $phone = get_theme_mod('contact_phone'); if ($phone) : ?>
                        <p><i class="fas fa-phone"></i> <?php echo esc_html($phone); ?></p>
                    <?php endif; ?>
                    
                    <?php $email = get_theme_mod('contact_email'); if ($email) : ?>
                        <p><i class="fas fa-envelope"></i> <?php echo esc_html($email); ?></p>
                    <?php endif; ?>
                    
                    <?php $address = get_theme_mod('contact_address'); if ($address) : ?>
                        <p><i class="fas fa-map-marker-alt"></i> <?php echo esc_html($address); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p><?php echo esc_html(get_theme_mod('footer_copyright', '© 2024 Premium Commerce. All rights reserved.')); ?></p>
            
            <?php
            wp_nav_menu(array(
                'theme_location' => 'footer',
                'menu_class' => 'footer-menu',
                'container' => false,
                'depth' => 1,
            ));
            ?>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
