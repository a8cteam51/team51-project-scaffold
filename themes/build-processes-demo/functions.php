<?php
/**
 * Build processes demo theme functions and definitions.
 *
 * @link    https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package BuildProcessesDemo_Theme
 * @since   1.0.0
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Loads theme styles and scripts.
 *
 * @since 1.0.0
 *
 * @return void
 */
function bpd_enqueue_scripts() {
	// Enqueue the theme's stylesheet with cache busting.
	wp_enqueue_style( 'build-processes-demo-style', get_stylesheet_uri(), array(), filemtime( get_stylesheet_directory() . '/style.css' ) );
}
add_action( 'wp_enqueue_scripts', 'bpd_enqueue_scripts' );

// Load the theme's translated strings.
function bpd_load_theme_textdomain(): void {
	load_child_theme_textdomain( 'build-processes-demo', get_stylesheet_directory() . '/languages' );
}
add_action( 'init', 'bpd_load_theme_textdomain' );

// Include the rest of the theme functionality.
foreach ( glob( get_stylesheet_directory() . '/includes/*.php' ) as $bpd_filename ) {
	if ( preg_match( '#/includes/_#i', $bpd_filename ) ) {
		continue; // Ignore files prefixed with an underscore.
	}

	include $bpd_filename;
}
