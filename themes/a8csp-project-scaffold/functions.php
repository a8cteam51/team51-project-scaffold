<?php
/**
 * A8CSP Project Scaffold theme functions and definitions.
 *
 * @link    https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package A8CSPProjectScaffold_Theme
 */

defined( 'ABSPATH' ) || exit;

/**
 * Returns the theme's slug.
 *
 * @return  string
 */
function a8csp_get_theme_slug(): string {
	return sanitize_key( wp_get_theme()->get( 'Name' ) );
}

/**
 * Returns an array with meta information for a given asset path. First, it checks for an .asset.php file in the same directory
 * as the given asset file whose contents are returns if it exists. If not, it returns an array with the file's last modified
 * time as the version and the main stylesheet + any extra dependencies passed in as the dependencies.
 *
 * @param   string        $asset_path         The path to the asset file.
 * @param   string[]|null $extra_dependencies Any extra dependencies to include in the returned meta.
 *
 * @return  array{ version: string, dependencies: array<string> }|null
 */
function a8csp_get_theme_asset_meta( string $asset_path, ?array $extra_dependencies = null ): ?array {
	$asset_path = str_starts_with( $asset_path, get_stylesheet_directory() ) ? $asset_path : get_stylesheet_directory() . "/$asset_path";
	if ( ! file_exists( $asset_path ) ) {
		return null;
	}

	$asset_meta = array(
		'dependencies' => array(),
		'version'      => (string) filemtime( $asset_path ),
	);
	if ( '' === $asset_meta['version'] ) {
		$asset_meta['version'] = wp_get_theme()->get( 'Version' );
	}

	$asset_pathinfo              = pathinfo( $asset_path );
	$asset_pathinfo['dirname'] ??= '';

	$asset_meta_file = "{$asset_pathinfo['dirname']}/{$asset_pathinfo['filename']}.asset.php";
	if ( file_exists( $asset_meta_file ) ) {
		$asset_meta_generated = require $asset_meta_file;

		if ( isset( $asset_meta_generated['version'] ) ) {
			$asset_meta['version'] = $asset_meta_generated['version'];
		}
		if ( isset( $asset_meta_generated['dependencies'] ) ) {
			$asset_meta['dependencies'] = $asset_meta_generated['dependencies'];
		}
	}

	if ( is_array( $extra_dependencies ) ) {
		$asset_meta['dependencies'] = array_merge( $asset_meta['dependencies'], $extra_dependencies );
		$asset_meta['dependencies'] = array_unique( $asset_meta['dependencies'] );
	}

	return $asset_meta;
}

// Include the rest of the theme's files.
$a8csp_theme_files = glob( __DIR__ . '/includes/*.php' );
if ( false !== $a8csp_theme_files ) {
	foreach ( $a8csp_theme_files as $a8csp_filename ) {
		if ( 1 === preg_match( '#/includes/_#i', $a8csp_filename ) ) {
			continue; // Ignore files prefixed with an underscore.
		}

		include $a8csp_filename;
	}
}
