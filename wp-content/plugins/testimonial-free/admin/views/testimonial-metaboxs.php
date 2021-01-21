<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.

/**
 * Sanitize function for text field.
 */
if ( ! function_exists( 'spftestimonial_sanitize_text' ) ) {
	function spftestimonial_sanitize_text( $value ) {

		$safe_text = filter_var( $value, FILTER_SANITIZE_STRING );
		return $safe_text;

	}
}

//
// Metabox of the testimonial shortcode generator.
// Set a unique slug-like ID.
//
$prefix_shortcode_opts = 'sp_tpro_shortcode_options';

//
// Testimonial metabox.
//
SPFTESTIMONIAL::createMetabox(
	$prefix_shortcode_opts, array(
		'title'     => __( 'Shortcode Options', 'testimonial-free' ),
		'class'     => 'spt-main-class',
		'post_type' => 'sp_tfree_shortcodes',
		// 'post_type' => 'sp_tpro_shortcodes',
		'context'   => 'normal',
	)
);

//
// General Settings section.
//
SPFTESTIMONIAL::createSection(
	$prefix_shortcode_opts, array(
		'title'  => __( 'General Settings', 'testimonial-free' ),
		'icon'   => 'fa fa-wrench',
		'fields' => array(

			array(
				'id'       => 'layout',
				'type'     => 'image_select',
				'title'    => __( 'Layout Preset', 'testimonial-free' ),
				'subtitle' => __( 'Select a layout to display the testimonials.', 'testimonial-free' ),
				'class'    => 'tfree-layout-preset',
				'options'  => array(
					'slider'  => array(
						'image' => plugin_dir_url( __FILE__ ) . 'framework/assets/images/layout/slider.png',
						'name'  => __( 'Slider', 'testimonial-free' ),
						'class'       => 'free-feature',
					),
					'grid'    => array(
						'image' => plugin_dir_url( __FILE__ ) . 'framework/assets/images/layout/grid.png',
						'name'  => __( 'Grid', 'testimonial-free' ),
						'class'       => 'pro-feature',
					),
					'masonry' => array(
						'image' => plugin_dir_url( __FILE__ ) . 'framework/assets/images/layout/masonry.png',
						'name'  => __( 'Masonry', 'testimonial-free' ),
						'class'       => 'pro-feature',
					),
					'list'    => array(
						'image' => plugin_dir_url( __FILE__ ) . 'framework/assets/images/layout/list.png',
						'name'  => __( 'List', 'testimonial-free' ),
						'class'       => 'pro-feature',
					),
					'filter'  => array(
						'image' => plugin_dir_url( __FILE__ ) . 'framework/assets/images/layout/filter.png',
						'name'  => __( 'Filter', 'testimonial-free' ),
						'class'       => 'pro-feature',
					),
				),
				'default'  => 'slider',
			),
			array(
				'id'       => 'theme_style',
				'type'     => 'select_f',
				'title'    => __( 'Select Theme', 'testimonial-free' ),
				'subtitle' => __( 'Select which theme you want to display.', 'testimonial-free' ),
				'options'  => array(
					'theme-one'   => array(
						'name'     => __( 'Theme One', 'testimonial-free' ),
						'pro_only' => false,
					),
					'theme-two'   => array(
						'name'     => __( '9+ Themes (Pro)', 'testimonial-free' ),
						'pro_only' => true,
					),
				),
				'default'  => 'theme-one',
			),
			array(
				'id'       => 'display_testimonials_from',
				'type'     => 'select_f',
				'title'    => __( 'Filter Testimonials', 'testimonial-free' ),
				'subtitle' => __( 'Select an option to display the testimonials.', 'testimonial-free' ),
				'options'  => array(
					'latest'                => array(
						'name'     => __( 'Latest', 'testimonial-free' ),
						'pro_only' => false,
					),
					'category'              => array(
						'name'     => __( 'Groups (Pro)', 'testimonial-free' ),
						'pro_only' => true,
					),
					'specific_testimonials' => array(
						'name'     => __( 'Specific (Pro)', 'testimonial-free' ),
						'pro_only' => true,
					),
					'exclude' => array(
						'name'     => __( 'Exclude (Pro)', 'testimonial-free' ),
						'pro_only' => true,
					),
				),
				'default'  => 'latest',
			),
			array(
				'id'       => 'number_of_total_testimonials',
				'type'     => 'spinner',
				'title'    => __( 'Limit', 'testimonial-free' ),
				'subtitle' => __( 'Limit number of testimonials to show.', 'testimonial-free' ),
				'default'  => '12',
				'min'      => -1,
			),
			array(
				'id'       => 'columns',
				'type'     => 'column',
				'title'    => __( 'Responsive Column(s)', 'testimonial-free' ),
				'subtitle' => __( 'Set number of column(s) in different devices for responsive view.', 'testimonial-free' ),
				'default'  => array(
					'large_desktop' => '1',
					'desktop'       => '1',
					'laptop'        => '1',
					'tablet'        => '1',
					'mobile'        => '1',
				),
			),
			array(
				'id'       => 'testimonial_order_by',
				'type'     => 'select',
				'title'    => __( 'Order By', 'testimonial-free' ),
				'subtitle' => __( 'Select an order by option.', 'testimonial-free' ),
				'options'  => array(
					'ID'       => __( 'Testimonial ID', 'testimonial-free' ),
					'date'     => __( 'Date', 'testimonial-free' ),
					'title'    => __( 'Title', 'testimonial-free' ),
					'modified' => __( 'Modified', 'testimonial-free' ),
				),
				'default'  => 'date',
			),
			array(
				'id'       => 'testimonial_order',
				'type'     => 'select',
				'title'    => __( 'Order Type', 'testimonial-free' ),
				'subtitle' => __( 'Select an order option.', 'testimonial-free' ),
				'options'  => array(
					'ASC'  => __( 'Ascending', 'testimonial-free' ),
					'DESC' => __( 'Descending', 'testimonial-free' ),
				),
				'default'  => 'DESC',
			),
			
		),
	)
);

