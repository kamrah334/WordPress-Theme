<?php
/**
 * The template for displaying all single posts
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
                <?php get_template_part('template-parts/content', get_post_type()); ?>

                <?php
                the_post_navigation(array(
                    'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous:', 'shopora-premium-commerce') . '</span> <span class="nav-title">%title</span>',
                    'next_text' => '<span class="nav-subtitle">' . esc_html__('Next:', 'shopora-premium-commerce') . '</span> <span class="nav-title">%title</span>',
                ));
                ?>

                <?php
                // If comments are open or we have at least one comment, load up the comment template.
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
                ?>

            <?php endwhile; ?>
        </div>

        <?php get_sidebar(); ?>
    </div>
</main>

<?php
get_footer();
?>
