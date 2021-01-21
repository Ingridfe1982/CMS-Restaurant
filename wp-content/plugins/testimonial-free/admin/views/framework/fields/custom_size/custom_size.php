<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.
/**
 *
 * Field: Dimension Advanced.
 *
 * @since 2.2.0
 * @version 2.2.0
 */
if ( ! class_exists( 'SPFTESTIMONIAL_Field_custom_size' ) ) {
	class SPFTESTIMONIAL_Field_custom_size extends SPFTESTIMONIAL_Fields {

		public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
			parent::__construct( $field, $value, $unique, $where, $parent );
		}

		public function render() {

			$args = wp_parse_args(
				$this->field,
				array(
					'width_icon'           => '<i class="fa fa-arrows-h"></i>',
					'height_icon'         => '<i class="fa fa-arrows-v"></i>',
					'width_placeholder'    => esc_html__( 'width', 'testimonial-free' ),
					'height_placeholder'  => esc_html__( 'height', 'testimonial-free' ),
					'width'                => true,
					'height'              => true,
					'crop'              => true,
					'crops'             => array( 'soft-crop', 'hard-crop' ),
					'unit'               => 'px',
				)
			);

			$default_value = array(
				'width'    => '',
				'height'  => '',
				'crop'  => 'hard-crop',
			);

			$default_value = ( ! empty( $this->field['default'] ) ) ? wp_parse_args( $this->field['default'], $default_value ) : $default_value;

			$value = wp_parse_args( $this->value, $default_value );

			echo $this->field_before();

			$properties = array();

			foreach ( array( 'width', 'height' ) as $prop ) {
				if ( ! empty( $args[ $prop ] ) ) {
					$properties[] = $prop;
				}
			}

			$properties = ( $properties === array( 'width', 'height' ) ) ? array_reverse( $properties ) : $properties;

			foreach ( $properties as $property ) {

				$placeholder = ( ! empty( $args[ $property . '_placeholder' ] ) ) ? ' placeholder="' . $args[ $property . '_placeholder' ] . '"' : '';

				echo '<div class="spftestimonial--input">';
				echo ( ! empty( $args[ $property . '_icon' ] ) ) ? '<span class="spftestimonial--label spftestimonial--label-icon">' . $args[ $property . '_icon' ] . '</span>' : '';
				echo '<input type="number" name="' . $this->field_name( '[' . $property . ']' ) . '" value="' . $value[ $property ] . '"' . $placeholder . ' class="spftestimonial-number" />';
				echo ( ! empty( $args['unit'] ) ) ? '<span class="spftestimonial--label spftestimonial--label-unit">' . $args['unit'] . '</span>' : '';
				echo '</div>';

			}

			if ( ! empty( $args['crop'] ) ) {
				echo '<div class="spf--left spf--input">';
				echo '<select name="' . $this->field_name( '[crop]' ) . '">';
				foreach ( $args['crops'] as $crop_prop ) {
					$selected = ( $value['crop'] === $crop_prop ) ? ' selected' : '';
					echo '<option value="' . $crop_prop . '"' . $selected . '>' . $crop_prop . '</option>';
				}
				echo '</select>';
				echo '</div>';
			}

			echo '<div class="clear"></div>';

			echo $this->field_after();

		}

	}
}
