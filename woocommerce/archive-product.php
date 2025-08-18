
<?php
/**
 * The Template for displaying product archives, including the main shop page
 *
 * @package Shopora_Premium_Commerce
 */

defined('ABSPATH') || exit;

get_header('shop');
?>

<div class="shop-container">
    <div class="container">
        <?php if (apply_filters('woocommerce_show_page_title', true)) : ?>
            <header class="woocommerce-products-header">
                <h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
                <?php
                /**
                 * Hook: woocommerce_archive_description.
                 */
                do_action('woocommerce_archive_description');
                ?>
                <p><?php esc_html_e('Discover our premium collection of carefully curated products', 'shopora-premium-commerce'); ?></p>
            </header>
        <?php endif; ?>

        <div class="shop-layout <?php echo shopora_show_sidebar() ? 'has-sidebar' : 'no-sidebar'; ?>">
            <?php if (shopora_show_sidebar()) : ?>
                <aside class="shop-sidebar">
                    <?php dynamic_sidebar('shop-sidebar'); ?>
                </aside>
            <?php endif; ?>

            <div class="shop-main">
                <?php
                /**
                 * Hook: woocommerce_before_shop_loop.
                 */
                do_action('woocommerce_before_shop_loop');

                if (woocommerce_product_loop()) {
                    /**
                     * Hook: woocommerce_before_shop_loop_start.
                     */
                    do_action('woocommerce_before_shop_loop_start');

                    woocommerce_product_loop_start();

                    if (wc_get_loop_prop('is_shortcode')) {
                        // Handle shortcode loop
                        $shortcode_query = wc_get_loop_prop('shortcode_query');
                        if ($shortcode_query->have_posts()) {
                            while ($shortcode_query->have_posts()) {
                                $shortcode_query->the_post();
                                /**
                                 * Hook: woocommerce_shop_loop.
                                 */
                                do_action('woocommerce_shop_loop');
                                wc_get_template_part('content', 'product');
                            }
                        }
                    } else {
                        // Handle normal product archive
                        if (have_posts()) {
                            while (have_posts()) {
                                the_post();
                                /**
                                 * Hook: woocommerce_shop_loop.
                                 */
                                do_action('woocommerce_shop_loop');
                                wc_get_template_part('content', 'product');
                            }
                        }
                    }

                    woocommerce_product_loop_end();

                    /**
                     * Hook: woocommerce_after_shop_loop.
                     */
                    do_action('woocommerce_after_shop_loop');
                } else {
                    /**
                     * Hook: woocommerce_no_products_found.
                     */
                    do_action('woocommerce_no_products_found');
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php
/**
 * Hook: woocommerce_after_main_content.
 */
do_action('woocommerce_after_main_content');

get_footer('shop');
?>
