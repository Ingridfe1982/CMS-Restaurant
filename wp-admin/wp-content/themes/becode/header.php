<!doctype html>
<html <?php language_attributes(); ?>>
    <head>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"> 
        <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <title><?php bloginfo('name'); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    
    <?php wp_head(); ?>
    </head>
<body <?php body_class(); ?>>
<section>
    <div>
        <p>Titre du site dans header.php:</p>
        <!-- Titre du site ( = blog name de blog info)-->
        <?php if ( is_front_page() && is_home() ) : ?>
            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
        <?php else : ?>
            <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
        <?php endif; ?>
        <!-- fin titre du site -->
    </div>
    <div>
        <p>Menu du site dans header.php:</p>
        <?php wp_nav_menu( array( 'theme_location' => 'menu_principal' ) ); ?>
    </div>
</section>
<div>FIN DU HEADER.PHP</br>--------------------------------------------------</div>
