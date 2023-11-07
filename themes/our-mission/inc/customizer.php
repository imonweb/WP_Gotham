<?php
/**
 * our-mission Theme Customizer
 *
 * @package our-mission
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function our_mission_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	$wp_customize->add_panel(
		'ourm_panel',
		array(
			'title'    => __( 'MISSION', 'our-mission' ),
			'priority' => 10,
		)
	);

	// Banner section.
	$wp_customize->add_section(
		'ourm_banner',
		array(
			'title'       => __( 'Banner on front page', 'our-mission' ),
			'description' => __( 'Set up a banner', 'our-mission' ),
			'priority'    => 10,
			'panel'       => 'ourm_panel',

		)
	);

	// Banner title.
	$wp_customize->add_setting(
		'ourm_banner_title',
		array(
			'default'   => __( 'We can live better', 'our-mission' ),
			'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'ourm_banner_title',
		array(
			'type'    => 'text',
			'label'   => esc_html__( 'Banner title', 'our-mission' ),
			'section' => 'ourm_banner',
		)
	);

	// Banner subtitle.
	$wp_customize->add_setting(
		'ourm_banner_subtitle',
		array(
			'default'   => __( 'Today I invite you to become part of my team and together realize the most important goal - to make people happier in the Gotham', 'our-mission' ),
			'transport' => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'ourm_banner_subtitle',
		array(
			'type'    => 'text',
			'label'   => esc_html__( 'Banner subtitle', 'our-mission' ),
			'section' => 'ourm_banner',
		)
	);

	// Banner image.
	$wp_customize->add_setting(
		'ourm_banner_image',
		array(
			'default'   => '',
			'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'ourm_banner_image',
			array(
				'label'    => __( 'Banner image', 'our-mission' ),
				'section'  => 'ourm_banner',
				'settings' => 'ourm_banner_image',
			)
		)
	);

	// Banner image.
	$wp_customize->add_setting(
		'ourm_banner_circles',
		array(
			'default'   => '',
			'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'ourm_banner_circles',
			array(
				'label'    => __( 'Banner circles', 'our-mission' ),
				'section'  => 'ourm_banner',
				'settings' => 'ourm_banner_circles',
			)
		)
	);

		// Socials section.

		$wp_customize->add_section(
			'ourm_socials',
			array(
				'title'    => __( 'Socials', 'our-mission' ),
	
				'priority' => 10,
				'panel'    => 'ourm_panel',
	
			)
		);
		
		// Facebook link.
		$wp_customize->add_setting(
			'ourm_fb_link',
			array(
				'default'   => '',
				'transport' => 'postMessage',
			)
		);
	
		$wp_customize->add_control(
			'ourm_fb_link',
			array(
				'type'    => 'text',
				'label'   => esc_html__( 'Facebook link', 'our-mission' ),
				'section' => 'ourm_socials',
			)
		);
	
		// Facebook icon.
		$wp_customize->add_setting(
			'ourm_fb_icon',
			array(
				'default'   => '',
				'transport' => 'postMessage',
			)
		);
	
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'ourm_fb_icon',
				array(
					'label'    => __( 'Facebook', 'our-mission' ),
					'section'  => 'ourm_socials',
					'settings' => 'ourm_fb_icon',
				)
			)
		);


	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'our_mission_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'our_mission_customize_partial_blogdescription',
			)
		);
	}
}
add_action( 'customize_register', 'our_mission_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function our_mission_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function our_mission_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function our_mission_customize_preview_js() {
	wp_enqueue_script( 'our-mission-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
}
add_action( 'customize_preview_init', 'our_mission_customize_preview_js' );
