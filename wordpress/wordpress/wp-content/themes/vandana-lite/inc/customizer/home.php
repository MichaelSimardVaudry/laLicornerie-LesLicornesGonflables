<?php
/**
 * Front Page Settings
 *
 * @package Vandana_Lite
 */

function vandana_lite_customize_register_frontpage( $wp_customize ) {
	
    /** Front Page Settings */
    $wp_customize->add_panel( 
        'frontpage_settings',
         array(
            'priority'    => 40,
            'capability'  => 'edit_theme_options',
            'title'       => __( 'Front Page Settings', 'vandana-lite' ),
            'description' => __( 'Static Home Page settings.', 'vandana-lite' ),
        ) 
    );    

    $wp_customize->get_section( 'header_image' )->panel                    = 'frontpage_settings';
    $wp_customize->get_section( 'header_image' )->title                    = __( 'Banner Section', 'vandana-lite' );
    $wp_customize->get_section( 'header_image' )->priority                 = 10;
    $wp_customize->get_control( 'header_image' )->active_callback          = 'vandana_lite_banner_ac';
    $wp_customize->get_control( 'header_video' )->active_callback          = 'vandana_lite_banner_ac';
    $wp_customize->get_control( 'external_header_video' )->active_callback = 'vandana_lite_banner_ac';
    $wp_customize->get_section( 'header_image' )->description              = '';                                               
    $wp_customize->get_setting( 'header_image' )->transport                = 'refresh';
    $wp_customize->get_setting( 'header_video' )->transport                = 'refresh';
    $wp_customize->get_setting( 'external_header_video' )->transport       = 'refresh';
    
    /** Banner Options */
    $wp_customize->add_setting(
        'ed_banner_section',
        array(
            'default'           => 'static_nl_banner',
            'sanitize_callback' => 'vandana_lite_sanitize_select'
        )
    );

    $wp_customize->add_control(
        new Vandana_Lite_Select_Control(
            $wp_customize,
            'ed_banner_section',
            array(
                'label'       => __( 'Banner Options', 'vandana-lite' ),
                'description' => __( 'Choose banner as static image/video or as a slider.', 'vandana-lite' ),
                'section'     => 'header_image',
                'choices'     => array(
                    'no_banner'        => __( 'Disable Banner Section', 'vandana-lite' ),
                    'static_nl_banner' => __( 'Static/Video Newsletter Banner', 'vandana-lite' ),
                    'slider_banner'    => __( 'Banner as Slider', 'vandana-lite' ),
                ),
                'priority' => 5 
            )            
        )
    );
    
    /** Banner Newsletter */
    $wp_customize->add_setting(
        'banner_newsletter',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post',
        )
    );
    
    $wp_customize->add_control(
        'banner_newsletter',
        array(
            'label'           => __( 'Banner Newsletter', 'vandana-lite' ),
            'section'         => 'header_image',
            'type'            => 'text',
            'active_callback' => 'vandana_lite_banner_ac'
        )
    );
    
    /** Slider Content Style */
    $wp_customize->add_setting(
        'slider_type',
        array(
            'default'           => 'latest_posts',
            'sanitize_callback' => 'vandana_lite_sanitize_select'
        )
    );

    $wp_customize->add_control(
        new Vandana_Lite_Select_Control(
            $wp_customize,
            'slider_type',
            array(
                'label'   => __( 'Slider Content Style', 'vandana-lite' ),
                'section' => 'header_image',
                'choices' => array(
                    'latest_posts' => __( 'Latest Posts', 'vandana-lite' ),
                    'cat'          => __( 'Category', 'vandana-lite' ),
                ),
                'active_callback' => 'vandana_lite_banner_ac'    
            )
        )
    );
    
    /** Slider Category */
    $wp_customize->add_setting(
        'slider_cat',
        array(
            'default'           => '',
            'sanitize_callback' => 'vandana_lite_sanitize_select'
        )
    );

    $wp_customize->add_control(
        new Vandana_Lite_Select_Control(
            $wp_customize,
            'slider_cat',
            array(
                'label'           => __( 'Slider Category', 'vandana-lite' ),
                'section'         => 'header_image',
                'choices'         => vandana_lite_get_categories(),
                'active_callback' => 'vandana_lite_banner_ac'    
            )
        )
    );
    
    /** No. of slides */
    $wp_customize->add_setting(
        'no_of_slides',
        array(
            'default'           => 3,
            'sanitize_callback' => 'vandana_lite_sanitize_number_absint'
        )
    );
    
    $wp_customize->add_control(
        new Vandana_Lite_Slider_Control( 
            $wp_customize,
            'no_of_slides',
            array(
                'section'     => 'header_image',
                'label'       => __( 'Number of Slides', 'vandana-lite' ),
                'description' => __( 'Choose the number of slides you want to display', 'vandana-lite' ),
                'choices'     => array(
                    'min'   => 1,
                    'max'   => 20,
                    'step'  => 1,
                ),
                'active_callback' => 'vandana_lite_banner_ac'                 
            )
        )
    );
    
    /** HR */
    $wp_customize->add_setting(
        'hr',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );
    
    $wp_customize->add_control(
        new Vandana_Lite_Note_Control( 
            $wp_customize,
            'hr',
            array(
                'section'     => 'header_image',
                'description' => '<hr/>',
                'active_callback' => 'vandana_lite_banner_ac'
            )
        )
    ); 
    
    /** Slider Auto */
    $wp_customize->add_setting(
        'slider_auto',
        array(
            'default'           => false,
            'sanitize_callback' => 'vandana_lite_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        new Vandana_Lite_Toggle_Control( 
            $wp_customize,
            'slider_auto',
            array(
                'section'     => 'header_image',
                'label'       => __( 'Slider Auto', 'vandana-lite' ),
                'description' => __( 'Enable slider auto transition.', 'vandana-lite' ),
                'active_callback' => 'vandana_lite_banner_ac'
            )
        )
    );
    
    /** Slider Loop */
    $wp_customize->add_setting(
        'slider_loop',
        array(
            'default'           => false,
            'sanitize_callback' => 'vandana_lite_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        new Vandana_Lite_Toggle_Control( 
            $wp_customize,
            'slider_loop',
            array(
                'section'     => 'header_image',
                'label'       => __( 'Slider Loop', 'vandana-lite' ),
                'description' => __( 'Enable slider loop.', 'vandana-lite' ),
                'active_callback' => 'vandana_lite_banner_ac'
            )
        )
    );

    $wp_customize->add_setting(
        'slider_speed',
        array(
            'default'           => 700,
            'sanitize_callback' => 'vandana_lite_sanitize_number_absint'
        )
    );
    
    $wp_customize->add_control(
        new Vandana_Lite_Slider_Control( 
            $wp_customize,
            'slider_speed',
            array(
                'section'     => 'header_image',
                'label'       => __( 'Slider Speed', 'vandana-lite' ),
                'description' => __( 'Controls the speed of slider.', 'vandana-lite' ),
                'active_callback' => 'vandana_lite_banner_ac',    
                'choices'     => array(
                    'min'   => 100,
                    'max'   => 10000,
                    'step'  => 100,
                ),                 
            )
        )
    );
    
    /** Slider Caption */
    $wp_customize->add_setting(
        'slider_caption',
        array(
            'default'           => true,
            'sanitize_callback' => 'vandana_lite_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        new Vandana_Lite_Toggle_Control( 
            $wp_customize,
            'slider_caption',
            array(
                'section'     => 'header_image',
                'label'       => __( 'Slider Caption', 'vandana-lite' ),
                'description' => __( 'Enable slider caption.', 'vandana-lite' ),
                'active_callback' => 'vandana_lite_banner_ac'
            )
        )
    );
    
    /** Slider Animation */
    $wp_customize->add_setting(
        'slider_animation',
        array(
            'default'           => '',
            'sanitize_callback' => 'vandana_lite_sanitize_select'
        )
    );

    $wp_customize->add_control(
        new Vandana_Lite_Select_Control(
            $wp_customize,
            'slider_animation',
            array(
                'label'       => __( 'Slider Animation', 'vandana-lite' ),
                'section'     => 'header_image',
                'choices'     => array(
                    'bounceOut'      => __( 'Bounce Out', 'vandana-lite' ),
                    'bounceOutLeft'  => __( 'Bounce Out Left', 'vandana-lite' ),
                    'bounceOutRight' => __( 'Bounce Out Right', 'vandana-lite' ),
                    'bounceOutUp'    => __( 'Bounce Out Up', 'vandana-lite' ),
                    'bounceOutDown'  => __( 'Bounce Out Down', 'vandana-lite' ),
                    'fadeOut'        => __( 'Fade Out', 'vandana-lite' ),
                    'fadeOutLeft'    => __( 'Fade Out Left', 'vandana-lite' ),
                    'fadeOutRight'   => __( 'Fade Out Right', 'vandana-lite' ),
                    'fadeOutUp'      => __( 'Fade Out Up', 'vandana-lite' ),
                    'fadeOutDown'    => __( 'Fade Out Down', 'vandana-lite' ),
                    'flipOutX'       => __( 'Flip OutX', 'vandana-lite' ),
                    'flipOutY'       => __( 'Flip OutY', 'vandana-lite' ),
                    'hinge'          => __( 'Hinge', 'vandana-lite' ),
                    'pulse'          => __( 'Pulse', 'vandana-lite' ),
                    'rollOut'        => __( 'Roll Out', 'vandana-lite' ),
                    'rotateOut'      => __( 'Rotate Out', 'vandana-lite' ),
                    'rubberBand'     => __( 'Rubber Band', 'vandana-lite' ),
                    'shake'          => __( 'Shake', 'vandana-lite' ),
                    ''               => __( 'Slide', 'vandana-lite' ),
                    'slideOutLeft'   => __( 'Slide Out Left', 'vandana-lite' ),
                    'slideOutRight'  => __( 'Slide Out Right', 'vandana-lite' ),
                    'slideOutUp'     => __( 'Slide Out Up', 'vandana-lite' ),
                    'slideOutDown'   => __( 'Slide Out Down', 'vandana-lite' ),
                    'swing'          => __( 'Swing', 'vandana-lite' ),
                    'tada'           => __( 'Tada', 'vandana-lite' ),
                    'zoomOut'        => __( 'Zoom Out', 'vandana-lite' ),
                    'zoomOutLeft'    => __( 'Zoom Out Left', 'vandana-lite' ),
                    'zoomOutRight'   => __( 'Zoom Out Right', 'vandana-lite' ),
                    'zoomOutUp'      => __( 'Zoom Out Up', 'vandana-lite' ),
                    'zoomOutDown'    => __( 'Zoom Out Down', 'vandana-lite' ),                    
                ),
                'active_callback' => 'vandana_lite_banner_ac'                                    
            )
        )
    );
    
    /** Readmore Text */
    $wp_customize->add_setting(
        'slider_readmore',
        array(
            'default'           => __( 'Read More', 'vandana-lite' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage' 
        )
    );
    
    $wp_customize->add_control(
        'slider_readmore',
        array(
            'type'            => 'text',
            'section'         => 'header_image',
            'label'           => __( 'Slider Readmore', 'vandana-lite' ),
            'active_callback' => 'vandana_lite_banner_ac'
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'slider_readmore', array(
        'selector' => '.site-banner .banner-caption .btn-1',
        'render_callback' => 'vandana_lite_get_slider_readmore',
    ) );

    /** Slider Settings Ends */

    /** About Section */
    $wp_customize->add_section(
        'about',
        array(
            'title'    => __( 'About Section', 'vandana-lite' ),
            'priority' => 40,
            'panel'    => 'frontpage_settings',
        )
    );

    $wp_customize->add_setting( 
        'ed_about_section', 
        array(
            'default'           => false,
            'sanitize_callback' => 'vandana_lite_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Vandana_Lite_Toggle_Control( 
            $wp_customize,
            'ed_about_section',
            array(
                'section'     => 'about',
                'label'       => __( 'Enable About Section', 'vandana-lite' ),
                'description' => __( 'Enable to show About section in homepage.', 'vandana-lite' ),
            )
        )
    );

    $wp_customize->add_setting(
        'about_page',
        array(
            'default'           => '',
            'sanitize_callback' => 'vandana_lite_sanitize_select'
        )
    );

    $wp_customize->add_control(
        new Vandana_Lite_Select_Control(
            $wp_customize,
            'about_page',
            array(
                'label'           => __( 'Select Page', 'vandana-lite' ),
                'section'         => 'about',
                'choices'         => vandana_lite_get_posts( 'page' ),
                'active_callback' => 'vandana_lite_about_section_ac' 
            )
        )
    );

    /** Blog Excerpt */
    $wp_customize->add_setting( 
        'about_excerpt', 
        array(
            'default'           => true,
            'sanitize_callback' => 'vandana_lite_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Vandana_Lite_Toggle_Control( 
            $wp_customize,
            'about_excerpt',
            array(
                'section'     => 'about',
                'label'       => __( 'Enable Excerpt', 'vandana-lite' ),
                'description' => __( 'Enable to show excerpt or disable to show full post content.', 'vandana-lite' ),
                'active_callback' => 'vandana_lite_about_section_ac'
            )
        )
    );

    $wp_customize->add_setting(
        'about_readmore',
        array(
            'default'           => __( 'Know More', 'vandana-lite' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'about_readmore',
        array(
            'section' => 'about',
            'label'   => __( 'About Read more', 'vandana-lite' ),
            'type'    => 'text',
            'active_callback' => 'vandana_lite_about_section_ac'
        )
    );

    $wp_customize->selective_refresh->add_partial( 'about_readmore', array(
        'selector' => '.about-section .button-wrap .btn-readmore',
        'render_callback' => 'vandana_lite_get_about_readmore',
    ) );

    /** About Section Ends */

    /** CTA Section */
    $wp_customize->add_section(
        'cta',
        array(
            'title'    => __( 'CTA Section', 'vandana-lite' ),
            'priority' => 50,
            'panel'    => 'frontpage_settings',
        )
    );

    $wp_customize->add_setting(
        'cta_bg',
        array(
            'default'           => esc_url( get_template_directory_uri() . '/images/flower-bg.png' ),
            'sanitize_callback' => 'vandana_lite_sanitize_image',
        )
    );
    
    $wp_customize->add_control(
       new WP_Customize_Image_Control(
           $wp_customize,
           'cta_bg',
           array(
               'label'           => __( 'CTA Background', 'vandana-lite' ),
               'description'     => __( 'Choose the background image for cta section. Recommended image format is PNG Format.', 'vandana-lite' ),
               'section'         => 'cta',
           )
       )
    );

    $wp_customize->add_setting(
        'cta_note_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );
    
    $wp_customize->add_control(
        new Vandana_Lite_Note_Control( 
            $wp_customize,
            'cta_note_text',
            array(
                'section'     => 'cta',
                'description' => __( '<hr/>Add "Blossom: Call To Action" widget for CTA section.', 'vandana-lite' ),
                'priority'    => -1
            )
        )
    );

    $cta_section = $wp_customize->get_section( 'sidebar-widgets-cta' );
    if ( ! empty( $cta_section ) ) {

        $cta_section->panel     = 'frontpage_settings';
        $cta_section->priority  = 50;
        $wp_customize->get_control( 'cta_note_text' )->section = 'sidebar-widgets-cta';
        $wp_customize->get_control( 'cta_bg' )->section = 'sidebar-widgets-cta';
    }  
    
    /** CTA Section Ends */ 

    /** Service Section */
    $wp_customize->add_section(
        'service',
        array(
            'title'    => __( 'Service Section', 'vandana-lite' ),
            'priority' => 60,
            'panel'    => 'frontpage_settings',
        )
    );

    /** Title */
    $wp_customize->add_setting(
        'service_label',
        array(
            'default'           => __( 'View All', 'vandana-lite' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'service_label',
        array(
            'label'           => __( 'Button Label', 'vandana-lite' ),
            'section'         => 'service',
            'type'            => 'text',
            'priority'        => -1
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'service_label', array(
        'selector' => '.service-section .button-wrap .btn-readmore',
        'render_callback' => 'vandana_lite_get_service_label',
    ) );
    
    /** Sub Title */
    $wp_customize->add_setting(
        'service_url',
        array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'service_url',
        array(
            'label'           => __( 'Button URL', 'vandana-lite' ),
            'section'         => 'service',
            'type'            => 'url',
            'priority'        => -1
        )
    );

    $wp_customize->add_setting(
        'service_note_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );
    
    $wp_customize->add_control(
        new Vandana_Lite_Note_Control( 
            $wp_customize,
            'service_note_text',
            array(
                'section'     => 'service',
                'description' => __( '<hr/>Add "Text" and "Blossom: Icon Text" widget for service section.', 'vandana-lite' ),
                'priority'    => -1
            )
        )
    );

    $service_section = $wp_customize->get_section( 'sidebar-widgets-service' );
    if ( ! empty( $service_section ) ) {

        $service_section->panel     = 'frontpage_settings';
        $service_section->priority  = 20;
        $wp_customize->get_control( 'service_note_text' )->section = 'sidebar-widgets-service';
        $wp_customize->get_control( 'service_label' )->section    = 'sidebar-widgets-service';
        $wp_customize->get_control( 'service_url' )->section    = 'sidebar-widgets-service';
    }  
    
    /** service Section Ends */ 

    /** Wheel of life section */
    $wp_customize->add_section(
        'wheel_of_life',
        array(
            'title'    => __( 'Wheel of Life Section', 'vandana-lite' ),
            'priority' => 70,
            'panel'    => 'frontpage_settings',
        )
    );

    if( vandana_lite_is_wheel_of_life_activated() ){

        $wp_customize->add_setting(
            'ed_wheeloflife_section',
            array(
                'default'           => false,
                'sanitize_callback' => 'vandana_lite_sanitize_checkbox'
            )
        );
    
        $wp_customize->add_control(
            new Vandana_Lite_Toggle_Control(
                $wp_customize,
                'ed_wheeloflife_section',
                array(
                    'label'       => __( 'Enable Wheel of Life Section', 'vandana-lite' ),
                    'section'     => 'wheel_of_life',
                )            
            )
        );

        /** Note */
        $wp_customize->add_setting(
            'wheeloflife_text',
            array(
                'default'           => '',
                'sanitize_callback' => 'wp_kses_post' 
            )
        );
        
        $wp_customize->add_control(
            new Vandana_Lite_Note_Control( 
                $wp_customize,
                'wheeloflife_text',
                array(
                    'section'     => 'wheel_of_life',
                    'description' => sprintf( __( 'Refer to this %1$sdocumentation%2$s to configure the plugin.', 'vandana-lite' ), '<a href="https://kraftplugins.com/wheel-of-life/docs/" target="_blank">', '</a>' ),
                    'active_callback' => 'vandana_lite_wheeloflife_ac'
                )
            )
        );
        
        $wp_customize->add_setting(
            'wol_section_title',
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );
        
        $wp_customize->add_control(
            'wol_section_title',
            array(
                'label'   => __( 'Section Title', 'vandana-lite' ),
                'section' => 'wheel_of_life',
                'type'    => 'text',
                'active_callback' => 'vandana_lite_wheeloflife_ac'
            )
        );
        
        $wp_customize->selective_refresh->add_partial( 'wol_section_title', array(
            'selector'        => '.wheeloflife-section h2.section-title',
            'render_callback' => 'vandana_lite_get_wol_section_title',
        ) );

        $wp_customize->add_setting(
            'wol_section_content',
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );
        
        $wp_customize->add_control(
            'wol_section_content',
            array(
                'label'           => __( 'Section Content', 'vandana-lite' ),
                'section'         => 'wheel_of_life',
                'type'            => 'text',
                'active_callback' => 'vandana_lite_wheeloflife_ac'
            )
        );

        $wp_customize->selective_refresh->add_partial( 'wol_section_content', array(
            'selector'        => '.wheeloflife-section .section-content p',
            'render_callback' => 'vandana_lite_get_wol_section_content',
        ) );

        /** Image */
        $wp_customize->add_setting(
            'wheeloflife_img',
            array(
                'default'           => get_template_directory_uri() . '/images/chart.png',
                'sanitize_callback' => 'vandana_lite_sanitize_image',
            )
        );
        
        $wp_customize->add_control(
            new WP_Customize_Image_Control(
                $wp_customize,
                'wheeloflife_img',
                array(
                    'label'             => __( 'Wheel of Life Image', 'vandana-lite' ),
                    'section'           => 'wheel_of_life',
                    'active_callback'   => 'vandana_lite_wheeloflife_ac'
                )
            )
        );

        $wp_customize->add_setting(
			'wheeloflife_shortcode',
			array(
				'default'            => '',
				'sanitize_callback'  => 'wp_kses_post',
			)
		);

		$wp_customize->add_control(
			'wheeloflife_shortcode',
			array(
				'label'         => __('Wheel of Life shortcode', 'vandana-lite'),
				'description'   => __('Enter the Wheel of Life shortcode. Ex. [wheeloflife id=1456]', 'vandana-lite'),
				'section'       => 'wheel_of_life',
				'type'          => 'text',
                'active_callback' => 'vandana_lite_wheeloflife_ac'
			)
		);

        $wp_customize->add_setting(
            'wheeloflife_learn_text',
            array(
                'default'           => '',
                'sanitize_callback' => 'wp_kses_post' 
            )
        );
        
        $wp_customize->add_control(
            new Vandana_Lite_Note_Control( 
                $wp_customize,
                'wheeloflife_learn_text',
                array(
                    'section'     => 'wheel_of_life',
                    'description' => sprintf( __( 'Refer to this %1$sdocumentation%2$s to learn how to use the shortcode.', 'vandana-lite' ), '<a href="https://kraftplugins.com/wheel-of-life/docs/how-to-display-embed-wheel-of-life-assessments/" target="_blank">', '</a>' ),
                    'active_callback' => 'vandana_lite_wheeloflife_ac'
                )
            )
        );

        $wp_customize->add_setting( 
            'wheeloflife_color', 
            array(
                'default'           => '#fef3f2',
                'sanitize_callback' => 'sanitize_hex_color',
            ) 
        );
    
        $wp_customize->add_control( 
            new WP_Customize_Color_Control( 
                $wp_customize, 
                'wheeloflife_color', 
                array(
                    'label'       => __( 'Section color', 'vandana-lite' ),
                    'section'     => 'wheel_of_life',
                    'active_callback' => 'vandana_lite_wheeloflife_ac'
                )
            )
        );

    }else{

        $wp_customize->add_setting(
    		'wol_activate_note',
    		array(
    			'sanitize_callback' => 'wp_kses_post'
    		)
    	);
    
    	$wp_customize->add_control(
    		new Vandana_Lite_Note_Control( 
    			$wp_customize,
    			'wol_activate_note',
    			array(
    				'section'     => 'wheel_of_life', 
                    'label'       => __( 'Wheel of Life', 'vandana-lite' ),   				
                    'description' => sprintf( __( 'Please install and activate the recommended plugin %1$sWheel of Life%2$s. After that option related with this section will be visible.', 'vandana-lite' ), '<a href="' . admin_url( 'themes.php?page=tgmpa-install-plugins' ) . '" target="_blank">', '</a>' ),
    			)
    		)
       ); 
    }
    /** Wheel of life section ends */


    /** Testimonial Section */
    $wp_customize->add_section(
        'testimonial',
        array(
            'title'    => __( 'Testimonial Section', 'vandana-lite' ),
            'priority' => 90,
            'panel'    => 'frontpage_settings',
        )
    );

    /** Testimonial Title  */
    $wp_customize->add_setting(
        'testimonial_title',
        array(
            'default'           => __( 'Testimonials', 'vandana-lite' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );
    
    $wp_customize->add_control(
        'testimonial_title',
        array(
            'label'           => __( 'Testimonial Section Title', 'vandana-lite' ),
            'description'     => __( 'Add title for testimonial section.', 'vandana-lite' ),
            'section'         => 'testimonial',
            'priority'    => -1
        )
    );

    $wp_customize->selective_refresh->add_partial( 'testimonial_title', array(
        'selector' => '.testimonial-section .section-header h2.section-title',
        'render_callback' => 'vandana_lite_get_testimonial_title',
    ) );
    
    /** Testimonial SubTitle  */
    $wp_customize->add_setting(
        'testimonial_subtitle',
        array(
            'default'           => __( 'Words of praise by my valuable clients.', 'vandana-lite' ),
            'sanitize_callback' => 'sanitize_textarea_field',
            'transport'         => 'postMessage',
        )
    );
    
    $wp_customize->add_control(
        'testimonial_subtitle',
        array(
            'label'           => __( 'Testimonial Section Subtitle', 'vandana-lite' ),
            'description'     => __( 'Add subtitle for testimonial section.', 'vandana-lite' ),
            'section'         => 'testimonial',
            'type'            => 'textarea',
            'priority'    => -1
        )
    );

    $wp_customize->selective_refresh->add_partial( 'testimonial_subtitle', array(
        'selector' => '.testimonial-section .section-header .section-content',
        'render_callback' => 'vandana_lite_get_testimonial_subtitle',
    ) );

    $wp_customize->add_setting(
        'testimonial_bg',
        array(
            'default'           => esc_url( get_template_directory_uri() . '/images/flower-bg.png' ),
            'sanitize_callback' => 'vandana_lite_sanitize_image',
        )
    );
    
    $wp_customize->add_control(
       new WP_Customize_Image_Control(
           $wp_customize,
           'testimonial_bg',
           array(
               'label'           => __( 'Choose Background', 'vandana-lite' ),
               'description'     => __( 'Choose the background image for testimonial section. Recommended image format is PNG Format.', 'vandana-lite' ),
               'section'         => 'testimonial',
           )
       )
    );
    
    $wp_customize->add_setting(
        'testimonial_note_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );
    
    $wp_customize->add_control(
        new Vandana_Lite_Note_Control( 
            $wp_customize,
            'testimonial_note_text',
            array(
                'section'     => 'testimonial',
                'description' => __( '<hr/>Add "Blossom: Testimonial" widget for testimonial section.', 'vandana-lite' ),
                'priority'    => -1
            )
        )
    );

    $testimonial_section = $wp_customize->get_section( 'sidebar-widgets-testimonial' );
    if ( ! empty( $testimonial_section ) ) {

        $testimonial_section->panel     = 'frontpage_settings';
        $testimonial_section->priority  = 90;
        $wp_customize->get_control( 'testimonial_note_text' )->section = 'sidebar-widgets-testimonial';
        $wp_customize->get_control( 'testimonial_title' )->section     = 'sidebar-widgets-testimonial';
        $wp_customize->get_control( 'testimonial_subtitle' )->section  = 'sidebar-widgets-testimonial';
        $wp_customize->get_control( 'testimonial_bg' )->section    = 'sidebar-widgets-testimonial';
    }  
    
    /** Testimonial Section Ends */

    /** Blog Section */
    $wp_customize->add_section(
        'blog_section',
        array(
            'title'    => __( 'Blog Section', 'vandana-lite' ),
            'priority' => 110,
            'panel'    => 'frontpage_settings',
        )
    );

    $wp_customize->add_setting( 
        'ed_blog_section', 
        array(
            'default'           => true,
            'sanitize_callback' => 'vandana_lite_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Vandana_Lite_Toggle_Control( 
            $wp_customize,
            'ed_blog_section',
            array(
                'section'     => 'blog_section',
                'label'       => __( 'Enable Blog Section', 'vandana-lite' ),
                'description' => __( 'Enable to show blog section in homepage.', 'vandana-lite' ),
            )
        )
    );

    /** Blog title */
    $wp_customize->add_setting(
        'blog_section_title',
        array(
            'default'           => __( 'Latest Articles', 'vandana-lite' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'blog_section_title',
        array(
            'section' => 'blog_section',
            'label'   => __( 'Blog Title', 'vandana-lite' ),
            'type'    => 'text',
            'active_callback' => 'vandana_lite_blog_section_ac'
        )
    );

    $wp_customize->selective_refresh->add_partial( 'blog_section_title', array(
        'selector' => '.blog-section .section-header h2.section-title',
        'render_callback' => 'vandana_lite_get_blog_section_title',
    ) );

    /** Blog description */
    $wp_customize->add_setting(
        'blog_section_subtitle',
        array(
            'default'           => __( 'Show your latest blog posts here. You can modify this section from Appearance > Customize > Front Page Settings > Blog Section.', 'vandana-lite' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'blog_section_subtitle',
        array(
            'section' => 'blog_section',
            'label'   => __( 'Blog Description', 'vandana-lite' ),
            'type'    => 'text',
            'active_callback' => 'vandana_lite_blog_section_ac'
        )
    ); 

    $wp_customize->selective_refresh->add_partial( 'blog_section_subtitle', array(
        'selector' => '.blog-section .section-header .section-content',
        'render_callback' => 'vandana_lite_get_blog_section_subtitle',
    ) );
    
    /** View All Label */
    $wp_customize->add_setting(
        'blog_view_all',
        array(
            'default'           => __( 'View All', 'vandana-lite' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'blog_view_all',
        array(
            'label'           => __( 'View All Label', 'vandana-lite' ),
            'section'         => 'blog_section',
            'type'            => 'text',
            'active_callback' => 'vandana_lite_blog_view_all_ac'
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'blog_view_all', array(
        'selector' => '.blog-section .button-wrap .btn-readmore',
        'render_callback' => 'vandana_lite_get_blog_view_all',
    ) ); 

    /** Blog Section Ends */

    /** Contact Section */
    $wp_customize->add_section(
        'contact',
        array(
            'title'    => __( 'Contact Section', 'vandana-lite' ),
            'priority' => 120,
            'panel'    => 'frontpage_settings',
        )
    );

    /** Contact Title  */
    $wp_customize->add_setting(
        'contact_sec_title',
        array(
            'default'           => __( 'Get in Touch Today', 'vandana-lite' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );
    
    $wp_customize->add_control(
        'contact_sec_title',
        array(
            'label'           => __( 'Contact Section Title', 'vandana-lite' ),
            'description'     => __( 'Add title for contact section.', 'vandana-lite' ),
            'section'         => 'contact',
            'priority'    => -1
        )
    );

    $wp_customize->selective_refresh->add_partial( 'contact_sec_title', array(
        'selector' => '.contact-section .section-header h2.section-title',
        'render_callback' => 'vandana_lite_get_contact_sec_title',
    ) );
    
    /** Contact SubTitle  */
    $wp_customize->add_setting(
        'contact_subtitle',
        array(
            'default'           => __( 'You can modify this section from Appearance > Customize > Front Page Settings > Contact Section.', 'vandana-lite' ),
            'sanitize_callback' => 'sanitize_textarea_field',
            'transport'         => 'postMessage',
        )
    );
    
    $wp_customize->add_control(
        'contact_subtitle',
        array(
            'label'           => __( 'Contact Section SubTitle', 'vandana-lite' ),
            'description'     => __( 'Add subtitle for contact section.', 'vandana-lite' ),
            'section'         => 'contact',
            'type'            => 'textarea',
            'priority'    => -1
        )
    );

    $wp_customize->selective_refresh->add_partial( 'contact_subtitle', array(
        'selector' => '.contact-section .section-header .section-content',
        'render_callback' => 'vandana_lite_get_contact_subtitle',
    ) );

    $wp_customize->add_setting(
        'contact_note_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );
    
    $wp_customize->add_control(
        new Vandana_Lite_Note_Control( 
            $wp_customize,
            'contact_note_text',
            array(
                'section'     => 'contact',
                'description' => __( '<hr/>Add "Blossom: Contact Widget", "Custom HTML ( for map ) or Image" & "Text" widgets for contact section.', 'vandana-lite' ),
                'priority'    => -1
            )
        )
    );

    $contact_section = $wp_customize->get_section( 'sidebar-widgets-contact' );
    if ( ! empty( $contact_section ) ) {

        $contact_section->panel     = 'frontpage_settings';
        $contact_section->priority  = 120;
        $wp_customize->get_control( 'contact_note_text' )->section = 'sidebar-widgets-contact';
        $wp_customize->get_control( 'contact_sec_title' )->section = 'sidebar-widgets-contact';
        $wp_customize->get_control( 'contact_subtitle' )->section  = 'sidebar-widgets-contact';
    }  
    
    /** Contact Section Ends */

}
add_action( 'customize_register', 'vandana_lite_customize_register_frontpage' );