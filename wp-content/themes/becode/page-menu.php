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

<?php get_footer( 'grey' ); ?>