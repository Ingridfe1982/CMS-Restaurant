<?php get_header(); ?>
<section>
    <?php while( have_posts() ) : the_post(); ?>
        <article>
            <h1><?php /*the_title(); */?></h1>
            <?php the_content(); ?>  
        </article>
    <?php endwhile; ?>
</section>
<?php get_footer(); ?>