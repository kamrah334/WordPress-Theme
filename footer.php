<?php
/**
 * The template for displaying the footer
 *
 * @package Shopora_Premium_Commerce
 */
?>

    </div><!-- #content -->

    <footer id="colophon" class="site-footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <?php if (is_active_sidebar('footer-1')) : ?>
                        <?php dynamic_sidebar('footer-1'); ?>
                    <?php else : ?>
                        <h3>Premium Commerce</h3>
                        <p>Your trusted partner for premium products and exceptional customer service.</p>
                        <div class="social-links">
                            <a href="#" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
                            <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                            <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                            <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin"></i></a>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="footer-section">
                    <?php if (is_active_sidebar('footer-2')) : ?>
                        <?php dynamic_sidebar('footer-2'); ?>
                    <?php else : ?>
                        <h3>Quick Links</h3>
                        <ul>
                            <li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
                            <li><a href="<?php echo esc_url(home_url('/shop/')); ?>">Products</a></li>
                            <li><a href="<?php echo esc_url(home_url('/about/')); ?>">About</a></li>
                            <li><a href="<?php echo esc_url(home_url('/contact/')); ?>">Contact</a></li>
                        </ul>
                    <?php endif; ?>
                </div>

                <div class="footer-section">
                    <?php if (is_active_sidebar('footer-3')) : ?>
                        <?php dynamic_sidebar('footer-3'); ?>
                    <?php else : ?>
                        <h3>Customer Service</h3>
                        <ul>
                            <li><a href="#">Help Center</a></li>
                            <li><a href="#">Shipping Info</a></li>
                            <li><a href="#">Returns</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Terms of Service</a></li>
                        </ul>
                    <?php endif; ?>
                </div>

                <div class="footer-section">
                    <?php if (is_active_sidebar('footer-4')) : ?>
                        <?php dynamic_sidebar('footer-4'); ?>
                    <?php else : ?>
                        <h3>Contact Information</h3>
                        <div class="contact-info">
                            <div class="contact-item">
                                <i class="fas fa-phone"></i>
                                <span><?php echo esc_html(get_theme_mod('contact_phone', '+1 (555) 123-4567')); ?></span>
                            </div>
                            <div class="contact-item">
                                <i class="fas fa-envelope"></i>
                                <span><?php echo esc_html(get_theme_mod('contact_email', 'hello@premiumcommerce.com')); ?></span>
                            </div>
                            <div class="contact-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <span><?php echo esc_html(get_theme_mod('contact_address', '123 Business Ave, Suite 100, City, State 12345')); ?></span>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved. | 
                   Designed with <i class="fas fa-heart" style="color: #e11d48;"></i> by Premium Commerce Team</p>
            </div>
        </div>
    </footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
