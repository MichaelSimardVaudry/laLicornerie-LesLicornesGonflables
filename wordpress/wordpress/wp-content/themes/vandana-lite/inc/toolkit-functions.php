<?php
/**
 * Toolkit Filters
 *
 * @package Vandana_Lite
 */

if( ! function_exists( 'vandana_lite_default_icon_text_size' ) ) :
    function vandana_lite_default_icon_text_size(){
        return 'vandana-lite-service';
    }
endif;
add_filter( 'bttk_icon_img_size', 'vandana_lite_default_icon_text_size' );

if( ! function_exists( 'vandana_lite_featured_page_image_alignment' ) ) :
    function vandana_lite_featured_page_image_alignment(){
        
        $align_array = array(
            'right'     => __( 'Right', 'vandana-lite' ),
            'left'      => __( 'Left', 'vandana-lite' ),
        );
        
        return $align_array;
    }
endif;
add_filter( 'bttk_img_alignment', 'vandana_lite_featured_page_image_alignment' );

if( ! function_exists( 'vandana_lite_cta_image_alignment' ) ) :
    function vandana_lite_cta_image_alignment(){
        
        $align_array = array(
            'right'     => __( 'Right', 'vandana-lite' ),
            'left'      => __( 'Left', 'vandana-lite' ),
            'centered'  => __( 'Centered', 'vandana-lite' )
        );
        
        return $align_array;
    }
endif;
add_filter( 'blossomthemes_cta_button_alignment', 'vandana_lite_cta_image_alignment' );

if( ! function_exists( 'vandana_lite_default_image_text_size' ) ) :
    function vandana_lite_default_image_text_size(){
        return 'vandana-lite-promotion';
    }
endif;
add_filter( 'bttk_it_img_size', 'vandana_lite_default_image_text_size' );

if( ! function_exists( 'vandana_lite_portfolio_single_related_image_size' ) ) :
    function vandana_lite_portfolio_single_related_image_size(){
        return 'vandana-lite-blog-grid';
    }
endif;
add_filter( 'bttk_related_portfolio_image', 'vandana_lite_portfolio_single_related_image_size' );

if( ! function_exists( 'vandana_lite_author_image' ) ) :
    function vandana_lite_author_image(){
       return 'full';
    }
endif;
add_filter( 'author_bio_img_size', 'vandana_lite_author_image' );

if( ! function_exists( 'vandana_lite_defer_js_files' ) ) :
    function vandana_lite_defer_js_files(){
        $defer_js = get_theme_mod( 'ed_defer', false );

        return ( $defer_js ) ? false : true;
    }
endif;
add_filter( 'bttk_public_assets_enqueue', 'vandana_lite_defer_js_files' );
add_filter( 'btif_public_assets_enqueue', 'vandana_lite_defer_js_files' );
add_filter( 'bten_public_assets_enqueue', 'vandana_lite_defer_js_files' );

