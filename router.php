
<?php
/**
 * Simple router for theme development
 */

class ThemeRouter {
    private $routes = [];
    
    public function __construct() {
        $this->setupRoutes();
    }
    
    private function setupRoutes() {
        $this->routes = [
            '/' => 'front-page.php',
            '/shop' => 'woocommerce/archive-product.php',
            '/product' => 'woocommerce/single-product.php',
            '/about' => 'page-about.php',
            '/blog' => 'archive.php',
            '/contact' => 'page.php'
        ];
    }
    
    public function route($uri) {
        // Clean the URI
        $uri = parse_url($uri, PHP_URL_PATH);
        $uri = rtrim($uri, '/');
        if (empty($uri)) $uri = '/';
        
        // Check for product page pattern
        if (preg_match('/^\/product\/(.+)$/', $uri)) {
            return $this->loadTemplate('woocommerce/single-product.php');
        }
        
        // Check for exact matches
        if (isset($this->routes[$uri])) {
            return $this->loadTemplate($this->routes[$uri]);
        }
        
        // Default to front page
        return $this->loadTemplate('front-page.php');
    }
    
    private function loadTemplate($template) {
        $templatePath = __DIR__ . '/' . $template;
        if (file_exists($templatePath)) {
            include $templatePath;
            return true;
        }
        
        // Fallback to index template
        if (file_exists(__DIR__ . '/front-page.php')) {
            include __DIR__ . '/front-page.php';
            return true;
        }
        
        return false;
    }
}

// Initialize router
$router = new ThemeRouter();
$router->route($_SERVER['REQUEST_URI'] ?? '/');
?>
