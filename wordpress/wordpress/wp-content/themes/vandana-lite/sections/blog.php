<?php
/**
 * Blog Section
 * 
 * @package Vandana_Lite
 */

$sec_title      = get_theme_mod( 'blog_section_title', __( 'Latest From The Blog', 'vandana-lite' ) );
$sec_subtitle   = get_theme_mod( 'blog_section_subtitle', __( 'Show your latest blog posts here. You can modify this section from Appearance > Customize > Front Page Settings > Blog Section.', 'vandana-lite' ) );
$blog           = get_option( 'page_for_posts' );
$label          = get_theme_mod( 'blog_view_all', __( 'View All', 'vandana-lite' ) );
$ed_blog_section = get_theme_mod( 'ed_blog_section', true );

$args = array(
    'posts_per_page'      => 3,
    'ignore_sticky_posts' => true
);

$qry = new WP_Query( $args );

if( $ed_blog_section && ( $sec_title || $sec_subtitle || $qry->have_posts() ) ){ ?>
<section id="blog_section" class="blog-section style-one">
	<div class="container">
        
        <?php if( $sec_title || $sec_subtitle ){ ?>
            <header class="section-header">	
                <?php 
                    if( $sec_title ) echo '<h2 class="section-title">' . esc_html( $sec_title ) . '</h2>';
                    if( $sec_subtitle ) echo '<div class="section-content">' . wp_kses_post( wpautop( $sec_subtitle ) ) . '</div>'; 
                ?>
    		</header>
        <?php } ?>
        
        <?php if( $qry->have_posts() ){ ?>
            <div class="section-grid">
    			<?php 
                while( $qry->have_posts() ){
                    $qry->the_post(); ?>
                    <article class="post">
        				<figure class="post-thumbnail">
                            <a href="<?php the_permalink(); ?>">
                            <?php 
                                if( has_post_thumbnail() ){
                                    the_post_thumbnail( 'vandana-lite-blog-sec', array( 'itemprop' => 'image' ) );
                                }else{ 
                                    vandana_lite_get_fallback_svg( 'vandana-lite-blog-sec' );//fallback
                                }                            
                            ?>                        
                            </a>
                            <div class="posted-on"><a href="<?php the_permalink(); ?>"><time class="updated published"><time class="entry-date published"><?php echo esc_html( get_the_date() ); ?></time></time></a></div>
                        </figure>
    					<header class="entry-header">
    						<h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    					</header>
        			</article>			
                <?php } ?>
    		</div>
    		
            <?php if( $blog && $label ){ ?>
                <div class="button-wrap">
        			<a href="<?php the_permalink( $blog ); ?>" class="btn-readmore"><?php echo esc_html( $label ); ?></a>
        		</div>
            <?php } ?>
        
        <?php } wp_reset_postdata(); ?>
	</div>
</section>
<?php 
}