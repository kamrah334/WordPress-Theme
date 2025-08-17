<?php
/**
 * The main template file
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
                    <?php if (is_home() && !is_front_page()) : ?>
                        <h1 class="page-title"><?php single_post_title(); ?></h1>
                    <?php elseif (is_search()) : ?>
                        <h1 class="page-title">
                            <?php printf(__('Search Results for: %s', 'shopora-premium-commerce'), '<span>' . get_search_query() . '</span>'); ?>
                        </h1>
                    <?php elseif (is_archive()) : ?>
                        <h1 class="page-title"><?php the_archive_title(); ?></h1>
                        <?php the_archive_description('<div class="archive-description">', '</div>'); ?>
                    <?php endif; ?>
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
<?php
/**
 * The main template file
 *
 * @package Shopora_Premium_Commerce
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <div class="content-area">
            <?php if (have_posts()) : ?>

                <?php if (is_home() && !is_front_page()) : ?>
                    <header class="page-header">
                        <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
                    </header>
                <?php endif; ?>

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

        <?php if (shopora_show_sidebar()) : ?>
            <?php get_sidebar(); ?>
        <?php endif; ?>
    </div>
</main>

<?php
get_footer();
?>
