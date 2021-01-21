<?php
/**
 * This is to register the shortcode post type.
 *
 * @package testimonial-free
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class SP_TFREE_Shortcodes {

	/**
	 * The single instance of the class.
	 *
	 * @var self
	 * @since 2.0
	 */
	private static $_instance = null;

	/**
	 * Register the class with the WordPress API
	 *
	 * @since 2.0
	 */
	public function __construct() {
		add_filter( 'init', array( $this, 'register_post_type' ) );
	}

	/**
	 * Allows for accessing single instance of class. Class should only be constructed once per call.
	 *
	 * @return SP_TFREE_Shortcodes
	 */
	public static function getInstance() {
		if ( ! self::$_instance ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * Shortcode Post Type
	 */
	function register_post_type() {
		register_post_type(
			'sp_tfree_shortcodes', array(
				'label'              => __( 'Generate Shortcode', 'testimonial-free' ),
				'description'        => __( 'Generate Shortcode for Testimonial', 'testimonial-free' ),
				'public'             => false,
				'has_archive'        => false,
				'publicly_queryable' => false,
				'show_ui'            => true,
				'show_in_menu'       => 'edit.php?post_type=spt_testimonial',
				'hierarchical'       => false,
				'query_var'          => false,
				'supports'           => array( 'title' ),
				'capability_type'    => 'post',
				'labels'             => array(
					'name'               => __( 'Testimonial Shortcodes', 'testimonial-free' ),
					'singular_name'      => __( 'Testimonial Shortcode', 'testimonial-free' ),
					'menu_name'          => __( 'Shortcode Generator', 'testimonial-free' ),
					'add_new'            => __( 'Add New', 'testimonial-free' ),
					'add_new_item'       => __( 'Add New Shortcode', 'testimonial-free' ),
					'edit'               => __( 'Edit', 'testimonial-free' ),
					'edit_item'          => __( 'Edit Shortcode', 'testimonial-free' ),
					'new_item'           => __( 'New Shortcode', 'testimonial-free' ),
					'view'               => __( 'View Shortcode', 'testimonial-free' ),
					'view_item'          => __( 'View Shortcode', 'testimonial-free' ),
					'search_items'       => __( 'Search Shortcode', 'testimonial-free' ),
					'not_found'          => __( 'No Testimonial Shortcode Found', 'testimonial-free' ),
					'not_found_in_trash' => __( 'No Testimonial Shortcode Found in Trash', 'testimonial-free' ),
					'parent'             => __( 'Parent Testimonial Shortcode', 'testimonial-free' ),
				),
			)
		);
	}
}
