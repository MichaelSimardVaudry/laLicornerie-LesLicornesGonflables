<?php
/**
 * XO Slider: main class.
 *
 * @package XOSlider
 * @since 1.0.0
 */

class XO_Slider {
	const DEFAULT_TEMPLATE_SLUG = 'default';
	public $plugin_dir;
	public $options;
	public $admin;
	public $templates;

	public function __construct() {
		$this->plugin_dir = dirname( __DIR__ );

		if ( is_admin() ) {
			require_once( $this->plugin_dir . '/inc/admin.php' );
			$this->admin = new XO_Slider_Admin( $this );
		}

		require_once( $this->plugin_dir . '/inc/xo-slider-widget.php' );
		require_once( $this->plugin_dir . '/inc/class-xo-slider-template-base.php' );

		add_action( 'plugins_loaded', [$this, 'plugins_loaded'] );
	}

	public function plugins_loaded() {
		$version = get_option( 'xo_slider_version' );
		if ( false === $version ) {
			update_option( 'xo_slider_version', XO_SLIDER_VERSION );
		}
		$this->options = get_option( 'xo_slider_options' );
		if ( false === $this->options ) {
			$this->options = ['css_load' => 'body'];
			update_option( 'xo_slider_options', $this->options );
		}

		add_action( 'init', [$this, 'init'] );
		add_action( 'wp_enqueue_scripts', [$this, 'enqueue_header'] );
        add_action( 'widgets_init', [$this, 'register_widget'] );
		add_shortcode( 'xo_liteslider', [$this, 'get_liteslider_shortcode'] );
		add_shortcode( 'xo_slider', [$this, 'get_slider_shortcode'] );

		if ( function_exists( 'register_block_type' ) ) {
			add_action( 'rest_api_init', [$this, 'initialize_rest_api'] );
			add_action( 'init', [$this, 'initialize_blocks'] );
			add_action( 'enqueue_block_editor_assets', [$this, 'enqueue_block_editor_assets'] );
		}
	}
	
	public function enqueue_header() {
		wp_enqueue_style( 'xo-slider', plugins_url( 'css/base.css', __DIR__ ), [], XO_SLIDER_VERSION );

		if ( ! empty( $this->options['css_load'] ) && 'head' === $this->options['css_load'] ) {
			wp_enqueue_style( 'swiper', plugins_url( 'vendor/swiper/swiper-bundle.min.css', __DIR__ ), [], XO_SLIDER_VERSION );

			// Enqueue all templates.
			foreach ( $this->templates as $template ) {
				wp_enqueue_style( "xo-slider-template-{$template->id}", $template->get_template_uri() . 'style.css', [], $template->version );
			}
		}
	}

	public function enqueue_scripts( $template_slug ) {
		if ( ! empty( $this->options['css_load'] ) && 'body' === $this->options['css_load'] ) {
			wp_enqueue_style( 'swiper', plugins_url( 'vendor/swiper/swiper-bundle.min.css', __DIR__ ), [], XO_SLIDER_VERSION );

			do_action( 'xo_slider_enqueue_scripts', $template_slug );
		}

		wp_enqueue_script( 'swiper', plugins_url( 'vendor/swiper/swiper-bundle.min.js', __DIR__ ), [], XO_SLIDER_VERSION, false );
	}

	public function init() {
		register_post_type( 'xo_liteslider', [
			'labels' => [
				'name' => __( 'Sliders', 'xo-liteslider' ),
				'singular_name' => __( 'Slider', 'xo-liteslider' ),
				'menu_name' => __( 'Sliders', 'xo-liteslider' ),
				'name_admin_bar' => __( 'Sliders', 'xo-liteslider' ),
				'all_items' => __( 'All Sliders', 'xo-liteslider' ),
				'add_new' => __( 'Add New', 'xo-liteslider' ),
				'add_new_item' => __( 'Add New', 'xo-liteslider' ),
				'edit_item' => __( 'Edit Slider', 'xo-liteslider' ),
				'new_item' => __( 'New Slider', 'xo-liteslider' ),
				'view_item' => __( 'View Slider', 'xo-liteslider' ),
				'search_items' => __( 'Search Slider', 'xo-liteslider' ),
				'not_found' => __( 'No sliders found', 'xo-liteslider' ),
				'not_found_in_trash' => __( 'No sliders found in Trash', 'xo-liteslider' ),
			],
			'public' => false,
			'exclude_from_search' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'query_var' => false,
			'rewrite' => false,
			'capability_type' => 'post',
			'has_archive' => false,
			'hierarchical' => false,
			'menu_position' => 25,
			'menu_icon' => 'dashicons-slides',
			'supports' => ['title', 'author'],

			'show_in_rest' => true,
			'rest_base' => 'xo_liteslider',
		 ] );

		$this->templates = $this->get_templates();
	}

