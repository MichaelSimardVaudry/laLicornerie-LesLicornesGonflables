<?php
/**
 * XO Slider: administration interface class.
 *
 * @package XOSlider
 * @since 1.0.0
 */

class XO_Slider_Admin {
	private $parent;
	private $parameters;

	public function __construct( $parent ) {
		$this->parent = $parent;
		add_action( 'plugins_loaded', [$this, 'plugins_loaded'] );
	}

	public function plugins_loaded() {
		add_filter( 'post_updated_messages', [$this, 'updated_messages'] );
		add_filter( 'bulk_post_updated_messages', [$this, 'bulk_updated_messages'], 10, 2 );
		add_filter( 'post_row_actions', [$this, 'remove_row_actions'], 10, 2 );
		add_action( 'save_post', [$this, 'save_post'] );
		add_action( 'admin_menu', [$this, 'admin_menu'] );
		add_action( 'admin_init', [$this, 'admin_init'] );
		add_action( 'admin_enqueue_scripts', [$this, 'admin_enqueue_scripts'] );
		add_action( 'edit_form_after_title', [$this, 'edit_form_after_title'] );
	}

	public function admin_enqueue_scripts() {
		global $post, $post_type;

		if ( isset( $post ) && 'xo_liteslider' === $post_type ) {
			wp_enqueue_style( 'xo-slider-admin', plugins_url( 'css/admin.css', __DIR__ ) );

			// Load the script for the media uploader.
			wp_enqueue_media( [ 'post' => $post->ID ] );
			wp_enqueue_script( 'xo-slider-admin', plugins_url( 'js/admin.js', __DIR__ ), ['jquery'], null, true );
			wp_localize_script( 'xo-slider-admin', 'messages', [
				'title' => __( 'Select Media', 'xo-liteslider' ),
				'button' => __( 'Select', 'xo-liteslider' )
			] );
		}
	}

	public function updated_messages( $messages ) {
		global $post;
		$messages['xo_liteslider'] = [
			0 => '',
			1 => __( 'Slider updated.', 'xo-liteslider' ),
			2 => __( 'Custom field updated.', 'xo-liteslider' ),
			3 => __( 'Custom field deleted.', 'xo-liteslider' ),
			4 => __( 'Slider updated.', 'xo-liteslider' ),
			5 => isset( $_GET['revision'] ) ? sprintf( __( 'Slider restored to revision from %s.', 'xo-liteslider' ), wp_post_revision_title( (int)$_GET['revision'], false ) ) : false,
			6 => __( 'Slider published.', 'xo-liteslider' ),
			7 => __( 'Slider saved.', 'xo-liteslider' ),
			8 => __( 'Slider submitted.', 'xo-liteslider' ),
			9 => sprintf( __( 'Slider scheduled for: <strong>%1$s</strong>.', 'xo-liteslider' ), date_i18n( __( 'M j, Y @ G:i', 'xo-liteslider' ), strtotime( $post->post_date ) ) ),
			10 => __( 'Slider draft updated.', 'xo-liteslider' ),
		];
		return $messages;
	}

	public function bulk_updated_messages( $bulk_messages, $bulk_counts ) {
		$bulk_messages['xo_liteslider'] = [
			'updated' => _n( '%s slider updated.', '%s sliders updated.', $bulk_counts['updated'], 'xo-liteslider' ),
			'locked' => _n( '%s slidert not updated, somebody is editing it.', '%s slider not updated, somebody is editing them.', $bulk_counts['locked'], 'xo-liteslider' ),
			'deleted' => _n( '%s slidert permanently deleted.', '%s sliders permanently deleted.', $bulk_counts['deleted'], 'xo-liteslider' ),
			'trashed' => _n( '%s slider moved to the Trash.', '%s sliders moved to the Trash.', $bulk_counts['trashed'], 'xo-liteslider' ),
			'untrashed' => _n( '%s slider restored from the Trash.', '%s sliders restored from the Trash.', $bulk_counts['untrashed'], 'xo-liteslider' ),
		];
		return $bulk_messages;
	}

	public function remove_row_actions( $actions, $post ) {
		if ( $post->post_type != 'xo_liteslider' ) {
			return $actions;
		}
		unset( $actions['inline hide-if-no-js'] );
		return $actions;
	}

