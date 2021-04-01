<?php
/**
 * myhorizon Theme configuration and setup
 *
 * @package myhorizon
 *
 *
 */

if ( ! function_exists( 'mht_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function mht_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on myhorizon, use a find and replace
	 * to change 'mht' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'mht', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu()
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'mht' ),
	) );
        register_nav_menus( array(
		'legal' => __( 'Legal Menu', 'mht' ),
	) );
        register_nav_menus( array(
		'blog-basics' => __( 'Blog Basics', 'mht' ),
	) );
        register_nav_menus( array(
		'blog-articles' => __( 'Blog Articles', 'mht' ),
	) );
        register_nav_menus( array(
		'blog-tools' => __( 'Blog Tools', 'mht' ),
	) );
        register_nav_menus( array(
		'ft-about' => __( 'Footer About', 'mht' ),
	) );
        register_nav_menus( array(
		'ft-products' => __( 'Footer Products', 'mht' ),
	) );


	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'gallery', 'aside', 'image', 'video', 'quote', 'link'
	) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'mht_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // mht_setup
add_action( 'after_setup_theme', 'mht_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function mht_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Default Sidebar', 'mht' ),
		'id'            => 'default-sidebar',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
        register_sidebar( array(
		'name'          => __( 'Legal Sidebar', 'mht' ),
		'id'            => 'legal-sidebar',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
        register_sidebar( array(
		'name'          => __( 'Footer Address', 'mht' ),
		'id'            => 'footer-address',
		'description'   => '',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );
        register_sidebar( array(
		'name'          => __( 'Footer Brand', 'mht' ),
		'id'            => 'footer-brand',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
        register_sidebar( array(
		'name'          => __( 'Footer Legal', 'mht' ),
		'id'            => 'footer-legal',
		'description'   => '',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );
        register_sidebar( array(
		'name'          => __( 'Header Gutter', 'mht' ),
		'id'            => 'header-gutter',
		'description'   => '',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );
        register_sidebar( array(
		'name'          => __( 'Contact CTA', 'mht' ),
		'id'            => 'contact-cta',
		'description'   => '',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );
        register_sidebar(array(
                'name'          => __('CIN Dismissable Alert', 'mht'),
                'id'            => 'sidebar-cinalert',
                'before_widget' => '',
                'after_widget'  => '',
                'before_title'  => '',
                'after_title'   => '',
	) );
     
            }
add_action( 'widgets_init', 'mht_widgets_init' );
