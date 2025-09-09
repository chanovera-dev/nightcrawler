<main id="main" class="site-main" role="main">
    <article>
        <section class="block">
            <header class="header content">
                <?php the_title( '<h1 class="main-title">', '</h1>' ); ?>
                <div class="breadcrumbs share">
                    <?php
                        if ( function_exists('wp_breadcrumbs') ) {
                            wp_breadcrumbs();
                        }
                    ?>
                </div>
            </header>
            <main class="content">
                <div class="post is-layout-constrained">
                    <?php the_content(); ?>
                </div>
                <?php
                    if ( is_active_sidebar( 'sidebar-page' ) ) {
                        echo '
                        <aside class="wp-sidebar">';
                        dynamic_sidebar( 'sidebar-page' ); echo '
                        </aside>';
                    }
                ?>
            </main>
        </section>
    </article>
</main><!-- .site-main -->