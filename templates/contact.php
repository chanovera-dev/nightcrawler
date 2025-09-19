<?php
/**
 * Template Name: Contacto
*/
get_header(); ?>

<main id="main" class="site-main" role="main">
    <header class="block">
        <?php
            if ( has_post_thumbnail() ) {
                echo get_the_post_thumbnail( null, 'full', [ 'class' => 'thumbnail background-parallax background-hero', 'alt'   => get_the_title(), 'loading' => 'lazy', 'data-speed' => '0.25' ] );
            }
        ?>
        <div class="content">
            <?php if ( $title = get_field( 'contact_header_title' ) ) : ?>
                <h1 class="main-title"><?php esc_html_e( $title ); ?></h1>
            <?php endif; ?>
            <?php if ( $subtitle = get_field( 'contact_header_subtitle' ) ) : ?>
                <h2 class="subtitle"><?php esc_html_e( $subtitle ); ?></h2>
            <?php endif; ?>
        </div>
    </header>
    <div class="block">
        <div class="content breadcrumbs share">
            <?php
                if ( function_exists('wp_breadcrumbs') ) {
                    wp_breadcrumbs();
                }
            ?>
        </div>
    </div>
    <main class="block">
        <div class="content">
            <?php if ( $form = get_field( 'contact_content_form' ) ) : ?>
                <?= do_shortcode( $form ) ?>
            <?php endif; ?>
            <div class="info">
                <?php if ( $title = get_field( 'contact_info_title' ) ) : ?>
                    <h2 class="title-section"><?php esc_html_e( $title ); ?></h2>
                <?php endif; ?>
                <?php if ( $address = get_field( 'contact_info_address' ) ) : ?>
                    <div class="address"><?php echo wp_kses_post( $address ); ?></div>
                <?php endif; ?>
                <div class="emails">
                    <?php if ( have_rows( 'contact_emails_repeater' ) ) : ?>
                        <?php while( have_rows( 'contact_emails_repeater' ) ) : the_row(); ?>
                            <div class="contact">
                                <?php if ( $name = get_sub_field( 'contact_name' ) ) : ?>
                                    <h3 class="contact-name"><?php esc_html_e( $name ); ?></h3>
                                <?php endif; ?>
                                <?php if ( $position = get_sub_field( 'contact_position' ) ) : ?>
                                    <p class="contact-position"><?php esc_html_e( $position ); ?></p>
                                <?php endif; ?>
                                <?php if ( $email = get_sub_field( 'contact_email' ) ) : ?>
                                    <a href="mailto:<?php echo antispambot( $email ); ?>" class="contact-email"><?php esc_html_e( $email ); ?></a>
                                <?php endif; ?>
                            </div>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <p><?php esc_html_e( '', 'yabaaexpress' ); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>
</main><!-- .site-main -->

<?php get_footer(); ?>