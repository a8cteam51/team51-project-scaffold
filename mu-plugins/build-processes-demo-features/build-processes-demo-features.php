<?php
/**
 * The Build Processes Demo features plugin bootstrap file.
 *
 * @since       0.1.0
 * @version     0.1.0
 * @author      WordPress.com Special Projects
 * @license     GPL-3.0-or-later
 *
 * @noinspection    ALL
 *
 * @wordpress-plugin
 * Plugin Name:             Build Processes Demo Features
 * Description:             A features plugin for a custom theme. Could include post types, metaboxes etc. Do not use for blocks!
 * Version:                 0.1.0
 * Requires at least:       6.1
 * Requires PHP:            8.1
 * Author:                  WordPress.com Special Projects
 * Author URI:              https://wpspecialprojects.wordpress.com/
 * License:                 GPL-3.0-or-later
 * License URI:             https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:             build-processes-demo-features
 * Domain Path:             /languages
 */

defined( 'ABSPATH' ) || exit;

// Define plugin constants.
function_exists( 'get_plugin_data' ) || require_once ABSPATH . 'wp-admin/includes/plugin.php';
define( 'BPD_FEATURES_METADATA', get_plugin_data( __FILE__, false, false ) );

define( 'BPD_FEATURES_DIR', plugin_dir_path( __FILE__ ) );
define( 'BPD_FEATURES_URL', plugin_dir_url( __FILE__ ) );

// Include the rest of the features plugin's files if system requirements check out.
if ( is_php_version_compatible( BPD_FEATURES_METADATA['RequiresPHP'] ) && is_wp_version_compatible( BPD_FEATURES_METADATA['RequiresWP'] ) ) {
	require_once 'functions.php';

	foreach ( glob( __DIR__ . '/includes/*.php' ) as $bpd_features_filename ) {
		if ( preg_match( '#/includes/_#i', $bpd_features_filename ) ) {
			continue; // Ignore files prefixed with an underscore.
		}

		include $bpd_features_filename;
	}
}
