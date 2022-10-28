<?php
/**
 * Vandana LiteTemplate Functions which enhance the theme by hooking into WordPress
 *
 * @package Vandana_Lite
 */

if( ! function_exists( 'vandana_lite_doctype' ) ) :
/**
 * Doctype Declaration
*/
function vandana_lite_doctype(){ ?>
    <!DOCTYPE html>
    <html <?php language_attributes(); ?>>
    <?php
}
endif;
add_action( 'vandana_lite_doctype', 'vandana_lite_doctype' );

if( ! function_exists( 'vandana_lite_head' ) ) :
/**
 * Before wp_head 
*/
function vandana_lite_head(){ ?>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php
}
endif;
add_action( 'vandana_lite_before_wp_head', 'vandana_lite_head' );

if( ! function_exists( 'vandana_lite_page_start' ) ) :
/**
 * Page Start
*/
function vandana_lite_page_start(){ ?>
    <div id="page" class="site">
        <a class="skip-link" href="#content"><?php esc_html_e( 'Skip to Content', 'vandana-lite' ); ?></a>
    <?php
}
endif;
add_action( 'vandana_lite_before_header', 'vandana_lite_page_start', 20 );

if( ! function_exists( 'vandana_lite_sticky_bar' ) ) :
/**
 * Promotional Block 
*/
function vandana_lite_sticky_bar(){

    $ed_notification_bar    = get_theme_mod( 'notification_bar_area', false );
    $notification_text      = get_theme_mod( 'notification_text', __( 'By continuing to use this site, you agree to the use of cookies.  ', 'vandana-lite' ) );
    $btn_label    = get_theme_mod( 'notification_btn_label', __( 'Find out more', 'vandana-lite' ) );
    $btn_url      = get_theme_mod( 'notification_btn_url', '#' );
    $new_tab      = get_theme_mod( 'ed_open_new_target', false );

    if( $ed_notification_bar && $notification_text ) { ?>
        <div class="sticky-t-bar active">
            <div class="sticky-bar-content">
                <div class="container">
                    <?php  
                    echo esc_html( $notification_text ); 

                    $target = $new_tab ? ' target="_blank"' : '';

                    if( $btn_label && $btn_url ) echo '<a class="btn-readmore" href="' . esc_url( $btn_url ) . '"' . $target . '>' . esc_html( $btn_label ) . '</a>'; ?> 
                </div>
            </div>
            <button class="close"></button>
        </div><?php 
    }
}
endif;
add_action( 'vandana_lite_header', 'vandana_lite_sticky_bar', 10 );

if( ! function_exists( 'vandana_lite_header' ) ) :
/**
 * Header Start
*/
function vandana_lite_header(){ 
    
    $ed_cart   = get_theme_mod( 'ed_shopping_cart', true );
    $ed_search = get_theme_mod( 'ed_header_search', true ); 
    ?>

    <header id="masthead" class="site-header style-one" itemscope itemtype="https://schema.org/WPHeader">
        <div class="header-t">
            <div class="container">
                <?php vandana_lite_secondary_navigation(); ?>
            </div>
        </div>
        <div class="header-mid">
            <div class="container">
                <div class="header-left">
                    <?php vandana_lite_social_links(); ?>
                </div>
                <?php vandana_lite_site_branding(); ?>
                <div class="header-right">
                    <?php if( vandana_lite_is_woocommerce_activated() && $ed_cart ){
                        echo '<div class="header-cart">';
                        vandana_lite_wc_cart_count();
                        echo '</div>';
                    }
                    if( $ed_search ) vandana_lite_form_section(); 
                    ?>
                </div>
            </div>
        </div>
        <div class="header-bottom">
            <div class="container">
                <?php vandana_lite_primary_navigation(); ?>
            </div>
        </div>
    </header>
    <?php vandana_lite_mobile_header();
    }
endif;
add_action( 'vandana_lite_header', 'vandana_lite_header', 20 );

if( ! function_exists( 'vandana_lite_content_start' ) ) :
/**
 * Content Start
 * 
*/
function vandana_lite_content_start(){       
    $home_sections = vandana_lite_get_home_sections(); 
    if( ! ( is_front_page() && ! is_home() && $home_sections ) ){ //Make necessary adjust for pg template.
        echo '<div id="content" class="site-content">'; 
        if( ! is_front_page() ) vandana_lite_breadcrumb(); 
        if( is_singular( 'post' ) ) vandana_lite_single_entry_header();
        echo '<div class="container">';
    }
}
endif;
add_action( 'vandana_lite_content', 'vandana_lite_content_start' );

