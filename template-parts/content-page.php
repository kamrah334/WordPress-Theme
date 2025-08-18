
<?php
/**
 * Template part for displaying page content
 *
 * @package Shopora_Premium_Commerce
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('page-content fade-in'); ?>>
    <?php if (has_post_thumbnail() && !is_front_page()): ?>
        <div class="page-featured-image">
            <?php shopora_post_thumbnail(); ?>
        </div>
    <?php endif; ?>

    <header class="entry-header">
        <?php if (!is_front_page()): ?>
            <h1 class="entry-title"><?php the_title(); ?></h1>
        <?php endif; ?>
    </header>

    <div class="entry-content">
        <?php
        the_content();

        wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'shopora-premium-commerce'),
            'after'  => '</div>',
        ));
        ?>
    </div>

    <?php if (get_edit_post_link()): ?>
        <footer class="entry-footer">
            <?php
            edit_post_link(
                sprintf(
                    wp_kses(
                        /* translators: %s: Name of current post. Only visible to screen readers */
                        __('Edit <span class="screen-reader-text">"%s"</span>', 'shopora-premium-commerce'),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    wp_kses_post(get_the_title())
                ),
                '<span class="edit-link">',
                '</span>'
            );
            ?>
        </footer>
    <?php endif; ?>
</article>
