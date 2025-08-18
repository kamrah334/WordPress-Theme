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
        'footer' => __('Footer Menu', 'shopora-premium-commerce'),
        'mobile' => __('Mobile Menu', 'shopora-premium-commerce'),
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
 * Fallback menu for primary navigation
 */
function shopora_fallback_menu() {
    ?>
    <ul class="main-menu">
        <li><a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'shopora-premium-commerce'); ?></a></li>
        <?php if (class_exists('WooCommerce')) : ?>
            <li><a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>"><?php esc_html_e('Shop', 'shopora-premium-commerce'); ?></a></li>
        <?php endif; ?>
        <li><a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>"><?php esc_html_e('Blog', 'shopora-premium-commerce'); ?></a></li>
        <?php
        // Add pages to menu
        $pages = get_pages(array('meta_key' => '_wp_page_template', 'meta_value' => 'page.php', 'number' => 3));
        foreach ($pages as $page) {
            echo '<li><a href="' . esc_url(get_permalink($page->ID)) . '">' . esc_html($page->post_title) . '</a></li>';
        }
        ?>
    </ul>
    <?php
}

/**
 * Posts pagination
 */
function shopora_posts_pagination() {
    $pagination = paginate_links(array(
        'type' => 'array',
        'prev_text' => '<i class="fas fa-chevron-left"></i>',
        'next_text' => '<i class="fas fa-chevron-right"></i>',
    ));

    if ($pagination) {
        echo '<nav class="posts-pagination"><ul class="page-numbers">';
        foreach ($pagination as $page) {
            echo '<li>' . $page . '</li>';
        }
        echo '</ul></nav>';
    }
}

/**
 * Enqueue scripts and styles
 */
