
<?php
/**
 * The sidebar containing the main widget area
 *
 * @package Shopora_Premium_Commerce
 */

if (!is_active_sidebar('sidebar-1')) {
    return;
}
?>

<div class="sidebar-content space-y-8">
    <?php dynamic_sidebar('sidebar-1'); ?>
    
    <!-- Default Sidebar Content if no widgets -->
    <?php if (!dynamic_sidebar('sidebar-1')) : ?>
        
        <!-- Search Widget -->
        <div class="widget">
            <h3 class="widget-title text-xl font-semibold mb-4 text-gray-900">
                <?php esc_html_e('Search', 'shopora-premium-commerce'); ?>
            </h3>
            <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="flex">
                <input type="search" 
                       class="flex-1 px-4 py-2 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent" 
                       placeholder="<?php esc_attr_e('Search...', 'shopora-premium-commerce'); ?>" 
                       value="<?php echo get_search_query(); ?>" 
                       name="s">
                <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded-r-lg hover:bg-purple-700 transition-colors">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>

        <!-- Recent Posts Widget -->
        <div class="widget">
            <h3 class="widget-title text-xl font-semibold mb-4 text-gray-900">
                <?php esc_html_e('Recent Posts', 'shopora-premium-commerce'); ?>
            </h3>
            <div class="space-y-4">
                <?php
                $recent_posts = wp_get_recent_posts(array(
                    'numberposts' => 5,
                    'post_status' => 'publish'
                ));
                
                foreach ($recent_posts as $post) :
                ?>
                    <div class="flex space-x-3">
                        <?php if (has_post_thumbnail($post['ID'])) : ?>
                            <div class="flex-shrink-0">
                                <a href="<?php echo esc_url(get_permalink($post['ID'])); ?>">
                                    <?php echo get_the_post_thumbnail($post['ID'], array(60, 60), array('class' => 'w-15 h-15 object-cover rounded-lg')); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        <div class="flex-1 min-w-0">
                            <h4 class="text-sm font-medium text-gray-900 hover:text-purple-600 transition-colors">
                                <a href="<?php echo esc_url(get_permalink($post['ID'])); ?>">
                                    <?php echo esc_html($post['post_title']); ?>
                                </a>
                            </h4>
                            <p class="text-xs text-gray-500 mt-1">
                                <?php echo get_the_date('M j, Y', $post['ID']); ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Categories Widget -->
        <div class="widget">
            <h3 class="widget-title text-xl font-semibold mb-4 text-gray-900">
                <?php esc_html_e('Categories', 'shopora-premium-commerce'); ?>
            </h3>
            <div class="space-y-2">
                <?php
                $categories = get_categories(array('hide_empty' => true));
                foreach ($categories as $category) :
                ?>
                    <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" 
                       class="flex items-center justify-between p-2 rounded-lg hover:bg-gray-50 transition-colors group">
                        <span class="text-gray-700 group-hover:text-purple-600 transition-colors">
                            <?php echo esc_html($category->name); ?>
                        </span>
                        <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-full">
                            <?php echo esc_html($category->count); ?>
                        </span>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Tags Widget -->
        <?php
        $tags = get_tags(array('hide_empty' => true, 'number' => 20));
        if ($tags) :
        ?>
            <div class="widget">
                <h3 class="widget-title text-xl font-semibold mb-4 text-gray-900">
                    <?php esc_html_e('Tags', 'shopora-premium-commerce'); ?>
                </h3>
                <div class="flex flex-wrap gap-2">
                    <?php foreach ($tags as $tag) : ?>
                        <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" 
                           class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-700 hover:bg-purple-100 hover:text-purple-700 transition-colors">
                            <?php echo esc_html($tag->name); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

    <?php endif; ?>
</div>
