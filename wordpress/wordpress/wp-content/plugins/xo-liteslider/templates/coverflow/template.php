<?php
/**
 * XO Slider Template.
 * 
 * @version 1.3.0
 * 
 * If you need to edit this file, copy this template.php and style.css files to the following directory
 * in the theme. The files in the theme take precedence.
 * 
 * Directory: "(Theme directory)/xo-liteslider/templates/(Template ID)/"
 */

class XO_Slider_Template_Coverflow extends XO_Slider_Template_Base {
	/**
	 * Template ID.
	 *
	 * @var string
	 */
	public $id = 'coverflow';

	/**
	 * Template name.
	 *
	 * @var string
	 */
	public $name = 'Coverflow';

	/**
	 * Template version.
	 *
	 * @var string
	 */
	public $version = '1.3.0';

	/**
	 * Enqueue scripts and styles.
	 */
	public function enqueue_scripts( $template_slug ) {
		if ( $this->id === $template_slug ) {
			wp_enqueue_style( "xo-slider-template-{$this->id}", $this->get_template_uri() . 'style.css', [], $this->version );
		}
	}

	/**
	 * Gets the description HTML.
	 */
	public function get_description() {
		return __( 'A template that displays a slider for a 3D coverflow effect. Video is not supported.', 'xo-liteslider' );
	}

	/**
	 * Get the slider HTML.
	 * 
	 * @param object $slide {
	 *     Slide data.
	 *
	 *     @type int   $id     Slide ID.
	 *     @type array $slides Slides data.
	 *     @type array $params Slide parameters.
	 * }
	 * @return string Slider HTML.
	 */
	public function get_html( $slide ) {
		$width_style = ( 0 === $slide->params['width'] ) ? '' : sprintf( ' style="width: %dpx;"', $slide->params['width'] );
		$height_style = ( 0 === $slide->params['height'] ) ? '' : sprintf( ' style="height: %dpx;"', $slide->params['height'] );

		$html = "<div class=\"swiper swiper-container\"{$width_style}>\n";

		$html .= '<div class="swiper-wrapper">' . "\n";
		foreach ( $slide->slides as $slide_data ) {
			if ( empty( $slide_data['media_id'] ) ) {
				continue;
			}

			$attr = ['class' => 'slide-image'];
			if ( $slide_data['alt'] ) {
				$attr['alt'] = $slide_data['alt'];
			}
			if ( $slide_data['title_attr'] ) {
				$attr['title'] = $slide_data['title_attr'];
			}
			$img = wp_get_attachment_image( $slide_data['media_id'], 'full', false, $attr );

			if ( $img ) {
				$html .= '<div class="swiper-slide mime-type-image">';

				$html .= "<div class=\"slide-image-wrap\"{$height_style}>";
				if ( $slide_data['link'] ) {
					$target = ( ! empty( $slide_data['link_newwin'] ) && $slide_data['link_newwin'] ) ? ' target="_blank" rel="noopener noreferrer"' : '';
					$html .= '<a href="' . esc_url( $slide_data['link'] ) . '"' . $target . '>' . $img . '</a>';
				} else {
					$html .= $img;
				}
				$html .= '</div>';

				if ( ! empty( $slide->params['content'] ) ) {
					$html .= '<div class="slide-content">' . wp_kses_post( $slide_data['content'] ) . '</div>';
				}

				$html .= "</div>\n"; // <!-- .swiper-slide -->
			}
		}
		$html .= "</div>\n"; // <!-- .swiper-wrapper -->

		if ( $slide->params['pagination'] ) {
			$html .= "<div class=\"swiper-pagination\"></div>\n";
		}

		$html .= "</div>\n"; // <!-- .swiper-container -->

		return $html;
	}

	/**
	 * Get the slider script.
	 *
	 * @param object $slide {
	 *     Slide data.
	 *
	 *     @type int   $id     Slide ID.
	 *     @type array $slides Slides data.
	 *     @type array $params Slide parameters.
	 * }
	 * @return array|false Slider script, false to not output the script.
	 */
	public function get_script( $slide ) {
		$params = [
			'effect'          => 'coverflow',
			'grabCursor'      => true,
			'centeredSlides'  => true,
			'slidesPerView'   => 'auto',
			'coverflowEffect' => ['rotate' => 50, 'stretch' => 0, 'depth' => 100, 'modifier' => 1, 'slideShadows' => true],
			'pagination'      => ['el' => $slide->params['pagination'] ? '.swiper-pagination' : null],
			'speed'           => $slide->params['speed'],
			'loop'            => true,
		];

		if ( ! empty( $slide->params['autoplay'] ) ) {
			$params['autoplay'] = [
				'delay' => @$slide->params['delay'],
				'stopOnLastSlide' => @$slide->params['stop_on_last_slide'] ?: false,
				'disableOnInteraction' => @$slide->params['disable_on_interaction'] ?: true,
			];
		} else {
			$params['autoplay'] = false;
		}

		if ( $slide->params['space_between'] ) $params['spaceBetween'] = $slide->params['space_between'];
		if ( $slide->params['slides_per_view'] ) $params['slidesPerView'] = $slide->params['slides_per_view'];
		if ( $slide->params['slides_per_group'] ) $params['slidesPerGroup'] = $slide->params['slides_per_group'];
		if ( $slide->params['auto_height'] ) $params['autoHeight'] = $slide->params['auto_height'];

		/**
		 * Filter slider script parameters.
		 *
		 * @since 2.0.0
		 *
		 * @param string      $params Script parameters.
		 * @param array       $slide  Slide data.
		 * @param string|null $key    Script parameter key.
		 */
		$params = apply_filters( 'xo_slider_script_parameter', $params, $slide, null );

		$json = json_encode( $params );
		$script = "var xoSlider{$slide->id} = new Swiper('#xo-slider-{$slide->id} .swiper-container', {$json});";

		return $script;
	}
}
