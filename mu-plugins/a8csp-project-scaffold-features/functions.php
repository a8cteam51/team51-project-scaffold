<?php

defined( 'ABSPATH' ) || exit;

/**
 * Returns the mu-plugin's metadata.
 *
 * @template PluginMetaKey of key-of<PluginMetaData>
 *
 * @param   PluginMetaKey|null $property Optional. The property to return. Default all.
 *
 * @return  ($property is null ? PluginMetaData : ($property is PluginMetaKey ? PluginMetaData[PluginMetaKey] : null))
 */
function a8csp_features_get_metadata( ?string $property = null ) {
	static $plugin_data = null;

	if ( null === $plugin_data ) {
		if ( ! function_exists( 'get_plugin_data' ) ) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}

		$plugin_data = get_plugin_data( __DIR__ . '/a8csp-project-scaffold-features.php', true, false );
	}

	$metadata = $plugin_data;
	if ( null === $property ) {
		return $metadata;
	}

	return $metadata[ $property ] ?? null;
}

/**
 * Returns the plugin's slug.
 *
 * @return  string
 */
function a8csp_features_get_slug(): string {
	return 'a8csp-project-scaffold-features';
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
function a8csp_features_get_asset_meta( string $asset_path, ?array $extra_dependencies = null ): ?array {
	$asset_path = str_starts_with( $asset_path, constant( 'A8CSP_FEATURES_DIR_PATH' ) ) ? $asset_path : constant( 'A8CSP_FEATURES_DIR_PATH' ) . $asset_path;
	if ( ! file_exists( $asset_path ) ) {
		return null;
	}

	$asset_meta = array(
		'dependencies' => array(),
		'version'      => (string) filemtime( $asset_path ),
	);
	if ( '' === $asset_meta['version'] ) {
		$asset_meta['version'] = a8csp_features_get_metadata( 'Version' );
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
