<?php get_header(); ?>
<section>
    <?php while( have_posts() ) : the_post(); ?>
        <article>
            <h1><?php the_title(); ?></h1>
            <?php the_content(); ?>  
        </article>
    <?php endwhile; ?>
    STARTERS
    <?php if( have_rows( 'starters' ) ): ?>
        <div class="team">
            <?php while ( have_rows( 'starters' ) ) : the_row(); ?>
            <div class="team__member">
                <?php the_sub_field( 'starter_name' ); ?>
                <?php the_sub_field( 'starter_description' ); ?>
                <?php the_sub_field( 'starter_price' ); ?>
            </div>
            <?php endwhile; ?>
        </div>
        <?php endif; ?>
        MAIN
        <?php if( have_rows( 'mains' ) ): ?>
        <div class="team">
            <?php while ( have_rows( 'mains' ) ) : the_row(); ?>
            <div class="team__member">
                <?php the_sub_field( 'main_name' ); ?>
                <?php the_sub_field( 'main_description' ); ?>
                <?php the_sub_field( 'main_price' ); ?>
            </div>
            <?php endwhile; ?>
        </div>
        <?php endif; ?>
        DESSERTS
        <?php if( have_rows( 'desserts' ) ): ?>
            <div class="team">
                <?php while ( have_rows( 'desserts' ) ) : the_row(); ?>
                <div class="team__member">
                    <?php the_sub_field( 'dessert_name' ); ?>
                    <?php the_sub_field( 'dessert_description' ); ?>
                    <?php the_sub_field( 'dessert_price' ); ?>
                </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    
</section>
<?php get_footer(); ?>