
<?php
/**
 * The Template for displaying product archives, including the main shop page
 *
 * @package Shopora_Premium_Commerce
 */

defined('ABSPATH') || exit;

get_header('shop');
?>

<div class="bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        <?php if (apply_filters('woocommerce_show_page_title', true)) : ?>
            <header class="text-center mb-12">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    <?php woocommerce_page_title(); ?>
                </h1>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    <?php esc_html_e('Discover our premium collection of carefully curated products', 'shopora-premium-commerce'); ?>
                </p>
                <?php do_action('woocommerce_archive_description'); ?>
            </header>
        <?php endif; ?>

        <div class="flex flex-col lg:flex-row gap-8">
            
            <!-- Sidebar -->
            <?php if (shopora_show_sidebar()) : ?>
                <aside class="w-full lg:w-80 xl:w-96 order-2 lg:order-1">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 sticky top-24">
                        <h3 class="text-lg font-semibold text-gray-900 mb-6">
                            <i class="fas fa-filter mr-2"></i>
                            <?php esc_html_e('Filter Products', 'shopora-premium-commerce'); ?>
                        </h3>
                        <?php dynamic_sidebar('shop-sidebar'); ?>
                    </div>
                </aside>
            <?php endif; ?>

            <!-- Main Shop Content -->
            <div class="flex-1 order-1 lg:order-2">
                
                <!-- Shop Toolbar -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 mb-8">
                    <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                        <div class="flex items-center text-sm text-gray-600">
                            <?php woocommerce_result_count(); ?>
                        </div>
                        <div class="flex items-center space-x-4">
                            <label for="orderby" class="text-sm text-gray-600">
                                <?php esc_html_e('Sort by:', 'shopora-premium-commerce'); ?>
                            </label>
                            <?php woocommerce_catalog_ordering(); ?>
                        </div>
                    </div>
                </div>

                <?php
                if (woocommerce_product_loop()) {
                    do_action('woocommerce_before_shop_loop');

                    echo '<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">';

                    if (wc_get_loop_prop('is_shortcode')) {
                        $products = wc_get_loop_prop('products');
                        if ($products && $products->have_posts()) {
                            while ($products->have_posts()) {
                                $products->the_post();
                                do_action('woocommerce_shop_loop');
                                wc_get_template_part('content', 'product');
                            }
                        }
                        wp_reset_postdata();
                    } else {
                        if (have_posts()) {
                            while (have_posts()) {
                                the_post();
                                do_action('woocommerce_shop_loop');
                                wc_get_template_part('content', 'product');
                            }
                        }
                    }

                    echo '</div>';

                    do_action('woocommerce_after_shop_loop');
                } else {
                    do_action('woocommerce_no_products_found');
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php
do_action('woocommerce_after_main_content');
get_footer('shop');
?>
