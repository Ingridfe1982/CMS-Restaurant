<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.
/**
 *
 * Field: column
 *
 * @since 2.2.0
 * @version 2.2.0
 */
if ( ! class_exists( 'SPFTESTIMONIAL_Field_column' ) ) {
	class SPFTESTIMONIAL_Field_column extends SPFTESTIMONIAL_Fields {

		public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
			parent::__construct( $field, $value, $unique, $where, $parent );
		}

		public function render() {

			$args = wp_parse_args(
				$this->field, array(
					'large_desktop_icon'        => '<i class="fa fa-television"></i>',
					'desktop_icon'              => '<i class="fa fa-desktop"></i>',
					'laptop_icon'               => '<i class="fa fa-laptop"></i>',
					'tablet_icon'               => '<i class="fa fa-tablet"></i>',
					'mobile_icon'               => '<i class="fa fa-mobile"></i>',
					'large_desktop_placeholder' => esc_html__( 'Large Desktop', 'testimonial-free' ),
					'desktop_placeholder'       => esc_html__( 'Desktop', 'testimonial-free' ),
					'laptop_placeholder'        => esc_html__( 'Laptop', 'testimonial-free' ),
					'tablet_placeholder'        => esc_html__( 'Tablet', 'testimonial-free' ),
					'mobile_placeholder'        => esc_html__( 'Mobile', 'testimonial-free' ),
                    'large_desktop'             => true,
                    'desktop'                   => true,
					'laptop'                    => true,
					'tablet'                    => true,
					'mobile'                    => true,
				)
			);

			$default_values = array(
				'large_desktop' => '',
				'desktop'       => '',
				'laptop'        => '',
				'tablet'        => '',
				'mobile'        => '',
			);

			$value = wp_parse_args( $this->value, $default_values );

			echo $this->field_before();

			$properties = array();

			foreach ( array( 'large_desktop', 'desktop', 'laptop', 'tablet', 'mobile' ) as $prop ) {
				if ( ! empty( $args[ $prop ] ) ) {
					$properties[] = $prop;
				}
			}

			$properties = ( $properties === array( 'desktop', 'tablet' ) ) ? array_reverse( $properties ) : $properties;

			foreach ( $properties as $property ) {

				$placeholder = ( ! empty( $args[ $property . '_placeholder' ] ) ) ? ' placeholder="' . $args[ $property . '_placeholder' ] . '"' : '';

				echo '<div class="spftestimonial--input">';
				echo ( ! empty( $args[ $property . '_icon' ] ) ) ? '<span class="spftestimonial--label spftestimonial--label-icon">' . $args[ $property . '_icon' ] . '</span>' : '';
				echo '<input type="text" name="' . $this->field_name( '[' . $property . ']' ) . '" value="' . $value[ $property ] . '"' . $placeholder . ' class="spftestimonial-number" />';
				echo '</div>';

			}

			echo '<div class="clear"></div>';

			echo $this->field_after();

		}

	}
}
