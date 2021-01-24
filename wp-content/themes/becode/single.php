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
                        <div class="date"> <?php the_time('d F Y'); ?></div>
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

                <div class="networks">
                    <a href="https://facebook.com/" target="_blank"><img class="logo" src="http://localhost/CMS-Restaurant/wp-content/uploads/2021/01/facebook.svg"></a>
                    <a href="https://twitter.com/" target="_blank"><img class="logo" src="http://localhost/CMS-Restaurant/wp-content/uploads/2021/01/twitter.svg"></a>
                    <a href="https://www.instagram.com/dev.restaurant/" target="_blank"><img class="logo" src="http://localhost/CMS-Restaurant/wp-content/uploads/2021/01/instagram.svg"></a>
                    <a href="mailto:devrestaurant@becode.org"><img class="logo" src="http://localhost/CMS-Restaurant/wp-content/uploads/2021/01/gmail.svg"></a>
                </div>

                <div class="bloc_ingr">
                    <h4 class="recipe_step">Ingredients</h4>
                    <div class="recipe_prep">
                        <?php echo get_field('preparation'); ?>
                    </div>
                    <div class="ingredients">
                        <?php echo get_field('ingredients') ?>
                    </div>
                </div>    
            </div>
            
            <h4 class="instr_title recipe_step">Instructions</h4>

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
<div class="hach_bottom_header_testi">
    <!-- background style hachage-->
</div>
<section id="excerpt">
    <div class="container">
    <div class="section_title">
        <h4 class="update_title">Latest updated</h4>
        <h4>RECIPES BLOG</h4>
    </div>
    <?php
        $args = array(
            'post_type'         => 'post',
            'posts_per_page'    => 4
        );
        $the_query = new WP_Query( $args );

        // The Loop
        if ( $the_query->have_posts() ) {
            echo ' <div class="card_container">';
        
            while ( $the_query->have_posts() ) {
                $the_query->the_post();
                    echo '<div class="latest_card">';
                        echo '<div>' . the_post_thumbnail('card', ['class' => 'card-img-top', 'alt' => '']) . '</div>';
                        echo '<div class="card_text"> <p>';
                            echo '<img class="img_cat" src="http://localhost/CMS-Restaurant/wp-content/uploads/2021/01/time-clock-1.svg">';
                            echo the_time( get_option( 'date_format' ) );
                        echo '</p>';
                        echo '<p class="card_title">' . get_the_title() . '</p>';
                        echo '<p>' . the_excerpt() . '</p>';
                        echo '<div class="horizontal_dotted_line">';
                            echo '<span class="dot">' . '</span>';
                            echo '<a class="readMore" href="' . get_permalink() . '">' . 'Read More' . '</a>';
                        echo '</div>';
                        echo '</div>';
                    echo '</div>';
            }
            echo '</div>';

        }
        /* Restore original Post Data */
        wp_reset_postdata();

        ?>
    </div>
</section>
<?php get_footer(); ?>