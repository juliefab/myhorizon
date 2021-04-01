<?php
/**
 * myhorizon Includes
 *
 * @package myhorizon
 *
 * The $myhorizon_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 */
$myhorizon_includes = array(
  'inc/scripts.php',                // Scripts and stylesheets
  'inc/config.php',                 // Configuration
  'inc/init.php',                   // Theme configuration and setup
  'inc/wrapper.php',                // Theme wrapper class
  'inc/sidebar.php',                // ConditionalTagCheck utility class
  'inc/titles.php',                 // Titles
  'inc/extras.php',                 // Custom functions that act independently of the theme templates
  'inc/template-tags.php',          // Custom template tags for this theme (_s) 
  'inc/jetpack.php',                // Load Jetpack compatibility file. (_s) 
  'inc/wp_bootstrap_navwalker.php'  // Register Custom Navigation Walker
);

foreach ($myhorizon_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'myhorizon'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);