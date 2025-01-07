<?php

defined( 'ABSPATH' ) || exit;

/**
 * Loads the features plugin's translated strings.
 *
 * @version 0.1.0
 *
 * @return  void
 */
function a8csp_features_load_textdomain(): void {
	load_muplugin_textdomain(
		a8csp_features_get_metadata( 'TextDomain' ),
		dirname( plugin_basename( constant( 'A8CSP_FEATURES_DIR_PATH' ) ) ) . a8csp_features_get_metadata( 'DomainPath' )
	);
}
add_action( 'init', 'a8csp_features_load_textdomain' );