//
// Slider Settings section.
//
SPFTESTIMONIAL::createSection(
	$prefix_shortcode_opts, array(
		'title'  => __( 'Slider Settings', 'testimonial-free' ),
		'icon'   => 'fa fa-sliders',
		'fields' => array(

			array(
				'id'       => 'slider_auto_play',
				'type'     => 'button_set',
				'title'    => __( 'AutoPlay', 'testimonial-free' ),
				'subtitle' => __( 'On/Off auto play.', 'testimonial-free' ),
				'options'  => array(
					'true'          => __( 'On', 'testimonial-free' ),
					'false'         => __( 'Off', 'testimonial-free' ),
					'off_on_mobile' => __( 'Off on Mobile', 'testimonial-free' ),
				),
				'default'  => 'true',
			),
			array(
				'id'         => 'slider_auto_play_speed',
				'type'       => 'spinner',
				'title'      => __( 'AutoPlay Speed', 'testimonial-free' ),
				'subtitle'   => __( 'Set auto play speed in a millisecond. Default value 3000ms.', 'testimonial-free' ),
				'default'    => '3000',
				'min'        => 1,
				'unit'       => __( 'ms', 'testimonial-free' ),
				'dependency' => array(
					'slider_auto_play',
					'any',
					'true,off_on_mobile',
				),
			),
			array(
				'id'       => 'slider_scroll_speed',
				'type'     => 'spinner',
				'title'    => __( 'Pagination Speed', 'testimonial-free' ),
				'subtitle' => __( 'Set pagination speed in a millisecond. Default value 600ms.', 'testimonial-free' ),
				'unit'     => __( 'ms', 'testimonial-free' ),
				'default'  => '600',
				'min'      => 1,
			),
			array(
				'id'       => 'slider_pause_on_hover',
				'type'     => 'switcher',
				'title'    => __( 'Pause on Hover', 'testimonial-free' ),
				'subtitle' => __( 'On/Off slider pause on hover.', 'testimonial-free' ),
				'default'  => true,
			),
			array(
				'id'       => 'slider_infinite',
				'type'     => 'switcher',
				'title'    => __( 'Infinite Loop', 'testimonial-free' ),
				'subtitle' => __( 'On/Off infinite loop mode.', 'testimonial-free' ),
				'default'  => true,
			),
			array(
				'id'       => 'slider_direction',
				'type'     => 'button_set',
				'title'    => __( 'Direction', 'testimonial-free' ),
				'subtitle' => __( 'Slider direction.', 'testimonial-free' ),
				'options'  => array(
					'ltr' => __( 'Right to Left', 'testimonial-free' ),
					'rtl' => __( 'Left to Right', 'testimonial-free' ),
				),
				'default'  => 'ltr',
			),
			array(
				'type'    => 'subheading',
				'content' => __( 'Navigation', 'testimonial-free' ),
			),
			array(
				'id'       => 'navigation',
				'type'     => 'button_set',
				'title'    => __( 'Navigation', 'testimonial-free' ),
				'subtitle' => __( 'Show/Hide slider navigation.', 'testimonial-free' ),
				'options'  => array(
					'true'           => __( 'Show', 'testimonial-free' ),
					'false'          => __( 'Hide', 'testimonial-free' ),
					'hide_on_mobile' => __( 'Hide on Mobile', 'testimonial-free' ),
				),
				'default'  => 'true',
			),
			array(
				'id'         => 'navigation_color',
				'type'       => 'color_group',
				'title'      => __( 'Navigation Color', 'testimonial-free' ),
				'subtitle'   => __( 'Set the navigation color.', 'testimonial-free' ),
				'options'    => array(
					'color'            => __( 'Color', 'testimonial-free' ),
					'hover-color'      => __( 'Hover Color', 'testimonial-free' ),
					'background'       => __( 'Background', 'testimonial-free' ),
					'hover-background' => __( 'Hover Background', 'testimonial-free' ),
				),
				'default'    => array(
					'color'            => '#ffffff',
					'hover-color'      => '#ffffff',
					'background'       => '#777777',
					'hover-background' => '#52b3d9',
				),
				'dependency' => array(
					'navigation',
					'any',
					'true,hide_on_mobile',
				),
			),
			array(
				'id'          => 'navigation_border',
				'type'        => 'border',
				'title'       => __( 'Navigation Border', 'testimonial-free' ),
				'subtitle'    => __( 'Set the navigation border.', 'testimonial-free' ),
				'all'         => true,
				'hover_color' => true,
				'default'     => array(
					'all'         => '0',
					'style'       => 'solid',
					'color'       => '#777777',
					'hover-color' => '#52b3d9',
				),
				'dependency' => array(
					'navigation',
					'any',
					'true,hide_on_mobile',
				),
			),

			array(
				'type'    => 'subheading',
				'content' => __( 'Pagination', 'testimonial-free' ),
			),
			array(
				'id'       => 'pagination',
				'type'     => 'button_set',
				'title'    => __( 'Pagination', 'testimonial-free' ),
				'subtitle' => __( 'Show/Hide pagination.', 'testimonial-free' ),
				'options'  => array(
					'true'           => __( 'Show', 'testimonial-free' ),
					'false'          => __( 'Hide', 'testimonial-free' ),
					'hide_on_mobile' => __( 'Hide on Mobile', 'testimonial-free' ),
				),
				'default'  => 'true',
			),
			array(
				'id'         => 'pagination_colors',
				'type'       => 'color_group',
				'title'      => __( 'Pagination Color', 'testimonial-free' ),
				'subtitle'   => __( 'Set the pagination color.', 'testimonial-free' ),
				'options'    => array(
					'color'        => __( 'Color', 'testimonial-free' ),
					'active-color' => __( 'Active Color', 'testimonial-free' ),
				),
				'default'    => array(
					'color'        => '#cccccc',
					'active-color' => '#52b3d9',
				),
				'dependency' => array(
					'pagination',
					'any',
					'true,hide_on_mobile',
				),
			),
			array(
				'type'    => 'subheading',
				'content' => __( 'Miscellaneous', 'testimonial-free' ),
			),
			array(
				'id'       => 'adaptive_height',
				'type'     => 'switcher',
				'title'    => __( 'Adaptive Slider Height', 'testimonial-free' ),
				'subtitle' => __( 'Dynamically adjust slider height based on each slide\'s height.', 'testimonial-free' ),
				'default'  => false,
			),
			array(
				'id'       => 'slider_swipe',
				'type'     => 'switcher',
				'title'    => __( 'Touch Swipe', 'testimonial-free' ),
				'subtitle' => __( 'On/Off swipe mode.', 'testimonial-free' ),
				'default'  => true,
			),
			array(
				'id'         => 'slider_draggable',
				'type'       => 'switcher',
				'title'      => __( 'Mouse Draggable', 'testimonial-free' ),
				'subtitle'   => __( 'On/Off mouse draggable mode.', 'testimonial-free' ),
				'default'    => true,
				'dependency' => array( 'slider_swipe', '==', 'true' ),
			),
			array(
				'id'         => 'swipe_to_slide',
				'type'       => 'switcher',
				'title'      => __( 'Swipe to Slide', 'testimonial-free' ),
				'subtitle'   => __( 'On/Off swipe to slide.', 'testimonial-free' ),
				'default'    => false,
				'dependency' => array( 'slider_swipe', '==', 'true' ),
			),

		),
	)
);

