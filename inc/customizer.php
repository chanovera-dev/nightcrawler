<?php
/**
 * Theme Customizer Settings
 * 
 * Handles all WordPress Customizer functionality including:
 * - Contact information settings
 * - Support phone numbers
 * - Email configurations
 * - Company description
 * 
 * @package Nightcrawler
 * @since 1.0.0
 */

/**
 * Register Customizer Settings
 * 
 * Adds custom sections and controls to WordPress Customizer:
 * - Contact data section
 * - Multiple phone number fields
 * - Support email field
 * - About company text area
 *
 * @param WP_Customize_Manager $wp_customize WordPress customizer object
 * @return void
 */

function theme_customizer($wp_customize) {
    // Contact Information Section
    $wp_customize->add_section('contact__data', array(
        'title' => __('Datos de contacto', 'nightcrawler'),
        'description' => __('Establece los datos de contacto'), 
        'priority' => 11,
    ));
        // Support Phone Number 1
        $wp_customize->add_setting('phone_number1', array(
            'default' => __('2294155160', 'nightcrawler'),
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control('phone_number1', array(
            'label' => __('Teléfono de Soporte 1', 'nightcrawler'),
            'section' => 'contact__data',
        ));
        // Support Phone Number 2
        $wp_customize->add_setting('phone_number2', array(
            'default' => __('2294482849', 'nightcrawler'),
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control('phone_number2', array(
            'label' => __('Teléfono de Soporte 2', 'nightcrawler'),
            'section' => 'contact__data',
        ));
        // Quotes Phone Number
        $wp_customize->add_setting('phone_cotizaciones', array(
            'default' => __('2294155160', 'nightcrawler'),
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control('phone_cotizaciones', array(
            'label' => __('Teléfono de Cotizaciones', 'nightcrawler'),
            'section' => 'contact__data',
        ));
        // Support Email
        $wp_customize->add_setting('email_support', array(
            'default' => __('atencionaclientes@yabaa.com', 'nightcrawler'),
            'sanitize_callback' => 'sanitize_email'
        ));
        $wp_customize->add_control('email_support', array(
            'label' => __('Email de Soporte', 'nightcrawler'),
            'section' => 'contact__data',
        ));
        // About Company Text
        $wp_customize->add_setting('about_us_text', array(
            'default' => __('Desde 1997, ofrecemos soluciones de mensajería y paquetería nacionales e internacionales, adaptándonos a las necesidades de nuestros clientes para enviar alimentos y medicamentos a Estados Unidos y Canadá.', 'nightcrawler'),
            'sanitize_callback' => 'wp_kses_post'
        ));
        $wp_customize->add_control('about_us_text', array(
            'label' => __('About Yabaa Express', 'nightcrawler'),
            'section' => 'contact__data',
            'type' => 'textarea'
        ));         
}
add_action('customize_register', 'theme_customizer');