<?php

add_action( 'init', 'ourm_register_post_types' );

function ourm_register_post_types() {
	register_post_type(
		'ourm_projects',
		array(
			'labels'              => array(
				'name'               => __( 'Projects', 'our-mission' ),
				'singular_name'      => __( 'Project', 'our-mission' ),
				'menu_name'          => __( 'Projects', 'our-mission' ),
				'all_items'          => __( 'All Projects', 'our-mission' ),
				'add_new'            => __( 'Add new', 'our-mission' ),
				'add_new_item'       => __( 'Add Projects', 'our-mission' ),
				'edit'               => __( 'Edit', 'our-mission' ),
				'edit_item'          => __( 'Edit Projects', 'our-mission' ),
				'new_item'           => __( 'New Project', 'our-mission' ),
				'view'               => __( 'See Projects', 'our-mission' ),
				'view_item'          => __( 'See Project', 'our-mission' ),
				'search_items'       => __( 'Search Projects', 'our-mission' ),
				'not_found'          => __( 'Projects not found', 'our-mission' ),
				'not_found_in_trash' => __( 'Projects not found in trash', 'our-mission' ),
				'parent'             => __( 'Parent Project', 'our-mission' ),
			),
			'rewrite'             => array(
				'slug' => 'projects',

			),
			'description'         => '',
			'public'              => true,
			'show_ui'             => true,
			'capability_type'     => 'page',
			'map_meta_cap'        => true,
			'publicly_queryable'  => true,
			'exclude_from_search' => false,
			'hierarchical'        => false,
			'query_var'           => true,
			'show_in_rest'        => true,

			'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
			'menu_position'       => 3,
			'has_archive'         => true,
			'show_in_nav_menus'   => true,

		)
	);

	register_post_type(
		'ourm_initiatives',
		array(
			'labels'              => array(
				'name'               => __( 'Initiatives', 'our-mission' ),
				'singular_name'      => __( 'Intiative', 'our-mission' ),
				'menu_name'          => __( 'Initiatives', 'our-mission' ),
				'all_items'          => __( 'All Initiatives', 'our-mission' ),
				'add_new'            => __( 'Add new', 'our-mission' ),
				'add_new_item'       => __( 'Add Initiatives', 'our-mission' ),
				'edit'               => __( 'Edit', 'our-mission' ),
				'edit_item'          => __( 'Edit Initiatives', 'our-mission' ),
				'new_item'           => __( 'New Intiative', 'our-mission' ),
				'view'               => __( 'See Initiatives', 'our-mission' ),
				'view_item'          => __( 'See Intiative', 'our-mission' ),
				'search_items'       => __( 'Search Initiatives', 'our-mission' ),
				'not_found'          => __( 'Initiatives not found', 'our-mission' ),
				'not_found_in_trash' => __( 'Initiatives not found in trash', 'our-mission' ),
				'parent'             => __( 'Parent Intiative', 'our-mission' ),
			),
			'rewrite'             => array(
				'slug' => 'initiatives',

			),
			'description'         => '',
			'public'              => true,
			'show_ui'             => true,
			'capability_type'     => 'page',
			'map_meta_cap'        => true,
			'publicly_queryable'  => true,
			'exclude_from_search' => false,
			'hierarchical'        => false,
			'query_var'           => true,
			'show_in_rest'        => true,

			'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
			'menu_position'       => 5,
			'has_archive'         => true,
			'show_in_nav_menus'   => true,

		)
	);

	register_taxonomy(
		'initiatives_district',
		array( 'ourm_initiatives' ),
		array(
			'label'             => '',
			'labels'            => array(
				'name'                       => __( 'Districts', 'our-mission' ),
				'singular_name'              => __( 'District', 'our-mission' ),
				'search_items'               => __( 'Search District', 'our-mission' ),
				'popular_items'              => __( 'Popular District', 'our-mission' ),
				'all_items'                  => __( 'All Districts', 'our-mission' ),
				'parent_item'                => __( 'Parent District', 'our-mission' ),
				'parent_item_colon'          => __( 'Parent District:', 'our-mission' ),
				'edit_item'                  => __( 'Edit District', 'our-mission' ),
				'update_item'                => __( 'Update District', 'our-mission' ),
				'add_new_item'               => __( 'Add new District', 'our-mission' ),
				'new_item_name'              => __( 'New Name District', 'our-mission' ),
				'separate_items_with_commas' => __( 'Separate Districts by comma', 'our-mission' ),
				'add_or_remove_items'        => __( 'Add or remove District', 'our-mission' ),
				'choose_from_most_used'      => __( 'Choose from the most used Districts', 'our-mission' ),
				'not_found'                  => __( 'District not found.', 'our-mission' ),
				'menu_name'                  => __( 'District', 'our-mission' ),
			),
			'rewrite'           => array(
				'slug' => 'districts',

			),
			'public'            => true,
			'hierarchical'      => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'meta_box_cb'       => 'post_categories_meta_box',

		)
	);

	// register_post_status(
	// 'denied',
	// array(
	// 'label'                     => _x( 'Not supported', 'post' ),
	// 'public'                    => true,
	// 'exclude_from_search'       => false,
	// 'show_in_admin_all_list'    => true,
	// 'show_in_admin_status_list' => true,
	// 'label_count'               => _n_noop( 'Denied <span class="count">(%s)</span>', 'Denied <span class="count">(%s)</span>' ),
	// )
	// );

	// add_action(
	// 'admin_footer-edit.php',
	// function() {
	// echo "<script>
	// jQuery(document).ready( function() {
	// jQuery( 'select[name=\"_status\"]' ).append( '<option value=\"denied\">Denied</option>' );
	// });
	// </script>";
	// }
	// );

	register_post_type(
		'ourm_events',
		array(
			'labels'              => array(
				'name'               => __( 'Events', 'our-mission' ),
				'singular_name'      => __( 'Event', 'our-mission' ),
				'menu_name'          => __( 'Events', 'our-mission' ),
				'all_items'          => __( 'All Events', 'our-mission' ),
				'add_new'            => __( 'Add new', 'our-mission' ),
				'add_new_item'       => __( 'Add Event', 'our-mission' ),
				'edit'               => __( 'Edit', 'our-mission' ),
				'edit_item'          => __( 'Edit Events', 'our-mission' ),
				'new_item'           => __( 'New Event', 'our-mission' ),
				'view'               => __( 'See Events', 'our-mission' ),
				'view_item'          => __( 'See Event', 'our-mission' ),
				'search_items'       => __( 'Search Events', 'our-mission' ),
				'not_found'          => __( 'Events not found', 'our-mission' ),
				'not_found_in_trash' => __( 'Events not found in trash', 'our-mission' ),
				'parent'             => __( 'Parent Events', 'our-mission' ),
			),
			'rewrite'             => array(
				'slug' => 'events',

			),
			'description'         => '',
			'public'              => true,
			'show_ui'             => true,
			'capability_type'     => 'page',
			'map_meta_cap'        => true,
			'publicly_queryable'  => true,
			'exclude_from_search' => false,
			'hierarchical'        => false,
			'query_var'           => true,
			'show_in_rest'        => true,

			'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
			'menu_position'       => 6,
			'has_archive'         => true,
			'show_in_nav_menus'   => true,

		)
	);

	register_post_type(
		'ourm_charity',
		array(
			'labels'              => array(
				'name'               => __( 'Charity', 'our-mission' ),
				'singular_name'      => __( 'Charity', 'our-mission' ),
				'menu_name'          => __( 'Charity', 'our-mission' ),
				'all_items'          => __( 'All Charity', 'our-mission' ),
				'add_new'            => __( 'Add new', 'our-mission' ),
				'add_new_item'       => __( 'Add Charity', 'our-mission' ),
				'edit'               => __( 'Edit', 'our-mission' ),
				'edit_item'          => __( 'Edit Charity', 'our-mission' ),
				'new_item'           => __( 'New Charity', 'our-mission' ),
				'view'               => __( 'See Charity', 'our-mission' ),
				'view_item'          => __( 'See Charity', 'our-mission' ),
				'search_items'       => __( 'Search Charity', 'our-mission' ),
				'not_found'          => __( 'Charity not found', 'our-mission' ),
				'not_found_in_trash' => __( 'Charity not found in trash', 'our-mission' ),
				'parent'             => __( 'Parent Charity', 'our-mission' ),
			),
			'rewrite'             => array(
				'slug' => 'charity',

			),
			'description'         => '',
			'public'              => true,
			'show_ui'             => true,
			'capability_type'     => 'page',
			'map_meta_cap'        => true,
			'publicly_queryable'  => true,
			'exclude_from_search' => false,
			'hierarchical'        => false,
			'query_var'           => true,
			'show_in_rest'        => true,

			'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
			'menu_position'       => 6,
			'has_archive'         => true,
			'show_in_nav_menus'   => true,

		)
	);
	
	//Signed initiatives.
	register_post_type(
		'ourm_ini_signed',
		array(
			'labels'              => array(
				'name'               => __( 'Initiatives signed', 'our-mission' ),
				'singular_name'      => __( 'Intiative', 'our-mission' ),
				'menu_name'          => __( 'Initiatives', 'our-mission' ),
				'all_items'          => __( 'All Initiatives', 'our-mission' ),
				'add_new'            => __( 'Add new', 'our-mission' ),
				'add_new_item'       => __( 'Add Initiatives', 'our-mission' ),
				'edit'               => __( 'Edit', 'our-mission' ),
				'edit_item'          => __( 'Edit Initiatives', 'our-mission' ),
				'new_item'           => __( 'New Intiative', 'our-mission' ),
				'view'               => __( 'See Initiatives', 'our-mission' ),
				'view_item'          => __( 'See Intiative', 'our-mission' ),
				'search_items'       => __( 'Search Initiatives', 'our-mission' ),
				'not_found'          => __( 'Initiatives not found', 'our-mission' ),
				'not_found_in_trash' => __( 'Initiatives not found in trash', 'our-mission' ),
				'parent'             => __( 'Parent Intiative', 'our-mission' ),
			),
			'rewrite'             => false,
			'description'         => '',
			'public'              => false,
			'show_ui'             => true,
			'capability_type'     => 'page',
			'map_meta_cap'        => true,
			'publicly_queryable'  => false,
			'exclude_from_search' => false,
			'hierarchical'        => false,
			'query_var'           => true,
			'show_in_rest'        => false,

			'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
			
			'has_archive'         => false,
			'show_in_nav_menus'   => false,

		)
	);

}
