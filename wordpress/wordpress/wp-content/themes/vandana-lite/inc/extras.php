<?php
/**
 * Vandana LiteStandalone Functions.
 *
 * @package Vandana_Lite
 */

if ( ! function_exists( 'vandana_lite_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time.
 */
function vandana_lite_posted_on() {

    $ed_post_date   = get_theme_mod( 'ed_post_date', false );
    if( $ed_post_date ) return false;

	$ed_updated_post_date = get_theme_mod( 'ed_post_update_date', true );
    $on = '';
    
    if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		if( $ed_updated_post_date ){
            $time_string = '<time class="entry-date published updated" datetime="%3$s" itemprop="dateModified">%4$s</time><time class="updated" datetime="%1$s" itemprop="datePublished">%2$s</time>';
            $on = __( 'Updated on ', 'vandana-lite' );		  
		}else{
            $time_string = '<time class="entry-date published" datetime="%1$s" itemprop="datePublished">%2$s</time><time class="updated" datetime="%3$s" itemprop="dateModified">%4$s</time>';  
		}        
	}else{
	   $time_string = '<time class="entry-date published updated" datetime="%1$s" itemprop="datePublished">%2$s</time><time class="updated" datetime="%3$s" itemprop="dateModified">%4$s</time>';   
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);
    
    $posted_on = sprintf( '%1$s %2$s', esc_html( $on ), '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>' );
	
	echo '<span class="posted-on"><i class="fas fa-calendar-alt"></i>' . $posted_on . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'vandana_lite_posted_by' ) ) :
/**
 * Prints HTML with meta information for the current author.
 */
function vandana_lite_posted_by() {
	$ed_post_author   = get_theme_mod( 'ed_post_author', false );
    if( $ed_post_author ) return false;

    $byline = sprintf(
		/* translators: %s: post author. */
		esc_html_x( 'by %s', 'post author', 'vandana-lite' ),
		'<span itemprop="name"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" itemprop="url">' . esc_html( get_the_author() ) . '</a></span>' 
    );
	echo '<span class="byline" itemprop="author" itemscope itemtype="https://schema.org/Person"><i class="fas fa-comment-dots"></i>' . $byline . '</span>';
}
endif;

if( ! function_exists( 'vandana_lite_comment_count' ) ) :
/**
 * Comment Count
*/
function vandana_lite_comment_count(){
    $ed_comments   = get_theme_mod( 'ed_comments', true );

    if ( $ed_comments && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comment-box"><i class="far fa-comment-dots"></i>';
		comments_popup_link(
			sprintf(
				wp_kses(
					/* translators: %s: post title */
					__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'vandana-lite' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			)
		);
		echo '</span>';
	}    
}
endif;

if ( ! function_exists( 'vandana_lite_category' ) ) :
/**
 * Prints categories
 */
function vandana_lite_category(){
	$ed_cat_single  = get_theme_mod( 'ed_category', false );
    // Hide category and tag text for pages.
	if ( 'post' === get_post_type() && !$ed_cat_single  ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( ' ' );
		if ( $categories_list ) {
			echo '<span class="category" itemprop="about">' . $categories_list . '</span>';
		}
	}
}
endif;

if ( ! function_exists( 'vandana_lite_tag' ) ) :
/**
 * Prints tags
 */
function vandana_lite_tag(){
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '' );
		if ( $tags_list ) {
			/* translators: 1: list of tags. */
			printf( '<span class="cat-tags" itemprop="about"><span class="tag-title"><i class="far fa-bookmark"></i></span>' . $tags_list . '</span>' );
		}
	}
}
endif;

if( ! function_exists( 'vandana_lite_get_posts_list' ) ) :
/**
 * Returns Latest, Related & Popular Posts
*/
function vandana_lite_get_posts_list( $status ){
    
    if( !is_singular( 'post' ) ) return false;
    global $post;
    
    $args = array(
        'post_type'           => 'post',
        'posts_status'        => 'publish',
        'ignore_sticky_posts' => true
    );
    
    switch( $status ){
        case 'latest':        
        $args['posts_per_page'] = 3;
        $title                  = __( 'Latest Posts', 'vandana-lite' );
        $class                  = 'additional-post';
        $image_size             = 'vandana-lite-blog-grid';
        break;
        
        case 'related':
        $args['posts_per_page'] = 4;
        $args['post__not_in']   = array( $post->ID );
        $args['orderby']        = 'rand';
        $title                  = get_theme_mod( 'related_post_title', __( 'You may also like', 'vandana-lite' ) );
        $class                  = 'additional-post';
        $image_size             = 'vandana-lite-blog-grid';
        $cats                   = get_the_category( $post->ID );        
        if( $cats ){
            $c = array();
            foreach( $cats as $cat ){
                $c[] = $cat->term_id; 
            }
            $args['category__in'] = $c;
        }
        break;        
        
    }
    
    $qry = new WP_Query( $args );
    
    if( $qry->have_posts() ){ ?>    
        <div class="<?php echo esc_attr( $class ); ?>">
    		<?php 
            if( $title ) echo '<h3 class="post-title">' . esc_html( $title ) . '</h3>'; ?>
            <div class="article-wrap">
			<?php while( $qry->have_posts() ){ $qry->the_post(); ?>
                <article class="post">
                    <figure class="post-thumbnail">
        				<a href="<?php the_permalink(); ?>">
                            <?php
                                if( has_post_thumbnail() ){
                                    the_post_thumbnail( $image_size, array( 'itemprop' => 'image' ) );
                                }else{ 
                                    vandana_lite_get_fallback_svg( $image_size );//fallback
                                }
                            ?>
                        </a>
                    </figure>
    				<header class="entry-header">
                        <div class="entry-meta"><?php vandana_lite_posted_on(); ?></div>
    					<?php
                            the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' );
                        ?>                        
    				</header>
    			</article>
			<?php }?>    		
            </div>
    	</div>
        <?php
    }
    wp_reset_postdata();
}
endif;

if( ! function_exists( 'vandana_lite_site_branding' ) ) :
/**
 * Site Branding
*/
function vandana_lite_site_branding(){ 
    $site_title       = get_bloginfo( 'name' );
    $site_description = get_bloginfo( 'description', 'display' );
    $header_text      = get_theme_mod( 'header_text', 1 );

    if( has_custom_logo() || $site_title || $site_description || $header_text ) :
        if( has_custom_logo() && ( $site_title || $site_description ) && $header_text ) {
            $branding_class = ' has-image-text';
        }else{
            $branding_class = '';
        }?>
        <div class="site-branding<?php echo esc_attr( $branding_class ); ?>" itemscope itemtype="https://schema.org/Organization">  
            <div class="site-logo">
                <?php 
                if( function_exists( 'has_custom_logo' ) && has_custom_logo() ){
                    the_custom_logo();
                }  ?>
            </div>

            <?php 
            if( $site_title || $site_description ) :
                echo '<div class="site-title-wrap">';
                if( is_front_page() ){ ?>
                    <h1 class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>
                    <?php 
                }else{ ?>
                    <p class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url"><?php bloginfo( 'name' ); ?></a></p>
                <?php }
                
                $description = get_bloginfo( 'description', 'display' );
                if ( $description || is_customize_preview() ){ ?>
                    <p class="site-description" itemprop="description"><?php echo $description; ?></p>
                <?php }
                echo '</div>';
            endif; ?>
        </div>    
    <?php endif;
}
endif;