//
// Display Settings section.
//
SPFTESTIMONIAL::createSection(
	$prefix_shortcode_opts, array(
		'title'  => __( 'Display Settings', 'testimonial-free' ),
		'icon'   => 'fa fa-th-large',
		'fields' => array(

			array(
				'id'       => 'section_title',
				'type'     => 'switcher',
				'title'    => __( 'Section Title', 'testimonial-free' ),
				'subtitle' => __( 'Show/Hide the testimonial section title.', 'testimonial-free' ),
				'text_on'    => __( 'Show', 'testimonial-free' ),
				'text_off'   => __( 'Hide', 'testimonial-free' ),
				'text_width' => 80,
				'default'  => false,
			),
			array(
				'type'    => 'subheading',
				'content' => __( 'Testimonial Content', 'testimonial-free' ),
			),
			array(
				'id'       => 'testimonial_title',
				'type'     => 'switcher',
				'title'    => __( 'Testimonial Title', 'testimonial-free' ),
				'subtitle' => __( 'Show/Hide testimonial tagline or title.', 'testimonial-free' ),
				'text_on'    => __( 'Show', 'testimonial-free' ),
				'text_off'   => __( 'Hide', 'testimonial-free' ),
				'text_width' => 80,
				'default'  => true,
			),
			array(
				'id'       => 'testimonial_text',
				'type'     => 'switcher',
				'title'    => __( 'Testimonial Content', 'testimonial-free' ),
				'subtitle' => __( 'Show/Hide testimonial content.', 'testimonial-free' ),
				'text_on'    => __( 'Show', 'testimonial-free' ),
				'text_off'   => __( 'Hide', 'testimonial-free' ),
				'text_width' => 80,
				'default'  => true,
			),
			array(
				'type'    => 'subheading',
				'content' => __( 'Reviewer Information', 'testimonial-free' ),
			),
			array(
				'id'       => 'testimonial_client_name',
				'type'     => 'switcher',
				'title'    => __( 'Full Name', 'testimonial-free' ),
				'subtitle' => __( 'Show/Hide reviewer full name.', 'testimonial-free' ),
				'text_on'    => __( 'Show', 'testimonial-free' ),
				'text_off'   => __( 'Hide', 'testimonial-free' ),
				'text_width' => 80,
				'default'  => true,
			),
			array(
				'id'       => 'testimonial_client_rating',
				'type'     => 'switcher',
				'title'    => __( 'Rating', 'testimonial-free' ),
				'subtitle' => __( 'Show/Hide rating.', 'testimonial-free' ),
				'text_on'    => __( 'Show', 'testimonial-free' ),
				'text_off'   => __( 'Hide', 'testimonial-free' ),
				'text_width' => 80,
				'default'  => true,
			),
			array(
				'id'         => 'testimonial_client_rating_color',
				'type'       => 'color',
				'title'      => __( 'Rating Color', 'testimonial-free' ),
				'subtitle'   => __( 'Set color for rating.', 'testimonial-free' ),
				'default'    => '#ffb900',
				'dependency' => array( 'testimonial_client_rating', '==', 'true' ),
			),
			array(
				'id'       => 'client_designation',
				'type'     => 'switcher',
				'title'    => __( 'Identity or Position', 'testimonial-free' ),
				'subtitle' => __( 'Show/Hide identity or position.', 'testimonial-free' ),
				'text_on'    => __( 'Show', 'testimonial-free' ),
				'text_off'   => __( 'Hide', 'testimonial-free' ),
				'text_width' => 80,
				'default'  => true,
			),

		),
	)
);