if( ! function_exists( 'vandana_lite_page_header' ) ) :
/**
 * Page Header
*/
function vandana_lite_page_header(){ ?>
    <div class="page-header">
        <?php                    
            if( is_archive() ){ 
                if( is_author() ){
                    $author_title = get_the_author();
                    $author_description = get_the_author_meta( 'description' ); ?>
                    <div class="author-section">
                        <figure class="author-img"><?php get_avatar( get_the_author_meta( 'ID' ), 170 ); ?></figure>
                        <div class="author-content-wrap">
                            <?php 
                                echo '<h3 class="author-name">' . esc_html( $author_title ) . '</h3>';
                                echo '<div class="author-content">' . wp_kses_post( wpautop( $author_description ) ) . '</div>';
                            ?>      
                        </div>
                    </div>
                    <?php 
                }
                else{
                    the_archive_title();
                    the_archive_description( '<div class="archive-description">', '</div>' );
                }             
            }

            if( is_page() ){
                the_title( '<h1 class="page-title">', '</h1>' );
            }
            
            if( is_search() ){ 
                global $wp_query;
                echo '<span class="sub-title">' . esc_html__( 'Search Results For:', 'vandana-lite' ) . '</span>';
                get_search_form();
            }
        ?>
    </div>
<?php vandana_lite_posts_per_page_count();
}
endif;
add_action( 'vandana_lite_before_posts_content', 'vandana_lite_page_header' );

if( ! function_exists( 'vandana_lite_entry_header' ) ) :
/**
 * Entry Header
*/
function vandana_lite_entry_header(){ 
    
    if( is_singular( 'post' ) ) return false; ?>

    <header class="entry-header">
		<?php                         
            if( 'post' === get_post_type() ){
                echo '<div class="entry-meta">';
                vandana_lite_posted_on();
                vandana_lite_comment_count();
                vandana_lite_category(); 
                echo '</div>';
            }

            if ( is_singular() ) :
    			the_title( '<h1 class="entry-title">', '</h1>' );
    		else :
    			the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
    		endif; 
		?>
	</header>         
    <?php    
}
endif;
add_action( 'vandana_lite_post_entry_content', 'vandana_lite_entry_header', 10 );

if ( ! function_exists( 'vandana_lite_post_thumbnail' ) ) :
/**
 * Displays an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 */
function vandana_lite_post_thumbnail() {
    $image_size  = 'thumbnail';
    
    if( is_home() || is_archive() || is_search() ){ 
        $image_size = vandana_lite_blog_image_size();       
        echo '<figure class="post-thumbnail"><a href="' . esc_url( get_permalink() ) . '">';
        if( has_post_thumbnail() ){                        
            the_post_thumbnail( $image_size, array( 'itemprop' => 'image' ) );    
        }else{
            vandana_lite_get_fallback_svg( $image_size );  
        }        
        echo '</a>';  
        echo '</figure>';
    }

    if( is_page() ){
        if( has_post_thumbnail() ){                        
            the_post_thumbnail( 'vandana-lite-blog-full', array( 'itemprop' => 'image' ) );    
        }
    }
}
endif;
add_action( 'vandana_lite_before_page_entry_content', 'vandana_lite_post_thumbnail' );
add_action( 'vandana_lite_before_post_entry_content', 'vandana_lite_post_thumbnail', 10 );

if( ! function_exists( 'vandana_lite_entry_content' ) ) :
/**
 * Entry Content
*/
function vandana_lite_entry_content(){ 
    $ed_excerpt = get_theme_mod( 'ed_excerpt', true );?>
    <div class="entry-content" itemprop="text">
		<?php
			if( is_singular() || ! $ed_excerpt || ( get_post_format() != false ) ){
                the_content();    
    			wp_link_pages( array(
    				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'vandana-lite' ),
    				'after'  => '</div>',
    			) );
            }else{
                the_excerpt();
            }
        ?>
	</div><!-- .entry-content -->
    <?php

}
endif;
add_action( 'vandana_lite_page_entry_content', 'vandana_lite_entry_content', 15 );
add_action( 'vandana_lite_post_entry_content', 'vandana_lite_entry_content', 15 );

