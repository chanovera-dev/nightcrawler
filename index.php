<?php 
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Nightcrawler
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header(); ?>

<main id="main" class="site-main" role="main" itemscope itemtype="https://schema.org/WebPage">
    <article class="block">
        <div class="content">
            <header class="entry-header">
                <h1 class="main-title" itemprop="headline"><?= esc_html_e( 'Index', 'nightcrawler' ); ?></h1>
            </header>
        </div>
    </article>
</main><!-- #main -->

<?php get_footer(); ?>