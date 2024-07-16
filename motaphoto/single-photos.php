<?php get_header(); ?>
<div class="page-container">

	<?php 
	// Boucle principale de WordPress
	if (have_posts()) : 
		while (have_posts()) : the_post(); 
		
		// Obtenir l'ID du post sélectionné
			$current_id = get_the_ID();
		// Obtenir l'ID du post précédent
			$previous_post = get_previous_post();
			$previous_id = $previous_post->ID;
			// Si pas de post avant le premier alors prendre le dernier
			if (is_null($previous_id)){
				$connected = new WP_Query( array(
					// Arguments
					'post_type' => 'photos', // Custom Post type
					'orderby'  => 'date',
					'order' => 'DESC',
					));
				$previous_id = $connected->posts[0]->ID;
			}
		// Obtenir l'ID du post suivant
			$next_post = get_next_post();
			$next_id = $next_post->ID;
			// Si pas de post après le dernier alors prendre le premier
			if (is_null($next_id)){
				$connected = new WP_Query( array(
					// Arguments
					'post_type' => 'photos', // Custom Post type
					'orderby'  => 'date',
					'order' => 'ASC',
					));
				$next_id = $connected->posts[0]->ID;
			}
		// Définir tableau avec 3 photos pour la navigation
			$projectIDs = array( $next_id, $current_id, $previous_id );
		?>
			<div class="post-single">
				<!--  Informations sur la photo active -->
				<div class="post-info">
					<h1><?php the_title(); ?></h1>
					<p>RÉFÉRENCE : <span id="ref-photo"><?php the_field('reference'); ?></span></p>
					<p>CATÉGORIE : <?php
						$categ = get_the_terms( get_the_ID(), 'categorie' );
						$categ = join(', ', wp_list_pluck( $categ , 'name') );
						echo $categ;
						?>
					</p>
					<p>FORMAT : <?php 
						$format = get_the_terms( get_the_ID(), 'format' );
						$format = join(', ', wp_list_pluck( $format , 'name') );
						echo $format; ?>
					</p>
					<p>TYPE : <?php the_field('type'); ?></p>
					<p>ANNÉE : <?php echo get_the_date('Y');?></p>
				</div>
				<!--  Photos précédente, active, suivante -->
				<div class="post-photo">
					<?php echo(get_the_post_thumbnail()); ?>
				</div>
			</div>


			<div class="bloc-dessous">
				<!--  Lien de contact sur la photo active -->
				<div class="lien-contact">
					<p>Cette photo vous intéresse ?</p>
					<button id="contact-ref" type="button">Contact</button>
				</div>
				
				<!--  Liens pour naviguer parmi les photos -->
				<div class="lien-navigation">
					<?php 
						// Boucle pour une WP Query sur mesure
						$args = array(
							'post_type' => 'photos', // Custom Post type
							'orderby'  => 'date',
							'order' => 'DESC',
							'post__in' => $projectIDs,
						);
						$my_query = new WP_Query($args);
						if( $my_query->have_posts() ) :
								$my_query->the_post();
								?>
								<img id="img-1" src="<?php echo get_the_post_thumbnail_url( $next_id, 'thumbnail' ); ?>">
								<img id="img-2" src="<?php echo get_the_post_thumbnail_url( $current_id, 'thumbnail' ); ?>">
								<img id="img-3" src="<?php echo get_the_post_thumbnail_url( $previous_id, 'thumbnail' ); ?>">
						<?php endif ?>

					<div class="fleche">
						<a href="<?php echo(get_permalink( $next_id )); ?>" class="flecheGauche" onmouseover="changeleft()" onmouseout="changeBack()"><img src="<?= get_stylesheet_directory_uri() . "/assets/images/fleche-gauche.png" ?>" alt="flèche gauche navigation"></a>
						<a href="<?php echo(get_permalink( $previous_id )); ?>" class="flecheDroite" onmouseover="changeright()" onmouseout="changeBack()"><img src="<?= get_stylesheet_directory_uri() . "/assets/images/fleche-droite.png" ?>" alt="flèche droite navigation"></a>
					</div>
				</div>
			</div>

		<!-- Zone de photos apparentées -->
		<div class="photos-liste-title">
			<p>VOUS AIMEREZ AUSSI</p>
		</div>

		<!-- Exécuter la WP Query avec les arguments pour définir ce qu'on récupère -->
		<?php 
		$listephoto = new WP_Query(array(
			'post_type' => 'photos', // Custom Post type
			'posts_per_page' => 2, // Nombre de photos par page
			'order' => 'DESC', // Ordre ASCendant ou DESCendant
			'orderby' => 'date', // Ordre par date
			'post__not_in' => array($current_id), // Exclure la photo principale pour éviter doublon
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
						<!-- Bloc d’affichage d’une photo de la liste -->
						<?php get_template_part( 'template-parts/photo_block', 'none' );?>
					<?php endwhile; ?>
				</div>
			<?php endif; ?>

		<?php endwhile; ?>
	<?php endif; ?>

	<!--  Réinitialiser à la requête principale -->
	<?php wp_reset_postdata(); ?>

</div>
<?php get_footer(); ?>