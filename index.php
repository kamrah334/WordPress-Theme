<?php get_header(); ?>

<main class="main-content">
    <div class="container">
        <?php if (is_home() && !is_front_page()) : ?>
            <header class="page-header">
                <h1 class="page-title"><?php single_post_title(); ?></h1>
            </header>
        <?php endif; ?>

        <div class="content-layout <?php echo shopora_show_sidebar() ? 'has-sidebar' : 'no-sidebar'; ?>">
            <div class="content-area">
                <?php if (have_posts()) : ?>
                    <div class="posts-grid">
                        <?php while (have_posts()) : the_post(); ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class('post-card fade-in'); ?>>
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="post-thumbnail">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('shopora-blog-grid'); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>

                                <div class="post-content">
                                    <header class="post-header">
                                        <h2 class="post-title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h2>

                                        <div class="post-meta">
                                            <span class="post-date">
                                                <i class="fas fa-calendar"></i>
                                                <?php echo get_the_date(); ?>
                                            </span>
                                            <span class="post-author">
                                                <i class="fas fa-user"></i>
                                                <?php the_author(); ?>
                                            </span>
                                            <?php if (has_category()) : ?>
                                                <span class="post-category">
                                                    <i class="fas fa-folder"></i>
                                                    <?php the_category(', '); ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </header>

                                    <div class="post-excerpt">
                                        <?php the_excerpt(); ?>
                                    </div>

                                    <div class="post-footer">
                                        <a href="<?php the_permalink(); ?>" class="btn btn-primary">
                                            <?php esc_html_e('Read More', 'shopora-premium-commerce'); ?>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        <?php endwhile; ?>
                    </div>

                    <?php shopora_posts_pagination(); ?>

                <?php else : ?>
                    <?php get_template_part('template-parts/content', 'none'); ?>
                <?php endif; ?>
            </div>

            <?php if (shopora_show_sidebar()) : ?>
                <aside class="sidebar">
                    <?php get_sidebar(); ?>
                </aside>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>