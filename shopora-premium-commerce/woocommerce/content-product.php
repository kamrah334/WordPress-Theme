
<?php
/**
 * The template for displaying product content within loops
 *
 * @package Shopora_Premium_Commerce
 */

defined('ABSPATH') || exit;

global $product;

// Ensure visibility.
if (empty($product) || !$product->is_visible()) {
    return;
}
?>
<li <?php wc_product_class('product-card-item', $product); ?>>
    <div class="product-card-inner">
        <?php
        /**
         * Hook: woocommerce_before_shop_loop_item.
         */
        do_action('woocommerce_before_shop_loop_item');
        ?>
        
        <div class="product-image-wrapper">
            <?php
            /**
             * Hook: woocommerce_before_shop_loop_item_title.
             */
            do_action('woocommerce_before_shop_loop_item_title');
            ?>
        </div>
        
        <div class="product-details">
            <?php
            /**
             * Hook: woocommerce_shop_loop_item_title.
             */
            do_action('woocommerce_shop_loop_item_title');
            
            /**
             * Hook: woocommerce_after_shop_loop_item_title.
             */
            do_action('woocommerce_after_shop_loop_item_title');
            ?>
        </div>
        
        <div class="product-actions">
            <?php
            /**
             * Hook: woocommerce_after_shop_loop_item.
             */
            do_action('woocommerce_after_shop_loop_item');
            ?>
        </div>
    </div>
</li>
