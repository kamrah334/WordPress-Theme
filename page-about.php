
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


<?php get_header(); ?>

<div class="bg-gray-50 min-h-screen pt-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Hero Section -->
        <section class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-3xl p-12 mb-12">
            <div class="text-center">
                <h1 class="text-5xl font-bold mb-6">About Shopora</h1>
                <p class="text-xl text-purple-100 max-w-3xl mx-auto">
                    We're passionate about bringing you the finest products with exceptional quality and service that exceeds expectations.
                </p>
            </div>
        </section>

        <!-- Story Section -->
        <section class="py-16">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-4xl font-bold text-gray-900 mb-6">Our Story</h2>
                    <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                        Founded with a vision to revolutionize online shopping, Shopora has grown from a small startup 
                        to a trusted e-commerce destination. We believe in the power of quality products and exceptional 
                        customer service.
                    </p>
                    <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                        Our team is dedicated to curating the best products from around the world, ensuring that every 
                        purchase you make is backed by our commitment to excellence.
                    </p>
                    <div class="flex space-x-4">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-purple-600">10k+</div>
                            <div class="text-gray-500">Happy Customers</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-purple-600">1000+</div>
                            <div class="text-gray-500">Products</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-purple-600">5★</div>
                            <div class="text-gray-500">Rating</div>
                        </div>
                    </div>
                </div>
                <div>
                    <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=600&h=400&fit=crop" 
                         alt="Our Team" 
                         class="rounded-2xl shadow-2xl">
                </div>
            </div>
        </section>

        <!-- Values Section -->
        <section class="py-16 bg-white rounded-3xl shadow-lg">
            <div class="max-w-6xl mx-auto px-8">
                <h2 class="text-4xl font-bold text-gray-900 text-center mb-12">Our Values</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="text-center">
                        <div class="w-20 h-20 bg-gradient-to-r from-blue-400 to-purple-500 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-heart text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Customer First</h3>
                        <p class="text-gray-600">Everything we do is centered around providing the best possible experience for our customers.</p>
                    </div>
                    <div class="text-center">
                        <div class="w-20 h-20 bg-gradient-to-r from-green-400 to-blue-500 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-leaf text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Sustainability</h3>
                        <p class="text-gray-600">We're committed to sustainable practices and environmentally friendly products.</p>
                    </div>
                    <div class="text-center">
                        <div class="w-20 h-20 bg-gradient-to-r from-purple-400 to-pink-500 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-star text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Excellence</h3>
                        <p class="text-gray-600">We strive for excellence in every product we offer and every service we provide.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Team Section -->
        <section class="py-16">
            <h2 class="text-4xl font-bold text-gray-900 text-center mb-12">Meet Our Team</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <?php
                $team_members = [
                    ['name' => 'Sarah Johnson', 'role' => 'CEO & Founder', 'image' => 'https://images.unsplash.com/photo-1494790108755-2616b612b17c?w=300&h=300&fit=crop'],
                    ['name' => 'Michael Chen', 'role' => 'CTO', 'image' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=300&h=300&fit=crop'],
                    ['name' => 'Emily Davis', 'role' => 'Head of Marketing', 'image' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=300&h=300&fit=crop'],
                    ['name' => 'David Wilson', 'role' => 'Head of Operations', 'image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=300&h=300&fit=crop']
                ];
                
                foreach ($team_members as $member) :
                ?>
                <div class="bg-white rounded-2xl shadow-lg p-6 text-center hover:shadow-xl transition-shadow">
                    <img src="<?php echo esc_url($member['image']); ?>" 
                         alt="<?php echo esc_attr($member['name']); ?>" 
                         class="w-24 h-24 rounded-full mx-auto mb-4 object-cover">
                    <h3 class="text-xl font-bold text-gray-900 mb-2"><?php echo esc_html($member['name']); ?></h3>
                    <p class="text-purple-600 font-semibold"><?php echo esc_html($member['role']); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
    </div>
</div>

<?php get_footer(); ?>
