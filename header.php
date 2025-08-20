<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <?php wp_head(); ?>
</head>
<body <?php body_class('antialiased font-sans bg-white'); ?>>
<?php wp_body_open(); ?>

<a class="skip-link sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 bg-purple-600 text-white px-4 py-2 rounded-lg z-50" href="#main">
    <?php esc_html_e('Skip to content', 'shopora-premium-commerce'); ?>
</a>

<div id="page" class="site">
    <header id="masthead" class="site-header bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <?php if (has_custom_logo()) : ?>
                        <?php the_custom_logo(); ?>
                    <?php else : ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="text-2xl font-bold text-purple-600">
                            <?php bloginfo('name'); ?>
                        </a>
                    <?php endif; ?>
                </div>

                <!-- Desktop Navigation -->
                <nav class="hidden md:flex items-center space-x-8">
                    <a href="/" class="text-gray-700 hover:text-purple-600 font-medium transition-colors">Home</a>
                    <a href="/shop" class="text-gray-700 hover:text-purple-600 font-medium transition-colors">Shop</a>
                    <a href="/product" class="text-gray-700 hover:text-purple-600 font-medium transition-colors">Products</a>
                    <a href="/page-about.php" class="text-gray-700 hover:text-purple-600 font-medium transition-colors">About</a>
                    <a href="/archive.php" class="text-gray-700 hover:text-purple-600 font-medium transition-colors">Blog</a>
                </nav>

                <!-- Cart & User Actions -->
                <div class="flex items-center space-x-4">
                    <a href="#" class="text-gray-600 hover:text-purple-600 transition-colors">
                        <i class="fas fa-search text-lg"></i>
                    </a>
                    <a href="#" class="relative text-gray-600 hover:text-purple-600 transition-colors">
                        <i class="fas fa-shopping-cart text-lg"></i>
                        <span class="absolute -top-2 -right-2 bg-purple-600 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">0</span>
                    </a>
                    <a href="#" class="text-gray-600 hover:text-purple-600 transition-colors">
                        <i class="fas fa-user text-lg"></i>
                    </a>

                    <!-- Mobile menu button -->
                    <button type="button" class="md:hidden text-gray-600 hover:text-purple-600 transition-colors" id="mobile-menu-button">
                        <i class="fas fa-bars text-lg"></i>
                    </button>
                </div>
            </div>

            <!-- Mobile Navigation -->
            <div class="md:hidden hidden" id="mobile-menu">
                <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-white border-t">
                    <a href="/" class="block px-3 py-2 text-gray-700 hover:text-purple-600 font-medium">Home</a>
                    <a href="/shop" class="block px-3 py-2 text-gray-700 hover:text-purple-600 font-medium">Shop</a>
                    <a href="/product" class="block px-3 py-2 text-gray-700 hover:text-purple-600 font-medium">Products</a>
                    <a href="/page-about.php" class="block px-3 py-2 text-gray-700 hover:text-purple-600 font-medium">About</a>
                    <a href="/archive.php" class="block px-3 py-2 text-gray-700 hover:text-purple-600 font-medium">Blog</a>
                </div>
            </div>
        </div>
    </header>

    <main id="main" class="site-main">