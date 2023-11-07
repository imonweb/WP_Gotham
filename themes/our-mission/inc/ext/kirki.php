<?php
if ( class_exists( 'Kirki' ) ) {

new Kirki\Panel(
	'ourm_kirki_setting',
	array(
		'priority'    => 10,
		'title'       => esc_html__( 'MISSION KIRKI', 'our-mission' ),
		
	)
);

new Kirki\Section(
	'ourm_kirki_banner',
	array(
		'title'       => esc_html__( 'Banner on front page', 'our-mission' ),
		'description' => esc_html__( 'Set up a banner.', 'our-mission' ),
		'panel'       => 'ourm_kirki_setting',
		'priority'    => 160,
	)
);

new Kirki\Field\Text(
	array(
		'settings' => 'ourm_kirki_banner_title',
		'label'    => esc_html__( 'Banner title', 'our-mission' ),
		'section'  => 'ourm_kirki_banner',
		'default'  => esc_html__( 'We can live better', 'our-mission' ),
		'priority' => 10,
	)
);

new Kirki\Field\Textarea(
	array(
		'settings'    => 'ourm_kirki_banner_subtitle',
		'label'       => esc_html__( 'Banner subtitle', 'our-mission' ),
		'section'     => 'ourm_kirki_banner',
		'default'     => esc_html__( 'Today I invite you to become part of my team and together realize the most important goal - to make people happier in the Gotham', 'our-mission' ),
	)
);
//save as url.
new Kirki\Field\Image(
	array(
		'settings'    => 'ourm_kirki_banner_image',
		'label'       => esc_html__( 'Banner image', 'our-mission' ),
		'section'     => 'ourm_kirki_banner',
		'default'     => '',
	
	)
);

new Kirki\Field\Background(
	array(
		'settings'    => 'ourm_kirki_banner_circles',
		'label'       => esc_html__( 'Banner circles', 'our-mission' ),
		
		'section'     => 'ourm_kirki_banner',
		'default'     => [
			'background-color'      => 'rgba(20,20,20,.8)',
			'background-image'      => '',
			'background-repeat'     => 'repeat',
			'background-position'   => 'center center',
			'background-size'       => 'cover',
			'background-attachment' => 'scroll',
		],
		'transport'   => 'auto',
		'output'      => [
			[
				'element' => '.circles-shapes-home',
			],
		],
	)
);

new Kirki\Section(
	'ourm_kirki_socials',
	array(
		'title'       => esc_html__( 'Socials', 'our-mission' ),
		
		'panel'       => 'ourm_kirki_setting',
		'priority'    => 160,
	)
);

new Kirki\Field\Repeater(
	array(
		'settings' => 'ourm_kirki_socials',
		'label'    => esc_html__( 'Socials', 'our-mission' ),
		'section'  => 'ourm_kirki_socials',
		'priority' => 10,
		'row_label'    => array(
			'type'  => 'field',
			'value' => esc_html__( 'social', 'our-mission' ),
			'field' => 'link_text',
		),
		'default'      => array(
			array(
				'link_text' => esc_html__( 'Facebook', 'our-mission' ),
				'link_icon' => '',

				'link_url'  => 'https://facebook.com',
			),
			array(
				'link_text' => esc_html__( 'Telegram', 'our-mission' ),
				'link_icon' => '',

				'link_url'  => 'https://web.telegram.org',
			),
			array(
				'link_text' => esc_html__( 'Instagram', 'our-mission' ),
				'link_icon' => '',

				'link_url'  => 'https://instagram.com',
			),
		),
		'fields'       => array(
			'link_text' => array(
				'type'    => 'text',
				'label'   => esc_html__( 'Name', 'our-mission' ),

				'default' => '',
			),
			'link_url'  => array(
				'type'    => 'link',
				'label'   => esc_html__( 'Link', 'our-mission' ),
				'default' => '',
			),
			'link_icon' => array(
				'type'    => 'image',
				'label'   => __( 'Icon', 'our-mission' ),
				'default' => '',

			),

		),
	)
);

}
