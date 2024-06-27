<!-- Afficher le header -->
<?php get_header(); ?>

    <!-- Hero header page d'accueil -->
    <div class="hero-header">
        <img src="<?= get_stylesheet_directory_uri() . "/assets/images/nathalie-11.jpeg" ?>" alt="Photographe Event Nathalie Mota">
        <span><img src="<?= get_stylesheet_directory_uri() . "/assets/images/Titre header.png" ?>" alt="Photographe Event Titre"></span>
    </div>

    <!-- Contenu de la page d'accueil -->
    <div class="home-container">

        <!-- Zone de filtres -->
        <div class="home-filter">
            <div class="select-wrapper">
                <select name="categorie" id="categorie-select">
                    <option value="" disabled selected>CATÉGORIES</option>
                    <option value="reception">Réception</option>
                    <option value="concert">Concert</option>
                    <option value="mariage">Mariage</option>
                    <option value="television">Télévision</option>
                </select>
            </div>
            <div class="select-wrapper select-wrapper-format">
                <select name="format" id="format-select">
                    <option value="" disabled selected>FORMATS</option>
                    <option value="paysage">Paysage</option>
                    <option value="portrait">Portrait</option>
                </select>
            </div>
            <div class="select-wrapper">
                <select name="trier" id="trier-select">
                    <option value="" disabled selected>TRIER PAR</option>
                    <option value="recente">Les + récentes</option>
                    <option value="ancienne">Les + anciennes</option>
                </select>
            </div>
        </div>

        <div class="home-photos">

            <!-- Exécuter la WP Query avec les arguments pour définir ce qu'on récupère -->
            <?php $fiche = new WP_Query(array(
            'post_type' => 'photos', // Custom Post type
            'posts_per_page' => 8, // Nombre de photos par page
            'order' => 'DESC', // Ordre ASCendant ou DESCendant
            'orderby' => 'date' // Ordre par date
            ));?>

            
            <!-- Lancer la boucle pour afficher le contenu -->
            <?php if($fiche->have_posts()) : ?>
                <ul>
                <?php while($fiche->have_posts()) : $fiche->the_post(); ?>
                <li class="home-photos">
                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                            <img src="<?php the_field('fichier'); ?>"/>
                        </a>
                </li>
                <?php endwhile; ?>
                </ul>
            <?php endif; ?>
        
        </div>

        <!--  Réinitialiser à la requête principale -->
        <?php wp_reset_postdata(); ?>

    </div>

<!-- Afficher le footer -->
<?php get_footer(); ?>