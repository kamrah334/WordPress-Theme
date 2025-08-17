
<?php
/**
 * Template Name: About Page with Blog Posts
 * The template for displaying the About page with latest blog posts
 *
 * @package Shopora_Premium_Commerce
 */

get_header();
?>

<main id="primary" class="site-main about-page">
    <div class="container">
        
        <!-- About Section -->
        <section class="about-hero">
            <div class="about-content">
                <div class="about-text">
                    <h1>About Premium Commerce</h1>
                    <p class="about-intro">We are dedicated to bringing you the finest selection of premium products that combine quality, innovation, and style. Our team carefully curates each item to ensure it meets our high standards.</p>
                    <p>With years of experience in the industry, we understand what our customers value most: exceptional quality, reliable service, and competitive prices.</p>
                    
                    <div class="about-features">
                        <div class="feature-grid">
                            <div class="feature-item">
                                <i class="fas fa-gem"></i>
                                <h3>Premium Quality</h3>
                                <p>Only the finest products make it to our collection</p>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-shipping-fast"></i>
                                <h3>Fast Shipping</h3>
                                <p>Quick and reliable delivery to your doorstep</p>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-shield-alt"></i>
                                <h3>30-Day Guarantee</h3>
                                <p>Money-back guarantee on all purchases</p>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-headset"></i>
                                <h3>24/7 Support</h3>
                                <p>Always here to help when you need us</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="about-image">
                    <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=600&h=400&fit=crop&crop=center" alt="Our team at work" />
                </div>
            </div>
        </section>

        <!-- Latest Blog Posts Section -->
        <section class="latest-blog-posts">
            <div class="section-header">
                <h2>Latest Updates & News</h2>
                <p>Stay updated with our latest news, product launches, and industry insights</p>
            </div>
            
            <div class="blog-posts-grid">
                <?php
                $recent_posts = new WP_Query(array(
                    'posts_per_page' => 6,
                    'post_status' => 'publish',
                    'orderby' => 'date',
                    'order' => 'DESC'
                ));

                if ($recent_posts->have_posts()) :
                    while ($recent_posts->have_posts()) : $recent_posts->the_post();
                ?>
                        <article class="blog-post-card">
                            <div class="post-thumbnail">
                                <?php if (has_post_thumbnail()) : ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('medium', array('class' => 'post-image')); ?>
                                    </a>
                                <?php else : ?>
                                    <div class="post-placeholder">
                                        <i class="fas fa-newspaper"></i>
                                    </div>
                                <?php endif; ?>
                            </div>
                            
                            <div class="post-content">
                                <div class="post-meta">
                                    <span class="post-date">
                                        <i class="fas fa-calendar-alt"></i>
                                        <?php echo get_the_date(); ?>
                                    </span>
                                    <span class="post-author">
                                        <i class="fas fa-user"></i>
                                        <?php the_author(); ?>
                                    </span>
                                </div>
                                
                                <h3 class="post-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>
                                
                                <p class="post-excerpt">
                                    <?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?>
                                </p>
                                
                                <a href="<?php the_permalink(); ?>" class="read-more-btn">
                                    Read More <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </article>
                <?php 
                    endwhile;
                    wp_reset_postdata();
                else :
                ?>
                    <!-- Fallback content if no posts exist -->
                    <div class="no-posts-message">
                        <div class="no-posts-icon">
                            <i class="fas fa-newspaper"></i>
                        </div>
                        <h3>Coming Soon</h3>
                        <p>We're working on exciting content for you. Check back soon for the latest updates and news!</p>
                    </div>
                <?php endif; ?>
            </div>
            
            <?php if ($recent_posts->have_posts() && $recent_posts->found_posts > 6) : ?>
                <div class="view-all-posts">
                    <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" class="btn btn-primary">
                        View All Posts
                    </a>
                </div>
            <?php endif; ?>
        </section>

        <!-- Call to Action Section -->
        <section class="about-cta">
            <div class="cta-content">
                <h2>Ready to Experience Premium Quality?</h2>
                <p>Join thousands of satisfied customers who trust us for their premium product needs.</p>
                <div class="cta-buttons">
                    <a href="<?php echo esc_url(home_url('/shop/')); ?>" class="btn btn-primary">
                        <i class="fas fa-shopping-bag"></i>
                        Shop Now
                    </a>
                    <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-secondary">
                        <i class="fas fa-envelope"></i>
                        Contact Us
                    </a>
                </div>
            </div>
        </section>

    </div>
</main>

<?php
get_footer();
?>


