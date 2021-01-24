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

<!-- --------------TESTIMONIAL--------------- -->
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
<!-- --------------END OF TESTIMONIAL--------------- -->
<section id="excerpt_white">
    <div class="container">
    <div class="section_title">
        <h4 class="update_title">Latest updated</h4>
        <h4>RECIPES BLOG</h4>
    </div>
    <?php
        $args = array(
            'post_type'         => 'post',
            'posts_per_page'    => 4
        );
        $the_query = new WP_Query( $args );

        // The Loop
        if ( $the_query->have_posts() ) {
            echo ' <div class="card_container">';
        
            while ( $the_query->have_posts() ) {
                $the_query->the_post();
                    echo '<div class="latest_card">';
                        echo '<div>' . the_post_thumbnail('card', ['class' => 'card-img-top', 'alt' => '']) . '</div>';
                        echo '<div class="card_text"> <p>';
                            echo '<img class="img_cat" src="http://localhost/CMS-Restaurant/wp-content/uploads/2021/01/time-clock-1.svg">';
                            echo the_time( get_option( 'date_format' ) );
                        echo '</p>';
                        echo '<p class="card_title">' . get_the_title() . '</p>';
                        echo '<p>' . the_excerpt() . '</p>';
                        echo '<div class="horizontal_dotted_line">';
                            echo '<span class="dot">' . '</span>';
                            echo '<a class="readMore" href="' . get_permalink() . '">' . 'Read More' . '</a>';
                        echo '</div>';
                        echo '</div>';
                    echo '</div>';
            }
            echo '</div>';

        }
        /* Restore original Post Data */
        wp_reset_postdata();

        ?>
    </div>
</section>

<?php get_footer(); ?>