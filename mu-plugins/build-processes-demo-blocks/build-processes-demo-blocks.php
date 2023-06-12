<?php
/**
 * The Build Processes Demo blocks plugin bootstrap file.
 *
 * @since       0.1.0
 * @version     0.1.0
 * @author      WordPress.com Special Projects
 * @license     GPL-3.0-or-later
 *
 * @noinspection    ALL
 *
 * @wordpress-plugin
 * Plugin Name:             Build Processes Demo Blocks
 * Description:             Example block scaffolded with Create Block tool.
 * Version:                 0.1.0
 * Requires at least:       6.1
 * Requires PHP:            8.1
 * Author:                  WordPress.com Special Projects
 * Author URI:              https://wpspecialprojects.wordpress.com/
 * License:                 GPL-3.0-or-later
 * License URI:             https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:             build-processes-demo-blocks
 * Domain Path:             /languages
 */

defined( 'ABSPATH' ) || exit;

// Define plugin constants.
function_exists( 'get_plugin_data' ) || require_once ABSPATH . 'wp-admin/includes/plugin.php';
define( 'BPD_BLOCKS_METADATA', get_plugin_data( __FILE__, false, false ) );

define( 'BPD_BLOCKS_DIR', plugin_dir_path( __FILE__ ) );
define( 'BPD_BLOCKS_URL', plugin_dir_url( __FILE__ ) );

// Include the rest of the blocks plugin's files if system requirements check out.
if ( is_php_version_compatible( BPD_BLOCKS_METADATA['RequiresPHP'] ) && is_wp_version_compatible( BPD_BLOCKS_METADATA['RequiresWP'] ) ) {

	// Block plugin files.
	bpd_blocks_include_files( '/includes/*.php' );

	// Individual block files.
	bpd_blocks_include_files( '/src/*/*.php' );
}


function bpd_blocks_include_files( $directory ) {
	foreach ( glob( __DIR__ . $directory ) as $filename ) {
		if ( ! preg_match( '#/_#i', $filename ) ) {
			include $filename;
		}
	}
}
