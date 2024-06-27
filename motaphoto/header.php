<!doctype html>
<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title>Motaphoto</title>
		<?php wp_head(); ?>
	</head>
	<body>
	<header>

		<nav id="navbar">
			<!-- image logo -->
			<div class="logo">
				<a href="<?= get_site_url() ?>">
					<img src="<?= get_stylesheet_directory_uri() . "/assets/images/logo-nathalie-mota.png" ?>" alt="Logo Nathalie Mota Photographe">
				</a>
			</div>
			<!-- menu principal -->
			<?php
				$defaults = array(
				'theme_location' => 'top', 
				'container' => '', 
				'menu_class' => 'nav navbar-nav menu__list', 
				'menu' => 'main-menu'
				);
				wp_nav_menu($defaults);
			?>
			<!-- menu burger -->
			<div class="burger" aria-expanded="false">
				<div class="line line1"></div>
				<div class="line line2"></div>
				<div class="line line3"></div>
			</div>
		</nav>

		<!-- popup contact -->
		<?php get_template_part( 'template-parts/contact', 'none' );?>
	</header>