	public function save_post( $post_id ) {
		if ( ! isset( $_POST['xo_slider_nonce'] ) ||
			! check_admin_referer( 'xo_slider_key', 'xo_slider_nonce' ) ||
			! current_user_can( 'edit_post', $post_id )
		) {
			return $post_id;
		}

		if ( isset( $_POST['xo_slider_slides'] ) ) {
			$slides = $_POST['xo_slider_slides'];

			foreach ( $slides as $key => $value ) {
				$slides[$key]['media_type'] = $value['media_type'];
				if ( 'youtube' === $value['media_type'] ) {
					$slides[$key]['media_id'] = 0;
					$slides[$key]['media_link'] = esc_url_raw( $slides[$key]['media_link'] );
				} else {
					$slides[$key]['media_id'] = $slides[$key]['image_id'] = (int) @$value['media_id'];
					$slides[$key]['media_link'] = null;
				}
				$slides[$key]['title_attr'] = sanitize_text_field( $value['title_attr'] );
				$slides[$key]['alt'] = sanitize_text_field( $value['alt'] );
				$slides[$key]['link'] = esc_url_raw( $value['link'] );
				$slides[$key]['content'] = wp_filter_post_kses( $value['content'] );
				$slides[$key]['title'] = wp_filter_post_kses( $value['title'] );
				$slides[$key]['subtitle'] = wp_filter_post_kses( $value['subtitle'] );
				$slides[$key]['button_text'] = wp_filter_post_kses( $value['button_text'] );
				$slides[$key]['button_link'] = esc_url_raw( $value['button_link'] );
				$slides[$key]['video_autoplay'] = isset( $value['video_autoplay'] );
				$slides[$key]['video_loop'] = isset( $value['video_loop'] );
				$slides[$key]['video_muted'] = isset( $value['video_muted'] );
				$slides[$key]['video_controls'] = isset( $value['video_controls'] );
				$slides[$key]['video_inline'] = isset( $value['video_inline'] );
			}

			update_post_meta( $post_id, 'slides', $slides );
		}

		if ( isset( $_POST['xo_slider_parameters'] ) ) {
			$params = $_POST['xo_slider_parameters'];

			$params['width'] = (int) @$params['width'];
			$params['height'] = (int) @$params['height'];
			$params['navigation'] = isset( $params['navigation'] );
			$params['pagination'] = isset( $params['pagination'] );
			$params['content'] = isset( $params['content'] );
			$params['sort'] = isset( $params['sort'] ) ? $params['sort'] : 'asc';
			$params['loop'] = isset( $params['loop'] );
			$params['speed'] = (int) @$params['speed'];
			$params['auto_height'] = isset( $params['auto_height'] );
			$params['slides_per_group'] = (float) @$params['slides_per_group'];
			$params['slides_per_view'] = (float) @$params['slides_per_view'];
			$params['space_between'] = (int) @$params['space_between'];
			$params['centered_slides'] = isset( $params['centered_slides'] );

			$params['autoplay'] = isset( $params['autoplay'] );
			$params['delay'] = (int) @$params['delay'];
			$params['stop_on_last_slide'] = isset( $params['stop_on_last_slide'] );
			$params['disable_on_interaction'] = isset( $params['disable_on_interaction'] );

			$params['thumbs_per_view'] = (int) @$params['thumbs_per_view'];
			$params['thumbs_space_between'] = (int) @$params['thumbs_space_between'];

			update_post_meta( $post_id, 'parameters', $params );
		}
	}

	public function admin_menu() {
		$page = add_submenu_page( 'edit.php?post_type=xo_liteslider', 'Option Settings', __( 'Settings', 'xo-liteslider' ), 'manage_options', 'xo-liteslider-settings', [$this, 'settings_page'] );
		add_action( "load-{$page}", [$this, 'add_settings_page_tabs'] );
	}

	/**
	 * Add a help tab to the contextual help for the screen.
	 *
	 * @since 3.2.0
	 */
	function add_settings_page_tabs() {
		$screen = get_current_screen();
		$screen->add_help_tab( [
			'id' => 'settings-help',
			'title' => __( 'Overview', 'xo-liteslider' ),
			'content' =>
				'<p>' . __( 'This screen allows you to configure the XO Slider.', 'xo-liteslider' ). '</p>'
		] );
		$screen->add_help_tab( [
			'id' => 'general-config',
			'title' => __( 'CSS location', 'xo-liteslider' ),
			'content' =>
				'<p>' . __( 'CSS location specifies where to place the CSS for the template and slider. Placement in header means that all template styles will be incorporated into the header of all pages. Header placement means that the styles of all templates will be incorporated into the header of all pages.', 'xo-liteslider' ) . '</p>'
		] );
	}

	/**
	 * Output the settings page.
	 *
	 * @since 3.2.0
	 */
	public function settings_page() {
		echo '<div class="wrap">';
		echo '<h1>' . __( 'XO Slider Settings', 'xo-liteslider' ) . '</h1>';
		echo '<form method="post" action="options.php">';
		settings_fields( 'xo_slider_group' );
		do_settings_sections( 'xo_slider_group' );
		submit_button();
		echo '</form>';
		echo '</div>';
	}

	public function admin_init() {
		// Slider edit page.
		remove_meta_box( 'submitdiv', 'xo_liteslider', 'core' );
		add_meta_box( 'xo-slider-meta-slide', __( 'Slides', 'xo-liteslider'), [$this, 'display_meta'], 'xo_liteslider', 'normal', 'high' );
		add_meta_box( 'xo-slider-meta-template', __( 'Template', 'xo-liteslider' ), [$this, 'display_meta_template'], 'xo_liteslider', 'side', 'low' );
		add_meta_box( 'xo-slider-meta-parameter', __( 'Parameter', 'xo-liteslider' ), [$this, 'display_meta_parameter'], 'xo_liteslider', 'side', 'low' );
		add_meta_box( 'xo-slider-meta-usage', __( 'Usage', 'xo-liteslider' ), [$this, 'display_meta_usage'], 'xo_liteslider', 'side', 'low' );
		add_meta_box( 'submitdiv', __( 'Save', 'xo-liteslider' ), [$this, 'submit_meta_box'], 'xo_liteslider', 'side', 'high', null );

		// Settings page.
		register_setting( 'xo_slider_group', 'xo_slider_options', [$this, 'sanitize_settings'] );
		add_settings_section( 'xo_slider_general_section', '', '__return_empty_string', 'xo_slider_group' );
		add_settings_field( 'css_load', __( 'CSS location', 'xo-liteslider' ), [$this, 'field_css_load'], 'xo_slider_group', 'xo_slider_general_section' );
	}

	/**
	 * Sanitize settings.
	 *
	 * @since 3.2.0
	 */
	function sanitize_settings( $input ) {
		return $input;
	}

