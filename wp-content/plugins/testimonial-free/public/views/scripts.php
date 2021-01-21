<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }  // if direct access

/**
 * Scripts and styles
 */
class SP_TFREE_Front_Scripts {

	/**
	 * @var null
	 * @since 1.0
	 */
	protected static $_instance = null;

	/**
	 * @return SP_TFREE_Front_Scripts
	 * @since 1.0
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

		add_action( 'wp_enqueue_scripts', array( $this, 'front_scripts' ) );
	}

	/**
	 * Plugin Scripts and Styles
	 */
	function front_scripts() {
		// CSS Files.
		wp_enqueue_style( 'tfree-slick', SP_TFREE_URL . 'public/assets/css/slick.css', array(), SP_TFREE_VERSION );
		wp_enqueue_style( 'tfree-font-awesome', SP_TFREE_URL . 'public/assets/css/font-awesome.min.css', array(), SP_TFREE_VERSION );
		wp_enqueue_style( 'tfree-deprecated-style', SP_TFREE_URL . 'public/assets/css/deprecated-style.css', array(), SP_TFREE_VERSION );
		wp_enqueue_style( 'tfree-style', SP_TFREE_URL . 'public/assets/css/style.css', array(), SP_TFREE_VERSION );
		include SP_TFREE_PATH . '/includes/custom-css.php';
		wp_add_inline_style( 'tfree-style', $custom_css );

		// JS Files.
		wp_register_script( 'tfree-slick-min-js', SP_TFREE_URL . 'public/assets/js/slick.min.js', array( 'jquery' ), SP_TFREE_VERSION, true );
		wp_register_script( 'tfree-slick-active', SP_TFREE_URL . 'public/assets/js/sp-slick-active.js', array( 'jquery' ), SP_TFREE_VERSION, true );

	}

}
new SP_TFREE_Front_Scripts();
