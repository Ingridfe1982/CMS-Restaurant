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
    <div class="container">
        <?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
            
            <h1><?php the_title(); ?></h1>

            <?php the_post_thumbnail('recipes'); ?>

            <?php the_content(); ?>
            
            

        <?php endwhile; endif; ?>
    </div>
</section>
<?php get_footer(); ?>