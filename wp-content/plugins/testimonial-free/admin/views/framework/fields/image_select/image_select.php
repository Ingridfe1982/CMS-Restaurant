<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.
/**
 *
 * Field: image_select
 *
 * @since 1.0.0
 * @version 1.0.0
 */
if ( ! class_exists( 'SPFTESTIMONIAL_Field_image_select' ) ) {
	class SPFTESTIMONIAL_Field_image_select extends SPFTESTIMONIAL_Fields {

		public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
			parent::__construct( $field, $value, $unique, $where, $parent );
		}

		public function render() {

			$args = wp_parse_args(
				$this->field, array(
					'multiple' => false,
					'options'  => array(),
				)
			);

			$value = ( is_array( $this->value ) ) ? $this->value : array_filter( (array) $this->value );

			echo $this->field_before();

			if ( ! empty( $args['options'] ) ) {

				echo '<div class="spftestimonial-siblings spftestimonial--image-group" data-multiple="' . $args['multiple'] . '">';

				$num = 1;

				foreach ( $args['options'] as $key => $option ) {

					$type    = ( $args['multiple'] ) ? 'checkbox' : 'radio';
					$extra   = ( $args['multiple'] ) ? '[]' : '';
					$active  = ( in_array( $key, $value ) ) ? ' spftestimonial--active' : '';
					$checked = ( in_array( $key, $value ) ) ? ' checked' : '';

					echo '<div class="spftestimonial--sibling spftestimonial--image' . $active . ' ' . $option['class'] . '">';
					echo '<img src="' . $option['image'] . '" alt="img-' . $num++ . '" />';
					if ( isset( $option['name'] ) ) {
						echo '<p>' . $option['name'] . '</p>';
					}
					echo '<input type="' . $type . '" name="' . $this->field_name( $extra ) . '" value="' . $key . '"' . $this->field_attributes() . $checked . '/>';
					echo '</div>';

				}

				echo '</div>';

			}

			echo '<div class="clear"></div>';

			echo $this->field_after();

		}

	}
}
