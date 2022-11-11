<?php
function bootstrap_photography_dynamic_css() {
        wp_enqueue_style(
                'bootstrap-photography-dynamic-css', get_template_directory_uri() . '/css/dynamic.css'
        );

        $site_title_color = esc_attr( get_theme_mod( 'site_title_color_option', '#4169e1' ) );
        $site_title_size = absint( get_theme_mod( 'site_title_size', '30') );
        $logo_size = absint( $site_title_size * 2 );

        $header_bg_colors = esc_attr( get_theme_mod( 'header_bg_colors', '#fff' ) );
        $header_text_colors = esc_attr( get_theme_mod( 'header_text_colors', '#ff0000' ) );

        $container_width = esc_attr( get_theme_mod( 'container_width', 1140 ) );

        $menu_dropdown_bg_colors = esc_attr( get_theme_mod( 'menu_dropdown_bg_colors', '#999' ) );

        $footer_bg_colors = esc_attr( get_theme_mod( 'footer_bg_colors', '#f5f5f5' ) );
        $footer_text_colors = esc_attr( get_theme_mod( 'footer_text_colors', '#999' ) );
        $footer_title_colors = esc_attr( get_theme_mod( 'footer_title_colors', '#000' ) );
        $footer_link_colors = esc_attr( get_theme_mod( 'footer_link_colors', '#000' ) );

        $font_family = esc_attr( get_theme_mod( 'font_family', 'Montserrat' ) );
        

        $dynamic_css = "
                /* Site Title Colors */
                .site-title a{color: $site_title_color;}

                /* site title size */
                .site-title{font-size: $site_title_size"."px; }

                header .custom-logo{ height: {$logo_size}"."px; }

                /* Header background Colors */
                .site-header{background-color: $header_bg_colors;}
               
                /* Header text Colors */
                .main-navigation ul li a{color: $header_text_colors;}

                .container{ max-width: {$container_width}"."px; }

                /* font family */
                body{font-family: $font_family; }

                /*Dropdown Menu bg color */
                .main-navigation .nav-menu .sub-menu{background-color: $menu_dropdown_bg_colors;}

                /* Menu bar bg color */
                #nav-icon span{background-color: $header_text_colors;}

                /* Footer background Colors */
                .site-footer{background-color: $footer_bg_colors;}
               
                /* Footer text Colors */
                .site-footer{color: $footer_text_colors;}

                /* Footer title Colors */
                .widget-title{color: $footer_title_colors;}

                /* Footer title Colors */
                .site-footer a{color: $footer_link_colors;}


                /* Main Menu bg color*/
                @media (max-width: 991px){
                .menu.nav-menu{background-color: $header_bg_colors;}
                }

                
        ";
        wp_add_inline_style( 'bootstrap-photography-dynamic-css', $dynamic_css );
}
add_action( 'wp_enqueue_scripts', 'bootstrap_photography_dynamic_css' );
