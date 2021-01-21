<?php
/**
 * The admin review notice.
 *
 * @since        2.1.5
 * @version      2.1.5
 *
 * @package    Testimonial
 * @subpackage Testimonial/admin/views/notices
 * @author     ShapedPlugin<support@shapedplugin.com>
 */
class Testimonial_Review {

	public function __construct() {
		add_action( 'admin_notices', array( $this, 'display_admin_notice' ) );
		add_action( 'wp_ajax_sp-tfree-never-show-review-notice', array( $this, 'dismiss_review_notice' ) );
	}

	/**
	 * Display admin notice.
	 *
	 * @return void
	 */
	public function display_admin_notice() {

		// Show only to Admins.
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		// Variable default value.
		$review = get_option( 'sp_testimonial_review_notice_dismiss' );
		$time   = time();
		$load   = false;

		if ( ! $review ) {
			$review = array(
				'time'      => $time,
				'dismissed' => false,
			);
			add_option( 'sp_testimonial_review_notice_dismiss', $review );
		} else {
			// Check if it has been dismissed or not.
			if ( ( isset( $review['dismissed'] ) && ! $review['dismissed'] ) && ( isset( $review['time'] ) && ( ( $review['time'] + ( DAY_IN_SECONDS * 3 ) ) <= $time ) ) ) {
				$load = true;
			}
		}

		// If we cannot load, return early.
		if ( ! $load ) {
			return;
		}
		?>
		<div id="sp-tfree-review-notice" class="sp-tfree-review-notice">
			<div class="sp-tfree-plugin-icon">
				<img src="<?php echo SP_TFREE_URL . 'admin/assets/images/icon-256.png'; ?>" alt="Testimonial">
			</div>
			<div class="sp-tfree-notice-text">
				<h3>Enjoying <strong>Testimonial</strong>?</h3>
				<p>Hope that you had a good experience with the <strong>Testimonial</strong>. Would you please show us a little love by rating us in the <a href="https://wordpress.org/support/plugin/testimonial-free/reviews/?filter=5#new-post" target="_blank"><strong>WordPress.org</strong></a>?
				Just a minute to rate it. Thank you!</p>

				<p class="sp-tfree-review-actions">
					<a href="https://wordpress.org/support/plugin/testimonial-free/reviews/?filter=5#new-post" target="_blank" class="button button-primary notice-dismissed rate-testimonial">Rate Testimonial</a>
					<a href="#" class="notice-dismissed remind-me-later"><span class="dashicons dashicons-clock"></span>Nope, maybe later
</a>
					<a href="#" class="notice-dismissed never-show-again"><span class="dashicons dashicons-dismiss"></span>Never show again</a>
				</p>
			</div>
		</div>

		<script type='text/javascript'>

			jQuery(document).ready( function($) {
				$(document).on('click', '#sp-tfree-review-notice.sp-tfree-review-notice .notice-dismissed', function( event ) {
					if ( $(this).hasClass('rate-testimonial') ) {
						var notice_dismissed_value = "1";
					}
					if ( $(this).hasClass('remind-me-later') ) {
						var notice_dismissed_value =  "2";
						event.preventDefault();
					}
					if ( $(this).hasClass('never-show-again') ) {
						var notice_dismissed_value =  "3";
						event.preventDefault();
					}

					$.post( ajaxurl, {
						action: 'sp-tfree-never-show-review-notice',
						notice_dismissed_data : notice_dismissed_value
					});

					$('#sp-tfree-review-notice.sp-tfree-review-notice').hide();
				});
			});

		</script>
		<?php
	}

	/**
	 * Dismiss review notice
	 *
	 * @since  2.1.5
	 *
	 * @return void
	 **/
	public function dismiss_review_notice() {
		if ( ! $review ) {
			$review = array();
		}
		switch ( $_POST['notice_dismissed_data'] ) {
			case '1':
				$review['time']      = time();
				$review['dismissed'] = false;
				break;
			case '2':
				$review['time']      = time();
				$review['dismissed'] = false;
				break;
			case '3':
				$review['time']      = time();
				$review['dismissed'] = true;
				break;
		}
		update_option( 'sp_testimonial_review_notice_dismiss', $review );
		die;
	}
}

new Testimonial_Review();
