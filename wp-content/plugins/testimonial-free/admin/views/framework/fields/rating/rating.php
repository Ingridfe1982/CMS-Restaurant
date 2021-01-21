<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.
/**
 *
 * Field: Rating
 *
 * @since 1.0.0
 * @version 1.0.0
 */
if ( ! class_exists( 'SPFTESTIMONIAL_Field_rating' ) ) {
	class SPFTESTIMONIAL_Field_rating extends SPFTESTIMONIAL_Fields {

		public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
			parent::__construct( $field, $value, $unique, $where, $parent );
		}

		public function render() {

			$args = wp_parse_args(
				$this->field, array(
					'query_args' => array(),
				)
			);

			echo $this->field_before();

			if ( isset( $this->field['options'] ) ) {

				$options = $this->field['options'];
				$options = ( is_array( $options ) ) ? $options : array_filter( $this->field_data( $options, false, $args['query_args'] ) );

				if ( is_array( $options ) && ! empty( $options ) ) {

					echo '<div class="sp-tpro-client-rating">';
					foreach ( $options as $sub_key => $sub_value ) {
						$checked = ( $sub_key == $this->value ) ? ' checked' : '';
						echo '<input type="radio" name="' . $this->field_name() . '" id="' . $sub_key . '" value="' . $sub_key . '"' . $this->field_attributes() . $checked . '/><label for="' . $sub_key . '" title="' . $sub_value . '"><i class="fa fa-star"></i></label>';
					}
					echo '</div>';

				} else {

					echo ( ! empty( $this->field['empty_message'] ) ) ? $this->field['empty_message'] : esc_html__( 'No data provided for this option type.', 'testimonial-free' );

				}
			} else {
				$label = ( isset( $this->field['label'] ) ) ? $this->field['label'] : '';
				echo '<label><input type="radio" name="' . $this->field_name() . '" value="1"' . $this->field_attributes() . checked( $this->value, 1, false ) . '/> ' . $label . '</label>';
			}

			echo $this->field_after();

		}

	}
}
