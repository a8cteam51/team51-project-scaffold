<?php

/**
 * Simple shortcode to output a string.
 *
 * @return string
 */
function build_processes_demo_translatable_string() {
	return __( 'This string can be translated!', 'build-processes-demo' );
}

add_shortcode( 'translate-string', 'build_processes_demo_translatable_string' );
