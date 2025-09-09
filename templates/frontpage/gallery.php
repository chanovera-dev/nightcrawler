<section id="gallery" class="block">
    <div class="content">
        <?php if ( $title = get_field( 'gallery_title' ) ) : ?>
            <h2 class="title-section"><?php esc_html_e( $title ); ?></h2>
        <?php endif; ?>
    </div>
    <div class="content">
        <div class="gallery-slideshow" style="display: none;">
            <?php if ( have_rows('gallery_repeater') ) : ?>
                
                <?php while ( have_rows('gallery_repeater') ) : the_row(); 
                    $picture = get_sub_field('gallery_repeater_picture');
                ?>
                    <?php if ( $picture = get_sub_field('gallery_repeater_picture') ) : ?>
                    <?php 
                        $url = esc_url( $picture['url'] );
                        $alt = esc_attr( $picture['alt'] ?: 'Fotografía de productos enviados' );
                        $srcset = wp_get_attachment_image_srcset( $picture['ID'], 'full' );
                        $sizes = wp_get_attachment_image_sizes( $picture['ID'], 'full' );
                    ?>
                    <img class="gallery-image" src="<?php echo $url; ?>" srcset="<?php echo esc_attr( $srcset ); ?>" sizes="<?php echo esc_attr( $sizes ); ?>" alt="<?php echo $alt; ?>" loading="lazy">
                <?php endif; ?>         
                <?php endwhile; ?>                 
            <?php else: ?>
                <p><?php esc_html_e( 'Ninguna imagen encontrada', 'ernestovives' ); ?></p>
            <?php endif; ?>
        </div>
        <div class="slider-container" id="slider-container">
            <div class="slider-track" id="slider-track">
                <!-- Slides se inyectan dinámicamente -->
            </div>
            <div class="footer-slideshow slider-buttons">
                <button id="prev">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 320 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z"/></svg>
                </button>
                <div class="pagination" id="pagination"></div>
                <button id="next">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 320 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/></svg>
                </button>
            </div>
        </div>
    </div>
    <div class="lightbox" id="lightbox">
        <button class="close-lightbox" id="close-lightbox">&times;</button>
        <img id="lightbox-img" src="" alt="Imagen Ampliada">
    </div>
</section>