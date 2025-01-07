<?php declare( strict_types=1 );

defined( 'ABSPATH' ) || exit;

/**
 * Simple shortcode to output a string.
 *
 * @return string
 */
function a8csp_sc_translatable_string(): string {
	return __( 'This string can be translated!', 'a8csp-project-scaffold' );
}
add_shortcode( 'translate-string', 'a8csp_sc_translatable_string' );
