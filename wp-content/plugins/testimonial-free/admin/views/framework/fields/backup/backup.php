<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.
/**
 *
 * Field: backup
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! class_exists( 'SPFTESTIMONIAL_Field_backup' ) ) {
  class SPFTESTIMONIAL_Field_backup extends SPFTESTIMONIAL_Fields {

    public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
      parent::__construct( $field, $value, $unique, $where, $parent );
    }

    public function render() {

      $unique = $this->unique;
      $nonce  = wp_create_nonce( 'spftestimonial_backup_nonce' );
      $export = add_query_arg( array( 'action' => 'spftestimonial-export', 'export' => $unique, 'nonce' => $nonce ), admin_url( 'admin-ajax.php' ) );

      echo $this->field_before();

      echo '<textarea name="spftestimonial_transient[spftestimonial_import_data]" class="spftestimonial-import-data"></textarea>';
      echo '<button type="submit" class="button button-primary spftestimonial-confirm spftestimonial-import" data-unique="'. $unique .'" data-nonce="'. $nonce .'">'. esc_html__( 'Import', 'testimonial-free' ) .'</button>';
      echo '<small>( '. esc_html__( 'copy-paste your backup string here', 'testimonial-free' ).' )</small>';

      echo '<hr />';
      echo '<textarea readonly="readonly" class="spftestimonial-export-data">'. json_encode( get_option( $unique ) ) .'</textarea>';
      echo '<a href="'. esc_url( $export ) .'" class="button button-primary spftestimonial-export" target="_blank">'. esc_html__( 'Export and Download Backup', 'testimonial-free' ) .'</a>';

      echo '<hr />';
      echo '<button type="submit" name="spftestimonial_transient[spftestimonial_reset_all]" value="spftestimonial_reset_all" class="button spftestimonial-warning-primary spftestimonial-confirm spftestimonial-reset" data-unique="'. $unique .'" data-nonce="'. $nonce .'">'. esc_html__( 'Reset All', 'testimonial-free' ) .'</button>';
      echo '<small class="spftestimonial-text-error">'. esc_html__( 'Please be sure for reset all of options.', 'testimonial-free' ) .'</small>';

      echo $this->field_after();

    }

  }
}
