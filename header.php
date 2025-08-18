
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Header -->
<header class="site-header" id="site-header">
    <div class="container">
        <div class="header-content">
            <?php if (has_custom_logo()) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo">
                    <i class="fas fa-shopping-bag"></i>
                    <?php echo esc_html(get_theme_mod('header_logo_text', get_bloginfo('name'))); ?>
                </a>
            <?php endif; ?>
            
            <nav class="main-navigation" id="main-navigation">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_class' => 'main-menu',
                    'container' => false,
                    'fallback_cb' => 'shopora_fallback_menu',
                ));
                ?>
            </nav>
            
            <div class="header-actions">
                <a href="#" class="search-toggle" id="search-toggle">
                    <i class="fas fa-search"></i>
                </a>
                
                <?php if (class_exists('WooCommerce')) : ?>
                    <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="cart-link">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                    </a>
                <?php endif; ?>
                
                <button class="mobile-menu-toggle" id="mobile-menu-toggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>
        
        <!-- Search Form -->
        <div class="header-search" id="header-search">
            <?php get_search_form(); ?>
        </div>
    </div>
</header>
