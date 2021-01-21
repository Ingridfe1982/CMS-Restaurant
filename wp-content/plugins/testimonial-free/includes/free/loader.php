<?php
/**
 * The Free Loader Class
 *
 * @package testimonial-free
 *
 * @since 2.0
 */
class SP_TFREE_Loader {

	function __construct() {
		require_once SP_TFREE_PATH . 'admin/views/scripts.php';
		require_once SP_TFREE_PATH . 'admin/views/mce-button.php';
		require_once SP_TFREE_PATH . 'admin/views/widget.php';
		require_once SP_TFREE_PATH . 'public/views/shortcoderender.php';
		require_once SP_TFREE_PATH . 'public/views/deprecated-shortcodes.php';
		require_once SP_TFREE_PATH . 'public/views/scripts.php';
	}

}

new SP_TFREE_Loader();
