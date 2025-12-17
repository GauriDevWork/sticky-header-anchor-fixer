<?php
defined( 'ABSPATH' ) || exit;

class SHAF_Settings {

    public static function init() {
        add_action( 'admin_menu', [ __CLASS__, 'menu' ] );
        add_action( 'admin_init', [ __CLASS__, 'settings' ] );
    }

    public static function menu() {
        add_options_page(
            'Sticky Header Anchor Fixer',
            'Sticky Anchor Fixer',
            'manage_options',
            'shaf-settings',
            [ __CLASS__, 'settings_page' ]
        );
    }

    public static function settings() {
        register_setting( 'shaf_options_group', 'shaf_options', [ __CLASS__, 'sanitize' ] );

        add_settings_section( 'shaf_main', '', '__return_false', 'shaf-settings' );

        add_settings_field(
            'offset',
            'Header Offset (px)',
            [ __CLASS__, 'field_offset' ],
            'shaf-settings',
            'shaf_main'
        );

        add_settings_field(
            'smooth',
            'Enable Smooth Scroll',
            [ __CLASS__, 'field_smooth' ],
            'shaf-settings',
            'shaf_main'
        );
    }

    public static function sanitize( $input ) {
        return [
            'offset' => isset( $input['offset'] ) ? absint( $input['offset'] ) : 80,
            'smooth' => ! empty( $input['smooth'] ) ? 1 : 0,
        ];
    }

    public static function field_offset() {
        $options = get_option( 'shaf_options', [] );
        $val = isset( $options['offset'] ) ? intval( $options['offset'] ) : 80;
        echo '<input type="number" name="shaf_options[offset]" value="' . esc_attr( $val ) . '" min="0" />';
    }

    public static function field_smooth() {
        $options = get_option( 'shaf_options', [] );
        $checked = ! empty( $options['smooth'] );
        echo '<input type="checkbox" name="shaf_options[smooth]" value="1" ' . checked( $checked, true, false ) . ' />';
    }

    public static function settings_page() {
        echo '<div class="wrap"><h1>Sticky Header Anchor Fixer</h1>';
        echo '<form method="post" action="options.php">';
        settings_fields( 'shaf_options_group' );
        do_settings_sections( 'shaf-settings' );
        submit_button();
        echo '</form></div>';
    }
}