	/**
	 * Register CSS load field.
	 *
	 * @since 3.2.0
	 */
	function field_css_load() {
		$value = ! empty( $this->parent->options['css_load'] ) ? $this->parent->options['css_load'] : 'body';
		echo
			'<fieldset><legend class="screen-reader-text"><span>' . __( 'CSS location', 'xo-liteslider' ) . '</span></legend>' .
			'<p>' .
			'<label><input name="xo_slider_options[css_load]" type="radio" value="none" ' . checked( 'none', $value, false ) . '> ' . __( 'Do not include', 'xo-liteslider' ) . '</label><br>' .
			'<label><input name="xo_slider_options[css_load]" type="radio" value="head" ' . checked( 'head', $value, false ) . '> ' . __( 'Place in header', 'xo-liteslider' ) . '</label><br>' .
			'<label><input name="xo_slider_options[css_load]" type="radio" value="body" ' . checked( 'body', $value, false ) . '> ' . __( 'Place in footer', 'xo-liteslider' ) . '</label>' .
			'</p>' .
			'<p class="description">' . __( 'Typically, you should choose to place it in the footer.', 'xo-liteslider' ) . '</p>' .
			'</fieldset>';
	}

	public function submit_meta_box( $post, $args = array() ) {
		echo '<div class="submitbox" id="submitpost">';
		echo '<div id="major-publishing-actions" style="border-top: 0;">';

		echo '<div style="display:none;">' . get_submit_button( __( 'Save' ), 'button', 'save' ) . '</div>';

		do_action( 'post_submitbox_start' );

		echo '<div id="delete-action">';
		if ( current_user_can( 'delete_post', $post->ID ) ) {
			if ( !EMPTY_TRASH_DAYS ) {
				$delete_text = __( 'Delete Permanently' );
			} else {
				$delete_text = __( 'Move to Trash' );
			}
			echo '<a class="submitdelete deletion" href="' . esc_url( get_delete_post_link( $post->ID ) ) . '">' . $delete_text . '</a>';
		}
		echo '</div>';

		echo '<div id="publishing-action">';
		echo '<span class="spinner"></span>';
		if ( ! in_array( $post->post_status, array( ' publish', 'future', 'private' ) ) || 0 == $post->ID ) {
			echo '<input name="original_publish" type="hidden" id="original_publish" value="' . esc_attr__( 'Publish' ) . '" />';
			submit_button( __( 'Save' ), 'primary button-large', 'publish', false );
		} else {
			echo '<input name="original_publish" type="hidden" id="original_publish" value="' . esc_attr__( 'Update' ) . '" />';
			echo '<input name="save" type="submit" class="button button-primary button-large" id="publish" value="' . esc_attr__( 'Update' ) . '" />';
		}
		echo '</div>';
		echo '<div class="clear"></div>';

		echo '</div>';
		echo '</div>';
	}

	public function edit_form_after_title ( $post ) {
		if ( $post->post_type !== 'xo_liteslider' || $post->post_status === 'auto-draft' ) {
			return;
		}
		?>
		<p class="description">
			<label for="xo-slider-shortcode"><?php _e( 'Copy this shortcode, please paste it into the post or page:', 'xo-liteslider' ); ?></label>
			<span class="shortcode wp-ui-primary">
			<input id="xo-slider-shortcode" onfocus="this.select();" readonly="readonly" class="large-text code" value="[xo_slider id=&quot;<?php echo esc_attr( $post->ID ); ?>&quot;]" type="text">
			</span>
		</p>
		<?php
	}

