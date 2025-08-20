
<?php get_header(); ?>

<div class="bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        <!-- Archive Header -->
        <header class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                <?php the_archive_title(); ?>
            </h1>
            <?php if (get_the_archive_description()) : ?>
                <div class="text-xl text-gray-600 max-w-2xl mx-auto">
                    <?php the_archive_description(); ?>
                </div>
            <?php endif; ?>
        </header>

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
                            <i class="fas fa-folder-open text-6xl text-gray-300"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">
                            <?php esc_html_e('No posts found', 'shopora-premium-commerce'); ?>
                        </h2>
                        <p class="text-gray-600 mb-6">
                            <?php esc_html_e('Sorry, but no posts were found in this archive.', 'shopora-premium-commerce'); ?>
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
<?php get_header(); ?>

<div class="bg-gray-50 min-h-screen pt-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-2">Latest News & Articles</h1>
            <p class="text-lg text-gray-600">Stay updated with our latest insights, tips, and company news</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <main class="lg:col-span-2">
                <div class="space-y-8">
                    <?php
                    // Sample blog posts
                    $blog_posts = [
                        [
                            'title' => '10 Must-Have Tech Gadgets for 2024',
                            'excerpt' => 'Discover the latest tech innovations that will revolutionize your daily life. From smart home devices to cutting-edge wearables.',
                            'image' => 'https://images.unsplash.com/photo-1518717758536-85ae29035b6d?w=600&h=300&fit=crop',
                            'date' => 'March 15, 2024',
                            'author' => 'Tech Team',
                            'category' => 'Technology'
                        ],
                        [
                            'title' => 'The Future of E-commerce: Trends to Watch',
                            'excerpt' => 'Explore the emerging trends shaping the future of online shopping and what they mean for consumers.',
                            'image' => 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=600&h=300&fit=crop',
                            'date' => 'March 10, 2024',
                            'author' => 'Marketing Team',
                            'category' => 'Business'
                        ],
                        [
                            'title' => 'How to Choose the Perfect Headphones',
                            'excerpt' => 'A comprehensive guide to finding the right headphones for your needs, budget, and lifestyle.',
                            'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=600&h=300&fit=crop',
                            'date' => 'March 5, 2024',
                            'author' => 'Product Team',
                            'category' => 'Reviews'
                        ]
                    ];

                    foreach ($blog_posts as $post) :
                    ?>
                    <article class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                        <div class="md:flex">
                            <div class="md:w-1/3">
                                <img src="<?php echo esc_url($post['image']); ?>" 
                                     alt="<?php echo esc_attr($post['title']); ?>" 
                                     class="w-full h-48 md:h-full object-cover">
                            </div>
                            <div class="md:w-2/3 p-6">
                                <div class="flex items-center mb-3">
                                    <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm font-semibold">
                                        <?php echo esc_html($post['category']); ?>
                                    </span>
                                    <span class="ml-4 text-sm text-gray-500"><?php echo esc_html($post['date']); ?></span>
                                </div>
                                <h2 class="text-2xl font-bold text-gray-900 mb-3 hover:text-purple-600 transition-colors">
                                    <a href="/blog/<?php echo sanitize_title($post['title']); ?>"><?php echo esc_html($post['title']); ?></a>
                                </h2>
                                <p class="text-gray-600 mb-4 leading-relaxed"><?php echo esc_html($post['excerpt']); ?></p>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span class="text-sm text-gray-500">By <?php echo esc_html($post['author']); ?></span>
                                    </div>
                                    <a href="/blog/<?php echo sanitize_title($post['title']); ?>" 
                                       class="text-purple-600 hover:text-purple-700 font-semibold">
                                        Read More <i class="fas fa-arrow-right ml-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </article>
                    <?php endforeach; ?>
                </div>

                <!-- Pagination -->
                <div class="mt-12 flex justify-center">
                    <nav class="flex items-center space-x-2">
                        <button class="px-4 py-2 text-gray-500 hover:text-purple-600 transition-colors">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="px-4 py-2 bg-purple-600 text-white rounded-lg">1</button>
                        <button class="px-4 py-2 text-gray-700 hover:text-purple-600 transition-colors">2</button>
                        <button class="px-4 py-2 text-gray-700 hover:text-purple-600 transition-colors">3</button>
                        <button class="px-4 py-2 text-gray-500 hover:text-purple-600 transition-colors">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </nav>
                </div>
            </main>

            <!-- Sidebar -->
            <aside class="space-y-8">
                <!-- Search -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Search</h3>
                    <form class="relative">
                        <input type="text" 
                               placeholder="Search articles..." 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent pr-10">
                        <button type="submit" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-purple-600">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>

                <!-- Categories -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Categories</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-600 hover:text-purple-600 transition-colors">Technology (12)</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-purple-600 transition-colors">Business (8)</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-purple-600 transition-colors">Reviews (15)</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-purple-600 transition-colors">Lifestyle (6)</a></li>
                    </ul>
                </div>

                <!-- Recent Posts -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Recent Posts</h3>
                    <div class="space-y-4">
                        <div class="flex space-x-3">
                            <img src="https://images.unsplash.com/photo-1518717758536-85ae29035b6d?w=60&h=60&fit=crop" 
                                 alt="Recent post" class="w-15 h-15 rounded-lg object-cover flex-shrink-0">
                            <div>
                                <h4 class="text-sm font-semibold text-gray-900 hover:text-purple-600 transition-colors">
                                    <a href="#">Top 5 Gaming Accessories</a>
                                </h4>
                                <p class="text-xs text-gray-500">March 12, 2024</p>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</div>

<?php get_footer(); ?>
