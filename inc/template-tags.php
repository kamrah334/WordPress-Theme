
<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Shopora_Premium_Commerce
 */

if (!function_exists('shopora_posted_on')):
/**
 * Prints HTML with meta information for the current post-date/time.
 */
function shopora_posted_on() {
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    if (get_the_time('U') !== get_the_modified_time('U')) {
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
    }

    $time_string = sprintf($time_string,
        esc_attr(get_the_date(DATE_W3C)),
        esc_html(get_the_date()),
        esc_attr(get_the_modified_date(DATE_W3C)),
        esc_html(get_the_modified_date())
    );

    $posted_on = sprintf(
        /* translators: %s: post date. */
        esc_html_x('Posted on %s', 'post date', 'shopora-premium-commerce'),
        '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
    );

    echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}
endif;

if (!function_exists('shopora_posted_by')):
/**
 * Prints HTML with meta information for the current author.
 */
function shopora_posted_by() {
    $byline = sprintf(
        /* translators: %s: post author. */
        esc_html_x('by %s', 'post author', 'shopora-premium-commerce'),
        '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
    );

    echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}
endif;

if (!function_exists('shopora_entry_footer')):
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function shopora_entry_footer() {
    // Hide category and tag text for pages.
    if ('post' === get_post_type()) {
        /* translators: used between list items, there is a space after the comma */
        $categories_list = get_the_category_list(esc_html__(', ', 'shopora-premium-commerce'));
        if ($categories_list) {
            /* translators: 1: list of categories. */
            printf('<span class="cat-links">' . esc_html__('Posted in %1$s', 'shopora-premium-commerce') . '</span>', $categories_list); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        }

        /* translators: used between list items, there is a space after the comma */
        $tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'shopora-premium-commerce'));
        if ($tags_list) {
            /* translators: 1: list of tags. */
            printf('<span class="tags-links">' . esc_html__('Tagged %1$s', 'shopora-premium-commerce') . '</span>', $tags_list); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        }
    }

    if (!is_single() && !post_password_required() && (comments_open() || get_comments_number())) {
        echo '<span class="comments-link">';
        comments_popup_link(
            sprintf(
                wp_kses(
                    /* translators: %s: post title */
                    __('Leave a Comment<span class="screen-reader-text"> on %s</span>', 'shopora-premium-commerce'),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                wp_kses_post(get_the_title())
            )
        );
        echo '</span>';
    }

    edit_post_link(
        sprintf(
            wp_kses(
                /* translators: %s: Name of current post. Only visible to screen readers */
                __('Edit <span class="screen-reader-text">%s</span>', 'shopora-premium-commerce'),
                array(
                    'span' => array(
                        'class' => array(),
                    ),
                )
            ),
            wp_kses_post(get_the_title())
        ),
        '<span class="edit-link">',
        '</span>'
    );
}
endif;

if (!function_exists('shopora_post_thumbnail')):
/**
 * Displays an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 */
function shopora_post_thumbnail() {
    if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
        return;
    }

    if (is_singular()):
        ?>
        <div class="post-thumbnail">
            <?php the_post_thumbnail('shopora-featured', array('class' => 'featured-image')); ?>
        </div><!-- .post-thumbnail -->
    <?php else: ?>
        <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
            <?php
            the_post_thumbnail('shopora-blog-grid', array(
                'alt' => the_title_attribute(array(
                    'echo' => false,
                )),
                'class' => 'featured-image'
            ));
            ?>
        </a>
        <?php
    endif; // End is_singular().
}
endif;

if (!function_exists('shopora_get_social_links')):
/**
 * Get social media links from customizer
 */
