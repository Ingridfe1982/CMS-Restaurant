<!doctype html>
<html <?php language_attributes(); ?>>
<head> 
        <meta charset="UTF-8">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"> 
        <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
        <link rel="stylesheet" href="http://localhost/CMS-Restaurant/wp-content/themes/becode/style-our-resto.css">
        <link rel="preload" href="../styles/fonts/Poppins.ttf" as="fonts">
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <title><?php bloginfo('name'); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>



<section class="header">
    <div class="header_img_background">
        <?php 
        $image = get_field('image_en-tete');
        if( !empty( $image ) ){ ?>
            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
        <?php ;}else{ ?>
            <div class="noimage"></div>
            <?php ;}
            ?>
    </div>
    <div class="container">
        <div class="top_site">
            <!-- Site Title ( = blog name de blog info)-->
            <div class="site-title">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
            </div>
            <!-- END Site Title -->

            <!-- Menu -->
            <div class="header_navigation">
                <?php wp_nav_menu( array( 'theme_location' => 'menu_principal' ) ); ?>
            </div>
        </div>
        
        <!-- page title -->
        <div class="header_title">
            <div class="header_title_slogan"><?php the_field('header_title_slogan') ?></div>
            <div class="header_title_big"><?php the_field('header_title_big_1') ?><br><?php the_field('header_title_big_2') ?></div>
        </div>
        <div class="lien_bonus">
            <div class="topline2"></div>
            <a href="<?php the_field('lien_bonus', 18) ?>"><?php the_field('texte_du_lien_bonus') ?></a></div>
        <!-- END page title -->
    </div>
</section>

<div class="hach_bottom_header">
    <!-- background style hachage-->
</div>


