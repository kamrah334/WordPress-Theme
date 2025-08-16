<?php
/**
 * The Template for displaying all single products
 *
 * @package Shopora_Premium_Commerce
 */

defined('ABSPATH') || exit;

get_header('shop'); ?>

<div class="single-product-container">
    <div class="container">
        
        <?php
        /**
         * Hook: woocommerce_before_main_content.
         *
         * @hooked woocommerce_breadcrumb - 20
         */
        do_action('woocommerce_before_main_content');
        ?>

        <?php while (have_posts()) : ?>
            <?php the_post(); ?>
            <?php global $product; ?>

            <div class="product-details">
                
                <?php
                /**
                 * Hook: woocommerce_before_single_product.
                 *
                 * @hooked woocommerce_output_all_notices - 10
                 */
                do_action('woocommerce_before_single_product');

                if (post_password_required()) {
                    echo get_the_password_form();
                    return;
                }
                ?>

                <div id="product-<?php the_ID(); ?>" <?php wc_product_class('', $product); ?>>

                    <div class="product-gallery">
                        <?php
                        /**
                         * Hook: woocommerce_before_single_product_summary.
                         *
                         * @hooked woocommerce_show_product_sale_flash - 10
                         * @hooked woocommerce_show_product_images - 20
                         */
                        do_action('woocommerce_before_single_product_summary');
                        ?>
                        
                        <!-- Trust Badges -->
                        <div class="product-trust-badges">
                            <div class="trust-badge">
                                <i class="fas fa-shipping-fast"></i>
                                <span>Free Shipping</span>
                            </div>
                            <div class="trust-badge">
                                <i class="fas fa-undo-alt"></i>
                                <span>30-Day Returns</span>
                            </div>
                            <div class="trust-badge">
                                <i class="fas fa-shield-alt"></i>
                                <span>2 Year Warranty</span>
                            </div>
                        </div>
                    </div>

                    <div class="product-summary">
                        <?php
                        /**
                         * Hook: woocommerce_single_product_summary.
                         *
                         * @hooked woocommerce_template_single_title - 5
                         * @hooked woocommerce_template_single_rating - 10
                         * @hooked woocommerce_template_single_price - 10
                         * @hooked woocommerce_template_single_excerpt - 20
                         * @hooked woocommerce_template_single_add_to_cart - 30
                         * @hooked woocommerce_template_single_meta - 40
                         * @hooked woocommerce_template_single_sharing - 50
                         * @hooked WC_Structured_Data::generate_product_data() - 60
                         */
                        do_action('woocommerce_single_product_summary');
                        ?>
                        
                        <!-- Product Features -->
                        <div class="product-features">
                            <h4><i class="fas fa-star"></i> Key Features</h4>
                            <ul>
                                <li><i class="fas fa-check"></i> Premium Quality Materials</li>
                                <li><i class="fas fa-check"></i> Advanced Technology</li>
                                <li><i class="fas fa-check"></i> Sleek Modern Design</li>
                                <li><i class="fas fa-check"></i> User-Friendly Interface</li>
                            </ul>
                        </div>
                        
                        <!-- Security Badges -->
                        <div class="security-badges">
                            <div class="security-badge">
                                <i class="fas fa-lock"></i>
                                <span>Secure Payment</span>
                            </div>
                            <div class="security-badge">
                                <i class="fas fa-credit-card"></i>
                                <span>All Cards Accepted</span>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="product-tabs-section">
                    <?php
                    /**
                     * Hook: woocommerce_after_single_product_summary.
                     *
                     * @hooked woocommerce_output_product_data_tabs - 10
                     * @hooked woocommerce_upsell_display - 15
                     * @hooked woocommerce_output_related_products - 20
                     */
                    do_action('woocommerce_after_single_product_summary');
                    ?>
                </div>

            </div>

        <?php endwhile; ?>

    </div>
</div>

<?php
get_footer('shop');
?>
