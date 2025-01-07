<?php declare( strict_types=1 );

defined( 'ABSPATH' ) || exit;

// Guard against WooCommerce not being active.
if ( ! class_exists( 'WooCommerce' ) ) {
	return;
}

/**
 * Registers and/or enqueues WooCommerce-specific scripts and stylesheets.
 *
 * @return  void
 */
function a8csp_wc_enqueue_frontend_assets(): void {
	$theme_slug = a8csp_get_theme_slug();

	if ( function_exists( 'is_cart' ) && is_cart() ) {
		$asset_meta = a8csp_get_theme_asset_meta( get_theme_file_path( 'assets/css/build/cart.css' ), array( 'woocommerce-general' ) );
		if ( is_array( $asset_meta ) ) {
			wp_enqueue_style(
				"$theme_slug-cart",
				get_theme_file_uri( 'assets/css/build/cart.css' ),
				$asset_meta['dependencies'],
				$asset_meta['version']
			);
		}
	}
	if ( function_exists( 'is_checkout' ) && is_checkout() ) {
		$asset_meta = a8csp_get_theme_asset_meta( get_theme_file_path( 'assets/css/build/checkout.css' ), array( 'woocommerce-general' ) );
		if ( is_array( $asset_meta ) ) {
			wp_enqueue_style(
				"$theme_slug-checkout",
				get_theme_file_uri( 'assets/css/build/checkout.css' ),
				$asset_meta['dependencies'],
				$asset_meta['version']
			);
		}
	}
}
add_action( 'wp_enqueue_scripts', 'a8csp_wc_enqueue_frontend_assets' );
