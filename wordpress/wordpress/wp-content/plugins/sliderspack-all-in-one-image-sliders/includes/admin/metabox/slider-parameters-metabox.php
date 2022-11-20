<?php
/**
 * Handles Slider Parameters metabox HTML
 *
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post;

// Taking some functions
$prefix					= WP_APAIOIS_META_PREFIX;
$bx_effect_data			= wp_spaios_bx_effect();
$flex_animation_data	= wp_spaios_flex_animation();
$nivo_effect_data		= wp_spaios_nivo_effect();
$wallop_mode_data		= wp_spaios_wallop_mode();
$un_effect_data			= wp_spaios_un_effect();

// Taking some variable
$check_post_gallery	= get_post_meta( $post->ID, $prefix.'check_post_gallery', true );
$check_post_gallery	= ! empty( $check_post_gallery ) ? $check_post_gallery : 'gallery';

$slider_type		= get_post_meta( $post->ID, $prefix.'slider_type', true );
$slider_type		= ! empty( $slider_type ) ? $slider_type : 'bxslider';

// Taking some common parameters
$arrow			= get_post_meta( $post->ID, $prefix.'arrow', true );
$arrow			= ( $arrow == 'false' ) ? 'false' : 'true';

$pagination		= get_post_meta( $post->ID, $prefix.'pagination', true );
$pagination		= ( $pagination == 'false' ) ? 'false' : 'true';

$autoplay		= get_post_meta( $post->ID, $prefix.'autoplay', true );
$autoplay		= ( $autoplay == 'false' ) ? 'false' : 'true';

$autoplay_speed	= get_post_meta( $post->ID, $prefix.'autoplay_speed', true );
$autoplay_speed	= ! empty( $autoplay_speed ) ? $autoplay_speed : 3000;

$speed			= get_post_meta( $post->ID, $prefix.'speed', true );
$speed			= ! empty( $speed ) ? $speed : 1000;

$loop			= get_post_meta( $post->ID, $prefix.'loop', true );
$loop			= ( $loop == 'false' ) ? 'false' : 'true';

$caption		= get_post_meta( $post->ID, $prefix.'caption', true );
$caption		= ( $caption == 'false' ) ? 'false' : 'true';

$link_target	= get_post_meta( $post->ID, $prefix.'link_target', true );
$link_target	= ! empty( $link_target ) ? $link_target : '_blank';

$image_size		= get_post_meta( $post->ID, $prefix.'slide_media_size', true );	
$image_size 	= ! empty( $image_size ) ? $image_size : 'large';

$fancy_box		= get_post_meta( $post->ID, $prefix.'fancy_box', true );
$fancy_box		= ( $fancy_box == 'false' ) ? 'false' : 'true';
?>

<div class="wp-spaios-common-parameters-sett">

	<!-- WordPress Post Sett - Start -->
	<div class="spaios-show-hide-row spaios-show-if-post" style="<?php if( $check_post_gallery != 'post' ) { echo 'display: none;'; } ?>">
		<?php include_once( WP_APAIOIS_DIR .'/includes/admin/metabox/wp-post-metabox.php' ); ?>
	</div>
	<!-- WordPress Post Sett - End -->

	<table class="form-table wp-spaios-tbl">			
		<tbody>
			<tr>
				<th colspan="2" class="wp-spaios-no-padding">
					<div class="wp-spaios-title-sett"><?php _e('Common Parameters For All Slider', 'sliderspack-all-in-one-image-sliders') ?></div>
				</th>
			</tr>
			<tr class="spaios-show-for-all-type spaios-hide-if-type-polaroids-gallery" style="<?php if( $slider_type == 'polaroids-gallery' ) { echo 'display: none;'; } ?>">
				<td colspan="2" class="wp-spaios-no-padding">
					<table class="form-table wp-spaios-tbl">
						<tr>
							<th>
								<label for="wp-spaios-arrow"><?php _e('Arrow', 'sliderspack-all-in-one-image-sliders'); ?></label>
							</th>
							<td>
								<label for="wp-spaios-arrow-true">
									<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>arrow" value="true" <?php checked('true', $arrow); ?> class="wp-spaios-arrow-true" id="wp-spaios-arrow-true" /><?php esc_html_e('True', 'sliderspack-all-in-one-image-sliders'); ?>
								</label>
								<label for="wp-spaios-arrow-false">
									<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>arrow" value="false" <?php checked('false', $arrow); ?> class="wp-spaios-arrow-false" id="wp-spaios-arrow-false" /><?php esc_html_e('False', 'sliderspack-all-in-one-image-sliders'); ?>
								</label><br/>
								<span class="description"><?php _e('Enable slider Arrows.','sliderspack-all-in-one-image-sliders'); ?></span>
							</td>
						</tr>
						<tr class="wp-spaios-pro-feature">
							<th>
								<label><?php _e('Arrow Theme', 'sliderspack-all-in-one-image-sliders'); ?></label>
							</th>
							<td>
								<select name="" class="wp-spaios-select" disabled>
									<option><?php esc_html_e('Light','sliderspack-all-in-one-image-sliders'); ?></option>
									<option><?php esc_html_e('Dark','sliderspack-all-in-one-image-sliders'); ?></option>
								</select> <br/>
								<span class="description"><?php _e('Select slider arrow theme.','sliderspack-all-in-one-image-sliders'); ?></span>
								<?php echo sprintf( __( 'Upgrade to <a href="%s" target="_blank">Premium Version</a> to get this option.', 'sliderspack-all-in-one-image-sliders'), WP_APAIOIS_PLUGIN_LINK); ?>
							</td>
						</tr>
						<tr>
							<th>
								<label for="wp-spaios-pagination"><?php _e('Pagination', 'sliderspack-all-in-one-image-sliders'); ?></label>
							</th>
							<td>
								<label for="wp-spaios-pagination-true">
									<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>pagination" value="true" <?php checked('true', $pagination); ?> class="wp-spaios-pagination-true" id="wp-spaios-pagination-true" /><?php esc_html_e('True', 'sliderspack-all-in-one-image-sliders'); ?>
								</label>
								<label for="wp-spaios-pagination-false">
									<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>pagination" value="false" <?php checked('false', $pagination); ?> class="wp-spaios-pagination-false" id="wp-spaios-pagination-false" /><?php esc_html_e('False', 'sliderspack-all-in-one-image-sliders'); ?>
								</label><br/>
								<span class="description"><?php _e(' Enable slider pagination.','sliderspack-all-in-one-image-sliders'); ?></span>
							</td>
						</tr>
						<tr class="wp-spaios-pro-feature">
							<th>
								<label><?php _e('Pagination Style', 'sliderspack-all-in-one-image-sliders'); ?></label>
							</th>
							<td>
								<select name="" class="wp-spaios-select" disabled>
									<option><?php esc_html_e('Style 1','sliderspack-all-in-one-image-sliders'); ?></option>
									<option><?php esc_html_e('Style 2','sliderspack-all-in-one-image-sliders'); ?></option>
									<option><?php esc_html_e('Style 3','sliderspack-all-in-one-image-sliders'); ?></option>
									<option><?php esc_html_e('Style 4','sliderspack-all-in-one-image-sliders'); ?></option>
								</select><br/>
								<span class="description"><?php _e('Select slider pagination style.','sliderspack-all-in-one-image-sliders'); ?></span>
								<?php echo sprintf( __( 'Upgrade to <a href="%s" target="_blank">Premium Version</a> to get this option.', 'sliderspack-all-in-one-image-sliders'), WP_APAIOIS_PLUGIN_LINK); ?>
							</td>
						</tr>
						<tr>
							<th>
								<label><?php _e('Autoplay', 'sliderspack-all-in-one-image-sliders'); ?></label>
							</th>
							<td>
								<label for="wp-spaios-autoplay-true">
									<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>autoplay" value="true" <?php checked('true', $autoplay); ?> class="wp-spaios-show-hide wp-spaios-autoplay-true" id="wp-spaios-autoplay-true" data-prefix="autoplay" /><?php esc_html_e('True', 'sliderspack-all-in-one-image-sliders'); ?>
								</label>
								<label for="wp-spaios-autoplay-false">
									<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>autoplay" value="false" <?php checked('false', $autoplay); ?> class="wp-spaios-show-hide wp-spaios-autoplay-false" id="wp-spaios-autoplay-false" data-prefix="autoplay" /><?php esc_html_e('False', 'sliderspack-all-in-one-image-sliders'); ?>
								</label><br/>
								<span class="description"><?php _e('Enable Autoplay for Slider.','sliderspack-all-in-one-image-sliders'); ?></span>
							</td>
						</tr>
						<tr class="spaios-show-hide-row-autoplay spaios-show-if-autoplay-true" style="<?php if( $autoplay == 'false' ) { echo 'display: none'; } ?>">
							<th>
								<label for="wp-spaios-autoplay-speed"><?php _e('Autoplay Speed', 'sliderspack-all-in-one-image-sliders'); ?></label>
							</th>
							<td>
								<input type="text" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>autoplay_speed" value="<?php echo wp_spaios_esc_attr( $autoplay_speed ); ?>" class="wp-spaios-autoplay-speed" id="wp-spaios-autoplay-speed" /><br/>
								<span class="description"><?php _e('Set Speed for Duration of transition between slides (in ms).','sliderspack-all-in-one-image-sliders'); ?></span>
							</td>
						</tr>
						<tr class="spaios-show-hide-row-autoplay spaios-show-if-autoplay-true" style="<?php if( $autoplay == 'false' ) { echo 'display: none'; } ?>">
							<th>
								<label for="wp-spaios-speed"><?php _e('Speed', 'sliderspack-all-in-one-image-sliders'); ?></label>
							</th>
							<td>
								<input type="text" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>speed" value="<?php echo wp_spaios_esc_attr( $speed ); ?>" class="wp-spaios-speed" id="wp-spaios-speed" /><br/>
								<span class="description"><?php _e('Set Speed for Duration of transition between slides (in ms).','sliderspack-all-in-one-image-sliders'); ?></span><br/>
								<span class="description"><?php _e('<strong>Note: </strong>It will not work with `Wallop Slider`.','sliderspack-all-in-one-image-sliders'); ?></span>
							</td>
						</tr>
						<tr>
							<th>
								<label><?php _e('Loop', 'sliderspack-all-in-one-image-sliders'); ?></label>
							</th>
							<td>
								<label for="wp-spaios-loop-true">
									<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>loop" value="true" <?php checked('true', $loop); ?> class="wp-spaios-loop-true" id="wp-spaios-loop-true" /><?php esc_html_e('True', 'sliderspack-all-in-one-image-sliders'); ?>
								</label>
								<label for="wp-spaios-loop-false">
									<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>loop" value="false" <?php checked('false', $loop); ?> class="wp-spaios-loop-false" id="wp-spaios-loop-false" /><?php esc_html_e('False', 'sliderspack-all-in-one-image-sliders'); ?>
								</label><br/>
								<span class="description"><?php _e('Enable slider loop mode.','sliderspack-all-in-one-image-sliders'); ?></span><br/>
								<span class="description"><?php _e('<strong>Note: </strong>it will not work with `Nivo Slider` slider.', 'sliderspack-all-in-one-image-sliders'); ?></span>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr class="wp-spaios-pro-feature">
				<th>
					<label><?php _e('Title', 'sliderspack-all-in-one-image-sliders'); ?></label>
				</th>
				<td>
					<input type="radio" name="" value="" checked="checked" disabled> <?php _e('True', 'sliderspack-all-in-one-image-sliders'); ?>
					<input type="radio" name=""  value="" disabled> <?php _e('False', 'sliderspack-all-in-one-image-sliders'); ?><br/>
					<span class="description"><?php _e('Display image Title.','sliderspack-all-in-one-image-sliders'); ?></span>
					<?php echo sprintf( __( 'Upgrade to <a href="%s" target="_blank">Premium Version</a> to get this option.', 'sliderspack-all-in-one-image-sliders'), WP_APAIOIS_PLUGIN_LINK); ?>
				</td>
			</tr>
			<tr>
				<th>
					<label><?php _e('Caption', 'sliderspack-all-in-one-image-sliders'); ?></label>
				</th>
				<td>
					<label for="wp-spaios-caption-true">
						<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>caption" value="true" <?php checked('true', $caption); ?> class="wp-spaios-caption-true" id="wp-spaios-caption-true" /><?php esc_html_e('True', 'sliderspack-all-in-one-image-sliders'); ?>
					</label>
					<label for="wp-spaios-caption-false">
						<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>caption" value="false" <?php checked('false', $caption); ?> class="wp-spaios-caption-false" id="wp-spaios-caption-false" /><?php esc_html_e('False', 'sliderspack-all-in-one-image-sliders'); ?>
					</label><br/>
					<span class="description"><?php _e(' Display image caption.','sliderspack-all-in-one-image-sliders'); ?></span>
				</td>
			</tr>
			<tr>
				<th>
					<label><?php _e('Link Target', 'sliderspack-all-in-one-image-sliders'); ?></label>
				</th>
				<td>
					<label for="wp-spaios-lt-blank">
						<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>link_target" value="_blank" <?php checked('_blank', $link_target); ?> class="wp-spaios-lt-blank" id="wp-spaios-lt-blank" /><?php esc_html_e('Blank', 'sliderspack-all-in-one-image-sliders'); ?>
					</label>
					<label for="wp-spaios-lt-self">
						<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>link_target" value="_self" <?php checked('_self', $link_target); ?> class="wp-spaios-lt-self" id="wp-spaios-lt-self" /><?php esc_html_e('Self', 'sliderspack-all-in-one-image-sliders'); ?>
					</label><br/>
					<span class="description"><?php _e('Select link target for read more button, title and image.','sliderspack-all-in-one-image-sliders'); ?></span>
				</td>
			</tr>
			<tr>
				<th>
					<label for="wp-spaios-img-size"><?php _e('Image Size', 'sliderspack-all-in-one-image-sliders'); ?></label>
				</th>
				<td>
					<input type="text" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>slide_media_size" value="<?php echo wp_spaios_esc_attr( $image_size ); ?>" class="wp-spaios-img-size" id="wp-spaios-img-size" /><br/>
					<em> <?php _e( 'Enter image size as WordPress standard. Ex: thumbnail, medium, large, full.', 'sliderspack-all-in-one-image-sliders' ) ?></em>
				</td>
			</tr>
			<tr class="wp-spaios-pro-feature">
				<th>
					<label for="wp-spaios-image-fit"><?php _e('Image Fit', 'sliderspack-all-in-one-image-sliders'); ?></label>
				</th>
				<td>
					<input type="radio" name="" value="" checked="checked" disabled> <?php _e('True', 'sliderspack-all-in-one-image-sliders'); ?>
					<input type="radio" name=""  value="" disabled=""> <?php _e('False', 'sliderspack-all-in-one-image-sliders'); ?><br/>
					<span class="description"><?php _e('Set image resized to fit its container.','sliderspack-all-in-one-image-sliders'); ?></span>
					<?php echo sprintf( __( 'Upgrade to <a href="%s" target="_blank">Premium Version</a> to get this option.', 'sliderspack-all-in-one-image-sliders'), WP_APAIOIS_PLUGIN_LINK); ?>
				</td>
			</tr>
			<tr class="wp-spaios-pro-feature">
				<th>
					<label><?php _e('Slider Height', 'sliderspack-all-in-one-image-sliders'); ?></label>
				</th>
				<td>
					<input type="number" name="" value="" disabled><br/>	
					<span class="description"><?php _e('Enter slider height. Ex: 400','sliderspack-all-in-one-image-sliders'); ?></span>
					<?php echo sprintf( __( 'Upgrade to <a href="%s" target="_blank">Premium Version</a> to get this option.', 'sliderspack-all-in-one-image-sliders'), WP_APAIOIS_PLUGIN_LINK); ?>
				</td>
			</tr>
			<tr>
				<th>
					<label><?php _e('Fancy Box Enable', 'sliderspack-all-in-one-image-sliders'); ?></label>
				</th>
				<td>
					<label for="wp-spaios-fancybox-true">
						<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>fancy_box" value="true" <?php checked('true', $fancy_box); ?> class="wp-spaios-show-hide wp-spaios-fancybox-true" id="wp-spaios-fancybox-true" data-prefix="fancy" /><?php esc_html_e('True', 'sliderspack-all-in-one-image-sliders'); ?>
					</label>
					<label for="wp-spaios-fancybox-false">
						<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>fancy_box" value="false" <?php checked('false', $fancy_box); ?> class="wp-spaios-show-hide wp-spaios-fancybox-false" id="wp-spaios-fancybox-false" data-prefix="fancy" /><?php esc_html_e('False', 'sliderspack-all-in-one-image-sliders'); ?>
					</label><br/>
					<span class="description"><?php _e('Enable Fancy Box','sliderspack-all-in-one-image-sliders'); ?></span>
				</td>
			</tr>
		</tbody>
	</table>
		
	<!-- Fancy Box Settings - Start -->
	<div class="wp-spaios-pro-feature spaios-show-hide-row-fancy spaios-show-if-fancy-true" style="<?php if( $fancy_box != 'true' ) { echo 'display: none;'; } ?>">
		<?php include_once( WP_APAIOIS_DIR .'/includes/admin/metabox/fancybox-metabox.php' ); ?>
	</div>
	<!-- Fancy Box Settings - End -->

	<!-- BX Slider Settings - Start -->
	<div class="spaios-show-hide-row-type spaios-show-if-type-bxslider" style="<?php if( $slider_type != 'bxslider' ) { echo 'display: none;'; } ?>">
		<?php include_once( WP_APAIOIS_DIR .'/includes/admin/metabox/bxslider-metabox.php' ); ?>
	</div>
	<!-- BX Slider Settings - End -->

	<!-- Flex Slider Settings - Start -->
	<div class="spaios-show-hide-row-type spaios-show-if-type-flexslider" style="<?php if( $slider_type != 'flexslider' ) { echo 'display: none;'; } ?>">
		<?php include_once( WP_APAIOIS_DIR .'/includes/admin/metabox/flexslider-metabox.php' ); ?>
	</div>
	<!-- Flex Slider Settings - End -->

	<!-- Owl Carousel Slider Settings - Start -->
	<div class="spaios-show-hide-row-type spaios-show-if-type-owl-slider" style="<?php if( $slider_type != 'owl-slider' ) { echo 'display: none;'; } ?>">
		<?php include_once( WP_APAIOIS_DIR .'/includes/admin/metabox/owlslider-metabox.php' ); ?>
	</div>
	<!-- Owl Carousel Slider Settings - End -->

	<!-- Nivo Slider Settings - Start -->
	<div class="spaios-show-hide-row-type spaios-show-if-type-nivo-slider" style="<?php if( $slider_type != 'nivo-slider' ) { echo 'display: none;'; } ?>">
		<?php include_once( WP_APAIOIS_DIR .'/includes/admin/metabox/nivoslider-metabox.php' ); ?>
	</div>
	<!-- Nivo Slider Settings - End -->

	<!-- 3D Slider Settings - Start -->
	<div class="spaios-show-hide-row-type spaios-show-if-type-3dslider" style="<?php if( $slider_type != '3dslider' ) { echo 'display: none;'; } ?>">
		<?php include_once( WP_APAIOIS_DIR .'/includes/admin/metabox/3dslider-metabox.php' ); ?>
	</div>
	<!-- 3D Slider Settings - End -->

	<!-- Swiper Slider Settings - Start -->
	<div class="spaios-show-hide-row-type spaios-show-if-type-swiperslider" style="<?php if( $slider_type != 'swiperslider' ) { echo 'display: none;'; } ?>">
		<?php include_once( WP_APAIOIS_DIR .'/includes/admin/metabox/swiperslider-metabox.php' ); ?>
	</div>
	<!-- Swiper Slider Settings - End -->

	<!-- Wallop Slider Settings - Start -->
	<div class="spaios-show-hide-row-type spaios-show-if-type-wallop-slider" style="<?php if( $slider_type != 'wallop-slider' ) { echo 'display: none;'; } ?>">
		<?php include_once( WP_APAIOIS_DIR .'/includes/admin/metabox/wallopslider-metabox.php' ); ?>
	</div>
	<!-- Wallop Slider Settings - End -->

	<!-- Un Slider Settings - Start -->
	<div class="spaios-show-hide-row-type spaios-show-if-type-un-slider" style="<?php if( $slider_type != 'un-slider' ) { echo 'display: none;'; } ?>">
		<?php include_once( WP_APAIOIS_DIR .'/includes/admin/metabox/unslider-metabox.php' ); ?>
	</div>
	<!-- Un Slider Settings - End -->
</div><!-- end .wp-spaios-common-parameters-sett -->