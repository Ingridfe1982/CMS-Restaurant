<?php
/**
 * Testimonial Widget
 *
 * @since 2.0
 */
function sp_testimonial_free_widget() {
	register_widget( 'TFREE_Widget_Content' );
}
add_action( 'widgets_init', 'sp_testimonial_free_widget' );

class TFREE_Widget_Content extends WP_Widget {

	function __construct() {
		parent::__construct(
			'TFREE_Widget_Content', __( 'Testimonial', 'testimonial-free' ),
			array(
				'description' => __( 'Display Testimonials.', 'testimonial-free' ),
			)
		);
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		extract( $args );

		$title        = apply_filters( 'widget_title', esc_attr( $instance['title'] ) );
		$shortcode_id = isset( $instance['shortcode_id'] ) ? absint( $instance['shortcode_id'] ) : 0;

		if ( ! $shortcode_id ) {
			return;
		}

		echo $args['before_widget'];

		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		echo do_shortcode( '[sp_testimonial id=' . $shortcode_id . ']' );
		echo $args['after_widget'];
	}


	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		$shortcodes   = $this->shortcodes_list();
		$shortcode_id = ! empty( $instance['shortcode_id'] ) ? absint( $instance['shortcode_id'] ) : null;
		$title        = ! empty( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';

		if ( count( $shortcodes ) > 0 ) {

			echo sprintf( '<p><label for="%1$s">%2$s</label>', $this->get_field_id( 'title' ), __( 'Title:', 'testimonial-free' ) );
			echo sprintf( '<input type="text" class="widefat" id="%1$s" name="%2$s" value="%3$s" /></p>', $this->get_field_id( 'title' ), $this->get_field_name( 'title' ), $title );

			echo sprintf( '<p><label>%s</label>', __( 'Testimonial Shortcodes:', 'testimonial-free' ) );
			echo sprintf( '<select class="widefat" name="%s">', $this->get_field_name( 'shortcode_id' ) );
			foreach ( $shortcodes as $shortcode ) {
				$selected = $shortcode->id == $shortcode_id ? 'selected="selected"' : '';
				echo sprintf(
					'<option value="%1$d" %3$s>%2$s</option>',
					$shortcode->id,
					$shortcode->title,
					$selected
				);
			}
			echo '</select></p>';

		} else {
			echo sprintf(
				'<p>%1$s <a href="' . admin_url( 'post-new.php?post_type=sp_tfree_shortcodes' ) . '">%3$s</a> %2$s</p>',
				__( 'You did not generate any shortcode yet.', 'testimonial-free' ),
				__( 'to generate a new shortcode now.', 'testimonial-free' ),
				__( 'click here', 'testimonial-free' )
			);
		}
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update( $new_instance, $old_instance ) {
		$instance                 = array();
		$instance['title']        = sanitize_text_field( $new_instance['title'] );
		$instance['shortcode_id'] = absint( $new_instance['shortcode_id'] );

		return $instance;
	}

	private function shortcodes_list() {
		$shortcodes = get_posts(
			array(
				'post_type'   => 'sp_tfree_shortcodes',
				'post_status' => 'publish',
			)
		);

		if ( count( $shortcodes ) < 1 ) {
			return array();
		}

		return array_map(
			function ( $shortcode ) {
					return (object) array(
						'id'    => absint( $shortcode->ID ),
						'title' => esc_html( $shortcode->post_title ),
					);
			}, $shortcodes
		);
	}

}