if( ! function_exists( 'vandana_lite_contact_widget_filter' ) ) :
/**
 * Filter for contact widget
*/
function vandana_lite_contact_widget_filter( $html, $args, $instance ){
    $title       = ! empty( $instance['title'] ) ? $instance['title'] : '';        
    $description = ! empty( $instance['description'] ) ? $instance['description'] : '';        
    $telephone   = ! empty( $instance['telephone'] ) ? $instance['telephone'] : '';        
    $email       = ! empty( $instance['email'] ) ? $instance['email'] : '';        
    $address     = ! empty( $instance['address'] ) ? $instance['address'] : '';
    $follow_on_text     = get_theme_mod( 'follow_on_text', __( 'Follow Us On:', 'vandana-lite' ) );

    ob_start();
    
    if( $title ) echo $args['before_title'] . apply_filters( 'widget_title', $title, $instance ) . $args['after_title']; ?>  

    <div class="bttk-contact-widget-wrap contact-info">
    <?php 
        if( $description !='' ) echo wpautop( wp_kses_post( $description ) ); 
        
        if( $telephone || $email || $address ){ 
            echo '<ul class="contact-list">';
            
            if( $address !='' ) echo '<li><strong class="contact-list-title">' . __( 'Location:', 'vandana-lite' ) . '</strong>' . esc_html( $address ) . '</li>';
            if( $telephone != '' ) echo '<li><strong class="contact-list-title">' . __( 'Contact:', 'vandana-lite' ) . '</strong><span>' . __( 'T:', 'vandana-lite' ) . '</span><a href="' . esc_url( 'tel:' . preg_replace( '/[^\d+]/', '', $telephone ) ) . '">' . esc_html( $telephone ) . '</a></li>';
            if( $email !='' ) echo '<li><span>' . __( 'E:', 'vandana-lite' ) . '</span><a href="' . esc_url( 'mailto:' . sanitize_email( $email ) ) . '">' . esc_html( $email ) . '</a></li>';

            echo '</ul>';
        }
        
        if( isset( $instance['social'] ) && !empty( $instance['social'] ) )
        { 
            $icons = $instance['social']; ?>                
            <ul class="social-networks">
                <?php if( $follow_on_text ) echo '<strong class="contact-list-title">' . esc_html( $follow_on_text ) . '</strong>';

                    $arr_keys  = array_keys( $icons );
                    foreach ( $arr_keys as $key => $value )
                    { 
                        if ( array_key_exists( $value, $instance['social'] ) )
                        { 
                            if( isset( $instance['social'][$value] ) && !empty( $instance['social'][$value] ) )
                            {
                                if( !isset( $instance['social_profile'][$value] ) || ( isset( $instance['social_profile'][$value] ) && $instance['social_profile'][$value] == '' ) )
                                {
                                    $icon = bttk_get_social_icon_name( $instance['social'][$value] );
                                    $class = ( $icon == 'rss' ) ? 'fas fa-'.$icon : 'fab fa-'.$icon;
                                }
                                elseif( isset( $instance['social_profile'][$value] ) && !empty( $instance['social_profile'][$value] ) )
                                {
                                    $icon = $instance['social_profile'][$value] ;
                                    $class = ( $icon == 'rss' ) ? 'fas fa-'.$icon : 'fab fa-'.$icon;
                                }
                                ?>
                                <li class="bttk-contact-social-icon-wrap">
                                    <a <?php if( isset( $instance['target'] ) && $instance['target'] == '1' ){ echo "target=_blank"; } ?> href="<?php echo esc_url( $instance['social'][$value] );?>">
                                        <span class="bttk-contact-social-links-field-handle"><i class="<?php echo esc_attr( $class );?>"></i></span>
                                    </a>
                                </li>
                            <?php
                            }
                        }
                    }
                ?>
            </ul>
            <?php 
        } 
        ?>
    </div>
    <?php
    $html = ob_get_clean();
    return $html;
}
endif;
add_filter( 'blossom_contact_widget_filter', 'vandana_lite_contact_widget_filter', 10, 3 );

if( ! function_exists( 'vandana_lite_testimonial_filter' ) ) :
/**
 * Filter for Testimonial widget
*/
function vandana_lite_testimonial_filter( $html, $args, $instance ){
    $obj = new BlossomThemes_Toolkit_Functions();
    $name        = ! empty( $instance['name'] ) ? $instance['name'] : '' ;        
    $designation = ! empty( $instance['designation'] ) ? $instance['designation'] : '' ;        
    $testimonial = ! empty( $instance['testimonial'] ) ? $instance['testimonial'] : '';
    $image       = ! empty( $instance['image'] ) ? $instance['image'] : '';

    if( $image ){
        /** Added to work for demo testimonial compatible */
        $attachment_id = $image;
        if ( !filter_var( $image, FILTER_VALIDATE_URL ) === false ) {
            $attachment_id = $obj->bttk_get_attachment_id( $image );
        }

        $icon_img_size = 'thumbnail';
    }
    
    ob_start(); 
    ?>
    
        <div class="bttk-testimonial-holder">
            <div class="bttk-testimonial-inner-holder">
                <?php if( $image ){ ?>
                    <div class="img-holder">
                        <?php echo wp_get_attachment_image( $attachment_id, $icon_img_size, false, array( 'alt' => esc_attr( $name )));?>
                    </div>
                <?php }?>
    
                <div class="text-holder">
                    <?php if( $testimonial ) echo '<div class="testimonial-content">' . wpautop( wp_kses_post( $testimonial ) ) . '</div>'; ?>
                </div>
                <div class="testimonial-meta">
                   <?php 
                        if( $name ) echo '<span class="name">' . esc_html( $name ) . '</span>';
                        if( isset( $designation ) && $designation!='' ){
                            echo '<span class="designation">' . esc_html( $designation ) . '</span>';
                        }
                    ?>
                </div>                              
            </div>
        </div>
    <?php 
    $html = ob_get_clean();
    return $html;
}
endif;
add_filter( 'blossom_testimonial_widget_filter', 'vandana_lite_testimonial_filter', 10, 3 );