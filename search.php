
<?php
/**
 * The template for displaying search results pages
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
                    <h1 class="page-title">
                        <?php
                        printf(
                            esc_html__('Search Results for: %s', 'shopora-premium-commerce'),
                            '<span>' . get_search_query() . '</span>'
                        );
                        ?>
                    </h1>
                </header>

                <div class="posts-grid">
                    <?php while (have_posts()) : ?>
                        <?php the_post(); ?>
                        <?php get_template_part('template-parts/content', 'search'); ?>
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
