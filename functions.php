
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
    wp_enqueue_style('shopora-style', get_stylesheet_uri(), array(), '1.2.0');
    wp_enqueue_style('shopora-main', get_template_directory_uri() . '/assets/css/main.css', array(), '1.2.0');
    
    // Enqueue Google Fonts
    wp_enqueue_style('shopora-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap', array(), null);
    
    // Enqueue Font Awesome
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0');
    
    // Enqueue main JavaScript
    wp_enqueue_script('shopora-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.2.0', true);
    
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
 * Custom excerpt length
 */
function shopora_excerpt_length($length) {
    return get_theme_mod('excerpt_length', 25);
}
add_filter('excerpt_length', 'shopora_excerpt_length');

/**
 * Custom excerpt more
 */
function shopora_excerpt_more($more) {
    return get_theme_mod('excerpt_more', '...');
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
    
    // Add sidebar class
    if (shopora_show_sidebar()) {
        $classes[] = 'has-sidebar';
    } else {
        $classes[] = 'no-sidebar';
    }
    
    return $classes;
}
add_filter('body_class', 'shopora_body_classes');

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
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'primary_color', array(
        'label'    => __('Primary Color', 'shopora-premium-commerce'),
        'section'  => 'shopora_primary_colors',
    )));
    
    $wp_customize->add_setting('secondary_color', array(
        'default'           => '#a855f7',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'secondary_color', array(
        'label'    => __('Secondary Color', 'shopora-premium-commerce'),
        'section'  => 'shopora_primary_colors',
    )));
    
    $wp_customize->add_setting('accent_color', array(
        'default'           => '#f59e0b',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'accent_color', array(
        'label'    => __('Accent Color', 'shopora-premium-commerce'),
        'section'  => 'shopora_primary_colors',
    )));
    
    // Typography Panel
    $wp_customize->add_panel('shopora_typography', array(
        'title'    => __('Typography', 'shopora-premium-commerce'),
        'priority' => 30,
    ));
    
    // Header Typography
    $wp_customize->add_section('shopora_header_typography', array(
        'title'    => __('Header Typography', 'shopora-premium-commerce'),
        'panel'    => 'shopora_typography',
    ));
    
    $wp_customize->add_setting('header_font_size', array(
        'default'           => '16',
        'sanitize_callback' => 'absint',
    ));
    
    $wp_customize->add_control('header_font_size', array(
        'label'    => __('Header Font Size (px)', 'shopora-premium-commerce'),
        'section'  => 'shopora_header_typography',
        'type'     => 'number',
        'input_attrs' => array('min' => 12, 'max' => 24),
    ));
    
    // Hero section
    $wp_customize->add_section('shopora_hero', array(
        'title'    => __('Hero Section', 'shopora-premium-commerce'),
        'priority' => 35,
    ));
    
    $wp_customize->add_setting('hero_enable', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ));
    
    $wp_customize->add_control('hero_enable', array(
        'label'    => __('Enable Hero Section', 'shopora-premium-commerce'),
        'section'  => 'shopora_hero',
        'type'     => 'checkbox',
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
    
    $wp_customize->add_setting('hero_image', array(
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'hero_image', array(
        'label'    => __('Hero Background Image', 'shopora-premium-commerce'),
        'section'  => 'shopora_hero',
    )));
    
    // Products Section
    $wp_customize->add_section('shopora_products', array(
        'title'    => __('Products Section', 'shopora-premium-commerce'),
        'priority' => 40,
    ));
    
    $wp_customize->add_setting('products_per_page', array(
        'default'           => 15,
        'sanitize_callback' => 'absint',
    ));
    
    $wp_customize->add_control('products_per_page', array(
        'label'    => __('Products Per Page', 'shopora-premium-commerce'),
        'section'  => 'shopora_products',
        'type'     => 'number',
        'input_attrs' => array('min' => 6, 'max' => 50),
    ));
    
    $wp_customize->add_setting('shop_columns_desktop', array(
        'default'           => 5,
        'sanitize_callback' => 'absint',
    ));
    
    $wp_customize->add_control('shop_columns_desktop', array(
        'label'    => __('Desktop Columns (Sidebar Enabled)', 'shopora-premium-commerce'),
        'section'  => 'shopora_products',
        'type'     => 'select',
        'choices'  => array(
            '3' => '3 Columns',
            '4' => '4 Columns',
            '5' => '5 Columns',
            '6' => '6 Columns',
        ),
    ));
    
    $wp_customize->add_setting('shop_columns_desktop_no_sidebar', array(
        'default'           => 6,
        'sanitize_callback' => 'absint',
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
        ),
    ));
    
    $wp_customize->add_setting('shop_columns_tablet', array(
        'default'           => 4,
        'sanitize_callback' => 'absint',
    ));
    
    $wp_customize->add_control('shop_columns_tablet', array(
        'label'    => __('Tablet Columns', 'shopora-premium-commerce'),
        'section'  => 'shopora_products',
        'type'     => 'select',
        'choices'  => array(
            '2' => '2 Columns',
            '3' => '3 Columns',
            '4' => '4 Columns',
        ),
    ));
    
    $wp_customize->add_setting('shop_columns_mobile', array(
        'default'           => 2,
        'sanitize_callback' => 'absint',
    ));
    
    $wp_customize->add_control('shop_columns_mobile', array(
        'label'    => __('Mobile Columns', 'shopora-premium-commerce'),
        'section'  => 'shopora_products',
        'type'     => 'select',
        'choices'  => array(
            '1' => '1 Column',
            '2' => '2 Columns',
            '3' => '3 Columns',
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
    ));
    
    $wp_customize->add_control('sidebar_show_shop', array(
        'label'    => __('Show Sidebar on Shop Page', 'shopora-premium-commerce'),
        'section'  => 'shopora_sidebar',
        'type'     => 'checkbox',
    ));
    
    $wp_customize->add_setting('sidebar_show_product', array(
        'default'           => false,
        'sanitize_callback' => 'wp_validate_boolean',
    ));
    
    $wp_customize->add_control('sidebar_show_product', array(
        'label'    => __('Show Sidebar on Product Pages', 'shopora-premium-commerce'),
        'section'  => 'shopora_sidebar',
        'type'     => 'checkbox',
    ));
    
    $wp_customize->add_setting('sidebar_show_blog', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ));
    
    $wp_customize->add_control('sidebar_show_blog', array(
        'label'    => __('Show Sidebar on Blog Pages', 'shopora-premium-commerce'),
        'section'  => 'shopora_sidebar',
        'type'     => 'checkbox',
    ));
    
    // Contact Information
    $wp_customize->add_section('shopora_contact', array(
        'title'    => __('Contact Information', 'shopora-premium-commerce'),
        'priority' => 50,
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
    
    // Social Media
    $wp_customize->add_section('shopora_social', array(
        'title'    => __('Social Media', 'shopora-premium-commerce'),
        'priority' => 55,
    ));
    
    $social_networks = array(
        'facebook' => 'Facebook',
        'twitter' => 'Twitter',
        'instagram' => 'Instagram',
        'linkedin' => 'LinkedIn',
        'youtube' => 'YouTube',
    );
    
    foreach ($social_networks as $network => $label) {
        $wp_customize->add_setting("social_{$network}", array(
            'sanitize_callback' => 'esc_url_raw',
        ));
        
        $wp_customize->add_control("social_{$network}", array(
            'label'    => sprintf(__('%s URL', 'shopora-premium-commerce'), $label),
            'section'  => 'shopora_social',
            'type'     => 'url',
        ));
    }
    
    // Footer Settings
    $wp_customize->add_section('shopora_footer', array(
        'title'    => __('Footer Settings', 'shopora-premium-commerce'),
        'priority' => 60,
    ));
    
    $wp_customize->add_setting('footer_copyright', array(
        'default'           => '© 2024 Premium Commerce. All rights reserved.',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('footer_copyright', array(
        'label'    => __('Copyright Text', 'shopora-premium-commerce'),
        'section'  => 'shopora_footer',
        'type'     => 'text',
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
    $header_font_size = get_theme_mod('header_font_size', 16);
    $shop_columns_desktop = get_theme_mod('shop_columns_desktop', 5);
    $shop_columns_desktop_no_sidebar = get_theme_mod('shop_columns_desktop_no_sidebar', 6);
    $shop_columns_tablet = get_theme_mod('shop_columns_tablet', 4);
    $shop_columns_mobile = get_theme_mod('shop_columns_mobile', 2);
    
    ?>
    <style type="text/css" id="shopora-custom-styles">
        :root {
            --primary-color: <?php echo esc_attr($primary_color); ?>;
            --secondary-color: <?php echo esc_attr($secondary_color); ?>;
            --accent-color: <?php echo esc_attr($accent_color); ?>;
        }
        
        .main-navigation {
            font-size: <?php echo esc_attr($header_font_size); ?>px;
        }
        
        /* Shop Grid Responsive */
        .shop-layout.has-sidebar .woocommerce ul.products {
            grid-template-columns: repeat(<?php echo esc_attr($shop_columns_desktop); ?>, 1fr) !important;
        }
        
        .shop-layout.no-sidebar .woocommerce ul.products {
            grid-template-columns: repeat(<?php echo esc_attr($shop_columns_desktop_no_sidebar); ?>, 1fr) !important;
        }
        
        @media (max-width: 1024px) {
            .woocommerce ul.products {
                grid-template-columns: repeat(<?php echo esc_attr($shop_columns_tablet); ?>, 1fr) !important;
            }
        }
        
        @media (max-width: 768px) {
            .woocommerce ul.products {
                grid-template-columns: repeat(<?php echo esc_attr($shop_columns_mobile); ?>, 1fr) !important;
            }
        }
        
        /* Color Applications */
        .btn-primary,
        .woocommerce ul.products li.product .button,
        .woocommerce div.product form.cart .single_add_to_cart_button {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%) !important;
        }
        
        .btn-primary:hover,
        .woocommerce ul.products li.product .button:hover,
        .woocommerce div.product form.cart .single_add_to_cart_button:hover {
            background: linear-gradient(135deg, var(--secondary-color) 0%, var(--primary-color) 100%) !important;
        }
        
        .woocommerce ul.products li.product .price,
        .price {
            color: var(--primary-color) !important;
        }
        
        .hero-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        }
        
        .main-navigation a:hover {
            color: var(--primary-color);
        }
    </style>
    <?php
}
add_action('wp_head', 'shopora_custom_styles');

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
    
    return $show_setting && is_active_sidebar($sidebar_id);
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
}
add_action('init', 'shopora_woocommerce_init');

/**
 * Add custom search widget for shop sidebar
 */
class Shopora_Product_Search_Widget extends WP_Widget {
    function __construct() {
        parent::__construct(
            'shopora_product_search',
            __('Shop Search', 'shopora-premium-commerce'),
            array('description' => __('Product search form for shop sidebar', 'shopora-premium-commerce'))
        );
    }
    
    public function widget($args, $instance) {
        echo $args['before_widget'];
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }
        ?>
        <div class="search-section">
            <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="product-search-form">
                <div class="search-wrapper">
                    <input type="search" class="search-field" placeholder="<?php echo esc_attr_x('Search products...', 'placeholder', 'shopora-premium-commerce'); ?>" value="<?php echo get_search_query(); ?>" name="s" />
                    <input type="hidden" name="post_type" value="product" />
                    <button type="submit" class="search-submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>
        <?php
        echo $args['after_widget'];
    }
    
    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : __('Search Products', 'shopora-premium-commerce');
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'shopora-premium-commerce'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <?php
    }
    
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
        return $instance;
    }
}

function shopora_register_widgets() {
    register_widget('Shopora_Product_Search_Widget');
}
add_action('widgets_init', 'shopora_register_widgets');

/**
 * Include template tags
 */
require get_template_directory() . '/inc/template-tags.php';
?>
