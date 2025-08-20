<?php
/**
 * Shopora Premium Commerce Theme Functions
 *
 * @package Shopora_Premium_Commerce
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme setup
 */
function shopora_setup() {
    // Add theme support
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));

    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'shopora-premium-commerce'),
    ));
}
add_action('after_setup_theme', 'shopora_setup');

/**
 * Enqueue scripts and styles
 */
function shopora_scripts() {
    wp_enqueue_style('shopora-style', get_stylesheet_uri());
    wp_enqueue_style('tailwindcss', 'https://cdn.tailwindcss.com');
}
add_action('wp_enqueue_scripts', 'shopora_scripts');
?>