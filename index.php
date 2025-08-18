
<?php
// Bootstrap WordPress if not already loaded
if (!defined('ABSPATH')) {
    // Try to find WordPress installation
    $wp_load_paths = [
        __DIR__ . '/wp-load.php',
        __DIR__ . '/../wp-load.php',
        __DIR__ . '/../../wp-load.php',
        __DIR__ . '/../../../wp-load.php',
    ];
    
    $wp_loaded = false;
    foreach ($wp_load_paths as $path) {
        if (file_exists($path)) {
            require_once($path);
            $wp_loaded = true;
            break;
        }
    }
    
    // If WordPress not found, create a minimal environment
    if (!$wp_loaded) {
        // Define basic WordPress constants
        define('ABSPATH', __DIR__ . '/');
        define('WP_DEBUG', true);
        define('WP_DEBUG_LOG', true);
        
        // Create minimal WordPress functions for theme development
        if (!function_exists('get_header')) {
            function get_header($name = null) {
                $header_file = $name ? "header-{$name}.php" : 'header.php';
                if (file_exists(__DIR__ . '/' . $header_file)) {
                    include __DIR__ . '/' . $header_file;
                }
            }
        }
        
        if (!function_exists('get_footer')) {
            function get_footer($name = null) {
                $footer_file = $name ? "footer-{$name}.php" : 'footer.php';
                if (file_exists(__DIR__ . '/' . $footer_file)) {
                    include __DIR__ . '/' . $footer_file;
                }
            }
        }
        
        if (!function_exists('get_sidebar')) {
            function get_sidebar($name = null) {
                $sidebar_file = $name ? "sidebar-{$name}.php" : 'sidebar.php';
                if (file_exists(__DIR__ . '/' . $sidebar_file)) {
                    include __DIR__ . '/' . $sidebar_file;
                }
            }
        }
        
        if (!function_exists('wp_head')) {
            function wp_head() {
                echo '<link rel="stylesheet" href="/assets/css/main.css">';
                echo '<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>';
                echo '<script src="/assets/js/main.js"></script>';
            }
        }
        
        if (!function_exists('wp_footer')) {
            function wp_footer() {
                // Basic footer scripts
            }
        }
        
        if (!function_exists('body_class')) {
            function body_class($class = '') {
                echo 'class="' . esc_attr($class) . '"';
            }
        }
        
        if (!function_exists('language_attributes')) {
            function language_attributes() {
                echo 'lang="en-US"';
            }
        }
        
        if (!function_exists('bloginfo')) {
            function bloginfo($show) {
                switch ($show) {
                    case 'charset':
                        echo 'UTF-8';
                        break;
                    case 'name':
                        echo 'Shopora Premium Commerce';
                        break;
                    case 'description':
                        echo 'Premium WordPress Theme';
                        break;
                }
            }
        }
        
        if (!function_exists('wp_body_open')) {
            function wp_body_open() {
                // Body open hook
            }
        }
        
        if (!function_exists('esc_html_e')) {
            function esc_html_e($text, $domain = '') {
                echo htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
            }
        }
        
        if (!function_exists('esc_url')) {
            function esc_url($url) {
                return htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
            }
        }
        
        if (!function_exists('home_url')) {
            function home_url($path = '') {
                return 'http://localhost:5000' . $path;
            }
        }
        
        if (!function_exists('get_template_directory_uri')) {
            function get_template_directory_uri() {
                return '';
            }
        }
        
        if (!function_exists('have_posts')) {
            function have_posts() {
                return true; // For demo purposes
            }
        }
        
        if (!function_exists('the_post')) {
            function the_post() {
                // Demo post data
            }
        }
        
        if (!function_exists('get_the_ID')) {
            function get_the_ID() {
                return 1;
            }
        }
        
        if (!function_exists('post_class')) {
            function post_class($class = '') {
                echo 'class="post ' . esc_attr($class) . '"';
            }
        }
        
        if (!function_exists('has_post_thumbnail')) {
            function has_post_thumbnail() {
                return false;
            }
        }
        
        if (!function_exists('the_permalink')) {
            function the_permalink() {
                echo '#';
            }
        }
        
        if (!function_exists('get_the_date')) {
            function get_the_date() {
                return date('F j, Y');
            }
        }
        
        if (!function_exists('the_author')) {
            function the_author() {
                echo 'Demo Author';
            }
        }
        
        if (!function_exists('the_title')) {
            function the_title() {
                echo 'Demo Post Title';
            }
        }
        
        if (!function_exists('the_excerpt')) {
            function the_excerpt() {
                echo 'This is a demo excerpt for the blog post. It shows how the theme will look with actual content.';
            }
        }
        
        if (!function_exists('has_category')) {
            function has_category() {
                return true;
            }
        }
        
        if (!function_exists('get_the_category')) {
            function get_the_category() {
                return [
                    (object) ['name' => 'WordPress'],
                    (object) ['name' => 'Design']
                ];
            }
        }
        
        if (!function_exists('esc_html')) {
            function esc_html($text) {
                return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
            }
        }
        
        if (!function_exists('shopora_show_sidebar')) {
            function shopora_show_sidebar() {
                return true;
            }
        }
        
        if (!function_exists('shopora_posts_pagination')) {
            function shopora_posts_pagination() {
                echo '<nav class="posts-pagination mt-8">
                    <div class="flex justify-center space-x-2">
                        <a href="#" class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors">1</a>
                        <a href="#" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">2</a>
                        <a href="#" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">3</a>
                    </div>
                </nav>';
            }
        }
        
        if (!function_exists('is_home')) {
            function is_home() {
                return true;
            }
        }
        
        if (!function_exists('is_front_page')) {
            function is_front_page() {
                return false;
            }
        }
        
        if (!function_exists('single_post_title')) {
            function single_post_title() {
                echo 'Latest Posts';
            }
        }
    }
}

