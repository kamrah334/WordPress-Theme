<?php get_header(); ?>

<main class="main-content">
    <!-- Hero Section -->
    <?php if (get_theme_mod('hero_enable', true)) : ?>
        <section class="hero-section" style="<?php if (get_theme_mod('hero_background_image')) : ?>background-image: url(<?php echo esc_url(get_theme_mod('hero_background_image')); ?>);<?php endif; ?>">
            <div class="hero-overlay"></div>
            <div class="container">
                <div class="hero-content">
                    <h1 class="hero-title"><?php echo esc_html(get_theme_mod('hero_title', 'Premium Products for Modern Living')); ?></h1>
                    <p class="hero-description"><?php echo esc_html(get_theme_mod('hero_description', 'Discover our curated collection of high-quality products designed to enhance your lifestyle.')); ?></p>
                    <div class="hero-actions">
                        <?php if (class_exists('WooCommerce')) : ?>
                            <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" class="btn btn-primary btn-large">
                                <?php esc_html_e('Shop Now', 'shopora-premium-commerce'); ?>
                            </a>
                        <?php endif; ?>
                        <a href="<?php echo esc_url(get_permalink(get_page_by_path('about'))); ?>" class="btn btn-secondary btn-large">
                            <?php esc_html_e('Learn More', 'shopora-premium-commerce'); ?>
                        </a>
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
                    <h2><?php esc_html_e('Featured Products', 'shopora-premium-commerce'); ?></h2>
                    <p><?php esc_html_e('Discover our most popular items, carefully selected for their quality and innovation', 'shopora-premium-commerce'); ?></p>
                </div>

                <div class="products-grid">
                    <?php
                    $featured_products = wc_get_featured_product_ids();

                    if (!empty($featured_products)) {
                        $featured_query = new WP_Query(array(
                            'post_type' => 'product',
                            'posts_per_page' => 6,
                            'post__in' => $featured_products,
                            'orderby' => 'post__in'
                        ));
                    } else {
                        // Fallback to recent products if no featured products
                        $featured_query = new WP_Query(array(
                            'post_type' => 'product',
                            'posts_per_page' => 6,
                            'meta_query' => array(
                                array(
                                    'key' => '_visibility',
                                    'value' => array('catalog', 'visible'),
                                    'compare' => 'IN'
                                )
                            )
                        ));
                    }

                    if ($featured_query->have_posts()) :
                        while ($featured_query->have_posts()) : $featured_query->the_post();
                            global $product;
                            ?>
                            <div class="product-card fade-in">
                                <div class="product-image-container">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <?php the_post_thumbnail('shopora-product-grid'); ?>
                                        <?php else : ?>
                                            <div class="product-placeholder">
                                                <i class="fas fa-image" style="font-size: 3rem; color: var(--primary-color);"></i>
                                            </div>
                                        <?php endif; ?>
                                    </a>

                                    <?php if ($product->is_on_sale()) : ?>
                                        <span class="onsale"><?php esc_html_e('Sale!', 'shopora-premium-commerce'); ?></span>
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
                                        <?php woocommerce_template_loop_add_to_cart(); ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                    else :
                        // Fallback static products for demo
                        $demo_products = array(
                            array('icon' => 'fas fa-headphones', 'title' => 'Premium Wireless Headphones', 'price' => '$299.00'),
                            array('icon' => 'fas fa-laptop', 'title' => 'Smart Laptop Pro', 'price' => '$1,299.00'),
                            array('icon' => 'fas fa-mobile-alt', 'title' => 'Smartphone Pro Max', 'price' => '$899.00'),
                            array('icon' => 'fas fa-watch', 'title' => 'Smart Watch Elite', 'price' => '$399.00'),
                            array('icon' => 'fas fa-camera', 'title' => 'Digital Camera 4K', 'price' => '$799.00'),
                            array('icon' => 'fas fa-gamepad', 'title' => 'Gaming Controller Pro', 'price' => '$89.00'),
                        );

                        foreach ($demo_products as $demo_product) :
                        ?>
                        <div class="product-card fade-in">
                            <div class="product-image-container">
                                <div class="product-placeholder">
                                    <i class="<?php echo esc_attr($demo_product['icon']); ?>" style="font-size: 3rem; color: var(--primary-color);"></i>
                                </div>
                            </div>
                            <div class="product-info">
                                <h3 class="product-title"><?php echo esc_html($demo_product['title']); ?></h3>
                                <div class="product-price"><?php echo esc_html($demo_product['price']); ?></div>
                                <div class="product-actions">
                                    <?php if (class_exists('WooCommerce')) : ?>
                                        <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" class="btn btn-primary">
                                            <?php esc_html_e('Shop Now', 'shopora-premium-commerce'); ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <div class="section-footer">
                    <?php if (class_exists('WooCommerce')) : ?>
                        <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" class="btn btn-secondary btn-large">
                            <?php esc_html_e('View All Products', 'shopora-premium-commerce'); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- About Section -->
    <section class="about-section">
        <div class="container">
            <div class="about-content">
                <div class="about-text">
                    <h2><?php esc_html_e('About Premium Commerce', 'shopora-premium-commerce'); ?></h2>
                    <p><?php esc_html_e('We are dedicated to providing you with the finest selection of premium products. Our team carefully curates each item to ensure exceptional quality, innovative design, and outstanding value.', 'shopora-premium-commerce'); ?></p>

                    <div class="features-grid">
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-truck"></i>
                            </div>
                            <h4><?php esc_html_e('Free Shipping', 'shopora-premium-commerce'); ?></h4>
                            <p><?php esc_html_e('Free delivery on orders over $100', 'shopora-premium-commerce'); ?></p>
                        </div>

                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <h4><?php esc_html_e('Secure Payment', 'shopora-premium-commerce'); ?></h4>
                            <p><?php esc_html_e('100% secure payment processing', 'shopora-premium-commerce'); ?></p>
                        </div>

                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-undo"></i>
                            </div>
                            <h4><?php esc_html_e('Easy Returns', 'shopora-premium-commerce'); ?></h4>
                            <p><?php esc_html_e('30-day hassle-free returns', 'shopora-premium-commerce'); ?></p>
                        </div>
                    </div>

                    <div class="about-actions">
                        <a href="<?php echo esc_url(get_permalink(get_page_by_path('about'))); ?>" class="btn btn-primary">
                            <?php esc_html_e('Learn More', 'shopora-premium-commerce'); ?>
                        </a>
                    </div>
                </div>

                <div class="about-image">
                    <div class="image-placeholder">
                        <i class="fas fa-store" style="font-size: 8rem; color: var(--primary-color);"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Section -->
    <section class="blog-section">
        <div class="container">
            <div class="section-header">
                <h2><?php esc_html_e('Latest News & Updates', 'shopora-premium-commerce'); ?></h2>
                <p><?php esc_html_e('Stay updated with our latest product releases, company news, and helpful tips', 'shopora-premium-commerce'); ?></p>
            </div>

            <div class="blog-grid">
                <?php
                $blog_query = new WP_Query(array(
                    'post_type' => 'post',
                    'posts_per_page' => 3,
                    'post_status' => 'publish'
                ));

                if ($blog_query->have_posts()) :
                    while ($blog_query->have_posts()) : $blog_query->the_post();
                ?>
                        <article class="blog-card fade-in">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="blog-image">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('shopora-blog-grid'); ?>
                                    </a>
                                </div>
                            <?php endif; ?>

                            <div class="blog-content">
                                <div class="blog-meta">
                                    <span class="blog-date"><?php echo get_the_date(); ?></span>
                                    <span class="blog-category"><?php the_category(', '); ?></span>
                                </div>

                                <h3 class="blog-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>

                                <div class="blog-excerpt">
                                    <?php the_excerpt(); ?>
                                </div>

                                <div class="blog-footer">
                                    <a href="<?php the_permalink(); ?>" class="btn btn-primary">
                                        <?php esc_html_e('Read More', 'shopora-premium-commerce'); ?>
                                    </a>
                                </div>
                            </div>
                        </article>
                <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>

            <div class="section-footer">
                <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="btn btn-secondary btn-large">
                    <?php esc_html_e('View All Posts', 'shopora-premium-commerce'); ?>
                </a>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>