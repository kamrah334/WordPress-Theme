<?php
/**
 * Template part for displaying posts
 *
 * @package Shopora_Premium_Commerce
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('blog-card fade-in'); ?>>
    <?php if (has_post_thumbnail()): ?>
        <div class="blog-card-image">
            <?php shopora_post_thumbnail(); ?>
        </div>
    <?php endif; ?>

    <div class="blog-card-content">
        <header class="entry-header">
            <?php shopora_entry_categories(); ?>

            <?php if (is_singular()): ?>
                <h1 class="entry-title"><?php the_title(); ?></h1>
            <?php else: ?>
                <h3 class="entry-title">
                    <a href="<?php the_permalink(); ?>" rel="bookmark">
                        <?php the_title(); ?>
                    </a>
                </h3>
            <?php endif; ?>

            <?php if ('post' === get_post_type()): ?>
                <div class="entry-meta">
                    <?php shopora_post_meta(); ?>
                    <?php if (is_singular()): ?>
                        <?php shopora_display_reading_time(); ?>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </header>

        <div class="entry-content">
            <?php
            if (is_singular()) {
                the_content(sprintf(
                    wp_kses(
                        /* translators: %s: Name of current post. Only visible to screen readers */
                        __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'shopora-premium-commerce'),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    wp_kses_post(get_the_title())
                ));

                wp_link_pages(array(
                    'before' => '<div class="page-links">' . esc_html__('Pages:', 'shopora-premium-commerce'),
                    'after'  => '</div>',
                ));
            } else {
                the_excerpt();
                echo '<a href="' . esc_url(get_permalink()) . '" class="btn btn-primary btn-small">';
                echo esc_html__('Read More', 'shopora-premium-commerce');
                echo '</a>';
            }
            ?>
        </div>

        <?php if (is_singular()): ?>
            <footer class="entry-footer">
                <?php shopora_entry_tags(); ?>
            </footer>
        <?php endif; ?>
    </div>
</article>