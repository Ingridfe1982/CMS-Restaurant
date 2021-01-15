<?php
// Ajouter la prise en charge des images mises en avant
add_theme_support('post-thumbnails');
// Ajouter automatiquement le titre du site dans l'en-tête du site
add_theme_support( 'title-tag' );

function enregistre_mon_menu() {
    register_nav_menu( 'menu_principal', __( 'Menu principal' ) );
}
add_action( 'init', 'enregistre_mon_menu' );

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
   }
   	// to have the option with the widgets in the dashboard of wp: add_action ...
   add_action( 'widgets_init', 'footer_widgets_init' );
