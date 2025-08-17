<?php
/**
 * The front page template file
 *
 * @package Shopora_Premium_Commerce
 */

get_header();
?>

<main id="primary" class="site-main front-page">

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <h1><?php echo esc_html(get_theme_mod('hero_title', 'Premium Products for Modern Living')); ?></h1>
                    <p><?php echo esc_html(get_theme_mod('hero_description', 'Discover our curated collection of high-quality products designed to enhance your lifestyle.')); ?></p>
                    <div class="hero-buttons">
                        <a href="<?php echo esc_url(get_theme_mod('hero_primary_btn_url', '/shop')); ?>" class="btn btn-primary">
                            <?php echo esc_html(get_theme_mod('hero_primary_btn_text', 'Shop Now')); ?>
                        </a>
                        <a href="<?php echo esc_url(get_theme_mod('hero_secondary_btn_url', '/about')); ?>" class="btn btn-secondary">
                            <?php echo esc_html(get_theme_mod('hero_secondary_btn_text', 'Learn More')); ?>
                        </a>
                    </div>
                </div>
                <div class="hero-image">
                    <img src="https://images.unsplash.com/photo-1560472354-b33ff0c44a43?w=500&h=400&fit=crop&crop=center" alt="Modern lifestyle products" />
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section class="featured-products">
        <div class="container">
            <div class="section-header">
                <h2>Featured Products</h2>
                <p>Discover our most popular items chosen by customers worldwide</p>
            </div>

            <div class="products-grid">
                <?php if (class_exists('WooCommerce')) : ?>
                    <?php
                    $featured_products = wc_get_featured_product_ids();
                    if (!empty($featured_products)) {
                        $args = array(
                            'post_type' => 'product',
                            'posts_per_page' => 6,
                            'post__in' => $featured_products,
                            'meta_query' => WC()->query->get_meta_query(),
                        );
                    } else {
                        $args = array(
                            'post_type' => 'product',
                            'posts_per_page' => 6,
                            'meta_query' => WC()->query->get_meta_query(),
                        );
                    }

                    $products = new WP_Query($args);

                    if ($products->have_posts()) :
                        while ($products->have_posts()) : $products->the_post();
                            global $product;
                            ?>
                            <div class="product-card">
                                <div class="product-image-container">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail('medium', array('class' => 'product-image')); ?>
                                    <?php else : ?>
                                        <div class="product-placeholder" style="background: linear-gradient(45deg, #f3f4f6, #e5e7eb); height: 200px; display: flex; align-items: center; justify-content: center; border-radius: 8px;">
                                            <i class="fas fa-image" style="font-size: 2rem; color: #9ca3af;"></i>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <h3 class="product-title"><?php the_title(); ?></h3>
                                <p class="product-description"><?php echo wp_trim_words(get_the_excerpt(), 10); ?></p>
                                <div class="product-price"><?php echo $product->get_price_html(); ?></div>
                                <a href="<?php the_permalink(); ?>" class="btn btn-primary">Shop Now</a>
                            </div>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                <?php else : ?>
                    <!-- Fallback products if WooCommerce is not active -->
                    <div class="product-card">
                        <div style="background: linear-gradient(45deg, #fbbf24, #f59e0b); height: 200px; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-headphones" style="font-size: 3rem; color: white;"></i>
                        </div>
                        <h3 class="product-title">Premium Wireless Headphones</h3>
                        <p class="product-description">High-quality audio experience with noise cancellation</p>
                        <div class="product-price">$299.00</div>
                        <a href="#" class="btn btn-primary">Shop Now</a>
                    </div>

                    <div class="product-card">
                        <div style="background: linear-gradient(45deg, #1f2937, #374151); height: 200px; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-clock" style="font-size: 3rem; color: white;"></i>
                        </div>
                        <h3 class="product-title">Smart Fitness Watch</h3>
                        <p class="product-description">Track your fitness goals with advanced health monitoring</p>
                        <div class="product-price">$199.00</div>
                        <a href="#" class="btn btn-primary">Shop Now</a>
                    </div>

                    <div class="product-card">
                        <div style="background: linear-gradient(45deg, #6b7280, #9ca3af); height: 200px; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-laptop" style="font-size: 3rem; color: white;"></i>
                        </div>
                        <h3 class="product-title">Ultra-Thin Laptop</h3>
                        <p class="product-description">Powerful performance in a sleek, portable design</p>
                        <div class="product-price">$1,299.00</div>
                        <a href="#" class="btn btn-primary">Shop Now</a>
                    </div>
                <?php endif; ?>
            </div>
            <div style="text-align: center; margin-top: 40px;">
                <a href="<?php echo esc_url(get_theme_mod('view_all_btn_url', '/shop')); ?>" class="btn btn-primary">
                    <?php echo esc_html(get_theme_mod('view_all_btn_text', 'View All Products')); ?>
                </a>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section">
        <div class="container">
            <div class="about-content">
                <div class="about-text">
                    <h2>About Premium Commerce</h2>
                    <p>We are dedicated to bringing you the finest selection of premium products that combine quality, innovation, and style. Our team carefully curates each item to ensure it meets our high standards.</p>
                    <p>With years of experience in the industry, we understand what our customers value most: exceptional quality, reliable service, and competitive prices.</p>
                    <ul class="about-features">
                        <li>Premium quality products</li>
                        <li>Fast and reliable shipping</li>
                        <li>30-day money-back guarantee</li>
                        <li>24/7 customer support</li>
                        <li>Secure payment processing</li>
                    </ul>
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
                <p>Don't just take our word for it - here's what some customers have to say about their experience with Premium Commerce</p>
            </div>

            <div class="testimonials-grid">
                <div class="testimonial-card">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">"Outstanding quality and exceptional customer service. I've been a customer for over two years and have never been disappointed."</p>
                    <div class="testimonial-author">
                        <img src="https://images.unsplash.com/photo-1494790108755-2616b612b098?w=100&h=100&fit=crop&crop=face" alt="Sarah Johnson" class="author-avatar" />
                        <div class="author-info">
                            <h4>Sarah Johnson</h4>
                            <span>Marketing Director</span>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">"The products are exactly as described and shipping was incredibly fast. Highly recommend Premium Commerce to anyone looking for quality."</p>
                    <div class="testimonial-author">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&h=100&fit=crop&crop=face" alt="Michael Chen" class="author-avatar" />
                        <div class="author-info">
                            <h4>Michael Chen</h4>
                            <span>Software Engineer</span>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">"Amazing shopping experience! The website is easy to navigate and the customer support team is always helpful and responsive."</p>
                    <div class="testimonial-author">
                        <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=100&h=100&fit=crop&crop=face" alt="Emily Rodriguez" class="author-avatar" />
                        <div class="author-info">
                            <h4>Emily Rodriguez</h4>
                            <span>Business Owner</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section">
        <div class="container">
            <div class="contact-content">
                <div class="contact-info">
                    <h2>Get in Touch</h2>
                    <p>Have questions about our products or need help with your order? We're here to help!</p>

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
                </div>

                <div class="contact-form">
                    <form action="#" method="post">
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" id="subject" name="subject" required>
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea id="message" name="message" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section" style="background: linear-gradient(135deg, #7c3aed 0%, #a855f7 100%); padding: 80px 0; text-align: center; color: white;">
        <div class="container">
            <div class="cta-content">
                <h2 style="font-size: 2.5rem; font-weight: 700; margin-bottom: 20px;">Ready to Transform Your Shopping Experience?</h2>
                <p style="font-size: 1.2rem; margin-bottom: 30px; opacity: 0.9;">Join thousands of satisfied customers who trust our premium products.</p>
                <a href="<?php echo esc_url(get_theme_mod('cta_btn_url', '/contact')); ?>" class="btn btn-secondary" style="background: white; color: #7c3aed; border: none; padding: 15px 35px; font-weight: 600;">
                    <?php echo esc_html(get_theme_mod('cta_btn_text', 'Get Started Today')); ?>
                </a>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="newsletter-section">
        <div class="container">
            <div class="newsletter-content">
                <h2>Stay Updated</h2>
                <p>Subscribe to our newsletter for the latest products and exclusive offers.</p>
                <form class="newsletter-form">
                    <input type="email" placeholder="Enter your email address" required>
                    <button type="submit" class="btn btn-primary">Subscribe</button>
                </form>
            </div>
        </div>
    </section>

</main>

<?php
get_footer();
?>