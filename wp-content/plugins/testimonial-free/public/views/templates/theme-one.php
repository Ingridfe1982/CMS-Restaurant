<?php
/**
 * Theme One
 */

$outline .= '<div class="sp-testimonial-free-item">';
$outline .= '<div class="sp-testimonial-free">';

if ( $client_image && has_post_thumbnail( $post_query->post->ID ) ) {
	$outline .= '<div class="sp-tfree-client-image">';
	$outline .= get_the_post_thumbnail( $post_query->post->ID, $image_sizes, array( 'class' => 'tfree-client-image' ) );
	$outline .= '</div>';
}

if ( $testimonial_title && ! empty( get_the_title() ) ) {
	$outline .= '<div class="tfree-testimonial-title"><h3>' . get_the_title() . '</h3></div>';
}

if ( $testimonial_text && ! empty( get_the_content() ) ) {
	$outline .= '<div class="tfree-client-testimonial">';
	$outline .= '<p class="tfree-testimonial-content">' . apply_filters( 'the_content', get_the_content() ) . '</p>';
	$outline .= '</div>';
}

if ( $reviewer_name && ! empty( $tfree_name ) ) {
	$outline .= '<h4 class="tfree-client-name">' . $tfree_name . '</h2>';
}

if ( $star_rating && ! empty( $tfree_rating_star ) ) {

	switch ( $tfree_rating_star ) {
		case 'five_star':
			$rating_value     = '5';
			$star_rating_data = $this->tfree_five_star;
			break;
		case 'four_star':
			$rating_value     = '4';
			$star_rating_data = $this->tfree_four_star;
			break;
		case 'three_star':
			$rating_value     = '3';
			$star_rating_data = $this->tfree_three_star;
			break;
		case 'two_star':
			$rating_value     = '2';
			$star_rating_data = $this->tfree_two_star;
			break;
		case 'one_star':
			$rating_value     = '1';
			$star_rating_data = $this->tfree_one_star;
			break;
	}

	$outline .= '<div class="tfree-client-rating">';
	$outline .= $star_rating_data;
	$outline .= '</div>';
}

if ( $reviewer_position && ! empty( $tfree_designation ) ) {
	$outline .= '<div class="tfree-client-designation">';
	$outline .= $tfree_designation;
	$outline .= '</div>';
}

$outline .= '</div>'; // sp-testimonial-free.
$outline .= '</div>'; // sp-testimonial-free-item.
