        <footer id="footer">
            <a class="whatsapp-link" href="https://api.whatsapp.com/send/?phone=2294155160&text=Hola+Yabba+Express%2C+necesito+ayuda+para+enviar+o+rastrear+un+paquete.&type=phone_number&app_absent=0" target="_blank">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/WhatsApp.svg.png" alt="WhatsApp Icon">
            </a>
            <div class="block top-footer">
                <div class="content large-width">
                    <div class="footer-links about-us">
                        <h2 class="footer-links__title"><?php esc_html_e( 'Acerca de ', 'yabaaexpress' ); echo bloginfo( 'name' ); ?></h2>
                        <p class="about-us__text"><?= get_theme_mod( 'about_us_text', 'Desde 1997, ofrecemos soluciones de mensajería y paquetería nacionales e internacionales, adaptándonos a las necesidades de nuestros clientes para enviar alimentos y medicamentos a Estados Unidos y Canadá.' ); ?></p>
                        <?php
                            wp_nav_menu( array(
                                    'container'       => 'nav',
                                    'container_class' => 'social',
                                    'theme_location'  => 'social',
                                ) );
                        ?>
                    </div>
                    <?php
                        function render_footer_menu_section( $location_slug, $container_class ) {
                            $locations = get_nav_menu_locations();

                            if ( ! isset( $locations[ $location_slug ] ) ) {
                                return;
                            }

                            $menu_id = $locations[ $location_slug ];
                            $menu_obj = wp_get_nav_menu_object( $menu_id );
                            $items = wp_get_nav_menu_items( $menu_id );

                            if ( empty( $items ) ) {
                                return;
                            }

                            echo '<div class="footer-links">';
                            echo '<h2 class="footer-links__title">' . esc_html( $menu_obj->name ) . '</h2>';
                            wp_nav_menu( array(
                                'container'       => 'nav',
                                'container_class' => $container_class,
                                'theme_location'  => $location_slug,
                            ) );
                            echo '</div>';
                        }

                        // Render each footer menu
                        render_footer_menu_section( 'services', 'services' );
                        render_footer_menu_section( 'subsidiaries', 'subsidiaries' );
                        render_footer_menu_section( 'contact', 'contact' );
                    ?>
                </div>
            </div>
            <div class="block bottom-footer">
                <div class="content large-width">
                    <p><?php echo '© '; bloginfo( 'name' ); echo ' ' . date("Y"); ?> • <?= __('Todos los Derechos Reservados', 'yabaaexpress') ?></p>
                </div>
            </div>
        </footer>
        <?php wp_footer(); ?>
    </body>
</html>