//
// Image Settings section.
//
SPFTESTIMONIAL::createSection(
	$prefix_shortcode_opts, array(
		'title'  => __( 'Image Settings', 'testimonial-free' ),
		'icon'   => 'fa fa-image',
		'fields' => array(

			array(
				'id'         => 'client_image',
				'type'       => 'switcher',
				'title'      => __( 'Testimonial Image', 'testimonial-free' ),
				'subtitle'   => __( 'Show/Hide testimonial image.', 'testimonial-free' ),
				'text_on'    => __( 'Show', 'testimonial-free' ),
				'text_off'   => __( 'Hide', 'testimonial-free' ),
				'text_width' => 80,
				'default'    => true,
			),
			array(
				'id'         => 'image_sizes',
				'type'       => 'image_sizes',
				'title'      => __( 'Testimonial Image Size', 'testimonial-free' ),
				'subtitle'   => __( 'Select which size image to show with your Testimonials.', 'testimonial-free' ),
				'default'    => 'tf-client-image-size',
				'dependency' => array(
					'client_image',
					'==',
					'true',
				),
			),
			array(
				'id'         => 'image_custom_size',
				'type'       => 'custom_size',
				'class'       => 'disabled',
				'title'      => __( 'Custom Size', 'testimonial-free' ),
				'subtitle'   => __( 'Set a custom width and height of the image.', 'testimonial-free' ),
				'default'    => array(
					'width'  => '120',
					'height' => '120',
					'crop'   => 'hard-crop',
					'unit'   => 'px',
				),
				'attributes' => array(
					'min' => 0,
				),
				'dependency' => array(
					'client_image|image_sizes',
					'==|==',
					'true|custom',
				),
			),

		),
	)
);

