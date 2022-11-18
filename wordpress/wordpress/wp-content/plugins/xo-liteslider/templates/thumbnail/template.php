<?php
/**
 * XO Slider Template.
 * 
 * @version 1.6.0
 * 
 * If you need to edit this file, copy this template.php and style.css files to the following directory
 * in the theme. The files in the theme take precedence.
 * 
 * Directory: "(Theme directory)/xo-liteslider/templates/(Template ID)/"
 */

class XO_Slider_Template_Thumbnail extends XO_Slider_Template_Base {
	/**
	 * Template ID.
	 *
	 * @var string
	 */
	public $id = 'thumbnail';

	/**
	 * Template name.
	 *
	 * @var string
	 */
	public $name = 'Thumbnail';

	/**
	 * Template version.
	 *
	 * @var string
	 */
	public $version = '1.6.0';

	/**
	 * Enqueue scripts and styles.
	 */
	public function enqueue_scripts( $template_slug ) {
		if ( $this->id === $template_slug ) {
			wp_enqueue_style( 'xo-slider-template-thumbnail', plugins_url( 'style.css', __FILE__ ), [], $this->version );
		}
	}

	/**
	 * Gets the description HTML.
	 */
	public function get_description() {
		return __( 'This template displays a slider with thumbnails. Video is not supported.', 'xo-liteslider' );
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
		$style = '';
		if ( ! empty( $slide->params['width'] ) ) {
			$style .= "width:{$slide->params['width']}px;";
		}
		if ( ! empty( $slide->params['height'] ) ) {
			$style .= "height:{$slide->params['height']}px;";
		}
		if ( $style ) {
			$style = " style=\"{$style}\"";
		}

		$imgs = [];
		foreach ( $slide->slides as $key => $slide_data ) {
			if ( @$slide_data['image_id'] ) {
				$attr = ['class' => 'slide-image'];
				if ( isset( $slide_data['alt'] ) ) {
					$attr['alt'] = $slide_data['alt'];
				}
				if ( isset( $slide_data['title_attr'] ) ) {
					$attr['title'] = $slide_data['title_attr'];
				}
				$img = wp_get_attachment_image( $slide_data['image_id'], 'full', false, $attr );
				if ( $img ) {
					$imgs[$key] = $img;
				}
			}
		}

		$html = "<div class=\"swiper swiper-container gallery-main\"{$style}>\n";
		$html .= '<div class="swiper-wrapper">' . "\n";
		foreach ( $imgs as $key => $img ) {
			$slide_data = $slide->slides[$key];

			$html .= '<div class="swiper-slide mime-type-image">';

			if ( ! empty( $slide_data['link'] ) ) {
				$target = ( ! empty( $slide_data['link_newwin'] ) && $slide_data['link_newwin'] ) ? ' target="_blank" rel="noopener noreferrer"' : '';
				$html .= '<a href="' . esc_url( $slide_data['link'] ) . '"' . $target . '>' . $img . '</a>';
			} else {
				$html .= $img;
			}

			if ( ! empty( $slide->params['content'] ) ) {
				$html .= '<div class="slide-content">' . "\n";

				if ( ! empty( $slide_data['title'] ) ) {
					$html .= '<div class="slide-content-title">' . wp_kses_post( $slide_data['title'] ) . '</div>' . "\n";
				}
				if ( ! empty( $slide_data['subtitle'] ) ) {
					$html .= '<div class="slide-content-subtitle">' . wp_kses_post( $slide_data['subtitle'] ) . '</div>' . "\n";
				}
				if ( ! empty( $slide_data['content'] ) ) {
					$html .= '<div class="slide-content-text">' . wp_kses_post( $slide_data['content'] ) . '</div>' . "\n";
				}
				if ( ! empty( $slide_data['button_text'] ) && ! empty( $slide_data['button_link'] ) ) {
					$target = ( ! empty( $slide_data['button_newwin'] ) && $slide_data['button_newwin'] ) ? ' target="_blank" rel="noopener noreferrer"' : '';
					$html .= '<div class="slide-content-button"><a href="' . esc_url( $slide_data['button_link'] ) . '" class="slide-content-button-main"' . $target . '>' . wp_kses_post( $slide_data['button_text'] ) . '</a></div>' . "\n";
				}

				$html .= "</div>\n"; // <!-- .slide-content -->
			}

			$html .= '</div>' ."\n"; // <!-- .swiper-slide -->
		}
		$html .= '</div>'. "\n"; // <!-- .swiper-wrapper -->

		if ( @$slide->params['pagination'] ) {
			$html .= '<div class="swiper-pagination swiper-pagination-white"></div>' . "\n";
		}

		if ( @$slide->params['navigation'] ) {
			$html .= '<div class="swiper-button-next swiper-button-white"></div>'. "\n";
			$html .= '<div class="swiper-button-prev swiper-button-white"></div>'. "\n";
		}

		$html .= '</div>'. "\n"; // <!-- swiper-container -->

		$html .= '<div class="swiper swiper-container gallery-thumbs">' . "\n";
		$html .= '<div class="swiper-wrapper">' . "\n";
		foreach ( $imgs as $key => $img ) {
			$html .= "<div class=\"swiper-slide\">{$img}</div>\n";
		}
		$html .= "</div>\n"; // <!-- .swiper-wrapper -->
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
		$count = @$slide->params['thumbs_per_view'] ?: count( $slide->slides );

		if ( isset( $slide->params['navigation'] ) ) {
			$next = '.swiper-button-next';
			$prev = '.swiper-button-prev';
		} else {
			$next = null;
			$prev = null;
		}

		$thumb_params = [
			'slidesPerView'         => $count,
			'freeMode'              => true,
			'watchSlidesVisibility' => true,
			'watchSlidesProgress'   => true,
		];

		if ( ! empty( $slide->params['thumbs_space_between'] ) ) $thumb_params['spaceBetween'] = $slide->params['thumbs_space_between'];

		$params = [
			'pagination'     => ['el' => isset( $slide->params['pagination'] ) ? '.swiper-pagination' : null, 'clickable' => true],
			'navigation'     => ['nextEl' => $next, 'prevEl' => $prev],
			'effect'         => in_array( @$slide->params['effect'], ['slide', 'fade', 'cube', 'coverflow', 'flip'] ) ? $slide->params['effect'] : 'slide',
			'speed'          => @$slide->params['speed'] ?: 300,
			'loop'           => @$slide->params['loop'],
			'loopedSlides'   => $count,
			'centeredSlides' => isset( $slide->params['centered_slides'] ) ? $slide->params['centered_slides'] : false,
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

		if ( ! empty( $slide->params['slides_per_view'] ) ) $params['slidesPerView'] = $slide->params['slides_per_view'];
		if ( ! empty( $slide->params['slides_per_group'] ) ) $params['slidesPerGroup'] = $slide->params['slides_per_group'];
		if ( ! empty( $slide->params['space_between'] ) ) $params['spaceBetween'] = $slide->params['space_between'];
		if ( ! empty( $slide->params['auto_height'] ) ) $params['autoHeight'] = $slide->params['auto_height'];

		/**
		 * Filter slider script parameters.
		 *
		 * @since 2.0.0
		 *
		 * @param string      $params Script parameters.
		 * @param array       $slide  Slide data.
		 * @param string|null $key    Script parameter key.
		 */
		$thumb_params = apply_filters( 'xo_slider_script_parameter', $thumb_params, $slide, 'thumbs' );
		$params = apply_filters( 'xo_slider_script_parameter', $params, $slide, '' );

		$thumb_json = json_encode( $thumb_params );
		$json = substr( substr( json_encode( $params ), 1 ), 0, -1 );

		$script =
			"var xoSlider{$slide->id}Thumbs = new Swiper('#xo-slider-{$slide->id} .gallery-thumbs', {$thumb_json});" .
			"var xoSlider{$slide->id} = new Swiper('#xo-slider-{$slide->id} .gallery-main', {{$json}, thumbs: {swiper: xoSlider{$slide->id}Thumbs}});";

		return $script;
	}
}
