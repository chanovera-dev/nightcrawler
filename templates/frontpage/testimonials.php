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
    <div class="container">
        <?php if ( $title = get_field( 'testimonials_title' ) ) : ?>
            <h2 class="title-section"><?php esc_html_e( $title ); ?></h2>
        <?php endif; ?>
    </div>
    <div class="container content large-width">
        <div class="slideshow-wrapper">
            <div class="slideshow">
                <?php if ( have_rows( 'testimonials_repeater' ) ) : ?>
                    <?php while ( have_rows( 'testimonials_repeater' ) ) : the_row(); ?>
                        <div class="testimony">
                            <?php if ( $picture = get_sub_field('testimonial_picture') ) : ?>
                                <?php 
                                    $url = esc_url( $picture['url'] );
                                    $alt = esc_attr( $picture['alt'] ?: 'Fotografía del testigo' );
                                    $srcset = wp_get_attachment_image_srcset( $picture['ID'], 'full' );
                                    $sizes = wp_get_attachment_image_sizes( $picture['ID'], 'full' );
                                ?>
                                <img class="testimony-avatar" src="<?php echo $url; ?>" srcset="<?php echo esc_attr( $srcset ); ?>" sizes="<?php echo esc_attr( $sizes ); ?>" alt="<?php echo $alt; ?>" loading="lazy">
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
                            <?php if ( $testimony = get_sub_field( 'testimonial_text' ) ) : ?>
                                <p class="testimony-quote"><?php esc_html_e( $testimony ); ?></p>
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