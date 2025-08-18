
<?php get_header(); ?>

<div class="bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        <!-- Page Header -->
        <?php if (is_home() && !is_front_page()) : ?>
            <header class="text-center mb-12">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    <?php single_post_title(); ?>
                </h1>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    <?php esc_html_e('Discover our latest stories, insights, and updates', 'shopora-premium-commerce'); ?>
                </p>
            </header>
        <?php endif; ?>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Main Content -->
            <div class="flex-1">
                <?php if (have_posts()) : ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                        <?php while (have_posts()) : the_post(); ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class('card card-hover fade-in'); ?>>
                                
                                <!-- Featured Image -->
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="aspect-w-16 aspect-h-9 overflow-hidden rounded-t-xl">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('shopora-blog-grid', array('class' => 'w-full h-48 object-cover hover:scale-105 transition-transform duration-300')); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>

                                <!-- Post Content -->
                                <div class="p-6">
                                    <!-- Post Meta -->
                                    <div class="flex items-center text-sm text-gray-500 mb-3">
                                        <time class="flex items-center">
                                            <i class="fas fa-calendar-alt mr-2"></i>
                                            <?php echo get_the_date(); ?>
                                        </time>
                                        <span class="mx-2">•</span>
                                        <span class="flex items-center">
                                            <i class="fas fa-user mr-2"></i>
                                            <?php the_author(); ?>
                                        </span>
                                    </div>

                                    <!-- Post Title -->
                                    <h2 class="text-xl font-bold text-gray-900 mb-3 hover:text-purple-600 transition-colors">
                                        <a href="<?php the_permalink(); ?>" class="block">
                                            <?php the_title(); ?>
                                        </a>
                                    </h2>

                                    <!-- Post Excerpt -->
                                    <div class="text-gray-600 mb-4 line-clamp-3">
                                        <?php the_excerpt(); ?>
                                    </div>

                                    <!-- Post Categories -->
                                    <?php if (has_category()) : ?>
                                        <div class="flex flex-wrap gap-2 mb-4">
                                            <?php foreach (get_the_category() as $category) : ?>
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                                    <?php echo esc_html($category->name); ?>
                                                </span>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>

                                    <!-- Read More Button -->
                                    <a href="<?php the_permalink(); ?>" class="inline-flex items-center text-purple-600 hover:text-purple-700 font-semibold transition-colors">
                                        <?php esc_html_e('Read More', 'shopora-premium-commerce'); ?>
                                        <i class="fas fa-arrow-right ml-2"></i>
                                    </a>
                                </div>
                            </article>
                        <?php endwhile; ?>
                    </div>

                    <!-- Pagination -->
                    <?php shopora_posts_pagination(); ?>

                <?php else : ?>
                    <!-- No Posts Found -->
                    <div class="text-center py-16">
                        <div class="mb-6">
                            <i class="fas fa-search text-6xl text-gray-300"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">
                            <?php esc_html_e('No posts found', 'shopora-premium-commerce'); ?>
                        </h2>
                        <p class="text-gray-600 mb-6">
                            <?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with different keywords.', 'shopora-premium-commerce'); ?>
                        </p>
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="btn-primary">
                            <?php esc_html_e('Back to Home', 'shopora-premium-commerce'); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Sidebar -->
            <?php if (shopora_show_sidebar()) : ?>
                <aside class="w-full lg:w-80 xl:w-96">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 sticky top-24">
                        <?php get_sidebar(); ?>
                    </div>
                </aside>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
