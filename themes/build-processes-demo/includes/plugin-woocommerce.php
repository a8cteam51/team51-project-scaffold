<?php

defined( 'ABSPATH' ) || exit;

// Guard against WooCommerce not being active.
if ( ! class_exists( 'WooCommerce' ) ) {
	return;
}

/**
 * Registers and/or enqueues WooCommerce-specific scripts and stylesheets.
 *
 * @since   1.0.0
 * @version 1.0.0
 *
 * @return  void
 */
function bpd_wc_enqueue_frontend_assets(): void {
	$theme_slug = bpd_get_theme_slug();

	if ( function_exists( 'is_cart' ) && is_cart() ) {
		$asset_meta = bpd_get_theme_asset_meta( get_theme_file_path( 'assets/css/build/cart.css' ), array( 'woocommerce-general' ) );
		wp_enqueue_style(
			"$theme_slug-cart",
			get_theme_file_uri( 'assets/css/build/cart.css' ),
			$asset_meta['dependencies'],
			$asset_meta['version']
		);
	}
	if ( function_exists( 'is_checkout' ) && is_checkout() ) {
		$asset_meta = bpd_get_theme_asset_meta( get_theme_file_path( 'assets/css/build/checkout.css' ), array( 'woocommerce-general' ) );
		wp_enqueue_style(
			"$theme_slug-checkout",
			get_theme_file_uri( 'assets/css/build/checkout.css' ),
			$asset_meta['dependencies'],
			$asset_meta['version']
		);
	}
}
add_action( 'wp_enqueue_scripts', 'bpd_wc_enqueue_frontend_assets' );