	public function display_meta( $post ) {
		$slides = get_post_meta( $post->ID, 'slides', true );
		if ( empty( $slides ) ) {
			$slides = [ [
				'media_type'     => '',
				'media_id'       => 0,
				'media_link'     => '',
				'title_attr'     => '',
				'alt'            => '',
				'link'           => '',
				'link_newwin'    => false,
				'content'        => '',
				'title'          => '',
				'subtitle'       => '',
				'button_text'    => '',
				'button_link'    => '',
				'button_newwin'  => false,
				'video_autoplay' => true,
				'video_loop'     => true,
				'video_muted'    => true,
				'video_controls' => false,
				'video_inline'   => true,
				'video_preload'  => 'metadata',
			] ];
		}

		echo '<div id="xo-slider-slide">';
		echo '<p class="howto">' . __( 'Drag the header of each item to change the order.', 'xo-liteslider' ) . '</p>';
		echo '<ul class="slide-repeat ui-sortable">';
		$counter = 0;
		foreach ( $slides as $key => $value ) {
			$media_link = ! empty( $value['media_link'] ) ? $value['media_link'] : null;
			if ( ! isset( $value['media_id'] ) && isset( $value['image_id'] ) ) {
				$media_id = $value['image_id'];
				$media_type = 'image';
			} else {
				$media_type = ! empty( $value['media_type'] ) ? $value['media_type'] : 'image';
				$media_id = (int) @$value['media_id'];
			}

			$link_newwin = ! empty( $value['link_newwin'] ) ? $value['link_newwin'] : false;

			$video_autoplay = ! empty( $value['video_autoplay'] ) ? $value['video_autoplay'] : false;
			$video_loop = ! empty( $value['video_loop'] ) ? $value['video_loop'] : false;
			$video_muted = ! empty( $value['video_muted'] ) ? $value['video_muted'] : false;
			$video_controls = ! empty( $value['video_controls'] ) ? $value['video_controls'] : false;
			$video_inline = ! empty( $value['video_inline'] ) ? $value['video_inline'] : false;
			$video_preload = ! empty( $value['video_preload'] ) ? $value['video_preload'] : 'metadata';

			$button_newwin = ! empty( $value['button_newwin'] ) ? $value['button_newwin'] : false;

			$image_src = false;
			if ( 'youtube' === $media_type ) {
				if ( 1 === preg_match( '/[\/?=]([a-zA-Z0-9_\-]{11})[&\?]?/', $media_link, $matches ) ) {
					$image_src = 'http://img.youtube.com/vi/' . $matches[1] . '/default.jpg';
				}
			} else {
				if ( ! empty( $media_id ) ) {
					$image_src = wp_get_attachment_image_src( $media_id, array( 150, 150 ), true )[0];
				}
			}

			echo '<li class="slide">';

			echo '<div class="slide-header">';
			echo '<span class="slide-header-title"></span>';
			echo '<span class="slide-header-button slide-header-append-button dashicons dashicons-plus-alt" title="' . esc_attr( __( 'Add Slide', 'xo-liteslider' ) ) . '"></span>';
			echo '<span class="slide-header-button slide-header-remove-button dashicons dashicons-trash" title="' . esc_attr( __( 'Delete Slide', 'xo-liteslider' ) ) . '"></span>';
			echo '<span class="slide-header-button slide-header-toggle-button dashicons dashicons-arrow-up"></span>';
			echo '</div>';

			echo '<div class="slide-inner">';

			echo '<table class="slide-table"><tbody>';
			echo '<tr>';
			echo '<td style="width: 160px;">';
			echo '<div class="slide-image" title="' . esc_attr( __( 'Select Media', 'xo-liteslider' ) ) . '">';
			if ( $image_src ) {
				echo '<img loading="lazy" src="' . esc_url( $image_src ) . '" alt="" title="' . esc_attr( __( 'Select Media', 'xo-liteslider' ) ) . '" />';
				if ( 'video' === $media_type ) {
					$filename =  basename( get_attached_file( $media_id ) );
					echo '<div class="filename"><div>' . esc_html( $filename ) .'</div></div>';
				} else if ( 'youtube' === $media_type ) {
					echo '<div class="filename"><div>' . esc_html( $media_link ) .'</div></div>';
				}
				echo '<div class="message" style="display: none;"><span>' . __( 'Select Media', 'xo-liteslider' ) . '</span></div>';
			} else {
				echo '<div class="message"><span>' . __( 'Select Media', 'xo-liteslider' ) . '</span></div>';
			}

			echo '</div>';
			echo '<input class="slide-media-type" name="xo_slider_slides[' . $counter . '][media_type]" type="hidden" value="' . esc_attr( $media_type ) . '" />';
			echo '<input class="slide-media-id" name="xo_slider_slides[' . $counter . '][media_id]" type="hidden" value="' . esc_attr( $media_id ) . '" />';
			echo '<input class="slide-media-link" name="xo_slider_slides[' . $counter . '][media_link]" type="hidden" value="' . esc_attr( $media_link ) . '" />';
			echo '<span class="slide-image-button slide-image-clear" title="' . esc_attr( __( 'Clear Media', 'xo-liteslider' ) ) . '"></span>';
			echo '</td>';
			echo '<td>';

			echo '<div class="slide-panel-wrapper">';

			echo '<ul class="slide-panel-tabs">';
			echo '<li class="tabs"><a class="nav-tab-link" data-type="slide-panel-general" href="#">' . __( 'Image', 'xo-liteslider' ) . '</a></li>';
			echo '<li><a class="nav-tab-link" data-type="slide-panel-content" href="#">' . __( 'Content', 'xo-liteslider' ) . '</a></li>';
			echo '<li><a class="nav-tab-link" data-type="slide-panel-option" href="#">' . __( 'Option', 'xo-liteslider' ) . '</a></li>';
			echo '<li><a class="nav-tab-link" data-type="slide-panel-video" href="#">' . __( 'Video', 'xo-liteslider' ) . '</a></li>';
			echo '</ul>';

			echo '<div class="slide-panel tabs-slide-panel-general tabs-panel-active">';
			echo '<p><label for="xo_slider_slides[' . $counter . '][title_attr]">' . __( 'Title Attribute:', 'xo-liteslider' ) . '</label></p>' .
				'<p><input id="xo_slider_slides[' . $counter . '][title_attr]" name="xo_slider_slides[' . $counter . '][title_attr]" type="text" value="' . esc_attr( @$value['title_attr'] ) . '" /></p>';
			echo '<p><label for="xo_slider_slides[' . $counter . '][alt]">' . __( 'Alt text (alternative text):', 'xo-liteslider' ) . '</label></p>' .
				'<p><input id="xo_slider_slides[' . $counter . '][alt]" name="xo_slider_slides[' . $counter . '][alt]" type="text" value="' . esc_attr( @$value['alt'] ) . '" /></p>';
			echo '<p><label for="xo_slider_slides[' . $counter . '][link]">' . __( 'Link (URL):', 'xo-liteslider' ) . '</label>' .
				'<span style="float: right;"><label for="xo_slider_slides[' . $counter . '][link_newwin]">' . __( 'Open in new window:', 'xo-liteslider' ) . '</label> ' .
				'<input id="xo_slider_slides[' . $counter . '][link_newwin]" name="xo_slider_slides[' . $counter . '][link_newwin]" type="checkbox" value="1" ' . checked( $link_newwin, true, false ) .'/><label for="xo_slider_slides[' . $counter . '][link_newwin]"></label></span></p>' .
				'<p><input id="xo_slider_slides[' . $counter . '][link]" name="xo_slider_slides[' . $counter . '][link]" type="text" value="' . esc_attr( @$value['link'] ) . '" /></p>';
			echo '</div>';

			echo '<div class="slide-panel tabs-slide-panel-content tabs-panel-inactive">';
			echo '<p><label for="xo_slider_slides[' . $counter . '][content]">' . __( 'Content (HTML):', 'xo-liteslider' ) . '</label></p>' . 
				'<textarea id="xo_slider_slides[' . $counter . '][content]" name="xo_slider_slides[' . $counter . '][content]" rows="8">' . esc_attr( @$value['content'] ) . '</textarea></p>';
			echo '</div>';

			echo '<div class="slide-panel tabs-slide-panel-option tabs-panel-inactive">';
			echo '<p><label for="xo_slider_slides[' . $counter . '][title]">' . __( 'Title:', 'xo-liteslider' ) . '</label></p>' .
				'<p><input id="xo_slider_slides[' . $counter . '][title]" name="xo_slider_slides[' . $counter . '][title]" type="text" value="' . esc_attr( @$value['title'] ) . '" /></p>';
			echo '<p><label for="xo_slider_slides[' . $counter . '][subtitle]">' . __( 'Subtitle:', 'xo-liteslider' ) . '</label></p>' .
				'<p><input id="xo_slider_slides[' . $counter . '][subtitle]" name="xo_slider_slides[' . $counter . '][subtitle]" type="text" value="' . esc_attr( @$value['subtitle'] ) . '" /></p>';
			echo '<p><label for="xo_slider_slides[' . $counter . '][button_text]">' . __( 'Button text:', 'xo-liteslider' ) . '</label></p>' .
				'<p><input id="xo_slider_slides[' . $counter . '][button_text]" name="xo_slider_slides[' . $counter . '][button_text]" type="text" value="' . esc_attr( @$value['button_text'] ) . '" /></p>';
			echo '<p><label for="xo_slider_slides[' . $counter . '][button_link]">' . __( 'Button link (URL):', 'xo-liteslider' ) . '</label>' .
				'<span style="float: right;"><label for="xo_slider_slides[' . $counter . '][button_newwin]">' . __( 'Open in new window:', 'xo-liteslider' ) . '</label> ' .
				'<input id="xo_slider_slides[' . $counter . '][button_newwin]" name="xo_slider_slides[' . $counter . '][button_newwin]" type="checkbox" value="1" ' . checked( $button_newwin, true, false ) .'/><label for="xo_slider_slides[' . $counter . '][button_newwin]"></label></span></p>' .
				'<p><input id="xo_slider_slides[' . $counter . '][button_link]" name="xo_slider_slides[' . $counter . '][button_link]" type="text" value="' . esc_attr( @$value['button_link'] ) . '" /></p>';
			echo '</div>';

			echo '<div class="slide-panel tabs-slide-panel-video tabs-panel-inactive">';
			echo '<table class="table-video"><tbody>';
			echo '<tr><th><label for="xo_slider_slides[' . $counter . '][video_autoplay]">' . __( 'Autoplay:', 'xo-liteslider' ) . '</label></th>';
			echo '<td><input id="xo_slider_slides[' . $counter . '][video_autoplay]" name="xo_slider_slides[' . $counter . '][video_autoplay]" type="checkbox" value="1" ' . checked( $video_autoplay, true, false ) .'/><label for="xo_slider_slides[' . $counter . '][video_autoplay]"></label></td></tr>';
			echo '<tr><th><label for="xo_slider_slides[' . $counter . '][video_loop]">' . __( 'Loop:', 'xo-liteslider' ) . '</label></th>';
			echo '<td><input id="xo_slider_slides[' . $counter . '][video_loop]" name="xo_slider_slides[' . $counter . '][video_loop]" type="checkbox" value="1" ' . checked( $video_loop, true, false ) .'/><label for="xo_slider_slides[' . $counter . '][video_loop]"></label></td></tr>';
			echo '<tr><th><label for="xo_slider_slides[' . $counter . '][video_muted]">' . __( 'Muted:', 'xo-liteslider' ) . '</label></th>';
			echo '<td><input id="xo_slider_slides[' . $counter . '][video_muted]" name="xo_slider_slides[' . $counter . '][video_muted]" type="checkbox" value="1" ' . checked( $video_muted, true, false ) .'/><label for="xo_slider_slides[' . $counter . '][video_muted]"></label></td></tr>';
			echo '<tr><th><label for="xo_slider_slides[' . $counter . '][video_controls]">' . __( 'Playback controls:', 'xo-liteslider' ) . '</label></th>';
			echo '<td><input id="xo_slider_slides[' . $counter . '][video_controls]" name="xo_slider_slides[' . $counter . '][video_controls]" type="checkbox" value="1" ' . checked( $video_controls, true, false ) .'/><label for="xo_slider_slides[' . $counter . '][video_controls]"></label></td></tr>';
			echo '<tr><th><label for="xo_slider_slides[' . $counter . '][video_inline]">' . __( 'Play inline:', 'xo-liteslider' ) . '</label></th>';
			echo '<td><input id="xo_slider_slides[' . $counter . '][video_inline]" name="xo_slider_slides[' . $counter . '][video_inline]" type="checkbox" value="1" ' . checked( $video_inline, true, false ) .'/><label for="xo_slider_slides[' . $counter . '][video_inline]"></label></td></tr>';
			echo '<tr><th><label for="xo_slider_slides[' . $counter . '][video_preload]">' . __( 'Preload:', 'xo-liteslider' ) . '</label></th><td>';
			echo '<select id="xo_slider_slides[' . $counter . '][video_preload]" name="xo_slider_slides[' . $counter . '][video_preload]">';
			echo '<option value="auto"'. ( 'auto' === $video_preload ? ' selected' : '' ) . '>' . __( 'Auto', 'xo-liteslider' ) . '</option>';
			echo '<option value="metadata"'. ( 'metadata' === $video_preload ? ' selected' : '' ) . '>' . __( 'Metadata', 'xo-liteslider' ) . '</option>';
			echo '<option value="none"'. ( 'none' === $video_preload ? ' selected' : '' ) . '>' . __( 'None', 'xo-liteslider' ) . '</option>';
			echo '</select>';
			echo '</td></tr>';

			echo '</tbody></table>';
			echo '</div>';

			echo '</div>'; // <!-- .slide-panel-wrapper -->

			echo '</td>';
			echo '</tr>';
			echo '</tbody></table>';

			echo '</div>'; // <!-- .slide-inner -->

			echo '</li>';

			$counter++;
		}
		echo '</ul>';
		echo '</div>' . "\n";

		wp_nonce_field( 'xo_slider_key', 'xo_slider_nonce' );

		// Countermeasure against the problem that the width of the date select control becomes narrow
		echo '<style type="text/css">.media-frame select.attachment-filters { min-width: 102px; }</style>';	
	}