if( ! function_exists( 'vandana_lite_social_links' ) ) :
/**
 * Social Links 
*/
function vandana_lite_social_links( $echo = true ){ 
    $social_links = get_theme_mod( 'social_links' );
    $ed_social    = get_theme_mod( 'ed_social_links', false ); 
    
    if( $ed_social && $social_links && $echo ){ ?>
    <div class="header-social">
        <ul class="social-networks">
        	<?php 
            foreach( $social_links as $link ){
        	   if( $link['link'] ){ ?>
                <li>
                    <a href="<?php echo esc_url( $link['link'] ); ?>" target="_blank" rel="nofollow noopener">
                        <i class="<?php echo esc_attr( $link['font'] ); ?>"></i>
                    </a>
                </li>    	   
                <?php
                } 
            } 
            ?>
    	</ul>
    </div>
    <?php    
    }elseif( $ed_social && $social_links ){
        return true;
    }else{
        return false;
    }
    ?>
    <?php                                
}
endif;

if( ! function_exists( 'vandana_lite_form_section' ) ) :
/**
 * Form Icon
*/
function vandana_lite_form_section(){ ?>
    <div class="header-search">
        <button class="search-toggle" data-toggle-target=".search-modal" data-toggle-body-class="showing-search-modal" data-set-focus=".search-modal .search-field" aria-expanded="false">
            <svg xmlns="http://www.w3.org/2000/svg" width="22.691" height="21.932" viewBox="0 0 22.691 21.932">
                <g id="Group_258" data-name="Group 258" transform="matrix(0.966, -0.259, 0.259, 0.966, -1515.787, 248.902)">
                    <g id="Ellipse_9" data-name="Ellipse 9" transform="translate(1525.802 162.18) rotate(-30)" fill="none" stroke="#6a6a6a" stroke-width="2.5">
                        <circle cx="7.531" cy="7.531" r="7.531" stroke="none"/>
                        <circle cx="7.531" cy="7.531" r="6.281" fill="none"/>
                    </g>
                    <path id="Path_4339" data-name="Path 4339" d="M0,0V7" transform="translate(1540.052 170.724) rotate(-30)" fill="none" stroke="#6a6a6a" stroke-linecap="round" stroke-width="2.5"/>
                </g>
            </svg>
        </button>
        <div class="header-search-wrap search-modal cover-modal" data-modal-target-string=".search-modal">
            <div class="header-search-inner-wrap">
                <?php get_search_form(); ?>
            <button class="close" data-toggle-target=".search-modal" data-toggle-body-class="showing-search-modal" data-set-focus=".search-modal .search-field" aria-expanded="false"></button>
            </div>
        </div>
    </div><!-- .header-search -->
    <?php
}
endif;

if( ! function_exists( 'vandana_lite_primary_navigation' ) ) :
/**
 * Primary Navigation.
*/
function vandana_lite_primary_navigation(){    
    if( current_user_can( 'manage_options' ) || has_nav_menu( 'primary' ) ) { ?>
    	<nav id="site-navigation" class="main-navigation" role="navigation" itemscope itemtype="https://schema.org/SiteNavigationElement">
            <button class="toggle-btn">
                <span class="toggle-bar"></span>
                <span class="toggle-bar"></span>
                <span class="toggle-bar"></span>
            </button>
    		<?php
    			wp_nav_menu( array(
    				'theme_location' => 'primary',
    				'menu_id'        => 'primary-menu',
                    'menu_class'     => 'nav-menu',
                    'fallback_cb'    => 'vandana_lite_primary_menu_fallback',
    			) );
    		?>
    	</nav><!-- #site-navigation -->
    <?php
    }
}
endif;

if( ! function_exists( 'vandana_lite_primary_menu_fallback' ) ) :
/**
 * Fallback for primary menu
*/
function vandana_lite_primary_menu_fallback(){
    if( current_user_can( 'manage_options' ) ){
        echo '<ul id="primary-menu" class="nav-menu">';
        echo '<li><a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '">' . esc_html__( 'Click here to add a menu', 'vandana-lite' ) . '</a></li>';
        echo '</ul>';
    }
}
endif;

if( ! function_exists( 'vandana_lite_secondary_navigation' ) ) :
/**
 * Secondary Navigation
*/
function vandana_lite_secondary_navigation(){ 
    if( current_user_can( 'manage_options' ) || has_nav_menu( 'secondary' ) ) { ?>
    	<nav class="secondary-menu">
            <button class="toggle-btn">
                <span class="toggle-bar"></span>
                <span class="toggle-bar"></span>
                <span class="toggle-bar"></span>
            </button>
            <?php
                wp_nav_menu( array(
                    'theme_location' => 'secondary',
                    'menu_id'        => 'secondary-menu',
                    'menu_class'     => 'nav-menu',
                    'fallback_cb'    => 'vandana_lite_secondary_menu_fallback',
                ) );
            ?>
    	</nav>
        <?php
    }
}
endif;

if( ! function_exists( 'vandana_lite_secondary_menu_fallback' ) ) :
/**
 * Fallback for secondary menu
*/
function vandana_lite_secondary_menu_fallback(){
    if( current_user_can( 'manage_options' ) ){
        echo '<ul id="secondary-menu" class="nav-menu">';
        echo '<li><a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '">' . esc_html__( 'Click here to add a menu', 'vandana-lite' ) . '</a></li>';
        echo '</ul>';
    }
}
endif;

if( ! function_exists( 'vandana_lite_footer_navigation' ) ) :
/**
 * Primary Navigation.
*/
function vandana_lite_footer_navigation(){ 
    if( current_user_can( 'manage_options' ) || has_nav_menu( 'footer' ) ) { ?>
        <div class="footer-menu">
            <?php
                wp_nav_menu( array(
                    'theme_location' => 'footer',
                    'menu_id'        => 'footer-menu',
                    'menu_class'     => 'nav-menu',
                    'fallback_cb'    => 'vandana_lite_footer_menu_fallback',
                ) );
            ?>
        </div><!-- #site-navigation -->
        <?php
    }
}
endif;

