<?php

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit();
}

function xo_liteslider_delete_plugin() {
	global $wpdb;

	$posts = get_posts(
		array(
			'numberposts' => -1,
			'post_type' => 'xo_liteslider',
			'post_status' => 'any',
		)
	);

	foreach ( $posts as $post ) {
		wp_delete_post( $post->ID, true );
	}

	delete_option( 'xo_liteslider_version' );
}

if ( ! is_multisite() ) {
	xo_liteslider_delete_plugin();
} else {
	global $wpdb;

	$blog_ids = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs" );
	$original_blog_id = get_current_blog_id();
	foreach ( $blog_ids as $blog_id ) {
		switch_to_blog( $blog_id );
		xo_liteslider_delete_plugin();
	}
	switch_to_blog( $original_blog_id );
}
