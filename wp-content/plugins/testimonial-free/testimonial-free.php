<?php
/**
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://shapedplugin.com
 * @since             1.0
 * @package           Testimonial
 *
 * Plugin Name:     Testimonial
 * Plugin URI:      https://shapedplugin.com/plugin/testimonial-pro/
 * Description:     Most Customizable and Powerful Testimonials Showcase Plugin for WordPress that allows you to manage and display Testimonials or Reviews on any page or widget.
 * Version:         2.2.8
 * Author:          ShapedPlugin
 * Author URI:      https://shapedplugin.com/
 * Text Domain:     testimonial-free
 * Domain Path:     /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'activate_testimonial' ) ) {
	/**
	 * The code that runs during plugin activation.
	 * This action is documented in includes/class-testimonial-activator.php
	 */
	function activate_testimonial() {
		require_once plugin_dir_path( __FILE__ ) . 'includes/class-testimonial-activator.php';
		Testimonial_Activator::activate();
	}
}

if ( ! function_exists( 'deactivate_testimonial' ) ) {
	/**
	 * The code that runs during plugin deactivation.
	 * This action is documented in includes/class-testimonial-deactivator.php
	 */
	function deactivate_testimonial() {
		require_once plugin_dir_path( __FILE__ ) . 'includes/class-testimonial-deactivator.php';
		Testimonial_Deactivator::deactivate();
	}
}

register_activation_hook( __FILE__, 'activate_testimonial' );
register_deactivation_hook( __FILE__, 'deactivate_testimonial' );

require_once plugin_dir_path( __FILE__ ) . 'includes/class-testimonial-updates.php';
require_once plugin_dir_path( __FILE__ ) . 'admin/views/notices/review.php';
require_once plugin_dir_path( __FILE__ ) . 'admin/views/framework/classes/setup.class.php';
require_once plugin_dir_path( __FILE__ ) . 'admin/views/testimonial-settings.php';
require_once plugin_dir_path( __FILE__ ) . 'admin/views/testimonial-metaboxs.php';

