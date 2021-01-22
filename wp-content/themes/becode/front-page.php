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
<div class="hach_bottom_header_testi">
    <!-- background style hachage-->
</div>
<section class="testimonial">
    <div class="testi_txt">
	<?php echo do_shortcode('[sp_testimonial id="438"]'); ?>
    </div>
    <div class="testi_img">
        <img src="http://localhost/CMS-Restaurant/wp-content/uploads/2021/01/customers.png">
    </div>
</section>
<div class="hach_bottom_header">
    <!-- background style hachage-->
</div>
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