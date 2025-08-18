<?php
/**
 * Custom template tags for this theme
 *
 * @package Shopora_Premium_Commerce
 */

if (!function_exists('shopora_post_thumbnail')):
/**
 * Displays an optional post thumbnail.
 */
function shopora_post_thumbnail() {
    if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
        return;
    }

    if (is_singular()):
        ?>
        <div class="post-thumbnail fade-in">
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

    $social_links = array();

    foreach ($social_networks as $network => $data) {
        $url = get_theme_mod("social_{$network}");
        if ($url) {
            $social_links[$network] = array(
                'url' => esc_url($url),
                'icon' => $data['icon'],
                'label' => $data['label']
            );
        }
    }

    return $social_links;
}
endif;

if (!function_exists('shopora_display_social_links')):
/**
 * Display social media links
 */
function shopora_display_social_links() {
    $social_links = shopora_get_social_links();

    if (empty($social_links)) {
        return;
    }

    echo '<div class="social-links">';
    foreach ($social_links as $network => $data) {
        printf(
            '<a href="%s" target="_blank" rel="noopener noreferrer" class="social-link social-link-%s" aria-label="%s">
                <i class="%s" aria-hidden="true"></i>
            </a>',
            $data['url'],
            esc_attr($network),
            esc_attr($data['label']),
            esc_attr($data['icon'])
        );
    }
    echo '</div>';
}
endif;

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

if (!function_exists('shopora_entry_categories')):
/**
 * Prints HTML with category information for the current post.
 */
function shopora_entry_categories() {
    if ('post' === get_post_type()) {
        $categories_list = get_the_category_list(esc_html__(', ', 'shopora-premium-commerce'));
        if ($categories_list) {
            printf(
                '<span class="cat-links">%1$s</span>',
                $categories_list // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            );
        }
    }
}
endif;

if (!function_exists('shopora_entry_tags')):
/**
 * Prints HTML with tag information for the current post.
 */
function shopora_entry_tags() {
    if ('post' === get_post_type()) {
        $tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'shopora-premium-commerce'));
        if ($tags_list) {
            printf(
                '<span class="tags-links">%1$s %2$s</span>',
                esc_html__('Tagged:', 'shopora-premium-commerce'),
                $tags_list // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            );
        }
    }
}
endif;

if (!function_exists('shopora_post_meta')):
/**
 * Display post meta information
 */
function shopora_post_meta() {
    echo '<div class="blog-meta">';
    echo '<i class="fas fa-calendar-alt"></i>';
    shopora_posted_on();
    echo '<i class="fas fa-user"></i>';
    shopora_posted_by();

    if (get_comments_number() > 0) {
        echo '<i class="fas fa-comments"></i>';
        echo '<a href="' . esc_url(get_comments_link()) . '">';
        printf(
            /* translators: %s: comment count */
            esc_html(_n('%s Comment', '%s Comments', get_comments_number(), 'shopora-premium-commerce')),
            number_format_i18n(get_comments_number())
        );
        echo '</a>';
    }
    echo '</div>';
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

    $delimiter = '<i class="fas fa-chevron-right"></i>';
    $home_title = __('Home', 'shopora-premium-commerce');

    echo '<nav class="breadcrumbs" aria-label="' . esc_attr__('Breadcrumb Navigation', 'shopora-premium-commerce') . '">';
    echo '<div class="container">';
    echo '<a href="' . esc_url(home_url('/')) . '">' . esc_html($home_title) . '</a>';

    if (is_category() || is_single()) {
        echo ' ' . $delimiter . ' ';
        the_category(' ' . $delimiter . ' ');
        if (is_single()) {
            echo ' ' . $delimiter . ' ';
            the_title();
        }
    } elseif (is_page()) {
        echo ' ' . $delimiter . ' ';
        the_title();
    } elseif (is_search()) {
        echo ' ' . $delimiter . ' ';
        printf(__('Search Results for "%s"', 'shopora-premium-commerce'), get_search_query());
    } elseif (is_tag()) {
        echo ' ' . $delimiter . ' ';
        printf(__('Posts Tagged "%s"', 'shopora-premium-commerce'), single_tag_title('', false));
    } elseif (is_author()) {
        echo ' ' . $delimiter . ' ';
        printf(__('Author: %s', 'shopora-premium-commerce'), get_the_author());
    } elseif (is_404()) {
        echo ' ' . $delimiter . ' ';
        _e('Error 404', 'shopora-premium-commerce');
    }

    echo '</div>';
    echo '</nav>';
}
endif;

