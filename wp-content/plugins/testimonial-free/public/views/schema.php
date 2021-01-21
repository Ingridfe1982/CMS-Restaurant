<?php
if ( $post_query->have_posts() ) {
	$sc_title          = get_the_title( $post_id ) ? get_the_title( $post_id ) : 'Testimonial';
	$outline          .= '<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "Product",
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "' . $aggregate_rating . '",
    "reviewCount": "' . $total_rated_testimonials . '"
  },
  "name": "' . $sc_title . '",
  "review": [';
	$testimonial_count = 0;

	while ( $post_query->have_posts() ) :
		$post_query->the_post();

		$testimonial_data  = get_post_meta( get_the_ID(), 'sp_tpro_meta_options', true );
		$tfree_name        = ( isset( $testimonial_data['tpro_name'] ) ? $testimonial_data['tpro_name'] : '' );
		$tfree_rating_star = ( isset( $testimonial_data['tpro_rating'] ) ? $testimonial_data['tpro_rating'] : 'five_star' );

		switch ( $tfree_rating_star ) {
			case 'five_star':
				$rating_value = '5';
				break;
			case 'four_star':
				$rating_value = '4';
				break;
			case 'three_star':
				$rating_value = '3';
				break;
			case 'two_star':
				$rating_value = '2';
				break;
			case 'one_star':
				$rating_value = '1';
				break;
		}

		$outline .= '{
                "@type": "Review",
                "author": "' . $tfree_name . '",
                "datePublished": "' . get_the_date( 'F j, Y' ) . '",';
		if ( get_the_content() ) {
			$outline .= '"description": "' . esc_attr( wp_strip_all_tags( get_the_content() ) ) . '",';
		}
		if ( get_the_title() ) {
			$outline .= '"name": "' . esc_attr( wp_strip_all_tags( get_the_title() ) ) . '",';
		}
				$outline .= '"reviewRating": {
                  "@type": "Rating",
                  "bestRating": "5",
                  "ratingValue": "' . $rating_value . '",
                  "worstRating": "1"
                }
              }';
		if ( ++$testimonial_count !== $total_rated_testimonials ) {
			$outline .= ',';
		}
	endwhile;

	$outline .= ']
}
</script>';
}
