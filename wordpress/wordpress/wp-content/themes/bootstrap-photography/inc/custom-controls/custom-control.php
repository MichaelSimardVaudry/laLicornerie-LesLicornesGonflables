<?php
if( ! function_exists( 'bootstrap_photography_register_custom_controls' ) ) :
/**
 * Register Custom Controls
*/
function bootstrap_photography_register_custom_controls( $wp_customize ) {
    
    // Load our custom control.
    require_once get_template_directory() . '/inc/custom-controls/slider/class-slider-control.php';

    require_once get_template_directory() . '/inc/custom-controls/radiobtn/class-radio-buttonset-control.php';

    require_once get_template_directory() . '/inc/custom-controls/radioimg/class-radio-image-control.php';

    require_once get_template_directory() . '/inc/custom-controls/notes.php';
            
    // Register the control type.
    $wp_customize->register_control_type( 'Bootstrap_Photography_Slider_Control' );
    $wp_customize->register_control_type( 'Bootstrap_Photography_Buttonset_Control' );
    $wp_customize->register_control_type( 'Bootstrap_Photography_Radio_Image_Control' );
}
endif;
add_action( 'customize_register', 'bootstrap_photography_register_custom_controls' );