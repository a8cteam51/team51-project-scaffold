<?php
/**
 * By default, WordPress will load all files in the mu-plugins directory and ignore all the directories inside.
 *
 * This file is a workaround which will load all the plugins in the mu-plugins directory which follow the naming
 * convention of `plugin-name/plugin-name.php`.
 */

defined( 'ABSPATH' ) || exit;

foreach ( glob( __DIR__ . '/*', GLOB_ONLYDIR ) as $bpd_mu_plugin_dir ) {
	$bpd_plugin = $bpd_mu_plugin_dir . DIRECTORY_SEPARATOR . basename( $bpd_mu_plugin_dir ) . '.php';
	if ( file_exists( $bpd_plugin ) ) {
		require_once $bpd_plugin;
	}
}

/**
 * Adds the mu-plugins to the plugins list.
 *
 * @param array $plugins An array of plugins to list.
 *
 * @return array
 */
function t51_mu_plugin_filter( array $plugins ): array {
	unset( $plugins['mustuse']['mu-loader.php'] );

	foreach ( glob( WPMU_PLUGIN_DIR . '/*/*.php' ) as $file ) {
		$plugin_data = get_plugin_data( $file, false, false );

		if ( empty( $plugin_data['Name'] ) ) {
			continue;
		}

		$plugins['mustuse'][ basename( $file ) ] = $plugin_data;
	}

	return $plugins;
}
add_filter( 'plugins_list', 't51_mu_plugin_filter' );