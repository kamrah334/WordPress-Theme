<?php
/**
 * Shopora Premium Commerce Theme Functions
 *
 * @package Shopora_Premium_Commerce
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    // Check if we're in development mode
    if (isset($_SERVER['HTTP_HOST']) && strpos($_SERVER['HTTP_HOST'], 'replit') !== false) {
        // Define basic constants for Replit development
        define('ABSPATH', __DIR__ . '/');
        define('WP_DEBUG', true);
        define('WP_DEBUG_LOG', true);

        // Add basic WordPress function fallbacks
        if (!function_exists('esc_attr')) {
            function esc_attr($text) { return htmlspecialchars($text, ENT_QUOTES, 'UTF-8'); }
        }
        if (!function_exists('esc_html')) {
            function esc_html($text) { return htmlspecialchars($text, ENT_QUOTES, 'UTF-8'); }
        }
        if (!function_exists('esc_url')) {
            function esc_url($url) { return htmlspecialchars($url, ENT_QUOTES, 'UTF-8'); }
        }
        if (!function_exists('get_theme_mod')) {
            function get_theme_mod($name, $default = '') { return $default; }
        }
        if (!function_exists('home_url')) {
            function home_url($path = '') { return 'http://localhost:5000' . $path; }
        }
        if (!function_exists('get_bloginfo')) {
            function get_bloginfo($show) {
                switch ($show) {
                    case 'name': return 'Shopora Premium Commerce';
                    case 'description': return 'Premium WordPress Theme';
                    default: return '';
                }
            }
        }
        if (!function_exists('wp_get_theme')) {
            function wp_get_theme() {
                return (object) ['get' => function($key) { return '3.1.0'; }];
            }
        }
        if (!function_exists('get_template_directory_uri')) {
            function get_template_directory_uri() { return ''; }
        }
        if (!function_exists('wp_enqueue_style')) {
            function wp_enqueue_style($handle, $src = '', $deps = array(), $ver = false, $media = 'all') {}
        }
        if (!function_exists('wp_enqueue_script')) {
            function wp_enqueue_script($handle, $src = '', $deps = array(), $ver = false, $in_footer = false) {}
        }
        if (!function_exists('add_action')) {
            function add_action($hook, $callback, $priority = 10, $accepted_args = 1) {}
        }
        if (!function_exists('add_theme_support')) {
            function add_theme_support($feature, $args = null) {}
        }
        if (!function_exists('register_nav_menus')) {
            function register_nav_menus($locations = array()) {}
        }
        if (!function_exists('register_sidebar')) {
            function register_sidebar($args = array()) {}
        }
        if (!function_exists('add_filter')) {
            function add_filter($hook, $callback, $priority = 10, $accepted_args = 1) {}
        }
        if (!function_exists('wp_localize_script')) {
            function wp_localize_script($handle, $object_name, $l10n) {}
        }
        if (!function_exists('wp_create_nonce')) {
            function wp_create_nonce($action = -1) { return 'dev_nonce'; }
        }
        if (!function_exists('admin_url')) {
            function admin_url($path = '', $scheme = 'admin') { return '/wp-admin/' . $path; }
        }
        if (!function_exists('class_exists')) {
            function class_exists($class) { return false; }
        }
        if (!function_exists('__')) {
            function __($text, $domain = 'default') { return $text; }
        }
        if (!function_exists('esc_html_e')) {
            function esc_html_e($text, $domain = 'default') { echo esc_html($text); }
        }
        if (!function_exists('get_stylesheet_uri')) {
            function get_stylesheet_uri() { return '/style.css'; }
        }
        if (!function_exists('wp_add_inline_style')) {
            function wp_add_inline_style($handle, $data) {}
        }
        if (!function_exists('absint')) {
            function absint($maybeint) { return abs(intval($maybeint)); }
        }
        if (!function_exists('sanitize_text_field')) {
            function sanitize_text_field($str) { return htmlspecialchars(strip_tags($str), ENT_QUOTES, 'UTF-8'); }
        }
        if (!function_exists('sanitize_hex_color')) {
            function sanitize_hex_color($color) { return $color; }
        }
        if (!function_exists('wp_validate_boolean')) {
            function wp_validate_boolean($var) { return (bool) $var; }
        }
        if (!function_exists('sanitize_textarea_field')) {
            function sanitize_textarea_field($str) { return htmlspecialchars(strip_tags($str), ENT_QUOTES, 'UTF-8'); }
        }
        if (!function_exists('esc_url_raw')) {
            function esc_url_raw($url) { return $url; }
        }
        if (!function_exists('add_query_arg')) {
            function add_query_arg($args, $url) { return $url . '?' . http_build_query($args); }
        }
    } else {
        exit;
    }
}

/**
 * Theme setup
 */
