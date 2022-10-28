<?php
/**
 * Vandana Lite Widget Areas
 * 
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 * @package Vandana_Lite
 */

function vandana_lite_widgets_init(){    
    $sidebars = array(
        'sidebar'   => array(
            'name'        => __( 'Sidebar', 'vandana-lite' ),
            'id'          => 'sidebar', 
            'description' => __( 'Default Sidebar', 'vandana-lite' ),
        ),
        'client' => array(
            'name'        => __( 'Client Section', 'vandana-lite' ),
            'id'          => 'client', 
            'description' => __( 'Add "Blossom: Client Logo Widget" for client section.', 'vandana-lite' ),
        ),
        'promotional' => array(
            'name'        => __( 'Promotional Section', 'vandana-lite' ),
            'id'          => 'promotional', 
            'description' => __( 'Add "Blossom: Image Text" widget for promotional section. Recommended image size for this section is square image of 377px by 377 px.', 'vandana-lite' ),
        ),
        'cta' => array(
            'name'        => __( 'Call To Action Section', 'vandana-lite' ),
            'id'          => 'cta', 
            'description' => __( 'Add "Blossom: Call To Action" widget for call to action section.', 'vandana-lite' ),
        ),
        'service' => array(
            'name'        => __( 'Service Section', 'vandana-lite' ),
            'id'          => 'service', 
            'description' => __( 'Add "Text" & "Blossom: Icon Text" widget for service section.', 'vandana-lite' ),
        ),
        'testimonial' => array(
            'name'        => __( 'Testimonial Section', 'vandana-lite' ),
            'id'          => 'testimonial', 
            'description' => __( 'Add "Blossom: Testimonial" widget for testimonial section.', 'vandana-lite' ),
        ),
        'contact' => array(
            'name'        => __( 'Contact Section', 'vandana-lite' ),
            'id'          => 'contact', 
            'description' => __( 'Add "Blossom: Contact Widget", "Custom HTML ( for map ) or Image" & "Text" widgets for contact section.', 'vandana-lite' ),
        ),
        'footer-one'=> array(
            'name'        => __( 'Footer One', 'vandana-lite' ),
            'id'          => 'footer-one', 
            'description' => __( 'Add footer one widgets here.', 'vandana-lite' ),
        ),
        'footer-two'=> array(
            'name'        => __( 'Footer Two', 'vandana-lite' ),
            'id'          => 'footer-two', 
            'description' => __( 'Add footer two widgets here.', 'vandana-lite' ),
        ),
        'footer-three'=> array(
            'name'        => __( 'Footer Three', 'vandana-lite' ),
            'id'          => 'footer-three', 
            'description' => __( 'Add footer three widgets here.', 'vandana-lite' ),
        ),
        'footer-four'=> array(
            'name'        => __( 'Footer Four', 'vandana-lite' ),
            'id'          => 'footer-four', 
            'description' => __( 'Add footer four widgets here.', 'vandana-lite' ),
        )
    );
    
    foreach( $sidebars as $sidebar ){
        register_sidebar( array(
    		'name'          => esc_html( $sidebar['name'] ),
    		'id'            => esc_attr( $sidebar['id'] ),
    		'description'   => esc_html( $sidebar['description'] ),
    		'before_widget' => '<section id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</section>',
    		'before_title'  => '<h2 class="widget-title" itemprop="name">',
    		'after_title'   => '</h2>',
    	) );
    }
    
}
add_action( 'widgets_init', 'vandana_lite_widgets_init' );