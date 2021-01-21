<?php
/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      2.1.5
 * @package    Testimonial
 * @subpackage Testimonial/includes
 */
class Testimonial_Activator {
	/**
	 * Activation hook function.
	 */
	public static function activate() {

		deactivate_plugins( 'testimonial-pro/testimonial-pro.php' );
	}

}
