<?php

/**
 * bootstrap-photography functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Bootstrap Photography
 */

if ( !defined( '_S_VERSION' ) ) {
    // Replace the version number of the theme on each release.
    define( '_S_VERSION', '1.0.7' );
}
if ( !function_exists( 'bootstrap_photography_setup' ) ) {
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function bootstrap_photography_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on bootstrap-photography, use a find and replace
         * to change 'bootstrap-photography' to the name of your theme in all the template files.
         */
        load_theme_textdomain( 'bootstrap-photography' );
        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );
        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );
        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support( 'post-thumbnails' );
        // This theme uses wp_nav_menu() in one location.
        register_nav_menus( array(
            'menu-1' => esc_html__( 'Primary', 'bootstrap-photography' ),
        ) );
        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script'
        ) );
        // Set up the WordPress core custom background feature.
        add_theme_support( 'custom-background', apply_filters( 'bootstrap_photography_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        ) ) );
        // Add theme support for selective refresh for widgets.
        add_theme_support( 'customize-selective-refresh-widgets' );
        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support( 'custom-logo', array(
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        ) );
        add_editor_style();
    }

}
add_action( 'after_setup_theme', 'bootstrap_photography_setup' );
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function bootstrap_photography_content_width()
{
    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS['content_width'] = apply_filters( 'bootstrap_photography_content_width', 640 );
}

add_action( 'after_setup_theme', 'bootstrap_photography_content_width', 0 );
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function bootstrap_photography_widgets_init()
{
    for ( $i = 1 ;  $i < 5 ;  $i++ ) {
        register_sidebar( array(
            'name'          => esc_html__( 'Footer Widget', 'bootstrap-photography' ) . " " . $i,
            'id'            => 'footer-' . $i . '',
            'description'   => esc_html__( 'Add widgets here.', 'bootstrap-photography' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ) );
    }
}

add_action( 'widgets_init', 'bootstrap_photography_widgets_init' );
/**
 * Enqueue scripts and styles.
 */
function bootstrap_photography_scripts()
{
    $font_family = get_theme_mod( 'font_family', 'Montserrat' );
    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css' );
    wp_enqueue_style(
        'bootstrap-photography-style',
        get_stylesheet_uri(),
        array(),
        _S_VERSION
    );
    wp_style_add_data( 'bootstrap-photography-style', 'rtl', 'replace' );
    wp_enqueue_style( 'bootstrap-photography-googlefonts', 'https://fonts.googleapis.com/css?family=' . esc_attr( $font_family ) . ':200,300,400,500,600,700,800,900|' );
    wp_enqueue_script(
        'bootstrap-photography-navigation',
        get_template_directory_uri() . '/js/navigation.js',
        array(),
        _S_VERSION,
        true
    );
    wp_enqueue_script(
        'bootstrap-photography-skip-link-focus-fix',
        get_template_directory_uri() . '/js/skip-link-focus-fix.js',
        array(),
        _S_VERSION,
        true
    );
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}

add_action( 'wp_enqueue_scripts', 'bootstrap_photography_scripts' );
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';
/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';
/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';
require get_template_directory() . '/inc/custom-controls/custom-control.php';
/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';
/**
 * Customizer changes css
 */
require get_template_directory() . '/inc/dynamic-css.php';
/**
 * For Admin Page
 */
if ( is_admin() ) {
    require get_template_directory() . '/inc/about/about.php';
}
/**
 * Recommended Plugins
 */
require get_template_directory() . '/inc/tgmpa/recommended-plugins.php';
require get_template_directory() . '/inc/upgrade-to-pro/class-customize.php';