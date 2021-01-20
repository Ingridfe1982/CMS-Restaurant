<?php get_header(); ?>
<section>
    <h1>Les recettes</h1>
    <?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>

        <article>

            <?php the_post_thumbnail(); ?>

            <?php the_content(); ?>

            <a href="<?php the_permalink(); ?>">READ A LITTLE MORE</a>

        </article>

    <?php endwhile; endif; ?>
</section>
<?php get_footer(); ?>