
<?php
/**
 * Template for displaying search forms
 *
 * @package Shopora_Premium_Commerce
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <label class="screen-reader-text" for="search-field"><?php echo esc_html__('Search for:', 'shopora-premium-commerce'); ?></label>
    <button type="submit" class="search-submit">
        <i class="fas fa-search" aria-hidden="true"></i>
        <span class="screen-reader-text"><?php echo esc_html__('Search', 'shopora-premium-commerce'); ?></span>
    </button>
    <input type="search" 
           id="search-field" 
           class="search-field" 
           placeholder="<?php echo esc_attr__('Search products, posts...', 'shopora-premium-commerce'); ?>" 
           value="<?php echo get_search_query(); ?>" 
           name="s" 
           required />
</form>
