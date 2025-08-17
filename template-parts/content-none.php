
<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @package Shopora_Premium_Commerce
 */
?>

<section class="no-results not-found">
    <header class="page-header">
        <h1 class="page-title"><?php esc_html_e('Nothing here', 'shopora-premium-commerce'); ?></h1>
    </header>

    <div class="page-content">
        <?php if (is_home() && current_user_can('publish_posts')) : ?>
            <p><?php
            printf(
                wp_kses(
                    __('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'shopora-premium-commerce'),
                    array(
                        'a' => array(
                            'href' => array(),
                        ),
                    )
                ),
                esc_url(admin_url('post-new.php'))
            );
            ?></p>

        <?php elseif (is_search()) : ?>
            <p><?php esc_html_e('It seems we can\'t find what you\'re looking for. Perhaps searching can help.', 'shopora-premium-commerce'); ?></p>
            <?php get_search_form(); ?>

        <?php else : ?>
            <p><?php esc_html_e('It seems we can\'t find what you\'re looking for. Perhaps searching can help.', 'shopora-premium-commerce'); ?></p>
            <?php get_search_form(); ?>

        <?php endif; ?>
    </div>
</section>
