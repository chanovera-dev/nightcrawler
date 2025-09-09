<?php get_header(); ?>
<main id="main" class="site-main" role="main">
    <section class="block">
        <header class="content">
            <?php the_archive_title( '<h1 class="main-title">', '</h1>' ); ?>
        </header>
        <div class="posts content">
            <?php
                if ( have_posts() ) {
                    
                    while ( have_posts() ) {
                        the_post();
                        get_template_part( 'template-parts/content', 'archive' );
                    }
                    the_posts_pagination( array(
                        'mid_size'  => 2,
                        'prev_text' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0"/></svg>Anterior',
                        'next_text' => 'Siguiente <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708"/></svg>'
                    ) );

                }
            ?>
        </div>
    </section>
</main><!-- .site-main -->
<?php get_footer(); ?>