	/**
	 * Get the slider parameters.
	 *
	 * @since 2.0.0
	 *
	 * @return array Array of slider parameters.
	 */
	private function get_parameters() {
		if ( empty( $this->parameters ) ) {
			$this->parameters = get_post_meta( get_the_ID(), 'parameters', true );
			if ( empty( $this->parameters ) ) {
				$this->parameters = [
					'template' => XO_Slider::DEFAULT_TEMPLATE_SLUG,
					'effect' => 'slide',
					'navigation' => true,
					'pagination' => true,
					'content' => true,
					'sort' => 'asc',
					'loop' => true,
					'speed' => 600,
					'auto_height' => false,
					'slides_per_group' => 0,
					'slides_per_view' => 0,
					'space_between' => 0,
					'centered_slides' => false,
					'autoplay' => true,
					'delay' => 3000,
					'stop_on_last_slide' => false,
					'disable_on_interaction' => true,
					'thumbs_per_view' => 0,
					'thumbs_space_between' => 0,
					'width' => null,
					'height' => null,
				];
			}
		}
		return $this->parameters;
	}

	public function display_meta_parameter() {
		$params = $this->get_parameters();

		$template = @$params['template'];
		$width = @$params['width'] ?: '';
		$height = @$params['height'] ?: '';
		$effect = @$params['effect'];
		$navigation = @$params['navigation'];
		$pagination = @$params['pagination'];
		$content = @$params['content'];
		$sort = @$params['sort'];
		$loop = @$params['loop'];
		$speed = @$params['speed'];
		$auto_height = @$params['auto_height'];
		$slides_per_group = @$params['slides_per_group'] ?: '';
		$slides_per_view = @$params['slides_per_view'] ?: '';
		$space_between = @$params['space_between'] ?: '';
		$centered_slides = @$params['centered_slides'];
		$autoplay = @$params['autoplay'];
		$delay = @$params['delay'];
		$stop_on_last_slide = @$params['stop_on_last_slide'];
		$disable_on_interaction = @$params['disable_on_interaction'];
		$thumbs_per_view = @$params['thumbs_per_view'] ?: '';
		$thumbs_space_between = @$params['thumbs_space_between'] ?: '';

		echo '<div id="xo-slider-parameter">';

		echo '<div class="parameter-panel-wrapper">';

		echo '<ul class="parameter-panel-tabs">';
		echo '<li class="tabs"><a class="nav-tab-link" data-type="parameter-panel-basic" href="#">' . __( 'Basic', 'xo-liteslider' ) . '</a></li>';
		echo '<li><a class="nav-tab-link" data-type="parameter-panel-autoplay" href="#">' . __( 'Autoplay', 'xo-liteslider' ) . '</a></li>';
		echo '<li><a class="nav-tab-link" data-type="parameter-panel-thumbnail" href="#">' . __( 'Thumbnail', 'xo-liteslider' ) . '</a></li>';
		echo '</ul>';

		echo '<div class="parameter-panel tabs-parameter-panel-basic tabs-panel-active">';
		echo '<table class="table-parameter"><tbody>';

		echo '<tr><th><label for="xo_slider_parameters[width]">' . __( 'Width:', 'xo-liteslider' ) . '</label></th>';
		echo '<td><input id="xo_slider_parameters[width]" name="xo_slider_parameters[width]" type="number" value="' . esc_attr( $width ) . '" class="small-text" min="0" step="1" /> px</td></tr>';
		echo '<tr><th><label for="xo_slider_parameters[height]">' . __( 'Height:', 'xo-liteslider' ) . '</label></th>';
		echo '<td><input id="xo_slider_parameters[height]" name="xo_slider_parameters[height]" type="number" value="' . esc_attr( $height ) . '" class="small-text" min="0" step="1" /> px</td></tr>';
		echo '<tr><th><label for="xo_slider_parameters[effect]">' . __( 'Effect:', 'xo-liteslider' ) . '</label></th><td>';
		echo '<select id="xo_slider_parameters[effect]" name="xo_slider_parameters[effect]">';
		echo '<option value="slide"'. ( 'slide' === $effect ? ' selected' : '' ) . '>Slide</option>';
		echo '<option value="fade"'. ( 'fade' === $effect ? ' selected' : '' ) . '>Fade</option>';
		echo '<option value="cube"'. ( 'cube' === $effect ? ' selected' : '' ) . '>Cube</option>';
		echo '<option value="coverflow"'. ( 'coverflow' === $effect ? ' selected' : '' ) . '>Coverflow</option>';
		echo '<option value="flip"'. ( 'flip' === $effect ? ' selected' : '' ) . '>Flip</option>';
		echo '</select>';
		echo '</td></tr>';
		echo '<tr><th><label for="xo_slider_parameters[navigation]">' . __( 'Navigation:', 'xo-liteslider' ) . '</label></th>';
		echo '<td><input id="xo_slider_parameters[navigation]" name="xo_slider_parameters[navigation]" type="checkbox" value="1" ' . checked( $navigation, true, false ) .'/><label for="xo_slider_parameters[navigation]"></label></td></tr>';
		echo '<tr><th><label for="xo_slider_parameters[pagination]">' . __( 'Pagination:', 'xo-liteslider' ) . '</label></th>';
		echo '<td><input id="xo_slider_parameters[pagination]" name="xo_slider_parameters[pagination]" type="checkbox" value="1" ' . checked( $pagination, true, false ) .'/><label for="xo_slider_parameters[pagination]"></label></td></tr>';
		echo '<tr><th><label for="xo_slider_parameters[content]">' . __( 'Content:', 'xo-liteslider' ) . '</label></th>';
		echo '<td><input id="xo_slider_parameters[content]" name="xo_slider_parameters[content]" type="checkbox" value="1" ' . checked( $content, true, false ) .'/><label for="xo_slider_parameters[content]"></label></td></tr>';
		echo '<tr><th><label for="xo_slider_parameters[sort]">' . __( 'Order:', 'xo-liteslider' ) . '</label></th><td>';
		echo '<select id="xo_slider_parameters[sort]" name="xo_slider_parameters[sort]">';
		echo '<option value="asc"'. ( $sort == 'asc' ? ' selected' : '' ) . '>' . __( 'Ascending order', 'xo-liteslider' ) . '</option>';
		echo '<option value="desc"'. ( $sort == 'desc' ? ' selected' : '' ) . '>' . __( 'Descending order', 'xo-liteslider' ) . '</option>';
		echo '<option value="random"'. ( $sort == 'random' ? ' selected' : '' ) . '>' . __( 'Random', 'xo-liteslider' ) . '</option>';
		echo '</select>';
		echo '</td></tr>';
		echo '<tr><th><label for="xo_slider_parameters[loop]">' . __( 'Loop:', 'xo-liteslider' ) . '</label></th>';
		echo '<td><input id="xo_slider_parameters[loop]" name="xo_slider_parameters[loop]" type="checkbox" value="1" ' . checked( $loop, true, false ) .'/><label for="xo_slider_parameters[loop]"></label></td></tr>';
		echo '<tr><th><label for="xo_slider_parameters[speed]">' . __( 'Effect speed:', 'xo-liteslider' ) . '</label></th>';
		echo '<td><input id="xo_slider_parameters[speed]" name="xo_slider_parameters[speed]" type="number" value="' . esc_attr( $speed ) . '" class="small-text" min="0" step="100" /> ' . __( 'ms', 'xo-liteslider' ) . '</td></tr>';
		echo '<tr><th><label for="xo_slider_parameters[auto_height]">' . __( 'Auto height:', 'xo-liteslider' ) . '</label></th>';
		echo '<td><input id="xo_slider_parameters[auto_height]" name="xo_slider_parameters[auto_height]" type="checkbox" value="1" ' . checked( $auto_height, true, false ) .'/><label for="xo_slider_parameters[auto_height]"></label></td></tr>';
		echo '<tr><th><label for="xo_slider_parameters[slides_per_group]">' . __( 'Group unit:', 'xo-liteslider' ) . '</label></th>';
		echo '<td><input id="xo_slider_parameters[slides_per_group]" name="xo_slider_parameters[slides_per_group]" type="number" value="' . esc_attr( $slides_per_group ) . '" class="small-text" min="0" step="0.01" /></td></tr>';
		echo '<tr><th><label for="xo_slider_parameters[slides_per_view]">' . __( 'View unit:', 'xo-liteslider' ) . '</label></th>';
		echo '<td><input id="xo_slider_parameters[slides_per_view]" name="xo_slider_parameters[slides_per_view]" type="number" value="' . esc_attr( $slides_per_view ) . '" class="small-text" min="0" step="0.01" /></td></tr>';
		echo '<tr><th><label for="xo_slider_parameters[space_between]">' . __( 'Space between:', 'xo-liteslider' ) . '</label></th>';
		echo '<td><input id="xo_slider_parameters[space_between]" name="xo_slider_parameters[space_between]" type="number" value="' . esc_attr( $space_between ) . '" class="small-text" min="0" step="1" /> px</td></tr>';
		echo '<tr><th><label for="xo_slider_parameters[centered_slides]">' . __( 'Centered Slides:', 'xo-liteslider' ) . '</label></th>';
		echo '<td><input id="xo_slider_parameters[centered_slides]" name="xo_slider_parameters[centered_slides]" type="checkbox" value="1" ' . checked( $centered_slides, true, false ) .'/><label for="xo_slider_parameters[centered_slides]"></label></td></tr>';

		echo '</tbody></table>';
		echo '<p class="howto">' . __( 'Width and height are optional. Some parameters may not be reflected in some templates.', 'xo-liteslider' ) . '</p>';
		echo '</div>'; // <!-- tabs-parameter-panel-basic -->

		echo '<div class="parameter-panel tabs-parameter-panel-autoplay tabs-panel-inactive">';
		echo '<table class="table-parameter"><tbody>';

		echo '<tr><th><label for="xo_slider_parameters[autoplay]">' . __( 'Autoplay:', 'xo-liteslider' ) . '</label></th>';
		echo '<td><input id="xo_slider_parameters[autoplay]" name="xo_slider_parameters[autoplay]" type="checkbox" value="1" ' . checked( $autoplay, true, false ) .'/><label for="xo_slider_parameters[autoplay]"></label></td></tr>';
		echo '<tr><th><label for="xo_slider_parameters[delay]">' . __( 'Delay:', 'xo-liteslider' ) . '</label></th>';
		echo '<td><input id="xo_slider_parameters[delay]" name="xo_slider_parameters[delay]" type="number" value="' . esc_attr( $delay ) . '" class="small-text" min="0" step="100" /> ' . __( 'ms', 'xo-liteslider' ) . '</td></tr>';

		echo '<tr><th><label for="xo_slider_parameters[stop_on_last_slide]">' . __( 'Stop on last slide:', 'xo-liteslider' ) . '</label></th>';
		echo '<td><input id="xo_slider_parameters[stop_on_last_slide]" name="xo_slider_parameters[stop_on_last_slide]" type="checkbox" value="1" ' . checked( $stop_on_last_slide, true, false ) .'/><label for="xo_slider_parameters[stop_on_last_slide]"></label></td></tr>';
		echo '<tr><th><label for="xo_slider_parameters[disable_on_interaction]">' . __( 'Disable on interaction:', 'xo-liteslider' ) . '</label></th>';
		echo '<td><input id="xo_slider_parameters[disable_on_interaction]" name="xo_slider_parameters[disable_on_interaction]" type="checkbox" value="1" ' . checked( $disable_on_interaction, true, false ) .'/><label for="xo_slider_parameters[disable_on_interaction]"></label></td></tr>';

		echo '</tbody></table>';
		echo '</div>'; // <!-- tabs-parameter-panel-basic -->

		echo '<div class="parameter-panel tabs-parameter-panel-thumbnail tabs-panel-inactive">';
		echo '<table class="table-parameter"><tbody>';

		echo '<tr><th><label for="xo_slider_parameters[thumbs_per_view]">' . __( 'View unit:', 'xo-liteslider' ) . '</label></th>';
		echo '<td><input id="xo_slider_parameters[thumbs_per_view]" name="xo_slider_parameters[thumbs_per_view]" type="number" value="' . esc_attr( $thumbs_per_view ) . '" class="small-text" min="0" step="1" /></td></tr>';
		echo '<tr><th><label for="xo_slider_parameters[thumbs_space_between]">' . __( 'Space between:', 'xo-liteslider' ) . '</label></th>';
		echo '<td><input id="xo_slider_parameters[thumbs_space_between]" name="xo_slider_parameters[thumbs_space_between]" type="number" value="' . esc_attr( $thumbs_space_between ) . '" class="small-text" min="0" step="1" /> px</td></tr>';

		echo '</tbody></table>';
		echo '</div>'; // <!-- tabs-parameter-panel-thumbnail -->

		echo '</div>'; // <!-- parameter-panel-wrapper -->
		echo '</div>' . "\n";
	}

