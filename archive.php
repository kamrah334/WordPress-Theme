<?php
/**
 * The template for displaying archive pages
 *
 * @package Shopora_Premium_Commerce
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <div class="content-area">
            <?php if (have_posts()) : ?>

                <header class="page-header">
                    <?php
                    the_archive_title('<h1 class="page-title">', '</h1>');
                    the_archive_description('<div class="archive-description">', '</div>');
                    ?>
                </header>

                <div class="posts-grid">
                    <?php while (have_posts()) : ?>
                        <?php the_post(); ?>
                        <?php get_template_part('template-parts/content', get_post_type()); ?>
                    <?php endwhile; ?>
                </div>

                <?php
                the_posts_navigation(array(
                    'prev_text' => __('Older posts', 'shopora-premium-commerce'),
                    'next_text' => __('Newer posts', 'shopora-premium-commerce'),
                ));
                ?>

            <?php else : ?>
                <?php get_template_part('template-parts/content', 'none'); ?>
            <?php endif; ?>
        </div>

        <?php get_sidebar(); ?>
    </div>
</main>

<?php
get_footer();
?>

