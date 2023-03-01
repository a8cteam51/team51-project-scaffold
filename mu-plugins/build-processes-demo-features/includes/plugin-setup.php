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
function bpd_features_load_textdomain(): void {
	load_muplugin_textdomain( BPD_FEATURES_METADATA['TextDomain'], dirname( plugin_basename( BPD_FEATURES_DIR ) ) . BPD_FEATURES_METADATA['DomainPath'] );
}
add_action( 'init', 'bpd_features_load_textdomain' );
