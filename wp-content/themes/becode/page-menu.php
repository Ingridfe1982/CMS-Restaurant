<?php get_header(); ?>
<section id="our_menu">
    <div class="the_menu">
    <?php while( have_posts() ) : the_post(); ?>
        <article class="menu_welcome">
            <h1 class="menu_title">THE MENU</h1>  
        </article>
    <?php endwhile; ?>
    <p class="menu_category">STARTERS</p>
    <div class="menu_category_details">
        <?php if( have_rows( 'starters' ) ): ?>
            <?php while ( have_rows( 'starters' ) ) : the_row(); ?>
                <?php if ( get_sub_field('starter_chef_selection')) : ?>
                                    <div class="selection_title">CHEF SELECTION</div>
                                    <div class="menu_selection">
                                        <ul class="menu_details">
                                            <li>
                                                <span class="menu_name">
                                                    <?php the_sub_field( 'starter_name' ); ?>
                                                </span>
                                                <span class="menu_price">
                                                    <?php the_sub_field( 'starter_price' ); ?> €
                                                </span>
                                            </li>
                                            <li class="menu_description">
                                                <?php the_sub_field( 'starter_description' ); ?>
                                            </li>
                                        </ul>
                                    </div>
                <?php else: ?>
                <ul class="menu_details">
                    <li>
                        <span class="menu_name">
                            <?php the_sub_field( 'starter_name' ); ?>
                        </span>
                        <span class="menu_price">
                            <?php the_sub_field( 'starter_price' ); ?> €
                        </span>
                    </li>
                    <li class="menu_description">
                        <?php the_sub_field( 'starter_description' ); ?>
                    </li>
                </ul>
                <?php endif; ?>
            <?php endwhile; ?> 
        <?php endif; ?>
    </div>
        <p class="menu_category">MAINS</p>
        <div class="menu_category_details">
            <?php if( have_rows( 'mains' ) ): ?>
            <?php while ( have_rows( 'mains' ) ) : the_row(); ?>
                <?php if ( get_sub_field('main_chef_selection')) : ?>
                                <div class="selection_title">CHEF SELECTION</div>
                                <div class="menu_selection">
                                <ul class="menu_details">
                                    <li>
                                        <span class="menu_name">
                                            <?php the_sub_field( 'main_name' ); ?>
                                        </span>
                                        <span class="menu_price">
                                            <?php the_sub_field( 'main_price' ); ?> €
                                        </span>
                                    </li>
                                    <li class="menu_description">
                                        <?php the_sub_field( 'main_description' ); ?>
                                    </li>
                                </ul>
                                </div>
                    <?php else: ?>
                <ul class="menu_details">
                    <li>
                        <span class="menu_name">
                            <?php the_sub_field( 'main_name' ); ?>
                        </span>
                        <span class="menu_price">
                            <?php the_sub_field( 'main_price' ); ?> €
                        </span>
                    </li>
                    <li class="menu_description">
                        <?php the_sub_field( 'main_description' ); ?>
                    </li>
                </ul>
                <?php endif; ?>
            <?php endwhile; ?> 
            <?php endif; ?>
        </div>
        <p class="menu_category">DESSERTS</p>
        <div class="menu_category_details">
            <?php if( have_rows( 'desserts' ) ): ?>
            <?php while ( have_rows( 'desserts' ) ) : the_row(); ?> 
                <?php if ( get_sub_field('dessert_chef_selection')) : ?>
                            <div class="selection_title">CHEF SELECTION</div>
                            <div class="menu_selection">
                                <ul class="menu_details">
                                    <li>
                                        <span class="menu_name">
                                            <?php the_sub_field( 'dessert_name' ); ?>
                                        </span>
                                        <span class="menu_price">
                                            <?php the_sub_field( 'dessert_price' ); ?> €
                                        </span>
                                    </li>
                                    <li class="menu_description">
                                        <?php the_sub_field( 'dessert_description' ); ?>
                                    </li>
                                </ul>
                            </div>
                <?php else: ?>
                <ul class="menu_details">
                    <li>
                        <span class="menu_name">
                            <?php the_sub_field( 'dessert_name' ); ?>
                        </span>
                        <span class="menu_price">
                            <?php the_sub_field( 'dessert_price' ); ?> €
                        </span>
                    </li>
                    <li class="menu_description">
                        <?php the_sub_field( 'dessert_description' ); ?>
                    </li>
                </ul>
                <?php endif ; ?>
            <?php endwhile; ?> 
            <?php endif; ?>
        </div>
    </div>
</section>

<?php while( have_posts() ) : the_post(); ?>
            <?php the_content(); ?> 
       
<?php endwhile; ?>

<?php get_footer(); ?>