<?php

defined( 'ABSPATH' ) || exit;

/**
 * Loads the features plugin's translated strings.
 *
 * @since   0.1.0
 * @version 0.1.0
 *
 * @return  void
 */
function bpd_features_load_textdomain() {
	load_muplugin_textdomain( 'build-processes-demo-features', dirname( plugin_basename( BPD_FEATURES_DIR ) ) . '/languages' );
}
add_action( 'init', 'bpd_features_load_textdomain' );
