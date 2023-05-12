<?php

defined( 'ABSPATH' ) || exit;

/**
 * Registers custom post types.
 *
 * @since   0.1.0
 * @version 0.1.0
 *
 * @return  void
 */
function bpd_features_register_book_post_type(): void {
	// Set UI labels for Custom Post Type
	$labels = array(
		'name'               => _x( 'Books', 'Post Type General Name', 'build-processes-demo-features' ),
		'singular_name'      => __( 'Book', 'build-processes-demo-features' ),
		'menu_name'          => _x( 'Books', 'Admin Menu text', 'build-processes-demo-features' ),
		'all_items'          => __( 'All Books', 'build-processes-demo-features' ),
		'view_item'          => __( 'View Book', 'build-processes-demo-features' ),
		'add_new_item'       => __( 'Add New Book', 'build-processes-demo-features' ),
		'add_new'            => __( 'Add New', 'build-processes-demo-features' ),
		'edit_item'          => __( 'Edit Book', 'build-processes-demo-features' ),
		'update_item'        => __( 'Update Book', 'build-processes-demo-features' ),
		'search_items'       => __( 'Search Book', 'build-processes-demo-features' ),
		'not_found'          => __( 'Not Found', 'build-processes-demo-features' ),
		'not_found_in_trash' => __( 'Not found in Trash', 'build-processes-demo-features' ),
	);

	// Set other options for Custom Post Type
	$args = array(
		'label'               => __( 'Books', 'build-processes-demo-features' ),
		'description'         => __( 'Books catalogue', 'build-processes-demo-features' ),
		'labels'              => $labels,
		'supports'            => array(
			'title',
			'editor',
			'excerpt',
			'author',
			'thumbnail',
			'comments',
			'revisions',
			'custom-fields',
		),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
		'show_in_rest'        => true,
		'menu_icon'           => 'dashicons-book',
	);

	register_post_type( 'book', $args );
}
add_action( 'init', 'bpd_features_register_book_post_type' );

/**
 * Registers and/or enqueues scripts and stylesheets specific to the book post type.
 *
 * @since   0.1.0
 * @version 0.1.0
 *
 * @return  void
 */
function bpd_features_enqueue_book_post_type_frontend_assets(): void {
	$plugin_slug = bpd_features_get_slug();

	if ( is_post_type_archive( 'book' ) ) {
		$asset_meta = bpd_features_get_asset_meta( BPD_FEATURES_DIR . 'assets/css/build/book-archive.css' );
		wp_enqueue_style(
			"$plugin_slug-book-archive",
			BPD_FEATURES_URL . 'assets/css/build/book-archive.css',
			$asset_meta['dependencies'],
			$asset_meta['version']
		);
	}
	if ( is_singular( 'book' ) ) {
		$asset_meta = bpd_features_get_asset_meta( BPD_FEATURES_DIR . 'assets/css/build/book-singular.css' );
		wp_enqueue_style(
			"$plugin_slug-book-singular",
			BPD_FEATURES_URL . 'assets/css/build/book-singular.css',
			$asset_meta['dependencies'],
			$asset_meta['version']
		);
	}
}
add_action( 'wp_enqueue_scripts', 'bpd_features_enqueue_book_post_type_frontend_assets' );
