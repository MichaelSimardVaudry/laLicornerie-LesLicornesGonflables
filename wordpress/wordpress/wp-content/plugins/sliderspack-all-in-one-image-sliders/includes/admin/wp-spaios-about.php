<?php
/**
 * Designs and Plugins Feed
 *
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Action to add menu
add_action('admin_menu', 'wp_spaios_register_about_page');

/**
 * Register plugin design page in admin menu
 * 
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */
function wp_spaios_register_about_page() {
	add_submenu_page( 'edit.php?post_type='.WP_APAIOIS_POST_TYPE, __('About', 'sliderspack-all-in-one-image-sliders'), __('About', 'sliderspack-all-in-one-image-sliders'), 'manage_options', 'welcome_sliderspack', 'wp_spaios_about_page' );
	// Register plugin premium page
	add_submenu_page( 'edit.php?post_type='.WP_APAIOIS_POST_TYPE, __('Upgrade to PRO - SlidersPack', 'sliderspack-all-in-one-image-sliders'), '<span style="color:#ff2700">'.__('Upgrade to PRO', 'sliderspack-all-in-one-image-sliders').'</span>', 'manage_options', 'wp-spaios-premium', 'wp_spaios_premium_page' );
}

/**
 * Function to display plugin design HTML
 * 
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */
function wp_spaios_about_page() {
	
	$wp_spaios_tabs = apply_filters('wp_spaios_about_tabs', array(
					'wp_spaios_welcome' => __("What's New", 'sliderspack-all-in-one-image-sliders'),
				));
	$active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'wp_spaios_welcome';
	?>
	<div class="wrap about-wrap wp-spaios-about-wrap">

	<div id="fb-root"></div>

		<h1><?php echo __('Welcome to', 'sliderspack-all-in-one-image-sliders').' SlidersPack '.WP_APAIOIS_VERSION; ?></h1>

		<div class="about-text"><?php echo sprintf( __('Thank you for using <a href="%s" target="_blank">%s</a>. Please <a href="%s" target="_blank">rate us</a>. A huge thanks in advance!', 'sliderspack-all-in-one-image-sliders'), 'https://www.essentialplugin.com/', 'SlidersPack', 'https://wordpress.org/support/plugin/sliderspack-all-in-one-image-sliders/reviews/#new-post' ); ?></br></br>
		<a class="button button-primary" href="<?php echo admin_url( 'edit.php?post_type='.WP_APAIOIS_POST_TYPE); ?>" target="_blank"><?php _e('Create Sliders', 'sliderspack-all-in-one-image-sliders'); ?></a>									
		<a class="button button-primary" href="http://demo.wponlinesupport.com/sliderspack-all-in-one-image-post-slider/" target="_blank"><?php _e('Demo for Sliders', 'sliderspack-all-in-one-image-sliders'); ?></a>
	</div>
		<div class="wp-badge wp-spaios-page-logo"><?php echo __('Version', 'sliderspack-all-in-one-image-sliders') .' '. WP_APAIOIS_VERSION; ?></div>
		
		<?php if( !empty($wp_spaios_tabs) ) { ?>
		<h2 class="nav-tab-wrapper">
			<?php foreach ($wp_spaios_tabs as $tab_key => $tab_val) { 

				if( empty($tab_key) ) {
					continue;
				}

				$active_tab_cls	= ($active_tab == $tab_key) ? 'nav-tab-active' : '';
				$tab_link 		= admin_url( 'edit.php?post_type='.WP_APAIOIS_POST_TYPE.'&page=welcome_sliderspack' );
			?>
				<a class="nav-tab <?php echo $active_tab_cls; ?>" href="<?php echo $tab_link; ?>"><?php echo $tab_val; ?></a>
			<?php } ?>
		</h2>
		<?php } ?>

		<div class="wp-spaios-cnt-wrap wp-spaios-nav-tab-cnt-wrap wp-spaios-clearfix">
			<?php if( $active_tab == 'wp_spaios_welcome' ) { ?>
			<div class="wp-spaios-welcome-tab-cnt wp-spaios-clearfix">
				<h2><?php _e('SlidersPack – All In One Image Sliders', 'sliderspack-all-in-one-image-sliders'); ?></h2>
				<p class="lead-description"><?php _e('SlidersPack - You can create your own unique, SEO-optimized sliders/carousel. Also SlidersPack work with WordPress Posts.', 'sliderspack-all-in-one-image-sliders'); ?></p>
				<div class="wp-spaios-intro-image wp-spaios-columns wp-spaios-medium-5">
					<img src="<?php echo WP_APAIOIS_URL; ?>/assets/images/sliderspack-logo.png" alt="SlidersPack" />
				</div>
				<div class="wp-spaios-columns wp-spaios-medium-7">
					<p><?php _e('The largest Slider bundle for WordPress with 10 slider with shortcode. All Slider are totally unique, Developed with passion, Use individually to fit your website.', 'sliderspack-all-in-one-image-sliders'); ?></p>
					<p><?php _e('Enable / Disable feature of particular slider so use only those slider which requires to your website and others will not disturb you'); ?> :)</p>
					
				</div>

				<div class="wp-spaios-columns wp-spaios-medium-12">
					<hr/>
					<h2><?php _e('Existing Sliders', 'sliderspack-all-in-one-image-sliders'); ?></h2>
				</div>

				<div class="wp-spaios-icolumns-wrap wp-spaios-about-module-wrap wp-spaios-clearfix clear">
					<div class="wp-spaios-icolumns wp-spaios-medium-4 wp-spaios-about-module">
						<div class="wp-spaios-about-module-inr">
							<div class="wp-spaios-about-module-title"><span>FlexSlider 2</span></div>
							<div class="wp-spaios-about-module-desc">Responsive, Slider/Carousel, 2 transition effects.</div>
						</div>
					</div></br>
					<div class="wp-spaios-icolumns wp-spaios-medium-4 wp-spaios-about-module">
						<div class="wp-spaios-about-module-inr">
							<div class="wp-spaios-about-module-title"><span>BXSlider</span></div>
							<div class="wp-spaios-about-module-desc">Responsive, Slider/Carousel, Ticker, Horizontal, vertical, and fade modes.</div>
						</div>
					</div>
					<div class="wp-spaios-icolumns wp-spaios-medium-4 wp-spaios-about-module">
						<div class="wp-spaios-about-module-inr">
							<div class="wp-spaios-about-module-title"><span>Owl Slider/Carousel 2</span></div>
							<div class="wp-spaios-about-module-desc">Responsive, Slider/Carousel, Center and Autowidth mode.</div>
						</div>
					</div>
					<div class="wp-spaios-icolumns wp-spaios-medium-4 wp-spaios-about-module">
						<div class="wp-spaios-about-module-inr">
							<div class="wp-spaios-about-module-title"><span>Swiper Slider</span></div>
							<div class="wp-spaios-about-module-desc">Responsive, Slider/Carousel, Center, Horizontal, vertical mode.</div>
						</div>
					</div>
					<div class="wp-spaios-icolumns wp-spaios-medium-4 wp-spaios-about-module">
						<div class="wp-spaios-about-module-inr">
							<div class="wp-spaios-about-module-title"><span>3D Slider</span></div>
							<div class="wp-spaios-about-module-desc">Responsive Carousel with 3d effect.</div>
						</div>
					</div>
					<div class="wp-spaios-icolumns wp-spaios-medium-4 wp-spaios-about-module">
						<div class="wp-spaios-about-module-inr">
							<div class="wp-spaios-about-module-title"><span>Wallop Slider</span></div>
							<div class="wp-spaios-about-module-desc">Responsive Slider and Much more than just a slider.</div>
						</div>
					</div>
					<div class="wp-spaios-icolumns wp-spaios-medium-4 wp-spaios-about-module">
						<div class="wp-spaios-about-module-inr">
							<div class="wp-spaios-about-module-title"><span>Unslider</span></div>
							<div class="wp-spaios-about-module-desc">Responsive Slider and is an ultra-simple jQuery slider for your website.</div>
						</div>
					</div>
					<div class="wp-spaios-icolumns wp-spaios-medium-4 wp-spaios-about-module">
						<div class="wp-spaios-about-module-inr">
							<div class="wp-spaios-about-module-title"><span>Nivo Slider</span></div>
							<div class="wp-spaios-about-module-desc">Responsive, 16 Transition Effects.</div>
						</div>
					</div>
					<div class="wp-spaios-icolumns wp-spaios-medium-4 wp-spaios-about-module">
						<div class="wp-spaios-about-module-inr">
							<div class="wp-spaios-about-module-title"><span>Scattered Polaroids Gallery</span></div>
							<div class="wp-spaios-about-module-desc">Responsive image gallery slider.</div>
						</div>
					</div>
				</div><!-- end .wp-spaios-icolumns-wrap -->
			</div><!-- end .wp-spaios-welcome-tab-cnt -->
			<?php } else {
				do_action( 'wp_spaios_about_tabs_cnt_'.$active_tab, $active_tab );
			} ?>

			<div class="wp-spaios-columns wp-spaios-medium-12">
				<p>
					<?php echo __('Thank you for choosing', 'sliderspack-all-in-one-image-sliders'); ?> SlidersPack,
					<a href="<?php echo WP_APAIOIS_SITE_LINK; ?>" target="_blank">Essential Plugin</a>
				</p>
			</div>
		</div><!-- end .wp-spaios-nav-tab-cnt-wrap -->

	</div><!-- wp-spaios-about-wrap -->
<?php }
/**
	 * Pro Page
	 * 
	 * @package SlidersPack
	 * @since 1.0.0
	 */
	function wp_spaios_premium_page() {
		include_once( WP_APAIOIS_DIR . '/includes/admin/premium.php' );
	}