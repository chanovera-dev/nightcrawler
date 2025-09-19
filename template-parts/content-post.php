<main id="main" class="site-main" role="main">
    <article id="<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="block">
            <?php
                if ( has_post_thumbnail() ) {
                    echo get_the_post_thumbnail( null, 'full', [ 'class' => 'thumbnail background-hero', 'alt'   => get_the_title(), 'loading' => 'lazy', 'data-speed' => '0.25' ] );
                }
            ?>
            <div class="content">
                <?php
                    the_title( '<h1 class="main-title">', '</h1>' );
                ?>
                <div class="date category">
                    <?php
                        echo get_the_date();
                        echo ' en ';
                        the_category();
                    ?>
                </div>
            </div>
        </header>
        <section class="block">
            <div class="content is-layout-constrained">
                <?php the_content(); ?>
            </div>
            <div class="content content-tags">
                <?php
                    $tags = get_the_tags();
                    if ( $tags ) {
                        echo '<ul class="tags">';
                        foreach ( $tags as $tag ) {
                            echo '<li><a href="' . esc_url( get_tag_link( $tag->term_id ) ) . '">' . esc_html( $tag->name ) . '</a></li>';
                        }
                        echo '</ul>';
                    }
                ?>
            </div>
            <?php if ( comments_open() ) : ?>
                <div class="content">
                    <?php comments_template(); ?>
                </div>
            <?php endif; ?>
        </section>
    </article>
</main><!-- .site-main -->