
<?php
/**
 * The sidebar containing the main widget area
 *
 * @package Shopora_Premium_Commerce
 */

if (!shopora_show_sidebar()) {
    return;
}

$sidebar_id = shopora_get_sidebar_id();
?>

<aside id="secondary" class="widget-area sidebar">
    <?php if ($sidebar_id === 'shop-sidebar') : ?>
        <div class="sidebar-header">
            <h3><i class="fas fa-filter"></i> Filter Products</h3>
        </div>
    <?php endif; ?>
    
    <?php if (is_active_sidebar($sidebar_id)) : ?>
        <?php dynamic_sidebar($sidebar_id); ?>
    <?php else : ?>
        <!-- Default widgets if no widgets are added -->
        <?php if ($sidebar_id === 'shop-sidebar') : ?>
            <section class="widget filter-section">
                <h4><i class="fas fa-search"></i> Search Products</h4>
                <div class="search-section">
                    <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="product-search-form">
                        <div class="search-wrapper">
                            <input type="search" class="search-field" placeholder="Search products..." value="<?php echo get_search_query(); ?>" name="s" />
                            <input type="hidden" name="post_type" value="product" />
                            <button type="submit" class="search-submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </section>
            
            <?php if (class_exists('WooCommerce')) : ?>
                <section class="widget filter-section">
                    <h4><i class="fas fa-tags"></i> Categories</h4>
                    <ul class="category-list">
                        <?php
                        $product_categories = get_terms('product_cat', array(
                            'hide_empty' => true,
                            'number' => 10
                        ));
                        foreach ($product_categories as $category) :
                        ?>
                            <li>
                                <a href="<?php echo esc_url(get_term_link($category)); ?>">
                                    <i class="fas fa-folder"></i>
                                    <?php echo esc_html($category->name); ?>
                                    <span class="count">(<?php echo esc_html($category->count); ?>)</span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </section>
                
                <section class="widget filter-section">
                    <h4><i class="fas fa-dollar-sign"></i> Price Range</h4>
                    <ul class="price-range-list">
                        <li><a href="<?php echo esc_url(add_query_arg(array('min_price' => '0', 'max_price' => '50'), wc_get_page_permalink('shop'))); ?>">Under $50</a></li>
                        <li><a href="<?php echo esc_url(add_query_arg(array('min_price' => '50', 'max_price' => '100'), wc_get_page_permalink('shop'))); ?>">$50 - $100</a></li>
                        <li><a href="<?php echo esc_url(add_query_arg(array('min_price' => '100', 'max_price' => '200'), wc_get_page_permalink('shop'))); ?>">$100 - $200</a></li>
                        <li><a href="<?php echo esc_url(add_query_arg(array('min_price' => '200'), wc_get_page_permalink('shop'))); ?>">Over $200</a></li>
                    </ul>
                </section>
            <?php endif; ?>
        <?php else : ?>
            <section class="widget">
                <h2 class="widget-title">Recent Posts</h2>
                <ul class="recent-posts-list">
                    <?php
                    $recent_posts = wp_get_recent_posts(array('numberposts' => 5));
                    foreach ($recent_posts as $post) :
                    ?>
                        <li><a href="<?php echo get_permalink($post['ID']); ?>"><?php echo esc_html($post['post_title']); ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </section>
            
            <section class="widget">
                <h2 class="widget-title">Categories</h2>
                <ul>
                    <?php wp_list_categories(array('title_li' => '')); ?>
                </ul>
            </section>
        <?php endif; ?>
    <?php endif; ?>
</aside>
