
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
<div <?php wc_product_class('product-card bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition-all duration-300 group', $product); ?>>
    
    <!-- Product Image -->
    <div class="relative aspect-square overflow-hidden bg-gray-50">
        <?php
        /**
         * Hook: woocommerce_before_shop_loop_item.
         */
        do_action('woocommerce_before_shop_loop_item');
        ?>
        
        <a href="<?php the_permalink(); ?>" class="block w-full h-full">
            <?php
            /**
             * Hook: woocommerce_before_shop_loop_item_title.
             */
            do_action('woocommerce_before_shop_loop_item_title');
            ?>
            
            <?php if ($product->get_image_id()) : ?>
                <?php echo woocommerce_get_product_thumbnail('shopora-product-grid', array('class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-300')); ?>
            <?php else : ?>
                <div class="w-full h-full flex items-center justify-center bg-gray-100">
                    <i class="fas fa-image text-4xl text-gray-400"></i>
                </div>
            <?php endif; ?>
        </a>

        <!-- Sale Badge -->
        <?php if ($product->is_on_sale()) : ?>
            <div class="absolute top-3 left-3">
                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-500 text-white">
                    <?php esc_html_e('Sale', 'shopora-premium-commerce'); ?>
                </span>
            </div>
        <?php endif; ?>

        <!-- Quick Actions -->
        <div class="absolute top-3 right-3 flex flex-col space-y-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
            
            <!-- Wishlist Button (if plugin available) -->
            <?php if (function_exists('yith_wcwl_add_to_wishlist')) : ?>
                <button class="w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-sm hover:bg-purple-50 hover:text-purple-600 transition-colors">
                    <i class="fas fa-heart text-sm"></i>
                </button>
            <?php endif; ?>
            
            <!-- Quick View Button -->
            <button class="w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-sm hover:bg-purple-50 hover:text-purple-600 transition-colors">
                <i class="fas fa-eye text-sm"></i>
            </button>
        </div>
    </div>

    <!-- Product Info -->
    <div class="p-4">
        
        <!-- Product Category -->
        <?php
        $categories = wp_get_post_terms($product->get_id(), 'product_cat');
        if (!empty($categories)) :
        ?>
            <div class="mb-2">
                <span class="text-xs text-gray-500 font-medium uppercase tracking-wider">
                    <?php echo esc_html($categories[0]->name); ?>
                </span>
            </div>
        <?php endif; ?>

        <!-- Product Title -->
        <h3 class="text-sm font-semibold text-gray-900 mb-2 line-clamp-2 group-hover:text-purple-600 transition-colors">
            <a href="<?php the_permalink(); ?>">
                <?php
                /**
                 * Hook: woocommerce_shop_loop_item_title.
                 */
                do_action('woocommerce_shop_loop_item_title');
                ?>
            </a>
        </h3>

        <!-- Product Rating -->
        <?php if ($rating_html = wc_get_rating_html($product->get_average_rating())) : ?>
            <div class="flex items-center mb-2">
                <div class="flex items-center text-yellow-400 text-sm">
                    <?php echo $rating_html; ?>
                </div>
                <span class="text-xs text-gray-500 ml-2">
                    (<?php echo esc_html($product->get_review_count()); ?>)
                </span>
            </div>
        <?php endif; ?>

        <!-- Product Price -->
        <div class="mb-3">
            <?php
            /**
             * Hook: woocommerce_after_shop_loop_item_title.
             */
            do_action('woocommerce_after_shop_loop_item_title');
            ?>
        </div>

        <!-- Add to Cart Button -->
        <div class="mt-auto">
            <?php
            /**
             * Hook: woocommerce_after_shop_loop_item.
             */
            do_action('woocommerce_after_shop_loop_item');
            ?>
        </div>
    </div>
</div>
