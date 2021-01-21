<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.

/**
 *
 * Export
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'spftestimonial_export' ) ) {
  function spftestimonial_export() {

    if( ! empty( $_GET['export'] ) && ! empty( $_GET['nonce'] ) && wp_verify_nonce( $_GET['nonce'], 'spftestimonial_backup_nonce' ) ) {

      header('Content-Type: application/json');
      header('Content-disposition: attachment; filename=backup-'. gmdate( 'd-m-Y' ) .'.json');
      header('Content-Transfer-Encoding: binary');
      header('Pragma: no-cache');
      header('Expires: 0');

      echo json_encode( get_option( wp_unslash( $_GET['export'] ) ) );

    }

    die();
  }
  add_action( 'wp_ajax_spftestimonial-export', 'spftestimonial_export' );
}

/**
 *
 * Import Ajax
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'spftestimonial_import_ajax' ) ) {
  function spftestimonial_import_ajax() {

    if( ! empty( $_POST['import_data'] ) && ! empty( $_POST['unique'] ) && ! empty( $_POST['nonce'] ) && wp_verify_nonce( $_POST['nonce'], 'spftestimonial_backup_nonce' ) ) {

      $import_data = json_decode( wp_unslash( trim( $_POST['import_data'] ) ), true );

      if( is_array( $import_data ) ) {

        update_option( wp_unslash( $_POST['unique'] ), wp_unslash( $import_data ) );
        wp_send_json_success();

      }

    }

    wp_send_json_error( array( 'error' => esc_html__( 'Error: Nonce verification has failed. Please try again.', 'testimonial-free' ) ) );

  }
  add_action( 'wp_ajax_spftestimonial-import', 'spftestimonial_import_ajax' );
}

/**
 *
 * Reset Ajax
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'spftestimonial_reset_ajax' ) ) {
  function spftestimonial_reset_ajax() {

    if( ! empty( $_POST['unique'] ) && ! empty( $_POST['nonce'] ) && wp_verify_nonce( $_POST['nonce'], 'spftestimonial_backup_nonce' ) ) {
      delete_option( wp_unslash( $_POST['unique'] ) );
      wp_send_json_success();
    }

    wp_send_json_error( array( 'error' => esc_html__( 'Error: Nonce verification has failed. Please try again.', 'testimonial-free' ) ) );

  }
  add_action( 'wp_ajax_spftestimonial-reset', 'spftestimonial_reset_ajax' );
}

/**
 *
 * Chosen Ajax
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'spftestimonial_chosen_ajax' ) ) {
  function spftestimonial_chosen_ajax() {

    if( ! empty( $_POST['term'] ) && ! empty( $_POST['type'] ) && ! empty( $_POST['nonce'] ) && wp_verify_nonce( $_POST['nonce'], 'spftestimonial_chosen_ajax_nonce' ) ) {

      $capability = apply_filters( 'spftestimonial_chosen_ajax_capability', 'manage_options' );

      if( current_user_can( $capability ) ) {

        $type       = $_POST['type'];
        $term       = $_POST['term'];
        $query_args = ( ! empty( $_POST['query_args'] ) ) ? $_POST['query_args'] : array();
        $options    = SPFTESTIMONIAL_Fields::field_data( $type, $term, $query_args );

        wp_send_json_success( $options );

      } else {
        wp_send_json_error( array( 'error' => esc_html__( 'You do not have required permissions to access.', 'testimonial-free' ) ) );
      }

    } else {
      wp_send_json_error( array( 'error' => esc_html__( 'Error: Nonce verification has failed. Please try again.', 'testimonial-free' ) ) );
    }

  }
  add_action( 'wp_ajax_spftestimonial-chosen', 'spftestimonial_chosen_ajax' );
}
