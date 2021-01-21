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
        <!-- <h1>Mes articles</h1> -->
    <div class="container">
            <div class="cat_navigation">
                <?php wp_nav_menu( array( 'theme_location' => 'categorie_menu' ) ); ?>
            </div>
            <?php while(have_posts()) : the_post(); ?>
                <div class="recipes">
                    <div class="recipes_details">
                        <div class="post_date">
                            <img class="img_cat" src="http://localhost/CMS-Restaurant/wp-content/uploads/2021/01/time-clock-1.svg"><?php the_time('d F Y'); ?>
                        </div>
                        <div class="recipe_cat">
                            <img class="img_cat" src="http://localhost/CMS-Restaurant/wp-content/uploads/2021/01/cutelry-1.svg">
                            <?php the_category(); ?>
                        </div>
                        <h3><?php the_title(); ?></h3>
                        <?php the_excerpt(); ?>
                        <div class="bouton">
                            <a class="read_more" href="<?php the_permalink(); ?>">Read More</a>
                        </div>
                    </div>
                    <div class="recipes_img">
                        <img  class="dish" <?= the_post_thumbnail('recipes'); ?>
                    </div>
                </div>
        <?php endwhile; ?>
    </div>
</section>
<?php get_footer(); ?>