	public function display_meta_template() {
		$params = $this->get_parameters();

		if ( 0 === count( $this->parent->templates ) ) {
			echo '<p class="howto">' . __( 'Template not found.', 'xo-liteslider' ) . '</p>';
			return;
		}

		$template_id = @$params['template'] ?: 'default';

		echo '<div id="xo-slider-template">';

		echo '<table class="table-template"><tbody>';
		echo '<tr><th><label for="template-select">' . __( 'Template:', 'xo-liteslider' ) . '</label></th><td>';
		echo '<select id="template-select" name="xo_slider_parameters[template]">';
		foreach ( $this->parent->templates as $template ) {
			echo '<option value="' . esc_attr( $template->id ) . '"'. ( $template->id == $template_id ? ' selected' : '' ) . '>' . esc_html( $template->name ) . '</option>';
		}
		echo '</select>';
		echo '</td></tr>';
		echo '</tbody></table>';

		foreach ( $this->parent->templates as $template ) {
			echo '<div class="template-description template-description-' . $template->id . ( $template->id == $template_id ? ' active' : ' inactive' ) . '">';
			if ( $url = $template->get_screenshot() ) {
				echo '<p class="template-image"><img loading="lazy" src="' . esc_url( $url ) . '" class="" alt=""></p>';
			}
			echo '<p class="howto">' . esc_html( $template->get_description() ) . '</p>';
			echo '</div>';
		}

		echo '</div>' . "\n";
	}

	public function display_meta_usage( $post ) {
		echo '<div id="xo-slider-usage">';
		echo '<p><label>' . __( 'Shortcode:', 'xo-liteslider' );
		echo '<input id="xo-slider-usage-shortcode" onfocus="this.select();" readonly="readonly" class="large-text code" value="[xo_slider id=&quot;' . esc_attr( $post->ID ) . '&quot;]" type="text">';
		echo '</label></p>';
		echo '<p><label>' . __( 'Template tag:', 'xo-liteslider' );
		echo '<input id="xo-slider-usage-template" onfocus="this.select();" readonly="readonly" class="large-text code" value="&lt;?php xo_slider( ' . esc_attr( $post->ID ) . ' ); ?&gt;" type="text">';
		echo '</label></p>';
		echo '<p class="howto">' . __( 'Parameter default will be the oldest slider.', 'xo-liteslider' ) . '</p>';
		echo '</div>' . "\n";
	}
}