if ( ! class_exists( 'SP_Testimonial_FREE' ) ) {
	/**
	 * Handles core plugin hooks and action setup.
	 *
	 * @package testimonial-free
	 * @since 2.0
	 */
	class SP_Testimonial_FREE {
		/**
		 * Plugin version
		 *
		 * @var string
		 */
		public $version = '2.2.8';

		/**
		 * @var SP_TFREE_Testimonial $shortcode
		 */
		public $testimonial;

		/**
		 * @var SP_TFREE_Shortcodes $shortcode
		 */
		public $shortcode;

		/**
		 * @var SP_TFREE_Router $router
		 */
		public $router;

		/**
		 * @var null
		 * @since 2.0
		 */
		protected static $_instance = null;

		/**
		 * @return SP_Testimonial_FREE
		 * @since 2.0
		 */
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}

			return self::$_instance;
		}

		/**
		 * SP_Testimonial_FREE constructor.
		 */
		function __construct() {
			// Define constants.
			$this->define_constants();

			// Required class file include.
			spl_autoload_register( array( $this, 'autoload' ) );

			// Include required files.
			$this->includes();

			// instantiate classes.
			$this->instantiate();

			// Initialize the filter hooks.
			$this->init_filters();

			// Initialize the action hooks.
			$this->init_actions();
		}

		/**
		 * Initialize WordPress filter hooks
		 *
		 * @return void
		 */
		function init_filters() {
			add_filter( 'plugin_action_links', array( $this, 'add_plugin_action_links' ), 10, 2 );
			add_filter( 'manage_sp_tfree_shortcodes_posts_columns', array( $this, 'add_shortcode_column' ) );
			add_filter( 'plugin_row_meta', array( $this, 'after_testimonial_free_row_meta' ), 10, 4 );
			add_filter( 'manage_spt_testimonial_posts_columns', array( $this, 'add_testimonial_column' ) );
		}

		/**
		 * Initialize WordPress action hooks
		 *
		 * @return void
		 */
		function init_actions() {
			add_action( 'plugins_loaded', array( $this, 'load_text_domain' ) );
			add_action( 'manage_sp_tfree_shortcodes_posts_custom_column', array( $this, 'add_shortcode_form' ), 10, 2 );
			add_action( 'manage_spt_testimonial_posts_custom_column', array( $this, 'add_testimonial_extra_column' ), 10, 2 );
			add_action( 'activated_plugin', array( $this, 'redirect_help_page' ) );
		}

		/**
		 * Define constants
		 *
		 * @since 2.0
		 */
		public function define_constants() {
			$this->define( 'SP_TFREE_VERSION', $this->version );
			$this->define( 'SP_TFREE_PATH', plugin_dir_path( __FILE__ ) );
			$this->define( 'SP_TFREE_URL', plugin_dir_url( __FILE__ ) );
			$this->define( 'SP_TFREE_BASENAME', plugin_basename( __FILE__ ) );
		}

		/**
		 * Define constant if not already set
		 *
		 * @since 2.0
		 *
		 * @param  string      $name
		 * @param  string|bool $value
		 */
		public function define( $name, $value ) {
			if ( ! defined( $name ) ) {
				define( $name, $value );
			}
		}


		/**
		 * Load TextDomain for plugin.
		 *
		 * @since 2.0
		 */
		public function load_text_domain() {
			load_plugin_textdomain( 'testimonial-free', false, SP_TFREE_PATH . '/languages' );
		}

		/**
		 * Add plugin action menu
		 *
		 * @param array  $links
		 * @param string $file
		 *
		 * @return array
		 */
		public function add_plugin_action_links( $links, $file ) {

			if ( SP_TFREE_BASENAME === $file ) {
				$ui_links = sprintf( '<a href="%s">%s</a>', admin_url( 'edit.php?post_type=sp_tfree_shortcodes' ), __( 'Shortcode Generator', 'testimonial-free' ) );

				array_unshift( $links, $ui_links );

				$links['go_pro'] = sprintf( '<a href="%s" style="%s">%s</a>', 'https://shapedplugin.com/plugin/testimonial-pro', 'color:#1dab87;font-weight:bold', __( 'Go Premium!', 'testimonial-free' ) );
			}

			return $links;
		}

		/**
		 * Add plugin row meta link
		 *
		 * @since 2.0
		 *
		 * @param $plugin_meta
		 * @param $file
		 *
		 * @return array
		 */
		function after_testimonial_free_row_meta( $plugin_meta, $file ) {
			if ( SP_TFREE_BASENAME === $file ) {
				$plugin_meta[] = '<a href="https://shapedplugin.com/demo/testimonial-pro/" target="_blank">' . __( 'Live Demo', 'testimonial-free' ) . '</a>';
			}

			return $plugin_meta;
		}

		/**
		 * Autoload class files on demand
		 *
		 * @param string $class requested class name
		 */
		function autoload( $class ) {
			$name = explode( '_', $class );
			if ( isset( $name[2] ) ) {
				$class_name = strtolower( $name[2] );
				$filename   = SP_TFREE_PATH . '/class/' . $class_name . '.php';

				if ( file_exists( $filename ) ) {
					require_once $filename;
				}
			}
		}

		/**
		 * Instantiate all the required classes
		 *
		 * @since 2.0
		 */
		function instantiate() {
			$this->testimonial = SP_TFREE_Testimonial::getInstance();
			$this->shortcode   = SP_TFREE_Shortcodes::getInstance();

			do_action( 'sp_tfree_instantiate', $this );
		}

		/**
		 * page router instantiate.
		 *
		 * @since 2.0
		 */
		function page() {
			$this->router = SP_TFREE_Router::instance();

			return $this->router;
		}

		/**
		 * Include the required files
		 *
		 * @return void
		 */
		function includes() {
			$this->page()->sp_tfree_function();
			$this->router->includes();
		}

		/**
		 * ShortCode Column
		 *
		 * @param $columns
		 *
		 * @return array
		 */
		function add_shortcode_column() {
			$new_columns['cb']        = '<input type="checkbox" />';
			$new_columns['title']     = __( 'Slider Title', 'testimonial-free' );
			$new_columns['shortcode'] = __( 'Shortcode', 'testimonial-free' );
			$new_columns['']          = '';
			$new_columns['date']      = __( 'Date', 'testimonial-free' );

			return $new_columns;
		}

		/**
		 * @param $column
		 * @param $post_id
		 */
		function add_shortcode_form( $column, $post_id ) {

			switch ( $column ) {

				case 'shortcode':
					$column_field = '<input style="width: 270px;padding: 6px;" type="text" onClick="this.select();" readonly="readonly" value="[sp_testimonial ' . 'id=&quot;' . $post_id . '&quot;' . ']"/>';
					echo $column_field;
					break;
				default:
					break;

			} // end switch

		}

		/**
		 * Testimonial Column
		 *
		 * @param $columns
		 *
		 * @return array
		 */
		function add_testimonial_column() {
			$new_columns['cb']     = '<input type="checkbox" />';
			$new_columns['title']  = __( 'Title', 'testimonial-pro' );
			$new_columns['image']  = __( 'Image', 'testimonial-pro' );
			$new_columns['name']   = __( 'Name', 'testimonial-pro' );
			$new_columns['rating'] = __( 'Rating', 'testimonial-pro' );
			$new_columns['']       = '';
			$new_columns['date']   = __( 'Date', 'testimonial-pro' );

			return $new_columns;
		}

		/**
		 * @param $column
		 * @param $post_id
		 */
		function add_testimonial_extra_column( $column, $post_id ) {

			switch ( $column ) {

				case 'rating':
					$testimonial_data = get_post_meta( $post_id, 'sp_tpro_meta_options', true );
					if ( isset( $testimonial_data['tpro_rating'] ) ) {
						$rating_star = $testimonial_data['tpro_rating'];
						$fill_star   = '<i style="color: #f3bb00;" class="fa fa-star"></i>';
						$empty_star  = '<i class="fa fa-star"></i>';
						switch ( $rating_star ) {
							case 'one_star':
								$column_field = '<span style="font-size: 16px; color: #d4d4d4;">' . $fill_star . $empty_star . $empty_star . $empty_star . $empty_star . '</span>';
								break;
							case 'two_star':
								$column_field = '<span style="font-size: 16px; color: #d4d4d4;">' . $fill_star . $fill_star . $empty_star . $empty_star . $empty_star . '</span>';
								break;
							case 'three_star':
								$column_field = '<span style="font-size: 16px; color: #d4d4d4;">' . $fill_star . $fill_star . $fill_star . $empty_star . $empty_star . '</span>';
								break;
							case 'four_star':
								$column_field = '<span style="font-size: 16px; color: #d4d4d4;">' . $fill_star . $fill_star . $fill_star . $fill_star . $empty_star . '</span>';
								break;
							case 'five_star':
								$column_field = '<span style="font-size: 16px; color: #d4d4d4;">' . $fill_star . $fill_star . $fill_star . $fill_star . $fill_star . '</span>';
								break;
							default:
								$column_field = '<span aria-hidden="true">—</span>';
								break;
						}

						echo $column_field;
					}

					break;
				case 'image':
					add_image_size( 'sp_tfree_client_small_img', 50, 50, true );
					$testimonial_client_image = get_the_post_thumbnail( get_the_ID(), 'sp_tfree_client_small_img' );
					if ( $testimonial_client_image !== '' ) {
						echo $testimonial_client_image;
					} else {
						echo '<span aria-hidden="true">—</span>';
					}
					break;
				default:
					break;
				case 'name':
					$testimonial_data = get_post_meta( $post_id, 'sp_tpro_meta_options', true );
					if ( isset( $testimonial_data['tpro_name'] ) ) {
						$testimonial_client_name = $testimonial_data['tpro_name'];
						if ( $testimonial_client_name !== '' ) {
							echo esc_html( $testimonial_client_name );
						} else {
							echo '<span aria-hidden="true">—</span>';
						}
					}
					break;

			} // end switch

		}

		/**
		 * Redirect after active
		 *
		 * @param $plugin
		 */
		function redirect_help_page( $plugin ) {
			if ( SP_TFREE_BASENAME === $plugin ) {
				exit( wp_redirect( admin_url( 'edit.php?post_type=spt_testimonial&page=tfree_help' ) ) );
			}
		}

	}
}

/**
 * Returns the main instance.
 *
 * @since 2.0
 * @return SP_Testimonial_FREE
 */
function sp_testimonial_free() {
	return SP_Testimonial_FREE::instance();
}

// sp_testimonial_free instance.
sp_testimonial_free();
