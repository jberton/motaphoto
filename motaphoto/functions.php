<?php

// Chargement du css
function load_css() {
	wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/assets/css/style.css', array(), filemtime(get_stylesheet_directory() . '/assets/css/style.css'));
}
add_action( 'wp_enqueue_scripts', 'load_css' );

// Chargement du Javascript
function load_javascript(){
    wp_enqueue_script( "custom-js", get_stylesheet_directory_uri() . "/assets/js/script.js", array(), false, true );
    wp_enqueue_script( "lightbox", get_stylesheet_directory_uri() . "/assets/js/lightbox.js", [ 'jquery' ], '1.0', false);
    wp_enqueue_script('motaphoto', get_stylesheet_directory_uri() . "/assets/js/ajax.js", [ 'jquery' ], '1.0', true);
}
add_action( 'wp_enqueue_scripts', 'load_javascript');


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
function register_my_menus() {
    register_nav_menus(
    array(
    'main-menu' => __( 'Menu Principal' ),
    'footer-menu' => __( 'Menu Footer' ),
    )
    );
   }
   add_action( 'init', 'register_my_menus' );

// Fonction qui affiche une image de façon aléatoire dans le hero page accueil
function random_photo() {
    $args = array(
        'post_type' => 'photos', // Custom Post type
        'orderby' => 'rand',
        'posts_per_page' => 1,
        );
    $query = new WP_Query( $args );
    if ( $query->have_posts() ) {
            while ( $query->have_posts() ) {
                $query->the_post();
                $rand_photo .= get_the_post_thumbnail();
            }
        wp_reset_postdata();
    } else {
        $rand_photo .= '<p>Pas de photo à afficher.</p>';
    }
    return $rand_photo;
}
add_shortcode('random-photo','random_photo');



// Réceptionner et traiter la requête Ajax en PHP
add_action( 'wp_ajax_load_photos', 'load_photos' );
add_action( 'wp_ajax_nopriv_load_photos', 'load_photos' );

function load_photos() {
  
	// Vérification de sécurité
  	if( 
		! isset( $_REQUEST['nonce'] ) or 
       	! wp_verify_nonce( $_REQUEST['nonce'], 'load_photos' ) 
    ) {
    	wp_send_json_error( "Vous n’avez pas l’autorisation d’effectuer cette action.", 403 );
  	}
    
    // On vérifie que l'identifiant a bien été envoyé
    if( ! isset( $_POST['postid'] ) ) {
    	wp_send_json_error( "L'identifiant de l'article est manquant.", 400 );
  	}

  	// Récupération des données du formulaire
  	$post_id = intval( $_POST['postid'] );
    
	// Vérifier que l'article est publié, et public
	if( get_post_status( $post_id ) !== 'publish' ) {
    	wp_send_json_error( "Vous n'avez pas accès aux commentaires de cet article.", 403 );
	}


    // Requête des photos WP Query - Charger plus, filtre sur catégorie, format et tri

        // Définition variables requete charger plus
        $currentpage = intval( $_POST['currentpage'] );
        $posts_per_page = 8;

        // Définition variable requete avec filtre catégorie, format, ordre de tri
        $categ = sanitize_text_field( $_POST['postcateg'] );
        $format = sanitize_text_field( $_POST['postformat'] );
        $order = sanitize_text_field( $_POST['postorder'] );
            if($order==='à partir des plus anciennes'){
                $order = 'ASC';
            }
            if($order==='à partir des plus récentes'){
                $order = 'DESC';
            }

        // Construction de la requete
        // Si filtre appliqué : ordre de tri par date
        if ($order != undefined && $order != "TRIER PAR") {
            $args = array(
                'post_type' => 'photos', // Custom Post type
                'posts_per_page' => $posts_per_page, // Nombre de photos par page
                'order' => $order, // Ordre ASCendant ou DESCendant
                'orderby' => 'date', // Ordre par date
                'paged' => $currentpage,
                );
        }
        else {
        // Si aucun filtre ordre date
            $args = array(
                'post_type' => 'photos', // Custom Post type
                'posts_per_page' => $posts_per_page, // Nombre de photos par page
                'order' => 'DESC', // Ordre ASCendant ou DESCendant
                'orderby' => 'date', // Ordre par date
                'paged' => $currentpage,
                );
            }

            // Si filtre appliqué : Catégorie seulement
            if ($categ != undefined && $categ != "CATÉGORIES" && $format === "FORMATS") {
                $args['tax_query'] = array(
                      array(
                        'taxonomy' => 'categorie',
                        'field' => 'slug',
                        'terms' => $categ, // Utiliser la catégorie sélectionnée
                      ),
                );
            }

            // Si filtre appliqué : Format seulement
            if ($format != undefined && $format != "FORMATS" && $categ === "CATÉGORIES") {
                $args['tax_query'] = array(
                        array(
                        'taxonomy' => 'format',
                        'field' => 'slug',
                        'terms' => $format, // Utiliser la catégorie sélectionnée
                        ),
                );
            }

            // Si filtres appliqués : Catégorie + Format
            if ($categ != undefined && $format != undefined && $categ != "CATÉGORIES" && $format != "FORMATS") {
                $args['tax_query'] = array(
                    'relation' => 'AND',
                      array(
                        'taxonomy' => 'categorie',
                        'field' => 'slug',
                        'terms' => $categ, // Utiliser la catégorie sélectionnée
                      ),
                      array(
                        'taxonomy' => 'format',
                        'field' => 'slug',
                        'terms' => $format, // Utiliser le format sélectionnée
                      ),
                );
            
            }

        $wp_query = new WP_Query( $args );
        
        // Définir le nombre de page maximum
        $max_page = ($wp_query->max_num_pages);
        
        // Préparer le HTML des photos
        ob_start();
        if($wp_query->have_posts()) :
            echo '<div class="photos-cards">';
            while($wp_query->have_posts()) : $wp_query->the_post();
                $reponse .= get_template_part( 'template-parts/photo_block', 'none' );
            endwhile;
            echo '</div>';
        endif;
        $html = ob_get_clean();

        wp_reset_postdata();

  	// Envoyer les données au navigateur
      $result = [
        'max' => $max_page,
        'html' => $html,
    ];
    wp_send_json_success( $result );
    
}