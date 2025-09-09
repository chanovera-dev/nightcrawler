<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="description" content="<?php bloginfo( 'description' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <header id="header" class="site-header block">
        <div class="content large-width">
            <div class="site-brand">
                <?php
                    if ( ! has_custom_logo() ) {
                        echo '<a href="' . get_home_url() . '" aria-label="link to home page">' . bloginfo( 'name' ) . '</a>';
                    } else {
                        the_custom_logo();
                    }
                ?>
            </div>
            <div class="support-navigation__wrapper">
                <div class="customer-service-contact">
                    <?php
                    // Load inline SVG icon
                    function get_inline_svg($filename) {
                        $path = get_template_directory() . '/assets/icons/' . $filename;
                        return file_exists($path) ? file_get_contents($path) : '';
                    }

                    echo get_inline_svg('header-phone.svg');

                    // Retrieve contact data from Customizer
                    $phone1 = get_theme_mod('phone_number1', '2294155160');
                    $phone2 = get_theme_mod('phone_number2', '2294482849');
                    $email  = get_theme_mod('email_support', 'atencionaclientes@yabaa.com');

                    // Format phone numbers
                    $formatted1 = format_phone_number($phone1);
                    $formatted2 = format_phone_number($phone2);
                    ?>
                    
                    <a class="customer-phone" href="tel:<?= esc_attr($phone1); ?>">
                        <?= esc_html($formatted1); ?>
                    </a>
                    <a class="customer-phone" href="tel:<?= esc_attr($phone2); ?>">
                        <?= esc_html($formatted2); ?>
                    </a>
                    <a class="customer-email" href="mailto:<?= esc_attr($email); ?>">
                        <?= esc_html($email); ?>
                    </a>
                </div>
                <?php
                    wp_nav_menu( array(
                        'container'       => 'nav',
                        'container_class' => 'main-navigation__wrapper',
                        'theme_location'  => 'primary',
                    ) );
                ?>
            </div>
            <div class="menu-mobile__button" onclick="toggleMenuMobile()">
                <span class="bar"></span>
            </div>
        </div>
    </header>