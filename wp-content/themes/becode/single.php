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
    <div class="box_instructions">
        <?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
            
            <div class="head_bloc">
                <div class="post_info">
                    <div class="flex-hour">
                        <a href="home.php" class="back"><img class="img_cat" src="http://localhost/CMS-Restaurant/wp-content/uploads/2021/01/left-arrow-1.svg">Retour</a>
                        <?php the_time('d F Y'); ?>
                    </div>
                    <div class="recipe_cat">
                            <img class="img_cat" src="http://localhost/CMS-Restaurant/wp-content/uploads/2021/01/cutelry-2.svg">
                            <?php the_category(); ?>
                        </div>
                </div>
            
                <h1 class="recipe_title"><?php the_title(); ?></h1>

                <div class="post_content">
                    <?php the_content(); ?>
                </div>
            </div>

            <div class="recipe_img">
                <?php the_post_thumbnail('post'); ?>
            </div>

            <div class="ingr-flex">

            <div>
    </div>

                <div class="recipe_widget">
                    <?php if ( is_active_sidebar( 'recipes-widgets' ) ) : ?>
                        <div id="recipes_widget" class="recipe_widget" role="complementary"><?php dynamic_sidebar( 'recipes-widgets' ); ?></div>
                    <?php endif; ?>
                </div>

                <div class="bloc_ingr">
                    <h4 class="instr_title">INGREDIENTS</h4>
                    <div class="recipe_prep">
                        <?php echo get_field('preparation'); ?>
                    </div>
                    <div class="ingredients">
                        <?php echo get_field('ingredients') ?>
                    </div>
                </div>    
            </div>
            
            <h4 class="instr_title">INSTRUCTIONS</h4>

            <?php if( have_rows( 'instructions' ) ):
                $instruction_number = 1; ?>
                <?php while ( have_rows( 'instructions' ) ) : the_row(); ?>

                <div class="instru-flex">

                    <div class="instr_number">
                        <!-- <p class="instr_number_p"> -->
                            <?php echo $instruction_number++ ?>
                        <!-- </p> -->
                    </div>

                    <div class="instructions">
                        <?php the_sub_field('instructions') ?>
                    </div>
                </div>

                    <?php
                        $image = get_sub_field('image');
                        if ( $image ):
                            ?>
                                <!-- <div class="boxImgInstruction"> -->
                                    <img class="imgInstruction" src=<?php echo $image; ?>>
                                <!-- </div> -->
                    <?php endif; ?>

            <?php endwhile; endif; ?>
            
        <?php endwhile; endif; ?>
    </div>
</section>
<?php get_footer(); ?>