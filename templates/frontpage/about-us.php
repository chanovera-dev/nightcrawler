<section id="about-us" class="block">
    <div class="container">
        <?php if ( $picture = get_field('about_us_main_picture') ) : ?>
            <?php 
                $url = esc_url( $picture['url'] );
                $alt = esc_attr( $picture['alt'] ?: 'Fotografía principal de la sección nosotros' );
                $srcset = wp_get_attachment_image_srcset( $picture['ID'], 'full' );
                $sizes = wp_get_attachment_image_sizes( $picture['ID'], 'full' );
            ?>
            <img class="main-picture" src="<?php echo $url; ?>" srcset="<?php echo esc_attr( $srcset ); ?>" sizes="<?php echo esc_attr( $sizes ); ?>" alt="<?php echo $alt; ?>" loading="lazy">
        <?php endif; ?>
    </div>
    <div class="container">
        <div class="container">
            <?php if ( have_rows( 'about_us_repeater' ) ) : ?>
                <?php while( have_rows( 'about_us_repeater' ) ) : the_row(); ?>
                    <div class="about-card">
                        <div class="about-card__header">
                            <?php
                                $svg_id = get_sub_field('about_card_icon');
                                if ( $svg_id ) {
                                    $svg_path = get_attached_file( $svg_id );

                                    if ( file_exists( $svg_path ) ) {
                                        $svg_content = file_get_contents( $svg_path );
                                        echo $svg_content;
                                    }
                                }
                                if ( $title = get_sub_field( 'about_card_title' ) ) {
                                    esc_html_e( $title );
                                }
                            ?>
                        </div>
                        <div class="about-card__content">
                            <?php 
                                if( $text = get_sub_field( 'about_card_text' ) ) {
                                    echo wp_kses_post( $text );
                                }
                            ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else : ?>
                <p><?php esc_html_e( 'No se han encontrado datos acerca de Yabaa Express' ); ?></p>
            <?php endif; ?>
        </div>
        <div class="container-request-quote">
            <?php
                $svg_id = get_field('about_us_letter_icon');
                if ( $svg_id ) {
                    $svg_path = get_attached_file( $svg_id );

                    if ( file_exists( $svg_path ) ) {
                        $svg_content = file_get_contents( $svg_path );
                        echo $svg_content;
                    }
                }
            ?>
            <div class="request-quote">
                <?php if ( $title = get_field( 'request_quote_title' ) ) : ?>
                    <h3 class="request-title"><?php esc_html_e( $title ); ?></h3>
                <?php endif; ?>
                <?php if ( $text = get_field( 'request_quote_text' ) ) : ?>
                    <p><?php esc_html_e( $text ); ?></p>
                <?php endif; ?>
            </div>
            <a href="" class="send-request">
                ENVIAR REQUERIMIENTO
            </a>
        </div>
    </div>
</section>