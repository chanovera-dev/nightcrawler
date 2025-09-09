<?php
/**
 * Main Single Page Template
 * 
 * This template handles the display of individual pages.
 * It loads the appropriate content template part based on
 * the current page context and passes the post data.
 * 
 * Template variables:
 * - $post: WP_Post object containing the current page data
 * 
 * @package yabaaexpress
 * @since 1.0.0
 */
get_header();

if ( have_posts() ) {

    while( have_posts() ) {

        the_post();     
        get_template_part( 'template-parts/content', 'page' );

    }

}

get_footer();