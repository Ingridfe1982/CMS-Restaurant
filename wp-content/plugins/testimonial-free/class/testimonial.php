<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * The SP_TFREE_Testimonial class.
 */
class SP_TFREE_Testimonial {

	/**
	 * The class instance.
	 *
	 * @var $_instance
	 * @since 2.0
	 */
	private static $_instance;

	/**
	 * The method to get instance.
	 *
	 * @return $_instance
	 * @since 2.0
	 */
	public static function getInstance() {
		if ( ! self::$_instance ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * The class constructor.
	 *
	 * @since 1.0
	 */
	public function __construct() {
		add_filter( 'init', array( $this, 'register_post_type' ) );
	}

	/**
	 * Register post type
	 *
	 * @since 1.0
	 */
	public function register_post_type() {

		if ( post_type_exists( 'spt_testimonial' ) ) {
			return;
		}

		$labels = apply_filters(
			'sp_testimonial_post_type_labels',
			array(
				'name'                  => __( 'All Testimonials', 'testimonial-free' ),
				'singular_name'         => __( 'Testimonial', 'testimonial-free' ),
				'menu_name'             => __( 'Testimonial', 'testimonial-free' ),
				'all_items'             => __( 'All Testimonials', 'testimonial-free' ),
				'add_new'               => __( 'Add New Testimonial', 'testimonial-free' ),
				'add_new_item'          => __( 'Add New Testimonial', 'testimonial-free' ),
				'edit'                  => __( 'Edit', 'testimonial-free' ),
				'edit_item'             => __( 'Edit Testimonial', 'testimonial-free' ),
				'new_item'              => __( 'New Testimonial', 'testimonial-free' ),
				'search_items'          => __( 'Search Testimonials', 'testimonial-free' ),
				'not_found'             => __( 'No Testimonials found', 'testimonial-free' ),
				'not_found_in_trash'    => __( 'No Testimonials found in Trash', 'testimonial-free' ),
				'parent'                => __( 'Parent Testimonials', 'testimonial-free' ),
				'featured_image'        => __( 'Testimonial Image', 'testimonial-free' ),
				'set_featured_image'    => __( 'Set Testimonial image', 'testimonial-free' ),
				'remove_featured_image' => __( 'Remove image', 'testimonial-free' ),
				'use_featured_image'    => __( 'Use as image', 'testimonial-free' ),
			)
		);

		$args = apply_filters(
			'sp_testimonial_post_type_args',
			array(
				'label'              => __( 'Testimonial', 'testimonial-free' ),
				'description'        => __( 'Testimonial custom post type.', 'testimonial-free' ),
				'taxonomies'         => array(),
				'public'             => false,
				'has_archive'        => false,
				'publicly_queryable' => false,
				'query_var'          => false,
				'show_ui'            => current_user_can( 'manage_options' ) ? true : false,
				'show_in_menu'       => true,
				'menu_icon'          => 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIj8+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgd2lkdGg9IjUxMnB4IiBoZWlnaHQ9IjUxMnB4IiB2aWV3Qm94PSIwIDAgNDc4LjI0OCA0NzguMjQ4IiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA0NzguMjQ4IDQ3OC4yNDg7IiB4bWw6c3BhY2U9InByZXNlcnZlIiBjbGFzcz0iIj48Zz48Zz4KCTxnPgoJCTxnPgoJCQk8cGF0aCBkPSJNNDU2LjAyLDQ0LjgyMUgyNjQuODNjLTEyLjI2LDAtMjIuMjMyLDkuOTcyLTIyLjIzMiwyMi4yMjl2OTguNjUyYzAsMTIuMjU4LDkuOTc0LDIyLjIzLDIyLjIzMiwyMi4yM2gxNi43ODd2MzkuMTYxICAgICBjMCwyLjcwNywxLjU4LDUuMTY1LDQuMDQzLDYuMjkyYzAuOTIsMC40MiwxLjkwMSwwLjYyNywyLjg3NSwwLjYyN2MxLjYzMSwwLDMuMjQ0LTAuNTc2LDQuNTIzLTEuNjg1bDUxLjM4My00NC4zOTZoMTExLjU3NiAgICAgYzEyLjI2LDAsMjIuMjMtOS45NzMsMjIuMjMtMjIuMjNWNjcuMDVDNDc4LjI1LDU0Ljc5Miw0NjguMjc3LDQ0LjgyMSw0NTYuMDIsNDQuODIxeiBNMzE5LjkyMiwxMTIuMjUybC0xMC4yMDksOS45NTMgICAgIGwyLjQxLDE0LjA1NGMwLjE3NCwxLjAxNS0wLjI0MiwyLjAzOC0xLjA3NiwyLjY0M2MtMC40NjksMC4zNDItMS4wMjcsMC41MTYtMS41ODgsMC41MTZjLTAuNDI4LDAtMC44NjEtMC4xMDMtMS4yNTYtMC4zMSAgICAgbC0xMi42MjEtNi42MzVsLTEyLjYxOSw2LjYzNWMtMC45MTIsMC40NzgtMi4wMTYsMC4zOTgtMi44NDgtMC4yMDZzLTEuMjQ4LTEuNjI4LTEuMDc0LTIuNjQzbDIuNDEtMTQuMDU0bC0xMC4yMTEtOS45NTMgICAgIGMtMC43MzQtMC43MTgtMS4wMDItMS43OTItMC42ODUtMi43NjljMC4zMTctMC45NzgsMS4xNjQtMS42OTEsMi4xODMtMS44MzlsMTQuMTEtMi4wNWw2LjMxLTEyLjc4NiAgICAgYzAuNDU3LTAuOTIzLDEuMzk2LTEuNTA3LDIuNDI0LTEuNTA3czEuOTY5LDAuNTg0LDIuNDIyLDEuNTA3bDYuMzEyLDEyLjc4NmwxNC4xMDcsMi4wNWMxLjAyLDAuMTQ4LDEuODYzLDAuODYxLDIuMTg0LDEuODM5ICAgICBDMzIwLjkyNCwxMTAuNDYsMzIwLjY1OCwxMTEuNTM1LDMxOS45MjIsMTEyLjI1MnogTTM4NC43NjYsMTEyLjI1MmwtMTAuMjExLDkuOTUzbDIuNDEyLDE0LjA1NCAgICAgYzAuMTcyLDEuMDE1LTAuMjQ0LDIuMDM4LTEuMDc2LDIuNjQzYy0wLjQ2OSwwLjM0Mi0xLjAyNSwwLjUxNi0xLjU4OCwwLjUxNmMtMC40MywwLTAuODU5LTAuMTAzLTEuMjYtMC4zMWwtMTIuNjE5LTYuNjM1ICAgICBsLTEyLjYxOSw2LjYzNWMtMC45MTIsMC40NzgtMi4wMTQsMC4zOTgtMi44NDYtMC4yMDZjLTAuODM0LTAuNjA0LTEuMjUtMS42MjgtMS4wNzYtMi42NDNsMi40MS0xNC4wNTRsLTEwLjIwOS05Ljk1MyAgICAgYy0wLjczNC0wLjcxOC0xLjAwMi0xLjc5Mi0wLjY4NC0yLjc2OWMwLjMxNi0wLjk3OCwxLjE2LTEuNjkxLDIuMTgyLTEuODM5bDE0LjEwOS0yLjA1bDYuMzExLTEyLjc4NiAgICAgYzAuNDU1LTAuOTIzLDEuMzk2LTEuNTA3LDIuNDIyLTEuNTA3YzEuMDI5LDAsMS45NjcsMC41ODQsMi40MjIsMS41MDdsNi4zMTIsMTIuNzg2bDE0LjEwOSwyLjA1ICAgICBjMS4wMjEsMC4xNDgsMS44NjMsMC44NjEsMi4xODIsMS44MzlDMzg1Ljc2OCwxMTAuNDYsMzg1LjUsMTExLjUzNSwzODQuNzY2LDExMi4yNTJ6IE00NDkuNjA3LDExMi4yNTJsLTEwLjIxMSw5Ljk1MyAgICAgbDIuNDA4LDE0LjA1NGMwLjE3NiwxLjAxNS0wLjIzOCwyLjAzOC0xLjA3MiwyLjY0M2MtMC40NzEsMC4zNDItMS4wMjcsMC41MTYtMS41OSwwLjUxNmMtMC40MywwLTAuODU5LTAuMTAzLTEuMjU4LTAuMzEgICAgIGwtMTIuNjIxLTYuNjM1bC0xMi42MjEsNi42MzVjLTAuOTA4LDAuNDc4LTIuMDEyLDAuMzk4LTIuODQ0LTAuMjA2Yy0wLjgzNC0wLjYwNC0xLjI0OC0xLjYyOC0xLjA3Ni0yLjY0M2wyLjQxMi0xNC4wNTQgICAgIGwtMTAuMjExLTkuOTUzYy0wLjczNC0wLjcxOC0xLTEuNzkyLTAuNjg0LTIuNzY5YzAuMzE2LTAuOTc4LDEuMTY0LTEuNjkxLDIuMTgyLTEuODM5bDE0LjExMS0yLjA1bDYuMzExLTEyLjc4NiAgICAgYzAuNDUzLTAuOTIzLDEuMzk1LTEuNTA3LDIuNDItMS41MDdjMS4wMjcsMCwxLjk3MSwwLjU4NCwyLjQyNiwxLjUwN0w0MzQsMTA1LjU5NGwxNC4xMDksMi4wNSAgICAgYzEuMDE4LDAuMTQ4LDEuODYxLDAuODYxLDIuMTgyLDEuODM5QzQ1MC42MDksMTEwLjQ2LDQ1MC4zNDQsMTExLjUzNSw0NDkuNjA3LDExMi4yNTJ6IiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIiBmaWxsPSIjOUZBNEE5Ii8+CgkJCTxwYXRoIGQ9Ik0xNTIuODQ0LDExMi45MjRjLTQ2Ljc2LDAtNzIuNjM5LDI0LjIzMS03Mi4xNjYsNzAuOTIxYzAuNjg2LDYzLjk0NywyNy44NTksMTAyLjc0LDcyLjE2NiwxMDIuMDYzICAgICBjMCwwLDcyLjEzMSwyLjkyNCw3Mi4xMzEtMTAyLjA2M0MyMjQuOTc1LDEzNy4xNTUsMjAwLjYwNSwxMTIuOTI0LDE1Mi44NDQsMTEyLjkyNHoiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSJhY3RpdmUtcGF0aCIgZGF0YS1vbGRfY29sb3I9IiMwMDAwMDAiIGZpbGw9IiM5RkE0QTkiLz4KCQkJPHBhdGggZD0iTTI4MC40MjgsMzM0LjQ0NGwtNzIuMDc0LTI4LjczNmwtMTYuODc3LTE0LjIyM2MtNC40NTctMy43NjYtMTEuMDQxLTMuNDg4LTE1LjE3OCwwLjYyMWwtMjMuNDYzLDIzLjMzNmwtMjMuNTMzLTIzLjM0MiAgICAgYy00LjEzNy00LjEwNC0xMC43MTMtNC4zNjktMTUuMTY0LTAuNjE1bC0xNi44ODEsMTQuMjIzbC03Mi4wNzQsMjguNzM5QzEuOTc1LDM0My42OSwxLjk5NSw0MjUuODg0LDAsNDMzLjQyN2gzMDUuNjQ2ICAgICBDMzAzLjY1Niw0MjUuOSwzMDMuNjQ2LDM0My42NzksMjgwLjQyOCwzMzQuNDQ0eiIgZGF0YS1vcmlnaW5hbD0iIzAwMDAwMCIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBkYXRhLW9sZF9jb2xvcj0iIzAwMDAwMCIgZmlsbD0iIzlGQTRBOSIvPgoJCTwvZz4KCTwvZz4KPC9nPjwvZz4gPC9zdmc+Cg==',
				'show_in_nav_menus'  => true,
				'show_in_admin_bar'  => true,
				'hierarchical'       => false,
				'menu_position'      => 20,
				'supports'           => array(
					'title',
					'editor',
					'thumbnail',
				),
				'capability_type'    => 'post',
				'labels'             => $labels,
			)
		);

		register_post_type( 'spt_testimonial', $args );
	}

}
