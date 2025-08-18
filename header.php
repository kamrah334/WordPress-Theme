
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php wp_head(); ?>
</head>
<body <?php body_class('antialiased'); ?>>
<?php wp_body_open(); ?>

<a class="skip-link" href="#main"><?php esc_html_e('Skip to content', 'shopora-premium-commerce'); ?></a>

<!-- Header -->
<header class="site-header">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center py-4">
            <!-- Logo -->
            <div class="flex items-center">
                <?php if (has_custom_logo()) : ?>
                    <div class="custom-logo">
                        <?php the_custom_logo(); ?>
                    </div>
                <?php else : ?>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center space-x-2 text-2xl font-bold text-gray-900 hover:text-purple-600 transition-colors">
                        <i class="fas fa-shopping-bag text-purple-600"></i>
                        <span><?php echo esc_html(get_theme_mod('site_title_text', get_bloginfo('name'))); ?></span>
                    </a>
                <?php endif; ?>
            </div>
            
            <!-- Desktop Navigation -->
            <nav class="hidden lg:flex items-center space-x-8">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container' => false,
                    'menu_class' => 'flex items-center space-x-8',
                    'link_before' => '<span class="text-gray-700 hover:text-purple-600 font-medium transition-colors">',
                    'link_after' => '</span>',
                    'fallback_cb' => 'shopora_fallback_menu',
                ));
                ?>
            </nav>
            
            <!-- Header Actions -->
            <div class="flex items-center space-x-4">
                <!-- Search Button -->
                <button id="search-toggle" class="p-2 text-gray-700 hover:text-purple-600 transition-colors">
                    <i class="fas fa-search text-lg"></i>
                </button>
                
                <!-- WooCommerce Cart -->
                <?php if (class_exists('WooCommerce')) : ?>
                    <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="relative p-2 text-gray-700 hover:text-purple-600 transition-colors">
                        <i class="fas fa-shopping-cart text-lg"></i>
                        <?php $cart_count = WC()->cart->get_cart_contents_count(); ?>
                        <?php if ($cart_count > 0) : ?>
                            <span class="absolute -top-1 -right-1 bg-purple-600 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center font-semibold">
                                <?php echo esc_html($cart_count); ?>
                            </span>
                        <?php endif; ?>
                    </a>
                <?php endif; ?>
                
                <!-- Mobile Menu Button -->
                <button id="mobile-menu-toggle" class="lg:hidden p-2 text-gray-700 hover:text-purple-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
        
        <!-- Mobile Navigation -->
        <div id="mobile-menu" class="lg:hidden hidden bg-white border-t border-gray-100 py-4">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container' => false,
                'menu_class' => 'space-y-2',
                'link_before' => '<span class="block px-4 py-2 text-gray-700 hover:bg-purple-50 hover:text-purple-600 transition-colors">',
                'link_after' => '</span>',
                'fallback_cb' => 'shopora_fallback_menu',
            ));
            ?>
        </div>
        
        <!-- Search Form -->
        <div id="search-form" class="hidden bg-white border-t border-gray-100 py-4">
            <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="flex">
                <input type="search" 
                       class="flex-1 px-4 py-2 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent" 
                       placeholder="<?php esc_attr_e('Search...', 'shopora-premium-commerce'); ?>" 
                       value="<?php echo get_search_query(); ?>" 
                       name="s">
                <button type="submit" class="px-6 py-2 bg-purple-600 text-white rounded-r-lg hover:bg-purple-700 transition-colors">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
    </div>
</header>

<main id="main" class="pt-20">
