
<?php
/**
 * The template for displaying archive pages
 *
 * @package Shopora_Premium_Commerce
 */

get_header(); ?>

<div class="blog-container">
    <div class="container">
        <header class="page-header">
            <?php
            the_archive_title('<h1 class="page-title">', '</h1>');
            $description = shopora_get_archive_description();
            if ($description) {
                echo '<div class="archive-description">' . wp_kses_post($description) . '</div>';
            }
            ?>
        </header>

        <div class="blog-layout <?php echo shopora_show_sidebar() ? 'has-sidebar' : 'no-sidebar'; ?>">
            <?php if (shopora_show_sidebar()) : ?>
                <aside class="blog-sidebar">
                    <?php get_sidebar(); ?>
                </aside>
            <?php endif; ?>

            <div class="blog-main">
                <?php if (have_posts()) : ?>
                    <div class="blog-grid">
                        <?php while (have_posts()) : the_post(); ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class('blog-card'); ?>>
                                <?php shopora_post_thumbnail(); ?>
                                
                                <div class="blog-card-content">
                                    <header class="entry-header">
                                        <?php the_title(sprintf('<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h3>'); ?>
                                        
                                        <div class="entry-meta blog-meta">
                                            <?php
                                            shopora_posted_on();
                                            shopora_posted_by();
                                            shopora_display_reading_time();
                                            ?>
                                        </div>
                                    </header>

                                    <div class="entry-summary excerpt">
                                        <?php the_excerpt(); ?>
                                    </div>

                                    <footer class="entry-footer">
                                        <a href="<?php the_permalink(); ?>" class="btn btn-primary read-more">
                                            <?php esc_html_e('Read More', 'shopora-premium-commerce'); ?>
                                            <i class="fas fa-arrow-right"></i>
                                        </a>
                                    </footer>
                                </div>
                            </article>
                        <?php endwhile; ?>
                    </div>

                    <?php shopora_pagination(); ?>

                <?php else : ?>
                    <?php get_template_part('template-parts/content', 'none'); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
?>
