<?php 
/**
 * 404 Page Template
 * 
 * Displays a custom 404 error page with a message and a link to the homepage.
 * Utilizes styles specifically enqueued for the 404 page.
 *
 * @package Nightcrawler
 * @since 1.0.0
 */
get_header(); ?>

<main id="main" class="site-main" role="main">
    <header class="block">
        <div class="content">
            <h1 class="main-title" itemprop="headline" aria-label="error404"><?= esc_html_e( 'Error', 'nightcrawler' ); ?></h1>
        </div>
    </header>
    <section class="block">
        <div class="content">
            <img class="error404-picture" src="<?php echo get_template_directory_uri(); ?>/assets/img/error404.webp" alt="Error 404 picture" loading="lazy">
            <p>
                <?php 
                    printf(
                        wp_kses_post(__('<strong>%s</strong> No encontramos la página que buscas.', 'nightcrawler')),
                        esc_html__('¡Ups!', 'nightcrawler')
                    ); 
                ?>
            </p>

            <a class="btn btn-primary" href="<?php echo get_home_url(); ?>">
                <?php echo esc_html('Ir a Inicio', 'nightcrawler'); ?>
            </a>
        </div>
    </section>
</main><!-- .site-main -->
<?php get_footer(); ?>