function shopora_get_social_links() {
    $social_networks = array(
        'facebook' => array(
            'icon' => 'fab fa-facebook-f',
            'label' => __('Facebook', 'shopora-premium-commerce')
        ),
        'twitter' => array(
            'icon' => 'fab fa-twitter',
            'label' => __('Twitter', 'shopora-premium-commerce')
        ),
        'instagram' => array(
            'icon' => 'fab fa-instagram',
            'label' => __('Instagram', 'shopora-premium-commerce')
        ),
        'linkedin' => array(
            'icon' => 'fab fa-linkedin-in',
            'label' => __('LinkedIn', 'shopora-premium-commerce')
        ),
        'youtube' => array(
            'icon' => 'fab fa-youtube',
            'label' => __('YouTube', 'shopora-premium-commerce')
        ),
        'pinterest' => array(
            'icon' => 'fab fa-pinterest',
            'label' => __('Pinterest', 'shopora-premium-commerce')
        ),
    );
    
    $links = array();
    
    foreach ($social_networks as $network => $data) {
        $url = get_theme_mod("social_{$network}");
        if ($url) {
            $links[$network] = array(
                'url' => esc_url($url),
                'icon' => $data['icon'],
                'label' => $data['label']
            );
        }
    }
    
    return $links;
}
endif;

if (!function_exists('shopora_display_social_links')):
/**
 * Display social media links
 */
function shopora_display_social_links($class = 'social-links') {
    $social_links = shopora_get_social_links();
    
    if (empty($social_links)) {
        return;
    }
    
    echo '<div class="' . esc_attr($class) . '">';
    
    foreach ($social_links as $network => $data) {
        printf(
            '<a href="%s" target="_blank" rel="noopener noreferrer" aria-label="%s" class="social-link social-link-%s">
                <i class="%s" aria-hidden="true"></i>
            </a>',
            $data['url'],
            $data['label'],
            esc_attr($network),
            esc_attr($data['icon'])
        );
    }
    
    echo '</div>';
}
endif;

if (!function_exists('shopora_get_reading_time')):
/**
 * Calculate estimated reading time for a post
 */
function shopora_get_reading_time($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    $content = get_post_field('post_content', $post_id);
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200); // Average reading speed of 200 words per minute
    
    return $reading_time;
}
endif;

if (!function_exists('shopora_display_reading_time')):
/**
 * Display estimated reading time
 */
function shopora_display_reading_time($post_id = null) {
    $reading_time = shopora_get_reading_time($post_id);
    
    printf(
        '<span class="reading-time">
            <i class="fas fa-clock" aria-hidden="true"></i>
            %s %s
        </span>',
        $reading_time,
        _n('min read', 'mins read', $reading_time, 'shopora-premium-commerce')
    );
}
endif;

if (!function_exists('shopora_breadcrumbs')):
/**
 * Display breadcrumbs
 */
function shopora_breadcrumbs() {
    if (is_front_page()) {
        return;
    }
    
    $breadcrumbs = array();
    
    // Home link
    $breadcrumbs[] = array(
        'title' => __('Home', 'shopora-premium-commerce'),
        'url' => home_url('/')
    );
    
    if (is_category() || is_single()) {
        $category = get_the_category();
        if ($category) {
            $breadcrumbs[] = array(
                'title' => $category[0]->name,
                'url' => get_category_link($category[0]->term_id)
            );
        }
    }
    
    if (is_single()) {
        $breadcrumbs[] = array(
            'title' => get_the_title(),
            'url' => ''
        );
    } elseif (is_page()) {
        $breadcrumbs[] = array(
            'title' => get_the_title(),
            'url' => ''
        );
    } elseif (is_archive()) {
        $breadcrumbs[] = array(
            'title' => get_the_archive_title(),
            'url' => ''
        );
    } elseif (is_search()) {
        $breadcrumbs[] = array(
            'title' => sprintf(__('Search Results for: %s', 'shopora-premium-commerce'), get_search_query()),
            'url' => ''
        );
    }
    
    if (empty($breadcrumbs)) {
        return;
    }
    
    echo '<nav class="breadcrumbs" aria-label="' . esc_attr__('Breadcrumb', 'shopora-premium-commerce') . '">';
    echo '<ol class="breadcrumb-list">';
    
    foreach ($breadcrumbs as $index => $breadcrumb) {
        $is_last = ($index === count($breadcrumbs) - 1);
        
        echo '<li class="breadcrumb-item' . ($is_last ? ' active' : '') . '">';
        
        if (!$is_last && !empty($breadcrumb['url'])) {
            printf('<a href="%s">%s</a>', esc_url($breadcrumb['url']), esc_html($breadcrumb['title']));
        } else {
            echo esc_html($breadcrumb['title']);
        }
        
        echo '</li>';
        
        if (!$is_last) {
            echo '<li class="breadcrumb-separator" aria-hidden="true">/</li>';
        }
    }
    
    echo '</ol>';
    echo '</nav>';
}
endif;

