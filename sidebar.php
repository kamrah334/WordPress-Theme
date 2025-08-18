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

<aside id="secondary" class="sidebar widget-area" role="complementary">
    <div class="sidebar-header">
        <h3><i class="fas fa-filter"></i> <?php esc_html_e('Filter Products', 'shopora-premium-commerce'); ?></h3>
    </div>

    <?php dynamic_sidebar(shopora_get_sidebar_id()); ?>
</aside>
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

<aside id="secondary" class="widget-area sidebar <?php echo esc_attr(shopora_get_sidebar_id()); ?>">
    <div class="sidebar-content">
        <?php dynamic_sidebar(shopora_get_sidebar_id()); ?>
    </div>
</aside><!-- #secondary -->
