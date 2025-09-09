<header class="block">
    <?php
        if ( has_post_thumbnail() ) {
            echo get_the_post_thumbnail( null, 'full', [ 'class' => 'thumbnail background-parallax background-hero', 'alt'   => get_the_title(), 'loading' => 'lazy', 'data-speed' => '0.25' ] );
        }
    ?>
    <div class="content large-width">
        <?php the_title( '<h1 class="main-title">', '</h1>' ); ?>
        <?php if( $subtitle = get_field( 'warranty_subtitle' ) ) : ?>
            <h2 class="subtitle"><?php esc_html_e( $subtitle ); ?></h2>
        <?php endif; ?>
    </div>
</header>