	/**
	 * Get instances of all templates.
	 *
	 * @since 3.2.0
	 *
	 * @return array Array of template objects.
	 */
	private function get_templates() {
		$templates = [];
		$dirs = scandir( $this->plugin_dir . '/templates' );
		foreach ( $dirs as $dir ) {
			if ( '.' === $dir[0] || ! is_dir( $this->plugin_dir . '/templates/' . $dir ) ) {
				continue;
			}

			$file =  $this->plugin_dir . '/templates/' . $dir . '/template.php';
			if ( ! file_exists( $file ) ) {
				continue;
			}
	
			$theme_file = locate_template( 'xo-liteslider/templates/' . $dir . '/template.php', true, true );
			if ( empty( $theme_file ) ) {
				require_once( $file );
				$use_theme_templates = false;
			} else {
				$use_theme_templates = true;
			}
			$class = 'XO_Slider_Template_' . ucfirst( $dir );
			$template = new $class( $use_theme_templates );
			$templates[$template->id] = $template;
		}
		return $templates;
	}

	public function get_slider( $id = 0, $attributes = null ) {
		if ( 0 === $id ) {
			// If no ID is specified, use the first slide.
			$slider_posts = get_posts( ['post_type' => 'xo_liteslider', 'orderby' => 'date', 'order' => 'ASC', 'numberposts' => 1] );
			if ( $slider_posts ) {
				$id = $slider_posts[0]->ID;
			}
		}

		$slides = get_post_meta( $id, 'slides', true );
		if ( empty( $slides ) ) {
			return;
		}

		$params = get_post_meta( $id, 'parameters', true );

		switch ( $params['sort'] ) {
			case 'random': shuffle( $slides ); break;
			case 'desc': $slides = array_reverse( $slides ); break;
		}

		// Measures against v2.1.0 or data below.
		foreach ( $slides as $key => $slide_data ) {
			if ( ! isset( $slide_data['media_id'] ) && isset( $slide_data['image_id'] ) ) {
				$slides[$key]['media_id'] = $slide_data['image_id'];
				$slides[$key]['media_type'] = 'image';
			}
		}

		$slide = (object) [ 'id' => $id, 'slides' => $slides, 'params' => $params ];

		$template_slug = empty( $slide->params['template'] ) ? self::DEFAULT_TEMPLATE_SLUG : $slide->params['template'];
		$template = $this->templates[$template_slug];

		$this->enqueue_scripts( $template_slug );

		$class = 'xo-slider';
		if ( ! empty( $attributes['className'] ) ) {
			$class .= ' ' . $attributes['className'];
		}
		if ( ! empty( $attributes['align'] ) ) {
			$class .= ' align' . $attributes['align'];
		}

		$html  = "<div id=\"xo-slider-{$slide->id}\" class=\"{$class} xo-slider-template-{$template->id}\">\n";
		$html .= $template->get_html( $slide );
		$html .= "</div>\n";

		/**
		 * Filter the slider HTML.
		 *
		 * @since 2.0.0
		 *
		 * @param string $script HTML.
		 * @param object $slide {
		 *     Slide data.
		 *
		 *     @type int   $id     Slide ID.
		 *     @type array $slides Slides data.
		 *     @type array $params Slide parameters.
		 * }
		 */
		$html = apply_filters( 'xo_slider_html', $html, $slide );

		$script = 'window.addEventListener("load", function() { ' . $template->get_script( $slide ) . ' });';

		/**
		 * Filters the slider script.
		 *
		 * @since 2.0.0
		 *
		 * @param string $script Script.
		 * @param object $slide {
		 *     Slide data.
		 *
		 *     @type int   $id     Slide ID.
		 *     @type array $slides Slides data.
		 *     @type array $params Slide parameters.
		 * }
		 */
		$script = apply_filters( 'xo_slider_script', $script, $slide );

		if ( $script ) {
			wp_add_inline_script( 'swiper', $script, 'after' );
		}

		return $html;
	}

