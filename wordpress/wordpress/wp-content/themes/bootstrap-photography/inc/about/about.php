<?php

/**
 * Added One Page Conference Page.
*/
/**
 * Add a new page under Appearance
 */
function bootstrap_photography_menu()
{
    add_theme_page(
        __( 'Get Started', 'bootstrap-photography' ),
        __( 'Get Started', 'bootstrap-photography' ),
        'edit_theme_options',
        'bootstrap-photography-get-started',
        'bootstrap_photography_page'
    );
}

add_action( 'admin_menu', 'bootstrap_photography_menu' );
/**
 * Enqueue styles for the help page.
 */
function bootstrap_photography_admin_scripts( $hook )
{
    if ( 'appearance_page_bootstrap-photography-get-started' !== $hook ) {
        return;
    }
    wp_enqueue_style(
        'bootstrap-photography-admin-style',
        get_template_directory_uri() . '/inc/about/about.css',
        array(),
        ''
    );
}

add_action( 'admin_enqueue_scripts', 'bootstrap_photography_admin_scripts' );
/**
 * Add the theme page
 */
function bootstrap_photography_page()
{
    ?>
	<div class="das-wrap">
		<div class="bootstrap-photography-panel">
			<div class="bootstrap-photography-logo">
				<img class="ts-logo" width="25" src="<?php 
    echo  esc_url( get_template_directory_uri() . '/inc/about/images/bootstrap.png' ) ;
    ?>" alt="Logo"> 
			</div>
			<?php 
    ?>
				<a href="https://thebootstrapthemes.com/bootstrap-photography-pro/" target="_blank" class="btn btn-success pull-right"><?php 
    esc_html_e( 'Upgrade to Pro $49.99', 'bootstrap-photography' );
    ?></a>
			<?php 
    ?>
			<p>
			<?php 
    esc_html_e( 'An Elementor based WordPress theme built within Bootstrap, it is perfect and best suited for photographers, travel bloggers as well as writers. While the theme comes packed with unique features for photographers to explore, it is extremely lightweight and easy to use. You can customize the entire website with Drag & Drop feature in a live preview.', 'bootstrap-photography' );
    ?></p>
			<a class="btn btn-primary" href="<?php 
    echo  esc_url( admin_url( '/customize.php?' ) ) ;
    ?>"><?php 
    esc_html_e( 'Theme Options - Click Here', 'bootstrap-photography' );
    ?></a>
		</div>

		<div class="bootstrap-photography-panel">
			<div class="bootstrap-photography-panel-content">
				<div class="theme-title">
					<h3><?php 
    esc_html_e( 'Once you install all recommended plugins, you can import demo template.', 'bootstrap-photography' );
    ?></h3>
				</div>
				<a class="btn btn-secondary" href="<?php 
    echo  esc_url( admin_url( '/themes.php?page=advanced-import' ) ) ;
    ?>"><?php 
    esc_html_e( 'View Demo Templates', 'bootstrap-photography' );
    ?></a>
			</div>
		</div>
		<div class="bootstrap-photography-panel">
			<div class="bootstrap-photography-panel-content">
				<div class="theme-title">
					<h4><?php 
    esc_html_e( 'If you like the theme, please leave a review or Contact us for technical support.', 'bootstrap-photography' );
    ?></h4>
				</div>
				<a href="https://wordpress.org/support/theme/bootstrap-photography/reviews/#new-post" target="_blank" class="btn btn-secondary"><?php 
    esc_html_e( 'Rate this theme', 'bootstrap-photography' );
    ?></a> <a href="https://thebootstrapthemes.com/support/" target="_blank" class="btn btn-secondary"><?php 
    esc_html_e( 'Contact Us', 'bootstrap-photography' );
    ?></a>
			</div>
		</div>
	</div>
	<?php 
}