if( ! function_exists( 'vandana_lite_entry_footer' ) ) :
/**
 * Entry Footer
*/
function vandana_lite_entry_footer(){ 
    $readmore = get_theme_mod( 'read_more_text', __( 'Read More', 'vandana-lite' ) );
    $ed_tags = get_theme_mod( 'ed_tags', false ); ?>
	<footer class="entry-footer">
		<?php
			if( is_single() && !$ed_tags ){
			    vandana_lite_tag();
			}
            
            if( is_home() || is_archive() || is_search() ){
                echo '<a href="' . esc_url( get_the_permalink() ) . '" class="readmore-link">' . esc_html( $readmore ) . '</a>';    
            }
            
            if( get_edit_post_link() ){
                edit_post_link(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Edit <span class="screen-reader-text">%s</span>', 'vandana-lite' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					),
					'<span class="edit-link">',
					'</span>'
				);
            }
		?>
	</footer><!-- .entry-footer -->
	<?php 
}
endif;
add_action( 'vandana_lite_page_entry_content', 'vandana_lite_entry_footer', 20 );
add_action( 'vandana_lite_post_entry_content', 'vandana_lite_entry_footer', 20 );

if( ! function_exists( 'vandana_lite_navigation' ) ) :
/**
 * Navigation
*/
function vandana_lite_navigation(){
    if( is_singular( 'post' ) ){
        $next_post = get_next_post();
        $prev_post = get_previous_post();

        if( $prev_post || $next_post ){?>            
            <nav class="post-navigation pagination" role="navigation">
                <h2 class="screen-reader-text"><?php esc_html_e( 'Post Navigation', 'vandana-lite' ); ?></h2>
                <div class="nav-links">
                    <?php if( $prev_post ){ ?>
                    <div class="nav-previous">
                        <a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>" rel="prev">
                            <span class="meta-nav"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M152.485 396.284l19.626-19.626c4.753-4.753 4.675-12.484-.173-17.14L91.22 282H436c6.627 0 12-5.373 12-12v-28c0-6.627-5.373-12-12-12H91.22l80.717-77.518c4.849-4.656 4.927-12.387.173-17.14l-19.626-19.626c-4.686-4.686-12.284-4.686-16.971 0L3.716 247.515c-4.686 4.686-4.686 12.284 0 16.971l131.799 131.799c4.686 4.685 12.284 4.685 16.97-.001z"></path></svg><?php esc_html_e( ' Previous Post', 'vandana-lite' ); ?></span>
                            <figure class="post-img">
                                <?php
                                $prev_img = get_post_thumbnail_id( $prev_post->ID );
                                if( $prev_img ){
                                    $prev_url = wp_get_attachment_image_url( $prev_img, 'thumbnail' );
                                    echo '<img src="' . esc_url( $prev_url ) . '" alt="' . the_title_attribute( 'echo=0', $prev_post ) . '">';                                        
                                }else{
                                    vandana_lite_get_fallback_svg( 'thumbnail' );
                                }
                                ?>
                            </figure>
                            <span class="post-title"><?php echo esc_html( get_the_title( $prev_post->ID ) ); ?></span>
                        </a>
                    </div>
                    <?php } ?>
                    <?php if( $next_post ){ ?>
                    <div class="nav-next">
                        <a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" rel="next">
                            <span class="meta-nav"><?php esc_html_e( 'Next Post ', 'vandana-lite' ); ?><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M295.515 115.716l-19.626 19.626c-4.753 4.753-4.675 12.484.173 17.14L356.78 230H12c-6.627 0-12 5.373-12 12v28c0 6.627 5.373 12 12 12h344.78l-80.717 77.518c-4.849 4.656-4.927 12.387-.173 17.14l19.626 19.626c4.686 4.686 12.284 4.686 16.971 0l131.799-131.799c4.686-4.686 4.686-12.284 0-16.971L312.485 115.716c-4.686-4.686-12.284-4.686-16.97 0z"></path></svg></span>
                            <figure class="post-img">
                                <?php
                                $next_img = get_post_thumbnail_id( $next_post->ID );
                                if( $next_img ){
                                    $next_url = wp_get_attachment_image_url( $next_img, 'thumbnail' );
                                    echo '<img src="' . esc_url( $next_url ) . '" alt="' . the_title_attribute( 'echo=0', $next_post ) . '">';                                        
                                }else{
                                    vandana_lite_get_fallback_svg( 'thumbnail' );
                                }
                                ?>
                            </figure>
                            <span class="post-title"><?php echo esc_html( get_the_title( $next_post->ID ) ); ?></span>
                        </a>
                    </div>
                    <?php } ?>
                </div>
            </nav>        
            <?php
        }
    }else{    
        the_posts_pagination( array(
            'prev_text'          => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path fill="currentColor" d="M231.293 473.899l19.799-19.799c4.686-4.686 4.686-12.284 0-16.971L70.393 256 251.092 74.87c4.686-4.686 4.686-12.284 0-16.971L231.293 38.1c-4.686-4.686-12.284-4.686-16.971 0L4.908 247.515c-4.686 4.686-4.686 12.284 0 16.971L214.322 473.9c4.687 4.686 12.285 4.686 16.971-.001z"></path></svg>',
            'next_text'          => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path fill="currentColor" d="M24.707 38.101L4.908 57.899c-4.686 4.686-4.686 12.284 0 16.971L185.607 256 4.908 437.13c-4.686 4.686-4.686 12.284 0 16.971L24.707 473.9c4.686 4.686 12.284 4.686 16.971 0l209.414-209.414c4.686-4.686 4.686-12.284 0-16.971L41.678 38.101c-4.687-4.687-12.285-4.687-16.971 0z"></path></svg>',
            'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'vandana-lite' ) . ' </span>',
        ) );
    }
}
endif;
add_action( 'vandana_lite_after_post_content', 'vandana_lite_navigation', 30 );
add_action( 'vandana_lite_after_posts_content', 'vandana_lite_navigation' );

