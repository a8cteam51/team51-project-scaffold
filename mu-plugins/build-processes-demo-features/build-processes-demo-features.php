<?php
/**
 * The Build Processes Demo features plugin bootstrap file.
 *
 * @since       0.1.0
 * @version     0.1.0
 * @author      WP Special Projects
 * @license     GPL-3.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:             Build Processes Demo Features
 * Description:             A features plugin for a custom theme. Could include post types, metaboxes etc. Do not use for blocks!
 * Version:                 0.1.0
 * Requires at least:       6.1
 * Requires PHP:            8.1
 * Author:                  WP Special Projects
 * Author URI:              https://wpspecialprojects.wordpress.com/
 * License:                 GPL-3.0-or-later
 * License URI:             https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:             build-processes-demo-features
 * Domain Path:             /languages
 */

defined( 'ABSPATH' ) || exit;

// Load the features plugin's translated strings.
function bpd_features_load_textdomain() {
	load_muplugin_textdomain( 'build-processes-demo-features', dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_action( 'init', 'bpd_features_load_textdomain' );

// Load the features plugin's files.
foreach ( glob( __DIR__ . '/includes/*.php' ) as $bpd_features_filename ) {
	if ( preg_match( '#/includes/_#i', $bpd_features_filename ) ) {
		continue; // Ignore files prefixed with an underscore.
	}

	include $bpd_features_filename;
}
