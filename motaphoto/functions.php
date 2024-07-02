<?php

// Chargement du css
function load_css() {
	wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/assets/css/style.css', array(), filemtime(get_stylesheet_directory() . '/assets/css/style.css'));
}
add_action( 'wp_enqueue_scripts', 'load_css' );

// Chargement du Javascript
function load_javascript(){
    wp_enqueue_script( "custom-js", get_stylesheet_directory_uri() . "/assets/js/script.js", array(), false, true );
}
add_action( 'wp_enqueue_scripts', 'load_javascript' );

// Activation de JQuery
function theme_scripts() {
    wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'theme_scripts');

// Supprimer les balises p rajoutées par Contact Form7
add_filter('wpcf7_autop_or_not', '__return_false');

// Ajouter au thème l'image mise en avant
add_theme_support( 'post-thumbnails' );

//ajouter une nouvelle zone de menu à mon thème
// s'il y a plusieurs menus à rajouter, voici le code :
function register_my_menus() {
    register_nav_menus(
    array(
    'main-menu' => __( 'Menu Principal' ),
    'footer-menu' => __( 'Menu Footer' ),
    )
    );
   }
   add_action( 'init', 'register_my_menus' );