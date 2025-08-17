
<?php
/**
 * The sidebar containing the main widget area
 *
 * @package Shopora_Premium_Commerce
 */

if (!is_active_sidebar(shopora_get_sidebar_id())) {
    return;
}
?>

<aside id="secondary" class="widget-area sidebar">
    <div class="sidebar-inner">
        <?php
        $sidebar_id = shopora_get_sidebar_id();
        
        // If shop sidebar is empty, add default widgets
        if ($sidebar_id === 'shop-sidebar' && !is_active_sidebar('shop-sidebar')) {
            ?>
            <section class="widget filter-section search-section">
                <h4 class="widget-title"><?php esc_html_e('Search Products', 'shopora-premium-commerce'); ?></h4>
                <div class="search-wrapper">
                    <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="product-search-form">
                        <div class="search-input-wrapper">
                            <input type="search" 
                                   class="search-field" 
                                   placeholder="<?php echo esc_attr_x('Search products...', 'placeholder', 'shopora-premium-commerce'); ?>" 
                                   value="<?php echo get_search_query(); ?>" 
                                   name="s" 
                                   autocomplete="off" />
                            <input type="hidden" name="post_type" value="product" />
                            <button type="submit" class="search-submit" aria-label="<?php esc_attr_e('Search', 'shopora-premium-commerce'); ?>">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </section>
            
            <?php
            // Add product categories if WooCommerce is active
            if (class_exists('WooCommerce')) {
                $product_categories = get_terms(array(
                    'taxonomy' => 'product_cat',
                    'hide_empty' => true,
                    'number' => 10,
                ));
                
                if (!empty($product_categories) && !is_wp_error($product_categories)) {
                    ?>
                    <section class="widget filter-section categories-section">
                        <h4 class="widget-title"><?php esc_html_e('Product Categories', 'shopora-premium-commerce'); ?></h4>
                        <ul class="product-categories">
                            <?php foreach ($product_categories as $category) : ?>
                                <li>
                                    <a href="<?php echo esc_url(get_term_link($category)); ?>" class="category-link">
                                        <?php echo esc_html($category->name); ?>
                                        <span class="product-count">(<?php echo esc_html($category->count); ?>)</span>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </section>
                    <?php
                }
            }
        } else {
            dynamic_sidebar($sidebar_id);
        }
        ?>
    </div>
</aside>
