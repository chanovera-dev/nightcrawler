<?php
/**
 * Templates
 */

/**
 * Enqueues styles specifically for 404 error page
 * 
 * Loads custom CSS file only when viewing 404 page
 * to optimize performance and reduce unnecessary loading
 *
 * @since 1.0.0
 * @return void
 */
function page404_styles() {
    // Remove WP block styles
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');

    // Only load styles on 404 page
    if (is_404()) {
        // Cache theme directory URI
        $theme_uri = get_template_directory_uri();
        
        wp_enqueue_style(
            'error404',
            $theme_uri . '/assets/css/error404.css',
            array(),
            get_asset_version('/assets/css/error404.css'),
            'all'
        );
    }
}
add_action( 'wp_enqueue_scripts', 'page404_styles' );

/**
 * Frontpage template styles
 * 
 * Loads custom CSS file only when viewing the front page
 * to optimize performance and reduce unnecessary loading
 *
 * @since 1.0.0
 * @return void
 */
function frontpage_template() {
    if ( ! is_front_page() ) return;

    // Estilos y scripts fijos
    wp_enqueue_style( 'cotizador', get_template_directory_uri() . '/assets/css/frontpage/cotizador.css', [], get_asset_version('/assets/css/frontpage/cotizador.css') );
    wp_enqueue_script( 'cotizador-script', get_template_directory_uri() . '/assets/js/frontpage/cotizador.js', [], get_asset_version('/assets/js/frontpage/cotizador.js'), true );
    wp_enqueue_style( 'rastreo', get_template_directory_uri() . '/assets/css/frontpage/rastreo.css', [], get_asset_version('/assets/css/frontpage/rastreo.css') );
    wp_enqueue_script( 'parallax-rastreo', get_template_directory_uri() . '/assets/js/parallax-hero.js', [], get_asset_version('/assets/js/parallax-hero.js'), true );
    wp_enqueue_script( 'parallax-testimonials', get_template_directory_uri() . '/assets/js/parallax.js', [], get_asset_version('/assets/js/parallax.js'), true );

    // Obtener número desde el personalizador
    $cotizaciones = get_theme_mod('phone_cotizaciones', '2294155160');

    // Pasarlo a JS
    wp_localize_script( 'cotizador-script', 'cotizadorData', [ 'whatsapp' => '521' . $cotizaciones,]);

    // Secciones condicionales
    $sections = [
        'hero'         => [ 'condition' => have_rows( 'hero_repeater' ), 'css'         => true, 'js'  => [ 'handle' => 'hero-slideshow', 'src'       => '/assets/js/frontpage/hero/slideshow.js' ] ],
        'posts'        => [ 'condition' => ! empty( get_posts() ), 'css'               => true, 'js'  => [ 'handle' => 'posts-slideshow',  'src'     => '/assets/js/frontpage/posts/slideshow-posts.js' ] ], 
        'gallery'      => [ 'condition' => have_rows( 'gallery_repeater' ), 'css'      => true, 'js'  => [ 'handle' => 'gallery-slideshow', 'src'    => '/assets/js/frontpage/gallery/slideshow-gallery.js' ] ],
        'services'     => [ 'condition' => have_rows( 'services_repeater' ), 'css'     => true ],
        'supply-chain' => [ 'condition' => have_rows( 'supply_chain_repeater' ), 'css' => true, 'js'  => [ 'handle' => 'numbers-supply-chain', 'src' => '/assets/js/numbers.js' ] ],
        'about-us'     => [ 'condition' => have_rows( 'about_us_repeater' ), 'css' => true ],
        'testimonials' => [ 'condition' => have_rows( 'testimonials_repeater' ), 'css' => true ],
    ];

    foreach ( $sections as $handle => $data ) {
        if ( $data['condition'] ) {
            if ( ! empty( $data['css'] ) ) {
                wp_enqueue_style( $handle, get_template_directory_uri() . "/assets/css/frontpage/{$handle}.css", [], get_asset_version("/assets/css/frontpage/{$handle}.css") );
            }
            if ( ! empty( $data['js'] ) ) {
                $js = $data['js'];
                wp_enqueue_script( $js['handle'], get_template_directory_uri() . $js['src'], [], get_asset_version($js['src']), true );
            }
        }
    }
}
add_action( 'wp_enqueue_scripts', 'frontpage_template' );

