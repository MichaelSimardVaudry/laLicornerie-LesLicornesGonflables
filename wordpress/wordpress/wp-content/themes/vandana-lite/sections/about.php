<?php
/**
 * About Section
 * 
 * @package Vandana_Lite
 */
$ed_about_section = get_theme_mod( 'ed_about_section', false );
$about_page   	  = get_theme_mod( 'about_page' );
$about_readmore   = get_theme_mod( 'about_readmore', __( 'Know More', 'vandana-lite' ) );
$about_excerpt    = get_theme_mod( 'about_excerpt', true ); 

if( !$ed_about_section ) return false;
if( empty( $about_page ) ) return false;

$args = array(
    'post_type'   => 'page',
    'page_id'	  => $about_page,
);

$about_qry = new WP_Query( $args );

if( $about_qry->have_posts() ){ ?>

<section id="about_section" class="about-section style-one">
	<div class="container">
		<?php while( $about_qry->have_posts() ){ $about_qry->the_post(); ?>
	    	<figure class="section-img">
	            <?php 
	                if( has_post_thumbnail() ){
	                    the_post_thumbnail( 'vandana-lite-about', array( 'itemprop' => 'image' ) );
	                }else{ 
	                    vandana_lite_get_fallback_svg( 'vandana-lite-about' );
	                }                            
	            ?>                        
	        </figure>
			<div class="section-content-wrap">
				<?php the_title( '<h2 class="section-title">', '</h2>' ); 
				echo '<div class="section-content">';
					if( $about_excerpt ) :
						the_excerpt();
					else:
						the_content();
					endif; ?>
				</div>
				<?php if( $about_readmore && $about_excerpt  ){ ?>
                    <div class="button-wrap"><a href="<?php the_permalink(); ?>" class="btn-readmore"><?php echo esc_html( $about_readmore );?></a></div>
                    <?php
                } ?>
			</div> 
		<?php } ?>
    </div>
</section> <!-- .about-section -->
<?php
}
wp_reset_postdata();