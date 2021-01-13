<?php get_header(); ?>
<section>
        <h1>Mes articles</h1>
        <?php while(have_posts()) : the_post(); ?>
        <article>
		<?php the_post_thumbnail('medium'); ?>
            <h2><?php the_title(); ?></h2>
            <?php the_content(); ?>
        </article>
		<?php endwhile; ?>
</section>
<?php get_footer(); ?>