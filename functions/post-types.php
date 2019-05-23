<?php
//Classes
add_action( 'init', 'class_post_init' );
function class_post_init() {
	$labels = array(
		'name'               => _x( 'Classes', 'post type general name', 'excavator-template' ),
		'singular_name'      => _x( 'Class', 'post type singular name', 'excavator-template' ),
		'menu_name'          => _x( 'Classes', 'admin menu', 'excavator-template' ),
		'name_admin_bar'     => _x( 'Class', 'add new on admin bar', 'excavator-template' ),
		'add_new'            => _x( 'Add New', 'class', 'excavator-template' ),
		'add_new_item'       => __( 'Add New Class', 'excavator-template' ),
		'new_item'           => __( 'New Class', 'excavator-template' ),
		'edit_item'          => __( 'Edit Class', 'excavator-template' ),
		'view_item'          => __( 'View Class', 'excavator-template' ),
		'all_items'          => __( 'All Classes', 'excavator-template' ),
		'search_items'       => __( 'Search Classes', 'excavator-template' ),
		'parent_item_colon'  => __( 'Parent Classes:', 'excavator-template' ),
		'not_found'          => __( 'No Classes found.', 'excavator-template' ),
		'not_found_in_trash' => __( 'No Classes found in Trash.', 'excavator-template' )
	);

	$args = array(
		'labels'             => $labels,
        'description'        => __( 'Description.', 'excavator-template' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'class' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 6,
		'menu_icon' => 'dashicons-clock',
		'supports'           => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
	);

	register_post_type( 'class', $args );
}


add_action( 'after_switch_theme', 'flush_rewrite_rules' );