//
// Typography section.
//
SPFTESTIMONIAL::createSection(
	$prefix_shortcode_opts, array(
		'title'  => __( 'Typography', 'testimonial-free' ),
		'icon'   => 'fa fa-font',
		'fields' => array(
			array(
				'type'    => 'notice',
				'style'   => 'normal',
				'content' => __( 'The Following Typography (900+ Google Fonts) options are available in the <a href="https://shapedplugin.com/plugin/testimonial-pro/" target="_blank">Pro Version</a> only except color fields.', 'testimonial-free' ),
			),
			array(
				'id'       => 'section_title_font_load',
				'type'     => 'switcher',
				'title'    => __( 'Load Section Title Font', 'testimonial-free' ),
				'subtitle' => __( 'On/Off google font for the section title.', 'testimonial-free' ),
				'class'    => 'sp-testimonial-font-load',
				'default'  => true,
			),
			array(
				'id'           => 'section_title_typography',
				'type'         => 'typography',
				'title'        => __( 'Section Title Font', 'testimonial-free' ),
				'subtitle'     => __( 'Set testimonial section title font properties.', 'testimonial-free' ),
				'default'      => array(
					'font-family'    => 'Open Sans',
					'font-weight'    => '600',
					'type'           => 'google',
					'font-size'      => '22',
					'line-height'    => '22',
					'text-align'     => 'center',
					'text-transform' => 'none',
					'letter-spacing' => 0,
					'color'          => '#444444',
				),
				'preview'      => true,
				'preview_text' => 'What Our Customers Saying', // Replace preview text with any text you like.
			),
			array(
				'id'       => 'testimonial_title_font_load',
				'type'     => 'switcher',
				'title'    => __( 'Load Testimonial Title Font', 'testimonial-free' ),
				'subtitle' => __( 'On/Off google font for the testimonial tagline or title.', 'testimonial-free' ),
				'class'    => 'sp-testimonial-font-load',
				'default'  => true,
			),
			array(
				'id'           => 'testimonial_title_typography',
				'type'         => 'typography',
				'title'        => __( 'Testimonial Title Font', 'testimonial-free' ),
				'subtitle'     => __( 'Set testimonial tagline or title font properties.', 'testimonial-free' ),
				'default'      => array(
					'font-family'    => 'Open Sans',
					'font-weight'    => '600',
					'type'           => 'google',
					'font-size'      => '20',
					'line-height'    => '30',
					'text-align'     => 'center',
					'text-transform' => 'none',
					'letter-spacing' => 0,
					'color'          => '#333333',
				),
				'preview'      => true,
				'preview_text' => 'The Testimonial Title', // Replace preview text with any text you like.
			),
			array(
				'id'       => 'testimonial_text_font_load',
				'type'     => 'switcher',
				'title'    => __( 'Load Testimonial Content Font', 'testimonial-free' ),
				'subtitle' => __( 'On/Off google font for the testimonial content.', 'testimonial-free' ),
				'class'    => 'sp-testimonial-font-load',
				'default'  => true,
			),
			array(
				'id'       => 'testimonial_text_typography',
				'type'     => 'typography',
				'title'    => __( 'Testimonial Content Font', 'testimonial-free' ),
				'subtitle' => __( 'Set testimonial content font properties.', 'testimonial-free' ),
				'default'  => array(
					'font-family'    => 'Open Sans',
					'font-weight'    => 'normal',
					'type'           => 'google',
					'font-size'      => '16',
					'line-height'    => '26',
					'text-align'     => 'center',
					'text-transform' => 'none',
					'letter-spacing' => 0,
					'color'          => '#333333',
				),
				'color'    => true,
				'preview'  => true,
			),
			array(
				'id'       => 'client_name_font_load',
				'type'     => 'switcher',
				'title'    => __( 'Load Name Font', 'testimonial-free' ),
				'subtitle' => __( 'On/Off google font for the name.', 'testimonial-free' ),
				'class'    => 'sp-testimonial-font-load',
				'default'  => true,
			),
			array(
				'id'           => 'client_name_typography',
				'type'         => 'typography',
				'title'        => __( 'Name Font', 'testimonial-free' ),
				'subtitle'     => __( 'Set name font properties.', 'testimonial-free' ),
				'default'      => array(
					'font-family'    => 'Open Sans',
					'font-weight'    => '700',
					'type'           => 'google',
					'font-size'      => '16',
					'line-height'    => '24',
					'text-align'     => 'center',
					'text-transform' => 'none',
					'letter-spacing' => 0,
					'color'          => '#333333',
				),
				'color'        => true,
				'preview'      => true,
				'preview_text' => 'Jacob Firebird', // Replace preview text with any text you like.
			),
			array(
				'id'       => 'designation_company_font_load',
				'type'     => 'switcher',
				'title'    => __( 'Load Identity or Position & Company Name Font', 'testimonial-free' ),
				'subtitle' => __( 'On/Off google font for the identity or position & company name.', 'testimonial-free' ),
				'class'    => 'sp-testimonial-font-load',
				'default'  => true,
			),
			array(
				'id'           => 'client_designation_company_typography',
				'type'         => 'typography',
				'title'        => __( 'Identity or Position & Company Name Font', 'testimonial-free' ),
				'subtitle'     => __( 'Set identity or position & company name font properties.', 'testimonial-free' ),
				'default'      => array(
					'font-family'    => 'Open Sans',
					'font-weight'    => 'normal',
					'type'           => 'google',
					'font-size'      => '16',
					'line-height'    => '24',
					'text-align'     => 'center',
					'text-transform' => 'none',
					'letter-spacing' => 0,
					'color'          => '#444444',
				),
				'color'        => true,
				'preview'      => true,
				'preview_text' => 'CEO - Firebird Media Inc.', // Replace preview text with any text you like.
			),
			array(
				'id'       => 'location_font_load',
				'type'     => 'switcher',
				'title'    => __( 'Load Location Font', 'testimonial-free' ),
				'subtitle' => __( 'On/Off google font for the location.', 'testimonial-free' ),
				'class'    => 'sp-testimonial-font-load',
				'default'  => true,
			),
			array(
				'id'           => 'client_location_typography',
				'type'         => 'typography',
				'title'        => __( 'Location Font', 'testimonial-free' ),
				'subtitle'     => __( 'Set location font properties.', 'testimonial-free' ),
				'class'        => 'sp-testimonial-font-color',
				'default'      => array(
					'font-family'    => 'Open Sans',
					'font-weight'    => 'normal',
					'type'           => 'google',
					'font-size'      => '15',
					'line-height'    => '20',
					'text-align'     => 'center',
					'text-transform' => 'none',
					'letter-spacing' => 0,
					'color'          => '#444444',
				),
				'color'        => true,
				'preview'      => true,
				'preview_text' => 'Los Angeles', // Replace preview text with any text you like.
			),
			array(
				'id'       => 'phone_font_load',
				'type'     => 'switcher',
				'title'    => __( 'Load Phone or Mobile Font', 'testimonial-free' ),
				'subtitle' => __( 'On/Off google font for the phone or mobile.', 'testimonial-free' ),
				'class'    => 'sp-testimonial-font-load',
				'default'  => true,
			),
			array(
				'id'           => 'client_phone_typography',
				'type'         => 'typography',
				'title'        => __( 'Phone or Mobile Font', 'testimonial-free' ),
				'subtitle'     => __( 'Set phone or mobile font properties.', 'testimonial-free' ),
				'class'        => 'sp-testimonial-font-color',
				'default'      => array(
					'font-family'    => 'Open Sans',
					'font-weight'    => 'normal',
					'type'           => 'google',
					'font-size'      => '15',
					'line-height'    => '20',
					'text-align'     => 'center',
					'text-transform' => 'none',
					'letter-spacing' => 0,
					'color'          => '#444444',
				),
				'color'        => true,
				'preview'      => true,
				'preview_text' => '+1 234567890', // Replace preview text with any text you like.
			),
			array(
				'id'       => 'email_font_load',
				'type'     => 'switcher',
				'title'    => __( 'Load Email Address Font', 'testimonial-free' ),
				'subtitle' => __( 'On/Off google font for the email address.', 'testimonial-free' ),
				'class'    => 'sp-testimonial-font-load',
				'default'  => true,
			),
			array(
				'id'           => 'client_email_typography',
				'type'         => 'typography',
				'title'        => __( 'Email Address Font', 'testimonial-free' ),
				'subtitle'     => __( 'Set email address font properties.', 'testimonial-free' ),
				'class'        => 'sp-testimonial-font-color',
				'default'      => array(
					'font-family'    => 'Open Sans',
					'font-weight'    => 'normal',
					'type'           => 'google',
					'font-size'      => '15',
					'line-height'    => '20',
					'text-align'     => 'center',
					'text-transform' => 'none',
					'letter-spacing' => 0,
					'color'          => '#444444',
				),
				'color'        => true,
				'preview'      => true,
				'preview_text' => 'mail@yourwebsite.com', // Replace preview text with any text you like.
			),
			array(
				'id'       => 'date_font_load',
				'type'     => 'switcher',
				'title'    => __( 'Load Date Font', 'testimonial-free' ),
				'subtitle' => __( 'On/Off google font for the date.', 'testimonial-free' ),
				'class'    => 'sp-testimonial-font-load',
				'default'  => true,
			),
			array(
				'id'           => 'testimonial_date_typography',
				'type'         => 'typography',
				'title'        => __( 'Date Font', 'testimonial-free' ),
				'subtitle'     => __( 'Set date font properties.', 'testimonial-free' ),
				'class'        => 'sp-testimonial-font-color',
				'default'      => array(
					'font-family'    => 'Open Sans',
					'font-weight'    => 'normal',
					'type'           => 'google',
					'font-size'      => '15',
					'line-height'    => '20',
					'text-align'     => 'center',
					'text-transform' => 'none',
					'letter-spacing' => 0,
					'color'          => '#444444',
				),
				'color'        => true,
				'preview'      => true,
				'preview_text' => 'February 21, 2018', // Replace preview text with any text you like.
			),
			array(
				'id'       => 'website_font_load',
				'type'     => 'switcher',
				'title'    => __( 'Load Website Font', 'testimonial-free' ),
				'subtitle' => __( 'On/Off google font for the website.', 'testimonial-free' ),
				'class'    => 'sp-testimonial-font-load',
				'default'  => true,
			),
			array(
				'id'           => 'client_website_typography',
				'type'         => 'typography',
				'title'        => __( 'Website Font', 'testimonial-free' ),
				'subtitle'     => __( 'Set website font properties.', 'testimonial-free' ),
				'class'        => 'sp-testimonial-font-color',
				'default'      => array(
					'font-family'    => 'Open Sans',
					'font-weight'    => 'normal',
					'type'           => 'google',
					'font-size'      => '15',
					'line-height'    => '20',
					'text-align'     => 'center',
					'text-transform' => 'none',
					'letter-spacing' => 0,
					'color'          => '#444444',
				),
				'color'        => true,
				'preview'      => true,
				'preview_text' => 'www.yourwebsite.com', // Replace preview text with any text you like.
			),
			array(
				'id'       => 'filter_font_load',
				'type'     => 'switcher',
				'title'    => __( 'Load Filter Font', 'testimonial-free' ),
				'subtitle' => __( 'On/Off google font for the filter.', 'testimonial-free' ),
				'class'    => 'sp-testimonial-font-load',
				'default'  => true,
			),
			array(
				'id'           => 'filter_typography',
				'type'         => 'typography',
				'title'        => __( 'Filter Font', 'testimonial-free' ),
				'subtitle'     => __( 'Set filter font properties.', 'testimonial-free' ),
				'default'      => array(
					'font-family'    => 'Open Sans',
					'font-weight'    => 'normal',
					'type'           => 'google',
					'font-size'      => '15',
					'line-height'    => '20',
					'text-align'     => 'center',
					'text-transform' => 'none',
					'letter-spacing' => 0,
				),
				'color'        => false,
				'preview'      => true,
				'preview_text' => 'All', // Replace preview text with any text you like.
			),

		),
	)
);

