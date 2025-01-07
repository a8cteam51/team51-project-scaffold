<?php

defined( 'ABSPATH' ) || exit;

/**
 * Registers custom post types.
 *
 * @return  void
 */
function a8csp_features_register_book_post_type(): void {
	// Set UI labels for Custom Post Type
	$labels = array(
		'name'               => _x( 'Books', 'Post Type General Name', 'a8csp-project-scaffold-features' ),
		'singular_name'      => __( 'Book', 'a8csp-project-scaffold-features' ),
		'menu_name'          => _x( 'Books', 'Admin Menu text', 'a8csp-project-scaffold-features' ),
		'all_items'          => __( 'All Books', 'a8csp-project-scaffold-features' ),
		'view_item'          => __( 'View Book', 'a8csp-project-scaffold-features' ),
		'add_new_item'       => __( 'Add New Book', 'a8csp-project-scaffold-features' ),
		'add_new'            => __( 'Add New', 'a8csp-project-scaffold-features' ),
		'edit_item'          => __( 'Edit Book', 'a8csp-project-scaffold-features' ),
		'update_item'        => __( 'Update Book', 'a8csp-project-scaffold-features' ),
		'search_items'       => __( 'Search Book', 'a8csp-project-scaffold-features' ),
		'not_found'          => __( 'Not Found', 'a8csp-project-scaffold-features' ),
		'not_found_in_trash' => __( 'Not found in Trash', 'a8csp-project-scaffold-features' ),
	);

	// Set other options for Custom Post Type
	$args = array(
		'label'               => __( 'Books', 'a8csp-project-scaffold-features' ),
		'description'         => __( 'Books catalogue', 'a8csp-project-scaffold-features' ),
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
		'rewrite'             => array(
			'slug'       => 'book',
			'with_front' => false,
		),
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
		'show_in_rest'        => true,
		'menu_icon'           => 'dashicons-book',
	);

	register_post_type( 'book', $args );
}
add_action( 'init', 'a8csp_features_register_book_post_type' );

/**
 * Registers and/or enqueues scripts and stylesheets specific to the book post type.
 *
 * @return  void
 */
function a8csp_features_enqueue_book_post_type_frontend_assets(): void {
	$plugin_slug = a8csp_features_get_slug();

	if ( is_post_type_archive( 'book' ) ) {
		$asset_meta = a8csp_features_get_asset_meta( 'assets/css/build/book-archive.css' );
		if ( is_array( $asset_meta ) ) {
			wp_enqueue_style(
				"$plugin_slug-book-archive",
				constant( 'A8CSP_FEATURES_DIR_URL' ) . 'assets/css/build/book-archive.css',
				$asset_meta['dependencies'],
				$asset_meta['version']
			);
		}
	}
	if ( is_singular( 'book' ) ) {
		$asset_meta = a8csp_features_get_asset_meta( 'assets/css/build/book-singular.css' );
		if ( is_array( $asset_meta ) ) {
			wp_enqueue_style(
				"$plugin_slug-book-singular",
				constant( 'A8CSP_FEATURES_DIR_URL' ) . 'assets/css/build/book-singular.css',
				$asset_meta['dependencies'],
				$asset_meta['version']
			);
		}
	}
}
add_action( 'wp_enqueue_scripts', 'a8csp_features_enqueue_book_post_type_frontend_assets' );
