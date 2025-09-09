<?php
/**
 * Template Name: Rastreo
 */
get_header(); ?>

<main id="main" class="site-main" role="main">
    <section id="rastreo" class="block">
        <?= get_the_post_thumbnail( null, 'full', [ 'class' => 'background-rastreo background-parallax background-hero', 'alt' => get_the_title(), 'loading' => 'lazy' ] ); ?>
    <div class="content">
        <div class="iframe--wrapper">
            <iframe
                title="Widget de seguimiento de envíos"
                src="https://postal.ninja/widget/tracker"
                style="width: 100%; height: 300px;"
                frameborder="0">
            </iframe>
        </div>
    </div>
</section>
</main>

<?php get_footer(); ?>