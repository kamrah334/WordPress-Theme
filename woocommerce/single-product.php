
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

                    <?php
                    // Display related products in horizontal 4-column layout
                    global $product;
                    
                    $related_ids = wc_get_related_products($product->get_id(), 4);
                    
                    if (!empty($related_ids)) :
                        ?>
                        <section class="related-products">
                            <h2><?php esc_html_e('Related Products', 'shopora-premium-commerce'); ?></h2>
                            <ul class="products">
                                <?php
                                foreach ($related_ids as $related_id) :
                                    $related_product = wc_get_product($related_id);
                                    if (!$related_product) continue;
                                    ?>
                                    <li class="product">
                                        <a href="<?php echo esc_url($related_product->get_permalink()); ?>">
                                            <?php echo $related_product->get_image('medium'); ?>
                                            <h3><?php echo esc_html($related_product->get_name()); ?></h3>
                                            <span class="price"><?php echo $related_product->get_price_html(); ?></span>
                                        </a>
                                        <?php
                                        echo apply_filters('woocommerce_loop_add_to_cart_link',
                                            sprintf('<a href="%s" data-quantity="1" class="%s" %s>%s</a>',
                                                esc_url($related_product->add_to_cart_url()),
                                                esc_attr(implode(' ', array_filter(array(
                                                    'button',
                                                    'product_type_' . $related_product->get_type(),
                                                    $related_product->is_purchasable() && $related_product->is_in_stock() ? 'add_to_cart_button' : '',
                                                    $related_product->supports('ajax_add_to_cart') ? 'ajax_add_to_cart' : '',
                                                )))),
                                                wc_implode_html_attributes(array(
                                                    'data-product_id' => $related_product->get_id(),
                                                    'data-product_sku' => $related_product->get_sku(),
                                                    'aria-label' => $related_product->add_to_cart_description(),
                                                    'rel' => 'nofollow',
                                                )),
                                                esc_html($related_product->add_to_cart_text())
                                            ),
                                        $related_product);
                                        ?>
                                    </li>
                                    <?php
                                endforeach;
                                ?>
                            </ul>
                        </section>
                        <?php
                    endif;
                    ?>

                <?php endwhile; ?>
            </div>
        </div>
    </div>
</div>

<?php
get_footer('shop');
?>
