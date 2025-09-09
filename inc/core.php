<?php
/**
 * Core Theme Setup and Asset Loading
 *
 * Handles theme initialization, feature registration, and asset management:
 * - Navigation menus registration
 * - WordPress core features support
 * - Asset loading with cache busting
 * - Widget areas registration
 *
 * Sets up theme defaults and registers support for various WordPress features
 * 
 * @package Nightcrawler
 * @since 1.0.0
 */

function setup_nightcrawler() {
    // Register navigation menus
    register_nav_menus([
        'mobile'       => __( 'Mobile Header Menu', 'nightcrawler' ),
        'primary'      => __( 'Desktop Header Menu', 'nightcrawler' ),
        'social'       => __( 'Social Menu', 'nightcrawler' ),
        'contact'      => __( 'Contact Footer Menu', 'nightcrawler' ),
        'services'     => __( 'Services Footer Menu', 'nightcrawler' ),
        'subsidiaries' => __( 'Subsidiaries Footer Menu', 'nightcrawler' ),
    ]);

    // Basic theme support
    add_theme_support( 'title-tag' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'align-wide' );
    add_theme_support( 'customize-selective-refresh-widgets' );

    // Custom logo support
    add_theme_support( 'custom-logo', [
        'height'      => 32,
        'width'       => 172,
        'flex-height' => true,
        'flex-width'  => true,
    ]);

    // HTML5 markup support
    add_theme_support( 'html5', apply_filters( 'nightcrawler_html5_args', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'widgets',
        'style',
        'script',
    ]));

    // Post thumbnails for posts only
    add_theme_support( 'post-thumbnails', [ 'post', 'page', 'event' ] );
    set_post_thumbnail_size( 350, 200, true );
}
add_action( 'after_setup_theme', 'setup_nightcrawler' );

/**
 * Generates version string for asset cache busting
 */
function get_asset_version($file_path) {
    $full_path = get_template_directory() . $file_path;
    return file_exists($full_path) ? filemtime($full_path) : time();
}

/**
 * Enqueues header styles with cache busting
 * 
 * Loads global stylesheet and form-specific styles in the header
 * with automatic versioning based on file modification time.
 */
function load_to_header() {
    // Define styles array for better maintenance and performance
    $styles = [
        'global' => [
            'path' => '/style.css',
            'deps' => [],
        ],
        'custom-forms' => [
            'path' => '/assets/css/forms.css',
            'deps' => [],
        ]
    ];

    // Cache theme directory URI to avoid multiple calls
    $theme_uri = get_template_directory_uri();
    
    // Enqueue styles efficiently
    foreach ($styles as $handle => $style) {
        if (file_exists(get_template_directory() . $style['path'])) {
            wp_enqueue_style(
                $handle,
                esc_url($theme_uri . $style['path']),
                $style['deps'],
                get_asset_version($style['path']),
                'all'
            );
        }
    }
}
add_action( 'wp_enqueue_scripts', 'load_to_header' );

/**
 * Enqueues footer assets conditionally
 * 
 * Loads:
 * - Admin styles for logged-in users
 * - Root styles for all users
 * - Global JavaScript with deferred loading
 */
function load_to_footer() {
    // Cache theme directory data
    $theme_uri = trailingslashit(get_template_directory_uri());
    
    // Define footer assets
    $assets = [
        'styles' => [
            'wp-root' => [
                'path' => 'assets/css/wp-root.css',
                'deps' => []
            ],
            'has-login' => [
                'path' => 'assets/css/has-wp-login.css',
                'deps' => [],
                'condition' => 'is_user_logged_in'
            ]
        ],
        'scripts' => [
            'global' => [
                'path' => 'assets/js/global.js',
                'deps' => [],
                'defer' => true
            ]
        ]
    ];

    // Load styles efficiently
    foreach ($assets['styles'] as $handle => $style) {
        if (!isset($style['condition']) || ($style['condition'] && function_exists($style['condition']) && call_user_func($style['condition']))) {
            wp_enqueue_style(
                $handle,
                esc_url($theme_uri . $style['path']),
                $style['deps'],
                get_asset_version('/' . $style['path']),
                'all'
            );
        }
    }

    // Load scripts with defer
    foreach ($assets['scripts'] as $handle => $script) {
        wp_enqueue_script(
            $handle,
            esc_url($theme_uri . $script['path']),
            $script['deps'],
            get_asset_version('/' . $script['path']),
            true
        );
    }
}
add_action( 'wp_footer', 'load_to_footer' );

/**
 * Registers theme widget areas/sidebars
 * 
 * Creates two widget areas:
 * - sidebar-page: For static pages
 * - sidebar-post: For blog entries
 */
// function widgets_areas() {

//     register_sidebar(
//         array(
//             'name'          => __( 'Sidebar Page', 'nightcrawler' ),
//             'id'            => 'sidebar-page',
//             'before_widget' => '',
//             'after_widget'  => '',
//         )
//     );

//     register_sidebar(
//         array(
//             'name'          => __( 'Sidebar Post', 'nightcrawler' ),
//             'id'            => 'sidebar-post',
//             'before_widget' => '',
//             'after_widget'  => '',
//         )
//     );

// }
// add_action( 'widgets_init', 'widgets_areas' );