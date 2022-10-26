<?php
/**
 * Plugin Name:       Build Processes Demo Blocks
 * Description:       Example block scaffolded with Create Block tool.
 * Requires at least: 6.1
 * Requires PHP:      8.1
 * Version:           0.1.0
 * Author:            WP Special Projects
 * License:           GPL-3.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       build-processes-demo-blocks
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
}
add_action( 'init', 'build_processes_demo_blocks_init' );
