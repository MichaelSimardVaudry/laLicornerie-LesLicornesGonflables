/* global wp, jQuery */
/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Site title color
	wp.customize( 'site_title_color_option', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).css( 'color', to );
		} );
	} );

	// Site title size color
	wp.customize( 'site_title_size', function( value ) {
		value.bind( function( to ) {
			$( '.site-title' ).css( 'font-size', to + "px" );
			$( 'header .custom-logo' ).css( 'height', ( to * 2 ) + "px" );
		} );
	} );


	// font family
	wp.customize( 'site_identity_font_family', function( value ) {
		value.bind( function( to ) {
			$(".site-title").append("<link href='https://fonts.googleapis.com/css?family=" + to + ":200,300,400,500,600,700,800,900|' rel='stylesheet' type='text/css'>");
			$( '.site-title' ).css( 'font-family', to );
		} );
	} );

	//container width
	wp.customize( 'container_width', function( value ) {
		value.bind( function( to ) {
			$( '.container' ).css( 'max-width', to + "px" );
		} );
	} );


	
	// Header text color.
	wp.customize( 'header_text_colors', function( value ) {
		value.bind( function( to ) {
			$( '.main-navigation ul li a' ).css( 'color', to );
			
		} );
	} );
	wp.customize( 'header_text_colors', function( value ) {
		value.bind( function( to ) {
			$( '#nav-icon span' ).css( 'background-color', to );
			
		} );
	} );
	// Header background color.
	wp.customize( 'header_bg_colors', function( value ) {
		value.bind( function( to ) {
			$( '.site-header' ).css( 'background-color', to );
			
		} );
	} );

	wp.customize( 'header_bg_colors', function( value ) {
		value.bind( function( to ) {
			$( '.menu.nav-menu' ).css( 'background-color', to );
			
		} );
	} );
	// font family
	wp.customize( 'font_family', function( value ) {
		value.bind( function( to ) {
			$("head").append("<link href='https://fonts.googleapis.com/css?family=" + to + ":200,300,400,500,600,700,800,900|' rel='stylesheet' type='text/css'>");
			$( 'body, p' ).css( 'font-family', to );
		} );
	} );
	// Menu dropdown background color.
	wp.customize( 'menu_dropdown_bg_colors', function( value ) {
		value.bind( function( to ) {
			$( '.main-navigation .nav-menu .sub-menu' ).css( 'background-color', to );
			
		} );
	} );
	// Footer text color.
	wp.customize( 'footer_text_colors', function( value ) {
		value.bind( function( to ) {
			$( '.site-footer' ).css( 'color', to );
			
		} );
	} );
	// Footer background color.
	wp.customize( 'footer_bg_colors', function( value ) {
		value.bind( function( to ) {
			$( '.site-footer' ).css( 'background-color', to );
			
		} );
	} );

	// Footer title color.
	wp.customize( 'footer_title_colors', function( value ) {
		value.bind( function( to ) {
			$( '.widget-title' ).css( 'color', to );
			
		} );
	} );

	// Footer link color.
	wp.customize( 'footer_link_colors', function( value ) {
		value.bind( function( to ) {
			$( '.site-footer a' ).css( 'color', to );
			
		} );
	} );
		
	
}( jQuery ) );