if( ! function_exists( 'vandana_lite_footer_menu_fallback' ) ) :
/**
 * Fallback for footer menu
*/
function vandana_lite_footer_menu_fallback(){
    if( current_user_can( 'manage_options' ) ){
        echo '<ul id="footer-menu" class="nav-menu">';
        echo '<li><a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '">' . esc_html__( 'Click here to add a menu', 'vandana-lite' ) . '</a></li>';
        echo '</ul>';
    }
}
endif;

if( ! function_exists( 'vandana_lite_mobile_header' ) ) :
/**
 * Mobile Header
*/
function vandana_lite_mobile_header(){ 
    $ed_cart   = get_theme_mod( 'ed_shopping_cart', true );
    $ed_search = get_theme_mod( 'ed_header_search', true );
    ?>
        <div class="mobile-header">
            <div class="container">
                <button class="menu-toggle" data-toggle-target=".main-menu-modal" data-toggle-body-class="showing-main-menu-modal" aria-expanded="false" data-set-focus=".close-main-nav-toggle">
                    <span class="toggle-bar"></span>
                    <span class="toggle-bar"></span>
                    <span class="toggle-bar"></span>
                </button>
                <div class="mbl-menu-wrap">
                    <div class="primary-menu-list main-menu-modal cover-modal" data-modal-target-string=".main-menu-modal">
                        <button class="close close-main-nav-toggle" data-toggle-target=".main-menu-modal" data-toggle-body-class="showing-main-menu-modal" aria-expanded="false" data-set-focus=".main-menu-modal"></button>
                        <div class="mobile-menu" aria-label="<?php esc_attr_e( 'Mobile', 'vandana-lite' ); ?>">
                            <div class="main-menu-modal">
                                <?php vandana_lite_primary_navigation(); ?>
                                <div class="mbl-right-block">
                                    <?php vandana_lite_secondary_navigation(); ?>
                                    <?php if( vandana_lite_social_links( false ) ) : ?>
                                        <?php vandana_lite_social_links(); ?>
                                    <?php endif; ?>
                                    <?php if( ( vandana_lite_is_woocommerce_activated() && $ed_cart ) ) : ?>
                                        <div class="header-right">
                                            <?php if( vandana_lite_is_woocommerce_activated() && $ed_cart ){
                                                echo '<div class="header-cart">';
                                                vandana_lite_wc_cart_count();
                                                echo '</div>';
                                            }
                                            ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                    vandana_lite_site_branding(); 
                    if( $ed_search ) {
                        echo '<div class="header-search">
                            <button class="search-toggle" data-toggle-target=".mob-search-modal" data-toggle-body-class="showing-mob-search-modal" data-set-focus=".mob-search-modal .search-field" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22.691" height="21.932" viewBox="0 0 22.691 21.932">
                                    <g id="Group_258" data-name="Group 258" transform="matrix(0.966, -0.259, 0.259, 0.966, -1515.787, 248.902)">
                                        <g id="Ellipse_9" data-name="Ellipse 9" transform="translate(1525.802 162.18) rotate(-30)" fill="none" stroke="#6a6a6a" stroke-width="2.5">
                                            <circle cx="7.531" cy="7.531" r="7.531" stroke="none"/>
                                            <circle cx="7.531" cy="7.531" r="6.281" fill="none"/>
                                        </g>
                                        <path id="Path_4339" data-name="Path 4339" d="M0,0V7" transform="translate(1540.052 170.724) rotate(-30)" fill="none" stroke="#6a6a6a" stroke-linecap="round" stroke-width="2.5"/>
                                    </g>
                                </svg>
                            </button>
                            <div class="header-search-wrap mob-search-modal cover-modal" data-modal-target-string=".mob-search-modal">
                                <div class="header-search-inner-wrap">';
                                    get_search_form();
                                echo '<button class="close" data-toggle-target=".mob-search-modal" data-toggle-body-class="showing-mob-search-modal" data-set-focus=".mob-search-modal .search-field" aria-expanded="false"></button>
                                </div>
                            </div>
                        </div><!-- .header-search -->';
                    }	
                ?>
                
            </div>
        </div><!-- .mobile-header -->
    <?php
}
endif;

