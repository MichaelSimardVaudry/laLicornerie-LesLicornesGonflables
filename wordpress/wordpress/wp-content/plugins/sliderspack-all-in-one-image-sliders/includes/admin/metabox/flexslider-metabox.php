<?php
/**
 * Handles Flex Slider Setting metabox HTML
 *
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Taking some variable
$animation_flex			= get_post_meta( $post->ID, $prefix.'animation_flex', true );
$slide_to_show_flex		= get_post_meta( $post->ID, $prefix.'slide_to_show_flex', true );
$max_slide_to_show_flex	= get_post_meta( $post->ID, $prefix.'max_slide_to_show_flex', true );
$slide_to_scroll_flex	= get_post_meta( $post->ID, $prefix.'slide_to_scroll_flex', true );
$slide_margin_flex		= get_post_meta( $post->ID, $prefix.'slide_margin_flex', true );
$slide_width_flex		= get_post_meta( $post->ID, $prefix.'slide_width_flex', true );
$start_slide_flex		= get_post_meta( $post->ID, $prefix.'start_slide_flex', true );
$height_auto_flex		= get_post_meta( $post->ID, $prefix.'height_auto_flex', true );
$random_start_flex		= get_post_meta( $post->ID, $prefix.'random_start_flex', true );
$ticker_hover_flex		= get_post_meta( $post->ID, $prefix.'ticker_hover_flex', true );
$height_auto_flex		= ( $height_auto_flex == 'true' )	? 'true' : 'false';
$random_start_flex		= ( $random_start_flex == 'true' )	? 'true' : 'false';
$ticker_hover_flex		= ( $ticker_hover_flex == 'true' )	? 'true' : 'false';
?>

<table class="form-table wp-spaios-tbl">			
	<tbody>
		<tr>
			<th colspan="2">
				<div class="wp-spaios-title-sett"><?php _e('Flex Slider Parameters', 'sliderspack-all-in-one-image-sliders') ?></div>
			</th>
		</tr>
		<tr class="wp-spaios-pro-feature">				
			<th>
				<label for="wp-spaios-mode"><?php _e('Mode', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<select name="" class="wp-spaios-select wp-spaios-mode" disabled>
					<option selected="selected"><?php esc_html_e('Horizontal', 'sliderspack-all-in-one-image-sliders'); ?></option>
					<option><?php esc_html_e('Vertical', 'sliderspack-all-in-one-image-sliders'); ?></option>
				</select><br/>
				<span class="description"><?php _e('Select slider mode.','sliderspack-all-in-one-image-sliders'); ?></span>
				<?php echo sprintf( __( 'Upgrade to <a href="%s" target="_blank">Premium Version</a> to get this option.', 'sliderspack-all-in-one-image-sliders'), WP_APAIOIS_PLUGIN_LINK); ?>
			</td>
		</tr>
		<tr>
			<th>
				<label for="wp-spaios-animation"><?php _e('Animation Type', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<select name="<?php echo wp_spaios_esc_attr( $prefix ); ?>animation_flex" class="wp-spaios-select wp-spaios-animation" id="wp-spaios-animation">
					<?php if( ! empty( $flex_animation_data ) ) {
						foreach ($flex_animation_data as $flex_animation_key => $flex_animation_val) { ?>
							<option value="<?php echo wp_spaios_esc_attr( $flex_animation_key ); ?>" <?php selected($animation_flex, $flex_animation_key); ?>><?php echo $flex_animation_val; ?></option>
						<?php }
					} ?>
				</select><br/>
				<span class="description"><?php _e('Select animation for flexSlider','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr class="wp-spaios-pro-feature">
			<th>
				<label><?php _e('Show Thumbnail', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<input type="radio" class="wp-spaios-show-hide" name="" value="true" checked="checked" disabled><?php _e('True', 'sliderspack-all-in-one-image-sliders'); ?>
				<input type="radio" class="wp-spaios-show-hide" name="" value="false" disabled><?php _e('False', 'sliderspack-all-in-one-image-sliders'); ?><br/>
				<span class="description"><?php _e('Enable slider thumbnail images.','sliderspack-all-in-one-image-sliders'); ?></span><br>
				<span class="description wp-spaios-red"><?php _e('<strong>Note:</strong> Show thumbnail will not work with Slide To Scroll > 1.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr class="wp-spaios-pro-feature">
			<th>
				<label><?php _e('Thumbnail Position', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<select name="" class="wp-spaios-select" disabled>
					<option><?php _e('Top', 'sliderspack-all-in-one-image-sliders'); ?></option>
					<option><?php _e('Bottom', 'sliderspack-all-in-one-image-sliders'); ?></option>
				</select> <br/>
				<span class="description"><?php _e('Select slider thumbnail position.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr>					
			<th>
				<label for="wp-spaios-slide-shown"><?php _e('Minimum Number of Slides to Shown', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<input type="text" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>slide_to_show_flex" value="<?php echo wp_spaios_esc_attr( $slide_to_show_flex ); ?>" class="wp-spaios-slide-shown" id="wp-spaios-slide-shown" /><br/>
				<span class="description"><?php _e('Set minimum number of slides to shown. Minimum number of slides to shown will work for Mobile.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr>					
			<th>
				<label for="wp-spaios-max-slide"><?php _e('Maximum Number of Slides to Shown', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<input type="text" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>max_slide_to_show_flex" value="<?php echo wp_spaios_esc_attr( $max_slide_to_show_flex ); ?>" class="wp-spaios-max-slide" id="wp-spaios-max-slide" /><br/>
				<span class="description"><?php _e('Set maximum number of slides to shown. Minimum number of slides to shown will work for Desktop. <br /> if Maximum Number of Slides to Shown > 1 please use Slide Width setting.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr>
			<th>
				<label for="wp-spaios-slide-width"><?php _e('Slide Width', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<input type="text" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>slide_width_flex" value="<?php echo wp_spaios_esc_attr( $slide_width_flex ); ?>" class="wp-spaios-slide-width" id="wp-spaios-slide-width" /><br/>
				<span class="description"><?php _e('Set width of each slide. Slide Width will work if Maximum Number of Slides to Shown > 1','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr>
			<th>
				<label for="wp-spaios-slide-scroll"><?php _e('Slide To Scroll', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<input type="text" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>slide_to_scroll_flex" value="<?php echo wp_spaios_esc_attr( $slide_to_scroll_flex ); ?>" class="wp-spaios-slide-scroll" id="wp-spaios-slide-scroll" /><br/>
				<span class="description"><?php _e('Set slide to scroll at a time. Useful to use with Slide To Show > 1.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		
		<tr>
			<th>
				<label for="wp-spaios-slide-margin"><?php _e('Slide margin', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<input type="text" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>slide_margin_flex" value="<?php echo wp_spaios_esc_attr( $slide_margin_flex ); ?>" class="wp-spaios-slide-margin" id="wp-spaios-slide-margin" /><br/>
				<span class="description"><?php _e('Margin between each slide. Ex: 5.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr>
			<th>
				<label class="wp-spaios-slide-start"><?php _e('Start Slide', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<input type="text" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>start_slide_flex" value="<?php echo wp_spaios_esc_attr( $start_slide_flex ); ?>" class="wp-spaios-slide-start" id="wp-spaios-slide-start" /><br/>
				<span class="description"><?php _e('Starting slide index (zero-based). eg. 3','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr>
			<th>
				<label class="wp-spaios-auto-height"><?php _e('Auto height', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<label for="wp-spaios-ah-true">
					<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>height_auto_flex" value="true" <?php checked('true', $height_auto_flex); ?> class="wp-spaios-ah-true" id="wp-spaios-ah-true" /><?php esc_html_e('True', 'sliderspack-all-in-one-image-sliders'); ?>
				</label>
				<label for="wp-spaios-ah-false">
					<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>height_auto_flex" value="false" <?php checked('false', $height_auto_flex); ?> class="wp-spaios-ah-false" id="wp-spaios-ah-false" /><?php esc_html_e('False', 'sliderspack-all-in-one-image-sliders'); ?>
				</label><br/>
				<span class="description"><?php _e('Allow height of the slider to animate smoothly.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr>
			<th>
				<label><?php _e('Random Start', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<label for="wp-spaios-random-true">
					<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>random_start_flex" value="true" <?php checked('true', $random_start_flex); ?> class="wp-spaios-random-true" id="wp-spaios-random-true" /><?php esc_html_e('True', 'sliderspack-all-in-one-image-sliders'); ?>
				</label>
				<label for="wp-spaios-random-false">
					<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>random_start_flex" value="false" <?php checked('false', $random_start_flex); ?> class="wp-spaios-random-false" id="wp-spaios-random-false" /><?php esc_html_e('False', 'sliderspack-all-in-one-image-sliders'); ?>
				</label><br/>
				<span class="description"><?php _e('Start slider on a random slide','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>				
		<tr>				
			<th>
				<label><?php _e('Pause on Mouse Hover', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<label for="wp-spaios-hover-true">
					<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>ticker_hover_flex" value="true" <?php checked('true', $ticker_hover_flex); ?> class="wp-spaios-hover-true" id="wp-spaios-hover-true" /><?php esc_html_e('True', 'sliderspack-all-in-one-image-sliders'); ?>
				</label>
				<label for="wp-spaios-hover-false">
					<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>ticker_hover_flex" value="false" <?php checked('false', $ticker_hover_flex); ?> class="wp-spaios-hover-false" id="wp-spaios-hover-false" /><?php esc_html_e('False', 'sliderspack-all-in-one-image-sliders'); ?>
				</label><br/>
				<span class="description"><?php _e('Slider will pause when mouse hovers','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
	</tbody>
</table>