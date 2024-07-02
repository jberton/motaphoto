<!-- Exécuter la WP Query avec les arguments pour définir ce qu'on récupère -->
<?php 

// Récupérer les variables (catégorie et post id) passées dans get_template_part
$categ = $args['categorie'];
$idpost = $args['postid'];

$listephoto = new WP_Query(array(
    'post_type' => 'photos', // Custom Post type
    'posts_per_page' => 2, // Nombre de photos par page
    'order' => 'DESC', // Ordre ASCendant ou DESCendant
    'orderby' => 'date', // Ordre par date
    'post__not_in' => array($idpost), // Exclure la photo principale pour éviter doublon
    'tax_query' => array(
        array (
            'taxonomy' => 'categorie',
            'field' => 'slug',
            'terms' => $categ, // Utiliser la catégorie de la photo principale
        )
        ), 
));
?>

<?php if($listephoto->have_posts()) : ?>
    <div class="photos-cards">
        <?php while($listephoto->have_posts()) : $listephoto->the_post(); ?>
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                <img src="<?php the_field('fichier'); ?>"/>
            </a>
        <?php endwhile; ?>
    </div>
<?php endif; ?>