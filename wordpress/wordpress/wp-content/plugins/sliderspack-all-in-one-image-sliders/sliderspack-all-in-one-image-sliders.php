<?php
/**
 * Plugin Name: Slider a SlidersPack - All In One Image/Post Slider
 * Plugin URI: https://www.essentialplugin.com/wordpress-plugin/sliderspack-one-image-post-slider/
 * Description: SlidersPack - All In One Image Slider plus FancyBox for WordPress. Also work with WordPress Posts. Work with Gutenberg shortcode block. Slider added - Flex Slider 2, bxSlider, Owl Carousel 2, Swiper Slider, 3D Slider, Wallop Slider, unSlider, Nivo Slider, Responsive Slides and Polaroids Gallery.
 * Author: WP OnlineSupport, Essential Plugin
 * Text Domain: sliderspack-all-in-one-image-sliders
 * Domain Path: /languages/
 * Version: 2.0.2
 * Author URI: https://www.essentialplugin.com/wordpress-plugin/sliderspack-one-image-post-slider/
 *
 * @package WordPress
 * @author WP OnlineSupport 
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if( ! defined( 'WP_APAIOIS_VERSION' ) ) {
	define( 'WP_APAIOIS_VERSION', '2.0.2' ); // Version of plugin
}
if( ! defined( 'WP_APAIOIS_DIR' ) ) {
	define( 'WP_APAIOIS_DIR', dirname( __FILE__ ) ); // Plugin dir
}
if( ! defined( 'WP_APAIOIS_URL' ) ) {
	define( 'WP_APAIOIS_URL', plugin_dir_url( __FILE__ ) ); // Plugin url
}
if( ! defined( 'WP_APAIOIS_POST_TYPE' ) ) {
	define( 'WP_APAIOIS_POST_TYPE', 'wpspaios_slider' ); // Plugin post type
}
if( ! defined( 'WP_APAIOIS_META_PREFIX' ) ) {
	define( 'WP_APAIOIS_META_PREFIX', '_spaios_' ); // Plugin metabox prefix
}
if( ! defined( 'WP_APAIOIS_PLUGIN_LINK' ) ) {
	define( 'WP_APAIOIS_PLUGIN_LINK', 'https://www.essentialplugin.com/wordpress-plugin/sliderspack-one-image-post-slider/?utm_source=WP&utm_medium=SlidersPack&utm_campaign=Features-PRO' ); // Plugin link
}

if( ! defined( 'WP_APAIOIS_PLUGIN_UPGRADE' ) ) {
	define( 'WP_APAIOIS_PLUGIN_UPGRADE', 'https://www.essentialplugin.com/wordpress-plugin/sliderspack-one-image-post-slider/?utm_source=WP&utm_medium=SlidersPack&utm_campaign=Upgrade-PRO' ); // Plugin link
}

if( ! defined( 'WP_APAIOIS_SITE_LINK' ) ) {
	define('WP_APAIOIS_SITE_LINK','https://www.essentialplugin.com'); // Plugin link
}

/**
 * Load Text Domain
 * This gets the plugin ready for translation
 * 
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */
function wp_spaios_load_textdomain() {

	global $wp_version;

	// Set filter for plugin's languages directory
	$wp_spaios_lang_dir = dirname( plugin_basename( __FILE__ ) ) . '/languages/';
	$wp_spaios_lang_dir = apply_filters( 'wp_spaios_languages_directory', $wp_spaios_lang_dir );
	
	// Traditional WordPress plugin locale filter.
	$get_locale = get_locale();

	if ( $wp_version >= 4.7 ) {
		$get_locale = get_user_locale();
	}

	// Traditional WordPress plugin locale filter
	$locale = apply_filters( 'plugin_locale',  $get_locale, 'sliderspack-all-in-one-image-sliders' );
	$mofile = sprintf( '%1$s-%2$s.mo', 'sliderspack-all-in-one-image-sliders', $locale );

	// Setup paths to current locale file
	$mofile_global  = WP_LANG_DIR . '/plugins/' . basename( WP_APAIOIS_DIR ) . '/' . $mofile;

	if ( file_exists( $mofile_global ) ) { // Look in global /wp-content/languages/plugin-name folder
		load_textdomain( 'sliderspack-all-in-one-image-sliders', $mofile_global );
	} else { // Load the default language files
		load_plugin_textdomain( 'sliderspack-all-in-one-image-sliders', false, $wp_spaios_lang_dir );
	}

}
add_action('plugins_loaded', 'wp_spaios_load_textdomain');

