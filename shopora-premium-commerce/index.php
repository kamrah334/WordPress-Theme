<?php
/**
 * The main template file
 *
 * @package Shopora_Premium_Commerce
 */

get_header();
?>

<main id="primary" class="site-main blog-page">
    <div class="container">

        <header class="page-header">
            <div class="page-header-content">
                <?php if (is_home() && !is_front_page()) : ?>
                    <h1 class="page-title"><?php single_post_title(); ?></h1>
                <?php elseif (is_search()) : ?>
                    <h1 class="page-title">
                        <?php printf(esc_html__('Search Results for: %s', 'shopora-premium-commerce'), '<span>' . get_search_query() . '</span>'); ?>
                    </h1>
                <?php elseif (is_archive()) : ?>
                    <h1 class="page-title"><?php the_archive_title(); ?></h1>
                    <?php the_archive_description('<div class="archive-description">', '</div>'); ?>
                <?php else : ?>
                    <h1 class="page-title"><?php esc_html_e('Latest Posts', 'shopora-premium-commerce'); ?></h1>
                    <p class="page-description"><?php esc_html_e('Stay updated with our latest news and insights', 'shopora-premium-commerce'); ?></p>
                <?php endif; ?>
            </div>
        </header>

        <div class="blog-layout <?php echo shopora_show_sidebar() ? 'has-sidebar' : 'no-sidebar'; ?>">
            <?php if (shopora_show_sidebar()) : ?>
                <aside class="blog-sidebar">
                    <?php get_sidebar(); ?>
                </aside>
            <?php endif; ?>

            <div class="blog-main">
                <?php if (have_posts()) : ?>

                    <div class="posts-grid <?php echo esc_attr(get_theme_mod('blog_layout', 'grid')); ?>" data-columns="<?php echo esc_attr(get_theme_mod('blog_columns', 3)); ?>">
                        <?php
                        while (have_posts()) :
                            the_post();
                            get_template_part('template-parts/content', get_post_type());
                        endwhile;
                        ?>
                    </div>

                    <?php the_posts_navigation(array(
                        'prev_text' => '<i class="fas fa-arrow-left"></i> ' . esc_html__('Older posts', 'shopora-premium-commerce'),
                        'next_text' => esc_html__('Newer posts', 'shopora-premium-commerce') . ' <i class="fas fa-arrow-right"></i>',
                    )); ?>

                <?php else : ?>
                    <?php get_template_part('template-parts/content', 'none'); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>

<?php
get_footer();
?>