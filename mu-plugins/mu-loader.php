<?php
/**
 * By default, WordPress will load all files in the mu-plugins directory and ignore all the directories inside.
 *
 * This file is a workaround which will load all the plugins in the mu-plugins directory which have a root-level file
 * containing a plugin header (@link https://developer.wordpress.org/plugins/plugin-basics/header-requirements/).
 */

defined( 'ABSPATH' ) || exit;

require_once ABSPATH . 'wp-admin/includes/plugin.php';

foreach ( glob( WPMU_PLUGIN_DIR . '/*/*.php' ) as $bpd_mu_plugin_file ) {
	$bpd_mu_plugin_data = get_plugin_data( $bpd_mu_plugin_file, false, false );
	if ( ! empty( $bpd_mu_plugin_data['Name'] ) ) {
		require_once $bpd_mu_plugin_file;
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