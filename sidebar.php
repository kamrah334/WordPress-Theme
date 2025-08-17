<?php
/**
 * The sidebar containing the main widget area
 *
 * @package Shopora_Premium_Commerce
 */

if (!is_active_sidebar('sidebar-1')) {
    return;
}
?>

<aside id="secondary" class="widget-area sidebar">
    <?php if (is_shop() || is_product_category() || is_product_tag()) : ?>
        <!-- Shop Sidebar Header -->
        <div class="sidebar-header">
            <h3><i class="fas fa-filter"></i> Filter Products</h3>
        </div>

        <!-- Search Section -->
        <div class="filter-section search-section">
            <h4><i class="fas fa-search"></i> Search</h4>
            <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
                <div class="search-wrapper">
                    <input type="search" class="search-field" placeholder="Search products..." value="<?php echo get_search_query(); ?>" name="s" />
                    <input type="hidden" name="post_type" value="product" />
                    <button type="submit" class="search-submit"><i class="fas fa-search"></i></button>
                </div>
            </form>
        </div>

        <!-- Categories Section -->
        <div class="filter-section">
            <h4><i class="fas fa-list"></i> Categories</h4>
            <ul class="category-list">
                <li><a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>"><i class="fas fa-th"></i> All Products</a></li>
                <li><a href="#"><i class="fas fa-laptop"></i> Electronics</a></li>
                <li><a href="#"><i class="fas fa-tshirt"></i> Fashion</a></li>
                <li><a href="#"><i class="fas fa-home"></i> Home & Garden</a></li>
                <li><a href="#"><i class="fas fa-running"></i> Sports & Fitness</a></li>
            </ul>
        </div>

        <!-- Price Range Section -->
        <div class="filter-section">
            <h4><i class="fas fa-dollar-sign"></i> Price Range</h4>
            <ul class="price-range-list">
                <li><a href="#"><span class="price-label">Under $50</span></a></li>
                <li><a href="#"><span class="price-label">$50 - $100</span></a></li>
                <li><a href="#"><span class="price-label">$100 - $200</span></a></li>
                <li><a href="#"><span class="price-label">Over $200</span></a></li>
            </ul>
        </div>
    <?php endif; ?>

    <!-- Dynamic Sidebar Widgets -->
    <?php dynamic_sidebar('sidebar-1'); ?>
</aside>
