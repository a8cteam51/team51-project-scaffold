<?php
/**
 * Render callback for the ssrbaz block.
 *
 * @since   0.1.0
 * @version 0.1.0
 *
 * @param array  $attributes The block attributes.
 * @return string The block HTML.
 */
function bpd_blocks_render_block_ssrbaz( $attributes ): string {

	$ssr_output = esc_html__( 'This is a server-side rendered block.', 'build-processes-demo-blocks' );

	return '<div ' . get_block_wrapper_attributes() . '>' . esc_html( $ssr_output ) . '</div>';
}
