<?php
/**
 * Plugin Name: Sticky Header Anchor Fixer
 * Plugin URI:  https://github.com/yourname/sticky-header-anchor-fixer
 * Description: Fixes anchor links hidden behind sticky headers by adjusting scroll offset dynamically.
 * Version:     1.0.0
 * Author:      Your Name
 * Text Domain: sticky-header-anchor-fixer
 * License:     GPLv2 or later
 */

defined( 'ABSPATH' ) || exit;

class SHAF_Plugin {

    public static function init() {

        // Include files
        require_once plugin_dir_path( __FILE__ ) . 'includes/class-shaf-frontend.php';
        require_once plugin_dir_path( __FILE__ ) . 'includes/class-shaf-settings.php';

        // Initialize components
        SHAF_Frontend::init();
        SHAF_Settings::init();
    }
}

SHAF_Plugin::init();
