<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.

//
// Set a unique slug-like ID.
//
$prefix = '_sp_testimonial_options';

//
// Review text.
//
$url  = 'https://wordpress.org/support/plugin/testimonial-free/reviews/?filter=5#new-post';
$text = sprintf(
	__( 'If you like <strong>Testimonial</strong> please leave us a <a href="%s" target="_blank">&#9733;&#9733;&#9733;&#9733;&#9733;</a> rating. Your Review is very important to us as it helps us to grow more. ', 'testimonial-free' ),
	$url
);

//
// Create a settings page.
//
SPFTESTIMONIAL::createOptions(
	$prefix, array(
		'menu_title'       => __( 'Settings', 'testimonial-free' ),
		'menu_parent'      => 'edit.php?post_type=spt_testimonial',
		'menu_type'        => 'submenu', // menu, submenu, options, theme, etc.
		'menu_slug'        => 'spt_settings',
		'theme'            => 'light',
		'class'            => 'spt-main-class',
		'show_all_options' => false,
		'show_search'      => false,
		'show_footer'      => false,
		'footer_credit'    => $text,
		'framework_title'  => __( 'Testimonial Settings', 'testimonial-free' ),
	)
);

//
// Advanced section.
//
SPFTESTIMONIAL::createSection(
	$prefix, array(
		'name'   => 'advanced_settings',
		'title'  => __( 'Advanced', 'testimonial-free' ),
		'icon'   => 'fa fa-cogs',

		'fields' => array(
			array(
				'id'         => 'spt_enable_schema',
				'type'       => 'switcher',
				'title'      => __( 'Schema Markup', 'testimonial-free' ),
				'subtitle'   => __( 'Enable/Disable schema markup.', 'testimonial-free' ),
				'text_on'    => __( 'Enabled', 'testimonial-free' ),
				'text_off'   => __( 'Disabled', 'testimonial-free' ),
				'text_width' => '98',
				'default'    => false,
			),
		),
	)
);

//
// Custom CSS section.
//
SPFTESTIMONIAL::createSection(
	$prefix, array(
		'name'   => 'custom_css_section',
		'title'  => __( 'Custom CSS', 'testimonial-free' ),
		'icon'   => 'fa fa-css3',

		'fields' => array(
			array(
				'id'       => 'custom_css',
				'type'     => 'code_editor',
				'settings' => array(
					'theme' => 'dracula',
					'mode'  => 'css',
				),
				'title'    => __( 'Custom CSS', 'testimonial-free' ),
				'subtitle' => __( 'Write your custom CSS.', 'testimonial-free' ),
			),
		),
	)
);