function shopora_scripts() {
    // Enqueue main stylesheet
    wp_enqueue_style('shopora-style', get_stylesheet_uri(), array(), wp_get_theme()->get('Version'));

    // Enqueue main CSS file
    wp_enqueue_style('shopora-main', get_template_directory_uri() . '/assets/css/main.css', array(), wp_get_theme()->get('Version'));

    // Enqueue Google Fonts
    $google_fonts_url = shopora_get_google_fonts_url();
    if ($google_fonts_url) {
        wp_enqueue_style('shopora-fonts', $google_fonts_url, array(), null);
    }

    // Enqueue Font Awesome
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css', array(), '6.5.0');

    // Enqueue jQuery from WordPress core
    wp_enqueue_script('jquery');

    // Enqueue main JavaScript with jQuery dependency
    wp_enqueue_script('shopora-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), wp_get_theme()->get('Version'), true);

    // Localize script for AJAX
    wp_localize_script('shopora-main', 'shopora_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('shopora_nonce'),
        'home_url' => home_url('/'),
        'wc_ajax_url' => class_exists('WooCommerce') ? WC_AJAX::get_endpoint('%%endpoint%%') : '',
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
        'family' => implode('|', $fonts),
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
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

    // Shop Sidebar
    register_sidebar(array(
        'name'          => __('Shop Sidebar', 'shopora-premium-commerce'),
        'id'            => 'shop-sidebar',
        'description'   => __('Sidebar for shop and product pages', 'shopora-premium-commerce'),
        'before_widget' => '<section id="%1$s" class="widget filter-section %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h4 class="widget-title">',
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
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ));
    }

    // Header Widget Area
    register_sidebar(array(
        'name'          => __('Header Widget Area', 'shopora-premium-commerce'),
        'id'            => 'header-widget',
        'description'   => __('Widget area in the header', 'shopora-premium-commerce'),
        'before_widget' => '<div id="%1$s" class="header-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
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
    if (shopora_show_sidebar()) {
        $classes[] = 'has-sidebar';
    } else {
        $classes[] = 'no-sidebar';
    }

    return $classes;
}
add_filter('body_class', 'shopora_body_classes');

/**
 * AJAX Cart Count Update
 */
function shopora_get_cart_count() {
    check_ajax_referer('shopora_nonce', 'nonce');

    $count = 0;
    if (class_exists('WooCommerce')) {
        $count = WC()->cart->get_cart_contents_count();
    }

    wp_send_json_success(array('count' => $count));
}
add_action('wp_ajax_get_cart_count', 'shopora_get_cart_count');
add_action('wp_ajax_nopriv_get_cart_count', 'shopora_get_cart_count');

/**
 * Fallback menu function
 */
function shopora_fallback_menu() {
    echo '<ul class="flex items-center space-x-8">';
    echo '<li><a href="' . esc_url(home_url('/')) . '" class="text-gray-700 hover:text-purple-600 font-medium transition-colors">' . esc_html__('Home', 'shopora-premium-commerce') . '</a></li>';
    if (class_exists('WooCommerce')) {
        echo '<li><a href="' . esc_url(wc_get_page_permalink('shop')) . '" class="text-gray-700 hover:text-purple-600 font-medium transition-colors">' . esc_html__('Shop', 'shopora-premium-commerce') . '</a></li>';
    }
    echo '<li><a href="' . esc_url(get_permalink(get_option('page_for_posts'))) . '" class="text-gray-700 hover:text-purple-600 font-medium transition-colors">' . esc_html__('Blog', 'shopora-premium-commerce') . '</a></li>';
    echo '</ul>';
}

/**
 * Customizer settings
 */
function shopora_customize_register($wp_customize) {

    // Header Panel
    $wp_customize->add_panel('shopora_header', array(
        'title'    => __('Header Settings', 'shopora-premium-commerce'),
        'priority' => 25,
    ));

    // Header Layout Section
    $wp_customize->add_section('shopora_header_layout', array(
        'title'    => __('Header Layout', 'shopora-premium-commerce'),
        'panel'    => 'shopora_header',
        'priority' => 10,
    ));

    $wp_customize->add_setting('header_layout', array(
        'default'           => 'default',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('header_layout', array(
        'label'    => __('Header Layout', 'shopora-premium-commerce'),
        'section'  => 'shopora_header_layout',
        'type'     => 'select',
        'choices'  => array(
            'default' => __('Default', 'shopora-premium-commerce'),
            'centered' => __('Centered', 'shopora-premium-commerce'),
            'minimal' => __('Minimal', 'shopora-premium-commerce'),
        ),
    ));

    // Header Text/Logo Settings
    $wp_customize->add_setting('header_logo_text', array(
        'default'           => get_bloginfo('name'),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('header_logo_text', array(
        'label'    => __('Logo Text', 'shopora-premium-commerce'),
        'section'  => 'shopora_header_layout',
        'type'     => 'text',
    ));

    $wp_customize->add_setting('header_tagline', array(
        'default'           => get_bloginfo('description'),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('header_tagline', array(
        'label'    => __('Header Tagline', 'shopora-premium-commerce'),
        'section'  => 'shopora_header_layout',
        'type'     => 'text',
    ));

    // Colors Panel
    $wp_customize->add_panel('shopora_colors', array(
        'title'    => __('Theme Colors', 'shopora-premium-commerce'),
        'priority' => 30,
    ));

    // Primary Colors Section
    $wp_customize->add_section('shopora_primary_colors', array(
        'title'    => __('Primary Colors', 'shopora-premium-commerce'),
        'panel'    => 'shopora_colors',
        'priority' => 10,
    ));

    $color_settings = array(
        'primary_color' => array(
            'default' => '#7c3aed',
            'label' => __('Primary Color', 'shopora-premium-commerce'),
        ),
        'secondary_color' => array(
            'default' => '#a855f7',
            'label' => __('Secondary Color', 'shopora-premium-commerce'),
        ),
        'accent_color' => array(
            'default' => '#f59e0b',
            'label' => __('Accent Color', 'shopora-premium-commerce'),
        ),
        'text_color' => array(
            'default' => '#1e293b',
            'label' => __('Text Color', 'shopora-premium-commerce'),
        ),
        'background_color' => array(
            'default' => '#ffffff',
            'label' => __('Background Color', 'shopora-premium-commerce'),
        ),
        'header_background_color' => array(
            'default' => '#ffffff',
            'label' => __('Header Background Color', 'shopora-premium-commerce'),
        ),
        'footer_background_color' => array(
            'default' => '#1e293b',
            'label' => __('Footer Background Color', 'shopora-premium-commerce'),
        ),
    );

    foreach ($color_settings as $setting_id => $setting) {
        $wp_customize->add_setting($setting_id, array(
            'default'           => $setting['default'],
            'sanitize_callback' => 'sanitize_hex_color',
        ));

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $setting_id, array(
            'label'    => $setting['label'],
            'section'  => 'shopora_primary_colors',
        )));
    }

    // Typography Panel
    $wp_customize->add_panel('shopora_typography', array(
        'title'    => __('Typography', 'shopora-premium-commerce'),
        'priority' => 35,
    ));

    // Font Family Section
    $wp_customize->add_section('shopora_font_families', array(
        'title'    => __('Font Families', 'shopora-premium-commerce'),
        'panel'    => 'shopora_typography',
    ));

    $google_fonts = array(
        'inherit' => __('Default', 'shopora-premium-commerce'),
        'Inter' => 'Inter',
        'Roboto' => 'Roboto',
        'Open Sans' => 'Open Sans',
        'Lato' => 'Lato',
        'Montserrat' => 'Montserrat',
        'Poppins' => 'Poppins',
        'Nunito' => 'Nunito',
        'Source Sans Pro' => 'Source Sans Pro',
        'Playfair Display' => 'Playfair Display',
        'Merriweather' => 'Merriweather',
        'Oswald' => 'Oswald',
        'Raleway' => 'Raleway',
        'Ubuntu' => 'Ubuntu',
        'Work Sans' => 'Work Sans',
    );

    $wp_customize->add_setting('heading_font_family', array(
        'default'           => 'Inter',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('heading_font_family', array(
        'label'    => __('Heading Font Family', 'shopora-premium-commerce'),
        'section'  => 'shopora_font_families',
        'type'     => 'select',
        'choices'  => $google_fonts,
    ));

    $wp_customize->add_setting('body_font_family', array(
        'default'           => 'Inter',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('body_font_family', array(
        'label'    => __('Body Font Family', 'shopora-premium-commerce'),
        'section'  => 'shopora_font_families',
        'type'     => 'select',
        'choices'  => $google_fonts,
    ));

    // Font Sizes Section
    $wp_customize->add_section('shopora_font_sizes', array(
        'title'    => __('Font Sizes', 'shopora-premium-commerce'),
        'panel'    => 'shopora_typography',
    ));

    $wp_customize->add_setting('base_font_size', array(
        'default'           => '16',
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('base_font_size', array(
        'label'    => __('Base Font Size (px)', 'shopora-premium-commerce'),
        'section'  => 'shopora_font_sizes',
        'type'     => 'range',
        'input_attrs' => array('min' => 12, 'max' => 24, 'step' => 1),
    ));

    // Button Styles Section
    $wp_customize->add_section('shopora_button_styles', array(
        'title'    => __('Button Styles', 'shopora-premium-commerce'),
        'panel'    => 'shopora_colors',
        'priority' => 20,
    ));

    $wp_customize->add_setting('button_style', array(
        'default'           => 'rounded',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('button_style', array(
        'label'    => __('Button Style', 'shopora-premium-commerce'),
        'section'  => 'shopora_button_styles',
        'type'     => 'select',
        'choices'  => array(
            'rounded' => __('Rounded', 'shopora-premium-commerce'),
            'square' => __('Square', 'shopora-premium-commerce'),
            'pill' => __('Pill Shape', 'shopora-premium-commerce'),
        ),
    ));

    $wp_customize->add_setting('button_border_radius', array(
        'default'           => '8',
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('button_border_radius', array(
        'label'    => __('Button Border Radius (px)', 'shopora-premium-commerce'),
        'section'  => 'shopora_button_styles',
        'type'     => 'range',
        'input_attrs' => array('min' => 0, 'max' => 50, 'step' => 1),
    ));

    $wp_customize->add_setting('button_hover_color', array(
        'default'           => '#a855f7',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'button_hover_color', array(
        'label'    => __('Button Hover Color', 'shopora-premium-commerce'),
        'section'  => 'shopora_button_styles',
    )));

    // Layout Settings
    $wp_customize->add_section('shopora_layout', array(
        'title'    => __('Layout Settings', 'shopora-premium-commerce'),
        'priority' => 40,
    ));

    $wp_customize->add_setting('shop_products_per_row', array(
        'default'           => '6',
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('shop_products_per_row', array(
        'label'    => __('Shop Products Per Row (Desktop)', 'shopora-premium-commerce'),
        'section'  => 'shopora_layout',
        'type'     => 'select',
        'choices'  => array(
            '3' => '3',
            '4' => '4',
            '5' => '5',
            '6' => '6',
        ),
    ));

    $wp_customize->add_setting('sidebar_show_shop', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ));

    $wp_customize->add_control('sidebar_show_shop', array(
        'label'    => __('Show Sidebar on Shop Pages', 'shopora-premium-commerce'),
        'section'  => 'shopora_layout',
        'type'     => 'checkbox',
    ));

    $wp_customize->add_setting('sidebar_show_blog', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ));

    $wp_customize->add_control('sidebar_show_blog', array(
        'label'    => __('Show Sidebar on Blog Pages', 'shopora-premium-commerce'),
        'section'  => 'shopora_layout',
        'type'     => 'checkbox',
    ));

    // Footer Panel
    $wp_customize->add_panel('shopora_footer', array(
        'title'    => __('Footer Settings', 'shopora-premium-commerce'),
        'priority' => 50,
    ));

    // Footer Content Section
    $wp_customize->add_section('shopora_footer_content', array(
        'title'    => __('Footer Content', 'shopora-premium-commerce'),
        'panel'    => 'shopora_footer',
    ));

    $wp_customize->add_setting('footer_copyright', array(
        'default'           => '© 2024 Premium Commerce. All rights reserved.',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('footer_copyright', array(
        'label'    => __('Copyright Text', 'shopora-premium-commerce'),
        'section'  => 'shopora_footer_content',
        'type'     => 'text',
    ));

    $wp_customize->add_setting('footer_text', array(
        'default'           => 'Your trusted partner for premium products and exceptional customer service.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('footer_text', array(
        'label'    => __('Footer Description', 'shopora-premium-commerce'),
        'section'  => 'shopora_footer_content',
        'type'     => 'textarea',
    ));

    // Contact Information Section
    $wp_customize->add_section('shopora_contact_info', array(
        'title'    => __('Contact Information', 'shopora-premium-commerce'),
        'panel'    => 'shopora_footer',
    ));

    $contact_fields = array(
        'contact_phone' => array(
            'default' => '+1 (555) 123-4567',
            'label' => __('Phone Number', 'shopora-premium-commerce'),
        ),
        'contact_email' => array(
            'default' => 'hello@premiumcommerce.com',
            'label' => __('Email Address', 'shopora-premium-commerce'),
        ),
        'contact_address' => array(
            'default' => '123 Business Ave, Suite 100, City, State 12345',
            'label' => __('Address', 'shopora-premium-commerce'),
        ),
    );

    foreach ($contact_fields as $field_id => $field) {
        $wp_customize->add_setting($field_id, array(
            'default'           => $field['default'],
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_control($field_id, array(
            'label'    => $field['label'],
            'section'  => 'shopora_contact_info',
            'type'     => 'text',
        ));
    }

    // Social Media Section
    $wp_customize->add_section('shopora_social', array(
        'title'    => __('Social Media', 'shopora-premium-commerce'),
        'panel'    => 'shopora_footer',
    ));

    $social_networks = array(
        'facebook' => 'Facebook',
        'twitter' => 'Twitter',
        'instagram' => 'Instagram',
        'linkedin' => 'LinkedIn',
        'youtube' => 'YouTube',
        'pinterest' => 'Pinterest',
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

    // Homepage Settings
    $wp_customize->add_section('shopora_homepage', array(
        'title'    => __('Homepage Settings', 'shopora-premium-commerce'),
        'priority' => 45,
    ));

    $wp_customize->add_setting('hero_enable', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ));

    $wp_customize->add_control('hero_enable', array(
        'label'    => __('Enable Hero Section', 'shopora-premium-commerce'),
        'section'  => 'shopora_homepage',
        'type'     => 'checkbox',
    ));

    $wp_customize->add_setting('hero_title', array(
        'default'           => 'Premium Products for Modern Living',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('hero_title', array(
        'label'    => __('Hero Title', 'shopora-premium-commerce'),
        'section'  => 'shopora_homepage',
        'type'     => 'text',
    ));

    $wp_customize->add_setting('hero_description', array(
        'default'           => 'Discover our curated collection of high-quality products designed to enhance your lifestyle.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('hero_description', array(
        'label'    => __('Hero Description', 'shopora-premium-commerce'),
        'section'  => 'shopora_homepage',
        'type'     => 'textarea',
    ));

    $wp_customize->add_setting('hero_background_image', array(
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'hero_background_image', array(
        'label'    => __('Hero Background Image', 'shopora-premium-commerce'),
        'section'  => 'shopora_homepage',
    )));

    // Blog Settings
    $wp_customize->add_section('shopora_blog', array(
        'title'    => __('Blog Settings', 'shopora-premium-commerce'),
        'priority' => 50,
    ));

    $wp_customize->add_setting('blog_layout', array(
        'default'           => 'grid',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('blog_layout', array(
        'label'    => __('Blog Layout', 'shopora-premium-commerce'),
        'section'  => 'shopora_blog',
        'type'     => 'select',
        'choices'  => array(
            'grid' => __('Grid Layout', 'shopora-premium-commerce'),
            'list' => __('List Layout', 'shopora-premium-commerce'),
            'masonry' => __('Masonry Layout', 'shopora-premium-commerce'),
        ),
    ));

    $wp_customize->add_setting('posts_per_page_blog', array(
        'default'           => 9,
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('posts_per_page_blog', array(
        'label'    => __('Posts Per Page', 'shopora-premium-commerce'),
        'section'  => 'shopora_blog',
        'type'     => 'number',
        'input_attrs' => array('min' => 3, 'max' => 20),
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
    $text_color = get_theme_mod('text_color', '#1e293b');
    $background_color = get_theme_mod('background_color', '#ffffff');
    $heading_font = get_theme_mod('heading_font_family', 'Inter');
    $body_font = get_theme_mod('body_font_family', 'Inter');
    $button_radius = get_theme_mod('button_border_radius', 8);

    ?>
    <style type="text/css" id="shopora-custom-styles">
        :root {
            --primary-color: <?php echo esc_attr($primary_color); ?>;
            --secondary-color: <?php echo esc_attr($secondary_color); ?>;
            --accent-color: <?php echo esc_attr($accent_color); ?>;
            --text-color: <?php echo esc_attr($text_color); ?>;
            --background-color: <?php echo esc_attr($background_color); ?>;
            --heading-font: '<?php echo esc_attr($heading_font); ?>', sans-serif;
            --body-font: '<?php echo esc_attr($body_font); ?>', sans-serif;
            --button-border-radius: <?php echo esc_attr($button_radius); ?>px;
        }

        .btn {
            border-radius: var(--button-border-radius);
        }
    </style>
    <?php
}
add_action('wp_head', 'shopora_custom_styles', 999);

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
    } elseif (is_page()) {
        return get_theme_mod('sidebar_show_page', false) && is_active_sidebar('sidebar-1');
    }

    return is_active_sidebar('sidebar-1');
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
 * WooCommerce setup and modifications
 */
if (class_exists('WooCommerce')) {

    /**
     * WooCommerce theme setup
     */
    function shopora_woocommerce_setup() {
        add_theme_support('woocommerce', array(
            'thumbnail_image_width' => 400,
            'single_image_width'    => 600,
            'product_grid'          => array(
                'default_rows'    => 3,
                'min_rows'        => 2,
                'max_rows'        => 8,
                'default_columns' => 6,
                'min_columns'     => 2,
                'max_columns'     => 6,
            ),
        ));

        // Remove default WooCommerce styles
        add_filter('woocommerce_enqueue_styles', '__return_empty_array');

        // Modify products per page
        add_filter('loop_shop_per_page', function() {
            return get_theme_mod('products_per_page', 18);
        });

        // Remove default actions and add custom ones
        remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
        remove_action('woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10);

        // Add custom shop toolbar
        add_action('woocommerce_before_shop_loop', 'shopora_shop_toolbar', 20);

        // Remove and replace related products
        remove_action('woocommerce_output_related_products', 'woocommerce_output_related_products', 20);
    }
    add_action('after_setup_theme', 'shopora_woocommerce_setup');

    /**
     * Custom shop toolbar
     */
    function shopora_shop_toolbar() {
        ?>
        <div class="shop-toolbar">
            <div class="toolbar-left">
                <?php woocommerce_result_count(); ?>
            </div>
            <div class="toolbar-right">
                <?php woocommerce_catalog_ordering(); ?>
            </div>
        </div>
        <?php
    }
}

/**
 * Include additional files
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Add theme update checker (for premium themes)
 */
function shopora_check_for_updates() {
    // Theme update logic would go here
    // This is where you'd implement automatic updates for premium themes
}

/**
 * Optimize theme performance
 */
function shopora_optimize_performance() {
    // Remove unnecessary WordPress features
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'rsd_link');

    // Remove emoji scripts
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');

    // Defer non-critical CSS
    add_filter('style_loader_tag', 'shopora_defer_non_critical_css', 10, 2);
}
add_action('init', 'shopora_optimize_performance');

/**
 * Defer non-critical CSS
 */
function shopora_defer_non_critical_css($tag, $handle) {
    $defer_styles = array('font-awesome');

    if (in_array($handle, $defer_styles)) {
        return str_replace('rel=\'stylesheet\'', 'rel=\'preload\' as=\'style\' onload=\'this.onload=null;this.rel="stylesheet"\'', $tag);
    }

    return $tag;
}

/**
 * Add schema markup for SEO
 */
function shopora_add_schema_markup() {
    if (is_home() || is_front_page()) {
        echo '<script type="application/ld+json">' . wp_json_encode(array(
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            'name' => get_bloginfo('name'),
            'description' => get_bloginfo('description'),
            'url' => home_url('/'),
        )) . '</script>';
    }
}
add_action('wp_head', 'shopora_add_schema_markup');
?>