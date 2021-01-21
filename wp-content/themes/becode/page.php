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
    <?php while( have_posts() ) : the_post(); ?>
        <article>
            <h1><?php /*the_title(); */?></h1>
            <?php the_content(); ?>  
        </article>
    <?php endwhile; ?>
</section>
<?php get_footer(); ?>