<!doctype html>
<html <?php language_attributes(); ?>>
    <head>
        <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <title><?php bloginfo('name'); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    
    <?php wp_head(); ?>
    </head>
<body <?php body_class(); ?>>

<p>Titre du site dans header.php:</p>
<!-- Titre du site ( = blog name de blog info)-->
		<?php if ( is_front_page() && is_home() ) : ?>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		<?php else : ?>
			<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
		<?php endif; ?>
<!-- fin titre du site -->

<p>Menu du site dans header.php:</p>
<?php wp_nav_menu( array( 'theme_location' => 'menu_principal' ) ); ?>
<div>FIN DU HEADER.PHP</br>--------------------------------------------------</div>