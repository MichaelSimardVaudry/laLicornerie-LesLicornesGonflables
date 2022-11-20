<?php
/**
 * Handles 3D Slider Setting metabox HTML
 *
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Taking some variable
$slide_to_show_3d		= get_post_meta( $post->ID, $prefix.'slide_to_show_3d', true );
$slide_show_tablet_3d	= get_post_meta( $post->ID, $prefix.'slide_show_tablet_3d', true );
$slide_show_mobile_3d	= get_post_meta( $post->ID, $prefix.'slide_show_mobile_3d', true );
$slide_to_scroll_3d		= get_post_meta( $post->ID, $prefix.'slide_to_scroll_3d', true );
$space_between_3d		= get_post_meta( $post->ID, $prefix.'space_between_3d', true );
$centermode_3d			= get_post_meta( $post->ID, $prefix.'centermode_3d', true );
$auto_stop_3d			= get_post_meta( $post->ID, $prefix.'auto_stop_3d', true );
$depth					= get_post_meta( $post->ID, $prefix.'depth', true );
$modifier				= get_post_meta( $post->ID, $prefix.'modifier', true );
$centermode_3d			= ( $centermode_3d == 'true' )	? 'true' : 'false';
$auto_stop_3d			= ( $auto_stop_3d == 'true' )	? 'true' : 'false';
?>

<table class="form-table wp-spaios-tbl">
	<tbody>
		<tr>
			<th colspan="2">
				<div class="wp-spaios-title-sett"><?php _e('3D Slider Parameters', 'sliderspack-all-in-one-image-sliders') ?></div>
			</th>
		</tr>
		<tr>
			<th>
				<label for="wp-spaios-slide-shown"><?php _e('Slide To Show', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<input type="text" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>slide_to_show_3d" value="<?php echo wp_spaios_esc_attr( $slide_to_show_3d ); ?>" class="wp-spaios-slide-shown" id="wp-spaios-slide-shown" /><br/>
				<span class="description"><?php _e('Number of slides per view. When window width is >= 640px.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr>
			<th>
				<label for="wp-spaios-slide-480"><?php _e('Slide To Show (480px)', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<input type="text" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>slide_show_tablet_3d" value="<?php echo wp_spaios_esc_attr( $slide_show_tablet_3d ); ?>" class="wp-spaios-slide-480" id="wp-spaios-slide-480" /><br/>
				<span class="description"><?php _e('Number of slides per view. When window width is >= 480px.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr>
			<th>
				<label for="wp-spaios-slide-320"><?php _e('Slide To Show (320px)', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<input type="text" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>slide_show_mobile_3d" value="<?php echo wp_spaios_esc_attr( $slide_show_mobile_3d ); ?>" class="wp-spaios-slide-320" id="wp-spaios-slide-320" /><br/>
				<span class="description"><?php _e('Number of slides per view. When window width is >= 320px.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr>
			<th>
				<label for="wp-spaios-slide-scroll"><?php _e('Slide To Scroll', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<input type="text" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>slide_to_scroll_3d" value="<?php echo wp_spaios_esc_attr( $slide_to_scroll_3d ); ?>" class="wp-spaios-slide-scroll" id="wp-spaios-slide-scroll" /><br/>
				<span class="description"><?php _e('Set numbers of slides to define and enable group sliding. Useful to use with slidesPerView > 1','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr>
			<th>
				<label for="wp-spaios-slide-space"><?php _e('Space Between Slides', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<input type="text" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>space_between_3d" value="<?php echo wp_spaios_esc_attr( $space_between_3d ); ?>" class="wp-spaios-slide-space" id="wp-spaios-slide-space" /><br/>
				<span class="description"><?php _e('Distance between slides in px.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr>
			<th>
				<label for="wp-spaios-center-mode"><?php _e('Centermode', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<label for="wp-spaios-cm-true">
					<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>centermode_3d" value="true" <?php checked('true', $centermode_3d); ?> class="wp-spaios-cm-true" id="wp-spaios-cm-true" /><?php esc_html_e('True', 'sliderspack-all-in-one-image-sliders'); ?>
				</label>
				<label for="wp-spaios-cm-false">
					<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>centermode_3d" value="false" <?php checked('false', $centermode_3d); ?> class="wp-spaios-cm-false" id="wp-spaios-cm-false" /><?php esc_html_e('False', 'sliderspack-all-in-one-image-sliders'); ?>
				</label><br/>
				<span class="description"><?php _e('If true, then active slide will be centered, not always on the left side.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr>
			<th>
				<label for="wp-spaios-autoplay-stop"><?php _e('Autoplay Stop On Last', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<label for="wp-spaios-ap-stop-true">
					<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>auto_stop_3d" value="true" <?php checked('true', $auto_stop_3d); ?> class="wp-spaios-ap-stop-true" id="wp-spaios-ap-stop-true" /><?php esc_html_e('True', 'sliderspack-all-in-one-image-sliders'); ?>
				</label>
				<label for="wp-spaios-ap-stop-false">
					<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>auto_stop_3d" value="false" <?php checked('false', $auto_stop_3d); ?> class="wp-spaios-ap-stop-false" id="wp-spaios-ap-stop-false" /><?php esc_html_e('False', 'sliderspack-all-in-one-image-sliders'); ?>
				</label><br/>
				<span class="description"><?php _e('Enable this parameter and autoplay will be stopped when it reaches last slide','sliderspack-all-in-one-image-sliders'); ?></span><br/>
				<span class="wp-spaios-red description"><?php _e('<strong>Note:</strong> This will work when loop is false.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
	</tbody>
</table>

<table class="form-table wp-spaios-tbl">
	<tbody>
		<tr>
			<th colspan="2">
				<div class="wp-spaios-title-sett"><?php _e('3D Slider Effect Parameters', 'sliderspack-all-in-one-image-sliders') ?></div>
			</th>
		</tr>
		<tr>									
			<th>
				<label for="wp-spaios-depth"><?php _e('Depth (Left - Right images scale value )', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<input type="text" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>depth" value="<?php echo wp_spaios_esc_attr( $depth ); ?>" class="wp-spaios-depth" id="wp-spaios-depth" /><br/>
				<span class="description"><?php _e('Enter the depth value to scale the left and right images','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr>
			<th>
				<label for="wp-spaios-overlap"><?php _e('Image overlap position', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<input type="text" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>modifier" value="<?php echo wp_spaios_esc_attr( $modifier ); ?>" class="wp-spaios-overlap" id="wp-spaios-overlap" /><br/>
				<span class="description"><?php _e('Enter the number value to overlap the image position','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>			
		<tr class="wp-spaios-pro-feature">
			<th>
				<label for="wp-spaios-img-rotate"><?php _e('Rotate Image', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<input type="text" name="" value="" disabled><br/>
				<span class="description"><?php _e('Enter the rotate value for image.','sliderspack-all-in-one-image-sliders'); ?></span>
				<?php echo sprintf( __( 'Upgrade to <a href="%s" target="_blank">Premium Version</a> to get this option.', 'sliderspack-all-in-one-image-sliders'), WP_APAIOIS_PLUGIN_LINK); ?>
			</td>
		</tr>
		<tr class="wp-spaios-pro-feature">
			<th>
				<label for="wp-spaios-img-stretch"><?php _e('Stretch', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<input type="text" name="" value="" disabled><br/>
				<span class="description"><?php _e('Enter the value for image stretch.','sliderspack-all-in-one-image-sliders'); ?></span>
				<?php echo sprintf( __( 'Upgrade to <a href="%s" target="_blank">Premium Version</a> to get this option.', 'sliderspack-all-in-one-image-sliders'), WP_APAIOIS_PLUGIN_LINK); ?>
			</td>
		</tr>
	</tbody>
</table><!-- end .wtwp-tstmnl-table -->	