<?php
    get_header( 'blog' );
?>
<section id="blog_page">
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
    <div class="pagination">
        <?php echo paginate_links(); ?>
    </div>
</section>
<div class="hach_bottom_home">
    <!-- background style hachage-->
</div>
<section id="discorver_food">
    <div class="container">
        <div class="d_food">    
            <div class="insta_d_food">
            <?php echo do_shortcode('[instagram-feed num=4 cols=2]');?>
            </div>
            <div class="txt_d_food">
                <h2>LET'S DISCOVER FOOD</h2>
                <h1>DISCOVER OUR MENU</h1>
                <div class="text_d_food">
                    For those pure food indulgence in mind, come next door and sate your desires with our ever changing internationally ans seasonally inspired small plates. We love food, lots of different food, just like you.
                </div>
                <div class="read_more">
                    <a href="http://localhost/CMS-Restaurant/index.php/menu/">View the full Menu</a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php  get_footer( ); ?>