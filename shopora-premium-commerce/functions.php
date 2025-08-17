
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

    // Set content width
    if (!isset($content_width)) {
        $content_width = 1200;
    }
}
add_action('after_setup_theme', 'shopora_setup');

/**
 * Enqueue scripts and styles
 */
function shopora_scripts() {
    // Enqueue main stylesheet
    wp_enqueue_style('shopora-style', get_stylesheet_uri(), array(), '1.4.0');
    wp_enqueue_style('shopora-main', get_template_directory_uri() . '/assets/css/main.css', array(), '1.4.0');

    // Enqueue Google Fonts
    wp_enqueue_style('shopora-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap', array(), null);

    // Enqueue Font Awesome
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0');

    // Enqueue main JavaScript
    wp_enqueue_script('shopora-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.4.0', true);

    // Localize script for AJAX
    wp_localize_script('shopora-main', 'shopora_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('shopora_nonce')
    ));

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
        'name'          => __('Shop Sidebar', 'shopora-premium-commerce'),
        'id'            => 'shop-sidebar',
        'description'   => __('Sidebar for shop and product pages', 'shopora-premium-commerce'),
        'before_widget' => '<section id="%1$s" class="widget filter-section %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));

    register_sidebar(array(
        'name'          => __('Main Sidebar', 'shopora-premium-commerce'),
        'id'            => 'sidebar-1',
        'description'   => __('Main sidebar for blog and pages', 'shopora-premium-commerce'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

    // Footer widgets
    for ($i = 1; $i <= 4; $i++) {
        register_sidebar(array(
            'name'          => sprintf(__('Footer %d', 'shopora-premium-commerce'), $i),
            'id'            => "footer-{$i}",
            'description'   => sprintf(__('Footer widget area %d', 'shopora-premium-commerce'), $i),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ));
    }
}
add_action('widgets_init', 'shopora_widgets_init');

/**
 * Helper function to check if sidebar should be displayed
 */
function shopora_show_sidebar() {
    if (is_shop() || is_product_category() || is_product_tag()) {
        $sidebar_id = 'shop-sidebar';
        $show_setting = get_theme_mod('sidebar_show_shop', true);
    } elseif (is_product()) {
        $sidebar_id = 'shop-sidebar';
        $show_setting = get_theme_mod('sidebar_show_product', false);
    } else {
        $sidebar_id = 'sidebar-1';
        $show_setting = get_theme_mod('sidebar_show_blog', true);
    }

    return $show_setting;
}

/**
 * Get sidebar ID based on current page
 */
function shopora_get_sidebar_id() {
    if (is_shop() || is_product_category() || is_product_tag() || is_product()) {
        return 'shop-sidebar';
    }
    return 'sidebar-1';
}

/**
 * WooCommerce modifications
 */
function shopora_woocommerce_init() {
    // Remove default WooCommerce styles
    add_filter('woocommerce_enqueue_styles', '__return_empty_array');

    // Change products per page
    add_filter('loop_shop_per_page', function() {
        return get_theme_mod('products_per_page', 15);
    });

    // Remove default WooCommerce breadcrumbs
    remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

    // Remove default WooCommerce result count and catalog ordering
    remove_action('woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10);
    remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
    remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);

    // Add custom shop toolbar
    add_action('woocommerce_before_shop_loop', 'shopora_shop_toolbar', 20);

    // Fix loop columns
    add_filter('loop_shop_columns', 'shopora_loop_columns');

    // Ensure proper product display
    add_action('pre_get_posts', 'shopora_pre_get_posts_shop');
}
add_action('after_setup_theme', 'shopora_woocommerce_init');

/**
 * Ensure products show in shop page
 */
function shopora_pre_get_posts_shop($query) {
    if (!is_admin() && $query->is_main_query()) {
        if (is_shop()) {
            $query->set('post_type', 'product');
            $query->set('posts_per_page', get_theme_mod('products_per_page', 15));
        }
    }
}

/**
 * Set loop columns based on sidebar
 */
function shopora_loop_columns() {
    if (shopora_show_sidebar()) {
        return get_theme_mod('shop_columns_desktop', 4);
    } else {
        return get_theme_mod('shop_columns_desktop_no_sidebar', 6);
    }
}

/**
 * Custom shop toolbar
 */
function shopora_shop_toolbar() {
    ?>
    <div class="shop-toolbar">
        <?php woocommerce_result_count(); ?>
        <?php woocommerce_catalog_ordering(); ?>
    </div>
    <?php
}

/**
 * Customizer settings
 */
function shopora_customize_register($wp_customize) {

    // Colors Panel
    $wp_customize->add_panel('shopora_colors', array(
        'title'    => __('Theme Colors', 'shopora-premium-commerce'),
        'priority' => 25,
    ));

    // Primary Colors Section
    $wp_customize->add_section('shopora_primary_colors', array(
        'title'    => __('Primary Colors', 'shopora-premium-commerce'),
        'panel'    => 'shopora_colors',
        'priority' => 10,
    ));

    $wp_customize->add_setting('primary_color', array(
        'default'           => '#7c3aed',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'primary_color', array(
        'label'    => __('Primary Color', 'shopora-premium-commerce'),
        'section'  => 'shopora_primary_colors',
    )));

    $wp_customize->add_setting('secondary_color', array(
        'default'           => '#a855f7',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'secondary_color', array(
        'label'    => __('Secondary Color', 'shopora-premium-commerce'),
        'section'  => 'shopora_primary_colors',
    )));

    $wp_customize->add_setting('accent_color', array(
        'default'           => '#f59e0b',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'accent_color', array(
        'label'    => __('Accent Color', 'shopora-premium-commerce'),
        'section'  => 'shopora_primary_colors',
    )));

    // Products Section
    $wp_customize->add_section('shopora_products', array(
        'title'    => __('Shop Settings', 'shopora-premium-commerce'),
        'priority' => 40,
    ));

    $wp_customize->add_setting('products_per_page', array(
        'default'           => 15,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('products_per_page', array(
        'label'    => __('Products Per Page', 'shopora-premium-commerce'),
        'section'  => 'shopora_products',
        'type'     => 'number',
        'input_attrs' => array('min' => 6, 'max' => 50),
    ));

    $wp_customize->add_setting('shop_columns_desktop', array(
        'default'           => 4,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('shop_columns_desktop', array(
        'label'    => __('Desktop Columns (With Sidebar)', 'shopora-premium-commerce'),
        'section'  => 'shopora_products',
        'type'     => 'select',
        'choices'  => array(
            '3' => '3 Columns',
            '4' => '4 Columns',
            '5' => '5 Columns',
        ),
    ));

    $wp_customize->add_setting('shop_columns_desktop_no_sidebar', array(
        'default'           => 6,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('shop_columns_desktop_no_sidebar', array(
        'label'    => __('Desktop Columns (No Sidebar)', 'shopora-premium-commerce'),
        'section'  => 'shopora_products',
        'type'     => 'select',
        'choices'  => array(
            '4' => '4 Columns',
            '5' => '5 Columns',
            '6' => '6 Columns',
            '7' => '7 Columns',
            '8' => '8 Columns',
        ),
    ));

    // Sidebar Visibility section
    $wp_customize->add_section('shopora_sidebar', array(
        'title'    => __('Sidebar Settings', 'shopora-premium-commerce'),
        'priority' => 45,
    ));

    $wp_customize->add_setting('sidebar_show_shop', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('sidebar_show_shop', array(
        'label'    => __('Show Sidebar on Shop Page', 'shopora-premium-commerce'),
        'section'  => 'shopora_sidebar',
        'type'     => 'checkbox',
    ));

    $wp_customize->add_setting('sidebar_show_product', array(
        'default'           => false,
        'sanitize_callback' => 'wp_validate_boolean',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('sidebar_show_product', array(
        'label'    => __('Show Sidebar on Product Pages', 'shopora-premium-commerce'),
        'section'  => 'shopora_sidebar',
        'type'     => 'checkbox',
    ));
}
add_action('customize_register', 'shopora_customize_register');

/**
 * Output custom styles based on customizer settings
 */
function shopora_custom_styles() {
    $primary_color = get_theme_mod('primary_color', '#7c3aed');
    $secondary_color = get_theme_mod('secondary_color', '#a855f7');
    $accent_color = get_theme_mod('accent_color', '#f59e0b');
    $shop_columns_desktop = get_theme_mod('shop_columns_desktop', 4);
    $shop_columns_desktop_no_sidebar = get_theme_mod('shop_columns_desktop_no_sidebar', 6);

    ?>
    <style type="text/css" id="shopora-custom-styles">
        :root {
            --primary-color: <?php echo esc_attr($primary_color); ?>;
            --secondary-color: <?php echo esc_attr($secondary_color); ?>;
            --accent-color: <?php echo esc_attr($accent_color); ?>;
        }

        /* Shop Grid Responsive */
        .shop-layout.has-sidebar .woocommerce ul.products,
        .shop-layout.has-sidebar .woocommerce .products {
            grid-template-columns: repeat(<?php echo esc_attr($shop_columns_desktop); ?>, 1fr) !important;
        }

        .shop-layout.no-sidebar .woocommerce ul.products,
        .shop-layout.no-sidebar .woocommerce .products {
            grid-template-columns: repeat(<?php echo esc_attr($shop_columns_desktop_no_sidebar); ?>, 1fr) !important;
        }

        /* Color Applications */
        .btn-primary,
        .woocommerce ul.products li.product .button,
        .woocommerce div.product form.cart .single_add_to_cart_button {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%) !important;
            color: white !important;
        }

        .woocommerce ul.products li.product .price {
            color: var(--primary-color) !important;
            font-weight: 700 !important;
        }

        .filter-section h4,
        .widget-title {
            color: var(--text-dark) !important;
            border-bottom: 2px solid var(--primary-color);
        }
    </style>
    <?php
}
add_action('wp_head', 'shopora_custom_styles', 999);

/**
 * Load WooCommerce compatibility file
 */
if (class_exists('WooCommerce')) {
    add_action('after_setup_theme', 'shopora_woocommerce_setup');

    function shopora_woocommerce_setup() {
        add_theme_support('woocommerce', array(
            'thumbnail_image_width' => 300,
            'single_image_width'    => 600,
            'product_grid'          => array(
                'default_rows'    => 3,
                'min_rows'        => 2,
                'max_rows'        => 8,
                'default_columns' => 4,
                'min_columns'     => 2,
                'max_columns'     => 8,
            ),
        ));
    }
}

/**
 * Include template tags
 */
require get_template_directory() . '/inc/template-tags.php';
