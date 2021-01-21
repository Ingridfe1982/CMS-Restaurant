<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Testimonial - route class
 *
 * @since 2.0
 */
class SP_TFREE_Router {

	/**
	 * @var SP_TFREE_Router single instance of the class
	 *
	 * @since 2.0
	 */
	protected static $_instance = null;


	/**
	 * Main SP_TFREE_Router Instance
	 *
	 * @since 2.0
	 * @static
	 * @return self Main instance
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * Include the required files
	 *
	 * @since 1.0
	 * @return void
	 */
	function includes() {
		include_once SP_TFREE_PATH . 'includes/free/loader.php';
	}

	/**
	 * function
	 *
	 * @since 1.0
	 * @return void
	 */
	function sp_tfree_function() {
		include_once SP_TFREE_PATH . 'includes/functions.php';
	}

}
