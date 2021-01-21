<?php
if ( is_home() ) :
    get_header( 'blog' );
elseif ( is_archive() ) :
    get_header( 'archive' );
elseif ( is_single() ) :
    get_header( 'single' );
else :
    get_header();
endif;
?>
<section>
    <?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
        <?php the_post_thumbnail('medium'); ?>
    	<!-- <h2><?php /*the_title();*/ ?></h2> -->
       	<?php the_content(); ?>
	<?php endwhile; endif; ?>
</section>
<?php get_footer(); ?>

<!-- *** Banner top  ***
	* Subtitle + Main Title + Img + Intern Link
	* 3 X Icon + Title + Text
*** Intro ***
	* Left : Image
	* Right : Title + Subtitle + Text + Signature (Subtitle + title)
*** 3 Restaurants ***
	See the posts Restaurants.
*** Our Menu ***
	* 4 X Img
	* Subtitle + Title + + Text + Intern Link
*** Testimony ***
	* Repeater :
		- Image
		- Text
		- Name
*** Recipes Blog ***
	See Posts Recipes -->