if (!function_exists('shopora_pagination')):
/**
 * Display pagination
 */
function shopora_pagination() {
    if (is_singular()) {
        return;
    }

    global $wp_query;

    if ($wp_query->max_num_pages <= 1) {
        return;
    }

    $pagination = paginate_links(array(
        'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
        'total' => $wp_query->max_num_pages,
        'current' => max(1, get_query_var('paged')),
        'format' => '?paged=%#%',
        'show_all' => false,
        'type' => 'list',
        'end_size' => 2,
        'mid_size' => 1,
        'prev_next' => true,
        'prev_text' => sprintf('<i class="fas fa-chevron-left"></i> %s', __('Previous', 'shopora-premium-commerce')),
        'next_text' => sprintf('%s <i class="fas fa-chevron-right"></i>', __('Next', 'shopora-premium-commerce')),
        'add_args' => false,
        'add_fragment' => '',
    ));

    if ($pagination) {
        echo '<nav class="pagination-container" aria-label="' . esc_attr__('Posts Navigation', 'shopora-premium-commerce') . '">';
        echo $pagination; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        echo '</nav>';
    }
}
endif;

if (!function_exists('shopora_get_reading_time')):
/**
 * Calculate reading time for a post
 */
function shopora_get_reading_time($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    $content = get_post_field('post_content', $post_id);
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200); // Average reading speed is 200 words per minute

    return $reading_time;
}
endif;

if (!function_exists('shopora_display_reading_time')):
/**
 * Display reading time
 */
function shopora_display_reading_time($post_id = null) {
    $reading_time = shopora_get_reading_time($post_id);

    printf(
        '<span class="reading-time"><i class="fas fa-clock"></i> %s</span>',
        sprintf(
            /* translators: %d: reading time in minutes */
            _n('%d min read', '%d min read', $reading_time, 'shopora-premium-commerce'),
            $reading_time
        )
    );
}
endif;

if (!function_exists('shopora_custom_logo')):
/**
 * Display custom logo with fallback
 */
function shopora_custom_logo() {
    if (has_custom_logo()) {
        the_custom_logo();
    } else {
        echo '<div class="site-branding">';
        echo '<h1 class="site-title"><a href="' . esc_url(home_url('/')) . '">' . esc_html(get_bloginfo('name')) . '</a></h1>';

        $description = get_bloginfo('description', 'display');
        if ($description || is_customize_preview()) {
            echo '<p class="site-description">' . esc_html($description) . '</p>';
        }
        echo '</div>';
    }
}
endif;

if (!function_exists('shopora_post_navigation')):
/**
 * Display post navigation
 */
function shopora_post_navigation() {
    if (!is_single()) {
        return;
    }

    $prev_post = get_previous_post();
    $next_post = get_next_post();

    if (!$prev_post && !$next_post) {
        return;
    }

    echo '<nav class="post-navigation" aria-label="' . esc_attr__('Post Navigation', 'shopora-premium-commerce') . '">';
    echo '<div class="nav-links">';

    if ($prev_post) {
        echo '<div class="nav-previous">';
        echo '<a href="' . esc_url(get_permalink($prev_post)) . '" rel="prev">';
        echo '<span class="nav-subtitle">' . esc_html__('Previous Post', 'shopora-premium-commerce') . '</span>';
        echo '<span class="nav-title">' . esc_html(get_the_title($prev_post)) . '</span>';
        echo '</a>';
        echo '</div>';
    }

    if ($next_post) {
        echo '<div class="nav-next">';
        echo '<a href="' . esc_url(get_permalink($next_post)) . '" rel="next">';
        echo '<span class="nav-subtitle">' . esc_html__('Next Post', 'shopora-premium-commerce') . '</span>';
        echo '<span class="nav-title">' . esc_html(get_the_title($next_post)) . '</span>';
        echo '</a>';
        echo '</div>';
    }

    echo '</div>';
    echo '</nav>';
}
endif;

?>