	public function get_liteslider_shortcode( $atts ) {
		extract( shortcode_atts( [
			'id' => 0
		], $atts, 'xo_liteslider' ) );
		return $this->get_slider( $id );
	}

	public function get_slider_shortcode( $atts ) {
		extract( shortcode_atts( [
			'id' => 0
		], $atts, 'xo_slider' ) );
		return $this->get_slider( $id );
	}

	public function register_widget() {
		register_widget( 'XO_Widget_Slider' );
	}

	public function initialize_rest_api() {
		register_rest_route( 'xo-slider/v1', '/preview/(?P<id>[\d]+)', [
			'methods' => WP_REST_Server::READABLE,
			'callback' => [$this, 'get_preview'],
			'permission_callback' => '__return_true',
		] );
	}

	public function get_preview( $data ) {
		global $xo_slider;
	
		$slider_id = $data['id'];
		$base_css_url = plugins_url( 'css/base.css', __DIR__ );
		$file = plugin_dir_path( __FILE__ ) . 'preview.php';
		$res = ! empty( $file ) ? include_once $file : [];
	
		$response = new WP_REST_Response( $res );
		$response->set_status( 200 );

		return $response;
	}

	public function initialize_blocks() {
		$script_asset_path = "{$this->plugin_dir}/build/index.asset.php";
		$script_asset = require( $script_asset_path );
		wp_register_script( 'xo-liteslider-xo-slider-block-editor', plugins_url( 'build/index.js', __DIR__ ), $script_asset['dependencies'], $script_asset['version'] );
		wp_register_style( 'xo-liteslider-xo-slider-block-editor', plugins_url( 'build/index.css', __DIR__ ), [], $script_asset['version'] );

		if ( function_exists( 'wp_set_script_translations' ) ) {
			wp_set_script_translations( 'xo-liteslider-xo-slider-block-editor', 'xo-liteslider', "{$this->plugin_dir}/languages" );
		} elseif ( function_exists( 'gutenberg_get_jed_locale_data' ) ) {
			$locale  = gutenberg_get_jed_locale_data( $_settings_plugin->text_domain );
			wp_add_inline_script( 'xo-liteslider', 'data', 'wp.i18n.setLocaleData( ' . json_encode( $locale ) . ', "xo-liteslider" );' );
		}

		register_block_type( 'xo-liteslider/xo-slider', [
			'editor_script'   => 'xo-liteslider-xo-slider-block-editor',
			'editor_style'    => 'xo-liteslider-xo-slider-block-editor',
			'style'           => 'xo-liteslider-xo-slider-block',
			'attributes'      => [
				'className' => [
					'type'    => 'string',
					'default' => '',
				],
				'align' => [
					'type'    => 'string',
					'default' => '',
				],
				'sliderID' => [
					'type'    => 'number',
					'default' => 0,
				]
			],
			'render_callback' => [$this, 'xo_slider_block_render_callback'],
		 ] );
	}
	
	public function xo_slider_block_render_callback( $attributes ) {
		$slider_id = @$attributes['sliderID'];
	
		global $xo_slider;
		$slider = $xo_slider->get_slider( $slider_id, $attributes );
		return $slider;
	}

	public function enqueue_block_editor_assets() {
		$script = <<<SCRIPT
function xoSliderIframeLoaded(clientID) {
	var sliderBlock = document.getElementById('block-' + clientID);
	var sliderFrame = sliderBlock.getElementsByTagName('iframe')[0];
	var innerHeight = sliderFrame.contentWindow.document.body.scrollHeight;
	var innerWidth = sliderFrame.contentWindow.document.body.scrollWidth;
	var sliderFrameWrapper = sliderFrame.parentNode;
	if ( 0 < innerHeight && 0 < innerWidth ) {
		sliderFrameWrapper.style.paddingTop = (innerHeight / innerWidth * 100) + '%';
	}
};
SCRIPT;
		wp_add_inline_script( 'wp-blocks', $script );
	}
}
