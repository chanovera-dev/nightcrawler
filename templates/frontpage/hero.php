<section id="hero" class="block">
    <div class="content">
        <?php if ( have_rows( 'hero_repeater' )) : ?>
        <div class="services-cards tabs">

            <?php if ( have_rows( 'hero_repeater' ) ) : ?>
                <?php $index = 1; ?>
                <?php while ( have_rows( 'hero_repeater' ) ) : the_row(); ?>
                    <input type="radio" id="btn<?php echo $index; ?>" name="tab-control" <?php checked( $index, 1 ); ?>>
                    <?php $index++; ?>
                <?php endwhile; ?>
            <?php endif; ?>

            <?php if ( have_rows( 'hero_repeater' ) ) : ?>
                <ul class="card-btns">
                    <?php $index = 1; ?>
                    <?php while( have_rows( 'hero_repeater' ) ) : the_row(); ?>
                        <li>
                            <label for="btn<?php echo $index; ?>">
                                <?php if ( $title = get_sub_field( 'hero_card_title' ) ) : ?>
                                    <?php echo esc_html( $title ); ?>
                                <?php endif; ?>
                            </label>
                        </li>
                        <?php $index++; ?>
                    <?php endwhile; ?>
                </ul>
            <?php endif; ?>

            <div class="card-content--container">
                <?php if ( have_rows( 'hero_repeater' ) ) : ?>
                    <?php while ( have_rows( 'hero_repeater' ) ) : the_row(); ?>
                        <div class="card">
                            <?php if ( $picture = get_sub_field('hero_card_picture') ) : ?>
                                <?php 
                                    $url = esc_url( $picture['url'] );
                                    $alt = esc_attr( $picture['alt'] ?: 'Fotografía del srvicio' );
                                    $srcset = wp_get_attachment_image_srcset( $picture['ID'], 'full' );
                                    $sizes = wp_get_attachment_image_sizes( $picture['ID'], 'full' );
                                ?>
                                <img class="picture" src="<?php echo $url; ?>" srcset="<?php echo esc_attr( $srcset ); ?>" sizes="<?php echo esc_attr( $sizes ); ?>" alt="<?php echo $alt; ?>" loading="lazy">
                            <?php endif; ?>

                            <?php if ( $title = get_sub_field( 'hero_card_title' ) ) : ?>
                                <div class="slide-title__wrapper">
                                    <h3 class="slide-title"><?php echo esc_html( $title ); ?></h3>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>

            <?php if ( have_rows( 'hero_repeater' ) ) : ?>
                <div class="scroll-icon"></div>
                <ul class="card-btns lines">
                    <?php $index = 1; ?>
                    <?php while( have_rows( 'hero_repeater' ) ) : the_row(); ?>
                        <li>
                            <label for="btn<?php echo $index; ?>">
                                <?php if ( $title = get_sub_field( 'hero_card_title' ) ) : ?>
                                    <?php echo esc_html( $title ); ?>
                                <?php endif; ?>
                            </label>
                        </li>
                        <?php $index++; ?>
                    <?php endwhile; ?>
                </ul>
            <?php endif; ?>

            <?php require get_template_directory() . '/templates/frontpage/hero/styles.php'; ?>

        </div>

        <?php if ( have_rows( 'hero_repeater' ) ) : ?>
            <div class="card-nav">             
                <button type="button" class="card-nav__btn prev" aria-label="Anterior">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0"/>
                    </svg>
                </button>
                <button type="button" class="card-nav__btn next" aria-label="Siguiente">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708"/>
                    </svg>
                </button>
            </div>
        <?php endif; ?>
    </div>
    <?php else: ?>
        <p style="padding: 20px 0;"><?php esc_html_e( 'No se han encontrado slides' ); ?></p>
    <?php endif; ?>
</section>