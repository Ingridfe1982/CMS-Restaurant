<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}  // if direct access

/**
 * Admin Scripts and styles
 */
class SP_TFREE_Admin_Scripts {

	/**
	 * @var null
	 * @since 2.0
	 */
	protected static $_instance = null;

	/**
	 * @return SP_TFREE_Admin_Scripts
	 * @since 2.0
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * Initialize the class
	 */
	public function __construct() {

		add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
	}

	/**
	 * Enqueue admin scripts
	 */
	public function admin_scripts() {
		wp_enqueue_style( 'testimonial-free-admin', SP_TFREE_URL . 'admin/assets/css/admin.min.css', array(), SP_TFREE_VERSION );
	}

}

new SP_TFREE_Admin_Scripts();
