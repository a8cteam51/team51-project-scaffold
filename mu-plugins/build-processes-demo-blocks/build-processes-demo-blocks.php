<?php
/**
 * The Build Processes Demo blocks plugin bootstrap file.
 *
 * @since       0.1.0
 * @version     0.1.0
 * @author      WP Special Projects
 * @license     GPL-3.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:             Build Processes Demo Blocks
 * Description:             Example block scaffolded with Create Block tool.
 * Version:                 0.1.0
 * Requires at least:       6.1
 * Requires PHP:            8.1
 * Author:                  WP Special Projects
 * Author URI:              https://wpspecialprojects.wordpress.com/
 * License:                 GPL-3.0-or-later
 * License URI:             https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:             build-processes-demo-blocks
 * Domain Path:             /languages
 */

defined( 'ABSPATH' ) || exit;

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function build_processes_demo_blocks_init(): void {
	register_block_type( __DIR__ . '/build/foobar' );
	register_block_type( __DIR__ . '/build/spamham' );

	load_muplugin_textdomain( 'build-processes-demo-blocks', dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	wp_set_script_translations( 'build-processes-demo-foobar-editor-script', 'build-processes-demo-blocks', plugin_dir_path( __FILE__ ) . '/languages' );
	wp_set_script_translations( 'build-processes-demo-spamham-editor-script', 'build-processes-demo-blocks', plugin_dir_path( __FILE__ ) . '/languages' );
}
add_action( 'init', 'build_processes_demo_blocks_init' );
