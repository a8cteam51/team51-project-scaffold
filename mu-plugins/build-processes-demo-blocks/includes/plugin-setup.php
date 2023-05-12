<?php

defined( 'ABSPATH' ) || exit;

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets, so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @since   0.1.0
 * @version 0.1.0
 *
 * @return  void
 */
function bpd_blocks_init(): void {
	register_block_type( BPD_BLOCKS_DIR . 'build/foobar' );
	register_block_type( BPD_BLOCKS_DIR . 'build/spamham' );
}
add_action( 'init', 'bpd_blocks_init' );

/**
 * Loads the blocks plugin's translated strings.
 *
 * @since   0.1.0
 * @version 0.1.0
 *
 * @return  void
 */
function bpd_blocks_load_textdomain(): void {
	load_muplugin_textdomain( BPD_BLOCKS_METADATA['TextDomain'], dirname( plugin_basename( BPD_BLOCKS_DIR ) ) . BPD_BLOCKS_METADATA['DomainPath'] );

	foreach ( glob( BPD_BLOCKS_DIR . 'build/*', GLOB_ONLYDIR ) as $bpd_block_dir ) {
		$bpd_block_name = basename( $bpd_block_dir );
		wp_set_script_translations(
			generate_block_asset_handle( "build-processes-demo/$bpd_block_name", 'editorScript' ),
			BPD_BLOCKS_METADATA['TextDomain'],
			untrailingslashit( BPD_BLOCKS_DIR ) . BPD_BLOCKS_METADATA['DomainPath']
		);
	}
}
add_action( 'init', 'bpd_blocks_load_textdomain', 11 );
