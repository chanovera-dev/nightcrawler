<?php
/**
 * Template Name: Servicios
 */
get_header(); ?>

<main id="main" class="site-main" role="main">
    <header class="block">
        <?php
            if ( has_post_thumbnail() ) {
                echo get_the_post_thumbnail( null, 'full', [ 'class' => 'thumbnail background-parallax', 'alt'   => get_the_title(), 'loading' => 'lazy', 'data-speed' => '0.25' ] );
            }
        ?>
        <div class="content large-width">
            <?php the_title( '<h1 class="main-title">', '</h1>' ); ?>
            <?php if( $subtitle = get_field( 'services_subtitle' ) ) : ?>
                <h2 class="subtitle"><?php esc_html_e( $subtitle ); ?></h2>
            <?php endif; ?>
        </div>
    </header>
    <section class="block services">
        <div class="content">
            <div class="container">
                <div class="slideshow-wrapper">
                    <div class="slideshow">
                        <?php if ( have_rows( 'services_repeater' ) ) : ?>
                            <?php while ( have_rows( 'services_repeater' ) ) : the_row(); ?>
                                <div class="service">
                                    <?php if ( $picture = get_sub_field('service_background_picture') ) : ?>
                                        <?php 
                                            $url = esc_url( $picture['url'] );
                                            $alt = esc_attr( $picture['alt'] ?: 'Fotografía del servicio' );
                                            $srcset = wp_get_attachment_image_srcset( $picture['ID'], 'full' );
                                            $sizes = wp_get_attachment_image_sizes( $picture['ID'], 'full' );
                                        ?>
                                        <img class="service-background" src="<?php echo $url; ?>" srcset="<?php echo esc_attr( $srcset ); ?>" sizes="<?php echo esc_attr( $sizes ); ?>" alt="<?php echo $alt; ?>" loading="lazy">
                                    <?php endif; ?>
                                    <div class="backdrop"></div>
                                    <div class="service__content">
                                        <?php if ( $title = get_sub_field( 'service_title' ) ) : ?>
                                            <h3 class="service-title"><?php esc_html_e( $title ); ?></h3>
                                        <?php endif; ?>
                                        <?php if ( $content = get_sub_field( 'service_content' ) ) : ?>
                                            <div class="service-content"><?php echo $content; ?></div>
                                        <?php endif; ?>
                                        <?php if ( $link = get_sub_field( 'service_link' ) ) : ?>
                                            <a class="service-link" href="<?php esc_url( $link )?>">
                                                <?php esc_html_e( 'Más información', 'yabaaexpress' ); ?>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 320 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/></svg>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <p><?php esc_html_e( 'No se han encontrado servicios.' ); ?></p>
                        <?php endif; ?>
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
                    <div class="slideshow-buttons-wrapper">
                        <ul class="slideshow-buttons"></ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php if (have_rows('solutions_repeater')) : ?>
    <section class="block">
        <div class="content">
            <?php
            $block_title = get_field('solutions_title');
            $background_image = get_field('solutions_title_background'); // campo imagen ACF

            if ($block_title):
                $background_url = is_array($background_image) ? $background_image['url'] : $background_image;
            ?>
                <h2 class="title-section solutions"
                    style="
                        <?php if ($background_url): ?>
                            background-image: url('<?php echo esc_url($background_url); ?>');
                        <?php endif; ?>
                    ">
                    <?php echo esc_html($block_title); ?>
                </h2>
            <?php endif; ?>
        </div>
        <div class="content large-width solutions">
            <?php while (have_rows('solutions_repeater')) : the_row(); 
                $category = get_sub_field('solution_category');
                $title = get_sub_field('solution_title');
                $text = get_sub_field('solution_text');
                $link = get_sub_field('solution_link');
                $link_label = get_sub_field('solution_link_label');
            ?>
                <div class="solution">
                    <?php if ($category): ?>
                        <span class="solution__category"><?php echo esc_html($category); ?></span>
                    <?php endif; ?>
                    
                    <?php if ($title): ?>
                        <h3 class="solution__title"><?php echo esc_html($title); ?></h3>
                    <?php endif; ?>

                    <?php if ($text): ?>
                        <div class="solution__text"><?php echo $text; ?></div>
                    <?php endif; ?>

                    <?php if ($link): ?>
                        <a class="solution__link" href="<?php echo esc_url($link); ?>"><?= esc_html__($link_label); ?></a>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        </div>
    </section>
    <?php endif; ?>
    <section id="testimonials" class="block">
        <?php if ( $picture = get_field('testimonials_background') ) : ?>
            <?php 
                $url = esc_url( $picture['url'] );
                $alt = esc_attr( $picture['alt'] ?: 'Fotografía del testigo' );
                $srcset = wp_get_attachment_image_srcset( $picture['ID'], 'full' );
                $sizes = wp_get_attachment_image_sizes( $picture['ID'], 'full' );
            ?>
            <img class="testimonials-background background-parallax" src="<?php echo $url; ?>" srcset="<?php echo esc_attr( $srcset ); ?>" sizes="<?php echo esc_attr( $sizes ); ?>" alt="<?php echo $alt; ?>" loading="lazy" data-speed="0.25">
        <?php endif; ?>
        <div class="container content large-width">
            <div class="slideshow-wrapper">
                <div class="slideshow">
                    <?php if ( have_rows( 'testimonials_repeater' ) ) : ?>
                        <?php while ( have_rows( 'testimonials_repeater' ) ) : the_row(); ?>
                            <div class="testimony">
                                <?php if ( $testimony = get_sub_field( 'testimonial_text' ) ) : ?>
                                    <p class="testimony-quote"><?php esc_html_e( $testimony ); ?></p>
                                <?php endif; ?>
                                <?php if ( $name = get_sub_field( 'testimonial_name' ) ) : ?>
                                    <h3 class="testimony-name testimony-position">
                                        <?php
                                            esc_html_e( $name );
                                            if ( $position = get_sub_field( 'testimonial_position' ) ) {
                                                echo ', '; esc_html_e( $position );
                                            }
                                        ?>
                                    </h3>
                                <?php endif; ?>
                                <?php if ( $company = get_sub_field( 'testimonial_company' ) ) : ?>
                                    <h3 class="testimony-company"><?php esc_html_e( $company ); ?></h3>
                                <?php endif; ?>
                                
                            </div>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <p><?php esc_html_e( 'No se han encontrado testimonios.' ); ?></p>
                    <?php endif; ?>
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
                <div class="slideshow-buttons-wrapper">
                    <ul class="slideshow-buttons"></ul>
                </div>
            </div>
        </div>
    </section>
    <section id="services" class="block">
        <div class="container">
            <?php if ( $title = get_field( 'services_title' ) ) : ?>
                <h2 class="title-section"><?php esc_html_e( $title ); ?></h2>
            <?php endif; ?>
        </div>
        <div class="container content large-width">
            <div class="slideshow-wrapper">
                <div class="slideshow">
                    <?php if ( have_rows( 'services_repeater_2' ) ) : ?>
                        <?php while ( have_rows( 'services_repeater_2' ) ) : the_row(); ?>
                            <?php if ( $picture = get_sub_field('service_picture') ) : ?>
                                <?php 
                                    $url = esc_url( $picture['url'] );
                                    $alt = esc_attr( $picture['alt'] ?: 'Fotografía del servicio' );
                                    $srcset = wp_get_attachment_image_srcset( $picture['ID'], 'full' );
                                    $sizes = wp_get_attachment_image_sizes( $picture['ID'], 'full' );
                                ?>
                                <img class="service-picture" src="<?php echo $url; ?>" srcset="<?php echo esc_attr( $srcset ); ?>" sizes="<?php echo esc_attr( $sizes ); ?>" alt="<?php echo $alt; ?>" loading="lazy">
                            <?php endif; ?>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <p><?php esc_html_e( 'No se han encontrado servicios.' ); ?></p>
                    <?php endif; ?>
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
                <div class="slideshow-buttons-wrapper">
                    <ul class="slideshow-buttons"></ul>
                </div>
            </div>
        </div>
    </section>
</main><!-- .site-main -->

<?php get_footer(); ?>