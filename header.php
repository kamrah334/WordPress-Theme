<?php
/**
 * The header for our theme
 *
 * @package Shopora_Premium_Commerce
 */
?>
<!doctype html>
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
    <header id="masthead" class="site-header">
        <div class="container">
            <div class="header-content">
                <div class="site-logo">
                    <?php
                    if (has_custom_logo()) {
                        the_custom_logo();
                    } else {
                        echo '<a href="' . esc_url(home_url('/')) . '">';
                        echo file_get_contents(get_template_directory() . '/assets/images/logo.svg');
                        echo '</a>';
                    }
                    ?>
                </div>

                <nav id="site-navigation" class="main-navigation">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'menu_id'        => 'primary-menu',
                        'fallback_cb'    => function() {
                            echo '<ul>';
                            echo '<li><a href="' . esc_url(home_url('/')) . '">Home</a></li>';
                            echo '<li><a href="' . esc_url(home_url('/shop/')) . '">Products</a></li>';
                            echo '<li><a href="' . esc_url(home_url('/about/')) . '">About</a></li>';
                            echo '<li><a href="' . esc_url(home_url('/contact/')) . '">Contact</a></li>';
                            echo '</ul>';
                        }
                    ));
                    ?>
                </nav>

                <div class="header-actions">
                    <?php if (class_exists('WooCommerce')) : ?>
                        <div class="cart-icon">
                            <a href="<?php echo esc_url(wc_get_cart_url()); ?>">
                                <i class="fas fa-shopping-cart"></i>
                                <span class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                            </a>
                        </div>
                    <?php endif; ?>
                    
                    <div class="search-toggle">
                        <button id="search-toggle" aria-label="Search">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <div id="search-form-container" class="search-form-container" style="display: none;">
                <?php get_search_form(); ?>
            </div>
        </div>
    </header>

    <div id="content" class="site-content">
