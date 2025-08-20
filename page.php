
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
<?php get_header(); ?>

<div class="bg-gray-50 min-h-screen pt-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Page Title</h1>
            <p class="text-lg text-gray-600">This is a generic page template for your WordPress theme.</p>
        </div>

        <!-- Page Content -->
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <div class="prose max-w-none">
                <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                    This is the default page template. You can customize this content based on your needs.
                    The page supports rich content including images, videos, and formatted text.
                </p>

                <h2 class="text-3xl font-bold text-gray-900 mb-4">Section Heading</h2>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt 
                    ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation 
                    ullamco laboris nisi ut aliquip ex ea commodo consequat.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 my-8">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Feature 1</h3>
                        <p class="text-gray-600">Description of feature or content block goes here.</p>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Feature 2</h3>
                        <p class="text-gray-600">Description of feature or content block goes here.</p>
                    </div>
                </div>

                <h3 class="text-2xl font-bold text-gray-900 mb-4">Call to Action</h3>
                <p class="text-gray-600 mb-6">
                    Ready to get started? Contact us today or explore our products.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="/contact" class="bg-purple-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-purple-700 transition-colors text-center">
                        Contact Us
                    </a>
                    <a href="/shop" class="border-2 border-purple-600 text-purple-600 px-6 py-3 rounded-lg font-semibold hover:bg-purple-600 hover:text-white transition-colors text-center">
                        Browse Products
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
