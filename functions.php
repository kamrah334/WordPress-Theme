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
    
    // Button Links section
    $wp_customize->add_section('shopora_buttons', array(
        'title'    => __('Button Links & Text', 'shopora-premium-commerce'),
        'priority' => 40,
    ));
    
    // Hero Primary Button
    $wp_customize->add_setting('hero_primary_btn_text', array(
        'default'           => 'Shop Now',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('hero_primary_btn_text', array(
        'label'    => __('Hero Primary Button Text', 'shopora-premium-commerce'),
        'section'  => 'shopora_buttons',
        'type'     => 'text',
    ));
    
    $wp_customize->add_setting('hero_primary_btn_url', array(
        'default'           => '/shop',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('hero_primary_btn_url', array(
        'label'    => __('Hero Primary Button URL', 'shopora-premium-commerce'),
        'section'  => 'shopora_buttons',
        'type'     => 'url',
    ));
    
    // Hero Secondary Button
    $wp_customize->add_setting('hero_secondary_btn_text', array(
        'default'           => 'Learn More',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('hero_secondary_btn_text', array(
        'label'    => __('Hero Secondary Button Text', 'shopora-premium-commerce'),
        'section'  => 'shopora_buttons',
        'type'     => 'text',
    ));
    
    $wp_customize->add_setting('hero_secondary_btn_url', array(
        'default'           => '/about',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('hero_secondary_btn_url', array(
        'label'    => __('Hero Secondary Button URL', 'shopora-premium-commerce'),
        'section'  => 'shopora_buttons',
        'type'     => 'url',
    ));
    
    // View All Products Button
    $wp_customize->add_setting('view_all_btn_text', array(
        'default'           => 'View All Products',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('view_all_btn_text', array(
        'label'    => __('View All Products Button Text', 'shopora-premium-commerce'),
        'section'  => 'shopora_buttons',
        'type'     => 'text',
    ));
    
    $wp_customize->add_setting('view_all_btn_url', array(
        'default'           => '/shop',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('view_all_btn_url', array(
        'label'    => __('View All Products Button URL', 'shopora-premium-commerce'),
        'section'  => 'shopora_buttons',
        'type'     => 'url',
    ));
    
    // CTA Button
    $wp_customize->add_setting('cta_btn_text', array(
        'default'           => 'Get Started Today',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('cta_btn_text', array(
        'label'    => __('CTA Button Text', 'shopora-premium-commerce'),
        'section'  => 'shopora_buttons',
        'type'     => 'text',
    ));
    
    $wp_customize->add_setting('cta_btn_url', array(
        'default'           => '/contact',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('cta_btn_url', array(
        'label'    => __('CTA Button URL', 'shopora-premium-commerce'),
        'section'  => 'shopora_buttons',
        'type'     => 'url',
    ));
    
    // Button Styles section
    $wp_customize->add_section('shopora_button_styles', array(
        'title'    => __('Button Styles', 'shopora-premium-commerce'),
        'priority' => 41,
    ));
    
    // Primary Button Color
    $wp_customize->add_setting('primary_btn_color', array(
        'default'           => '#7c3aed',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'primary_btn_color', array(
        'label'    => __('Primary Button Color', 'shopora-premium-commerce'),
        'section'  => 'shopora_button_styles',
    )));
    
    // Primary Button Hover Color
    $wp_customize->add_setting('primary_btn_hover_color', array(
        'default'           => '#6d28d9',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'primary_btn_hover_color', array(
        'label'    => __('Primary Button Hover Color', 'shopora-premium-commerce'),
        'section'  => 'shopora_button_styles',
    )));
    
    // Secondary Button Border Color
    $wp_customize->add_setting('secondary_btn_border_color', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'secondary_btn_border_color', array(
        'label'    => __('Secondary Button Border Color', 'shopora-premium-commerce'),
        'section'  => 'shopora_button_styles',
    )));
    
    // Button Border Radius
    $wp_customize->add_setting('btn_border_radius', array(
        'default'           => '8',
        'sanitize_callback' => 'absint',
    ));
    
    $wp_customize->add_control('btn_border_radius', array(
        'label'    => __('Button Border Radius (px)', 'shopora-premium-commerce'),
        'section'  => 'shopora_button_styles',
        'type'     => 'number',
        'input_attrs' => array(
            'min' => 0,
            'max' => 50,
        ),
    ));
}
add_action('customize_register', 'shopora_customize_register');

/**
 * Output custom button styles
 */
function shopora_custom_button_styles() {
    $primary_color = get_theme_mod('primary_btn_color', '#7c3aed');
    $primary_hover_color = get_theme_mod('primary_btn_hover_color', '#6d28d9');
    $secondary_border_color = get_theme_mod('secondary_btn_border_color', '#ffffff');
    $border_radius = get_theme_mod('btn_border_radius', '8');
    
    ?>
    <style type="text/css">
        .btn-primary {
            background: <?php echo esc_attr($primary_color); ?> !important;
            border-radius: <?php echo esc_attr($border_radius); ?>px !important;
        }
        .btn-primary:hover {
            background: <?php echo esc_attr($primary_hover_color); ?> !important;
        }
        .btn-secondary {
            border-color: <?php echo esc_attr($secondary_border_color); ?> !important;
            border-radius: <?php echo esc_attr($border_radius); ?>px !important;
        }
        .btn-secondary:hover {
            background: <?php echo esc_attr($secondary_border_color); ?> !important;
        }
        .btn {
            border-radius: <?php echo esc_attr($border_radius); ?>px !important;
        }
        .woocommerce ul.products li.product .button,
        .woocommerce div.product form.cart .single_add_to_cart_button {
            background: linear-gradient(135deg, <?php echo esc_attr($primary_color); ?> 0%, <?php echo esc_attr($primary_hover_color); ?> 100%) !important;
            border-radius: <?php echo esc_attr($border_radius); ?>px !important;
        }
        .woocommerce ul.products li.product .button:hover,
        .woocommerce div.product form.cart .single_add_to_cart_button:hover {
            background: linear-gradient(135deg, <?php echo esc_attr($primary_hover_color); ?> 0%, <?php echo esc_attr($primary_color); ?> 100%) !important;
        }
    </style>
    <?php
}
add_action('wp_head', 'shopora_custom_button_styles');

/**
 * Helper function to get button customizer settings
 */
function shopora_get_button_setting($setting_name, $default = '') {
    return get_theme_mod($setting_name, $default);
}

/**
 * Helper function to output customizable button
 */
function shopora_render_button($text_setting, $url_setting, $default_text, $default_url, $class = 'btn btn-primary', $additional_attrs = '') {
    $text = shopora_get_button_setting($text_setting, $default_text);
    $url = shopora_get_button_setting($url_setting, $default_url);
    
    printf(
        '<a href="%s" class="%s" %s>%s</a>',
        esc_url($url),
        esc_attr($class),
        $additional_attrs,
        esc_html($text)
    );
}

/**
 * WooCommerce modifications
 */
function shopora_woocommerce_init() {
    // Remove default WooCommerce styles
    add_filter('woocommerce_enqueue_styles', '__return_empty_array');
    
    // Change number of products per row
    add_filter('loop_shop_columns', function() {
        return 5; // Set to 5 products per row
    });
    
    // Change number of products per page
    add_filter('loop_shop_per_page', function() {
        return 15; // Increased to accommodate 5x3 grid
    });
}
add_action('init', 'shopora_woocommerce_init');
?>