get_header(); ?>

<div class="bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        <!-- Page Header -->
        <?php if (is_home() && !is_front_page()) : ?>
            <header class="text-center mb-12">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    <?php single_post_title(); ?>
                </h1>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    <?php esc_html_e('Discover our latest stories, insights, and updates', 'shopora-premium-commerce'); ?>
                </p>
            </header>
        <?php endif; ?>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Main Content -->
            <div class="flex-1">
                <?php if (have_posts()) : ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                        <?php 
                        // Demo posts for development
                        for ($i = 1; $i <= 6; $i++) : 
                        ?>
                            <article id="post-<?php echo $i; ?>" class="card card-hover fade-in bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition-all duration-300">
                                
                                <!-- Featured Image -->
                                <div class="aspect-w-16 aspect-h-9 overflow-hidden">
                                    <div class="w-full h-48 bg-gradient-to-br from-purple-400 to-purple-600 flex items-center justify-center">
                                        <i class="fas fa-image text-white text-3xl"></i>
                                    </div>
                                </div>

                                <!-- Post Content -->
                                <div class="p-6">
                                    <!-- Post Meta -->
                                    <div class="flex items-center text-sm text-gray-500 mb-3">
                                        <time class="flex items-center">
                                            <i class="fas fa-calendar-alt mr-2"></i>
                                            <?php echo get_the_date(); ?>
                                        </time>
                                        <span class="mx-2">•</span>
                                        <span class="flex items-center">
                                            <i class="fas fa-user mr-2"></i>
                                            Demo Author
                                        </span>
                                    </div>

                                    <!-- Post Title -->
                                    <h2 class="text-xl font-bold text-gray-900 mb-3 hover:text-purple-600 transition-colors">
                                        <a href="#" class="block">
                                            Demo Post Title <?php echo $i; ?>
                                        </a>
                                    </h2>

                                    <!-- Post Excerpt -->
                                    <div class="text-gray-600 mb-4 line-clamp-3">
                                        This is a demo excerpt for blog post <?php echo $i; ?>. It shows how the theme will look with actual WordPress content and demonstrates the responsive design.
                                    </div>

                                    <!-- Post Categories -->
                                    <div class="flex flex-wrap gap-2 mb-4">
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                            WordPress
                                        </span>
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                            Design
                                        </span>
                                    </div>

                                    <!-- Read More Button -->
                                    <a href="#" class="inline-flex items-center text-purple-600 hover:text-purple-700 font-semibold transition-colors">
                                        Read More
                                        <i class="fas fa-arrow-right ml-2"></i>
                                    </a>
                                </div>
                            </article>
                        <?php endfor; ?>
                    </div>

                    <!-- Pagination -->
                    <?php shopora_posts_pagination(); ?>

                <?php else : ?>
                    <!-- No Posts Found -->
                    <div class="text-center py-16">
                        <div class="mb-6">
                            <i class="fas fa-search text-6xl text-gray-300"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">
                            No posts found
                        </h2>
                        <p class="text-gray-600 mb-6">
                            Sorry, but nothing matched your search terms. Please try again with different keywords.
                        </p>
                        <a href="/" class="btn-primary inline-flex items-center px-6 py-3 bg-purple-600 text-white font-semibold rounded-lg hover:bg-purple-700 transition-colors">
                            Back to Home
                        </a>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Sidebar -->
            <?php if (shopora_show_sidebar()) : ?>
                <aside class="w-full lg:w-80 xl:w-96">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 sticky top-24">
                        <?php get_sidebar(); ?>
                    </div>
                </aside>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
