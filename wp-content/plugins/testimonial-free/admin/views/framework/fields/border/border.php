<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.
/**
 *
 * Field: border
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! class_exists( 'SPFTESTIMONIAL_Field_border' ) ) {
  class SPFTESTIMONIAL_Field_border extends SPFTESTIMONIAL_Fields {

    public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
      parent::__construct( $field, $value, $unique, $where, $parent );
    }

    public function render() {

      $args = wp_parse_args( $this->field, array(
        'top_icon'           => '<i class="fa fa-long-arrow-up"></i>',
        'left_icon'          => '<i class="fa fa-long-arrow-left"></i>',
        'bottom_icon'        => '<i class="fa fa-long-arrow-down"></i>',
        'right_icon'         => '<i class="fa fa-long-arrow-right"></i>',
        'all_icon'           => '<i class="fa fa-arrows"></i>',
        'top_placeholder'    => esc_html__( 'top', 'testimonial-free' ),
        'right_placeholder'  => esc_html__( 'right', 'testimonial-free' ),
        'bottom_placeholder' => esc_html__( 'bottom', 'testimonial-free' ),
        'left_placeholder'   => esc_html__( 'left', 'testimonial-free' ),
        'all_placeholder'    => esc_html__( 'all', 'testimonial-free' ),
        'top'                => true,
        'left'               => true,
        'bottom'             => true,
        'right'              => true,
        'all'                => false,
        'color'              => true,
        'hover_color'        => false,
        'style'              => true,
        'unit'               => 'px',
      ) );

      $default_value = array(
        'top'        => '',
        'right'      => '',
        'bottom'     => '',
        'left'       => '',
        'color'      => '',
        'hover-color' => '',
        'style'      => 'solid',
        'all'        => '',
      );

      $border_props = array(
        'solid'     => esc_html__( 'Solid', 'testimonial-free' ),
        'dashed'    => esc_html__( 'Dashed', 'testimonial-free' ),
        'dotted'    => esc_html__( 'Dotted', 'testimonial-free' ),
        'double'    => esc_html__( 'Double', 'testimonial-free' ),
        'inset'     => esc_html__( 'Inset', 'testimonial-free' ),
        'outset'    => esc_html__( 'Outset', 'testimonial-free' ),
        'groove'    => esc_html__( 'Groove', 'testimonial-free' ),
        'ridge'     => esc_html__( 'ridge', 'testimonial-free' ),
        'none'      => esc_html__( 'None', 'testimonial-free' )
      );

      $default_value = ( ! empty( $this->field['default'] ) ) ? wp_parse_args( $this->field['default'], $default_value ) : $default_value;

      $value = wp_parse_args( $this->value, $default_value );

      echo $this->field_before();

      echo '<div class="spftestimonial--inputs">';

      if( ! empty( $args['all'] ) ) {

        $placeholder = ( ! empty( $args['all_placeholder'] ) ) ? ' placeholder="'. $args['all_placeholder'] .'"' : '';

        echo '<div class="spftestimonial--input">';
        echo ( ! empty( $args['all_icon'] ) ) ? '<span class="spftestimonial--label spftestimonial--icon">'. $args['all_icon'] .'</span>' : '';
        echo '<input type="number" name="'. $this->field_name('[all]') .'" value="'. $value['all'] .'"'. $placeholder .' class="spftestimonial-input-number spftestimonial--is-unit" />';
        echo ( ! empty( $args['unit'] ) ) ? '<span class="spftestimonial--label spftestimonial--unit">'. $args['unit'] .'</span>' : '';
        echo '</div>';

      } else {

        $properties = array();

        foreach ( array( 'top', 'right', 'bottom', 'left' ) as $prop ) {
          if( ! empty( $args[$prop] ) ) {
            $properties[] = $prop;
          }
        }

        $properties = ( $properties === array( 'right', 'left' ) ) ? array_reverse( $properties ) : $properties;

        foreach( $properties as $property ) {

          $placeholder = ( ! empty( $args[$property.'_placeholder'] ) ) ? ' placeholder="'. $args[$property.'_placeholder'] .'"' : '';

          echo '<div class="spftestimonial--input">';
          echo ( ! empty( $args[$property.'_icon'] ) ) ? '<span class="spftestimonial--label spftestimonial--icon">'. $args[$property.'_icon'] .'</span>' : '';
          echo '<input type="number" name="'. $this->field_name('['. $property .']') .'" value="'. $value[$property] .'"'. $placeholder .' class="spftestimonial-input-number spftestimonial--is-unit" />';
          echo ( ! empty( $args['unit'] ) ) ? '<span class="spftestimonial--label spftestimonial--unit">'. $args['unit'] .'</span>' : '';
          echo '</div>';

        }

      }

      if( ! empty( $args['style'] ) ) {
        echo '<div class="spftestimonial--input">';
        echo '<select name="'. $this->field_name('[style]') .'">';
        foreach( $border_props as $border_prop_key => $border_prop_value ) {
          $selected = ( $value['style'] === $border_prop_key ) ? ' selected' : '';
          echo '<option value="'. $border_prop_key .'"'. $selected .'>'. $border_prop_value .'</option>';
        }
        echo '</select>';
        echo '</div>';
      }

      echo '</div>';

      if( ! empty( $args['color'] ) ) {
        $default_color_attr = ( ! empty( $default_value['color'] ) ) ? ' data-default-color="'. $default_value['color'] .'"' : '';
        echo '<div class="spftestimonial--color">';
        echo '<div class="spftestimonial-field-color">';
        echo '<div class="spftestimonial--title">'. esc_html( 'Color', 'testimonial-free' ).'</div>';
        echo '<input type="text" name="'. $this->field_name('[color]') .'" value="'. $value['color'] .'" class="spftestimonial-color"'. $default_color_attr .' />';
        echo '</div>';
        echo '</div>';
      }

      if( ! empty( $args['hover_color'] ) ) {
        $default_hover_color_attr = ( ! empty( $default_value['hover-color'] ) ) ? ' data-default-color="'. $default_value['hover-color'] .'"' : '';
        echo '<div class="spftestimonial--color">';
        echo '<div class="spftestimonial-field-color">';
        echo '<div class="spftestimonial--title">'. esc_html( 'Hover Color', 'testimonial-free' ).'</div>';
        echo '<input type="text" name="'. $this->field_name('[hover-color]') .'" value="'. $value['hover-color'] .'" class="spftestimonial-color"'. $default_hover_color_attr .' />';
        echo '</div>';
        echo '</div>';
      }

      echo '<div class="clear"></div>';

      echo $this->field_after();

    }

  }
}
