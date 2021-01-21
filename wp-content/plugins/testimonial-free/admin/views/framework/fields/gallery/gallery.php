<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.
/**
 *
 * Field: gallery
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! class_exists( 'SPFTESTIMONIAL_Field_gallery' ) ) {
  class SPFTESTIMONIAL_Field_gallery extends SPFTESTIMONIAL_Fields {

    public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
      parent::__construct( $field, $value, $unique, $where, $parent );
    }

    public function render() {

      $args = wp_parse_args( $this->field, array(
        'add_title'   => esc_html__( 'Add Gallery', 'testimonial-free' ),
        'edit_title'  => esc_html__( 'Edit Gallery', 'testimonial-free' ),
        'clear_title' => esc_html__( 'Clear', 'testimonial-free' ),
      ) );

      $hidden = ( empty( $this->value ) ) ? ' hidden' : '';

      echo $this->field_before();

      echo '<ul>';

      if( ! empty( $this->value ) ) {

        $values = explode( ',', $this->value );

        foreach ( $values as $id ) {
          $attachment = wp_get_attachment_image_src( $id, 'thumbnail' );
          echo '<li><img src="'. $attachment[0] .'" /></li>';
        }

      }

      echo '</ul>';
      echo '<a href="#" class="button button-primary spftestimonial-button">'. $args['add_title'] .'</a>';
      echo '<a href="#" class="button spftestimonial-edit-gallery'. $hidden .'">'. $args['edit_title'] .'</a>';
      echo '<a href="#" class="button spftestimonial-warning-primary spftestimonial-clear-gallery'. $hidden .'">'. $args['clear_title'] .'</a>';
      echo '<input type="text" name="'. $this->field_name() .'" value="'. $this->value .'"'. $this->field_attributes() .'/>';

      echo $this->field_after();

    }

  }
}