function shopora_setup() {
    // Add theme support for various features
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'script',
        'style',
        'navigation-widgets',
    ));

    // Add theme support for responsive embeds
    add_theme_support('responsive-embeds');

    // Add theme support for editor styles
    add_theme_support('editor-styles');
    add_editor_style('assets/css/main.css');

    // Add theme support for custom background
    add_theme_support('custom-background');

    // Add theme support for wide and full alignment
    add_theme_support('align-wide');

    // Add theme support for selective refresh for widgets
    add_theme_support('customize-selective-refresh-widgets');

    // Add WooCommerce support
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');

    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'shopora-premium-commerce'),
        'footer'  => __('Footer Menu', 'shopora-premium-commerce'),
        'mobile'  => __('Mobile Menu', 'shopora-premium-commerce'),
    ));

    // Set content width
    if (!isset($content_width)) {
        $content_width = 1200;
    }

    // Add image sizes
    add_image_size('shopora-featured', 800, 600, true);
    add_image_size('shopora-blog-grid', 400, 300, true);
    add_image_size('shopora-product-grid', 300, 300, true);
}
add_action('after_setup_theme', 'shopora_setup');

/**
 * Enqueue scripts and styles
 */
function shopora_scripts() {
    // Enqueue main stylesheet
    wp_enqueue_style('shopora-style', get_stylesheet_uri(), array(), wp_get_theme()->get('Version'));

    // Enqueue Tailwind CSS
    wp_enqueue_style('tailwindcss', 'https://cdn.tailwindcss.com/3.4.0', array(), '3.4.0');

    // Enqueue Google Fonts
    $google_fonts_url = shopora_get_google_fonts_url();
    if ($google_fonts_url) {
        wp_enqueue_style('shopora-fonts', $google_fonts_url, array(), null);
    }

    // Enqueue Font Awesome
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css', array(), '6.5.0');

    // Enqueue main JavaScript
    wp_enqueue_script('shopora-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), wp_get_theme()->get('Version'), true);

    // Localize script for AJAX
    wp_localize_script('shopora-main', 'shopora_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('shopora_nonce'),
        'home_url' => home_url('/'),
    ));

    // Enqueue comment reply script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'shopora_scripts');

/**
 * Get Google Fonts URL
 */
function shopora_get_google_fonts_url() {
    $heading_font = get_theme_mod('heading_font_family', 'Inter');
    $body_font = get_theme_mod('body_font_family', 'Inter');

    $fonts = array();

    if ($heading_font && $heading_font !== 'inherit') {
        $fonts[] = $heading_font . ':300,400,500,600,700,800';
    }

    if ($body_font && $body_font !== 'inherit' && $body_font !== $heading_font) {
        $fonts[] = $body_font . ':300,400,500,600,700';
    }

    if (empty($fonts)) {
        $fonts[] = 'Inter:300,400,500,600,700,800';
    }

    return add_query_arg(array(
        'family'  => implode('|', $fonts),
        'display' => 'swap',
    ), 'https://fonts.googleapis.com/css2');
}

/**
 * Register widget areas
 */
function shopora_widgets_init() {
    // Main Sidebar
    register_sidebar(array(
        'name'          => __('Main Sidebar', 'shopora-premium-commerce'),
        'id'            => 'sidebar-1',
        'description'   => __('Main sidebar for blog and pages', 'shopora-premium-commerce'),
        'before_widget' => '<section id="%1$s" class="widget %2$s mb-8">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title text-lg font-semibold text-gray-900 mb-4">',
        'after_title'   => '</h3>',
    ));

    // Shop Sidebar
    register_sidebar(array(
        'name'          => __('Shop Sidebar', 'shopora-premium-commerce'),
        'id'            => 'shop-sidebar',
        'description'   => __('Sidebar for shop and product pages', 'shopora-premium-commerce'),
        'before_widget' => '<section id="%1$s" class="widget filter-section %2$s mb-8">',
        'after_widget'  => '</section>',
        'before_title'  => '<h4 class="widget-title text-lg font-semibold text-gray-900 mb-4">',
        'after_title'   => '</h4>',
    ));

    // Footer widgets
    for ($i = 1; $i <= 4; $i++) {
        register_sidebar(array(
            'name'          => sprintf(__('Footer %d', 'shopora-premium-commerce'), $i),
            'id'            => "footer-{$i}",
            'description'   => sprintf(__('Footer widget area %d', 'shopora-premium-commerce'), $i),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title text-lg font-semibold text-white mb-4">',
            'after_title'   => '</h3>',
        ));
    }
}
add_action('widgets_init', 'shopora_widgets_init');

/**
 * Customizer settings
 */
function shopora_customize_register($wp_customize) {

    // Colors Panel
    $wp_customize->add_panel('shopora_colors', array(
        'title'    => __('Theme Colors', 'shopora-premium-commerce'),
        'priority' => 30,
    ));

    // Primary Colors Section
    $wp_customize->add_section('shopora_primary_colors', array(
        'title' => __('Primary Colors', 'shopora-premium-commerce'),
        'panel' => 'shopora_colors',
    ));

    $color_settings = array(
        'primary_color' => array(
            'default' => '#7c3aed',
            'label'   => __('Primary Color', 'shopora-premium-commerce'),
        ),
        'secondary_color' => array(
            'default' => '#a855f7',
            'label'   => __('Secondary Color', 'shopora-premium-commerce'),
        ),
        'accent_color' => array(
            'default' => '#f59e0b',
            'label'   => __('Accent Color', 'shopora-premium-commerce'),
        ),
        'background_color' => array(
            'default' => '#ffffff',
            'label'   => __('Background Color', 'shopora-premium-commerce'),
        ),
    );

    foreach ($color_settings as $setting_id => $setting) {
        $wp_customize->add_setting($setting_id, array(
            'default'           => $setting['default'],
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage',
        ));

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $setting_id, array(
            'label'   => $setting['label'],
            'section' => 'shopora_primary_colors',
        )));
    }

    // Typography Panel
    $wp_customize->add_panel('shopora_typography', array(
        'title'    => __('Typography', 'shopora-premium-commerce'),
        'priority' => 35,
    ));

    // Font Family Section
    $wp_customize->add_section('shopora_font_families', array(
        'title' => __('Font Families', 'shopora-premium-commerce'),
        'panel' => 'shopora_typography',
    ));

    $google_fonts = array(
        'inherit'           => __('Default', 'shopora-premium-commerce'),
        'Inter'            => 'Inter',
        'Roboto'           => 'Roboto',
        'Open Sans'        => 'Open Sans',
        'Lato'             => 'Lato',
        'Montserrat'       => 'Montserrat',
        'Poppins'          => 'Poppins',
        'Nunito'           => 'Nunito',
        'Source Sans Pro'  => 'Source Sans Pro',
        'Playfair Display' => 'Playfair Display',
        'Merriweather'     => 'Merriweather',
    );

    $wp_customize->add_setting('heading_font_family', array(
        'default'           => 'Inter',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('heading_font_family', array(
        'label'   => __('Heading Font Family', 'shopora-premium-commerce'),
        'section' => 'shopora_font_families',
        'type'    => 'select',
        'choices' => $google_fonts,
    ));

    $wp_customize->add_setting('body_font_family', array(
        'default'           => 'Inter',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('body_font_family', array(
        'label'   => __('Body Font Family', 'shopora-premium-commerce'),
        'section' => 'shopora_font_families',
        'type'    => 'select',
        'choices' => $google_fonts,
    ));

    // Footer Panel
    $wp_customize->add_panel('shopora_footer', array(
        'title'    => __('Footer Settings', 'shopora-premium-commerce'),
        'priority' => 50,
    ));

    // Footer Content Section
    $wp_customize->add_section('shopora_footer_content', array(
        'title' => __('Footer Content', 'shopora-premium-commerce'),
        'panel' => 'shopora_footer',
    ));

    $wp_customize->add_setting('footer_copyright', array(
        'default'           => '© 2024 Shopora Premium Commerce. All rights reserved.',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('footer_copyright', array(
        'label'   => __('Copyright Text', 'shopora-premium-commerce'),
        'section' => 'shopora_footer_content',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('footer_description', array(
        'default'           => 'Your trusted partner for premium products and exceptional customer service.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('footer_description', array(
        'label'   => __('Footer Description', 'shopora-premium-commerce'),
        'section' => 'shopora_footer_content',
        'type'    => 'textarea',
    ));

    // Social Media Section
    $wp_customize->add_section('shopora_social', array(
        'title' => __('Social Media', 'shopora-premium-commerce'),
        'panel' => 'shopora_footer',
    ));

    $social_networks = array(
        'facebook'  => 'Facebook',
        'twitter'   => 'Twitter',
        'instagram' => 'Instagram',
        'linkedin'  => 'LinkedIn',
        'youtube'   => 'YouTube',
    );

    foreach ($social_networks as $network => $label) {
        $wp_customize->add_setting("social_{$network}", array(
            'sanitize_callback' => 'esc_url_raw',
        ));

        $wp_customize->add_control("social_{$network}", array(
            'label'   => sprintf(__('%s URL', 'shopora-premium-commerce'), $label),
            'section' => 'shopora_social',
            'type'    => 'url',
        ));
    }
}
add_action('customize_register', 'shopora_customize_register');

/**
 * Output custom styles based on customizer settings
 */
function shopora_custom_styles() {
    $primary_color = get_theme_mod('primary_color', '#7c3aed');
    $secondary_color = get_theme_mod('secondary_color', '#a855f7');
    $accent_color = get_theme_mod('accent_color', '#f59e0b');
    $background_color = get_theme_mod('background_color', '#ffffff');
    $heading_font = get_theme_mod('heading_font_family', 'Inter');
    $body_font = get_theme_mod('body_font_family', 'Inter');

    $custom_css = "
        :root {
            --primary-color: {$primary_color};
            --secondary-color: {$secondary_color};
            --accent-color: {$accent_color};
            --background-color: {$background_color};
            --heading-font: '{$heading_font}', sans-serif;
            --body-font: '{$body_font}', sans-serif;
        }

        body {
            font-family: var(--body-font);
            background-color: var(--background-color);
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: var(--heading-font);
        }

        .btn-primary {
            background: linear-gradient(135deg, {$primary_color} 0%, {$secondary_color} 100%);
        }

        .text-primary {
            color: {$primary_color};
        }

        .bg-primary {
            background-color: {$primary_color};
        }
    ";

    wp_add_inline_style('shopora-style', $custom_css);
}
add_action('wp_enqueue_scripts', 'shopora_custom_styles');

/**
 * Helper function to check if sidebar should be displayed
 */
function shopora_show_sidebar() {
    if (is_shop() || is_product_category() || is_product_tag()) {
        return get_theme_mod('sidebar_show_shop', true) && is_active_sidebar('shop-sidebar');
    } elseif (is_product()) {
        return get_theme_mod('sidebar_show_product', false) && is_active_sidebar('shop-sidebar');
    } elseif (is_home() || is_archive() || is_search()) {
        return get_theme_mod('sidebar_show_blog', true) && is_active_sidebar('sidebar-1');
    }

    return is_active_sidebar('sidebar-1');
}

/**
 * Posts pagination
 */
function shopora_posts_pagination() {
    if (function_exists('paginate_links')) {
        $pagination = paginate_links(array(
            'type'      => 'array',
            'prev_text' => '<i class="fas fa-chevron-left"></i>',
            'next_text' => '<i class="fas fa-chevron-right"></i>',
        ));

        if ($pagination) {
            echo '<nav class="posts-pagination mt-8">';
            echo '<div class="flex justify-center space-x-2">';
            foreach ($pagination as $page) {
                echo '<div class="pagination-item">' . $page . '</div>';
            }
            echo '</div>';
            echo '</nav>';
        }
    } else {
        // Fallback for development
        echo '<nav class="posts-pagination mt-8">
            <div class="flex justify-center space-x-2">
                <a href="#" class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors">1</a>
                <a href="#" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">2</a>
                <a href="#" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">3</a>
            </div>
        </nav>';
    }
}

/**
 * Fallback menu function
 */
function shopora_fallback_menu() {
    echo '<ul class="flex items-center space-x-8">';
    echo '<li><a href="' . esc_url(home_url('/')) . '" class="text-gray-700 hover:text-purple-600 font-medium transition-colors">' . esc_html__('Home', 'shopora-premium-commerce') . '</a></li>';
    if (class_exists('WooCommerce')) {
        echo '<li><a href="/shop" class="text-gray-700 hover:text-purple-600 font-medium transition-colors">' . esc_html__('Shop', 'shopora-premium-commerce') . '</a></li>';
    }
    echo '<li><a href="#" class="text-gray-700 hover:text-purple-600 font-medium transition-colors">' . esc_html__('Blog', 'shopora-premium-commerce') . '</a></li>';
    echo '<li><a href="#" class="text-gray-700 hover:text-purple-600 font-medium transition-colors">' . esc_html__('About', 'shopora-premium-commerce') . '</a></li>';
    echo '<li><a href="#" class="text-gray-700 hover:text-purple-600 font-medium transition-colors">' . esc_html__('Contact', 'shopora-premium-commerce') . '</a></li>';
    echo '</ul>';
}

// Include additional template functions
if (file_exists(get_template_directory() . '/inc/template-tags.php')) {
    require get_template_directory() . '/inc/template-tags.php';
}

/**
 * WooCommerce setup and modifications
 */
if (class_exists('WooCommerce')) {
    function shopora_woocommerce_setup() {
        add_theme_support('woocommerce', array(
            'thumbnail_image_width' => 400,
            'single_image_width'    => 600,
            'product_grid'          => array(
                'default_rows'    => 3,
                'min_rows'        => 2,
                'max_rows'        => 8,
                'default_columns' => 4,
                'min_columns'     => 2,
                'max_columns'     => 6,
            ),
        ));

        // Remove default WooCommerce styles
        add_filter('woocommerce_enqueue_styles', '__return_empty_array');
    }
    add_action('after_setup_theme', 'shopora_woocommerce_setup');
}

?>