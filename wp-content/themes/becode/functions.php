<?php
/***
* The attachment_fields_to_save filter is used to filter the associated data of images. 
* By default, it receives the input from the Media Upload screen and provides default values to the post_title, 
* in case the user hasn't done so. 
*/
//add_action( 'wp_head', 'restaurant_head' );
/*function restaurant_head() {
	printf( '<meta name="Description" content="Restaurant Theme" />' );
	$format = '<link rel="icon" href="%s" type="image/x-icon" />';
	printf( $format, get_stylesheet_directory_uri() . '/images/site.ico' );
	$format = '<link rel="shortcut icon" href="%s" type="image/x-icon" />';
	printf( $format, get_stylesheet_directory_uri() . '/images/site.ico' );
}*/
//add_action( 'setup_theme', 'zn_setup_home_page' );
//add_action( 'after_setup_theme', 'zn_setup_home_page' );
function restaurant_setup_home_page() {
	//if( 'page' != get_option( 'show_on_front' ) ) 
	update_option( 'page_on_front', 44 );
	update_option( 'show_on_front', 'page' );
}

//add_action( 'admin_menu', 'register_my_custom_menu_page' );
function register_my_custom_menu_page(){
	add_menu_page( 'custom menu title', 'Sliders', 'manage_options', 'zn-upload.php', '', '', 6 );
		
	add_submenu_page( 'zn-upload.php', 'Upload New Slider', 'Add New', 'manage_options', 'zn-media-new.php' );
}

add_action( "wp_enqueue_scripts", "restaurant_enqueue", 11 );
function restaurant_enqueue() {
	//wp_deregister_script('jquery');
	//wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js", false, null);
	if( !wp_script_is( 'jquery' ) ) wp_enqueue_script('jquery');
	
	if( is_home() || is_front_page() ) {
		wp_enqueue_style( 'flexslider.css', get_stylesheet_directory_uri() . '/flexslider.css' );
		wp_enqueue_script( 'flexslider.js', get_stylesheet_directory_uri() . '/jquery.flexslider-min.js', array('jquery') );
	}
}

add_action( 'wp_head', 'restaurant_flexslider' );
//add_action( 'wp_enqueue_scripts', 'zn_flexslider' ); //no working
function restaurant_flexslider() {
	if( is_home() || is_front_page() )
	_e( "<script>
	//<![CDATA[
	jQuery(document).ready( function( $ ) {
		$('.flexslider').flexslider();
	}); 
	//]]>
	</script>",
	'restaurant');
}

//shortcode run on widge area
add_filter('widget_text', 'do_shortcode');

// Add specific CSS class (.template-front-page) on front page
//add_filter( 'body_class', 'zn_template_class' );
function zn_template_class( $classes="" ) {
	// add 'class-name' to the $classes array
	if( is_page_template( 'front-page.php' ) ) $classes[] = 'template-front-page';
	// return the $classes array
	return $classes;
}