/**
 * Post styles for single post or single page
 */
function post_templates() {

    if ( is_single() ) {
        wp_enqueue_style( 'single-post', get_template_directory_uri() . '/assets/css/single.css', [], get_asset_version('/assets/css/single.css') );
        if ( has_post_thumbnail() == true ) {
            wp_enqueue_style( 'single-post-thumbnail', get_template_directory_uri() . '/assets/css/single/thumbnail.css', [], get_asset_version('/assets/css/single/thumbnail.css') );
            wp_enqueue_script( 'parallax-rastreo', get_template_directory_uri() . '/assets/js/frontpage/rastreo/parallax-rastreo.js', [], get_asset_version('/assets/js/frontpage/rastreo/parallax-rastreo.js'), true );
        }
    }

    if ( is_page() ) {
        wp_enqueue_style( 'page', get_template_directory_uri() . '/assets/css/page.css', array(), get_asset_version('/assets/css/page.css'), 'all' );
        wp_enqueue_style( 'breadcrumbs', get_template_directory_uri() . '/assets/css/breadcrumbs.css', array(), get_asset_version('/assets/css/breadcrumbs.css'), 'all' );
        if ( is_active_sidebar( 'sidebar-page' ) ) {
            wp_enqueue_style( 'sidebar', get_template_directory_uri() . '/assets/css/sidebar.css', array(), get_asset_version('/assets/css/sidebar.css'), 'all' );
        }
    }
}
add_action( 'wp_enqueue_scripts', 'post_templates' );

/**
 * Post styles for templates
 */