if( ! function_exists( 'vandana_lite_author' ) ) :
/**
 * Author Section
*/
function vandana_lite_author(){ 
    $ed_author    = get_theme_mod( 'ed_author', false );
    $author_title = get_the_author();
    if( ! $ed_author && get_the_author_meta( 'description' ) ){ ?>
    <div class="author-section">
		<figure class="author-img">
            <?php echo get_avatar( get_the_author_meta( 'ID' ), 170 ); 
            if( $author_title ) echo '<h3 class="author-name">' . esc_html( $author_title ) . '</h3>';
            ?>
        </figure>
		<div class="author-content-wrap">
			<?php 
                echo '<div class="author-content">' . wp_kses_post( wpautop( get_the_author_meta( 'description' ) ) ) . '</div>';
            ?>		
		</div>
	</div>
    <?php
    }
}
endif;
add_action( 'vandana_lite_after_post_content', 'vandana_lite_author', 25 );

if( ! function_exists( 'vandana_lite_newsletter_single' ) ) :
/**
 * Newsletter
*/
function vandana_lite_newsletter_single(){ 
    $ed_newsletter = get_theme_mod( 'ed_single_newsletter', false );
    $newsletter    = get_theme_mod( 'newsletter_shortcode' );
    if( $ed_newsletter && $newsletter ){ ?>
        <div class="newsletter-block">
            <?php echo do_shortcode( $newsletter ); ?>
        </div>
        <?php
    }
}
endif;
add_action( 'vandana_lite_after_post_content', 'vandana_lite_newsletter_single', 32 );

if( ! function_exists( 'vandana_lite_related_posts' ) ) :
/**
 * Related Posts 
*/
function vandana_lite_related_posts(){ 
    $ed_related_post = get_theme_mod( 'ed_related', true );
    
    if( $ed_related_post ){
        vandana_lite_get_posts_list( 'related' );    
    }
}
endif;                                                                               
add_action( 'vandana_lite_after_post_content', 'vandana_lite_related_posts', 35 );

if( ! function_exists( 'vandana_lite_latest_posts' ) ) :
/**
 * Latest Posts
*/
function vandana_lite_latest_posts(){ 
    vandana_lite_get_posts_list( 'latest' );
}
endif;
add_action( 'vandana_lite_latest_posts', 'vandana_lite_latest_posts' );

if( ! function_exists( 'vandana_lite_comment' ) ) :
/**
 * Comments Template 
*/
function vandana_lite_comment(){
    // If comments are open or we have at least one comment, load up the comment template.
	if( get_theme_mod( 'ed_comments', true ) && ( comments_open() || get_comments_number() ) ) :
		comments_template();
	endif;
}
endif;
add_action( 'vandana_lite_after_post_content', 'vandana_lite_comment', vandana_lite_comment_toggle() );
add_action( 'vandana_lite_after_page_content', 'vandana_lite_comment' );

if( ! function_exists( 'vandana_lite_content_end' ) ) :
/**
 * Content End
*/
function vandana_lite_content_end(){ 
    $home_sections = vandana_lite_get_home_sections(); 
    if( ! ( is_front_page() && ! is_home() && $home_sections ) ){ ?>         
        </div><!-- .container -->        
    </div><!-- .site-content -->
    <?php
    }
}
endif;
add_action( 'vandana_lite_before_footer', 'vandana_lite_content_end', 20 );

if( ! function_exists( 'vandana_lite_instagram' ) ) :
/**
 * Blossom Instagram
*/
function vandana_lite_instagram(){
    if( vandana_lite_is_btif_activated() ){
        $ed_instagram = get_theme_mod( 'ed_instagram', false );
        if( $ed_instagram ){
            echo '<div class="instagram-section">';
            echo do_shortcode( '[blossomthemes_instagram_feed]' );
            echo '</div>';    
        }
    }
}
endif;
add_action( 'vandana_lite_before_footer_start', 'vandana_lite_instagram', 10 );

