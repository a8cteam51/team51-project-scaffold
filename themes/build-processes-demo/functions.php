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

// Include the rest of the theme functionality.
foreach ( glob( get_stylesheet_directory() . '/includes/*.php' ) as $bpd_filename ) {
	if ( preg_match( '#/includes/_#i', $bpd_filename ) ) {
		continue; // Ignore files prefixed with an underscore.
	}

	include $bpd_filename;
}

/**
 * Set up Build Processes Demo Theme textdomain.
 */
function build_processes_demo_theme_setup() {
	load_child_theme_textdomain( 'build-processes-demo', get_stylesheet_directory() . '/languages' );
}

add_action( 'after_setup_theme', 'build_processes_demo_theme_setup' );
