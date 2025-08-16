<?php
/**
 * Template part for displaying posts
 *
 * @package Shopora_Premium_Commerce
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-card'); ?>>
    <header class="entry-header">
        <?php if (has_post_thumbnail()) : ?>
            <div class="post-thumbnail">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('medium_large'); ?>
                </a>
            </div>
        <?php endif; ?>

        <?php
        if (is_singular()) :
            the_title('<h1 class="entry-title">', '</h1>');
        else :
            the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
        endif;
        ?>

        <?php if ('post' === get_post_type()) : ?>
            <div class="entry-meta">
                <?php
                shopora_posted_on();
                shopora_posted_by();
                ?>
            </div>
        <?php endif; ?>
    </header>

    <div class="entry-content">
        <?php
        if (is_singular()) {
            the_content(sprintf(
                wp_kses(
                    __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'shopora-premium-commerce'),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                get_the_title()
            ));

            wp_link_pages(array(
                'before' => '<div class="page-links">' . esc_html__('Pages:', 'shopora-premium-commerce'),
                'after'  => '</div>',
            ));
        } else {
            the_excerpt();
            echo '<a href="' . esc_url(get_permalink()) . '" class="read-more">' . esc_html__('Read More', 'shopora-premium-commerce') . '</a>';
        }
        ?>
    </div>

    <footer class="entry-footer">
        <?php shopora_entry_footer(); ?>
    </footer>
</article>
