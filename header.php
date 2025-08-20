
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
</head>
<body <?php body_class('antialiased font-sans'); ?>>
<?php wp_body_open(); ?>

<a class="skip-link sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 bg-purple-600 text-white px-4 py-2 rounded-lg z-50" href="#main">
    <?php esc_html_e('Skip to content', 'shopora-premium-commerce'); ?>
</a>

<!-- Header -->
<header class="site-header fixed top-0 w-full z-50 bg-white/95 backdrop-blur-md border-b border-gray-100 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <!-- Logo -->
            <div class="flex items-center flex-shrink-0">
                <?php if (has_custom_logo()) : ?>
                    <div class="custom-logo">
                        <?php the_custom_logo(); ?>
                    </div>
                <?php else : ?>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center space-x-3 text-2xl font-bold text-gray-900 hover:text-purple-600 transition-colors">
                        <div class="w-10 h-10 bg-gradient-to-r from-purple-600 to-indigo-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-shopping-bag text-white text-lg"></i>
                        </div>
                        <span class="hidden sm:block"><?php echo esc_html(get_theme_mod('site_title_text', get_bloginfo('name'))); ?></span>
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
                    'link_before' => '<span class="relative text-gray-700 hover:text-purple-600 font-medium transition-colors py-2 px-1 group">',
                    'link_after' => '<span class="absolute bottom-0 left-0 w-0 h-0.5 bg-purple-600 transition-all duration-300 group-hover:w-full"></span></span>',
                    'fallback_cb' => 'shopora_fallback_menu',
                ));
                ?>
            </nav>
            
            <!-- Header Actions -->
            <div class="flex items-center space-x-4">
                <!-- Search Button -->
                <button id="search-toggle" class="p-2 text-gray-700 hover:text-purple-600 hover:bg-purple-50 rounded-lg transition-all">
                    <i class="fas fa-search text-lg"></i>
                </button>
                
                <!-- User Account -->
                <button class="hidden sm:flex p-2 text-gray-700 hover:text-purple-600 hover:bg-purple-50 rounded-lg transition-all">
                    <i class="fas fa-user text-lg"></i>
                </button>
                
                <!-- Wishlist -->
                <button class="hidden sm:flex p-2 text-gray-700 hover:text-purple-600 hover:bg-purple-50 rounded-lg transition-all relative">
                    <i class="fas fa-heart text-lg"></i>
                    <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center font-semibold">3</span>
                </button>
                
                <!-- WooCommerce Cart -->
                <?php if (class_exists('WooCommerce')) : ?>
                    <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="relative p-2 text-gray-700 hover:text-purple-600 hover:bg-purple-50 rounded-lg transition-all group">
                        <i class="fas fa-shopping-cart text-lg"></i>
                        <?php $cart_count = WC()->cart->get_cart_contents_count(); ?>
                        <?php if ($cart_count > 0) : ?>
                            <span class="absolute -top-1 -right-1 bg-purple-600 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center font-semibold animate-pulse">
                                <?php echo esc_html($cart_count); ?>
                            </span>
                        <?php endif; ?>
                        
                        <!-- Mini Cart Dropdown -->
                        <div class="absolute right-0 top-full mt-2 w-80 bg-white rounded-2xl shadow-2xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
                            <div class="p-6">
                                <h3 class="font-semibold text-gray-900 mb-4">Shopping Cart</h3>
                                <!-- Mini cart items would go here -->
                                <div class="text-center py-8 text-gray-500">
                                    <i class="fas fa-shopping-cart text-3xl mb-4"></i>
                                    <p>Your cart is empty</p>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php endif; ?>
                
                <!-- Mobile Menu Button -->
                <button id="mobile-menu-toggle" class="lg:hidden p-2 text-gray-700 hover:text-purple-600 hover:bg-purple-50 rounded-lg transition-all">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
        
        <!-- Mobile Navigation -->
        <div id="mobile-menu" class="lg:hidden hidden bg-white border-t border-gray-100 shadow-lg">
            <div class="py-6 space-y-4">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container' => false,
                    'menu_class' => 'space-y-1',
                    'link_before' => '<span class="block px-4 py-3 text-gray-700 hover:bg-purple-50 hover:text-purple-600 transition-colors rounded-lg mx-4">',
                    'link_after' => '</span>',
                    'fallback_cb' => 'shopora_fallback_menu',
                ));
                ?>
                
                <!-- Mobile User Actions -->
                <div class="border-t border-gray-100 pt-4 px-4 space-y-2">
                    <a href="#" class="flex items-center space-x-3 text-gray-700 hover:text-purple-600 py-2">
                        <i class="fas fa-user"></i>
                        <span>My Account</span>
                    </a>
                    <a href="#" class="flex items-center space-x-3 text-gray-700 hover:text-purple-600 py-2">
                        <i class="fas fa-heart"></i>
                        <span>Wishlist</span>
                        <span class="ml-auto bg-red-100 text-red-600 text-xs px-2 py-1 rounded-full">3</span>
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Search Overlay -->
        <div id="search-overlay" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50">
            <div class="bg-white p-6 max-w-2xl mx-auto mt-20 rounded-2xl shadow-2xl">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-semibold text-gray-900">Search Products</h3>
                    <button id="close-search" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="relative">
                    <input type="search" 
                           class="w-full px-6 py-4 text-lg border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent pr-12" 
                           placeholder="<?php esc_attr_e('Search for products...', 'shopora-premium-commerce'); ?>" 
                           value="<?php echo get_search_query(); ?>" 
                           name="s">
                    <button type="submit" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-purple-600">
                        <i class="fas fa-search text-xl"></i>
                    </button>
                </form>
                
                <!-- Quick Search Results -->
                <div class="mt-6">
                    <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-3">Popular Searches</h4>
                    <div class="flex flex-wrap gap-2">
                        <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm hover:bg-purple-100 hover:text-purple-700 cursor-pointer transition-colors">Headphones</span>
                        <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm hover:bg-purple-100 hover:text-purple-700 cursor-pointer transition-colors">Laptops</span>
                        <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm hover:bg-purple-100 hover:text-purple-700 cursor-pointer transition-colors">Smart Watch</span>
                        <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm hover:bg-purple-100 hover:text-purple-700 cursor-pointer transition-colors">Gaming</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<main id="main" class="pt-20">
