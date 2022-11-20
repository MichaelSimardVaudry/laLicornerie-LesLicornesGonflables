<?php
/**
 * Handles Bx Slider Setting metabox HTML
 *
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Taking some variable
$mode_bx				= get_post_meta( $post->ID, $prefix.'mode_bx', true );
$slide_to_show_bx 		= get_post_meta( $post->ID, $prefix.'slide_to_show_bx', true );
$max_slide_to_show_bx 	= get_post_meta( $post->ID, $prefix.'max_slide_to_show_bx', true );
$slide_to_scroll_bx 	= get_post_meta( $post->ID, $prefix.'slide_to_scroll_bx', true );
$slide_margin_bx		= get_post_meta( $post->ID, $prefix.'slide_margin_bx', true );
$slide_width_bx			= get_post_meta( $post->ID, $prefix.'slide_width_bx', true );
$start_slide_bx			= get_post_meta( $post->ID, $prefix.'start_slide_bx', true );
$height_start_bx		= get_post_meta( $post->ID, $prefix.'height_start_bx', true );
$random_start_bx		= get_post_meta( $post->ID, $prefix.'random_start_bx', true );
$ticker_bx				= get_post_meta( $post->ID, $prefix.'ticker_bx', true );
$ticker_hover_bx		= get_post_meta( $post->ID, $prefix.'ticker_hover_bx', true );
$height_start_bx		= ( $height_start_bx == 'true' )	? 'true' : 'false';
$random_start_bx		= ( $random_start_bx == 'true' )	? 'true' : 'false';
$ticker_bx				= ( $ticker_bx == 'true' )			? 'true' : 'false';
$ticker_hover_bx		= ( $ticker_hover_bx == 'true' )	? 'true' : 'false';
?>

<table class="form-table wp-spaios-tbl wp-spaios-bxslider-sett">
	<tbody>
		<tr>
			<th colspan="2">
				<div class="wp-spaios-title-sett"><?php _e('BX Slider Parameters', 'sliderspack-all-in-one-image-sliders') ?></div>
			</th>
		</tr>
		<tr>
			<th>
				<label for="wp-spaios-mode"><?php _e('Mode', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<select name="<?php echo wp_spaios_esc_attr( $prefix ); ?>mode_bx" class="wp-spaios-select wp-spaios-mode" id="wp-spaios-mode">
					<?php if( ! empty( $bx_effect_data ) ) {
						foreach ($bx_effect_data as $bx_effect_key => $bx_effect_val) { ?>
							<option value="<?php echo wp_spaios_esc_attr( $bx_effect_key ); ?>" <?php selected($mode_bx, $bx_effect_key); ?>><?php echo $bx_effect_val; ?></option>
						<?php }
					} ?>
				</select><br/>
				<span class="description"><?php _e('Select mode for bxSlider','sliderspack-all-in-one-image-sliders'); ?></span><br/>
				<span class="description"><?php _e(' Note: Slide To Shown will not work with fade mode. ','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr>
			<th>
				<label for="wp-spaios-slide-shown"><?php _e('Minimum Number of Slides to Shown', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<input type="text" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>slide_to_show_bx" value="<?php echo wp_spaios_esc_attr( $slide_to_show_bx ); ?>" class="wp-spaios-slide-shown" id="wp-spaios-slide-shown" /><br/>
				<span class="description"><?php _e('Set minimum number of slides to shown. Minimum number of slides to shown will work for Mobile.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr>
			<th>
				<label for="wp-spaios-max-slide"><?php _e('Maximum Number of Slides to Shown', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<input type="text" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>max_slide_to_show_bx" value="<?php echo wp_spaios_esc_attr( $max_slide_to_show_bx ); ?>" class="wp-spaios-max-slide" id="wp-spaios-max-slide" /><br/>
				<span class="description"><?php _e('Set maximum number of slides to shown. Minimum number of slides to shown will work for Desktop.<br /> if Maximum Number of Slides to Shown > 1 please use Slide Width setting.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr>
			<th>
				<label for="wp-spaios-slide-width"><?php _e('Slide Width', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<input type="text" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>slide_width_bx" value="<?php echo wp_spaios_esc_attr( $slide_width_bx ); ?>" class="wp-spaios-slide-width" id="wp-spaios-slide-width" /><br/>
				<span class="description"><?php _e(' Set width of each slide. This setting is required for all horizontal carousels!. Also Slide Width will work if Maximum Number of Slides to Shown > 1','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr>
			<th>
				<label for="wp-spaios-slide-scroll"><?php _e('Slide To Scroll', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<input type="text" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>slide_to_scroll_bx" value="<?php echo wp_spaios_esc_attr( $slide_to_scroll_bx ); ?>" class="wp-spaios-slide-scroll" id="wp-spaios-slide-scroll" /><br/>
				<span class="description"><?php _e('Set slide to scroll at a time. Useful to use with Slide To Show > 1','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		
		<tr>
			<th>
				<label for="wp-spaios-slide-margin"><?php _e('Slide margin', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<input type="text" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>slide_margin_bx" value="<?php echo wp_spaios_esc_attr( $slide_margin_bx ); ?>" class="wp-spaios-slide-margin" id="wp-spaios-slide-margin" /><br/>
				<span class="description"><?php _e(' Set margin between each slide. Ex: 5.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr>
			<th>
				<label for="wp-spaios-slide-start"><?php _e('Start Slide', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<input type="text" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>start_slide_bx" value="<?php echo wp_spaios_esc_attr( $start_slide_bx ); ?>" class="wp-spaios-slide-start" id="wp-spaios-slide-start" /><br/>
				<span class="description"><?php _e(' Set Starting slide index (zero-based). Ex: 3.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr>
			<th>
				<label for="wp-spaios-auto-height"><?php _e('Auto height', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<label for="wp-spaios-auto-height-true">
					<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>height_start_bx" value="true" <?php checked('true', $height_start_bx); ?> class="wp-spaios-auto-height-true" id="wp-spaios-auto-height-true" /><?php esc_html_e('True', 'sliderspack-all-in-one-image-sliders'); ?>
				</label>
				<label for="wp-spaios-ah-false">
					<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>height_start_bx" value="false" <?php checked('false', $height_start_bx); ?> class="wp-spaios-ah-false" id="wp-spaios-ah-false" /><?php esc_html_e('False', 'sliderspack-all-in-one-image-sliders'); ?>
				</label><br/>
				<span class="description"><?php _e('Set auto height for slider.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr>
			<th>
				<label for="wp-spaios-random-start"><?php _e('Random Start', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<label for="wp-spaios-rs-true">
					<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>random_start_bx" value="true" <?php checked('true', $random_start_bx); ?> class="wp-spaios-rs-true" id="wp-spaios-rs-true" /><?php esc_html_e('True', 'sliderspack-all-in-one-image-sliders'); ?>
				</label>
				<label for="wp-spaios-rs-false">
					<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>random_start_bx" value="false" <?php checked('false', $random_start_bx); ?> class="wp-spaios-rs-false" id="wp-spaios-rs-false" /><?php esc_html_e('False', 'sliderspack-all-in-one-image-sliders'); ?>
				</label><br/>
				<span class="description"><?php _e('Start slider on a random slide.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr>
		
			<th>
				<label><?php _e('Ticker', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<label for="wp-spaios-ticker-true">
					<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>ticker_bx" value="true" <?php checked('true', $ticker_bx); ?> class="wp-spaios-ticker-true" id="wp-spaios-ticker-true" /><?php esc_html_e('True', 'sliderspack-all-in-one-image-sliders'); ?>
				</label>
				<label for="wp-spaios-ticker-false">
					<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>ticker_bx" value="false" <?php checked('false', $ticker_bx); ?> class="wp-spaios-ticker-false" id="wp-spaios-ticker-false" /><?php esc_html_e('False', 'sliderspack-all-in-one-image-sliders'); ?>
				</label><br/>
				<span class="description"><?php _e('Use slider in ticker mode (similar to a news ticker).','sliderspack-all-in-one-image-sliders'); ?></span><br>
				<span class="description"><?php _e('<strong>Note:</strong>  Ticker will work with "autoplay=false".','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr>				
			<th>
				<label><?php _e('Ticker Pause on Mouse Hover', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<label for="wp-spaios-ticker-pause-true">
					<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>ticker_hover_bx" value="true" <?php checked('true', $ticker_hover_bx); ?> class="wp-spaios-ticker-pause-true" id="wp-spaios-ticker-pause-true" /><?php esc_html_e('True', 'sliderspack-all-in-one-image-sliders'); ?>
				</label>
				<label for="wp-spaios-ticker-pause-false">
					<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>ticker_hover_bx" value="false" <?php checked('false', $ticker_hover_bx); ?> class="wp-spaios-ticker-pause-false" id="wp-spaios-ticker-pause-false" /><?php esc_html_e('False', 'sliderspack-all-in-one-image-sliders'); ?>
				</label><br/>
				<span class="description"><?php _e('Ticker will pause when mouse hovers over slider.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
	</tbody>
</table><!-- end .wp-spaios-bxslider-sett -->