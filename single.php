
<?php get_header(); ?>

<div class="bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden'); ?>>
                
                <!-- Featured Image -->
                <?php if (has_post_thumbnail()) : ?>
                    <div class="aspect-w-16 aspect-h-9">
                        <?php the_post_thumbnail('shopora-featured', array('class' => 'w-full h-64 md:h-96 object-cover')); ?>
                    </div>
                <?php endif; ?>

                <!-- Post Header -->
                <header class="p-8">
                    <!-- Post Meta -->
                    <div class="flex flex-wrap items-center text-sm text-gray-500 mb-4">
                        <time class="flex items-center mr-6">
                            <i class="fas fa-calendar-alt mr-2"></i>
                            <?php echo get_the_date(); ?>
                        </time>
                        <span class="flex items-center mr-6">
                            <i class="fas fa-user mr-2"></i>
                            <?php the_author(); ?>
                        </span>
                        <?php if (has_category()) : ?>
                            <span class="flex items-center">
                                <i class="fas fa-folder mr-2"></i>
                                <?php the_category(', '); ?>
                            </span>
                        <?php endif; ?>
                    </div>

                    <!-- Post Title -->
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 leading-tight">
                        <?php the_title(); ?>
                    </h1>
                </header>

                <!-- Post Content -->
                <div class="px-8 pb-8">
                    <div class="prose prose-lg max-w-none">
                        <?php
                        the_content();

                        wp_link_pages(array(
                            'before' => '<div class="flex justify-center mt-8"><nav class="flex space-x-2">',
                            'after'  => '</nav></div>',
                            'link_before' => '<span class="px-3 py-2 bg-gray-100 rounded-lg hover:bg-purple-100 transition-colors">',
                            'link_after' => '</span>',
                        ));
                        ?>
                    </div>

                    <!-- Post Tags -->
                    <?php if (has_tag()) : ?>
                        <div class="mt-8 pt-8 border-t border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                <i class="fas fa-tags mr-2"></i>
                                <?php esc_html_e('Tags', 'shopora-premium-commerce'); ?>
                            </h3>
                            <div class="flex flex-wrap gap-2">
                                <?php foreach (get_the_tags() as $tag) : ?>
                                    <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" 
                                       class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-700 hover:bg-purple-100 hover:text-purple-700 transition-colors">
                                        <?php echo esc_html($tag->name); ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </article>

            <!-- Post Navigation -->
            <nav class="mt-8">
                <?php
                $prev_post = get_previous_post();
                $next_post = get_next_post();
                ?>
                
                <?php if ($prev_post || $next_post) : ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <?php if ($prev_post) : ?>
                            <a href="<?php echo esc_url(get_permalink($prev_post)); ?>" 
                               class="block bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-lg transition-shadow group">
                                <div class="text-sm text-gray-500 mb-2">
                                    <i class="fas fa-chevron-left mr-2"></i>
                                    <?php esc_html_e('Previous Post', 'shopora-premium-commerce'); ?>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 group-hover:text-purple-600 transition-colors">
                                    <?php echo esc_html(get_the_title($prev_post)); ?>
                                </h3>
                            </a>
                        <?php endif; ?>
                        
                        <?php if ($next_post) : ?>
                            <a href="<?php echo esc_url(get_permalink($next_post)); ?>" 
                               class="block bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-lg transition-shadow group text-right">
                                <div class="text-sm text-gray-500 mb-2">
                                    <?php esc_html_e('Next Post', 'shopora-premium-commerce'); ?>
                                    <i class="fas fa-chevron-right ml-2"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 group-hover:text-purple-600 transition-colors">
                                    <?php echo esc_html(get_the_title($next_post)); ?>
                                </h3>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </nav>

            <!-- Comments -->
            <?php if (comments_open() || get_comments_number()) : ?>
                <div class="mt-8 bg-white rounded-xl shadow-sm border border-gray-100 p-8">
                    <?php comments_template(); ?>
                </div>
            <?php endif; ?>

        <?php endwhile; ?>
    </div>
</div>

<?php get_footer(); ?>
