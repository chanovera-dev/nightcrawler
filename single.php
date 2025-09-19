<?php
/**
 * Main Single Post Template
 * 
 * @package yabaaexpress
 * @since 1.0.0
 */
get_header();

if ( have_posts() ) {

    while( have_posts() ) {

        the_post();     
        get_template_part( 'template-parts/content', 'post' );

    }

}

get_footer();