
<?php
/**
 * The front page template file
 *
 * @package Shopora_Premium_Commerce
 */

get_header();
?>

<main id="primary" class="site-main front-page">
    
    <?php if (get_theme_mod('hero_enable', true)) : ?>
        <!-- Hero Section -->
        <section class="hero-section" <?php if (get_theme_mod('hero_image')) : ?>style="background-image: linear-gradient(135deg, rgba(124, 58, 237, 0.8) 0%, rgba(168, 85, 247, 0.8) 100%), url('<?php echo esc_url(get_theme_mod('hero_image')); ?>');"<?php endif; ?>>
            <div class="container">
                <div class="hero-content">
                    <div class="hero-text">
                        <h1><?php echo esc_html(get_theme_mod('hero_title', 'Premium Products for Modern Living')); ?></h1>
                        <p><?php echo esc_html(get_theme_mod('hero_description', 'Discover our curated collection of high-quality products designed to enhance your lifestyle.')); ?></p>
                        <div class="hero-buttons">
                            <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" class="btn btn-primary">
                                <i class="fas fa-shopping-bag"></i>
                                Shop Now
                            </a>
                            <a href="<?php echo esc_url(home_url('/about/')); ?>" class="btn btn-secondary">
                                <i class="fas fa-info-circle"></i>
                                Learn More
                            </a>
                        </div>
                    </div>
                    <div class="hero-image">
                        <div class="hero-dashboard">
                            <div class="dashboard-card">
                                <div class="dashboard-header">
                                    <h3>Analytics Dashboard</h3>
                                    <div class="dashboard-stats">
                                        <span class="stat">
                                            <i class="fas fa-arrow-up"></i>
                                            +12%
                                        </span>
                                        <span class="stat">
                                            <i class="fas fa-arrow-up"></i>
                                            +8%
                                        </span>
                                        <span class="stat">
                                            <i class="fas fa-arrow-down"></i>
                                            -3%
                                        </span>
                                    </div>
                                </div>
                                <div class="dashboard-chart">
                                    <svg viewBox="0 0 300 150" class="chart-svg">
                                        <polyline points="0,140 30,120 60,100 90,80 120,60 150,70 180,50 210,40 240,30 270,20 300,10" stroke="currentColor" fill="none" stroke-width="3"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
    
    <!-- Featured Products Section -->
    <?php if (class_exists('WooCommerce')) : ?>
        <section class="featured-products">
            <div class="container">
                <div class="section-header">
                    <h2>Featured Products</h2>
                    <p>Discover our most popular items, carefully selected for their quality and innovation</p>
                </div>
                
                <div class="products-grid">
                    <?php
                    $featured_products = wc_get_featured_product_ids();
                    $featured_query = new WP_Query(array(
                        'post_type' => 'product',
                        'posts_per_page' => 6,
                        'post__in' => $featured_products,
                        'meta_query' => WC()->query->get_meta_query(),
                        'tax_query' => WC()->query->get_tax_query(),
                    ));
                    
                    if ($featured_query->have_posts()) :
                        while ($featured_query->have_posts()) : $featured_query->the_post();
                            global $product;
                            ?>
                            <div class="product-card fade-in">
                                <div class="product-image-container">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <?php the_post_thumbnail('medium', array('class' => 'product-image')); ?>
                                        <?php else : ?>
                                            <div class="product-placeholder">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        <?php endif; ?>
                                    </a>
                                    <?php if ($product->is_on_sale()) : ?>
                                        <span class="sale-badge">Sale!</span>
                                    <?php endif; ?>
                                </div>
                                <div class="product-info">
                                    <h3 class="product-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h3>
                                    <div class="product-price">
                                        <?php echo $product->get_price_html(); ?>
                                    </div>
                                    <div class="product-actions">
                                        <a href="<?php the_permalink(); ?>" class="btn btn-primary">
                                            View Product
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                    else :
                        // Fallback products
                        ?>
                        <div class="product-card fade-in">
                            <div class="product-image-container">
                                <div class="product-placeholder">
                                    <i class="fas fa-headphones" style="font-size: 3rem; color: var(--primary-color);"></i>
                                </div>
                            </div>
                            <div class="product-info">
                                <h3 class="product-title">Premium Wireless Headphones</h3>
                                <div class="product-price">$299.00</div>
                                <div class="product-actions">
                                    <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" class="btn btn-primary">Shop Now</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="product-card fade-in">
                            <div class="product-image-container">
                                <div class="product-placeholder">
                                    <i class="fas fa-laptop" style="font-size: 3rem; color: var(--primary-color);"></i>
                                </div>
                            </div>
                            <div class="product-info">
                                <h3 class="product-title">Smart Laptop</h3>
                                <div class="product-price">$1,299.00</div>
                                <div class="product-actions">
                                    <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" class="btn btn-primary">Shop Now</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="product-card fade-in">
                            <div class="product-image-container">
                                <div class="product-placeholder">
                                    <i class="fas fa-mobile-alt" style="font-size: 3rem; color: var(--primary-color);"></i>
                                </div>
                            </div>
                            <div class="product-info">
                                <h3 class="product-title">Smartphone Pro</h3>
                                <div class="product-price">$899.00</div>
                                <div class="product-actions">
                                    <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" class="btn btn-primary">Shop Now</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="product-card fade-in">
                            <div class="product-image-container">
                                <div class="product-placeholder">
                                    <i class="fas fa-watch" style="font-size: 3rem; color: var(--primary-color);"></i>
                                </div>
                            </div>
                            <div class="product-info">
                                <h3 class="product-title">Smart Watch</h3>
                                <div class="product-price">$399.00</div>
                                <div class="product-actions">
                                    <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" class="btn btn-primary">Shop Now</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="product-card fade-in">
                            <div class="product-image-container">
                                <div class="product-placeholder">
                                    <i class="fas fa-camera" style="font-size: 3rem; color: var(--primary-color);"></i>
                                </div>
                            </div>
                            <div class="product-info">
                                <h3 class="product-title">Digital Camera</h3>
                                <div class="product-price">$799.00</div>
                                <div class="product-actions">
                                    <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" class="btn btn-primary">Shop Now</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="product-card fade-in">
                            <div class="product-image-container">
                                <div class="product-placeholder">
                                    <i class="fas fa-gamepad" style="font-size: 3rem; color: var(--primary-color);"></i>
                                </div>
                            </div>
                            <div class="product-info">
                                <h3 class="product-title">Gaming Controller</h3>
                                <div class="product-price">$89.00</div>
                                <div class="product-actions">
                                    <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" class="btn btn-primary">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="section-footer">
                    <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" class="btn btn-primary btn-large">
                        <i class="fas fa-arrow-right"></i>
                        View All Products
                    </a>
                </div>
            </div>
        </section>
    <?php endif; ?>
    
    <!-- About Section -->
    <section class="about-section">
        <div class="container">
            <div class="about-content">
                <div class="about-text">
                    <h2>About Premium Commerce</h2>
                    <p class="about-intro">We are dedicated to bringing you the finest selection of premium products that combine quality, innovation, and style.</p>
                    <p>With years of experience in the industry, we understand what our customers value most: exceptional quality, reliable service, and competitive prices. Our team carefully curates each item to ensure it meets our high standards.</p>
                    <ul class="about-features">
                        <li>Premium quality materials</li>
                        <li>Fast and reliable shipping</li>
                        <li>30-day money-back guarantee</li>
                        <li>24/7 customer support</li>
                        <li>Secure payment processing</li>
                    </ul>
                    <a href="<?php echo esc_url(home_url('/about/')); ?>" class="btn btn-primary">
                        Learn More About Us
                    </a>
                </div>
                <div class="about-image">
                    <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=600&h=400&fit=crop&crop=center" alt="Our team at work" />
                </div>
            </div>
        </div>
    </section>
    
    <!-- Testimonials Section -->
    <section class="testimonials">
        <div class="container">
            <div class="section-header">
                <h2>What Our Customers Say</h2>
                <p>Don't just take our word for it - here's what our satisfied customers have to say</p>
            </div>
            
            <div class="testimonials-grid">
                <div class="testimonial-card slide-up">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">"Outstanding quality and exceptional service. I've been a customer for over 2 years and have never been disappointed. Highly recommended!"</p>
                    <div class="testimonial-author">
                        <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?w=100&h=100&fit=crop&crop=face" alt="Sarah Johnson" class="author-avatar" />
                        <div class="author-info">
                            <h4>Sarah Johnson</h4>
                            <span>Verified Customer</span>
                        </div>
                    </div>
                </div>
                
                <div class="testimonial-card slide-up">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">"The product quality is amazing and the customer service is top-notch. Fast shipping and easy returns make shopping here a pleasure."</p>
                    <div class="testimonial-author">
                        <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=100&h=100&fit=crop&crop=face" alt="Michael Chen" class="author-avatar" />
                        <div class="author-info">
                            <h4>Michael Chen</h4>
                            <span>Regular Customer</span>
                        </div>
                    </div>
                </div>
                
                <div class="testimonial-card slide-up">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">"I love the variety of products and the attention to detail. Every purchase has exceeded my expectations. This is my go-to store!"</p>
                    <div class="testimonial-author">
                        <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=100&h=100&fit=crop&crop=face" alt="Emily Rodriguez" class="author-avatar" />
                        <div class="author-info">
                            <h4>Emily Rodriguez</h4>
                            <span>Premium Member</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Contact/CTA Section -->
    <section class="contact-section">
        <div class="container">
            <div class="contact-content">
                <div class="contact-info">
                    <h2>Get in Touch</h2>
                    <p>Have questions about our products or need assistance? We're here to help! Contact us today and experience our exceptional customer service.</p>
                    
                    <div class="contact-details">
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
                    
                    <div class="social-links">
                        <?php
                        $social_networks = array(
                            'facebook' => 'fab fa-facebook-f',
                            'twitter' => 'fab fa-twitter',
                            'instagram' => 'fab fa-instagram',
                            'linkedin' => 'fab fa-linkedin-in',
                            'youtube' => 'fab fa-youtube'
                        );
                        
                        foreach ($social_networks as $network => $icon) {
                            $url = get_theme_mod("social_{$network}");
                            if ($url) {
                                echo '<a href="' . esc_url($url) . '" target="_blank" rel="noopener"><i class="' . esc_attr($icon) . '"></i></a>';
                            }
                        }
                        ?>
                    </div>
                </div>
                
                <div class="contact-form">
                    <h3>Send Us a Message</h3>
                    <form id="contact-form" class="contact-form-wrapper">
                        <div class="form-group">
                            <label for="contact-name">Full Name</label>
                            <input type="text" id="contact-name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="contact-email">Email Address</label>
                            <input type="email" id="contact-email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="contact-subject">Subject</label>
                            <input type="text" id="contact-subject" name="subject" required>
                        </div>
                        <div class="form-group">
                            <label for="contact-message">Message</label>
                            <textarea id="contact-message" name="message" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane"></i>
                            Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    
</main>

<?php
get_footer();
?>
