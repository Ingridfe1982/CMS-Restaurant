<?php
if ( is_home() ) :
    get_header( 'blog' );
elseif ( is_archive() ) :
    get_header( 'archive' );
else :
    get_header();
endif;
?>
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
                            <img class="boulet" <?php the_post_thumbnail('recipes'); ?>
                        </div>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>
</section>
<?php get_footer(); ?>