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
                <?php
                /**
                 * Hook: woocommerce_sidebar.
                 *
                 * @hooked woocommerce_get_sidebar - 10
                 */
                do_action('woocommerce_sidebar');
                
                // Add custom filter sections if sidebar is empty
                if (!is_active_sidebar('shop-sidebar')) : ?>
                    <div class="filter-section">
                        <h4>Categories</h4>
                        <ul>
                            <li><a href="#">Electronics</a></li>
                            <li><a href="#">Fashion</a></li>
                            <li><a href="#">Home & Garden</a></li>
                            <li><a href="#">Sports & Fitness</a></li>
                        </ul>
                    </div>
                    
                    <div class="filter-section">
                        <h4>Price Range</h4>
                        <ul>
                            <li><a href="#">Under $50</a></li>
                            <li><a href="#">$50 - $100</a></li>
                            <li><a href="#">$100 - $200</a></li>
                            <li><a href="#">Over $200</a></li>
                        </ul>
                    </div>
                <?php endif; ?>
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
