<?php
/**
 * The Build Processes Demo extra functionality plugin bootstrap file.
 *
 * @since       0.1.0
 * @version     0.1.0
 * @author      WP Special Projects
 * @license     GPL-3.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:             Build Processes Demo Extra Functionality
 * Description:             An extra functionality plugin for a custom theme. Could include post types, metaboxes etc. Do not use for blocks!
 * Version:                 0.1.0
 * Requires at least:       6.1
 * Requires PHP:            8.1
 * Author:                  WP Special Projects
 * Author URI:              https://wpspecialprojects.wordpress.com/
 * License:                 GPL-3.0-or-later
 * License URI:             https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:             build-processes-demo-extra-functionality
 * Domain Path:             /languages
 */

defined( 'ABSPATH' ) || exit;

// Load the extra functionality plugin's translated strings.
function bpd_ef_load_textdomain() {
	load_muplugin_textdomain( 'build-processes-demo-extra-functionality', dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_action( 'muplugins_loaded', 'bpd_ef_load_textdomain' );

// Load the extra functionality plugin's files.
foreach ( glob( get_stylesheet_directory() . '/includes/*.php' ) as $bpd_ef_filename ) {
	if ( preg_match( '#/includes/_#i', $bpd_ef_filename ) ) {
		continue; // Ignore files prefixed with an underscore.
	}

	include $bpd_ef_filename;
}
