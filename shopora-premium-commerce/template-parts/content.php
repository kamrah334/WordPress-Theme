
<?php
/**
 * Template part for displaying posts
 *
 * @package Shopora_Premium_Commerce
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('blog-post-card'); ?>>
    
    <?php if (has_post_thumbnail()) : ?>
        <div class="post-thumbnail">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('medium_large', array('class' => 'post-image')); ?>
            </a>
            <div class="post-meta-overlay">
                <time class="post-date" datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                    <i class="fas fa-calendar-alt"></i>
                    <?php echo esc_html(get_the_date()); ?>
                </time>
            </div>
        </div>
    <?php endif; ?>

    <div class="post-content">
        <div class="post-meta">
            <span class="post-category">
                <?php
                $categories = get_the_category();
                if (!empty($categories)) {
                    echo '<a href="' . esc_url(get_category_link($categories[0]->term_id)) . '" class="category-link">';
                    echo '<i class="fas fa-tag"></i> ' . esc_html($categories[0]->name);
                    echo '</a>';
                }
                ?>
            </span>
            <span class="post-author">
                <i class="fas fa-user"></i>
                <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                    <?php the_author(); ?>
                </a>
            </span>
        </div>

        <header class="entry-header">
            <?php
            if (is_singular()) :
                the_title('<h1 class="entry-title">', '</h1>');
            else :
                the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
            endif;
            ?>
        </header>

        <div class="entry-content">
            <?php
            if (is_singular()) :
                the_content();
            else :
                the_excerpt();
            endif;
            
            wp_link_pages(array(
                'before' => '<div class="page-links">' . esc_html__('Pages:', 'shopora-premium-commerce'),
                'after'  => '</div>',
            ));
            ?>
        </div>

        <?php if (!is_singular()) : ?>
            <footer class="entry-footer">
                <a href="<?php the_permalink(); ?>" class="read-more-btn">
                    <?php esc_html_e('Read More', 'shopora-premium-commerce'); ?>
                    <i class="fas fa-arrow-right"></i>
                </a>
                
                <div class="post-stats">
                    <?php if (comments_open() || get_comments_number()) : ?>
                        <span class="comments-count">
                            <i class="fas fa-comments"></i>
                            <?php comments_number('0', '1', '%'); ?>
                        </span>
                    <?php endif; ?>
                </div>
            </footer>
        <?php endif; ?>
    </div>

</article>
