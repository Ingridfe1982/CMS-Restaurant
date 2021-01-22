<?php
// Ajouter la prise en charge des images mises en avant
add_theme_support('post-thumbnails');
// Ajouter automatiquement le titre du site dans l'en-tête du site
add_theme_support( 'title-tag' );
// Définir une autre taille d'images 
add_image_size( 'recipes', 400, 300, false );
add_image_size( 'post', 650, 250, false );

function register_my_menus() {
	register_nav_menus(
	array(
	'menu_principal' => __( 'Menu principal' ),
	'burger_menu' => __( 'Menu Burger' ),
	'categorie_menu' => __(' Menu Catégories'),
	)
	);
   }
   add_action( 'init', 'register_my_menus' );

// widget recipes
function recipes_widgets_init() {
 
<<<<<<< HEAD
    register_sidebar( array(

        'name' => 'Recipes',
        'id' => 'recipes-widgets',
        'before_widget' => '<div class="recipes_widget">',
        'after_widget' => '</div>',
        'before_title' => '<div>',
        'after_title' => '</div>',
        ) );
    }
    // to have the option with the widgets in the dashboard of wp: add_action ...
add_action( 'widgets_init', 'recipes_widgets_init' );

=======
	register_sidebar( array(
   
		'name' => 'Recipes',
		'id' => 'recipes_widgets',
		'before_widget' => '<div class="recipes_widgets>',
		'after_widget' => '</div>',
		'before_title' => '<div>',
		'after_title' => '</div>',
		) );
	}
	// to have the option with the widgets in the dashboard of wp: add_action ...
add_action( 'widgets_init', 'recipes_widgets_init' );

	
>>>>>>> olivier
// widget in the footer
function footer_widgets_init() {
 
	register_sidebar( array(
   
		'name' => 'Footer col 1',
		'id' => 'footer-widget-area1',
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<div class="title_miniplus">',
		'after_title' => '</div>',
		) );
	
	register_sidebar( array(
   
		'name' => 'Footer col 2',
		'id' => 'footer-widget-area2',
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<div class="title_mini">',
		'after_title' => '</div>',
		) );
		
	register_sidebar( array(
   
		'name' => 'Footer col 3',
		'id' => 'footer-widget-area3',
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<div class="title_mini">',
		'after_title' => '</div>',
		) );
		
	register_sidebar( array(
   
		'name' => 'Footer col 4',
		'id' => 'footer-widget-area4',
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<div class="title_mini">',
		'after_title' => '</div>',
		) );
	register_sidebar( array(

		'name' => 'Newsletter area',
		'id' => 'footer-widget-area5',
		'before_widget' => '<div class="news_widget">',
		'after_widget' => '</div>',
		'before_title' => '<div class="news_title">',
		'after_title' => '</div>',
		) );
   }
   	// to have the option with the widgets in the dashboard of wp: add_action ...
   add_action( 'widgets_init', 'footer_widgets_init' );
