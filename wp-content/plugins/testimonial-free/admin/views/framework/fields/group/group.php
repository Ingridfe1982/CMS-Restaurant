<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.
/**
 *
 * Field: group
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! class_exists( 'SPFTESTIMONIAL_Field_group' ) ) {
  class SPFTESTIMONIAL_Field_group extends SPFTESTIMONIAL_Fields {

    public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
      parent::__construct( $field, $value, $unique, $where, $parent );
    }

    public function render() {

      $args = wp_parse_args( $this->field, array(
        'max'                    => 0,
        'min'                    => 0,
        'fields'                 => array(),
        'button_title'           => esc_html__( 'Add New', 'testimonial-free' ),
        'accordion_title_prefix' => '',
        'accordion_title_number' => false,
        'accordion_title_auto'   => true,
      ) );

      $title_prefix = ( ! empty( $args['accordion_title_prefix'] ) ) ? $args['accordion_title_prefix'] : '';
      $title_number = ( ! empty( $args['accordion_title_number'] ) ) ? true : false;
      $title_auto   = ( ! empty( $args['accordion_title_auto'] ) ) ? true : false;

      if( ! empty( $this->parent ) && preg_match( '/'. preg_quote( '['. $this->field['id'] .']' ) .'/', $this->parent ) ) {

        echo '<div class="spftestimonial-notice spftestimonial-notice-danger">'. esc_html__( 'Error: Nested field id can not be same with another nested field id.', 'testimonial-free' ) .'</div>';

      } else {

        echo $this->field_before();

        echo '<div class="spftestimonial-cloneable-item spftestimonial-cloneable-hidden">';

          echo '<div class="spftestimonial-cloneable-helper">';
          echo '<i class="spftestimonial-cloneable-sort fa fa-arrows"></i>';
          echo '<i class="spftestimonial-cloneable-clone fa fa-clone"></i>';
          echo '<i class="spftestimonial-cloneable-remove spftestimonial-confirm fa fa-times" data-confirm="'. esc_html__( 'Are you sure to delete this item?', 'testimonial-free' ) .'"></i>';
          echo '</div>';

          echo '<h4 class="spftestimonial-cloneable-title">';
          echo '<span class="spftestimonial-cloneable-text">';
          echo ( $title_number ) ? '<span class="spftestimonial-cloneable-title-number"></span>' : '';
          echo ( $title_prefix ) ? '<span class="spftestimonial-cloneable-title-prefix">'. $title_prefix .'</span>' : '';
          echo ( $title_auto ) ? '<span class="spftestimonial-cloneable-value"><span class="spftestimonial-cloneable-placeholder"></span></span>' : '';
          echo '</span>';
          echo '</h4>';

          echo '<div class="spftestimonial-cloneable-content">';
          foreach ( $this->field['fields'] as $field ) {

            $field_parent  = $this->parent .'['. $this->field['id'] .']';
            $field_default = ( isset( $field['default'] ) ) ? $field['default'] : '';

            SPFTESTIMONIAL::field( $field, $field_default, '_nonce', 'field/group', $field_parent );

          }
          echo '</div>';

        echo '</div>';

        echo '<div class="spftestimonial-cloneable-wrapper spftestimonial-data-wrapper" data-title-number="'. $title_number .'" data-unique-id="'. $this->unique .'" data-field-id="['. $this->field['id'] .']" data-max="'. $args['max'] .'" data-min="'. $args['min'] .'">';

        if( ! empty( $this->value ) ) {

          $num = 0;

          foreach ( $this->value as $value ) {

            $first_id    = ( isset( $this->field['fields'][0]['id'] ) ) ? $this->field['fields'][0]['id'] : '';
            $first_value = ( isset( $value[$first_id] ) ) ? $value[$first_id] : '';

            echo '<div class="spftestimonial-cloneable-item">';

              echo '<div class="spftestimonial-cloneable-helper">';
              echo '<i class="spftestimonial-cloneable-sort fa fa-arrows"></i>';
              echo '<i class="spftestimonial-cloneable-clone fa fa-clone"></i>';
              echo '<i class="spftestimonial-cloneable-remove spftestimonial-confirm fa fa-times" data-confirm="'. esc_html__( 'Are you sure to delete this item?', 'testimonial-free' ) .'"></i>';
              echo '</div>';

              echo '<h4 class="spftestimonial-cloneable-title">';
              echo '<span class="spftestimonial-cloneable-text">';
              echo ( $title_number ) ? '<span class="spftestimonial-cloneable-title-number">'. ( $num+1 ) .'.</span>' : '';
              echo ( $title_prefix ) ? '<span class="spftestimonial-cloneable-title-prefix">'. $title_prefix .'</span>' : '';
              echo ( $title_auto ) ? '<span class="spftestimonial-cloneable-value">' . $first_value .'</span>' : '';
              echo '</span>';
              echo '</h4>';

              echo '<div class="spftestimonial-cloneable-content">';

              foreach ( $this->field['fields'] as $field ) {

                $field_parent  = $this->parent .'['. $this->field['id'] .']';
                $field_unique = ( ! empty( $this->unique ) ) ? $this->unique .'['. $this->field['id'] .']['. $num .']' : $this->field['id'] .'['. $num .']';
                $field_value  = ( isset( $field['id'] ) && isset( $value[$field['id']] ) ) ? $value[$field['id']] : '';

                SPFTESTIMONIAL::field( $field, $field_value, $field_unique, 'field/group', $field_parent );

              }

              echo '</div>';

            echo '</div>';

            $num++;

          }

        }

        echo '</div>';

        echo '<div class="spftestimonial-cloneable-alert spftestimonial-cloneable-max">'. esc_html__( 'You can not add more than', 'testimonial-free' ) .' '. $args['max'] .'</div>';
        echo '<div class="spftestimonial-cloneable-alert spftestimonial-cloneable-min">'. esc_html__( 'You can not remove less than', 'testimonial-free' ) .' '. $args['min'] .'</div>';

        echo '<a href="#" class="button button-primary spftestimonial-cloneable-add">'. $args['button_title'] .'</a>';

        echo $this->field_after();

      }

    }

    public function enqueue() {

      if( ! wp_script_is( 'jquery-ui-accordion' ) ) {
        wp_enqueue_script( 'jquery-ui-accordion' );
      }

      if( ! wp_script_is( 'jquery-ui-sortable' ) ) {
        wp_enqueue_script( 'jquery-ui-sortable' );
      }

    }

  }
}
