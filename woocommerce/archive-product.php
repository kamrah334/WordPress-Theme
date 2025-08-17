<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * @package Shopora_Premium_Commerce
 */

defined('ABSPATH') || exit;

get_header('shop');

?>
<div class="shop-container">
    <div class="container">
        
        <header class="woocommerce-products-header">
            <?php if (apply_filters('woocommerce_show_page_title', true)) : ?>
                <h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
                <p>Discover our premium collection of carefully curated products</p>
            <?php endif; ?>

            <?php
            /**
             * Hook: woocommerce_archive_description.
             *
             * @hooked woocommerce_taxonomy_archive_description - 10
             * @hooked woocommerce_product_archive_description - 10
             */
            do_action('woocommerce_archive_description');
            ?>
        </header>

        <div class="shop-content">
            <div class="shop-sidebar">
                <div class="sidebar-header">
                    <h3><i class="fas fa-filter"></i> Filter Products</h3>
                </div>
                
                <!-- Search Bar Section -->
                <div class="filter-section search-section">
                    <h4><i class="fas fa-search"></i> Search Products</h4>
                    <form role="search" method="get" class="woocommerce-product-search" action="<?php echo esc_url(home_url('/')); ?>">
                        <div class="search-wrapper">
                            <input type="search" class="search-field" placeholder="Search products..." value="<?php echo get_search_query(); ?>" name="s" />
                            <input type="hidden" name="post_type" value="product" />
                            <button type="submit" class="search-submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
                
                <!-- Categories Section -->
                <div class="filter-section">
                    <h4><i class="fas fa-tags"></i> Categories</h4>
                    <ul class="category-list">
                        <li><a href="#" data-category="electronics"><i class="fas fa-laptop"></i> Electronics</a></li>
                        <li><a href="#" data-category="fashion"><i class="fas fa-tshirt"></i> Fashion</a></li>
                        <li><a href="#" data-category="home-garden"><i class="fas fa-home"></i> Home & Garden</a></li>
                        <li><a href="#" data-category="sports-fitness"><i class="fas fa-dumbbell"></i> Sports & Fitness</a></li>
                    </ul>
                </div>
                
                <!-- Price Range Section -->
                <div class="filter-section">
                    <h4><i class="fas fa-dollar-sign"></i> Price Range</h4>
                    <ul class="price-range-list">
                        <li><a href="#" data-price="0-50"><span class="price-label">Under $50</span></a></li>
                        <li><a href="#" data-price="50-100"><span class="price-label">$50 - $100</span></a></li>
                        <li><a href="#" data-price="100-200"><span class="price-label">$100 - $200</span></a></li>
                        <li><a href="#" data-price="200+"><span class="price-label">Over $200</span></a></li>
                    </ul>
                </div>
                
                <!-- Recent Posts Section -->
                <div class="filter-section">
                    <h4><i class="fas fa-newspaper"></i> Recent Posts</h4>
                    <ul class="recent-posts-list">
                        <?php
                        $recent_posts = wp_get_recent_posts(array(
                            'numberposts' => 5,
                            'post_status' => 'publish'
                        ));
                        
                        if (!empty($recent_posts)) {
                            foreach ($recent_posts as $post) {
                                echo '<li><a href="' . get_permalink($post['ID']) . '">' . esc_html($post['post_title']) . '</a></li>';
                            }
                        } else {
                            echo '<li>No recent posts found</li>';
                        }
                        wp_reset_query();
                        ?>
                    </ul>
                </div>
                
                <!-- Recent Comments Section -->
                <div class="filter-section">
                    <h4><i class="fas fa-comments"></i> Recent Comments</h4>
                    <ul class="recent-comments-list">
                        <?php
                        $recent_comments = get_comments(array(
                            'number' => 5,
                            'status' => 'approve'
                        ));
                        
                        if (!empty($recent_comments)) {
                            foreach ($recent_comments as $comment) {
                                echo '<li><a href="' . get_comment_link($comment) . '">' . esc_html($comment->comment_author) . ' on ' . get_the_title($comment->comment_post_ID) . '</a></li>';
                            }
                        } else {
                            echo '<li>No recent comments</li>';
                        }
                        ?>
                    </ul>
                </div>
                
                <!-- Archives Section -->
                <div class="filter-section">
                    <h4><i class="fas fa-archive"></i> Archives</h4>
                    <ul class="archives-list">
                        <?php wp_get_archives(array('type' => 'monthly', 'limit' => 6)); ?>
                    </ul>
                </div>
                
                <?php
                /**
                 * Hook: woocommerce_sidebar.
                 *
                 * @hooked woocommerce_get_sidebar - 10
                 */
                do_action('woocommerce_sidebar');
                ?>
            </div>

            <div class="shop-main">
                <div class="shop-toolbar">
                    <?php
                    /**
                     * Hook: woocommerce_before_shop_loop.
                     *
                     * @hooked woocommerce_output_all_notices - 10
                     * @hooked woocommerce_result_count - 20
                     * @hooked woocommerce_catalog_ordering - 30
                     */
                    do_action('woocommerce_before_shop_loop');
                    ?>
                </div>

                <?php
                if (woocommerce_product_loop()) {
                    echo '<div class="products-grid-container">';
                    woocommerce_product_loop_start();

                    while (have_posts()) {
                        the_post();

                        /**
                         * Hook: woocommerce_shop_loop.
                         */
                        do_action('woocommerce_shop_loop');

                        wc_get_template_part('content', 'product');
                    }

                    woocommerce_product_loop_end();
                    echo '</div>';

                    /**
                     * Hook: woocommerce_after_shop_loop.
                     *
                     * @hooked woocommerce_pagination - 10
                     */
                    do_action('woocommerce_after_shop_loop');
                } else {
                    echo '<div class="no-products-found">';
                    echo '<div class="no-products-icon"><i class="fas fa-search"></i></div>';
                    echo '<h3>No products found</h3>';
                    echo '<p>Sorry, no products match your search criteria. Try adjusting your filters or search terms.</p>';
                    echo '<a href="' . esc_url(wc_get_page_permalink('shop')) . '" class="btn btn-primary">View All Products</a>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php
get_footer('shop');
?>
