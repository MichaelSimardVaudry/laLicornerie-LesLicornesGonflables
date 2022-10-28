<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Vandana_Lite
 */
    /**
     * Doctype Hook
     * 
     * @hooked vandana_lite_doctype
    */
    do_action( 'vandana_lite_doctype' );
?>
<head itemscope itemtype="https://schema.org/WebSite">
	<?php 
    /**
     * Before wp_head
     * 
     * @hooked vandana_lite_head
    */
    do_action( 'vandana_lite_before_wp_head' );
    
    wp_head(); ?>
</head>

<body <?php body_class(); ?> itemscope itemtype="https://schema.org/WebPage">

<?php
    wp_body_open();
    
    /**
     * Before Header
     * 
     * @hooked vandana_lite_page_start - 20 
    */
    do_action( 'vandana_lite_before_header' );
    
    /**
     * Header
     * 
     * @hooked vandana_lite_sticky_bar - 10     
     * @hooked vandana_lite_header - 20     
    */
    do_action( 'vandana_lite_header' );

    
    /**
     * Content
     * 
     * @hooked vandana_lite_content_start
    */
    do_action( 'vandana_lite_content' );