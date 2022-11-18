<?php
/**
 * XO Slider Template.
 * 
 * @version 1.4.0
 * 
 * If you need to edit this file, copy this template.php and style.css files to the following directory
 * in the theme. The files in the theme take precedence.
 * 
 * Directory: "(Theme directory)/xo-liteslider/templates/(Template ID)/"
 */

class XO_Slider_Template_Video extends XO_Slider_Template_Base {
	/**
	 * Template ID.
	 *
	 * @var string
	 */
	public $id = 'video';

	/**
	 * Template name.
	 *
	 * @var string
	 */
	public $name = 'Video';

	/**
	 * Template version.
	 *
	 * @var string
	 */
	public $version = '1.4.0';

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
		return __( 'A template that displays a video.', 'xo-liteslider' );
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
		
		$html = "<div class=\"swiper swiper-container\"{$style}>\n";

		$html .= '<div class="swiper-wrapper">' . "\n";
		foreach ( $slide->slides as $slide_data ) {
			if ( empty( $slide_data['media_id'] ) && empty( $slide_data['media_link'] ) && empty( $slide->params['content'] )) {
				continue;
			}

			$mime_type_class = in_array( @$slide_data['media_type'], ['image', 'video', 'youtube'] ) ? " mime-type-{$slide_data['media_type']}" : '';
			$html .= "<div class=\"swiper-slide{$mime_type_class}\">";

			if ( 'image' === $slide_data['media_type'] ) {
				$attr = ['class' => 'slide-image'];
				if ( isset( $slide_data['alt'] ) ) {
					$attr['alt'] = $slide_data['alt'];
				}
				if ( isset( $slide_data['title_attr'] ) ) {
					$attr['title'] = $slide_data['title_attr'];
				}
				$img = wp_get_attachment_image( $slide_data['media_id'], 'full', false, $attr );
				if ( $img ) {
					$html .= '<div class="slide-image">';
					if ( ! empty( $slide_data['link'] ) ) {
						$target = ( ! empty( $slide_data['link_newwin'] ) && $slide_data['link_newwin'] ) ? ' target="_blank" rel="noopener noreferrer"' : '';
						$html .= '<a href="' . esc_url( $slide_data['link'] ) . '"' . $target . '>' . $img . '</a>';
					} else {
						$html .= $img;
					}
					$html .= '</div>';
				}
			} else if ( 'video' === $slide_data['media_type'] ) {
				$html .= $this->get_attachment_video( $slide_data );
			} else if ( 'youtube' === $slide_data['media_type'] ) {
				$html .= $this->get_embed_youtube( $slide_data );
			}

			if ( ! empty( $slide->params['content'] && 'youtube' !== $slide_data['media_type'] ) ) {
				$html .= '<div class="slide-content">' . wp_kses_post( $slide_data['content'] ) . '</div>';
			}

			$html .= "</div>\n"; // <!-- .swiper-slide -->
		}
		$html .= "</div>\n"; // <!-- .swiper-wrapper -->

		if ( @$slide->params['pagination'] ) {
			$html .= "<div class=\"swiper-pagination swiper-pagination-white\"></div>\n";
		}

		if ( @$slide->params['navigation'] ) {
			$html .= "<div class=\"swiper-button-prev swiper-button-white\"></div>\n";
			$html .= "<div class=\"swiper-button-next swiper-button-white\"></div>\n";
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
		if ( isset( $slide->params['navigation'] ) ) {
			$next = '.swiper-button-next';
			$prev = '.swiper-button-prev';
		} else {
			$next = null;
			$prev = null;
		}

		$params = [
			'pagination'     => ['el' => isset( $slide->params['pagination'] ) ? '.swiper-pagination' : null, 'clickable' => true],
			'navigation'     => ['nextEl' => $next, 'prevEl' => $prev],
			'scrollbar'      => ['hide' => true],
			'effect'         => in_array( @$slide->params['effect'], ['slide', 'fade', 'cube', 'coverflow', 'flip'] ) ? $slide->params['effect'] : 'slide',
			'speed'          => @$slide->params['speed'] ?: 600,
			'loop'           => @$slide->params['loop'],
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

		if ( ! empty( $slide->params['auto_height'] ) ) $params['autoHeight'] = $slide->params['auto_height'];
		if ( ! empty( $slide->params['slides_per_group'] ) ) $params['slidesPerGroup'] = $slide->params['slides_per_group'];
		if ( ! empty( $slide->params['slides_per_view'] ) ) $params['slidesPerView'] = $slide->params['slides_per_view'];
		if ( ! empty( $slide->params['space_between'] ) ) $params['spaceBetween'] = $slide->params['space_between'];

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
