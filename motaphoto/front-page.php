<!-- Afficher le header -->
<?php get_header(); ?>

    <!-- Hero header page d'accueil -->
    <div class="hero-header">
        <?php echo do_shortcode( '[random-photo]' ); ?>
        <h1>PHOTOGRAPHE EVENT</h1>
    </div>

    <!-- Contenu de la page d'accueil -->
    <div class="page-container">

        <!-- Zone de filtres -->
        <div class="filters-container">

            <!-- Exécuter la WP Query pour récupérer les valeurs des listes déroulantes -->
            <?php $allphotos = new WP_Query(array(
                'post_type' => 'photos', // Custom Post type
                'posts_per_page'   => -1, // pour avoir tous les enregistrements
            ));?>

            <!-- Lancer la boucle pour enregistrer les catégories et les formats dans un tableau -->
            <?php if($allphotos->have_posts()) : ?>
                <?php while($allphotos->have_posts()) : $allphotos->the_post(); ?>
                    <?php 
                        $categ = get_the_terms( get_the_ID(), 'categorie' );
                        $categ = join(', ', wp_list_pluck( $categ , 'name') );
                        $tableauCateg[] = $categ; // Incrémenter le tableau des catégories
                        $format = get_the_terms( get_the_ID(), 'format' );
						$format = join(', ', wp_list_pluck( $format , 'name') );
                        $tableauFormat[] = $format; // Incrémenter le tableau des formats
                    ?>
                <?php endwhile; ?>
            <?php endif; ?>

            <!--  Réinitialiser à la requête principale -->
            <?php wp_reset_postdata(); ?>

            <?php 
            // Supprimer les doublons dans les tableaux
            $arrayCateg = array_unique($tableauCateg);
            $arrayFormat = array_unique($tableauFormat);
            ?>

            <div class="menu-deroulant">
                <button id="menu-d-1"><span id="btncat">CATÉGORIES</span>
                    <a><img id="menu-f-1" class="flechebas" src="<?= get_stylesheet_directory_uri() . "/assets/images/icon-fleche.png" ?>"></a>
                </button>
                <ul id="menu-class-1" class="hide">
                    <a href="#" class="clicmenu1">
                        <li
                            data-id="CATÉGORIES" 
                            data-postid="<?php echo get_the_ID(); ?>"
                            data-nonce="<?php echo wp_create_nonce('load_photos'); ?>"
                            data-action="load_photos"
                            data-ajaxurl="<?php echo admin_url( 'admin-ajax.php' ); ?>">
                            &ensp;
                        </li>
                    </a>
                    <?php foreach($arrayCateg as $value) { ?>
                        <a href="#" class="clicmenu1" data-value="<?php echo $value ?>"> 
                            <li 
                                data-id="<?php echo $value ?>" 
                                data-postid="<?php echo get_the_ID(); ?>"
                                data-nonce="<?php echo wp_create_nonce('load_photos'); ?>"
                                data-action="load_photos"
                                data-ajaxurl="<?php echo admin_url( 'admin-ajax.php' ); ?>">
                                <?php echo $value ?>
                            </li>
                        </a>
                    <?php } ?>
                </ul>
            </div>
            <div class="menu-deroulant">
                <button id="menu-d-2"><span id="btnform">FORMATS</span>
                    <a><img id="menu-f-2" class="flechebas" src="<?= get_stylesheet_directory_uri() . "/assets/images/icon-fleche.png" ?>"></a>
                </button>
                <ul id="menu-class-2" class="hide">
                    <a href="#" class="clicmenu2">
                        <li
                            data-id="FORMATS" 
                            data-postid="<?php echo get_the_ID(); ?>"
                            data-nonce="<?php echo wp_create_nonce('load_photos'); ?>"
                            data-action="load_photos"
                            data-ajaxurl="<?php echo admin_url( 'admin-ajax.php' ); ?>">
                            &ensp;
                        </li>
                    </a>
                    <?php foreach($arrayFormat as $value) { ?>
                        <a href="#" class="clicmenu2" data-value="<?php echo $value ?>"> 
                            <li 
                                data-id="<?php echo $value ?>" 
                                data-postid="<?php echo get_the_ID(); ?>"
                                data-nonce="<?php echo wp_create_nonce('load_photos'); ?>"
                                data-action="load_photos"
                                data-ajaxurl="<?php echo admin_url( 'admin-ajax.php' ); ?>">
                                <?php echo $value ?>
                            </li>
                        </a>
                        <?php } ?>
                </ul>
            </div>
            <div class="menu-deroulant">
                <button id="menu-d-3"><span id="btntri">TRIER PAR</span>
                    <a><img id="menu-f-3" class="flechebas" src="<?= get_stylesheet_directory_uri() . "/assets/images/icon-fleche.png" ?>"></a>
                </button>
                <ul id="menu-class-3" class="hide">
                    <a href="#" class="clicmenu3">
                        <li
                            data-id="TRIER PAR" 
                            data-postid="<?php echo get_the_ID(); ?>"
                            data-nonce="<?php echo wp_create_nonce('load_photos'); ?>"
                            data-action="load_photos"
                            data-ajaxurl="<?php echo admin_url( 'admin-ajax.php' ); ?>">
                            &ensp;
                        </li>
                    </a>
                    <a href="#" class="clicmenu3" data-value="à partir des plus récentes">
                        <li
                            data-id="DESC" 
                            data-postid="<?php echo get_the_ID(); ?>"
                            data-nonce="<?php echo wp_create_nonce('load_photos'); ?>"
                            data-action="load_photos"
                            data-ajaxurl="<?php echo admin_url( 'admin-ajax.php' ); ?>">
                            à partir des plus récentes
                        </li>
                    </a>
                    <a href="#" class="clicmenu3" data-value="à partir des plus anciennes">
                        <li
                            data-id="ASC" 
                            data-postid="<?php echo get_the_ID(); ?>"
                            data-nonce="<?php echo wp_create_nonce('load_photos'); ?>"
                            data-action="load_photos"
                            data-ajaxurl="<?php echo admin_url( 'admin-ajax.php' ); ?>">
                            à partir des plus anciennes
                        </li>
                    </a>
                </ul>
            </div>
        </div>

        <div class="home-photos">
            <!-- Exécuter la WP Query avec les arguments pour définir ce qu'on récupère -->
            <?php 
            $paged = 1; 
            $listephoto = new WP_Query(array(
                'post_type' => 'photos', // Custom Post type
                'posts_per_page' => 8, // Nombre de photos par page
                'order' => 'DESC', // Ordre ASCendant ou DESCendant
                'orderby' => 'date', // Ordre par date
                'paged' => $paged, // Current page
                ));
            ?>
                <?php if($listephoto->have_posts()) : ?>
                    <div class="photos-cards">
                        <?php while($listephoto->have_posts()) : $listephoto->the_post(); ?>
                            <!-- Bloc d’affichage d’une photo de la liste -->
                            <?php get_template_part( 'template-parts/photo_block', 'none' );?>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>      

            <!--  Pagination infinie en Ajax  -->
            <?php
            global $wp_query;
                $my_page = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $max_page = ($listephoto->max_num_pages);
                //var_dump($my_page); // Current page                      
                //var_dump($max_page); // Max page
            ?>

        </div>

        <button
                class="js-load-photos"
                data-postid="<?php echo get_the_ID(); ?>"
                data-currentpage= "<?php echo $my_page; ?>"
                data-maxpage= "<?php echo $max_page ?>"
                data-nonce="<?php echo wp_create_nonce('load_photos'); ?>"
                data-action="load_photos"
                data-ajaxurl="<?php echo admin_url( 'admin-ajax.php' ); ?>"
            >
            Charger plus
        </button>
        
    </div>

<!-- Afficher le footer -->
<?php get_footer(); ?>