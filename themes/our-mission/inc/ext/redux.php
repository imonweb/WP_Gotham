<?php
if ( class_exists( 'Redux' ) ) {
	$opt_name = 'ourm_settings';
	$theme    = wp_get_theme();



	$args = array(
		'display_name'    => $theme->get( 'Name' ),
		'display_version' => $theme->get( 'Version' ),
		'menu_title'      => esc_html__( 'Sample Options', 'our-mission' ),
		'customizer'      => true,
	);

	Redux::set_args( $opt_name, $args );

	Redux::set_section(
		$opt_name,
		array(
			'title'  => esc_html__( 'Banner', 'your-textdomain-here' ),
			'id'     => 'basic',

			'icon'   => 'el el-home',
			'fields' => array(
				array(
					'id'       => 'banner_title',
					'type'     => 'text',
					'title'    => esc_html__( 'Banner title', 'your-textdomain-here' ),
					'desc'     => esc_html__( 'Example description.', 'your-textdomain-here' ),
					'subtitle' => esc_html__( 'Example subtitle.', 'your-textdomain-here' ),
					'hint'     => array(
						'content' => 'This is a <b>hint</b> tool-tip for the text field.<br/><br/>Add any HTML based text you like here.',
					),
				),
				array(
					'id'       => 'banner_subtitle',
					'type'     => 'textarea',
					'title'    => esc_html__( 'Banner subtitle', 'your-textdomain-here' ),
					'desc'     => esc_html__( 'Example description.', 'your-textdomain-here' ),
					'subtitle' => esc_html__( 'Example subtitle.', 'your-textdomain-here' ),
					'hint'     => array(
						'content' => 'This is a <b>hint</b> tool-tip for the text field.<br/><br/>Add any HTML based text you like here.',
					),
					'rows'     => '8',
				),
			),
		)
	);

	Redux::set_field(
		$opt_name,
		'basic',
		array(
			'id'      => 'opt-radio',
			'type'    => 'radio',
			'title'   => esc_html__( 'Radio Option', 'your-textdomain-here' ),
			// Must provide key => value pairs for radio options
			'data'    => array(
				'1' => 'Opt 1',
				'2' => 'Opt 2',
				'3' => 'Opt 3',
			),
			'default' => '2',
		)
	);



	Redux::set_field(
		$opt_name,
		'basic',
		array(
			'id'       => 'banner_image',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Banner Image', 'your-textdomain-here' ),
			'desc'     => esc_html__( 'Basic media uploader with disabled URL input field.', 'your-textdomain-here' ),
			'subtitle' => esc_html__( 'Upload any media using the WordPress native uploader', 'your-textdomain-here' ),

		)
	);
	// Menus section
	Redux::set_section(
		$opt_name,
		array(
			'title'  => esc_html__( 'Menus', 'your-textdomain-here' ),
			'id'     => 'menu',

			'icon'   => 'el el-menu',
			'fields' => array(
				array(
					'id'    => 'ourm_header_menu',
					'type'  => 'radio',
					'title' => esc_html__( 'Choose menu', 'your-textdomain-here' ),
					'data'  => array(
						'1' => 'Menu 1',
						'2' => 'Menu 2',

					),
				),
				array(
					'id'    => 'ourm_dark_logo',
					'type'  => 'media',
					'title' => esc_html__( 'Dark logo', 'your-textdomain-here' ),
				),

			),
		)
	);

	// Contacts section

	Redux::set_section(
		$opt_name,
		array(
			'title'  => esc_html__( 'Contacts', 'our-mission' ),
			'id'     => 'contacts',

			'icon'   => 'el el-admin',
			'fields' => array(
				array(
					'id'    => 'contacts_tel',
					'type'  => 'text',
					'title' => esc_html__( 'Phone', 'your-textdomain-here' ),

				),
				array(
					'id'    => 'contacts_working_hours',
					'type'  => 'text',
					'title' => esc_html__( 'Working hours', 'your-textdomain-here' ),

				),
				array(
					'id'    => 'contacts_email',
					'type'  => 'text',
					'title' => esc_html__( 'Email', 'your-textdomain-here' ),

				),
				array(
					'id'    => 'contacts_addr',
					'type'  => 'text',
					'title' => esc_html__( 'Address', 'your-textdomain-here' ),

				),
				array(
					'id'     => 'redux_socials',
					'type'   => 'repeater',
					'title'  => esc_html__( 'Socials', 'your-textdomain-here' ),
					'group_values' => true,
					'fields' => array(
						array(
							'id'    => 'link_text',
							'type'    => 'text',
							'title' => esc_html__( 'Name', 'our-mission' ),

						),
						array(
							'id'    => 'link_url',
							'type'  => 'text',
							'title' => esc_html__( 'Link', 'our-mission' ),

						),
						array(
							'id'    => 'link_icon',
							'type'  => 'media',
							'title' => __( 'Icon', 'our-mission' ),


						),
					),

				),
				array(
					'id'    => 'contacts_map',
					'type'  => 'editor',
					'title' => esc_html__( 'Map', 'your-textdomain-here' ),

				),

			),
		)
	);
}
