<?php
defined( 'ABSPATH' ) || exit;

class SHAF_Frontend {

    public static function init() {
        add_action( 'wp_enqueue_scripts', [ __CLASS__, 'enqueue_scripts' ] );
    }

    public static function enqueue_scripts() {
        $options = get_option( 'shaf_options', [] );

        wp_enqueue_script(
            'shaf-fixer',
            plugin_dir_url( __FILE__ ) . '../assets/js/fixer.js',
            [],
            '1.0.0',
            true
        );

        wp_localize_script(
            'shaf-fixer',
            'shaf_params',
            [
                'offset' => isset( $options['offset'] ) ? intval( $options['offset'] ) : 80,
                'smooth' => ! empty( $options['smooth'] ),
            ]
        );
    }
}
