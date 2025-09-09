<?php
/**
 * Extended Theme Functions
 * 
 * Additional functionality for the Nightcrawler theme including:
 * - Phone number formatting
 * - SVG upload support
 * - Custom excerpt length
 * - Enhanced menu structure
 * - Advanced breadcrumbs navigation
 * 
 * @package Nightcrawler
 * @since 1.0.0
 */

/**
 * Formats phone numbers into a standardized format
 * 
 * Converts a 10-digit phone number into (XXX) XXX-XXXX format.
 * Returns original number if not 10 digits.
 *
 * @param string $number The phone number to format
 * @return string Formatted phone number
 */
function format_phone_number($number) {
    $digits = preg_replace('/\D/', '', $number);
    if (strlen($digits) === 10) {
        return '(' . substr($digits, 0, 3) . ') ' . substr($digits, 3, 3) . '-' . substr($digits, 6);
    }
    return $number;
}

/**
 * Enables SVG file upload support with security checks
 * 
 * Adds SVG MIME type to allowed upload formats while maintaining
 * WordPress security standards.
 *
 * @param array $mimes Current allowed MIME types
 * @return array Modified MIME types
 */
function mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter( 'upload_mimes', 'mime_types' ); 

/**
 * Customizes excerpt length for better readability
 * 
 * Reduces post excerpt length to 21 words for improved
 * display in archive pages and search results.
 *
 * @param int $limit Current excerpt length
 * @return int Modified excerpt length (21)
 */
function reduce_excerpt_length($limit) {
    return 21;
}
add_filter('excerpt_length', 'reduce_excerpt_length', 999);

/**
 * Enhances menu structure with custom elements
 * 
 * Adds submenu indicators and custom markup for mobile and primary
 * navigation menus. Includes SVG icons for visual hierarchy.
 *
 * @param string $item_output The menu item's HTML
 * @param object $item Menu item data object
 * @param int $depth Depth of menu item
 * @param object $args Menu arguments
 * @return string Modified menu item HTML
 */
function custom_menu($item_output, $item, $depth, $args) {
    
    $allowed_locations = ['mobile', 'primary'];

    if (!isset($args->theme_location) || !in_array($args->theme_location, $allowed_locations)) {
        return $item_output;
    }

    global $submenu_items_by_parent;
    static $checked_menus = [];

    if (!empty($args->menu) && !in_array($args->menu->term_id, $checked_menus)) {
        $menu_items = wp_get_nav_menu_items($args->menu->term_id);
        foreach ($menu_items as $menu_item) {
            $submenu_items_by_parent[$menu_item->menu_item_parent][] = $menu_item;
        }
        $checked_menus[] = $args->menu->term_id;
    }

    $has_children = !empty($submenu_items_by_parent[$item->ID]);

    if ($has_children) {
        $text = esc_html($item->title);
        $svg_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="12" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"/></svg>';

        return '<div class="button-for-submenu">' . $text  . $svg_icon . '</div>';
    }

    return $item_output;
}
add_filter('walker_nav_menu_start_el', 'custom_menu', 10, 4);

/**
 * Implements advanced WordPress breadcrumbs
 * 
 * Generates semantic breadcrumb navigation with:
 * - Home icon with SVG
 * - Category hierarchy
 * - Page ancestors
 * - Date-based archives
 * - Search results
 * - Custom post types
 * - Taxonomies
 *
 * @return void Outputs HTML directly
 */
function wp_breadcrumbs() {
    if (is_front_page()) return;

    echo '<nav class="breadcrumbs" aria-label="Breadcrumb">';
    echo '<a href="' . esc_url(home_url('/')) . '">' . '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 576 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M575.8 255.5c0 18-15 32.1-32 32.1l-32 0 .7 160.2c0 2.7-.2 5.4-.5 8.1l0 16.2c0 22.1-17.9 40-40 40l-16 0c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1L416 512l-24 0c-22.1 0-40-17.9-40-40l0-24 0-64c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32 14.3-32 32l0 64 0 24c0 22.1-17.9 40-40 40l-24 0-31.9 0c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2l-16 0c-22.1 0-40-17.9-40-40l0-112c0-.9 0-1.9 .1-2.8l0-69.7-32 0c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z"/></svg>' . '</a> &raquo; ';

    if (is_category() || is_single()) {
        $category = get_the_category();
        if ($category) {
            $cat = $category[0];
            echo get_category_parents($cat, true, ' &raquo; ');
        }
        if (is_single()) {
            echo '<span>' . get_the_title() . '</span>';
        }
    } elseif (is_page()) {
        $ancestors = get_post_ancestors(get_the_ID());
        if ($ancestors) {
            $ancestors = array_reverse($ancestors);
            foreach ($ancestors as $ancestor) {
                echo '<a href="' . get_permalink($ancestor) . '">' . get_the_title($ancestor) . '</a> &raquo; ';
            }
        }
        echo '<span>' . get_the_title() . '</span>';
    } elseif (is_tag()) {
        echo '<span>' . single_tag_title('', false) . '</span>';
    } elseif (is_day()) {
        echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> &raquo; ';
        echo '<a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a> &raquo; ';
        echo '<span>' . get_the_time('d') . '</span>';
    } elseif (is_month()) {
        echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> &raquo; ';
        echo '<span>' . get_the_time('F') . '</span>';
    } elseif (is_year()) {
        echo '<span>' . get_the_time('Y') . '</span>';
    } elseif (is_author()) {
        echo '<span>' . get_the_author() . '</span>';
    } elseif (is_search()) {
        echo '<span>' . sprintf(__('Resultados de búsqueda para "%s"', 'textdomain'), get_search_query()) . '</span>';
    } elseif (is_404()) {
        echo '<span>' . __('Error 404', 'textdomain') . '</span>';
    } elseif (is_post_type_archive()) {
        echo '<span>' . post_type_archive_title('', false) . '</span>';
    } elseif (is_tax()) {
        $term = get_queried_object();
        echo '<span>' . $term->name . '</span>';
    }

    echo '</nav>';
}

/**
 * Social Icons
 */
function theme_custom_icons() {
    ?>
        <style>          
            /* iconos de redes sociales */
            .social .menu li a[href*="facebook"]:before{mask-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/icons/facebook.svg');}
            .social .menu li a[href*="twitter"]:before{mask-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/icons/twitter.svg');}
            .social .menu li a[href*="youtube"]:before{mask-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/icons/youtube.svg');}
            .social .menu li a[href*="instagram"]:before{mask-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/icons/instagram.svg');}
            .social .menu li a[href*="google"]:before{mask-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/icons/google.svg');}
            .social .menu li a[href*="tiktok"]:before{mask-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/icons/tiktok.svg');}

            .contact .menu li a[href*="tel"]:before{mask-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/icons/support-phone.svg');}
            .contact .menu li a[href*="mailto"]:before{mask-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/icons/mailto.svg');}
        </style>
    <?php
}
add_action('wp_head', 'theme_custom_icons');