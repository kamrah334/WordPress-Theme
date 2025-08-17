<?php
/**
 * The Template for displaying all single products
 *
 * @package Shopora_Premium_Commerce
 */

defined('ABSPATH') || exit;

get_header('shop'); ?>

<div class="single-product-container">
    <div class="container">
        <div class="shop-layout <?php echo shopora_show_sidebar() ? 'has-sidebar' : 'no-sidebar'; ?>">
            <?php if (shopora_show_sidebar()) : ?>
                <aside class="shop-sidebar">
                    <?php dynamic_sidebar(shopora_get_sidebar_id()); ?>
                </aside>
            <?php endif; ?>

            <div class="shop-main">
                <?php while (have_posts()) : ?>
                    <?php the_post(); ?>

                    <div id="product-<?php the_ID(); ?>" <?php wc_product_class('', $product); ?>>
                        <?php
                        /**
                         * Hook: woocommerce_before_single_product_summary.
                         */
                        do_action('woocommerce_before_single_product_summary');
                        ?>

                        <div class="summary entry-summary">
                            <?php
                            /**
                             * Hook: woocommerce_single_product_summary.
                             */
                            do_action('woocommerce_single_product_summary');
                            ?>
                        </div>

                        <?php
                        /**
                         * Hook: woocommerce_after_single_product_summary.
                         */
                        do_action('woocommerce_after_single_product_summary');
                        ?>
                    </div>

                <?php endwhile; ?>
            </div>
        </div>
    </div>
</div>

<?php
get_footer('shop');
?>