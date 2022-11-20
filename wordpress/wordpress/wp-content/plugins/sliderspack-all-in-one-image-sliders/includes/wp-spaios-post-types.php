<?php
/**
 * Register Post type functionality
 *
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Function to register post type
 * 
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */
function wp_spaios_register_post_type() {

	$wp_spaios_post_lbls = apply_filters( 'wp_spaios_post_labels', array(
								'name'					=> __('SlidersPack', 'sliderspack-all-in-one-image-sliders'),
								'singular_name'			=> __('SlidersPack', 'sliderspack-all-in-one-image-sliders'),
								'add_new'				=> __('Add slider', 'sliderspack-all-in-one-image-sliders'),
								'add_new_item'			=> __('Add New Slider', 'sliderspack-all-in-one-image-sliders'),
								'edit_item'				=> __('Edit Slider', 'sliderspack-all-in-one-image-sliders'),
								'new_item'				=> __('New Slider', 'sliderspack-all-in-one-image-sliders'),
								'view_item'				=> __('View Slider', 'sliderspack-all-in-one-image-sliders'),
								'search_items'			=> __('Search Slider', 'sliderspack-all-in-one-image-sliders'),
								'not_found'				=> __('No Slider Found', 'sliderspack-all-in-one-image-sliders'),
								'not_found_in_trash'	=> __('No Slider Found in Trash', 'sliderspack-all-in-one-image-sliders'),
								'menu_name'				=> __('SlidersPack', 'sliderspack-all-in-one-image-sliders')
							));

	$wp_spaios_slider_args = array(
		'labels'				=> $wp_spaios_post_lbls,
		'public'				=> false,
		'show_ui'				=> true,
		'query_var'				=> false,
		'rewrite'				=> true,
		'capability_type'		=> 'post',
		'hierarchical'			=> false,
		'menu_icon'				=> 'dashicons-format-gallery',
		 'supports'				=> array('title')
	);

	// Register slick slider post type
	register_post_type( WP_APAIOIS_POST_TYPE, apply_filters( 'wp_spaios_registered_post_type_args', $wp_spaios_slider_args ) );
}

// Action to register plugin post type
add_action('init', 'wp_spaios_register_post_type');

/**
 * Function to update post message for portfolio
 * 
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */
function wp_spaios_post_updated_messages( $messages ) {

	global $post, $post_ID;

	$messages[WP_APAIOIS_POST_TYPE] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __( 'Image Gallery updated.', 'sliderspack-all-in-one-image-sliders' ) ),
		2 => __( 'Custom field updated.', 'sliderspack-all-in-one-image-sliders' ),
		3 => __( 'Custom field deleted.', 'sliderspack-all-in-one-image-sliders' ),
		4 => __( 'Image Gallery updated.', 'sliderspack-all-in-one-image-sliders' ),
		5 => isset( $_GET['revision'] ) ? sprintf( __( 'Image Gallery restored to revision from %s', 'sliderspack-all-in-one-image-sliders' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __( 'Image Gallery published.', 'sliderspack-all-in-one-image-sliders' ) ),
		7 => __( 'Image Gallery saved.', 'sliderspack-all-in-one-image-sliders' ),
		8 => sprintf( __( 'Image Gallery submitted.', 'sliderspack-all-in-one-image-sliders' ) ),
		9 => sprintf( __( 'Image Gallery scheduled for: <strong>%1$s</strong>.', 'sliderspack-all-in-one-image-sliders' ),
		  date_i18n( __( 'M j, Y @ G:i', 'sliderspack-all-in-one-image-sliders' ), strtotime( $post->post_date ) ) ),
		10 => sprintf( __( 'Image Gallery draft updated.', 'sliderspack-all-in-one-image-sliders' ) ),
	);

	return $messages;
}

// Filter to update slider post message
add_filter( 'post_updated_messages', 'wp_spaios_post_updated_messages' );