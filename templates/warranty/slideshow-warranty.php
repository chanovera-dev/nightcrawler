<section class="block warranty">
    <div class="content">
        <div class="container">
            <?php if( $title = get_field( 'warranty_services_title' ) ) : ?>
                <h2 class="title-section"><?php esc_html_e( $title ); ?></h2>
            <?php endif; ?>
            <?php if( $subtitle = get_field( 'warranty_services_subtitle' ) ) : ?>
                <h3 class="subtitle"><?php esc_html_e( $subtitle ); ?></h3>
            <?php endif; ?>
        </div>
        <div class="container">
            <div class="slideshow-wrapper">
                <div class="slideshow">
                    <?php if ( have_rows( 'warranty_repeater' ) ) : ?>
                        <?php while ( have_rows( 'warranty_repeater' ) ) : the_row(); ?>
                            <div class="warranty">
                                <div class="warranty__content">
                                    <?php if ( $picture = get_sub_field('warranty_background_picture') ) : ?>
                                        <?php 
                                            $url = esc_url( $picture['url'] );
                                            $alt = esc_attr( $picture['alt'] ?: 'Fotografía del servicio' );
                                            $srcset = wp_get_attachment_image_srcset( $picture['ID'], 'full' );
                                            $sizes = wp_get_attachment_image_sizes( $picture['ID'], 'full' );
                                        ?>
                                        <img class="warranty-background" src="<?php echo $url; ?>" srcset="<?php echo esc_attr( $srcset ); ?>" sizes="<?php echo esc_attr( $sizes ); ?>" alt="<?php echo $alt; ?>" loading="lazy">
                                    <?php endif; ?>
                                    <?php if ( $title = get_sub_field( 'warranty_title' ) ) : ?>
                                        <h3 class="warranty-title"><?php esc_html_e( $title ); ?></h3>
                                    <?php endif; ?>
                                    <?php if ( $content = get_sub_field( 'warranty_content' ) ) : ?>
                                        <div class="warranty-content"><?php echo $content; ?></div>
                                    <?php endif; ?>
                                    <?php if ( $link = get_sub_field( 'warranty_link' ) ) : ?>
                                        <a class="warranty-link" href="<?php esc_url( $link )?>">
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