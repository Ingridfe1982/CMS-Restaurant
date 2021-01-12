<?php get_header(); ?>
        <!-- <h1>Mes articles</h1> -->
        <?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
        <?php the_post_thumbnail('medium'); ?>
    	<h2><?php the_title(); ?></h2>
       	<?php the_content(); ?>

	<?php endwhile; endif; ?>

<?php get_footer(); ?>