function templates_styles() {
    if ( is_page_template( 'templates/contact.php' ) ) {
        wp_enqueue_style( 'contact', get_template_directory_uri() . '/assets/css/templates/contact.css', array(), get_asset_version('/assets/css/templates/contact.css'), 'all' );
        wp_enqueue_style( 'breadcrumbs', get_template_directory_uri() . '/assets/css/breadcrumbs.css', array(), get_asset_version('/assets/css/breadcrumbs.css'), 'all' );  
        wp_enqueue_script( 'typing', get_template_directory_uri() . '/assets/js/typing.js', [], get_asset_version('/assets/js/typing.js'), true );
        if ( has_post_thumbnail() == true ) {
            wp_enqueue_style( 'contact-thumbnail', get_template_directory_uri() . '/assets/css/templates/contact/thumbnail.css', array(), get_asset_version('/assets/css/templates/contact/thumbnail.css'), 'all' );
            wp_enqueue_script( 'parallax-hero', get_template_directory_uri() . '/assets/js/parallax-hero.js', [], get_asset_version('/assets/js/parallax-hero.js'), true );
        }
    }

    if ( is_page_template( 'templates/branches.php' ) ) {
        wp_enqueue_style( 'branches', get_template_directory_uri() . '/assets/css/templates/branches.css', array(), get_asset_version('/assets/css/templates/branches.css'), 'all' );
        wp_enqueue_style( 'breadcrumbs', get_template_directory_uri() . '/assets/css/breadcrumbs.css', array(), get_asset_version('/assets/css/breadcrumbs.css'), 'all' );  
        if ( has_post_thumbnail() == true ) {
            wp_enqueue_style( 'contact-thumbnail', get_template_directory_uri() . '/assets/css/templates/contact/thumbnail.css', array(), get_asset_version('/assets/css/templates/contact/thumbnail.css'), 'all' );
            wp_enqueue_script( 'parallax-rastreo', get_template_directory_uri() . '/assets/js/parallax.js', [], get_asset_version('/assets/js/parallax.js'), true );
        }
    }

    if ( is_page_template( 'templates/services.php' ) ) {
        wp_enqueue_style( 'services', get_template_directory_uri() . '/assets/css/templates/services.css', array(), get_asset_version('/assets/css/templates/services.css'), 'all' );
        if ( has_post_thumbnail() == true ) {
            wp_enqueue_style( 'contact-thumbnail', get_template_directory_uri() . '/assets/css/templates/services/thumbnail.css', array(), get_asset_version('/assets/css/templates/services/thumbnail.css'), 'all' );
        }
        if ( have_rows( 'testimonials_repeater' ) ) {
            wp_enqueue_style( 'testimonials', get_template_directory_uri() . '/assets/css/templates/services/testimonials.css', array(), get_asset_version('/assets/css/templates/services/testimonials.css'), 'all' );
        }
        wp_enqueue_script( 'slideshow', get_template_directory_uri() . '/assets/js/frontpage/posts/slideshow-posts.js', [], get_asset_version('/assets/js/frontpage/posts/slideshow-posts.js'), true );
        wp_enqueue_style( 'services-repeater', get_template_directory_uri() . '/assets/css/frontpage/services.css', array(), get_asset_version('/assets/css/frontpage/services.css'), 'all' );
    }

    if ( is_page_template( 'templates/warranty.php' ) ) {
        wp_enqueue_style( 'warranty', get_template_directory_uri() . '/assets/css/templates/warranty.css', array(), get_asset_version('/assets/css/templates/warranty.css'), 'all' );
        if ( has_post_thumbnail() == true ) {
            wp_enqueue_script( 'parallax-hero', get_template_directory_uri() . '/assets/js/parallax-hero.js', [], get_asset_version('/assets/js/parallax-hero.js'), true );
            wp_enqueue_style( 'contact-thumbnail', get_template_directory_uri() . '/assets/css/templates/contact/thumbnail.css', array(), get_asset_version('/assets/css/templates/contact/thumbnail.css'), 'all' );
        }
        wp_enqueue_style( 'testimonials', get_template_directory_uri() . '/assets/css/templates/warranty/testimonials.css', array(), get_asset_version('/assets/css/templates/warranty/testimonials.css'), 'all' );
        wp_enqueue_script( 'slideshow', get_template_directory_uri() . '/assets/js/frontpage/posts/slideshow-posts.js', [], get_asset_version('/assets/js/frontpage/posts/slideshow-posts.js'), true );
    }

    if ( is_page_template( 'templates/rastreo.php' ) ) {
        wp_enqueue_style( 'rastreo', get_template_directory_uri() . '/assets/css/frontpage/rastreo.css', array(), get_asset_version('/assets/css/frontpage/rastreo.css'), 'all' );
        if ( has_post_thumbnail() == true ) {
            wp_enqueue_script( 'parallax-hero', get_template_directory_uri() . '/assets/js/parallax-hero.js', [], get_asset_version('/assets/js/parallax-hero.js'), true );
        }
    }
}
add_action( 'wp_enqueue_scripts', 'templates_styles' );

/**
 * Posts styles for home, archive or search
 */
function posts_styles() {
    if ( is_home() or is_archive() or is_search() ) {

        function unload_parts_header() {
            wp_dequeue_style( 'wp-block-library' );
        }
        add_action( 'wp_enqueue_scripts', 'unload_parts_header', 100 );
        wp_enqueue_style( 'posts', get_template_directory_uri() . '/assets/css/posts.css', array(), get_asset_version('/assets/css/posts.css'), 'all' );
        if ( paginate_links() ) {
            wp_enqueue_style( 'pagination', get_template_directory_uri() . '/assets/css/pagination.css', array(), get_asset_version('/assets/css/pagination.css'), 'all' );
        }
    }
}
add_action( 'wp_enqueue_scripts', 'posts_styles' );