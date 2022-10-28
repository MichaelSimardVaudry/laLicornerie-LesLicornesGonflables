<?php
/**
 * General Settings
 *
 * @package Vandana_Lite
 */

function vandana_lite_customize_register_general( $wp_customize ){
    
    /** General Settings */
    $wp_customize->add_panel( 
        'general_settings',
         array(
            'priority'    => 60,
            'capability'  => 'edit_theme_options',
            'title'       => __( 'General Settings', 'vandana-lite' ),
            'description' => __( 'Customize Header, Social, Sharing, SEO, Post/Page, Newsletter, Performance and Miscellaneous settings.', 'vandana-lite' ),
        ) 
    );

    /** Notification Bar Settings */
    $wp_customize->add_section(
        'notification_bar_settings',
        array(
            'title'    => __( 'Notification Bar Settings', 'vandana-lite' ),
            'priority' => 5,
            'panel'    => 'general_settings',
        )
    );
    
    /** Enable Notification Bar */
    $wp_customize->add_setting( 
        'notification_bar_area', 
        array(
            'default'           => false,
            'sanitize_callback' => 'vandana_lite_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Vandana_Lite_Toggle_Control( 
            $wp_customize,
            'notification_bar_area',
            array(
                'section'        => 'notification_bar_settings',
                'label'          => __( 'Enable Notification Bar', 'vandana-lite' ),
                'description'    => __( 'Enable to show Notification bar on top of header.', 'vandana-lite' ),
            )
        )
    );

     /** Notification Text */
    $wp_customize->add_setting( 
        'notification_text', 
        array(
            'default'           => __( 'By continuing to use this site, you agree to the use of cookies.  ', 'vandana-lite' ), 
            'sanitize_callback' => 'sanitize_text_field'
        ) 
    );
    
    $wp_customize->add_control(
        'notification_text',
        array(
            'section'        => 'notification_bar_settings',
            'label'          => __( 'Notification Text', 'vandana-lite' ),
            'description'    => __( 'Please add the notification text here.', 'vandana-lite' ),
            'active_callback'=> 'vandana_lite_notification',
            'type'           => 'text',
        )   
    );

    /** Notification Button Label */
    $wp_customize->add_setting(
        'notification_btn_label',
        array(
            'default'           => __( 'Find out more', 'vandana-lite' ),
            'sanitize_callback' => 'sanitize_text_field' 
        )
    );
    
    $wp_customize->add_control(
        'notification_btn_label',
        array(
            'type'            => 'text',
            'section'         => 'notification_bar_settings',
            'label'           => __( 'Notification Button Label', 'vandana-lite' ),
            'active_callback' => 'vandana_lite_notification',

        )
    );

    /** Notification Button Link */
    $wp_customize->add_setting(
        'notification_btn_url',
        array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw' 
        )
    );
    
    $wp_customize->add_control(
        'notification_btn_url',
        array(
            'type'            => 'text',
            'section'         => 'notification_bar_settings',
            'label'           => __( 'Notification Button Link', 'vandana-lite' ),
            'active_callback' => 'vandana_lite_notification',

        )
    );  

    /** Enable Notification Bar */
    $wp_customize->add_setting( 
        'ed_open_new_target', 
        array(
            'default'           => false,
            'sanitize_callback' => 'vandana_lite_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Vandana_Lite_Toggle_Control( 
            $wp_customize,
            'ed_open_new_target',
            array(
                'section'         => 'notification_bar_settings',
                'label'           => __( 'Enable to open in new window', 'vandana-lite' ),
                'description'     => __( 'Enable/Disable to show the URL to go in next window', 'vandana-lite' ),
                'active_callback' => 'vandana_lite_notification',

            )
        )
    );  

    /** Notification Bar Settings Ends */

    /** Header Settings */
    $wp_customize->add_section(
        'header_settings',
        array(
            'title'    => __( 'Header Settings', 'vandana-lite' ),
            'priority' => 20,
            'panel'    => 'general_settings',
        )
    );
    
    /** Enable Header Search */
    $wp_customize->add_setting( 
        'ed_header_search', 
        array(
            'default'           => true,
            'sanitize_callback' => 'vandana_lite_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Vandana_Lite_Toggle_Control( 
            $wp_customize,
            'ed_header_search',
            array(
                'section'     => 'header_settings',
                'label'       => __( 'Enable Header Search', 'vandana-lite' ),
                'description' => __( 'Enable to show Search button in header.', 'vandana-lite' ),
            )
        )
    );
    
    /** Shopping Cart */
    $wp_customize->add_setting( 
        'ed_shopping_cart', 
        array(
            'default'           => true,
            'sanitize_callback' => 'vandana_lite_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Vandana_Lite_Toggle_Control( 
            $wp_customize,
            'ed_shopping_cart',
            array(
                'section'         => 'header_settings',
                'label'           => __( 'Shopping Cart', 'vandana-lite' ),
                'description'     => __( 'Enable to show Shopping cart in the header.', 'vandana-lite' ),
                'active_callback' => 'vandana_lite_is_woocommerce_activated'
            )
        )
    );
    
    /** Header Settings Ends */

    /** Social Media Settings */
    $wp_customize->add_section(
        'social_media_settings',
        array(
            'title'    => __( 'Social Media Settings', 'vandana-lite' ),
            'priority' => 30,
            'panel'    => 'general_settings',
        )
    );
    
    /** Enable Social Links */
    $wp_customize->add_setting( 
        'ed_social_links', 
        array(
            'default'           => false,
            'sanitize_callback' => 'vandana_lite_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Vandana_Lite_Toggle_Control( 
            $wp_customize,
            'ed_social_links',
            array(
                'section'     => 'social_media_settings',
                'label'       => __( 'Enable Social Links', 'vandana-lite' ),
                'description' => __( 'Enable to show social links at header.', 'vandana-lite' ),
            )
        )
    );
    
    $wp_customize->add_setting( 
        new Vandana_Lite_Repeater_Setting( 
            $wp_customize, 
            'social_links', 
            array(
                'default' => '',
                'sanitize_callback' => array( 'Vandana_Lite_Repeater_Setting', 'sanitize_repeater_setting' ),
            ) 
        ) 
    );
    
    $wp_customize->add_control(
        new Vandana_Lite_Control_Repeater(
            $wp_customize,
            'social_links',
            array(
                'section' => 'social_media_settings',               
                'label'   => __( 'Social Links', 'vandana-lite' ),
                'fields'  => array(
                    'font' => array(
                        'type'        => 'font',
                        'label'       => __( 'Font Awesome Icon', 'vandana-lite' ),
                        'description' => __( 'Example: fab fa-facebook-f', 'vandana-lite' ),
                    ),
                    'link' => array(
                        'type'        => 'url',
                        'label'       => __( 'Link', 'vandana-lite' ),
                        'description' => __( 'Example: https://facebook.com', 'vandana-lite' ),
                    )
                ),
                'row_label' => array(
                    'type' => 'field',
                    'value' => __( 'links', 'vandana-lite' ),
                    'field' => 'link'
                )                        
            )
        )
    );
    /** Social Media Settings Ends */

    /** SEO Settings */
    $wp_customize->add_section(
        'seo_settings',
        array(
            'title'    => __( 'SEO Settings', 'vandana-lite' ),
            'priority' => 40,
            'panel'    => 'general_settings',
        )
    );
    
    /** Enable Social Links */
    $wp_customize->add_setting( 
        'ed_post_update_date', 
        array(
            'default'           => true,
            'sanitize_callback' => 'vandana_lite_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Vandana_Lite_Toggle_Control( 
            $wp_customize,
            'ed_post_update_date',
            array(
                'section'     => 'seo_settings',
                'label'       => __( 'Enable Last Update Post Date', 'vandana-lite' ),
                'description' => __( 'Enable to show last updated post date on listing as well as in single post.', 'vandana-lite' ),
            )
        )
    );
    
    /** Enable Social Links */
    $wp_customize->add_setting( 
        'ed_breadcrumb', 
        array(
            'default'           => true,
            'sanitize_callback' => 'vandana_lite_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Vandana_Lite_Toggle_Control( 
            $wp_customize,
            'ed_breadcrumb',
            array(
                'section'     => 'seo_settings',
                'label'       => __( 'Enable Breadcrumb', 'vandana-lite' ),
                'description' => __( 'Enable to show breadcrumb in inner pages.', 'vandana-lite' ),
            )
        )
    );
    
    /** Breadcrumb Home Text */
    $wp_customize->add_setting(
        'home_text',
        array(
            'default'           => __( 'Home', 'vandana-lite' ),
            'sanitize_callback' => 'sanitize_text_field' 
        )
    );
    
    $wp_customize->add_control(
        'home_text',
        array(
            'type'    => 'text',
            'section' => 'seo_settings',
            'label'   => __( 'Breadcrumb Home Text', 'vandana-lite' ),
        )
    );  
    /** SEO Settings Ends */

    /** Posts(Blog) & Pages Settings */
    $wp_customize->add_section(
        'post_page_settings',
        array(
            'title'    => __( 'Posts(Blog) & Pages Settings', 'vandana-lite' ),
            'priority' => 50,
            'panel'    => 'general_settings',
        )
    );
    
    /** Prefix Archive Page */
    $wp_customize->add_setting( 
        'ed_prefix_archive', 
        array(
            'default'           => true,
            'sanitize_callback' => 'vandana_lite_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Vandana_Lite_Toggle_Control( 
            $wp_customize,
            'ed_prefix_archive',
            array(
                'section'     => 'post_page_settings',
                'label'       => __( 'Hide Prefix in Archive Page', 'vandana-lite' ),
                'description' => __( 'Enable to hide prefix in archive page.', 'vandana-lite' ),
            )
        )
    );
    
    /** Blog Excerpt */
    $wp_customize->add_setting( 
        'ed_excerpt', 
        array(
            'default'           => true,
            'sanitize_callback' => 'vandana_lite_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Vandana_Lite_Toggle_Control( 
            $wp_customize,
            'ed_excerpt',
            array(
                'section'     => 'post_page_settings',
                'label'       => __( 'Enable Blog Excerpt', 'vandana-lite' ),
                'description' => __( 'Enable to show excerpt or disable to show full post content.', 'vandana-lite' ),
            )
        )
    );
    
    /** Excerpt Length */
    $wp_customize->add_setting( 
        'excerpt_length', 
        array(
            'default'           => 55,
            'sanitize_callback' => 'vandana_lite_sanitize_number_absint'
        ) 
    );
    
    $wp_customize->add_control(
        new Vandana_Lite_Slider_Control( 
            $wp_customize,
            'excerpt_length',
            array(
                'section'     => 'post_page_settings',
                'label'       => __( 'Excerpt Length', 'vandana-lite' ),
                'description' => __( 'Automatically generated excerpt length (in words).', 'vandana-lite' ),
                'choices'     => array(
                    'min'   => 10,
                    'max'   => 100,
                    'step'  => 5,
                )                 
            )
        )
    );
    
    /** Read More Text */
    $wp_customize->add_setting(
        'read_more_text',
        array(
            'default'           => __( 'Read More', 'vandana-lite' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage' 
        )
    );
    
    $wp_customize->add_control(
        'read_more_text',
        array(
            'type'    => 'text',
            'section' => 'post_page_settings',
            'label'   => __( 'Read More Text', 'vandana-lite' ),
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'read_more_text', array(
        'selector' => '.entry-footer .btn-readmore',
        'render_callback' => 'vandana_lite_get_read_more',
    ) );
    
    /** Note */
    $wp_customize->add_setting(
        'post_note_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );
    
    $wp_customize->add_control(
        new Vandana_Lite_Note_Control( 
            $wp_customize,
            'post_note_text',
            array(
                'section'     => 'post_page_settings',
                'description' => sprintf( __( '%s These options affect your individual posts.', 'vandana-lite' ), '<hr/>' ),
            )
        )
    );
    
    /** Hide Author Section */
    $wp_customize->add_setting( 
        'ed_author', 
        array(
            'default'           => false,
            'sanitize_callback' => 'vandana_lite_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Vandana_Lite_Toggle_Control( 
            $wp_customize,
            'ed_author',
            array(
                'section'     => 'post_page_settings',
                'label'       => __( 'Hide Author Section', 'vandana-lite' ),
                'description' => __( 'Enable to hide author section.', 'vandana-lite' ),
            )
        )
    );
    
    /** Show Related Posts */
    $wp_customize->add_setting( 
        'ed_related', 
        array(
            'default'           => true,
            'sanitize_callback' => 'vandana_lite_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Vandana_Lite_Toggle_Control( 
            $wp_customize,
            'ed_related',
            array(
                'section'     => 'post_page_settings',
                'label'       => __( 'Show Related Posts', 'vandana-lite' ),
                'description' => __( 'Enable to show related posts in single page.', 'vandana-lite' ),
            )
        )
    );
    
    /** Related Posts section title */
    $wp_customize->add_setting(
        'related_post_title',
        array(
            'default'           => __( 'You may also like', 'vandana-lite' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage' 
        )
    );
    
    $wp_customize->add_control(
        'related_post_title',
        array(
            'type'            => 'text',
            'section'         => 'post_page_settings',
            'label'           => __( 'Related Posts Section Title', 'vandana-lite' ),
            'active_callback' => 'vandana_lite_post_page_ac'
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'related_post_title', array(
        'selector' => '.additional-post .post-title',
        'render_callback' => 'vandana_lite_get_related_title',
    ) );
    
    /** Related Posts section title */
    $wp_customize->add_setting(
        'related_portfolio_title',
        array(
            'default'           => __( 'Related Projects', 'vandana-lite' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage' 
        )
    );
    
    $wp_customize->add_control(
        'related_portfolio_title',
        array(
            'type'            => 'text',
            'section'         => 'post_page_settings',
            'label'           => __( 'Related Portfolio Title', 'vandana-lite' ),
        )
    );

    $wp_customize->selective_refresh->add_partial( 'related_portfolio_title', array(
        'selector' => '.related-portfolio .related-portfolio-title',
        'render_callback' => 'vandana_lite_get_related_portfolio_title',
    ) );
    
    /** Comments */
    $wp_customize->add_setting(
        'ed_comments',
        array(
            'default'           => true,
            'sanitize_callback' => 'vandana_lite_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        new Vandana_Lite_Toggle_Control( 
            $wp_customize,
            'ed_comments',
            array(
                'section'     => 'post_page_settings',
                'label'       => __( 'Show Comments', 'vandana-lite' ),
                'description' => __( 'Enable to show Comments in Single Post/Page.', 'vandana-lite' ),
            )
        )
    );
    
    /** Comment Section After Content */
    $wp_customize->add_setting( 
        'toggle_comments', 
        array(
            'default'           => false,
            'sanitize_callback' => 'vandana_lite_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Vandana_Lite_Toggle_Control( 
            $wp_customize,
            'toggle_comments',
            array(
                'section'     => 'post_page_settings',
                'label'       => __( 'Toggle Comment Section', 'vandana-lite' ),
                'description' => __( 'Enable to show comment section after post content. Refresh site for changes.', 'vandana-lite' ),
                'active_callback' => 'vandana_lite_comments_toggle'
            )
        )
    );

    /** Hide Category */
    $wp_customize->add_setting( 
        'ed_category', 
        array(
            'default'           => false,
            'sanitize_callback' => 'vandana_lite_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Vandana_Lite_Toggle_Control( 
            $wp_customize,
            'ed_category',
            array(
                'section'     => 'post_page_settings',
                'label'       => __( 'Hide Category', 'vandana-lite' ),
                'description' => __( 'Enable to hide category.', 'vandana-lite' ),
            )
        )
    );

    /** Hide Tags */
    $wp_customize->add_setting( 
        'ed_tags', 
        array(
            'default'           => false,
            'sanitize_callback' => 'vandana_lite_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Vandana_Lite_Toggle_Control( 
            $wp_customize,
            'ed_tags',
            array(
                'section'     => 'post_page_settings',
                'label'       => __( 'Hide Tags', 'vandana-lite' ),
                'description' => __( 'Enable to hide tags.', 'vandana-lite' ),
            )
        )
    );

    /** Hide Post Author */
    $wp_customize->add_setting( 
        'ed_post_author', 
        array(
            'default'           => false,
            'sanitize_callback' => 'vandana_lite_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Vandana_Lite_Toggle_Control( 
            $wp_customize,
            'ed_post_author',
            array(
                'section'     => 'post_page_settings',
                'label'       => __( 'Hide Post Author', 'vandana-lite' ),
                'description' => __( 'Enable to hide post author.', 'vandana-lite' ),
            )
        )
    );
    
    /** Hide Posted Date */
    $wp_customize->add_setting( 
        'ed_post_date', 
        array(
            'default'           => false,
            'sanitize_callback' => 'vandana_lite_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Vandana_Lite_Toggle_Control( 
            $wp_customize,
            'ed_post_date',
            array(
                'section'     => 'post_page_settings',
                'label'       => __( 'Hide Posted Date', 'vandana-lite' ),
                'description' => __( 'Enable to hide posted date.', 'vandana-lite' ),
            )
        )
    );
    
    /** Posts(Blog) & Pages Settings Ends */

    /** Newsletter Settings */
    $wp_customize->add_section(
        'newsletter_settings',
        array(
            'title'    => __( 'Newsletter Settings', 'vandana-lite' ),
            'priority' => 65,
            'panel'    => 'general_settings',
        )
    );
    
    if( vandana_lite_is_btnw_activated() ){
        
        /** Enable Newsletter Section */
        $wp_customize->add_setting( 
            'ed_newsletter', 
            array(
                'default'           => false,
                'sanitize_callback' => 'vandana_lite_sanitize_checkbox'
            ) 
        );
        
        $wp_customize->add_control(
            new Vandana_Lite_Toggle_Control( 
                $wp_customize,
                'ed_newsletter',
                array(
                    'section'     => 'newsletter_settings',
                    'label'       => __( 'Newsletter Section', 'vandana-lite' ),
                    'description' => __( 'Enable to show Newsletter Section', 'vandana-lite' ),
                )
            )
        );

        /** Enable Newsletter Section */
        $wp_customize->add_setting( 
            'ed_single_newsletter', 
            array(
                'default'           => false,
                'sanitize_callback' => 'vandana_lite_sanitize_checkbox'
            ) 
        );
        
        $wp_customize->add_control(
            new Vandana_Lite_Toggle_Control( 
                $wp_customize,
                'ed_single_newsletter',
                array(
                    'section'     => 'newsletter_settings',
                    'label'       => __( 'Single Newsletter Section', 'vandana-lite' ),
                    'description' => __( 'Enable to show Newsletter Section in single post.', 'vandana-lite' ),
                )
            )
        );
        
        /** Newsletter Shortcode */
        $wp_customize->add_setting(
            'newsletter_shortcode',
            array(
                'default'           => '',
                'sanitize_callback' => 'wp_kses_post',
            )
        );
        
        $wp_customize->add_control(
            'newsletter_shortcode',
            array(
                'type'        => 'text',
                'section'     => 'newsletter_settings',
                'label'       => __( 'Newsletter Shortcode', 'vandana-lite' ),
                'description' => __( 'Enter the BlossomThemes Email Newsletters Shortcode. Ex. [BTEN id="356"]', 'vandana-lite' ),
            )
        ); 

    } else {
        $wp_customize->add_setting(
            'newsletter_recommend',
            array(
                'sanitize_callback' => 'wp_kses_post',
            )
        );

        $wp_customize->add_control(
            new vandana_lite_Plugin_Recommend_Control(
                $wp_customize,
                'newsletter_recommend',
                array(
                    'section'     => 'newsletter_settings',
                    'label'       => __( 'Newsletter Shortcode', 'vandana-lite' ),
                    'capability'  => 'install_plugins',
                    'plugin_slug' => 'blossomthemes-email-newsletter',//This is the slug of recommended plugin.
                    'description' => sprintf( __( 'Please install and activate the recommended plugin %1$sBlossomThemes Email Newsletter%2$s. After that option related with this section will be visible.', 'vandana-lite' ), '<strong>', '</strong>' ),
                )
            )
        );
    }
    /** Newsletter Settings End */

    /** Instagram Settings */
    $wp_customize->add_section(
        'instagram_settings',
        array(
            'title'    => __( 'Instagram Settings', 'vandana-lite' ),
            'priority' => 65,
            'panel'    => 'general_settings',
        )
    );
    
    if( vandana_lite_is_btif_activated() ){
        /** Enable Instagram Section */
        $wp_customize->add_setting( 
            'ed_instagram', 
            array(
                'default'           => false,
                'sanitize_callback' => 'vandana_lite_sanitize_checkbox'
            ) 
        );
        
        $wp_customize->add_control(
            new Vandana_Lite_Toggle_Control( 
                $wp_customize,
                'ed_instagram',
                array(
                    'section'     => 'instagram_settings',
                    'label'       => __( 'Instagram Section', 'vandana-lite' ),
                    'description' => __( 'Enable to show Instagram Section', 'vandana-lite' ),
                )
            )
        );
        
        /** Note */
        $wp_customize->add_setting(
            'instagram_text',
            array(
                'default'           => '',
                'sanitize_callback' => 'wp_kses_post' 
            )
        );
        
        $wp_customize->add_control(
            new Vandana_Lite_Note_Control( 
                $wp_customize,
                'instagram_text',
                array(
                    'section'     => 'instagram_settings',
                    'description' => sprintf( __( 'You can change the setting of BlossomThemes Social Feed %1$sfrom here%2$s.', 'vandana-lite' ), '<a href="' . esc_url( admin_url( 'admin.php?page=class-blossomthemes-instagram-feed-admin.php' ) ) . '" target="_blank">', '</a>' )
                )
            )
        );        
    }else{
        /** Note */
        $wp_customize->add_setting(
            'instagram_text',
            array(
                'default'           => '',
                'sanitize_callback' => 'wp_kses_post' 
            )
        );
        
        $wp_customize->add_control(
            new Vandana_Lite_Note_Control( 
                $wp_customize,
                'instagram_text',
                array(
                    'section'     => 'instagram_settings',
                    'description' => sprintf( __( 'Please install and activate the recommended plugin %1$sBlossomThemes Social Feed%2$s. After that option related with this section will be visible.', 'vandana-lite' ), '<a href="' . esc_url( admin_url( 'themes.php?page=tgmpa-install-plugins' ) ) . '" target="_blank">', '</a>' )
                )
            )
        );
    }

    /** Instagram Settings End */

    /** Miscellaneous Settings */
    $wp_customize->add_section(
        'misc_settings',
        array(
            'title'    => __( 'Misc Settings', 'vandana-lite' ),
            'priority' => 85,
            'panel'    => 'general_settings',
        )
    );

    /** Shop Page Description */
    $wp_customize->add_setting( 
        'ed_shop_archive_description', 
        array(
            'default'           => false,
            'sanitize_callback' => 'vandana_lite_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Vandana_Lite_Toggle_Control( 
            $wp_customize,
            'ed_shop_archive_description',
            array(
                'section'         => 'misc_settings',
                'label'           => __( 'Shop Page Description', 'vandana-lite' ),
                'description'     => __( 'Enable to show Shop Page Description.', 'vandana-lite' ),
                'active_callback' => 'vandana_lite_is_woocommerce_activated'
            )
        )
    );
    
    /** $shop_archive_description */
    $wp_customize->add_setting( 
        'shop_archive_description', 
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post'
        ) 
    );
    
    $wp_customize->add_control(
        'shop_archive_description',
        array(
            'section'         => 'misc_settings',
            'label'           => __( 'Description For Shop Page', 'vandana-lite' ),
            'description'     => __( 'Write new description for Shop Page to overwrite the default description.', 'vandana-lite' ),
            'type'            => 'textarea',
            'active_callback' => 'vandana_lite_shop_description_ac'
        )
    );

    $wp_customize->add_setting(
        'ed_elementor',
        array(
            'default'           => false,
            'sanitize_callback' => 'vandana_lite_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        new Vandana_Lite_Toggle_Control( 
            $wp_customize,
            'ed_elementor',
            array(
                'section'       => 'misc_settings',
                'label'         => __( 'Enable Elementor Page Builder in FrontPage', 'vandana-lite' ),
                'description'   => __( 'You can override your Homepage Contents from this Elementor Page Builder', 'vandana-lite' ),
            )
        )
    );
    /** Misc Settings End */
}
add_action( 'customize_register', 'vandana_lite_customize_register_general' );