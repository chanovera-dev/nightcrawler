<section id="rastreo" class="block">
    <?php if ( $picture = get_field('rastreo_background') ) : ?>
        <?php 
            $url = esc_url( $picture['url'] );
            $alt = esc_attr( $picture['alt'] ?: 'Fotografía de servicio' );
            $srcset = wp_get_attachment_image_srcset( $picture['ID'], 'full' );
            $sizes = wp_get_attachment_image_sizes( $picture['ID'], 'full' );
        ?>
        <img class="background-rastreo background-hero" src="<?php echo $url; ?>" srcset="<?php echo esc_attr( $srcset ); ?>" sizes="<?php echo esc_attr( $sizes ); ?>" alt="<?php echo $alt; ?>" loading="lazy" data-speed="0.25">
    <?php endif; ?>
    <div class="content">

        <div class="iframe--wrapper">
            <iframe
                title="Widget de seguimiento de envíos"
                src="https://postal.ninja/widget/tracker"
                style="width: 100%; height: 300px;"
                frameborder="0">
            </iframe>
        </div>
    </div>
</section>