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
            
            <div class="post_info">
                <?php the_category(); ?>
                <?php the_time('d F Y'); ?>
            </div>
        
            <h1 class="recipe_title"><?php the_title(); ?></h1>

            <div class="post_content">
                <?php the_content(); ?>
            </div>

            <?php the_post_thumbnail('post'); ?>

            <h4 class="instr_title">INGREDIENTS</h4>
            
            <?php echo get_field('preparation'); ?>

            <?php echo get_field('ingredients') ?>

            <h4 class="instr_title">INSTRUCTIONS</h4>

            <?php if( have_rows( 'instructions' ) ):
                $instruction_number = 1; ?>
                <?php while ( have_rows( 'instructions' ) ) : the_row(); ?>

                    <div class="instr_number">
                        <!-- <p class="instr_number_p"> -->
                            <?php echo $instruction_number++ ?>
                        <!-- </p> -->
                    </div>

                    <div class="instructions">
                        <?php the_sub_field('instructions') ?>
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