if( ! function_exists( 'vandana_lite_newsletter' ) ) :
/**
 * Blossom Newsletter
*/
function vandana_lite_newsletter(){
    $ed_newsletter = get_theme_mod( 'ed_newsletter', false );
    $newsletter = get_theme_mod( 'newsletter_shortcode' );

    if( $ed_newsletter && !empty( $newsletter ) && !is_single() ){
        echo '<section class="newsletter-section">';
        echo do_shortcode( $newsletter );   
        echo '</section>';            
    }

}
endif;
add_action( 'vandana_lite_before_footer_start', 'vandana_lite_newsletter', 20 );

if( ! function_exists( 'vandana_lite_footer_start' ) ) :
/**
 * Footer Start
*/
function vandana_lite_footer_start(){
    ?>
    <footer id="colophon" class="site-footer" itemscope itemtype="https://schema.org/WPFooter">
    <?php
}
endif;
add_action( 'vandana_lite_footer', 'vandana_lite_footer_start', 20 );

if( ! function_exists( 'vandana_lite_footer_top' ) ) :
/**
 * Footer Top
*/
function vandana_lite_footer_top(){    
    $footer_sidebars = array( 'footer-one', 'footer-two', 'footer-three', 'footer-four' );
    $active_sidebars = array();
    $sidebar_count   = 0;
    
    foreach ( $footer_sidebars as $sidebar ) {
        if( is_active_sidebar( $sidebar ) ){
            array_push( $active_sidebars, $sidebar );
            $sidebar_count++ ;
        }
    }
                 
    if( $active_sidebars ){ ?>
        <div class="footer-t">
    		<div class="container">
    			<div class="grid column-<?php echo esc_attr( $sidebar_count ); ?>">
                <?php foreach( $active_sidebars as $active ){ ?>
    				<div class="col">
    				   <?php dynamic_sidebar( $active ); ?>	
    				</div>
                <?php } ?>
                </div>
    		</div>
    	</div>
        <?php 
    }
}
endif;
add_action( 'vandana_lite_footer', 'vandana_lite_footer_top', 30 );

if( ! function_exists( 'vandana_lite_footer_bottom' ) ) :
/**
 * Footer Bottom
*/
function vandana_lite_footer_bottom(){ ?>
    <div class="footer-b">
		<div class="container">
			<div class="site-info">            
            <?php
                vandana_lite_get_footer_copyright();
                echo esc_html__( ' Vandana Lite | Developed By ', 'vandana-lite' ); 
                echo '<a href="' . esc_url( 'https://blossomthemes.com/' ) .'" rel="nofollow" target="_blank">' . esc_html__( 'Blossom Themes', 'vandana-lite' ) . '</a>.';                
                printf( esc_html__( ' Powered by %s. ', 'vandana-lite' ), '<a href="'. esc_url( __( 'https://wordpress.org/', 'vandana-lite' ) ) .'" target="_blank">WordPress</a>' );
                if( function_exists( 'the_privacy_policy_link' ) ){
                    the_privacy_policy_link();
                }
            ?>               
            </div>
            <?php vandana_lite_footer_navigation(); ?>
		</div>
	</div>
    <?php
}
endif;
add_action( 'vandana_lite_footer', 'vandana_lite_footer_bottom', 40 );

if( ! function_exists( 'vandana_lite_back_to_top' ) ) :
/**
 * Back to top
*/
function vandana_lite_back_to_top(){ ?>
    <button class="back-to-top">
        <i class="fas fa-angle-up"></i>
        <span class="to-top"><?php esc_html_e( 'Top', 'vandana-lite' ); ?></span>
    </button>
    <?php
}
endif;
add_action( 'vandana_lite_footer', 'vandana_lite_back_to_top', 45 );

if( ! function_exists( 'vandana_lite_footer_end' ) ) :
/**
 * Footer End 
*/
function vandana_lite_footer_end(){ ?>
    </footer><!-- #colophon -->
    <?php
}
endif;
add_action( 'vandana_lite_footer', 'vandana_lite_footer_end', 50 );

if( ! function_exists( 'vandana_lite_page_end' ) ) :
/**
 * Page End
*/
function vandana_lite_page_end(){ ?>
    </div><!-- #page -->
    <?php
}
endif;
add_action( 'vandana_lite_after_footer', 'vandana_lite_page_end', 20 );