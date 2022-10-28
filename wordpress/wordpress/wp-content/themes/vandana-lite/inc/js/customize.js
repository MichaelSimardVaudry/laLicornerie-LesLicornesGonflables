jQuery(document).ready(function($){
    /* Move Fornt page widgets to frontpage panel */
	wp.customize.section( 'sidebar-widgets-client' ).panel( 'frontpage_settings' );
	wp.customize.section( 'sidebar-widgets-client' ).priority( '20' );
    wp.customize.section( 'sidebar-widgets-promotional' ).panel( 'frontpage_settings' );
    wp.customize.section( 'sidebar-widgets-promotional' ).priority( '30' );
    wp.customize.section( 'sidebar-widgets-cta' ).panel( 'frontpage_settings' );
    wp.customize.section( 'sidebar-widgets-cta' ).priority( '50' );
    wp.customize.section( 'sidebar-widgets-service' ).panel( 'frontpage_settings' );
    wp.customize.section( 'sidebar-widgets-service' ).priority( '60' );
    wp.customize.section( 'sidebar-widgets-testimonial' ).panel( 'frontpage_settings' );
    wp.customize.section( 'sidebar-widgets-testimonial' ).priority( '90' );    
    wp.customize.section( 'sidebar-widgets-contact' ).panel( 'frontpage_settings' );
    wp.customize.section( 'sidebar-widgets-contact' ).priority( '120' );  
    
    $( 'input[name=vandana-lite-flush-local-fonts-button]' ).on( 'click', function( e ) {
        var data = {
            wp_customize: 'on',
            action: 'vandana_lite_flush_fonts_folder',
            nonce: vandana_lite_cdata.flushFonts
        };  
        $( 'input[name=vandana-lite-flush-local-fonts-button]' ).attr('disabled', 'disabled');

        $.post( ajaxurl, data, function ( response ) {
            if ( response && response.success ) {
                $( 'input[name=vandana-lite-flush-local-fonts-button]' ).val( 'Successfully Flushed' );
            } else {
                $( 'input[name=vandana-lite-flush-local-fonts-button]' ).val( 'Failed, Reload Page and Try Again' );
            }
        });
    });

    //Scroll to front page section
    $('body').on('click', '#sub-accordion-panel-frontpage_settings .control-subsection .accordion-section-title', function(event) {
        var section_id = $(this).parent('.control-subsection').attr('id');
        VandanaLitescrollToSection( section_id );
    }); 
    
    /* Home page preview url */
    wp.customize.panel( 'frontpage_settings', function( section ){
        section.expanded.bind( function( isExpanded ) {
            if( isExpanded ){
                wp.customize.previewer.previewUrl.set( vandana_lite_cdata.home );
            }
        });
    });
});

function VandanaLitescrollToSection( section_id ){
    var preview_section_id = "banner_section";

    var $contents = jQuery('#customize-preview iframe').contents();

    switch ( section_id ) {
        
        case 'accordion-section-sidebar-widgets-client':
        preview_section_id = "clients_section";
        break;

        case 'accordion-section-sidebar-widgets-promotional':
        preview_section_id = "promotional_section";
        break;

        case 'accordion-section-about':
        preview_section_id = "about_section";
        break;
        
        case 'accordion-section-sidebar-widgets-cta':
        preview_section_id = "cta_section";
        break;

        case 'accordion-section-sidebar-widgets-service':
        preview_section_id = "service_section";
        break;

        case 'accordion-section-wheel_of_life':
        preview_section_id = "wheeloflife_section";
        break;
        
        case 'accordion-section-sidebar-widgets-testimonial':
        preview_section_id = "testimonial_section";
        break;         
        
        case 'accordion-section-blog_section':
        preview_section_id = "blog_section";
        break;

        case 'accordion-section-sidebar-widgets-contact':
        preview_section_id = "contact_section";
        break;

    }

    if( $contents.find('#'+preview_section_id).length > 0 && $contents.find('.home').length > 0 ){
        $contents.find("html, body").animate({
        scrollTop: $contents.find( "#" + preview_section_id ).offset().top
        }, 1000);
    }
}

( function( api ) {

    // Extends our custom "example-1" section.
    api.sectionConstructor['vandana-lite-pro-section'] = api.Section.extend( {

        // No events for this type of section.
        attachEvents: function () {},

        // Always make the section active.
        isContextuallyActive: function () {
            return true;
        }
    } );

} )( wp.customize );