//add_action( 'widgets_init', 'zn_home_widgets' );
add_action( 'wp_loaded', 'restaurant_home_widgets' ); //use wp_loaded to load widgets in order
function restaurant_home_widgets() {
	// Register front page widgets
	register_sidebar( array(
		'name' => __( 'Front Widget 1', 'restaurant' ),
		'id' => 'sidebar-2',
		'description' => __( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'restaurant' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Front Widget 2', 'restaurant' ),
		'id' => 'sidebar-3',
		'description' => __( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'restaurant' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Front Widget 3', 'restaurant' ),
		'id' => 'sidebar-4',
		'description' => __( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'restaurant' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}

add_action( 'wp_loaded', 'restaurant_footer_widgets' );
function restaurant_footer_widgets() {
	// Register footer widgets
	register_sidebar( array(
			'name' => __( 'Footer Widget 1', 'restaurant' ),
			'id' => 'sidebar-5',
			'description' => __( 'Found at the bottom of every page (except 404s and optional homepage template) Left Footer Widget.', 'restaurant' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
	) );

	register_sidebar( array(
			'name' => __( 'Footer Widget 2', 'restaurant' ),
			'id' => 'sidebar-6',
			'description' => __( 'Found at the bottom of every page (except 404s and optional homepage template) Center Footer Widget.', 'restaurant' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => "</aside>",
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
	) );

	register_sidebar( array(
			'name' => __( 'Footer Widget 3', 'restaurant' ),
			'id' => 'sidebar-7',
			'description' => __( 'Found at the bottom of every page (except 404s and optional homepage template) Right Footer Widget.', 'restaurant' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => "</aside>",
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
	) );
}

add_action( 'wp_loaded', 'restaurant_head_widgets' );
function restaurant_head_widgets() {
// Register head widgets show contact and email
	register_sidebar( array(
		'name' => __( 'Head Widget', 'restaurant' ),
		'id' => 'sidebar-8',
		'description' => __( 'Phone and email go here.', 'restaurant' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}

//disable break line into <p> in pages and posts
remove_filter ('the_content', 'wpautop');

//add_filter( 'the_content', 'restaurant_nl2br' );
// convert breakline to <br>
function restaurant_nl2br( $content ) {
	if( is_page( 'menu' ) )
		$content = nl2br( $content );
	return $content;
}

/*$defaults = array(
	'default-image'          => '',
	'random-default'         => false,
	'width'                  => 0,
	'height'                 => 0,
	'flex-height'            => false,
	'flex-width'             => false,
	'header-text'            => true,
	'uploads'                => true,
	'wp-head-callback'       => '',
	'admin-head-callback'    => '',
	'admin-preview-callback' => '',
);
add_theme_support( 'custom-header', $defaults );
*/

/**
* slider library
*/
if( ! class_exists( 'WP_List_Table' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

add_action( 'admin_menu', 'restaurant_slider_menu_page_theme' );

function restaurant_slider_menu_page_theme(){
	//$hook = add_menu_page( 'ZN Sliders title', 'Sliders', 'manage_options', 'zn_slider', 'zn_slider_list' );
	$hook = add_theme_page( 'ZN Sliders title', 'Sliders', 'manage_options', 'zn_slider', 'zn_restaurant_slider_list' );
	
	add_submenu_page( 'zn_slider', 'Upload New Slider', 'Add New', 'manage_options', 'zn_new_slider', 'restaurant_slider_upload' );
	add_action( "load-$hook", 'restaurant_restaurant_add_options' );
}

function restaurant_restaurant_add_options() {
	global $sliderListTable;
	$sliderListTable = new restaurant_slider_List_Table();
}

class restaurant_slider_List_Table extends WP_List_Table {
	private $slider_data;
	function get_slider_data() {
		global $wpdb;
		$select_post_type = "SELECT ID, post_name, post_excerpt, guid, post_modified_gmt FROM $wpdb->posts WHERE post_type = 'slider'";
		return $wpdb->get_results( $select_post_type, ARRAY_A); 
	}
	
	function __construct(){
		global $status, $page;

		parent::__construct( array(
			'singular'  => __( 'slider', 'sliderlisttable' ),     //singular name of the listed records
			'plural'    => __( 'sliders', 'sliderlisttable' ),   //plural name of the listed records
			'ajax'      => false        //does this table support ajax?
		) );
		add_action( 'admin_head', array( &$this, 'admin_header' ) );            
	}

  function admin_header() {
		$page = ( isset($_GET['page'] ) ) ? esc_attr( $_GET['page'] ) : false;
    if( 'zn_slider' != $page ) return;
    echo '<style type="text/css">';
    echo '.wp-list-table .column-cb { width: 5%; }';
    echo '.wp-list-table .column-image { width: 100px; }';
    echo '.wp-list-table .column-post_name { width: 20%; }';
    echo '.wp-list-table .column-post_excerpt { width: 35%; }';
    echo '.wp-list-table .column-post_modified_gmt { width: 20%;}';
    echo '</style>';
  }

  function no_items() {
    _e( 'No sliders found, oops.' );
  }
	
  function column_default( $item, $column_name ) {
		switch( $column_name ) { 
			case 'post_name':
			case 'post_excerpt':
			case 'post_modified_gmt':
				return $item[$column_name];
			default:
				return print_r( $item, true ) ; //Show the whole array for troubleshooting purposes
		}
  }

	function get_columns(){
		$columns = array(
			'cb' => '<input type="checkbox" />',
			'image' => __( 'Image', 'sliderlisttable' ),
			'post_name' => __( 'File', 'sliderlisttable' ),
			'post_excerpt' => __( 'Caption', 'sliderlisttable' ),
			'post_modified_gmt' => __( 'Date', 'sliderlisttable' )
		);
		return $columns;
	}

	function get_sortable_columns() {
		$sortable_columns = array(
			'post_name'  => array('post_name',false),
			'post_excerpt' => array('post_excerpt',false),
			'post_modified_gmt'   => array('post_modified_gmt',false)
		);
		return $sortable_columns;
	}

	function usort_reorder( $a, $b ) {
		// If no sort, default to title
		$orderby = ( ! empty( $_GET['orderby'] ) ) ? $_GET['orderby'] : 'post_name';
		// If no order, default to asc
		$order = ( ! empty($_GET['order'] ) ) ? $_GET['order'] : 'asc';
		// Determine sort order
		$result = strcmp( $a[$orderby], $b[$orderby] );
		// Send final sort direction to usort
		return ( 'asc' === $order ) ? $result : -$result;
	}

	function column_post_name( $item ) {
		$actions = array(
			'delete'    => sprintf('<a href="?page=%s&action=%s&slider=%s">Delete</a>', $_REQUEST['page'], 'delete', $item['ID'] )
			//'save'      => sprintf('<a href="?page=%s&action=%s&slider=%s&caption=%s">Save Caption</a>', $_REQUEST['page'], 'save', $item['ID'], $item['post_excerpt'] )
		);
		//return sprintf('%1$s %2$s %3$s', $item['post_name'], '<br>third', $this->row_actions($actions) );
		return sprintf('%1$s %2$s', $item['post_name'], $this->row_actions($actions) );
	}

	function column_cb( $item ) {
		return sprintf( '<input type="checkbox" name="slider[]" value="%s" />', $item['ID']	);
	}
	
	function column_image( $item ) {
		return sprintf( '<img width="%s" src = "%s" />', '100', $item['guid']	);
	}
	
	function column_post_excerpt( $item ) {
		return sprintf( '<form action="?page=%s&action=%s&slider=%s" method="post"><textarea name="caption">%s</textarea><br><input type="submit" class="button-secondary" value="%s"/></form>', $_REQUEST['page'], 'save', $item['ID'], $item['post_excerpt'], 'Save Caption' );
	}

	function get_bulk_actions() {
		$actions = array(
			'delete'    => 'Delete'
		);
		return $actions;
	}

	function prepare_items() {
		$columns  = $this->get_columns();
		$hidden   = array();
		$sortable = $this->get_sortable_columns();
		$this->_column_headers = array( $columns, $hidden, $sortable );
		$this->slider_data = $this->get_slider_data(); 
		usort( $this->slider_data, array( &$this, 'usort_reorder' ) );
		$this->items = $this->slider_data;
	}
} //class

function restaurant_slider_help($contextual_help, $screen_id, $screen) {
	$page = isset($_GET['page']) ? $_GET['page'] : '';
	if( 'zn_slider' == $screen -> parent_file ){
		//$contextual_help = sprintf(__('<p>Upload images to For more information, read help on %s</p>', 'wowslider'), '<a href="http://wowslider.com/wordpress-jquery-slider.html" target="_blank">wowslider.com</a>');
		$screen->add_help_tab( array(
			'id'		=> 'overview',
			'title'		=> __('Overview'),
			'content'	=>
				'<p>' . __( 'All the images you&#8217;ve uploaded are listed in the Slider Library, with the most recent uploads listed first. You can use the Screen Options tab to customize the display of this screen, and Save Caption to update a caption.' ) . '</p>'
		) );	
		
		$screen->add_help_tab( array(
			'id'		=> 'actions-links',
			'title'		=> __('Available Actions'),
			'content'	=>
				'<p>' . __( 'Hovering over a row reveals action links: Delete. Clicking Delete will delete the file from the slider library (as well as from any posts to which it is currently attached).' ) . '</p>' .
				'<p>' . __( 'Clicking Save Caption to save or update the caption related to an image. The caption will be shown with images on sliders.' ) . '</p>'
		) );	
		$screen->set_help_sidebar(
			'<p><strong>' . __( 'For more information:' ) . '</strong></p>' .
			'<p>' . __( '<a href="http://designpromote.co.uk/wordpress" target="_blank">Notes on Slider Library</a>' ) . '</p>'
		);
	}
	return $contextual_help;
}
add_filter('contextual_help', 'restaurant_slider_help', 10, 3);

function restaurant_slider_admin_bar_menu(){
	global $wp_admin_bar;
	if (is_super_admin() && is_admin_bar_showing()){
		$wp_admin_bar -> add_menu(array(
			'id' => 'znslider',
			'parent' => 'new-content',
			'title'  => __('Slider', 'znslider'),
			'href'   => admin_url('admin.php?page=zn_new_slider')
		));
	}
}

add_action('wp_before_admin_bar_render', 'restaurant_slider_admin_bar_menu');

/**
* upload file and call restaurant_insert_attachment
*/
function restaurant_media_handle_upload($file_id, $post_id, $post_data = array(), $overrides = array( 'test_form' => false )) {

	$time = current_time('mysql');
	if ( $post = get_post($post_id) ) {
		if ( substr( $post->post_date, 0, 4 ) > 0 )
			$time = $post->post_date;
	}

	$name = $_FILES[$file_id]['name'];
	$file = wp_handle_upload($_FILES[$file_id], $overrides, $time);

	if ( isset($file['error']) )
		return new WP_Error( 'upload_error', $file['error'] );

	$name_parts = pathinfo($name);
	$name = trim( substr( $name, 0, -(1 + strlen($name_parts['extension'])) ) );

	$url = $file['url'];
	$type = $file['type'];
	$file = $file['file'];
	$title = $name;
	$content = '';

	// use image exif/iptc data for title and caption defaults if possible
	if ( $image_meta = @wp_read_image_metadata($file) ) {
		if ( trim( $image_meta['title'] ) && ! is_numeric( sanitize_title( $image_meta['title'] ) ) )
			$title = $image_meta['title'];
		if ( trim( $image_meta['caption'] ) )
			$content = $image_meta['caption'];
	}

	// Construct the attachment array
	$attachment = array_merge( array(
		'post_mime_type' => $type,
		'guid' => $url,
		'post_parent' => $post_id,
		'post_title' => $title,
		'post_content' => $content,
	), $post_data );

	// This should never be set as it would then overwrite an existing attachment.
	if ( isset( $attachment['ID'] ) )
		unset( $attachment['ID'] );

	// Save the data
	$id = restaurant_insert_attachment($attachment, $file, $post_id);
	if ( !is_wp_error($id) ) {
		wp_update_attachment_metadata( $id, wp_generate_attachment_metadata( $id, $file ) );
	}

	return $id;
}

/**
* insert into wp_post table and post_type = slider
*/
function restaurant_insert_attachment($object, $file = false, $parent = 0) {
	global $wpdb, $user_ID;

	$defaults = array('post_status' => 'inherit', 'post_type' => 'post', 'post_author' => $user_ID,
		'ping_status' => get_option('default_ping_status'), 'post_parent' => 0,
		'menu_order' => 0, 'to_ping' =>  '', 'pinged' => '', 'post_password' => '',
		'guid' => '', 'post_content_filtered' => '', 'post_excerpt' => '', 'import_id' => 0, 'context' => '');

	$object = wp_parse_args($object, $defaults);
	if ( !empty($parent) )
		$object['post_parent'] = $parent;

	unset( $object[ 'filter' ] );

	$object = sanitize_post($object, 'db');

	// export array as variables
	extract($object, EXTR_SKIP);

	if ( empty($post_author) )
		$post_author = $user_ID;

	$post_type = 'slider';

	if ( ! in_array( $post_status, array( 'inherit', 'private' ) ) )
		$post_status = 'inherit';

	if ( !empty($post_category) )
		$post_category = array_filter($post_category); // Filter out empty terms

	// Make sure we set a valid category.
	if ( empty($post_category) || 0 == count($post_category) || !is_array($post_category) ) {
		$post_category = array();
	}

	// Are we updating or creating?
	if ( !empty($ID) ) {
		$update = true;
		$post_ID = (int) $ID;
	} else {
		$update = false;
		$post_ID = 0;
	}

	// Create a valid post name.
	if ( empty($post_name) )
		$post_name = sanitize_title($post_title);
	else
		$post_name = sanitize_title($post_name);

	// expected_slashed ($post_name)
	$post_name = wp_unique_post_slug($post_name, $post_ID, $post_status, $post_type, $post_parent);

	if ( empty($post_date) )
		$post_date = current_time('mysql');
	if ( empty($post_date_gmt) )
		$post_date_gmt = current_time('mysql', 1);

	if ( empty($post_modified) )
		$post_modified = $post_date;
	if ( empty($post_modified_gmt) )
		$post_modified_gmt = $post_date_gmt;

	if ( empty($comment_status) ) {
		if ( $update )
			$comment_status = 'closed';
		else
			$comment_status = get_option('default_comment_status');
	}
	if ( empty($ping_status) )
		$ping_status = get_option('default_ping_status');

	if ( isset($to_ping) )
		$to_ping = preg_replace('|\s+|', "\n", $to_ping);
	else
		$to_ping = '';

	if ( isset($post_parent) )
		$post_parent = (int) $post_parent;
	else
		$post_parent = 0;

	if ( isset($menu_order) )
		$menu_order = (int) $menu_order;
	else
		$menu_order = 0;

	if ( !isset($post_password) )
		$post_password = '';

	if ( ! isset($pinged) )
		$pinged = '';

	// expected_slashed (everything!)
	$data = compact( array( 'post_author', 'post_date', 'post_date_gmt', 'post_content', 'post_content_filtered', 'post_title', 'post_excerpt', 'post_status', 'post_type', 'comment_status', 'ping_status', 'post_password', 'post_name', 'to_ping', 'pinged', 'post_modified', 'post_modified_gmt', 'post_parent', 'menu_order', 'post_mime_type', 'guid' ) );
	$data = stripslashes_deep( $data );

	if ( $update ) {
		$wpdb->update( $wpdb->posts, $data, array( 'ID' => $post_ID ) );
	} else {
		// If there is a suggested ID, use it if not already present
		if ( !empty($import_id) ) {
			$import_id = (int) $import_id;
			if ( ! $wpdb->get_var( $wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE ID = %d", $import_id) ) ) {
				$data['ID'] = $import_id;
			}
		}

		$wpdb->insert( $wpdb->posts, $data );
		$post_ID = (int) $wpdb->insert_id;
	}

	if ( empty($post_name) ) {
		$post_name = sanitize_title($post_title, $post_ID);
		$wpdb->update( $wpdb->posts, compact("post_name"), array( 'ID' => $post_ID ) );
	}

	if ( is_object_in_taxonomy($post_type, 'category') )
		wp_set_post_categories( $post_ID, $post_category );

	if ( isset( $tags_input ) && is_object_in_taxonomy($post_type, 'post_tag') )
		wp_set_post_tags( $post_ID, $tags_input );

	// support for all custom taxonomies
	if ( !empty($tax_input) ) {
		foreach ( $tax_input as $taxonomy => $tags ) {
			$taxonomy_obj = get_taxonomy($taxonomy);
			if ( is_array($tags) ) // array = hierarchical, string = non-hierarchical.
				$tags = array_filter($tags);
			if ( current_user_can($taxonomy_obj->cap->assign_terms) )
				wp_set_post_terms( $post_ID, $tags, $taxonomy );
		}
	}

	if ( $file )
		update_attached_file( $post_ID, $file );

	clean_post_cache( $post_ID );

	if ( ! empty( $context ) )
		add_post_meta( $post_ID, '_wp_attachment_context', $context, true );

	if ( $update) {
		do_action('edit_attachment', $post_ID);
	} else {
		do_action('add_attachment', $post_ID);
	}

	return $post_ID;
}

function zn_restaurant_slider_list() {
	global $wpdb, $sliderListTable;
	$title = 'Slider Library';
?>
	<div class="wrap">
		<div id='icon-upload' class='icon32'><br></div>
		<h2><?php echo esc_html( $title ); ?>
		<?php if( current_user_can( 'upload_files' ) ) ?>
			<a href="admin.php?page=zn_new_slider" class="add-new-h2"><?php echo esc_html_x('Add New', 'file'); ?></a>
		</h2>
<?php
	//delete slider or save post_experpt(caption)
	if( !empty( $_GET['action'] ) ) {
		echo '<div id="message" class="updated below-h2"><p>';
		switch( $_GET['action'] ) {
			case 'delete': 
				//check_admin_referer()
				//current_user_can()
				if( wp_delete_post( $_GET['slider'] ) )
					echo 'Slider ' . $_GET['slider'] . ' deleted.';
				break;
			case 'save': 
				if( !empty( $_POST['caption'] ) ) {
					$slider['ID'] = $_GET['slider'];
					$slider['post_excerpt'] = $_POST['caption'];
					$update_id = wp_update_post( $slider );
					if( ( $update_id != 0 ) && ( $update_id == $slider['ID'] ) )
						echo 'Slider ' . $update_id . ' saved.';
				}
				break;
			default: break;
		}
		echo '</p></div>';
	}
	//show slider list table
	//$sliderListTable = new zn_slider_List_Table();
	$sliderListTable->prepare_items(); 
	$sliderListTable->display();
}

function restaurant_slider_upload() {
	$title = 'Upload new slider';
?>
	<div class="wrap">
		<div id='icon-upload' class='icon32'><br></div>
		<h2><?php echo esc_html( $title ); ?></h2>
<?php
		//if( isset( $_FILES['slider-file'] ) && $_FILES['slider-file']['error'] <= 0 ) {
		if( $_POST ) {
			echo '<div id="message" class="updated below-h2"><p>';
			$post_id = 0;
			if ( isset( $_REQUEST['post_id'] ) ) {
				$post_id = absint( $_REQUEST['post_id'] );
				if ( ! get_post( $post_id ) || ! current_user_can( 'edit_post', $post_id ) )
					$post_id = 0;
			}
				
			$location = 'admin.php?page=zn_slider'; //zn-slider/zn-slider.php';
			if ( isset($_POST['slider-upload']) && !empty($_FILES) ) {
				check_admin_referer('slider-form');
				// Upload File button was clicked
				$id = restaurant_media_handle_upload( 'slider-file', $post_id );
				//var_dump( $id );
				if ( is_wp_error( $id ) )
					$location .= '?message=3';
				echo $_FILES['slider-file']['name'] . " is uploaded into Slider. <a href='" . admin_url( $location ) .  "'>View Sliders</a>";
			}
			//echo admin_url( $location );
			//wp_redirect( admin_url( $location ) );
			echo '</p></div>';
		}
?>
		<form enctype="multipart/form-data" method="post" action="" id="file-form" class="media-upload-form type-form validate html-uploader">

		<input type="file" name="slider-file" id="slider-file">
		<input class="button" type="submit" name="slider-upload" id="slider-upload" value="Upload">		
		<script type="text/javascript">
		var post_id = <?php echo $post_id; ?>, shortform = 3;
		</script>
		<input type="hidden" name="post_id" id="post_id" value="<?php echo $post_id; ?>" />
    <input type="hidden" name="page" value="zn_slider" />
		<?php wp_nonce_field('slider-form'); ?>
		<div id="media-items" class="hide-if-no-js"></div>
		</form>
	</div>
<?php	
}

/**
 * Customize page's color including:
 * Header background (top bar), font / menu font / content background / background background / footer background
 */
function restaurant_customize_register( $wp_customize ) {
//setting name : restaurant_theme_color
	$wp_customize->add_setting( 'restaurant_theme_color' , array(
    'default'     => '#660000',
    'transport'   => 'postMessage', //'refresh', 
		//postMessage uses Javascript to show instantly
		//refresh doesn't use Javascript, reload the page to see changes so has delay
		//create a Javascript file for all custom handling (https://codex.wordpress.org/Theme_Customization_API)
	) );
	$wp_customize->add_section( 'restaurant_new_section_name' , array(
    'title'      => __( 'Theme Colors', 'restaurant' ),
    'priority'   => 30,
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
	'label'        => __( 'Theme Color', 'restaurant' ),
	'section'    => 'restaurant_new_section_name',
	'settings'   => 'restaurant_theme_color',
	) ) );

}
add_action( 'customize_register', 'restaurant_customize_register' );

function restaurant_customize_css() {
	$restaurant_color = get_theme_mod( 'restaurant_theme_color' );
?>
	<style type="text/css">
	#top-page,
	.flex-caption,
	.home-widget .widget-title, 
	.entry-content .menu-title,
	footer[role="contentinfo"] 	{
		background-color: <?php echo get_theme_mod( 'restaurant_theme_color' ); ?>;
	}
	.site-header h1 a,
	.main-navigation a,
	.site-header h1 a:hover,
	.site-header h2 a:hover,
	.widget-title {
		color: <?php echo get_theme_mod( 'restaurant_theme_color' ); ?>;
	}
	.widget-area .widget input[type="button"],
	.content-area input[type="button"],
	.head-widget  input[type="button"]{
		color: #ffffff;
		background-color: <?php echo $restaurant_color; ?>;
		background-repeat: repeat-x;
		background-image: -moz-linear-gradient(top, <?php echo $restaurant_color; ?>, <?php echo $restaurant_color; ?>);
		background-image: -ms-linear-gradient(top, <?php echo $restaurant_color; ?>, <?php echo $restaurant_color; ?>);
		background-image: -webkit-linear-gradient(top, <?php echo $restaurant_color; ?>, <?php echo $restaurant_color; ?>);
		background-image: -o-linear-gradient(top, <?php echo $restaurant_color; ?>, <?php echo $restaurant_color; ?>);
		background-image: linear-gradient(top, <?php echo $restaurant_color; ?>, <?php echo $restaurant_color; ?>);
		border: 1px solid <?php echo $restaurant_color; ?>;
	}
	
	@media screen and (min-width: 600px) { 
		.main-navigation li a,
		.main-navigation .current-menu-item > a,
		.main-navigation .current-menu-ancestor > a,
		.main-navigation .current_page_item > a,
		.main-navigation .current_page_ancestor > a {
			color: <?php echo get_theme_mod( 'restaurant_theme_color' ); ?>;
			
		}
	}
	
	</style>
<?php
}
add_action( 'wp_head', 'restaurant_customize_css');
 
?>