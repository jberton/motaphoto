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
		// Obtenir l'ID du post suivant
			$next_post = get_next_post();
			$next_id = $next_post->ID;
		// Définir tableau avec 3 photos pour la navigation
			$projectIDs = array( $previous_id, $current_id, $next_id );

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
					<img src="<?php the_field('fichier'); ?>"/>
				</div>
			</div>


			<div class="bloc-dessous">
				<!--  Lien de contact sur la photo active -->
				<div class="lien-contact">
					<p>Cette photo vous intéresse ?</p>
					<button type="button">Contact</button>
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
						$x = 0;
						$my_query = new WP_Query($args);
						
						if( $my_query->have_posts() ) :
							while( $my_query->have_posts() ) :
								$my_query->the_post();
								$x ++;
								?>
								<img id="img-<?php echo($x); ?>" src="<?php the_field('fichier'); ?>" alt="lien photo">
							<?php endwhile; ?>
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

		<!-- Afficher le contenu des photos apparentées -->
		<?php get_template_part('template-parts/photo_block','my-template',array(
				'categorie' => $categ, // passing this array possible since WP 5.5
				'postid' => $current_id,
				));
		?>

		<?php endwhile; ?>
	<?php endif; ?>

	<!--  Réinitialiser à la requête principale -->
	<?php wp_reset_postdata(); ?>

</div>
<?php get_footer(); ?>