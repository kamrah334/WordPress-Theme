
<?php get_header(); ?>

<div class="bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex flex-col lg:flex-row gap-8">
            
            <!-- Main Content -->
            <div class="flex-1">
                <?php while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden'); ?>>
                        
                        <!-- Featured Image -->
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="aspect-w-16 aspect-h-9">
                                <?php the_post_thumbnail('shopora-featured', array('class' => 'w-full h-64 object-cover')); ?>
                            </div>
                        <?php endif; ?>

                        <!-- Page Header -->
                        <header class="p-8 border-b border-gray-100">
                            <h1 class="text-3xl md:text-4xl font-bold text-gray-900">
                                <?php the_title(); ?>
                            </h1>
                        </header>

                        <!-- Page Content -->
                        <div class="p-8">
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
                        </div>

                        <!-- Edit Link -->
                        <?php if (get_edit_post_link()) : ?>
                            <footer class="px-8 pb-8">
                                <div class="border-t border-gray-200 pt-6">
                                    <?php
                                    edit_post_link(
                                        __('Edit Page', 'shopora-premium-commerce'),
                                        '<span class="inline-flex items-center text-sm text-gray-500 hover:text-purple-600 transition-colors">',
                                        ' <i class="fas fa-edit ml-1"></i></span>'
                                    );
                                    ?>
                                </div>
                            </footer>
                        <?php endif; ?>
                    </article>

                    <!-- Comments -->
                    <?php if (comments_open() || get_comments_number()) : ?>
                        <div class="mt-8 bg-white rounded-xl shadow-sm border border-gray-100 p-8">
                            <?php comments_template(); ?>
                        </div>
                    <?php endif; ?>

                <?php endwhile; ?>
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
