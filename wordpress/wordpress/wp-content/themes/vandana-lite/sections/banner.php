<?php
/**
 * Banner Section
 * 
 * @package Vandana_Lite
 */

$ed_banner        = get_theme_mod( 'ed_banner_section', 'static_nl_banner' );
$slider_type      = get_theme_mod( 'slider_type', 'latest_posts' ); 
$slider_cat       = get_theme_mod( 'slider_cat' );
$posts_per_page   = get_theme_mod( 'no_of_slides', 3 );
$ed_caption       = get_theme_mod( 'slider_caption', true );
$read_more        = get_theme_mod( 'slider_readmore', __( 'Read More', 'vandana-lite' ) );
$banner_newsletter = get_theme_mod( 'banner_newsletter' );
        
if( ( $ed_banner == 'static_nl_banner' ) && has_custom_header() ){ ?>
    <div id="banner_section" class="site-banner static-cta caption-right style-three<?php if( has_header_video() ) echo esc_attr( ' video-banner' ); ?> static-newsletter">
        <div class="item">
            <?php 
                the_custom_header_markup();  
                if( $ed_banner == 'static_nl_banner' && $banner_newsletter ){
                    echo '<div class="banner-caption"><div class="container">';
                    echo do_shortcode( wp_kses_post( $banner_newsletter ) );
                    echo '</div></div>';
                }  
            ?>
        </div>
    </div>
<?php
}elseif( $ed_banner == 'slider_banner' ){
    if( $slider_type == 'latest_posts' || $slider_type == 'cat' ){
        $image_size = 'vandana-lite-slider';
        $args = array(
            'post_status'         => 'publish',            
            'ignore_sticky_posts' => true
        );
        
        if( $slider_type === 'cat' && $slider_cat ){
            $args['post_type']      = 'post';
            $args['cat']            = $slider_cat; 
            $args['posts_per_page'] = -1;  
        }else{
            $args['post_type']      = 'post';
            $args['posts_per_page'] = $posts_per_page;
        }
            
        $qry = new WP_Query( $args );
        
        if( $qry->have_posts() ){ ?>
            <div id="banner_section" class="site-banner slider-one">
                <div class="item-wrapper owl-carousel">            
        			<?php while( $qry->have_posts() ){ $qry->the_post(); ?>
                    <div class="item">
                        <div class="container">
                            <?php 
                            if( has_post_thumbnail() ){
            				    echo '<div class="slider-img">';
                				the_post_thumbnail( $image_size, array( 'itemprop' => 'image' ) );    
                                echo '</div>';
                            } ?>
                            <div class="banner-caption">
                                <?php if( $ed_caption ){
                                    the_title( '<h2 class="title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
                                    ?>
                                    <div class="banner-desc"><?php the_excerpt(); ?></div>
                                    <?php if( $read_more ) {
                                        echo '<div class="button-wrap">';
                                        echo '<a class="btn-readmore btn-1" href="' . esc_url( get_the_permalink() ) . '" class="btn-more">' . esc_html( $read_more ) . '</a>';
                                        echo '</div>';
                                    }
                                } ?>
                            </div>
                        </div>
        			</div>
        			<?php } ?>
                </div>                        
    		</div>                
        <?php
        }
        wp_reset_postdata();
    }
}