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
 * Returns the theme's slug.
 *
 * @since   1.0.0
 * @version 1.0.0
 *
 * @return  string
 */
function bpd_get_theme_slug(): string {
	return sanitize_key( wp_get_theme()->get( 'Name' ) );
}

/**
 * Returns an array with meta information for a given asset path. First, it checks for an .asset.php file in the same directory
 * as the given asset file whose contents are returns if it exists. If not, it returns an array with the file's last modified
 * time as the version and the main stylesheet + any extra dependencies passed in as the dependencies.
 *
 * @since   1.0.0
 * @version 1.0.0
 *
 * @param   string     $asset_path         The path to the asset file.
 * @param   array|null $extra_dependencies Any extra dependencies to include in the returned meta.
 *
 * @return  array|null
 */
function bpd_get_theme_asset_meta( string $asset_path, ?array $extra_dependencies = null ): ?array {
	if ( ! file_exists( $asset_path ) || ! str_starts_with( $asset_path, get_stylesheet_directory() ) ) {
		return null;
	}

	$asset_path_info = pathinfo( $asset_path );
	if ( file_exists( $asset_path_info['dirname'] . '/' . $asset_path_info['filename'] . '.asset.php' ) ) {
		$asset_meta  = require $asset_path_info['dirname'] . '/' . $asset_path_info['filename'] . '.asset.php';
		$asset_meta += array( 'dependencies' => array() ); // Ensure 'dependencies' key exists.
	} else {
		$asset_meta = array(
			'dependencies' => array(),
			'version'      => filemtime( $asset_path ),
		);
		if ( 'css' === $asset_path_info['extension'] && get_theme_file_path( 'style.css' ) !== $asset_path ) {
			$asset_meta['dependencies'][] = bpd_get_theme_slug() . '-style';
		}
		if ( false === $asset_meta['version'] ) { // Safeguard against filemtime() returning false.
			$asset_meta['version'] = wp_get_theme()->get( 'Version' );
		}
	}

	if ( is_array( $extra_dependencies ) ) {
		$asset_meta['dependencies'] = array_merge( $asset_meta['dependencies'], $extra_dependencies );
		$asset_meta['dependencies'] = array_unique( $asset_meta['dependencies'] );
	}

	return $asset_meta;
}

// Include the rest of the theme's files.
foreach ( glob( __DIR__ . '/includes/*.php' ) as $bpd_filename ) {
	if ( preg_match( '#/includes/_#i', $bpd_filename ) ) {
		continue; // Ignore files prefixed with an underscore.
	}

	include $bpd_filename;
}
