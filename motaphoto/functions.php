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

// Ajouter colonnes dans CPT Photos
function bbx_columns( $column ) {
	$column['fichier'] = 'Fichier photo';
	$column['categorie'] = 'Catégorie';
	$column['format'] = 'Format';
	return $column;
}
add_filter( 'manage_photos_posts_columns', 'bbx_columns' );

// Ajouter le contenu des colonnes ajoutées au CPT Photos
function custom_photos_column($column, $post_id) {
    if ( $column == 'categorie' ) {
		$categories = get_the_category($postId);
		foreach($categories as $category){
			echo '<a href="' . get_category_link($category) . '">' . $category->cat_name . '</a>';
		}
	}
}
add_action('manage_photos_posts_custom_column', 'custom_photos_column',10,2);

?>