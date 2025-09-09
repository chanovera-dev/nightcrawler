<?php
if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

/**
 * Theme Core Functions
 *
 * This file contains the main functionality for the Nightcrawler theme.
 * It loads core components and initializes theme features.
 *
 * @package Nightcrawler
 * @since 1.0.0
 */

// Get current theme version using constant for caching
define('NIGHTCRAWLER_VERSION', wp_get_theme('nightcrawler')->get('Version'));

// Whitelist of allowed components and their paths
const NIGHTCRAWLER_COMPONENTS = [
    'core'       => '/inc/core.php',
    'extended'   => '/inc/extended.php', 
    'customizer' => '/inc/customizer.php',
    'templates'  => '/inc/templates.php',
];

// Load components safely
$components = [];
foreach (NIGHTCRAWLER_COMPONENTS as $key => $relative_path) {
    $file = realpath(__DIR__ . $relative_path);
    
    // Validate file is within theme directory
    if ($file && strpos($file, __DIR__) === 0 && file_exists($file)) {
        try {
            $components[$key] = require_once $file;
        } catch (Throwable $e) {
            error_log(sprintf(
                '[Nightcrawler Theme] Failed loading component %s: %s',
                esc_html($key),
                esc_html($e->getMessage())
            ));
            $components[$key] = null;
        }
    } else {
        error_log(sprintf(
            '[Nightcrawler Theme] Invalid component path: %s',
            esc_html($relative_path)
        ));
        $components[$key] = null;
    }
}

// Store version and components in immutable object
$nightcrawler = (object) array_merge(
    ['version' => NIGHTCRAWLER_VERSION],
    $components
);