/**
 * Activation Hook
 * 
 * Register plugin activation hook.
 * 
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */
register_activation_hook( __FILE__, 'wp_spaios_install' );
add_action('admin_init', 'wp_spaios_plugin_redirect');
/**
 * Deactivation Hook
 * 
 * Register plugin deactivation hook.
 * 
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */
register_deactivation_hook( __FILE__, 'wp_spaios_uninstall');

/**
 * Plugin Setup (On Activation)
 * 
 * Does the initial setup,
 * set default values for the plugin options.
 * 
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */
function wp_spaios_install() {

	// Deactivate free version
	if( is_plugin_active('sliderspack-pro/sliderspack-all-in-one-image-sliders-pro.php') ) {
		add_action('update_option_active_plugins', 'wp_spaios_deactivate_pro_version');
	}

	// Register post type function
	wp_spaios_register_post_type();  

	// IMP need to flush rules for custom registered post type
	flush_rewrite_rules();
	add_option('sliderspack_plugin_do_activation_redirect', true);    
}

/**
 * Deactivate free plugin
 * 
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0.2
 */
function wp_spaios_deactivate_pro_version() {
	deactivate_plugins('sliderspack-pro/sliderspack-all-in-one-image-sliders-pro.php', true);
}

/**
 * Function to display admin notice of activated plugin.
 * 
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0.2
 */
function wp_spaios_plugin_admin_notice() {

	global $pagenow;

	$dir				= WP_PLUGIN_DIR . '/sliderspack-pro/sliderspack-all-in-one-image-sliders-pro.php';
	$notice_transient	= get_transient( 'wp_spaios_install_notice' );

	// If PRO plugin is active and free plugin exist
	if ( $notice_transient == false && file_exists($dir) && $pagenow == 'plugins.php' && current_user_can( 'install_plugins' ) ) {

		$notice_link = add_query_arg( array('message' => 'wp-spaios-install-notice'), admin_url('plugins.php') );

		echo '<div id="message" class="updated notice" style="position:relative;">
				<p>'.sprintf( __('<strong>Thank you for activating SlidersPack - All In One Image/Post Slider</strong>.<br /> It looks like you had Pro version <strong>(<em>SlidersPack Pro - All In One Image/Post Slider</em>)</strong> of this plugin activated. To avoid conflicts the extra version has been deactivated and we recommend you delete it.', 'sliderspack-all-in-one-image-sliders') ).'</p>
				<a href="'.esc_url( $notice_link ).'" class="notice-dismiss" style="text-decoration:none;"></a>
			</div>';
	}
}

// Action to display notice
add_action( 'admin_notices', 'wp_spaios_plugin_admin_notice');

/**
 * Plugin Setup (After Activation)
 * 
 * Does the initial setup,
 * set default values for the plugin options.
 * 
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */
function wp_spaios_plugin_redirect() {
	if ( get_option('sliderspack_plugin_do_activation_redirect', false) ) {
		delete_option('sliderspack_plugin_do_activation_redirect');
		wp_redirect(admin_url( 'edit.php?post_type=wpspaios_slider&page=welcome_sliderspack' ));
	}
}

/**
 * Plugin Setup (On Deactivation)
 * 
 * Delete  plugin options.
 * 
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */
function wp_spaios_uninstall() {

	// IMP need to flush rules for custom registered post type
	flush_rewrite_rules();
}

// Functions File
require_once( WP_APAIOIS_DIR . '/includes/wp-spaios-functions.php' );

// Plugin Post Type File
require_once( WP_APAIOIS_DIR . '/includes/wp-spaios-post-types.php' );

// Script File
require_once( WP_APAIOIS_DIR . '/includes/class-wp-spaios-script.php' );

// Admin Class File
require_once( WP_APAIOIS_DIR . '/includes/admin/class-wp-spaios-admin.php' );

// Shortcode File
require_once( WP_APAIOIS_DIR . '/includes/shortcode/sliderspack-shortcode.php' );

// About file, Load admin files
if ( is_admin() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {
	require_once( WP_APAIOIS_DIR . '/includes/admin/wp-spaios-about.php' );	
}