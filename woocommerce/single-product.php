
<?php
/**
 * WooCommerce Single Product Template
 */

get_header('shop'); ?>

<div class="bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        <?php while (have_posts()) : the_post(); ?>
            
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                
                <!-- Product Gallery and Info -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 p-8">
                    
                    <!-- Product Images -->
                    <div class="product-gallery">
                        <div class="aspect-w-1 aspect-h-1 bg-gray-100 rounded-lg overflow-hidden mb-4">
                            <?php woocommerce_show_product_images(); ?>
                        </div>
                        <div class="grid grid-cols-4 gap-2">
                            <?php woocommerce_output_product_data_tabs(); ?>
                        </div>
                    </div>
                    
                    <!-- Product Info -->
                    <div class="product-summary">
                        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                            <?php the_title(); ?>
                        </h1>
                        
                        <div class="product-rating mb-4">
                            <?php woocommerce_template_single_rating(); ?>
                        </div>
                        
                        <div class="product-price text-3xl font-bold text-purple-600 mb-6">
                            <?php woocommerce_template_single_price(); ?>
                        </div>
                        
                        <div class="product-excerpt text-gray-600 mb-6">
                            <?php woocommerce_template_single_excerpt(); ?>
                        </div>
                        
                        <form class="cart mb-8" action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>" method="post" enctype='multipart/form-data'>
                            <?php woocommerce_template_single_add_to_cart(); ?>
                        </form>
                        
                        <div class="product-meta text-sm text-gray-500">
                            <?php woocommerce_template_single_meta(); ?>
                        </div>
                        
                        <div class="product-sharing mt-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-3">
                                <?php esc_html_e('Share this product', 'shopora-premium-commerce'); ?>
                            </h3>
                            <div class="flex space-x-3">
                                <a href="#" class="w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="w-10 h-10 bg-blue-400 text-white rounded-full flex items-center justify-center hover:bg-blue-500 transition-colors">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="w-10 h-10 bg-pink-600 text-white rounded-full flex items-center justify-center hover:bg-pink-700 transition-colors">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Product Tabs -->
                <div class="border-t border-gray-200 p-8">
                    <?php woocommerce_output_product_data_tabs(); ?>
                </div>
            </div>
            
            <!-- Related Products -->
            <div class="mt-12">
                <h2 class="text-2xl font-bold text-gray-900 mb-8 text-center">
                    <?php esc_html_e('Related Products', 'shopora-premium-commerce'); ?>
                </h2>
                <?php woocommerce_output_related_products(); ?>
            </div>
            
        <?php endwhile; ?>
    </div>
</div>

<?php get_footer('shop'); ?>
