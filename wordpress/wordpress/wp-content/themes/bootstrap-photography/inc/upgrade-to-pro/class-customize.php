<?php
/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Bootstrap_Photography_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		require_once get_template_directory() . '/inc/upgrade-to-pro/section-pro.php';

		// Register custom section types.
		$manager->register_section_type( 'Bootstrap_Photography_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new Bootstrap_Photography_Customize_Section_Pro(
				$manager,
				'bootstrap-photography',
				array(
					'title'    => esc_html__( 'Premium Verison', 'bootstrap-photography' ),
					'pro_text' => esc_html__( 'Upgrade to Pro',  'bootstrap-photography' ),
					'pro_url'  => 'https://thebootstrapthemes.com/bootstrap-photography-pro/',
					'priority' => 0
				)
			)
		);
	}


	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {
		require_once get_template_directory() . '/inc/upgrade-to-pro/section-pro.php';


		wp_enqueue_script( 'bootstrap-photography-customize-controls', trailingslashit( get_template_directory_uri() ) . '/inc/upgrade-to-pro/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'bootstrap-photography-customize-controls', trailingslashit( get_template_directory_uri() ) . '/inc/upgrade-to-pro/customize-controls.css' );
	}
}
// Doing this customizer thang!
Bootstrap_Photography_Customize::get_instance();