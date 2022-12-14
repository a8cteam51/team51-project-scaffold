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
