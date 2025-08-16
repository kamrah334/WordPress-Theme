<?php
/**
 * Search form template
 *
 * @package Shopora_Premium_Commerce
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <label for="search-field" class="screen-reader-text">
        <?php echo _x('Search for:', 'label', 'shopora-premium-commerce'); ?>
    </label>
    <input type="search" 
           id="search-field" 
           class="search-field" 
           placeholder="<?php echo esc_attr_x('Search products...', 'placeholder', 'shopora-premium-commerce'); ?>" 
           value="<?php echo get_search_query(); ?>" 
           name="s" />
    <button type="submit" class="search-submit">
        <i class="fas fa-search"></i>
        <span class="screen-reader-text"><?php echo _x('Search', 'submit button', 'shopora-premium-commerce'); ?></span>
    </button>
</form>