if( ! function_exists( 'vandana_lite_breadcrumb' ) ) :
/**
 * Breadcrumbs
*/
function vandana_lite_breadcrumb(){ 
    global $post;
    $post_page  = get_option( 'page_for_posts' ); //The ID of the page that displays posts.
    $show_front = get_option( 'show_on_front' ); //What to show on the front page    
    $home       = get_theme_mod( 'home_text', __( 'Home', 'vandana-lite' ) ); // text for the 'Home' link
    $delimiter  = '<i class="fas fa-angle-right"></i>';
    $before     = '<span class="current" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">'; // tag before the current crumb
    $after      = '</span>'; // tag after the current crumb
    
    if( get_theme_mod( 'ed_breadcrumb', true ) ){
        
      $depth = 1;
        echo '<div class="breadcrumb-wrapper">
                <div class="container">
                <div id="crumbs" itemscope itemtype="https://schema.org/BreadcrumbList"> 
                    <span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                        <a itemprop="item" href="' . esc_url( home_url() ) . '"><span itemprop="name">' . esc_html( $home ) . '</span></a>
                        <meta itemprop="position" content="'. absint( $depth ).'" />
                        <span class="separator">' .  $delimiter  . '</span>
                    </span>';
        if( is_home() ){
            $depth = 2;
            echo $before . '<a itemprop="item" href="'. esc_url( get_the_permalink() ) .'"><span itemprop="name">' . esc_html( single_post_title( '', false ) ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" /> '. $after;
            
        }elseif( is_category() ){
            
            $depth = 2;
            $thisCat = get_category( get_query_var( 'cat' ), false );

            if( $show_front === 'page' && $post_page ){ //If static blog post page is set
                $p = get_post( $post_page );
                echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_permalink( $post_page ) ) . '"><span itemprop="name">' . esc_html( $p->post_title ) . ' </span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
                $depth ++;  
            }

            if ( $thisCat->parent != 0 ) {
                $parent_categories = get_category_parents( $thisCat->parent, false, ',' );
                $parent_categories = explode( ',', $parent_categories );

                foreach ( $parent_categories as $parent_term ) {
                    $parent_obj = get_term_by( 'name', $parent_term, 'category' );
                    if( is_object( $parent_obj ) ){
                        $term_url    = get_term_link( $parent_obj->term_id );
                        $term_name   = $parent_obj->name;
                        echo ' <span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( $term_url ) . '"><span itemprop="name">' . esc_html( $term_name ) . ' </span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span> ';
                        $depth ++;
                    }
                }
            }
            echo $before . ' <a itemprop="item" href="' . esc_url( get_term_link( $thisCat->term_id) ) . '"><span itemprop="name">' .  esc_html( single_cat_title( '', false ) ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /> ' . $after;
        
        }elseif( vandana_lite_is_woocommerce_activated() && ( is_product_category() || is_product_tag() ) ){ //For Woocommerce archive page
        
            $depth = 2;
            $current_term = $GLOBALS['wp_query']->get_queried_object();
            
            if ( wc_get_page_id( 'shop' ) ) { //Displaying Shop link in woocommerce archive page
                $_name = wc_get_page_id( 'shop' ) ? get_the_title( wc_get_page_id( 'shop' ) ) : '';
                $shop_url = wc_get_page_id( 'shop' ) && wc_get_page_id( 'shop' ) > 0  ? get_the_permalink( wc_get_page_id( 'shop' ) ) : home_url( '/shop' );
                if ( ! $_name ) {
                    $product_post_type = get_post_type_object( 'product' );
                    $_name = $product_post_type->labels->singular_name;
                }
                echo ' <span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( $shop_url ) . '"><span itemprop="name">' . esc_html( $_name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /> <span class="separator">' . $delimiter . '</span></span> ';
                $depth++;
            }

            if( is_product_category() ){
                $ancestors = get_ancestors( $current_term->term_id, 'product_cat' );
                $ancestors = array_reverse( $ancestors );
                foreach ( $ancestors as $ancestor ) {
                    $ancestor = get_term( $ancestor, 'product_cat' );    
                    if ( ! is_wp_error( $ancestor ) && $ancestor ) {
                        echo ' <span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_term_link( $ancestor ) ) . '"><span itemprop="name">' . esc_html( $ancestor->name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /> <span class="separator">' . $delimiter . '</span></span> ';
                        $depth++;
                    }
                }
            }           
            echo $before .'<a itemprop="item" href="' . esc_url( get_term_link( $current_term->term_id ) ) . '"><span itemprop="name">'. esc_html( $current_term->name ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
            
        }elseif( vandana_lite_is_woocommerce_activated() && is_shop() ){ //Shop Archive page

            $depth = 2;
            if ( get_option( 'page_on_front' ) == wc_get_page_id( 'shop' ) ) {
                return;
            }
            $_name = wc_get_page_id( 'shop' ) ? get_the_title( wc_get_page_id( 'shop' ) ) : '';
            $shop_url = wc_get_page_id( 'shop' ) && wc_get_page_id( 'shop' ) > 0  ? get_the_permalink( wc_get_page_id( 'shop' ) ) : home_url( '/shop' );
    
            if ( ! $_name ) {
                $product_post_type = get_post_type_object( 'product' );
                $_name = $product_post_type->labels->singular_name;
            }
            echo $before .'<a itemprop="item" href="' . esc_url( $shop_url ) . '"><span itemprop="name">'. esc_html( $_name ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after; 

        }elseif( is_tax( 'blossom_portfolio_categories' ) ){
            $depth = 2;
            $queried_object = get_queried_object();
            $taxonomy = 'blossom_portfolio_categories';
            $ancestors = get_ancestors( $queried_object->term_id, $taxonomy );
            if( !empty( $ancestors ) ){
            $termz = get_term( $ancestors[0], $taxonomy );
            $ancestors_title = !empty( $termz->name ) ? esc_html( $termz->name ) : ''; 
                echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_term_link( $termz->term_id ) ) . '"><span itemprop="name">' . $ancestors_title . ' </span></a><meta itemprop="position" content="'. absint( $depth ).'"/><span class="separator">' . $delimiter . '</span></span> ';
                $depth++;
            }
            echo $before . '<a itemprop="item" href="' . esc_url( get_term_link( $queried_object->term_id ) ) . '"><span itemprop="name">' . esc_html( $queried_object->name ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
        }elseif( is_tag() ){
            
            $queried_object = get_queried_object();
            $depth = 2;

            echo $before . '<a itemprop="item" href="' . esc_url( get_term_link( $queried_object->term_id ) ) . '"><span itemprop="name">' . esc_html( single_tag_title( '', false ) ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
     
        }elseif( is_author() ){
            
            $depth = 2;
            global $author;

            $userdata = get_userdata( $author );
            echo $before . '<a itemprop="item" href="' . esc_url( get_author_posts_url( $author ) ) . '"><span itemprop="name">' . esc_html( $userdata->display_name ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
     
        }elseif( is_search() ){
            
            $depth = 2;
            $request_uri = $_SERVER['REQUEST_URI'];
            echo $before .'<a itemprop="item" href="'. esc_url( $request_uri ) .'"><span itemprop="name">'. esc_html__( 'Search Results for "', 'vandana-lite' ) . esc_html( get_search_query() ) . esc_html__( '"', 'vandana-lite' ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
        
        }elseif( is_day() ){
            
            $depth = 2;
            echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_year_link( get_the_time( __( 'Y', 'vandana-lite' ) ) ) ) . '"><span itemprop="name">' . esc_html( get_the_time( __( 'Y', 'vandana-lite' ) ) ) . ' </span></a><meta itemprop="position" content="'. absint( $depth ).'"/><span class="separator">' . $delimiter . '</span></span> ';
            $depth ++;
            echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_month_link( get_the_time( __( 'Y', 'vandana-lite' ) ), get_the_time( __( 'm', 'vandana-lite' ) ) ) ) . '"><span itemprop="name">' . esc_html( get_the_time( __( 'F', 'vandana-lite' ) ) ) . ' </span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span> ';
            $depth ++;
            echo $before .'<a itemprop="item" href="' . esc_url( get_day_link( get_the_time( __( 'Y', 'vandana-lite' ) ), get_the_time( __( 'm', 'vandana-lite' ) ), get_the_time( __( 'd', 'vandana-lite' ) ) ) ) . '"><span itemprop="name">'. esc_html( get_the_time( __( 'd', 'vandana-lite' ) ) ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
        
        }elseif( is_month() ){
            
            $depth = 2;
            echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_year_link( get_the_time( __( 'Y', 'vandana-lite' ) ) ) ) . '"><span itemprop="name">' . esc_html( get_the_time( __( 'Y', 'vandana-lite' ) ) ) . ' </span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span> ';
            $depth++;
            echo $before .'<a itemprop="item" href="' . esc_url( get_month_link( get_the_time( __( 'Y', 'vandana-lite' ) ), get_the_time( __( 'm', 'vandana-lite' ) ) ) ) . '"><span itemprop="name">'. esc_html( get_the_time( __( 'F', 'vandana-lite' ) ) ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
        
        }elseif( is_year() ){
            
            $depth = 2;
            echo $before .'<a itemprop="item" href="' . esc_url( get_year_link( get_the_time( __( 'Y', 'vandana-lite' ) ) ) ) . '"><span itemprop="name">'. esc_html( get_the_time( __( 'Y', 'vandana-lite' ) ) ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
    
        }elseif( is_single() && !is_attachment() ){
            
            if( vandana_lite_is_woocommerce_activated() && 'product' === get_post_type() ){ //For Woocommerce single product
                
                $depth = 2;
                if ( wc_get_page_id( 'shop' ) ) { //Displaying Shop link in woocommerce archive page
                    $_name = wc_get_page_id( 'shop' ) ? get_the_title( wc_get_page_id( 'shop' ) ) : '';
                    $shop_url = wc_get_page_id( 'shop' ) && wc_get_page_id( 'shop' ) > 0  ? get_the_permalink( wc_get_page_id( 'shop' ) ) : home_url( '/shop' );
                    if ( ! $_name ) {
                        $product_post_type = get_post_type_object( 'product' );
                        $_name = $product_post_type->labels->singular_name;
                    }
                    echo ' <span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( $shop_url ) . '"><span itemprop="name">' . esc_html( $_name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /> <span class="separator">' . $delimiter . '</span></span> ';
                    $depth++;
                }
            
                if ( $terms = wc_get_product_terms( $post->ID, 'product_cat', array( 'orderby' => 'parent', 'order' => 'DESC' ) ) ) {
                    $main_term = apply_filters( 'woocommerce_breadcrumb_main_term', $terms[0], $terms );
                    $ancestors = get_ancestors( $main_term->term_id, 'product_cat' );
                    $ancestors = array_reverse( $ancestors );
                    foreach ( $ancestors as $ancestor ) {
                        $ancestor = get_term( $ancestor, 'product_cat' );    
                        if ( ! is_wp_error( $ancestor ) && $ancestor ) {
                            echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_term_link( $ancestor ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $ancestor->name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
                            $depth++;
                        }
                    }
                    echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_term_link( $main_term ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $main_term->name ) . ' </span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span> ';
                    $depth ++;
                }
                
                echo $before .'<a href="' . esc_url( get_the_permalink() ) . '" itemprop="item"><span itemprop="name">'. esc_html( get_the_title() ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
                
            }elseif( get_post_type() != 'post' ){
                $depth = 2;
                $post_type = get_post_type_object( get_post_type() );

                if( $post_type->has_archive == true ){// For CPT Archive Link
                   
                   // Add support for a non-standard label of 'archive_title' (special use case).
                   $label = !empty( $post_type->labels->archive_title ) ? $post_type->labels->archive_title : $post_type->labels->name;
                   
                   echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="'.esc_url( get_post_type_archive_link( get_post_type() ) ) .'" itemprop="item"><span itemprop="name">'.esc_html($label).'</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';

                   $depth ++;    
                }

                if( get_post_type() =='blossom-portfolio' ){
                    // Add support for a non-standard label of 'archive_title' (special use case).
                   $label = !empty( $post_type->labels->archive_title ) ? $post_type->labels->archive_title : $post_type->labels->name;
                   $portfolio_link = vandana_lite_get_page_template_url( 'templates/blossom-portfolio.php' );
                   echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="'.esc_url( $portfolio_link) .'" itemprop="item"><span itemprop="name">'.esc_html($label).'</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
                   $depth ++;    
                }

                echo $before .'<a href="' . esc_url( get_the_permalink() ) . '" itemprop="item"><span itemprop="name">'. esc_html( get_the_title() ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
                
            }else{ //For Post
                
                $cat_object       = get_the_category();
                $potential_parent = 0;
                $depth            = 2;
                
                if( $show_front === 'page' && $post_page ){ //If static blog post page is set
                    $p = get_post( $post_page );
                    echo ' <span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_permalink( $post_page ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $p->post_title ) . ' </span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span> ';  
                    $depth++;
                }
                
                if( is_array( $cat_object ) ){ //Getting category hierarchy if any
        
                    //Now try to find the deepest term of those that we know of
                    $use_term = key( $cat_object );
                    foreach( $cat_object as $key => $object )
                    {
                        //Can't use the next($cat_object) trick since order is unknown
                        if( $object->parent > 0  && ( $potential_parent === 0 || $object->parent === $potential_parent ) ){
                            $use_term = $key;
                            $potential_parent = $object->term_id;
                        }
                    }
                    
                    $cat = $cat_object[$use_term];
              
                    $cats = get_category_parents( $cat, false, ',' );
                    $cats = explode( ',', $cats );

                    foreach ( $cats as $cat ) {
                        $cat_obj = get_term_by( 'name', $cat, 'category' );
                        if( is_object( $cat_obj ) ){
                            $term_url    = get_term_link( $cat_obj->term_id );
                            $term_name   = $cat_obj->name;
                            echo ' <span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( $term_url ) . '"><span itemprop="name">' . esc_html( $term_name ) . ' </span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span> ';
                            $depth ++;
                        }
                    }
                }
    
                 echo $before .'<a itemprop="item" href="' . esc_url( get_the_permalink() ) . '"><span itemprop="name">'. esc_html( get_the_title() ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;     
                
            }
        
        }elseif( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ){
            
            $depth = 2;
            $post_type = get_post_type_object(get_post_type());
            if( get_query_var('paged') ){
                echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_post_type_archive_link( $post_type->name ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $post_type->label ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" />';
                echo ' <span class="separator">' . $delimiter . '</span></span> ' . $before . sprintf( __('Page %s', 'vandana-lite'), get_query_var('paged') ) . $after;
            }elseif( is_archive() ){
                echo $before .'<a itemprop="item" href="' . esc_url( get_post_type_archive_link( $post_type->name ) ) . '"><span itemprop="name">'. esc_html( post_type_archive_title() ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
            }else{
                echo $before .'<a itemprop="item" href="' . esc_url( get_post_type_archive_link( $post_type->name ) ) . '"><span itemprop="name">'. esc_html( $post_type->label ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
            }
    
        }elseif( is_attachment() ){
            
            $depth = 2;
            $parent = get_post( $post->post_parent );
            $cat = get_the_category( $parent->ID ); 
            if( $cat ){
                $cat = $cat[0];
                echo get_category_parents( $cat, TRUE, ' <span class="separator">' . $delimiter . '</span> ');
                echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_permalink( $parent ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $parent->post_title ) . '<span></a><meta itemprop="position" content="'. absint( $depth ).'" />' . ' <span class="separator">' . $delimiter . '</span></span>';
            }
            echo  $before .'<a itemprop="item" href="' . esc_url( get_the_permalink() ) . '"><span itemprop="name">'. esc_html( get_the_title() ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
        
        }elseif( is_page() && !$post->post_parent ){
            
           $depth = 2;
            echo $before .'<a itemprop="item" href="' . esc_url( get_the_permalink() ) . '"><span itemprop="name">'. esc_html( get_the_title() ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
    
        }elseif( is_page() && $post->post_parent ){
            
            global $post;
            $depth = 2;
            $parent_id  = $post->post_parent;
            $breadcrumbs = array();
            
            while( $parent_id ){
                $current_page = get_post( $parent_id );
                $breadcrumbs[] = $current_page->ID;
                $parent_id  = $current_page->post_parent;
            }

            $breadcrumbs = array_reverse( $breadcrumbs );

            for ( $i = 0; $i < count( $breadcrumbs); $i++ ){
                echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_permalink( $breadcrumbs[$i] ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( get_the_title( $breadcrumbs[$i] ) ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /></span>';
                if ( $i != count( $breadcrumbs ) - 1 ) echo ' <span class="separator">' . $delimiter . '</span> ';
                $depth++;
            }

            echo ' <span class="separator">' .  $delimiter . '</span> ' . $before .'<a href="' . get_permalink() . '" itemprop="item"><span itemprop="name">'. esc_html( get_the_title() ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" /></span>'. $after;
        
        }elseif( is_404() ){
            echo $before . esc_html__( '404 Error - Page Not Found', 'vandana-lite' ) . $after;
        }
        
        if( get_query_var('paged') ) echo __( ' (Page', 'vandana-lite' ) . ' ' . get_query_var('paged') . __( ')', 'vandana-lite' );
        
        echo '</div></div></div><!-- .breadcrumb-wrapper -->';  
        
    }                
}
endif;

if( ! function_exists( 'vandana_lite_theme_comment' ) ) :
/**
 * Callback function for Comment List *
 * 
 * @link https://codex.wordpress.org/Function_Reference/wp_list_comments 
 */
function vandana_lite_theme_comment( $comment, $args, $depth ){
	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
	<<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
	
    <?php if ( 'div' != $args['style'] ) : ?>
    <article id="div-comment-<?php comment_ID() ?>" class="comment-body" itemscope itemtype="https://schema.org/UserComments">
	<?php endif; ?>
    	
        <footer class="comment-meta">
            <div class="comment-author vcard">
        	   <?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
                <?php printf( __( '<b class="fn" itemprop="creator" itemscope itemtype="https://schema.org/Person">%s</b> <span class="says">says:</span>', 'vandana-lite' ), get_comment_author_link() ); ?>
        	</div><!-- .comment-author vcard -->
            <div class="comment-metadata commentmetadata">
                <?php esc_html_e( 'Posted on', 'vandana-lite' );?>
                <a href="<?php echo esc_url( htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ); ?>">
                    <time itemprop="commentTime" datetime="<?php echo esc_attr( get_gmt_from_date( get_comment_date() . get_comment_time(), 'Y-m-d H:i:s' ) ); ?>"><?php printf( esc_html__( '%1$s at %2$s', 'vandana-lite' ), get_comment_date(),  get_comment_time() ); ?></time>
                </a>
            </div>
            <?php if ( $comment->comment_approved == '0' ) : ?>
                <p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'vandana-lite' ); ?></p>
            <?php endif; ?>
        </footer>
        <div class="comment-content" itemprop="commentText"><?php comment_text(); ?></div>        
        <div class="reply">
            <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
        </div>        
	<?php if ( 'div' != $args['style'] ) : ?>
    </article><!-- .comment-body -->
	<?php endif; ?>
    
<?php
}
endif;

if( ! function_exists( 'vandana_lite_sidebar' ) ) :
/**
 * Return sidebar layouts for pages/posts
*/
function vandana_lite_sidebar( $class = false ){
    global $post;
    $return = false;
    $page_layout = get_theme_mod( 'page_sidebar_layout', 'right-sidebar' ); //Default Layout Style for Pages
    $post_layout = get_theme_mod( 'post_sidebar_layout', 'right-sidebar' ); //Default Layout Style for Posts
    $layout      = get_theme_mod( 'layout_style', 'right-sidebar' ); //Default Layout Style for Styling Settings
    
    if( is_singular( array( 'page', 'post' ) ) ){         
        if( get_post_meta( $post->ID, '_vandana_lite_sidebar_layout', true ) ){
            $sidebar_layout = get_post_meta( $post->ID, '_vandana_lite_sidebar_layout', true );
        }else{
            $sidebar_layout = 'default-sidebar';
        }
        
        if( is_page() ){
            if( is_active_sidebar( 'sidebar' ) ){
                if( $sidebar_layout == 'no-sidebar' || ( $sidebar_layout == 'default-sidebar' && $page_layout == 'no-sidebar' ) ){
                    $return = $class ? 'full-width' : false;
                }elseif( $sidebar_layout == 'centered' || ( $sidebar_layout == 'default-sidebar' && $page_layout == 'centered' ) ){
                    $return = $class ? 'full-width-centered' : false;
                }elseif( ( $sidebar_layout == 'default-sidebar' && $page_layout == 'right-sidebar' ) || ( $sidebar_layout == 'right-sidebar' ) ){
                    $return = $class ? 'rightsidebar' : 'sidebar';
                }elseif( ( $sidebar_layout == 'default-sidebar' && $page_layout == 'left-sidebar' ) || ( $sidebar_layout == 'left-sidebar' ) ){
                    $return = $class ? 'leftsidebar' : 'sidebar';
                }
            }else{
                $return = $class ? 'full-width' : false;
            }
        }elseif( is_single() ){
            if( is_active_sidebar( 'sidebar' ) ){
                if( $sidebar_layout == 'no-sidebar' || ( $sidebar_layout == 'default-sidebar' && $post_layout == 'no-sidebar' ) ){
                    $return = $class ? 'full-width' : false;
                }elseif( $sidebar_layout == 'centered' || ( $sidebar_layout == 'default-sidebar' && $post_layout == 'centered' ) ){
                    $return = $class ? 'full-width-centered' : false;
                }elseif( ( $sidebar_layout == 'default-sidebar' && $post_layout == 'right-sidebar' ) || ( $sidebar_layout == 'right-sidebar' ) ){
                    $return = $class ? 'rightsidebar' : 'sidebar';
                }elseif( ( $sidebar_layout == 'default-sidebar' && $post_layout == 'left-sidebar' ) || ( $sidebar_layout == 'left-sidebar' ) ){
                    $return = $class ? 'leftsidebar' : 'sidebar';
                }
            }else{
                $return = $class ? 'full-width' : false;
            }
        }
    }elseif( vandana_lite_is_woocommerce_activated() && ( is_shop() || is_product_category() || is_product_tag() || get_post_type() == 'product' ) ){
        if( $layout == 'no-sidebar' ){
            $return = $class ? 'full-width' : false;
        }elseif( is_active_sidebar( 'shop-sidebar' ) ){            
            if( $class ){
                if( $layout == 'right-sidebar' ) $return = 'rightsidebar'; //With Sidebar
                if( $layout == 'left-sidebar' ) $return = 'leftsidebar';
            }         
        }else{
            $return = $class ? 'full-width' : false;
        } 
    }else{
        if( $layout == 'no-sidebar' ){
            $return = $class ? 'full-width' : false;
        }elseif( is_active_sidebar( 'sidebar' ) ){            
            if( $class ){
                if( $layout == 'right-sidebar' ) $return = 'rightsidebar'; //With Sidebar
                if( $layout == 'left-sidebar' ) $return = 'leftsidebar';
            }else{
                $return = 'sidebar';    
            }                         
        }else{
            $return = $class ? 'full-width' : false;
        } 
    }    
    return $return; 
}
endif;

if( ! function_exists( 'vandana_lite_get_posts' ) ) :
/**
 * Fuction to list Custom Post Type
*/
function vandana_lite_get_posts( $post_type = 'post', $slug = false ){    
    $args = array(
    	'posts_per_page'   => -1,
    	'post_type'        => $post_type,
    	'post_status'      => 'publish',
    	'suppress_filters' => true 
    );
    $posts_array = get_posts( $args );
    
    // Initate an empty array
    $post_options = array();
    $post_options[''] = __( ' -- Choose -- ', 'vandana-lite' );
    if ( ! empty( $posts_array ) ) {
        foreach ( $posts_array as $posts ) {
            if( $slug ){
                $post_options[ $posts->post_title ] = $posts->post_title;
            }else{
                $post_options[ $posts->ID ] = $posts->post_title;    
            }
        }
    }
    return $post_options;
    wp_reset_postdata();
}
endif;

if( ! function_exists( 'vandana_lite_get_categories' ) ) :
/**
 * Function to list post categories in customizer options
*/
function vandana_lite_get_categories( $select = true, $taxonomy = 'category', $slug = false ){    
    /* Option list of all categories */
    $categories = array();
    
    $args = array( 
        'hide_empty' => false,
        'taxonomy'   => $taxonomy 
    );
    
    $catlists = get_terms( $args );
    if( $select ) $categories[''] = __( 'Choose Category', 'vandana-lite' );
    foreach( $catlists as $category ){
        if( $slug ){
            $categories[$category->slug] = $category->name;
        }else{
            $categories[$category->term_id] = $category->name;    
        }        
    }
    
    return $categories;
}
endif;

if( ! function_exists( 'vandana_lite_get_page_template_url' ) ) :
/**
 * Returns page template url if not found returns home page url
*/
function vandana_lite_get_page_template_url( $page_template ){
    $args = array(
        'meta_key'   => '_wp_page_template',
        'meta_value' => $page_template,
        'post_type'  => 'page',
        'fields'     => 'ids',
    );
    
    $posts_array = get_posts( $args );
    
    $url = ( $posts_array ) ? get_permalink( $posts_array[0] ) : get_permalink( get_option( 'page_on_front' ) );
    return $url;    
}
endif;

if( ! function_exists( 'vandana_lite_get_home_sections' ) ) :
/**
 * Returns Home Sections 
*/
function vandana_lite_get_home_sections(){
    $ed_banner     = get_theme_mod( 'ed_banner_section', 'static_nl_banner' );
    $sections = array( 
        'client'        => array( 'sidebar' => 'client' ),
        'promotional'   => array( 'sidebar' => 'promotional' ),
        'about'         => array( 'asection' => 'about' ),
        'cta'           => array( 'sidebar' => 'cta' ),
        'service'       => array( 'sidebar' => 'service' ),
        'wheeloflife'   => array( 'wsection' => 'wheeloflife' ),
        'testimonial'   => array( 'sidebar' => 'testimonial' ),
        'blog'          => array( 'bsection' => 'blog' ),
        'contact'       => array( 'sidebar' => 'contact' ),
    );
    
    $enabled_section = array();
    
    if( $ed_banner == 'slider_banner' || $ed_banner == 'static_nl_banner' ) array_push( $enabled_section, 'banner' );

    foreach( $sections as $k => $v ){
        if( array_key_exists( 'sidebar', $v ) ){
            if( is_active_sidebar( $v['sidebar'] ) ) array_push( $enabled_section, $v['sidebar'] );
        }else{
          if( array_key_exists( 'asection', $v ) && get_theme_mod( 'ed_about_section', false ) ) array_push( $enabled_section, $v['asection'] );
          if( array_key_exists( 'wsection', $v ) && get_theme_mod( 'ed_wheeloflife_section', false ) ) array_push( $enabled_section, $v['wsection'] );
          if( array_key_exists( 'bsection', $v ) && get_theme_mod( 'ed_blog_section', true ) ) array_push( $enabled_section, $v['bsection'] );
        }
    }  
    
    return apply_filters( 'vandana_lite_home_sections', $enabled_section );
}
endif;

if( ! function_exists( 'vandana_lite_get_image_sizes' ) ) :
/**
 * Get information about available image sizes
 */
function vandana_lite_get_image_sizes( $size = '' ) {
 
    global $_wp_additional_image_sizes;
 
    $sizes = array();
    $get_intermediate_image_sizes = get_intermediate_image_sizes();
 
    // Create the full array with sizes and crop info
    foreach( $get_intermediate_image_sizes as $_size ) {
        if ( in_array( $_size, array( 'thumbnail', 'medium', 'medium_large', 'large' ) ) ) {
            $sizes[ $_size ]['width'] = get_option( $_size . '_size_w' );
            $sizes[ $_size ]['height'] = get_option( $_size . '_size_h' );
            $sizes[ $_size ]['crop'] = (bool) get_option( $_size . '_crop' );
        } elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
            $sizes[ $_size ] = array( 
                'width' => $_wp_additional_image_sizes[ $_size ]['width'],
                'height' => $_wp_additional_image_sizes[ $_size ]['height'],
                'crop' =>  $_wp_additional_image_sizes[ $_size ]['crop']
            );
        }
    } 
    // Get only 1 size if found
    if ( $size ) {
        if( isset( $sizes[ $size ] ) ) {
            return $sizes[ $size ];
        } else {
            return false;
        }
    }
    return $sizes;
}
endif;

if ( ! function_exists( 'vandana_lite_get_fallback_svg' ) ) :    
/**
 * Get Fallback SVG
*/
function vandana_lite_get_fallback_svg( $post_thumbnail ) {
    if( ! $post_thumbnail ){
        return;
    }
    
    $image_size = vandana_lite_get_image_sizes( $post_thumbnail );
     
    if( $image_size ){ ?>
        <div class="svg-holder">
             <svg class="fallback-svg" viewBox="0 0 <?php echo esc_attr( $image_size['width'] ); ?> <?php echo esc_attr( $image_size['height'] ); ?>" preserveAspectRatio="none">
                    <rect width="<?php echo esc_attr( $image_size['width'] ); ?>" height="<?php echo esc_attr( $image_size['height'] ); ?>" style="fill:#f2f2f2;"></rect>
            </svg>
        </div>
        <?php
    }
}
endif;

if( ! function_exists( 'wp_body_open' ) ) :
/**
 * Fire the wp_body_open action.
 * Added for backwards compatibility to support pre 5.2.0 WordPress versions.
*/
function wp_body_open() {
	/**
	 * Triggered after the opening <body> tag.
    */
	do_action( 'wp_body_open' );
}
endif;

/**
 * Is Blossom Theme Toolkit active or not
*/
function vandana_lite_is_bttk_activated(){
    return class_exists( 'Blossomthemes_Toolkit' ) ? true : false;
}

/**
 * Is BlossomThemes Email Newsletters active or not
*/
function vandana_lite_is_btnw_activated(){
    return class_exists( 'Blossomthemes_Email_Newsletter' ) ? true : false;        
}

/**
 * Is BlossomThemes Social Feed active or not
*/
function vandana_lite_is_btif_activated(){
    return class_exists( 'Blossomthemes_Instagram_Feed' ) ? true : false;
}

/**
 * Query WooCommerce activation
 */
function vandana_lite_is_woocommerce_activated() {
	return class_exists( 'woocommerce' ) ? true : false;
}

/**
 * Check if Contact Form 7 Plugin is installed
*/
function vandana_lite_is_cf7_activated(){
    return class_exists( 'WPCF7' ) ? true : false;
}

/**
 * Query Jetpack activation
*/
function vandana_lite_is_jetpack_activated( $gallery = false ){
	if( $gallery ){
        return ( class_exists( 'jetpack' ) && Jetpack::is_module_active( 'tiled-gallery' ) ) ? true : false;
	}else{
        return class_exists( 'jetpack' ) ? true : false;
    }           
}

/**
 * Checks if elementor is active or not
*/
function vandana_lite_is_elementor_activated(){
    return class_exists( 'Elementor\\Plugin' ) ? true : false; 
}

/**
 * Checks if elementor has override that particular page/post or not
*/
function vandana_lite_is_elementor_activated_post(){
    if( vandana_lite_is_elementor_activated() && is_singular() ){
        global $post;
        $post_id = $post->ID;
        return \Elementor\Plugin::$instance->documents->get( $post_id )->is_built_with_elementor() ? true : false;
    }else{
        return false;
    }
}

/**
 * Is Wheel of life activated
 */
function vandana_lite_is_wheel_of_life_activated() {
    return class_exists( 'WheelOfLife\Wheel_Of_Life' ) ? true : false;
}


/**
 * Checks if classic editor is active or not
*/
function vandana_lite_is_classic_editor_activated(){
    return class_exists( 'Classic_Editor' ) ? true : false; 
}

if( ! function_exists( 'vandana_lite_posts_per_page_count' ) ):
/**
*   Counts the Number of total posts in Archive, Search and Author
*/
function vandana_lite_posts_per_page_count(){
    global $wp_query;
    if( is_archive() || is_search() && $wp_query->found_posts > 0 ) {
        $posts_per_page = get_option( 'posts_per_page' );
        $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
        $start_post_number = 0;
        $end_post_number   = 0;

        if( $wp_query->found_posts > 0 && !( vandana_lite_is_woocommerce_activated() && is_shop() ) ):                
            $start_post_number = 1;
            if( $wp_query->found_posts < $posts_per_page  ) {
                $end_post_number = $wp_query->found_posts;
            }else{
                $end_post_number = $posts_per_page;
            }

            if( $paged > 1 ){
                $start_post_number = $posts_per_page * ( $paged - 1 ) + 1;
                if( $wp_query->found_posts < ( $posts_per_page * $paged )  ) {
                    $end_post_number = $wp_query->found_posts;
                }else{
                    $end_post_number = $paged * $posts_per_page;
                }
            }

            printf( esc_html__( '%1$s Showing:  %2$s - %3$s of %4$s Articles %5$s', 'vandana-lite' ), '<span class="result-count">', absint( $start_post_number ), absint( $end_post_number ), esc_html( number_format_i18n( $wp_query->found_posts ) ), '</span>' );
        endif;
    }
}
endif; 

if ( ! function_exists( 'vandana_lite_blog_image_size' ) ) :
/**
 * Blog Layout Image Size
*/
function vandana_lite_blog_image_size() {

    $blog_layout  = get_theme_mod( 'blog_page_layout', 'classic-layout' );
    $sidebar      = vandana_lite_sidebar();

    if( $blog_layout == 'classic-layout') { 
        $image_size = ( $sidebar ) ? 'vandana-lite-blog' : 'vandana-lite-blog-full';    
    }elseif( $blog_layout == 'list-layout' ){ 
        $image_size = 'vandana-lite-blog-list';    
    }elseif( $blog_layout == 'grid-layout' ) {
        $image_size = 'vandana-lite-blog-grid';    
    }else{
        $image_size = ( $sidebar ) ? 'vandana-lite-blog' : 'vandana-lite-blog-full';
    }

    return $image_size;
}
endif;

if( ! function_exists( 'vandana_lite_single_meta_header' ) ) :
/**
 * Single Meta Header
*/
function vandana_lite_single_meta_header(){ 
    $author_title = get_the_author();
    $author_url = get_author_posts_url( get_the_author_meta( 'ID' ) ); 
    $ed_post_author   = get_theme_mod( 'ed_post_author', false );

    if( $author_title && $author_url && !$ed_post_author ) : ?>
        <div class="article-meta">
            <div class="article-meta-inner">
                <span class="byline" itemprop="author">
                    <span class="author">
                        <a href="<?php echo esc_url( $author_url ); ?>" class="url fn">
                            <?php echo get_avatar( get_the_author_meta( 'ID' ), 120 ); 
                            echo esc_html( $author_title );
                            ?>
                        </a>
                    </span>
                </span>
            </div>
        </div>       
    <?php endif;
}
endif;

if( ! function_exists( 'vandana_lite_single_entry_header' ) ) :
/**
 * Single Entry Header
*/
function vandana_lite_single_entry_header(){ 
    
    $single_id = get_the_ID();
    $image_url = get_the_post_thumbnail_url( $single_id, 'full' ); ?>
    
    <header class="entry-header" style="background-image: url('<?php echo esc_url( $image_url ); ?>');">
        <div class="container">
            <?php vandana_lite_category(); ?>
            <h1 class="entry-title"><?php echo esc_html( get_the_title( $single_id ) ); ?></h1>
            <div class="entry-meta">
                <?php vandana_lite_posted_on(); ?>
                <?php vandana_lite_comment_count(); ?>
            </div>
        </div>
    </header><!-- .entry-header -->
    
    <?php
}
endif;

if ( ! function_exists( 'vandana_lite_comment_toggle' ) ):
/**
 * Function toggle comment section position
*/
function vandana_lite_comment_toggle(){
    $comment_postion = get_theme_mod( 'toggle_comments', false );

    if ( $comment_postion ) {
        $priority = 20;
    }else{
        $priority = 45;
    }
    return intval( $priority ) ;
}
endif;