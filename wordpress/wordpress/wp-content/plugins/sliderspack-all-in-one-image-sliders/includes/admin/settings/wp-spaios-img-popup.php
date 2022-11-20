<?php
/**
 * Image Data Popup
 *
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<div class="wp-spaios-img-data-wrp wp-spaios-hide">
	<div class="wp-spaios-img-data-cnt">

		<div class="wp-spaios-img-cnt-block">
			<div class="wp-spaios-popup-close wp-spaios-popup-close-wrp"><img src="<?php echo WP_APAIOIS_URL; ?>assets/images/close.png" alt="<?php _e('Close (Esc)', 'sliderspack-all-in-one-image-sliders'); ?>" title="<?php _e('Close (Esc)', 'sliderspack-all-in-one-image-sliders'); ?>" /></div>

			<div class="wp-spaios-popup-body-wrp">
			</div><!-- end .wp-spaios-popup-body-wrp -->
			
			<div class="wp-spaios-img-loader"><?php _e('Please Wait', 'sliderspack-all-in-one-image-sliders'); ?> <span class="spinner"></span></div>

		</div><!-- end .wp-spaios-img-cnt-block -->

	</div><!-- end .wp-spaios-img-data-cnt -->
</div><!-- end .wp-spaios-img-data-wrp -->
<div class="wp-spaios-popup-overlay"></div>