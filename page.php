<?php
/**
 * The template for displaying all pages
 *
 * @package Shopora_Premium_Commerce
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <div class="content-area">
            <?php while (have_posts()) : ?>
                <?php the_post(); ?>
                <?php get_template_part('template-parts/content', 'page'); ?>

                <?php
                // If comments are open or we have at least one comment, load up the comment template.
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
                ?>

            <?php endwhile; ?>
        </div>

        <?php if (shopora_show_sidebar()) : ?>
            <?php get_sidebar(); ?>
        <?php endif; ?>
    </div>
</main>

<?php
get_footer();
?>
