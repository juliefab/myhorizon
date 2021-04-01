<?php

/**
 * myhorizon Enqueue scripts and styles. Includes custom WP-Admin styles.
 *
 * @package myhorizon
 *
 */

function myhorizon_scripts() {
    $assets = array(
      'css'       => '/public/css/base.min.css',
      'print'     => '/public/css/print.min.css',
      'script'    => '/public/js/script.min.js',
      'modernizr' => '/public/js/modernizr.min.js',
      'jquery'    => '//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.js'
    );

    wp_enqueue_style('base-style', get_stylesheet_directory_uri() . $assets['css'], false, filemtime( get_stylesheet_directory() . '/public/css/base.min.css' ), 'screen');
    wp_enqueue_style('print-style', get_stylesheet_directory_uri() . $assets['print'], false, filemtime( get_stylesheet_directory() . '/public/css/print.min.css' ), 'print');

   /**
   * jQuery is loaded using the same method from HTML5 Boilerplate:
   * Grab Google CDN's latest jQuery with a protocol relative URL; fallback to local if offline
   * It's kept in the header instead of footer to avoid conflicts with plugins.
   */
  if (!is_admin() && current_theme_supports('jquery-cdn')) {
    wp_deregister_script('jquery');
    wp_register_script('jquery', $assets['jquery'], array(), null, false);
    add_filter('script_loader_src', 'myhorizon_jquery_local_fallback', 10, 2);
  }

  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

  wp_enqueue_script('modernizr', get_template_directory_uri() . $assets['modernizr'], array(), null, false);
  wp_enqueue_script('jquery');
  wp_enqueue_script('script', get_template_directory_uri() . $assets['script'], array(), filemtime( get_template_directory() . $assets['script'] ), true);
}
add_action( 'wp_enqueue_scripts', 'myhorizon_scripts', 100 );

// jQuery local fallback
function myhorizon_jquery_local_fallback($src, $handle = null) {
  static $add_jquery_fallback = false;

  if ($add_jquery_fallback) {
    echo '<script>window.jQuery || document.write(\'<script src="' . get_template_directory_uri() . '/public/js/jquery.min.js?1.11.1"><\/script>\')</script>' . "\n";
    $add_jquery_fallback = false;
  }

  if ($handle === 'jquery') {
    $add_jquery_fallback = true;
  }

  return $src;
}
add_action('wp_head', 'myhorizon_jquery_local_fallback');

/**
 * Custom WP Admin Login Page
 */
// Reference custom login stylesheet
function myhorizon_login_stylesheet() {
    wp_enqueue_style( 'custom-login', get_template_directory_uri() . '/public/css/wp-login.min.css' );
  //wp_enqueue_script( 'custom-login', get_template_directory_uri() . '/public/js/wp-login.min.js' );
}
add_action( 'login_enqueue_scripts', 'myhorizon_login_stylesheet' );

// Change logo link and title
function wpc_url_login(){
	return get_site_url();
}
function wpc_url_title(){
        return get_bloginfo ( 'name' );
 }
add_filter('login_headerurl', 'wpc_url_login');
add_filter('login_headertitle', 'wpc_url_title');
