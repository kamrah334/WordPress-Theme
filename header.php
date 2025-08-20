<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="bg-white shadow">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <div class="text-2xl font-bold">
                <a href="<?php echo esc_url(home_url('/')); ?>">
                    <?php bloginfo('name'); ?>
                </a>
            </div>
            <nav>
                <a href="/" class="px-4 py-2">Home</a>
                <a href="/shop" class="px-4 py-2">Shop</a>
                <a href="/about" class="px-4 py-2">About</a>
            </nav>
        </div>
    </div>
</header>

<main>