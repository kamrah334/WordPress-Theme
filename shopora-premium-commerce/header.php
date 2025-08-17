
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'shopora-premium-commerce'); ?></a>

    <header id="masthead" class="site-header">
        <div class="container">
            <div class="header-content">
                <div class="site-logo">
                    <?php
                    if (has_custom_logo()) {
                        the_custom_logo();
                    } else {
                        ?>
                        <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="40" height="40" rx="8" fill="url(#gradient)"/>
                            <path d="M12 14h16v2H12v-2zm0 4h16v2H12v-2zm0 4h12v2H12v-2z" fill="white"/>
                            <defs>
                                <linearGradient id="gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0%" style="stop-color:#7c3aed"/>
                                    <stop offset="100%" style="stop-color:#a855f7"/>
                                </linearGradient>
                            </defs>
                        </svg>
                        <span class="site-title" style="margin-left: 10px; font-weight: 700; color: #1e293b; font-size: 1.5rem;">
                            <?php bloginfo('name'); ?>
                        </span>
                        <?php
                    }
                    ?>
                </div>

                <nav id="site-navigation" class="main-navigation">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'menu_id'        => 'primary-menu',
                        'fallback_cb'    => 'shopora_default_menu',
                    ));
                    ?>
                </nav>

                <div class="header-actions">
                    <div class="search-toggle">
                        <button type="button" class="search-toggle-btn" aria-expanded="false">
                            <i class="fas fa-search" aria-hidden="true"></i>
                            <span class="screen-reader-text"><?php esc_html_e('Search', 'shopora-premium-commerce'); ?></span>
                        </button>
                    </div>

                    <?php if (class_exists('WooCommerce')) : ?>
                        <div class="cart-icon">
                            <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="cart-link">
                                <i class="fas fa-shopping-cart" aria-hidden="true"></i>
                                <?php if (WC()->cart->get_cart_contents_count() > 0) : ?>
                                    <span class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                                <?php endif; ?>
                                <span class="screen-reader-text"><?php esc_html_e('View cart', 'shopora-premium-commerce'); ?></span>
                            </a>
                        </div>
                    <?php endif; ?>

                    <div class="mobile-menu-toggle">
                        <button type="button" class="mobile-menu-btn" aria-expanded="false">
                            <span class="hamburger"></span>
                            <span class="hamburger"></span>
                            <span class="hamburger"></span>
                            <span class="screen-reader-text"><?php esc_html_e('Menu', 'shopora-premium-commerce'); ?></span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="search-form-container" style="display: none;">
                <div class="container">
                    <?php get_search_form(); ?>
                </div>
            </div>
        </div>
    </header><!-- #masthead -->

    <div id="content" class="site-content">

<?php
/**
 * Default menu fallback
 */
function shopora_default_menu() {
    echo '<ul id="primary-menu" class="menu">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">' . esc_html__('Home', 'shopora-premium-commerce') . '</a></li>';
    
    if (class_exists('WooCommerce')) {
        echo '<li><a href="' . esc_url(wc_get_page_permalink('shop')) . '">' . esc_html__('Shop', 'shopora-premium-commerce') . '</a></li>';
    }
    
    echo '<li><a href="' . esc_url(home_url('/about/')) . '">' . esc_html__('About', 'shopora-premium-commerce') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/contact/')) . '">' . esc_html__('Contact', 'shopora-premium-commerce') . '</a></li>';
    echo '</ul>';
}
?>
