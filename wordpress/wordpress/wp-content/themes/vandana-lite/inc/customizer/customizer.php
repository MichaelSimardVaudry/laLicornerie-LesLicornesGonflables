<?php
/**
 * Vandana Lite Theme Customizer
 *
 * @package Vandana_Lite
 */

/**
 * Requiring customizer panels & sections
*/

$vandana_lite_sections     = array( 'info', 'site', 'appearance', 'layout', 'home', 'general', 'footer' );

foreach( $vandana_lite_sections as $s ){
    require get_template_directory() . '/inc/customizer/' . $s . '.php';
}

/**
 * Sanitization Functions
*/
require get_template_directory() . '/inc/customizer/sanitization-functions.php';

/**
 * Active Callbacks
*/
require get_template_directory() . '/inc/customizer/active-callback.php';

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function vandana_lite_customize_preview_js() {
	wp_enqueue_script( 'vandana-customizer', get_template_directory_uri() . '/inc/js/customizer.js', array( 'customize-preview' ), VANDANA_LITE_THEME_VERSION, true );
}
add_action( 'customize_preview_init', 'vandana_lite_customize_preview_js' );

function vandana_lite_customize_script(){
    $array = array(
        'home'       => get_permalink( get_option( 'page_on_front' ) ),
        'flushFonts' => wp_create_nonce( 'vandana-lite-local-fonts-flush' ),
    );
    wp_enqueue_style( 'vandana-customize', get_template_directory_uri() . '/inc/css/customize.css', array(), VANDANA_LITE_THEME_VERSION );
    wp_enqueue_script( 'vandana-customize', get_template_directory_uri() . '/inc/js/customize.js', array( 'jquery', 'customize-controls' ), VANDANA_LITE_THEME_VERSION, true );
    wp_localize_script( 'vandana-customize', 'vandana_lite_cdata', $array );

    wp_localize_script( 'vandana-lite-repeater', 'vandana_lite_customize',
		array(
			'nonce' => wp_create_nonce( 'vandana_lite_customize_nonce' )
		)
	);
}
add_action( 'customize_controls_enqueue_scripts', 'vandana_lite_customize_script' );

/*
 * Notifications in customizer
 */
require get_template_directory() . '/inc/customizer-plugin-recommend/customizer-notice/class-customizer-notice.php';

require get_template_directory() . '/inc/customizer-plugin-recommend/plugin-install/class-plugin-install-helper.php';

require get_template_directory() . '/inc/customizer-plugin-recommend/plugin-install/class-plugin-recommend.php';

$config_customizer = array(
	'recommended_plugins' => array(
		//change the slug for respective plugin recomendation
        'blossomthemes-toolkit' => array(
			'recommended' => true,
			'description' => sprintf(
				/* translators: %s: plugin name */
				esc_html__( 'If you want to take full advantage of the features this theme has to offer, please install and activate %s plugin.', 'vandana-lite' ), '<strong>BlossomThemes Toolkit</strong>'
			),
		),
	),
	'recommended_plugins_title' => esc_html__( 'Recommended Plugin', 'vandana-lite' ),
	'install_button_label'      => esc_html__( 'Install and Activate', 'vandana-lite' ),
	'activate_button_label'     => esc_html__( 'Activate', 'vandana-lite' ),
	'deactivate_button_label'   => esc_html__( 'Deactivate', 'vandana-lite' ),
);
vandana_lite_Customizer_Notice::init( apply_filters( 'vandana_lite_customizer_notice_array', $config_customizer ) );

if(!function_exists('vandana_lite_ajax_delete_fonts_folder') ) :
/**
 * Reset font folder
 *
 * @access public
 * @return void
 */
function vandana_lite_ajax_delete_fonts_folder() {
	// Check request.
	if ( ! check_ajax_referer( 'vandana-lite-local-fonts-flush', 'nonce', false ) ) {
		wp_send_json_error( 'invalid_nonce' );
	}
	if ( ! current_user_can( 'edit_theme_options' ) ) {
		wp_send_json_error( 'invalid_permissions' );
	}
	if ( class_exists( '\Vandana_Lite_WebFont_Loader' ) ) {
		$font_loader = new \Vandana_Lite_WebFont_Loader( '' );
		$removed = $font_loader->delete_fonts_folder();
		if ( ! $removed ) {
			wp_send_json_error( 'failed_to_flush' );
		}
		wp_send_json_success();
	}
	wp_send_json_error( 'no_font_loader' );
}
endif;
add_action( 'wp_ajax_vandana_lite_flush_fonts_folder', 'vandana_lite_ajax_delete_fonts_folder' );