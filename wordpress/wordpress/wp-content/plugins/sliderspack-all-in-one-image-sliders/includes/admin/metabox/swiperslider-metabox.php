<?php
/**
 * Handles Swiper Slider Setting metabox HTML
 *
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Taking some variable
$slide_to_show_swpr		= get_post_meta( $post->ID, $prefix.'slide_to_show_swpr', true );
$slide_show_tablet_swpr	= get_post_meta( $post->ID, $prefix.'slide_show_tablet_swpr', true );
$slide_show_mobile_swpr	= get_post_meta( $post->ID, $prefix.'slide_show_mobile_swpr', true );
$slide_to_scroll_swpr	= get_post_meta( $post->ID, $prefix.'slide_to_scroll_swpr', true );
$auto_stop_swpr			= get_post_meta( $post->ID, $prefix.'auto_stop_swpr', true );
$space_between_swpr		= get_post_meta( $post->ID, $prefix.'space_between_swpr', true );
$centermode_swpr		= get_post_meta( $post->ID, $prefix.'centermode_swpr', true );
$animation_swpr			= get_post_meta( $post->ID, $prefix.'animation_swpr', true );
$height_auto_swiper		= get_post_meta( $post->ID, $prefix.'height_auto_swiper', true );
$centermode_swpr		= ( $centermode_swpr == 'true' )	? 'true' : 'false';
$height_auto_swiper		= ( $height_auto_swiper == 'true' )	? 'true' : 'false';
$auto_stop_swpr			= ( $auto_stop_swpr == 'true' )		? 'true' : 'false';
?>

<table class="form-table wp-spaios-sdetails-tbl">		
	<tbody>
		<tr>
			<th colspan="2">
				<div class="wp-spaios-title-sett"><?php _e('Swiper Slider Parameters', 'sliderspack-all-in-one-image-sliders') ?></div>
			</th>
		</tr>
		<tr>
			<th>
				<label for="wp-spaios-slide-shown"><?php _e('Slide To Show', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<input type="text" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>slide_to_show_swpr" value="<?php echo wp_spaios_esc_attr( $slide_to_show_swpr ); ?>" class="wp-spaios-slide-shown" id="wp-spaios-slide-shown" /><br/>
				<span class="description"><?php _e('Number of slides per view. When window width is >= 640px.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr>					
			<th>
				<label for="wp-spaios-slide-480"><?php _e('Slide To Show (480px)', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<input type="text" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>slide_show_tablet_swpr" value="<?php echo wp_spaios_esc_attr( $slide_show_tablet_swpr ); ?>" class="wp-spaios-slide-480" id="wp-spaios-slide-480" /><br/>
				<span class="description"><?php _e('Number of slides per view. When window width is >= 480px.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr>					
			<th>
				<label for="wp-spaios-slide-320"><?php _e('Slide To Show (320px)', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<input type="text" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>slide_show_mobile_swpr" value="<?php echo wp_spaios_esc_attr( $slide_show_mobile_swpr ); ?>" class="wp-spaios-slide-480" id="wp-spaios-slide-480" /><br/>
				<span class="description"><?php _e('Number of slides per view. When window width is >= 320px.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr>
			<th>
				<label for="wp-spaios-slide-scroll"><?php _e('Slide To Scroll', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<input type="text" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>slide_to_scroll_swpr" value="<?php echo wp_spaios_esc_attr( $slide_to_scroll_swpr ); ?>" class="wp-spaios-slide-scroll" id="wp-spaios-slide-scroll" /><br/>
				<span class="description"><?php _e('Set numbers of slides to define and enable group sliding. Useful to use with slidesPerView > 1','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr class="wp-spaios-pro-feature">
			<th>
				<label><?php _e('FreeMode', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<input type="radio" name="" value="" checked disabled><?php _e('True', 'sliderspack-all-in-one-image-sliders'); ?>
				<input type="radio" name="" value="" disabled><?php _e('False', 'sliderspack-all-in-one-image-sliders'); ?><br/>
				<?php echo sprintf( __( 'Upgrade to <a href="%s" target="_blank">Premium Version</a> to get this option.', 'sliderspack-all-in-one-image-sliders'), WP_APAIOIS_PLUGIN_LINK); ?>
			</td>
		</tr>
		<tr class="wp-spaios-pro-feature">
			<th>
				<label><?php _e('Auto Width', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<input type="radio" name="" value="" checked disabled><?php _e('True', 'sliderspack-all-in-one-image-sliders'); ?>	
				<input type="radio" name="" value="" disabled><?php _e('False', 'sliderspack-all-in-one-image-sliders'); ?>	<br/>
				<span class="description"><?php _e('Display slides with auto/variable width.','sliderspack-all-in-one-image-sliders'); ?></span> <br/>
				<span class="description wp-spaios-red"><?php _e('<strong>Note:</strong> This will not display proper in Gallery Slider Design no.: 1, 3, 18 & Post Slider Design no.: 2, 3, 5, 8, 9, 11, 18, 19','sliderspack-all-in-one-image-sliders'); ?></span>
				<?php echo sprintf( __( 'Upgrade to <a href="%s" target="_blank">Premium Version</a> to get this option.', 'sliderspack-all-in-one-image-sliders'), WP_APAIOIS_PLUGIN_LINK); ?>
			</td>
		</tr>
		<tr>
			<th>
				<label for="wp-spaios-center-mode"><?php _e('Centermode', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<label for="wp-spaios-cm-true">
					<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>centermode_swpr" value="true" <?php checked('true', $centermode_swpr); ?> class="wp-spaios-cm-true" id="wp-spaios-cm-true" /><?php esc_html_e('True', 'sliderspack-all-in-one-image-sliders'); ?>
				</label>
				<label for="wp-spaios-cm-false">
					<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>centermode_swpr" value="false" <?php checked('false', $centermode_swpr); ?> class="wp-spaios-cm-false" id="wp-spaios-cm-false" /><?php esc_html_e('False', 'sliderspack-all-in-one-image-sliders'); ?>
				</label><br/>
				<span class="description"><?php _e('If true, then active slide will be centered, not always on the left side.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr class="wp-spaios-pro-feature" style="<?php if( $centermode_swpr != 'true' ) { echo 'display: none;'; } ?>">
			<th>
				<label><?php _e('Option', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<input type="radio" name="" value="" checked disabled><?php _e('Default', 'sliderspack-all-in-one-image-sliders'); ?>
				<input type="radio" name="" value="" disabled><?php _e('Scale', 'sliderspack-all-in-one-image-sliders'); ?>	<br/>
				<?php echo sprintf( __( 'Upgrade to <a href="%s" target="_blank">Premium Version</a> to get this option.', 'sliderspack-all-in-one-image-sliders'), WP_APAIOIS_PLUGIN_LINK); ?>
			</td>
		</tr>
		<tr class="wp-spaios-pro-feature">
			<th>
				<label><?php _e('Left & Right Image Overlay', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<input type="radio" name="" value="" checked disabled><?php _e('True', 'sliderspack-all-in-one-image-sliders'); ?>	
				<input type="radio" name="" value="" disabled><?php _e('False', 'sliderspack-all-in-one-image-sliders'); ?>	<br/>
				<span class="description"><?php _e('Add overlay on left & right image.','sliderspack-all-in-one-image-sliders'); ?></span> <br />
				<span class="description wp-spaios-red"><?php _e('<strong>Note:</strong> This will look good when auto width & center mode will be "true".','sliderspack-all-in-one-image-sliders'); ?></span>
				<?php echo sprintf( __( 'Upgrade to <a href="%s" target="_blank">Premium Version</a> to get this option.', 'sliderspack-all-in-one-image-sliders'), WP_APAIOIS_PLUGIN_LINK); ?>
			</td>
		</tr>
		<tr>
			<th>
				<label for="wp-spaios-slide-space"><?php _e('Space Between Slides', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<input type="text" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>space_between_swpr" value="<?php echo wp_spaios_esc_attr( $space_between_swpr ); ?>" calss="wp-spaios-slide-space" id="wp-spaios-slide-space" /><br/>
				<span class="description"><?php _e('Distance between slides in px.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr>					
			<th>
				<label for="wp-spaios-slide-effect"><?php _e('Effect', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<select name="<?php echo wp_spaios_esc_attr( $prefix ); ?>animation_swpr" class="wp-spaios-select wp-spaios-slide-effect" id="wp-spaios-slide-effect">
					<option value="slide" <?php selected('slide', $animation_swpr); ?>><?php esc_html_e('Slide', 'sliderspack-all-in-one-image-sliders'); ?></option>
					<option value="fade" <?php selected('fade', $animation_swpr); ?>> <?php esc_html_e('Fade', 'sliderspack-all-in-one-image-sliders'); ?></option>
				</select><br/>
				<span class="description"><?php _e('Could be "slide", "fade"','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr>
			<th>
				<label for="wp-spaios-autoheight"><?php _e('Auto height', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<label for="wp-spaios-ah-true">
					<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>height_auto_swiper" value="true" <?php checked('true', $height_auto_swiper); ?> class="wp-spaios-ah-true" id="wp-spaios-ah-true" /><?php esc_html_e('True', 'sliderspack-all-in-one-image-sliders'); ?>
				</label>
				<label for="wp-spaios-ah-false">
					<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>height_auto_swiper" value="false" <?php checked('false', $height_auto_swiper); ?> class="wp-spaios-ah-false" id="wp-spaios-ah-false" /><?php esc_html_e('False', 'sliderspack-all-in-one-image-sliders'); ?>
				</label><br/>
				<span class="description"><?php _e('Allow height of the slider to animate smoothly when direction is horizontal. Note:- Please use Height blank if Auto height is True','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr>
			<th>
				<label for="wp-spaios-ap-stop"><?php _e('Autoplay Stop On Last', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<label for="wp-spaios-aps-true">
					<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>auto_stop_swpr" value="true" <?php checked('true', $auto_stop_swpr); ?> class="wp-spaios-aps-true" id="wp-spaios-aps-true" /><?php esc_html_e('True', 'sliderspack-all-in-one-image-sliders'); ?>
				</label>
				<label for="wp-spaios-aps-false">
					<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>auto_stop_swpr" value="false" <?php checked('false', $auto_stop_swpr); ?> class="wp-spaios-aps-false" id="wp-spaios-aps-false" /><?php esc_html_e('False', 'sliderspack-all-in-one-image-sliders'); ?>
				</label><br/>
				<span class="description"><?php _e('Enable this parameter and autoplay will be stopped when it reaches last slide','sliderspack-all-in-one-image-sliders'); ?></span><br/>
				<span class="wp-spaios-red description"><?php _e('<strong>Note:</strong> This will work when loop is false.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
	</tbody>
</table>
<table class="form-table wp-spaios-sdetails-tbl wp-spaios-pro-feature">
	<tbody>
		<tr>
			<th colspan="2">
				<div class="wp-spaios-title-sett"><?php _e('Swiper Slider Thumbnail Parameters', 'sliderspack-all-in-one-image-sliders') ?></div>
			</th>
		</tr>
		<tr>
			<th>
				<label><?php _e('Show Thumbnail', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<input type="radio" class="wp-spaios-show-hide" name="" value="" checked disabled><?php _e('True', 'sliderspack-all-in-one-image-sliders'); ?>	
				<input type="radio" class="wp-spaios-show-hide" name="" value="" disabled><?php _e('False', 'sliderspack-all-in-one-image-sliders'); ?>	<br/>
				<span class="description"><?php _e('Display slider thumbnail images.','sliderspack-all-in-one-image-sliders'); ?></span><br />
				<span class="description wp-spaios-red"><?php _e('<strong>Note:</strong> It will work only when slide to show = 1 and slide per row = 1. ','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr>
			<th>
				<label><?php _e('Thumbnail Position', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<select name="" class="wp-spaios-select-box" disabled>
					<option><?php _e('Top', 'sliderspack-all-in-one-image-sliders'); ?></option>
				</select> <br/>
				<span class="description"><?php _e('Select thumbnail position ie top or bottom.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr>
			<th>
				<label><?php _e('Thumbnail Per View', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<input type="text" name="" value="" disabled><br/>
				<span class="description"><?php _e('Set slide per view.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr>
			<th>
				<label><?php _e('Space Between Thumbnail', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<input type="text" name="" value="" disabled><br/>
				<span class="description"><?php _e('Set distance between thumbnail in px. Ex: 5','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr>
			<th>
				<label><?php _e('FreeMode', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<input type="radio" name="" value="" checked disabled><?php _e('True', 'sliderspack-all-in-one-image-sliders'); ?>
				<input type="radio" name="" value="" disabled><?php _e('False', 'sliderspack-all-in-one-image-sliders'); ?><br/><br/>
				<?php echo sprintf( __( 'Upgrade to <a href="%s" target="_blank">Premium Version</a> to get this option.', 'sliderspack-all-in-one-image-sliders'), WP_APAIOIS_PLUGIN_LINK); ?>
			</td>
		</tr>
	</tbody>
</table>