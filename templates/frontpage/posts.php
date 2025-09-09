<section id="posts" class="block">
    <div class="container">
        <div class="padding-posts"></div>
        <div class="body-posts">
            <header class="body-posts__header">
                <?php if ( $title = get_field( 'frontpage_posts_title' ) ) : ?>
                    <h2 class="title-section"><?php esc_html_e( $title ); ?></h2>
                <?php endif; ?>
                <?php if ( $link = get_field( 'frontpage_posts_link' ) ) : ?>
                    <?php if ( $link_label = get_field( 'frontpage_posts_link_label' ) ) : ?>
                        <a href="<?= esc_url( $link ); ?>" class="view-all">
                            <?php esc_html_e( $link_label ); ?>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="form_submit_button_right_arrow" x="0px" y="0px" viewBox="0 0 32 11" style="enable-background:new 0 0 32 11;" width="21" xml:space="preserve" class="svg replaced-svg">
                                <style type="text/css">
                                    .st0{fill:currentColor;}
                                </style>
                                <path id="Forma_1" class="st0" d="M26.7,0.2c-0.2-0.2-0.6-0.2-0.8,0c-0.2,0.2-0.2,0.6,0,0.8c0,0,0,0,0,0l4.2,4H0.6  C0.3,4.9,0,5.2,0,5.5c0,0,0,0,0,0C0,5.8,0.3,6.1,0.6,6c0,0,0,0,0,0H30l-4.2,4c-0.2,0.2-0.2,0.6,0,0.8c0,0,0,0,0,0  c0.2,0.2,0.6,0.2,0.8,0l5.1-4.9c0.2-0.2,0.2-0.5,0-0.8c0,0,0,0,0,0L26.7,0.2z"></path>
                            </svg>
                        </a>
                    <?php endif; ?>
                <?php endif; ?>
            </header>
            <main class="body-posts__main">
                <?php
                    global $post;

                    $number_posts = get_field( 'frontpage_posts_number_archives' );
                    
                    $last_posts = get_posts( array( 'posts_per_page' => $number_posts ) );
                    
                    foreach ( $last_posts as $post ) :
                    setup_postdata( $post );

                    get_template_part( 'template-parts/frontpage', 'posts' );

                    endforeach;
                    wp_reset_postdata();
                ?>
            </main>
        </div>
    </div>
    <div class="container">
        <div class="slideshow-wrapper">
            <div class="slideshow">
                <?php
                    global $post;

                    $number_events = get_field( 'frontpage_posts_number_slides' );

                    $eventos = get_posts(array(
                        'post_type'      => 'event',
                        'posts_per_page' => $number_events
                    ));

                    foreach ( $eventos as $post ) :
                        setup_postdata( $post );

                        get_template_part( 'template-parts/frontpage', 'events' );

                    endforeach;

                    wp_reset_postdata();
                ?>
            </div>
            <div class="slideshow-buttons-wrapper">
                <ul class="slideshow-buttons"></ul>
            </div>
            <button class="slideshow-prev">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0"/>
                </svg>
            </button>
            <button class="slideshow-next">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708"/>
                </svg>
            </button>
        </div>
    </div>
</section>