<?php

function bpd_extra_functionality_register_book_post_type() {
	// Set UI labels for Custom Post Type
	$labels = array(
		'name'               => _x( 'Books', 'Post Type General Name', 'build-processes-demo-extra-functionality' ),
		'singular_name'      => __( 'Book', 'build-processes-demo-extra-functionality' ),
		'menu_name'          => _x( 'Books', 'Admin Menu text', 'build-processes-demo-extra-functionality' ),
		'all_items'          => __( 'All Books', 'build-processes-demo-extra-functionality' ),
		'view_item'          => __( 'View Book', 'build-processes-demo-extra-functionality' ),
		'add_new_item'       => __( 'Add New Book', 'build-processes-demo-extra-functionality' ),
		'add_new'            => __( 'Add New', 'build-processes-demo-extra-functionality' ),
		'edit_item'          => __( 'Edit Book', 'build-processes-demo-extra-functionality' ),
		'update_item'        => __( 'Update Book', 'build-processes-demo-extra-functionality' ),
		'search_items'       => __( 'Search Book', 'build-processes-demo-extra-functionality' ),
		'not_found'          => __( 'Not Found', 'build-processes-demo-extra-functionality' ),
		'not_found_in_trash' => __( 'Not found in Trash', 'build-processes-demo-extra-functionality' ),
	);

	// Set other options for Custom Post Type
	$args = array(
		'label'               => __( 'Books', 'build-processes-demo-extra-functionality' ),
		'description'         => __( 'Books catalogue', 'build-processes-demo-extra-functionality' ),
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

add_action( 'init', 'bpd_extra_functionality_register_book_post_type' );
