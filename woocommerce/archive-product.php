
<?php
/**
 * WooCommerce Shop Page Template
 */

get_header('shop'); ?>

<div class="bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        <!-- Shop Header -->
        <header class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                <?php woocommerce_page_title(); ?>
            </h1>
            <?php if (category_description()) : ?>
                <div class="text-xl text-gray-600 max-w-2xl mx-auto">
                    <?php echo category_description(); ?>
                </div>
            <?php endif; ?>
        </header>

        <div class="flex flex-col lg:flex-row gap-8">
            
            <!-- Sidebar -->
            <?php if (is_active_sidebar('shop-sidebar')) : ?>
                <aside class="w-full lg:w-80 xl:w-96">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 sticky top-24">
                        <?php dynamic_sidebar('shop-sidebar'); ?>
                    </div>
                </aside>
            <?php endif; ?>

            <!-- Main Content -->
            <div class="flex-1">
                <?php if (woocommerce_product_loop()) : ?>

                    <!-- Shop Toolbar -->
                    <div class="flex flex-col sm:flex-row justify-between items-center mb-8 p-4 bg-white rounded-xl shadow-sm border border-gray-100">
                        <div class="mb-4 sm:mb-0">
                            <?php woocommerce_result_count(); ?>
                        </div>
                        <div>
                            <?php woocommerce_catalog_ordering(); ?>
                        </div>
                    </div>

                    <!-- Products Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        <?php
                        woocommerce_product_loop_start();

                        if (wc_get_loop_prop('is_shortcode')) {
                            $columns = absint(wc_get_loop_prop('columns'));
                        }

                        while (have_posts()) :
                            the_post();
                            ?>
                            <div class="product-item card card-hover">
                                <div class="product-image aspect-w-1 aspect-h-1 overflow-hidden rounded-t-xl">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php woocommerce_template_loop_product_thumbnail(); ?>
                                    </a>
                                </div>
                                
                                <div class="product-info p-4">
                                    <h3 class="product-title text-lg font-semibold text-gray-900 mb-2 hover:text-purple-600 transition-colors">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h3>
                                    
                                    <div class="product-price text-xl font-bold text-purple-600 mb-3">
                                        <?php woocommerce_template_loop_price(); ?>
                                    </div>
                                    
                                    <div class="product-rating mb-3">
                                        <?php woocommerce_template_loop_rating(); ?>
                                    </div>
                                    
                                    <div class="product-actions">
                                        <?php woocommerce_template_loop_add_to_cart(); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>

                        <?php woocommerce_product_loop_end(); ?>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-12">
                        <?php woocommerce_pagination(); ?>
                    </div>

                <?php else : ?>
                    <!-- No Products Found -->
                    <div class="text-center py-16 bg-white rounded-xl shadow-sm border border-gray-100">
                        <div class="mb-6">
                            <i class="fas fa-shopping-bag text-6xl text-gray-300"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">
                            <?php esc_html_e('No products found', 'shopora-premium-commerce'); ?>
                        </h2>
                        <p class="text-gray-600 mb-6">
                            <?php esc_html_e('Sorry, but no products were found matching your selection.', 'shopora-premium-commerce'); ?>
                        </p>
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="btn-primary">
                            <?php esc_html_e('Continue Shopping', 'shopora-premium-commerce'); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer('shop'); ?>
