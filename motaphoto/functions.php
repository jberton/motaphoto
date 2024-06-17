<?php

// Chargement du css
function load_css() {
	wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/style.css', array(), filemtime(get_stylesheet_directory() . '/style.css'));
}
add_action( 'wp_enqueue_scripts', 'load_css' );

// Chargement du Javascript

function load_javascript(){
    wp_enqueue_script( "custom-js", get_stylesheet_directory_uri() . "/assets/js/script.js", array(), false, true );
}
add_action( 'wp_enqueue_scripts', 'load_javascript' );

?>