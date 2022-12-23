<?php

defined( 'ABSPATH' ) || exit;

/**
 * Simple shortcode to output a string.
 *
 * @return string
 */
function bpd_sc_translatable_string(): string {
	return __( 'This string can be translated!', 'build-processes-demo' );
}
add_shortcode( 'translate-string', 'bpd_sc_translatable_string' );
