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

// Loads the theme's translated strings.
function bpd_load_theme_textdomain(): void {
	load_child_theme_textdomain( 'build-processes-demo', get_stylesheet_directory() . '/languages' );
}
add_action( 'init', 'bpd_load_theme_textdomain' );

// Registers and/or enqueues theme scripts and stylesheets.
function bpd_enqueue_assets(): void {
	$theme_slug = sanitize_key( wp_get_theme()->get( 'Theme Name' ) );
	wp_enqueue_style( $theme_slug, get_stylesheet_uri() . '/style.css', array( /* parent theme style, if applicable */ ), filemtime( get_stylesheet_directory() . 'style.css' ) );

	if ( function_exists( 'is_cart' ) && is_cart() ) {
		$asset_meta = array(
			'dependencies' => array( $theme_slug ),
			'version'      => filemtime( get_stylesheet_directory() . '/assets/css/build/cart.css' ),
		);
		wp_enqueue_style( "$theme_slug-cart", get_stylesheet_directory_uri() . '/assets/css/build/cart.css', $asset_meta['dependencies'], $asset_meta['version'] );
	}
	if ( function_exists( 'is_checkout' ) && is_checkout() ) {
		$asset_meta = array(
			'dependencies' => array( $theme_slug ),
			'version'      => filemtime( get_stylesheet_directory() . '/assets/css/build/checkout.css' ),
		);
		wp_enqueue_style( "$theme_slug-checkout", get_stylesheet_directory_uri() . '/assets/css/build/checkout.css', $asset_meta['dependencies'], $asset_meta['version'] );
	}

	$asset_meta = require get_stylesheet_directory() . '/assets/js/build/index.asset.php';
	wp_enqueue_script( $theme_slug, get_stylesheet_directory_uri() . '/assets/js/build/index.js', $asset_meta['dependencies'], $asset_meta['version'], true );
}
add_action( 'wp_enqueue_scripts', 'bpd_enqueue_assets' );

// Registers an editor stylesheet for the theme.
function bpd_add_editor_style(): void {
	add_editor_style( 'style-editor.css' );
}
add_action( 'admin_init', 'bpd_add_editor_style' );

// Include the rest of the theme functionality.
foreach ( glob( get_stylesheet_directory() . '/includes/*.php' ) as $bpd_filename ) {
	if ( preg_match( '#/includes/_#i', $bpd_filename ) ) {
		continue; // Ignore files prefixed with an underscore.
	}

	include $bpd_filename;
}