//
// Metabox of the Testimonial.
// Set a unique slug-like ID.
//
$prefix_testimonial_opts = 'sp_tpro_meta_options';

//
// Testimonial metabox.
//
SPFTESTIMONIAL::createMetabox(
	$prefix_testimonial_opts, array(
		'title'     => __( 'Testimonial Options', 'testimonial-free' ),
		'class'     => 'spt-main-class',
		'post_type' => 'spt_testimonial',
		'context'   => 'normal',
	)
);

//
// Reviewer Information section.
//
SPFTESTIMONIAL::createSection(
	$prefix_testimonial_opts, array(
		'title'  => __( 'Reviewer Information', 'testimonial-free' ),
		'fields' => array(

			array(
				'id'       => 'tpro_name',
				'type'     => 'text',
				'title'    => __( 'Full Name', 'testimonial-free' ),
				'sanitize' => 'spftestimonial_sanitize_text',
			),
			array(
				'id'       => 'tpro_designation',
				'type'     => 'text',
				'title'    => __( 'Identity or Position', 'testimonial-free' ),
				'sanitize' => 'spftestimonial_sanitize_text',
			),
			array(
				'id'       => 'tpro_rating',
				'type'     => 'rating',
				'title'    => __( 'Rating', 'testimonial-free' ),
				'options'  => array(
					'five_star'  => __( '5 Stars', 'testimonial-free' ),
					'four_star'  => __( '4 Stars', 'testimonial-free' ),
					'three_star' => __( '3 Stars', 'testimonial-free' ),
					'two_star'   => __( '2 Stars', 'testimonial-free' ),
					'one_star'   => __( '1 Star', 'testimonial-free' ),
				),
				'default'  => '',
				'sanitize' => 'spftestimonial_sanitize_text',
			),

		),
	)
);
