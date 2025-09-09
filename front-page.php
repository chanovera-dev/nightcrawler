<?php
/**
 * The template for displaying the front page
 *
 * This is the template that displays the front page by default.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Nightcrawler
 * @since 1.0.0
 */
get_header(); ?>

<main id="main" class="site-main" role="main">
    <?php
        $directory = get_template_directory() . '/templates/frontpage';

        $sections = [
            'cotizador',
            'rastreo',
            'hero' => have_rows( 'hero_repeater' ),
            'posts' => ! empty( get_posts() ),
            'gallery' => have_rows( 'gallery_repeater' ),
            'services' => have_rows( 'services_repeater' ),
            'supply-chain' => have_rows( 'supply_chain_repeater' ),
            // 'about-us' => have_rows( 'about_us_repeater' ),
            'testimonials' => have_rows( 'testimonials_repeater' ),
        ];

        foreach ( $sections as $section => $condition ) {
            if ( is_int( $section ) ) {
                $section   = $condition;
                $condition = true;
            }

            if ( $condition && file_exists( "$directory/$section.php" ) ) {
                include "$directory/$section.php";
            }
        }
    ?>
</main>

<?php get_footer(); ?>