if (!function_exists('shopora_get_featured_posts')):
/**
 * Get featured posts
 */
function shopora_get_featured_posts($limit = 3) {
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => $limit,
        'meta_query' => array(
            array(
                'key' => '_shopora_featured_post',
                'value' => 'yes',
                'compare' => '='
            )
        )
    );
    
    return new WP_Query($args);
}
endif;

if (!function_exists('shopora_pagination')):
/**
 * Display numeric pagination
 */
function shopora_pagination() {
    global $wp_query;
    
    $total_pages = $wp_query->max_num_pages;
    
    if ($total_pages > 1) {
        $current_page = max(1, get_query_var('paged'));
        
        echo '<nav class="pagination-nav" aria-label="' . esc_attr__('Posts navigation', 'shopora-premium-commerce') . '">';
        
        echo paginate_links(array(
            'base' => get_pagenum_link(1) . '%_%',
            'format' => 'page/%#%/',
            'current' => $current_page,
            'total' => $total_pages,
            'prev_text' => '<i class="fas fa-chevron-left"></i> ' . __('Previous', 'shopora-premium-commerce'),
            'next_text' => __('Next', 'shopora-premium-commerce') . ' <i class="fas fa-chevron-right"></i>',
            'type' => 'list',
            'end_size' => 2,
            'mid_size' => 1,
        ));
        
        echo '</nav>';
    }
}
endif;

if (!function_exists('shopora_get_related_posts')):
/**
 * Get related posts based on categories
 */
function shopora_get_related_posts($post_id = null, $limit = 3) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    $categories = wp_get_post_categories($post_id);
    
    if (empty($categories)) {
        return new WP_Query();
    }
    
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => $limit,
        'post__not_in' => array($post_id),
        'category__in' => $categories,
        'orderby' => 'rand'
    );
    
    return new WP_Query($args);
}
endif;

if (!function_exists('shopora_get_post_views')):
/**
 * Get post view count
 */
function shopora_get_post_views($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    $views = get_post_meta($post_id, '_shopora_post_views', true);
    return $views ? intval($views) : 0;
}
endif;

if (!function_exists('shopora_set_post_views')):
/**
 * Set post view count
 */
function shopora_set_post_views($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    $views = shopora_get_post_views($post_id);
    update_post_meta($post_id, '_shopora_post_views', $views + 1);
}
endif;

// Track post views
function shopora_track_post_views() {
    if (is_single() && !is_user_logged_in()) {
        shopora_set_post_views();
    }
}
add_action('wp_head', 'shopora_track_post_views');

if (!function_exists('shopora_get_archive_description')):
/**
 * Get custom archive description
 */
function shopora_get_archive_description() {
    $description = '';
    
    if (is_home()) {
        $description = get_theme_mod('blog_description', __('Read our latest news and insights', 'shopora-premium-commerce'));
    } elseif (is_category()) {
        $description = category_description();
    } elseif (is_tag()) {
        $description = tag_description();
    } elseif (is_author()) {
        $description = get_the_author_meta('description');
    } elseif (is_date()) {
        if (is_year()) {
            $description = sprintf(__('Posts from %s', 'shopora-premium-commerce'), get_the_date('Y'));
        } elseif (is_month()) {
            $description = sprintf(__('Posts from %s', 'shopora-premium-commerce'), get_the_date('F Y'));
        } elseif (is_day()) {
            $description = sprintf(__('Posts from %s', 'shopora-premium-commerce'), get_the_date());
        }
    }
    
    return trim($description);
}
endif;

if (!function_exists('shopora_get_color_scheme')):
/**
 * Get current color scheme
 */
function shopora_get_color_scheme() {
    return get_theme_mod('color_scheme', 'default');
}
endif;

if (!function_exists('shopora_is_dark_mode')):
/**
 * Check if dark mode is enabled
 */
function shopora_is_dark_mode() {
    return get_theme_mod('dark_mode_enable', false);
}
endif;
?>
