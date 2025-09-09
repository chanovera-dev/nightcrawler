<section id="supply-chain" class="block">
    <div class="content large-width">
        <?php if ( $picture = get_field('supply_chain_main_picture') ) : ?>
            <?php 
                $url = esc_url( $picture['url'] );
                $alt = esc_attr( $picture['alt'] ?: 'Fotografía principal de la cadena de suministros' );
                $srcset = wp_get_attachment_image_srcset( $picture['ID'], 'full' );
                $sizes = wp_get_attachment_image_sizes( $picture['ID'], 'full' );
            ?>
            <img class="picture" src="<?php echo $url; ?>" srcset="<?php echo esc_attr( $srcset ); ?>" sizes="<?php echo esc_attr( $sizes ); ?>" alt="<?php echo $alt; ?>" loading="lazy">
        <?php endif; ?>
        <?php if ( $title = get_field( 'supply_chain_title_section' ) ) : ?>
            <h2 class="title-section"><?php esc_html_e( $title ); ?></h2>
        <?php endif; ?>
        <div class="assets">
            <?php if ( have_rows( 'supply_chain_repeater' ) ) : ?>
                <?php while( have_rows( 'supply_chain_repeater' ) ) : the_row(); ?>
                    <div class="asset">
                        <?php if ( $title = get_sub_field( 'supply_chain_repeater_title' ) ) : ?>
                            <h3 class="asset-title"><?php esc_html_e( $title ); ?></h3>
                        <?php endif; ?>
                        <?php if ( $picture = get_sub_field('supply_chain_repeater_picture') ) : ?>
                            <?php 
                                $url = esc_url( $picture['url'] );
                                $alt = esc_attr( $picture['alt'] ?: 'Fotografía principal de la cadena de suministros' );
                                $srcset = wp_get_attachment_image_srcset( $picture['ID'], 'full' );
                                $sizes = wp_get_attachment_image_sizes( $picture['ID'], 'full' );
                            ?>
                            <img class="asset-picture" src="<?php echo $url; ?>" srcset="<?php echo esc_attr( $srcset ); ?>" sizes="<?php echo esc_attr( $sizes ); ?>" alt="<?php echo $alt; ?>" loading="lazy">
                        <?php endif; ?>
                        <?php if ( $number = get_sub_field( 'supply_chain_repeater_number' ) ) : ?>
                            <p class="asset-number"><?php esc_html_e( $number ); ?></p>
                        <?php endif; ?>
                        <?php if ( $text = get_sub_field( 'supply_chain_repeater_text' ) ) : ?>
                            <p class="asset-text"><?php esc_html_e( $text ); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            <?php else : ?>
                <p><?php esc_html_e( 'No se han encontrado assets', 'yabaaexpress' ); ?></p>
            <?php endif; ?>
        </div>
    </div>
</section>