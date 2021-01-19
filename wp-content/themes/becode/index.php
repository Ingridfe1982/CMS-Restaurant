<?php get_header(); ?>
<section>
        <!-- <h1>Mes articles</h1> -->
        <div class="container">
             <?php while(have_posts()) : the_post(); ?>
                <article>
                    <div class="recipes">
                        <div class="recipes_details">
                            <?php the_time('d F Y'); ?>
                            <h4><?php the_title(); ?></h4>
                            <?php the_excerpt(); ?>
                            <a class="read_more" href="<?php the_permalink(); ?>">READ MORE</a>
                        </div>
                        <div class="recipes_img">
                            <?php the_post_thumbnail('thumbnail'); ?>
                        </div>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>
</section>
<?php get_footer(); ?>