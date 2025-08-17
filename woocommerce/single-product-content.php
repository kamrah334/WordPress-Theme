
<?php
/**
 * Single product content
 *
 * @package Shopora_Premium_Commerce
 */

defined('ABSPATH') || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product_summary.
 */
do_action('woocommerce_before_single_product_summary');
?>

<div class="summary entry-summary">
    <?php
    /**
     * Hook: woocommerce_single_product_summary.
     */
    do_action('woocommerce_single_product_summary');
    ?>
</div>

<?php
/**
 * Hook: woocommerce_after_single_product_summary.
 */
do_action('woocommerce_after_single_product_summary');
?>
