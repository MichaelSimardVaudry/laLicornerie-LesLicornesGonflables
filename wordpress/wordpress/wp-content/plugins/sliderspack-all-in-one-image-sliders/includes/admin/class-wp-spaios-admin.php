<?php
/**
 * Admin Class
 *
 * Handles the Admin side functionality of plugin
 *
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Wp_spaios_Admin {

	function __construct() {
		
		// Action to add metabox
		add_action( 'add_meta_boxes', array($this, 'wp_spaios_post_sett_metabox') );

		// Action to save metabox
		add_action( 'save_post', array($this, 'wp_spaios_save_metabox_value') );

		// Action to add custom column to Gallery listing
		add_filter( 'manage_'.WP_APAIOIS_POST_TYPE.'_posts_columns', array($this, 'wp_spaios_posts_columns') );

		// Action to add custom column data to Gallery listing
		add_action('manage_'.WP_APAIOIS_POST_TYPE.'_posts_custom_column', array($this, 'wp_spaios_post_columns_data'), 10, 2);

		// Filter to add row data
		add_filter( 'post_row_actions', array($this, 'wp_spaios_add_post_row_data'), 10, 2 );

		// Action to add Attachment Popup HTML
		add_action( 'admin_footer', array($this,'wp_spaios_image_update_popup_html') );

		// Ajax call to update option
		add_action( 'wp_ajax_wp_spaios_get_attachment_edit_form', array($this, 'wp_spaios_get_attachment_edit_form'));
		add_action( 'wp_ajax_nopriv_wp_spaios_get_attachment_edit_form',array( $this, 'wp_spaios_get_attachment_edit_form'));

		// Ajax call to update attachment data
		add_action( 'wp_ajax_wp_spaios_save_attachment_data', array($this, 'wp_spaios_save_attachment_data'));
		add_action( 'wp_ajax_nopriv_wp_spaios_save_attachment_data',array( $this, 'wp_spaios_save_attachment_data'));
	}

	/**
	 * Post Settings Metabox
	 * 
	 * @package SlidersPack - All In One Image Sliders
	 * @since 1.0
	 */
	function wp_spaios_post_sett_metabox() {

		// Post Type Meta Box
		add_meta_box( 'wp-spaios-post-sett', __( 'Select Images', 'sliderspack-all-in-one-image-sliders' ), array($this, 'wp_spaios_post_sett_mb_content'), WP_APAIOIS_POST_TYPE, 'normal', 'high' );

		// Slider Type Meta Box
		add_meta_box( 'wp-spaios-select-slider', __( 'Select Slider', 'sliderspack-all-in-one-image-sliders' ), array($this, 'wp_spaios_slider_type_mb_content'), WP_APAIOIS_POST_TYPE, 'normal', 'high' );

		// Slider Parameters Meta Box
		add_meta_box( 'wp-spaios-post-slider-sett', __( 'Slider Parameters', 'sliderspack-all-in-one-image-sliders' ), array($this, 'wp_spaios_slider_parameters_mb_content'), WP_APAIOIS_POST_TYPE, 'normal', 'default' );

		// Quick - Side Meta Box
		add_meta_box( 'wp-spaios-shrt-prev', __( 'How to Use', 'inboundwp' ), array($this, 'wp_spaios_shrt_prev_mb_content'), WP_APAIOIS_POST_TYPE, 'side' );
	}
	
	/**
	 * Post Settings Metabox HTML
	 * 
	 * @package SlidersPack - All In One Image Sliders
	 * @since 1.0
	 */
	function wp_spaios_post_sett_mb_content() {
		include_once( WP_APAIOIS_DIR .'/includes/admin/metabox/post-sett-metabox.php');
	}
	
	/**
	 * Post Settings Metabox HTML
	 * 
	 * @package SlidersPack - All In One Image Sliders
	 * @since 1.0
	 */
	function wp_spaios_slider_type_mb_content() {
		include_once( WP_APAIOIS_DIR .'/includes/admin/metabox/slider-type-metabox.php');
	}

	/**
	 * Post Settings Metabox HTML
	 * 
	 * @package SlidersPack - All In One Image Sliders
	 * @since 1.0
	 */
	function wp_spaios_slider_parameters_mb_content() {
		include_once( WP_APAIOIS_DIR .'/includes/admin/metabox/slider-parameters-metabox.php');
	}

	/**
	 * Quick Post Settings Metabox HTML
	 *
	 * @package SlidersPack - All In One Image Sliders
	 * @since 1.0
	 */
	function wp_spaios_shrt_prev_mb_content() {
		include_once( WP_APAIOIS_DIR .'/includes/admin/metabox/shortcode-metabox.php');
	}

	/**
	 * Function to save metabox values
	 * 
	 * @package SlidersPack - All In One Image Sliders
	 * @since 1.0
	 */
	function wp_spaios_save_metabox_value( $post_id ) {

		global $post_type;

		if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )                	// Check Autosave
		|| ( ! isset( $_POST['post_ID'] ) || $post_id != $_POST['post_ID'] )  	// Check Revision
		|| ( !current_user_can('edit_post', $post_id) )              			// Check if user can edit the post.
		|| ( $post_type != WP_APAIOIS_POST_TYPE ) )             			// Check if user can edit the post.
		{
		  return $post_id;
		}

		// Takig some variable
		$prefix				= WP_APAIOIS_META_PREFIX; // Taking metabox prefix
		$check_post_gallery	= ! empty( $_POST[$prefix.'check_post_gallery'] )	? wp_spaios_clean( $_POST[$prefix.'check_post_gallery'] )	: 'gallery';
		$slider_type		= isset( $_POST[$prefix.'slider_type'] )			? wp_spaios_clean( $_POST[$prefix.'slider_type'] )			: '';
		$include_category	= isset( $_POST[$prefix.'include_category'] )		? wp_spaios_clean( $_POST[$prefix.'include_category'] )		: '';
		$acf_field_name		= isset( $_POST[$prefix.'acf_field_name'] )			? wp_spaios_clean( $_POST[$prefix.'acf_field_name'] )		: '';
		$gallery_imgs		= isset( $_POST['wp_spaios_img'] )					? wp_spaios_clean( $_POST['wp_spaios_img'] )				: '';

		// Post Parameters
		$slide_ptype_limit			= ! empty( $_POST[$prefix.'slide_ptype_limit'] )			? $_POST[$prefix.'slide_ptype_limit']		: 20;
		$content_word_limit			= ! empty( $_POST[$prefix.'content_word_limit'] )			? $_POST[$prefix.'content_word_limit']		: 20;
		$content_readmore_text		= ! empty( $_POST[$prefix.'content_readmore_text'] )		? $_POST[$prefix.'content_readmore_text']	: __('Read More', 'sliderspack-all-in-one-image-sliders');
		$slide_ptype_title			= ( $_POST[$prefix.'slide_ptype_title'] == 'true' )			? 'true' : 'false';
		$slide_ptype_content		= ( $_POST[$prefix.'slide_ptype_content'] == 'true' )		? 'true' : 'false';
		$slide_ptype_readmorebtn	= ( $_POST[$prefix.'slide_ptype_readmorebtn'] == 'true' )	? 'true' : 'false';
		$slide_ptype_cat_name		= ( $_POST[$prefix.'slide_ptype_cat_name'] == 'true' )		? 'true' : 'false';

		// Common Parameters
		$arrow				= ( $_POST[$prefix.'arrow'] == 'true' )			? 'true' : 'false';
		$pagination			= ( $_POST[$prefix.'pagination'] == 'true' )	? 'true' : 'false';
		$loop				= ( $_POST[$prefix.'loop'] == 'true' )			? 'true' : 'false';
		$caption			= ( $_POST[$prefix.'caption'] == 'true' )		? 'true' : 'false';
		$fancy_box			= ( $_POST[$prefix.'fancy_box'] == 'true' )		? 'true' : 'false';
		$autoplay			= ( $_POST[$prefix.'autoplay'] == 'true' )		? 'true' : 'false';
		$link_target		= ! empty( $_POST[$prefix.'link_target'] )		? wp_spaios_clean( $_POST[$prefix.'link_target'] )					: '_blank';
		$slide_media_size	= isset( $_POST[$prefix.'slide_media_size'] )	? wp_spaios_clean( $_POST[$prefix.'slide_media_size'] )				: 'large';
		$autoplay_speed		= isset( $_POST[$prefix.'autoplay_speed'] )		? wp_spaios_clean_number( $_POST[$prefix.'autoplay_speed'], 3000 )	: '';
		$speed				= isset( $_POST[$prefix.'speed'] )				? wp_spaios_clean_number( $_POST[$prefix.'speed'], 1000 )			: '';

		// Bx Slider Parameters
		$mode_bx				= isset( $_POST[$prefix.'mode_bx'] )				? wp_spaios_clean( $_POST[$prefix.'mode_bx'] )							: 'horizontal';
		$slide_to_show_bx		= isset( $_POST[$prefix.'slide_to_show_bx'] )		? wp_spaios_clean_number($_POST[$prefix.'slide_to_show_bx'], '' )		: '';
		$max_slide_to_show_bx	= isset( $_POST[$prefix.'max_slide_to_show_bx'] )	? wp_spaios_clean_number($_POST[$prefix.'max_slide_to_show_bx'], '' )	: '';
		$slide_to_scroll_bx		= isset( $_POST[$prefix.'slide_to_scroll_bx'] )		? wp_spaios_clean_number($_POST[$prefix.'slide_to_scroll_bx'], '' )		: '';
		$slide_margin_bx		= isset( $_POST[$prefix.'slide_margin_bx'] )		? wp_spaios_clean_number($_POST[$prefix.'slide_margin_bx'], '' )		: '';
		$slide_width_bx			= isset( $_POST[$prefix.'slide_width_bx'] )			? wp_spaios_clean_number($_POST[$prefix.'slide_width_bx'], '' )			: '';
		$start_slide_bx			= isset( $_POST[$prefix.'start_slide_bx'] )			? wp_spaios_clean_number($_POST[$prefix.'start_slide_bx'], '' )			: '';
		$height_start_bx		= ( $_POST[$prefix.'height_start_bx'] == 'true' )	? 'true' : 'false';
		$random_start_bx		= ( $_POST[$prefix.'random_start_bx'] == 'true' )	? 'true' : 'false';
		$ticker_bx				= ( $_POST[$prefix.'ticker_bx'] == 'true' )			? 'true' : 'false';
		$ticker_hover_bx		= ( $_POST[$prefix.'ticker_hover_bx'] == 'true' )	? 'true' : 'false';

		// Flex Slider Parameters
		$animation_flex			= isset( $_POST[$prefix.'animation_flex'] )			? wp_spaios_clean( $_POST[$prefix.'animation_flex'] )						: 'slide';
		$slide_to_show_flex		= isset( $_POST[$prefix.'slide_to_show_flex'] )		? wp_spaios_clean_number( $_POST[$prefix.'slide_to_show_flex'], '' ) 		: '';
		$max_slide_to_show_flex	= isset( $_POST[$prefix.'max_slide_to_show_flex'] )	? wp_spaios_clean_number( $_POST[$prefix.'max_slide_to_show_flex'], '' )	: '';
		$slide_to_scroll_flex	= isset( $_POST[$prefix.'slide_to_scroll_flex'] )	? wp_spaios_clean_number( $_POST[$prefix.'slide_to_scroll_flex'], '' )		: '';
		$slide_margin_flex		= isset( $_POST[$prefix.'slide_margin_flex'] )		? wp_spaios_clean_number( $_POST[$prefix.'slide_margin_flex'], '' )			: '';
		$slide_width_flex		= isset( $_POST[$prefix.'slide_width_flex'] )		? wp_spaios_clean_number( $_POST[$prefix.'slide_width_flex'], '' )			: '';
		$start_slide_flex		= isset( $_POST[$prefix.'start_slide_flex'] )		? wp_spaios_clean_number( $_POST[$prefix.'start_slide_flex'], '' )			: '';
		$height_auto_flex		= ( $_POST[$prefix.'height_auto_flex'] == 'true' )	? 'true' : 'false';
		$random_start_flex		= ( $_POST[$prefix.'random_start_flex'] == 'true' )	? 'true' : 'false';
		$ticker_hover_flex		= ( $_POST[$prefix.'ticker_hover_flex'] == 'true' )	? 'true' : 'false';
		
		// OWL Carousel Slider Parameters
		$slide_to_show_owl		= isset( $_POST[$prefix.'slide_to_show_owl'] ) 			? wp_spaios_clean_number( $_POST[$prefix.'slide_to_show_owl'], '' )		: '';
		$slide_show_ipad_owl	= isset( $_POST[$prefix.'slide_show_ipad_owl'] )		? wp_spaios_clean_number( $_POST[$prefix.'slide_show_ipad_owl'], '' )	: '';
		$slide_show_tablet_owl	= isset( $_POST[$prefix.'slide_show_tablet_owl'] )		? wp_spaios_clean_number( $_POST[$prefix.'slide_show_tablet_owl'], '' )	: '';
		$slide_show_mobile_owl	= isset( $_POST[$prefix.'slide_show_mobile_owl'] )		? wp_spaios_clean_number( $_POST[$prefix.'slide_show_mobile_owl'], '' )	: '';
		$slide_to_scroll_owl	= isset( $_POST[$prefix.'slide_to_scroll_owl'] )		? wp_spaios_clean_number( $_POST[$prefix.'slide_to_scroll_owl'], '' )	: '';
		$slide_margin_owl		= isset( $_POST[$prefix.'slide_margin_owl'] )			? wp_spaios_clean_number( $_POST[$prefix.'slide_margin_owl'], '' )		: '';
		$slide_padding_owl		= isset( $_POST[$prefix.'slide_padding_owl'] )			? wp_spaios_clean_number( $_POST[$prefix.'slide_padding_owl'], '' )		: '';
		$start_slide_owl		= isset( $_POST[$prefix.'start_slide_owl'] )			? wp_spaios_clean_number( $_POST[$prefix.'start_slide_owl'], '' )		: '';
		$slide_center_owl		= ( $_POST[$prefix.'slide_center_owl'] == 'true' )		? 'true' : 'false';
		$slide_autowidth_owl	= ( $_POST[$prefix.'slide_autowidth_owl'] == 'true' )	? 'true' : 'false';
		$height_auto_owl		= ( $_POST[$prefix.'height_auto_owl'] == 'true' )		? 'true' : 'false';
		$slide_freeDrag_owl		= ( $_POST[$prefix.'slide_freeDrag_owl'] == 'true' )	? 'true' : 'false';
		$slide_rtl_owl			= ( $_POST[$prefix.'slide_rtl_owl'] == 'true' )			? 'true' : 'false';
		
		// Nivo Slider Parameters
		$effect_nivo		= isset( $_POST[$prefix.'effect_nivo'] )			? wp_spaios_clean( $_POST[$prefix.'effect_nivo'] )				: 'sliceDown';
		$width_nivo			= isset( $_POST[$prefix.'width_nivo'] )				? wp_spaios_clean_number( $_POST[$prefix.'width_nivo'], '' )	: '';
		$start_nivo			= isset( $_POST[$prefix.'start_nivo'] )				? wp_spaios_clean_number( $_POST[$prefix.'start_nivo'], '' )	: '';
		$random_start_nivo	= ( $_POST[$prefix.'random_start_nivo'] == 'true' )	? 'true' : 'false';
		$pauseon_over_nivo	= ( $_POST[$prefix.'pauseon_over_nivo'] == 'true' )	? 'true' : 'false';

		// 3D Slider Parameters
		$slide_to_show_3d		= isset( $_POST[$prefix.'slide_to_show_3d'] )		? wp_spaios_clean_number($_POST[$prefix.'slide_to_show_3d'], '' )		: '';
		$slide_show_tablet_3d	= isset( $_POST[$prefix.'slide_show_tablet_3d'] )	? wp_spaios_clean_number($_POST[$prefix.'slide_show_tablet_3d'], '' )	: '';
		$slide_show_mobile_3d	= isset( $_POST[$prefix.'slide_show_mobile_3d'] )	? wp_spaios_clean_number($_POST[$prefix.'slide_show_mobile_3d'], '' )	: '';
		$slide_to_scroll_3d		= isset( $_POST[$prefix.'slide_to_scroll_3d'] )		? wp_spaios_clean_number($_POST[$prefix.'slide_to_scroll_3d'], '' )		: '';
		$space_between_3d		= isset( $_POST[$prefix.'space_between_3d'] )		? wp_spaios_clean_number($_POST[$prefix.'space_between_3d'], '' )		: '';
		$depth					= isset( $_POST[$prefix.'depth'] )					? wp_spaios_clean_number($_POST[$prefix.'depth'], '' )					: '';
		$modifier				= isset( $_POST[$prefix.'modifier'] )				? wp_spaios_clean_number($_POST[$prefix.'modifier'], '' )				: '';
		$centermode_3d			= ( $_POST[$prefix.'centermode_3d'] == 'true' )		? 'true' : 'false';
		$auto_stop_3d			= ( $_POST[$prefix.'auto_stop_3d'] == 'true' )		? 'true' : 'false';

		// Swiper Slider Parameters
		$slide_to_show_swpr		= isset( $_POST[$prefix.'slide_to_show_swpr'] )			? wp_spaios_clean_number( $_POST[$prefix.'slide_to_show_swpr'], '' )		: '';
		$slide_show_tablet_swpr	= isset( $_POST[$prefix.'slide_show_tablet_swpr'] )		? wp_spaios_clean_number( $_POST[$prefix.'slide_show_tablet_swpr'], '' )	: '';
		$slide_show_mobile_swpr	= isset( $_POST[$prefix.'slide_show_mobile_swpr'] )		? wp_spaios_clean_number( $_POST[$prefix.'slide_show_mobile_swpr'], '' )	: '';
		$slide_to_scroll_swpr	= isset( $_POST[$prefix.'slide_to_scroll_swpr'] )		? wp_spaios_clean_number( $_POST[$prefix.'slide_to_scroll_swpr'], '' )		: '';
		$space_between_swpr		= isset( $_POST[$prefix.'space_between_swpr'] )			? wp_spaios_clean_number( $_POST[$prefix.'space_between_swpr'], '' )		: '';
		$animation_swpr			= isset( $_POST[$prefix.'animation_swpr'] )				? wp_spaios_clean( $_POST[$prefix.'animation_swpr'] )						: '';
		$centermode_swpr		= ( $_POST[$prefix.'centermode_swpr'] == 'true' )		? 'true' : 'false';
		$height_auto_swiper		= ( $_POST[$prefix.'height_auto_swiper'] == 'true' )	? 'true' : 'false';
		$auto_stop_swpr			= ( $_POST[$prefix.'auto_stop_swpr'] == 'true' )		? 'true' : 'false';

		// Wallop Slider Parameters
		$mode_wallop = isset( $_POST[$prefix.'mode_wallop'] ) ? wp_spaios_clean( $_POST[$prefix.'mode_wallop'] ) : '';

		// Un Slider Parameters
		$mode_un		= isset( $_POST[$prefix.'mode_un'] )				? wp_spaios_clean( $_POST[$prefix.'mode_un'] )				: 'horizontal';
		$height_auto_un	= ( $_POST[$prefix.'height_auto_un'] == 'true' )	? 'true' : 'false';

		// Update General Meta
		update_post_meta( $post_id, $prefix.'slider_type', $slider_type );
		update_post_meta( $post_id, $prefix.'check_post_gallery', $check_post_gallery );
		update_post_meta( $post_id, $prefix.'include_category', $include_category );
		update_post_meta( $post_id, $prefix.'acf_field_name', $acf_field_name );
		update_post_meta( $post_id, $prefix.'gallery_id', $gallery_imgs );

		// Update Post Meta
		update_post_meta( $post_id, $prefix.'slide_ptype_limit', $slide_ptype_limit );
		update_post_meta( $post_id, $prefix.'slide_ptype_title', $slide_ptype_title );
		update_post_meta( $post_id, $prefix.'slide_ptype_content', $slide_ptype_content );
		update_post_meta( $post_id, $prefix.'slide_ptype_readmorebtn', $slide_ptype_readmorebtn );
		update_post_meta( $post_id, $prefix.'content_readmore_text', $content_readmore_text );
		update_post_meta( $post_id, $prefix.'slide_ptype_cat_name', $slide_ptype_cat_name );
		update_post_meta( $post_id, $prefix.'content_word_limit', $content_word_limit );

		// Update Common Meta  
		update_post_meta( $post_id, $prefix.'arrow', $arrow );
		update_post_meta( $post_id, $prefix.'pagination', $pagination );
		update_post_meta( $post_id, $prefix.'autoplay', $autoplay );
		update_post_meta( $post_id, $prefix.'autoplay_speed', $autoplay_speed );
		update_post_meta( $post_id, $prefix.'speed', $speed );
		update_post_meta( $post_id, $prefix.'loop', $loop );
		update_post_meta( $post_id, $prefix.'caption', $caption );
		update_post_meta( $post_id, $prefix.'link_target', $link_target );
		update_post_meta( $post_id, $prefix.'slide_media_size', $slide_media_size );
		update_post_meta( $post_id, $prefix.'fancy_box', $fancy_box );

		// Update Bx Slider Meta
		update_post_meta( $post_id, $prefix.'mode_bx', $mode_bx );
		update_post_meta( $post_id, $prefix.'slide_to_show_bx', $slide_to_show_bx );
		update_post_meta( $post_id, $prefix.'max_slide_to_show_bx', $max_slide_to_show_bx );
		update_post_meta( $post_id, $prefix.'slide_to_scroll_bx', $slide_to_scroll_bx );
		update_post_meta( $post_id, $prefix.'slide_margin_bx', $slide_margin_bx );
		update_post_meta( $post_id, $prefix.'slide_width_bx', $slide_width_bx );
		update_post_meta( $post_id, $prefix.'ticker_bx', $ticker_bx );
		update_post_meta( $post_id, $prefix.'ticker_hover_bx', $ticker_hover_bx );
		update_post_meta( $post_id, $prefix.'height_start_bx', $height_start_bx );
		update_post_meta( $post_id, $prefix.'random_start_bx', $random_start_bx );		
		update_post_meta( $post_id, $prefix.'start_slide_bx', $start_slide_bx );

		// Update Flex Slider Meta
		update_post_meta( $post_id, $prefix.'animation_flex', $animation_flex );		
		update_post_meta( $post_id, $prefix.'slide_to_show_flex', $slide_to_show_flex );
		update_post_meta( $post_id, $prefix.'max_slide_to_show_flex', $max_slide_to_show_flex );
		update_post_meta( $post_id, $prefix.'slide_to_scroll_flex', $slide_to_scroll_flex );
		update_post_meta( $post_id, $prefix.'slide_margin_flex', $slide_margin_flex );
		update_post_meta( $post_id, $prefix.'slide_width_flex', $slide_width_flex );		
		update_post_meta( $post_id, $prefix.'start_slide_flex', $start_slide_flex );
		update_post_meta( $post_id, $prefix.'height_auto_flex', $height_auto_flex ); 
		update_post_meta( $post_id, $prefix.'random_start_flex', $random_start_flex );
		update_post_meta( $post_id, $prefix.'ticker_hover_flex', $ticker_hover_flex );

		// Update OWL Carousel Slider Meta
		update_post_meta( $post_id, $prefix.'slide_to_show_owl', $slide_to_show_owl );
		update_post_meta( $post_id, $prefix.'slide_show_ipad_owl', $slide_show_ipad_owl );
		update_post_meta( $post_id, $prefix.'slide_show_tablet_owl', $slide_show_tablet_owl );
		update_post_meta( $post_id, $prefix.'slide_show_mobile_owl', $slide_show_mobile_owl );
		update_post_meta( $post_id, $prefix.'slide_to_scroll_owl', $slide_to_scroll_owl );
		update_post_meta( $post_id, $prefix.'slide_margin_owl', $slide_margin_owl );
		update_post_meta( $post_id, $prefix.'slide_padding_owl', $slide_padding_owl );
		update_post_meta( $post_id, $prefix.'slide_center_owl', $slide_center_owl );
		update_post_meta( $post_id, $prefix.'slide_autowidth_owl', $slide_autowidth_owl );
		update_post_meta( $post_id, $prefix.'slide_freeDrag_owl', $slide_freeDrag_owl );
		update_post_meta( $post_id, $prefix.'slide_rtl_owl', $slide_rtl_owl );
		update_post_meta( $post_id, $prefix.'start_slide_owl', $start_slide_owl );
		update_post_meta( $post_id, $prefix.'height_auto_owl', $height_auto_owl );

		// Update Nivo Slider Meta
		update_post_meta( $post_id, $prefix.'width_nivo', $width_nivo );
		update_post_meta( $post_id, $prefix.'start_nivo', $start_nivo );
		update_post_meta( $post_id, $prefix.'effect_nivo', $effect_nivo );
		update_post_meta( $post_id, $prefix.'pauseon_over_nivo', $pauseon_over_nivo );
		update_post_meta( $post_id, $prefix.'random_start_nivo', $random_start_nivo );

		// Update 3D Slider Meta
		update_post_meta( $post_id, $prefix.'slide_to_show_3d', $slide_to_show_3d );
		update_post_meta( $post_id, $prefix.'slide_show_tablet_3d', $slide_show_tablet_3d );
		update_post_meta( $post_id, $prefix.'slide_show_mobile_3d', $slide_show_mobile_3d );
		update_post_meta( $post_id, $prefix.'slide_to_scroll_3d', $slide_to_scroll_3d );
		update_post_meta( $post_id, $prefix.'auto_stop_3d', $auto_stop_3d );
		update_post_meta( $post_id, $prefix.'centermode_3d', $centermode_3d );
		update_post_meta( $post_id, $prefix.'space_between_3d', $space_between_3d );
		update_post_meta( $post_id, $prefix.'depth', $depth );
		update_post_meta( $post_id, $prefix.'modifier', $modifier );

		// Update Swiper Slider Meta
		update_post_meta( $post_id, $prefix.'slide_to_show_swpr', $slide_to_show_swpr );
		update_post_meta( $post_id, $prefix.'slide_show_tablet_swpr', $slide_show_tablet_swpr );
		update_post_meta( $post_id, $prefix.'slide_show_mobile_swpr', $slide_show_mobile_swpr );
		update_post_meta( $post_id, $prefix.'slide_to_scroll_swpr', $slide_to_scroll_swpr );
		update_post_meta( $post_id, $prefix.'auto_stop_swpr', $auto_stop_swpr );
		update_post_meta( $post_id, $prefix.'centermode_swpr', $centermode_swpr );
		update_post_meta( $post_id, $prefix.'space_between_swpr', $space_between_swpr );
		update_post_meta( $post_id, $prefix.'animation_swpr', $animation_swpr );
		update_post_meta( $post_id, $prefix.'height_auto_swiper', $height_auto_swiper );

		// Update Wallop Slider Meta
		update_post_meta( $post_id, $prefix.'mode_wallop', $mode_wallop );

		// Update Un Slider Meta
		update_post_meta( $post_id, $prefix.'mode_un', $mode_un );
		update_post_meta( $post_id, $prefix.'height_auto_un', $height_auto_un );
	}

	/**
	 * Add custom column to Post listing page
	 * 
	 * @package SlidersPack - All In One Image Sliders
	 * @since 1.0
	 */
	function wp_spaios_posts_columns( $columns ) {

		$new_columns['wp_spaios_slider_type'] 	= esc_html__('Slider Type', 'sliderspack-all-in-one-image-sliders');
		$new_columns['wp_spaios_slider'] 		= esc_html__('Slider', 'sliderspack-all-in-one-image-sliders');
		$new_columns['wp_spaios_shortcode'] 	= esc_html__('Shortcode', 'sliderspack-all-in-one-image-sliders');
		
		$columns = wp_spaios_add_array( $columns, $new_columns, 1, true );

		return $columns;
	}

	/**
	 * Add custom column data to Post listing page
	 * 
	 * @package SlidersPack - All In One Image Sliders
	 * @since 1.0
	 */
	function wp_spaios_post_columns_data( $column, $post_id ) {

		global $post;
		// Taking some variables
		$prefix = WP_APAIOIS_META_PREFIX;		
		
		switch ( $column ) {
			case 'wp_spaios_shortcode':

				echo '<div class="wp-spaios-shortcode-preview">[sliders_pack id="'.$post_id.'"]</div>';				
				break;
				
			case 'wp_spaios_slider_type':

				$slider_type	= get_post_meta( $post_id, $prefix.'check_post_gallery', true );
				$slider_type	= isset( $slider_types[ $slider_type ] ) ? str_replace( '-' , ' ', $slider_types[ $slider_type ] ) : str_replace( '-', ' ', $slider_type );

				echo ucwords( $slider_type );
				break;

			case 'wp_spaios_slider':

				$sliders	= wp_spaios_slider_type();
				$slider		= get_post_meta( $post_id, $prefix.'slider_type', true );
				$slider		= isset( $sliders[ $slider ] ) ? str_replace( '-' , ' ', $sliders[ $slider ] ) : str_replace( '-' , ' ', $slider );

				echo ucwords( $slider );
				break;
		}
	}

	/**
	 * Function to add custom quick links at post listing page
	 * 
	 * @package SlidersPack - All In One Image Sliders
	 * @since 1.0
	 */
	function wp_spaios_add_post_row_data( $actions, $post ) {
		
		if( $post->post_type == WP_APAIOIS_POST_TYPE ) {
			return array_merge( array( 'wp_spaios_id' => 'ID: ' . $post->ID ), $actions );
		}
		
		return $actions;
	}

	/**
	 * Image data popup HTML
	 * 
	 * @package SlidersPack - All In One Image Sliders
	 * @since 1.0
	 */
	function wp_spaios_image_update_popup_html() {

		global $post_type;

		$registered_posts = array(WP_APAIOIS_POST_TYPE); // Getting registered post types

		if( in_array($post_type, $registered_posts) ) {
			include_once( WP_APAIOIS_DIR .'/includes/admin/settings/wp-spaios-img-popup.php');
		}
	}

	/**
	 * Get attachment edit form
	 * 
	 * @package SlidersPack - All In One Image Sliders
	 * @since 1.0
	 */
	function wp_spaios_get_attachment_edit_form() {
		
		// Taking some defaults
		$result 			= array();
		$result['success'] 	= 0;
		$result['msg'] 		= __('Sorry, Something happened wrong.', 'sliderspack-all-in-one-image-sliders');
		$attachment_id 		= ! empty( $_POST['attachment_id'] ) ? trim( $_POST['attachment_id'] ) : '';
		if( ! empty( $attachment_id ) ) {

			$attachment_post = get_post( $_POST['attachment_id'] );

			if( ! empty( $attachment_post ) ) {
				
				ob_start();

				// Popup Data File
				include( WP_APAIOIS_DIR . '/includes/admin/settings/wp-spaios-img-popup-data.php' );

				$attachment_data = ob_get_clean();

				$result['success'] 	= 1;
				$result['msg'] 		= __('Attachment Found.', 'sliderspack-all-in-one-image-sliders');
				$result['data']		= $attachment_data;
			}
		}
	
		echo json_encode($result);
		exit;
	}

	/**
	 * Get attachment edit form
	 * 
	 * @package SlidersPack - All In One Image Sliders
	 * @since 1.0
	 */
	function wp_spaios_save_attachment_data() {

		global $wp_error;

		$prefix 			= WP_APAIOIS_META_PREFIX;
		$result 			= array();
		$result['success'] 	= 0;
		$result['msg'] 		= __('Sorry, Something happened wrong.', 'sliderspack-all-in-one-image-sliders');
		$attachment_id 		= ! empty( $_POST['attachment_id'] ) ? trim( $_POST['attachment_id'] ) : '';
		$form_data 			= parse_str( $_POST['form_data'], $form_data_arr );

		if( ! empty( $attachment_id ) && ! empty( $form_data_arr ) ) {

			// Getting attachment post
			$wp_spaios_attachment_post = get_post( $attachment_id );

			// If post type is attachment
			if( isset( $wp_spaios_attachment_post->post_type ) && $wp_spaios_attachment_post->post_type == 'attachment' ) {
				$post_args = array(
									'ID'			=> $attachment_id,
									'post_title'	=> ! empty( $form_data_arr['wp_spaios_attachment_title'] ) ? $form_data_arr['wp_spaios_attachment_title'] : $wp_spaios_attachment_post->post_name,									
									'post_excerpt'	=> $form_data_arr['wp_spaios_attachment_caption'],
								);
				$update = wp_update_post( $post_args, $wp_error );

				if( !is_wp_error( $update ) ) {

					update_post_meta(  $attachment_id, '_wp_attachment_image_alt', wp_spaios_clean($form_data_arr['wp_spaios_attachment_alt']) );
					update_post_meta(  $attachment_id, $prefix.'attachment_link', wp_spaios_clean_url($form_data_arr['wp_spaios_attachment_link']) );

					$result['success'] 	= 1;
					$result['msg'] 		= __('Your changes saved successfully.', 'sliderspack-all-in-one-image-sliders');
				}
			}
		}
		echo json_encode($result);
		exit;
	}
}

$wp_spaios_admin = new Wp_spaios_Admin();