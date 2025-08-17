<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * @package Shopora_Premium_Commerce
 */

defined('ABSPATH') || exit;

get_header('shop');

/**
 * Hook: woocommerce_before_main_content.
 */
do_action('woocommerce_before_main_content');
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
                    <?php dynamic_sidebar(shopora_get_sidebar_id()); ?>
                </aside>
            <?php endif; ?>

            <div class="shop-main">
                <?php
                /**
                 * Hook: woocommerce_before_shop_loop.
                 */
                do_action('woocommerce_before_shop_loop');

                woocommerce_product_loop_start();

                if (wc_get_loop_prop('is_paginated')) {
                    $total = wc_get_loop_prop('total');
                    for ($i = 1; $i <= $total; $i++) {
                        /**
                         * Hook: woocommerce_shop_loop.
                         */
                        do_action('woocommerce_shop_loop');

                        wc_get_template_part('content', 'product');
                    }
                }

                woocommerce_product_loop_end();

                /**
                 * Hook: woocommerce_after_shop_loop.
                 */
                do_action('woocommerce_after_shop_loop');
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