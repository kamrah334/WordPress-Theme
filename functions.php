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
    // Add theme support for various features
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('custom-logo');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    
    // Add WooCommerce support
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'shopora-premium-commerce'),
        'footer' => __('Footer Menu', 'shopora-premium-commerce'),
    ));
    
    // Add support for editor styles
    add_theme_support('editor-styles');
    add_editor_style('assets/css/main.css');
}
add_action('after_setup_theme', 'shopora_setup');

/**
 * Enqueue scripts and styles
 */
function shopora_scripts() {
    // Enqueue main stylesheet
    wp_enqueue_style('shopora-style', get_stylesheet_uri(), array(), '1.0.0');
    wp_enqueue_style('shopora-main', get_template_directory_uri() . '/assets/css/main.css', array(), '1.0.0');
    
    // Enqueue Google Fonts
    wp_enqueue_style('shopora-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap', array(), null);
    
    // Enqueue Font Awesome
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css', array(), '6.0.0');
    
    // Enqueue main JavaScript
    wp_enqueue_script('shopora-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0.0', true);
    
    // Enqueue comment reply script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'shopora_scripts');

/**
 * Register widget areas
 */
function shopora_widgets_init() {
    register_sidebar(array(
        'name'          => __('Sidebar', 'shopora-premium-commerce'),
        'id'            => 'sidebar-1',
        'description'   => __('Add widgets here.', 'shopora-premium-commerce'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
    
    register_sidebar(array(
        'name'          => __('Footer 1', 'shopora-premium-commerce'),
        'id'            => 'footer-1',
        'description'   => __('Footer widget area 1', 'shopora-premium-commerce'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    register_sidebar(array(
        'name'          => __('Footer 2', 'shopora-premium-commerce'),
        'id'            => 'footer-2',
        'description'   => __('Footer widget area 2', 'shopora-premium-commerce'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    register_sidebar(array(
        'name'          => __('Footer 3', 'shopora-premium-commerce'),
        'id'            => 'footer-3',
        'description'   => __('Footer widget area 3', 'shopora-premium-commerce'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    register_sidebar(array(
        'name'          => __('Footer 4', 'shopora-premium-commerce'),
        'id'            => 'footer-4',
        'description'   => __('Footer widget area 4', 'shopora-premium-commerce'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'shopora_widgets_init');

/**
 * Custom excerpt length
 */
function shopora_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'shopora_excerpt_length');

/**
 * Custom excerpt more
 */
function shopora_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'shopora_excerpt_more');

/**
 * Add custom body classes
 */
function shopora_body_classes($classes) {
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }
    
    if (is_front_page()) {
        $classes[] = 'front-page';
    }
    
    return $classes;
}
add_filter('body_class', 'shopora_body_classes');

/**
 * Include template tags
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer settings
 */
function shopora_customize_register($wp_customize) {
    // Hero section
    $wp_customize->add_section('shopora_hero', array(
        'title'    => __('Hero Section', 'shopora-premium-commerce'),
        'priority' => 30,
    ));
    
    $wp_customize->add_setting('hero_title', array(
        'default'           => 'Premium Products for Modern Living',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('hero_title', array(
        'label'    => __('Hero Title', 'shopora-premium-commerce'),
        'section'  => 'shopora_hero',
        'type'     => 'text',
    ));
    
    $wp_customize->add_setting('hero_description', array(
        'default'           => 'Discover our curated collection of high-quality products designed to enhance your lifestyle.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    
    $wp_customize->add_control('hero_description', array(
        'label'    => __('Hero Description', 'shopora-premium-commerce'),
        'section'  => 'shopora_hero',
        'type'     => 'textarea',
    ));
    
    // Contact section
    $wp_customize->add_section('shopora_contact', array(
        'title'    => __('Contact Information', 'shopora-premium-commerce'),
        'priority' => 35,
    ));
    
    $wp_customize->add_setting('contact_phone', array(
        'default'           => '+1 (555) 123-4567',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('contact_phone', array(
        'label'    => __('Phone Number', 'shopora-premium-commerce'),
        'section'  => 'shopora_contact',
        'type'     => 'text',
    ));
    
    $wp_customize->add_setting('contact_email', array(
        'default'           => 'hello@premiumcommerce.com',
        'sanitize_callback' => 'sanitize_email',
    ));
    
    $wp_customize->add_control('contact_email', array(
        'label'    => __('Email Address', 'shopora-premium-commerce'),
        'section'  => 'shopora_contact',
        'type'     => 'email',
    ));
    
    $wp_customize->add_setting('contact_address', array(
        'default'           => '123 Business Ave, Suite 100, City, State 12345',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    
    $wp_customize->add_control('contact_address', array(
        'label'    => __('Address', 'shopora-premium-commerce'),
        'section'  => 'shopora_contact',
        'type'     => 'textarea',
    ));
}
add_action('customize_register', 'shopora_customize_register');

/**
 * WooCommerce modifications
 */
function shopora_woocommerce_init() {
    // Remove default WooCommerce styles
    add_filter('woocommerce_enqueue_styles', '__return_empty_array');
    
    // Change number of products per row
    add_filter('loop_shop_columns', function() {
        return 3;
    });
    
    // Change number of products per page
    add_filter('loop_shop_per_page', function() {
        return 9;
    });
}
add_action('init', 'shopora_woocommerce_init');
?>
