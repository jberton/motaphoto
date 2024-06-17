<!doctype html>
<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title>Motaphoto</title>
		<link rel="stylesheet" id="theme-style" href="http://localhost/motaphoto/wp-content/themes/motaphoto/style.css?ver=1.0.0" media="all">
	</head>
	<body>
	<header>
		<img src="<?= get_stylesheet_directory_uri() . "/assets/images/logo-nathalie-mota.png" ?>" alt="Logo Nathalie Mota Photographe">
		
		<?php
            $defaults = array(
              'theme_location' => 'top', 
              'container' => '', 
              'menu_class' => 'nav navbar-nav menu__list', 
              'menu' => 'main-menu'
            );
            wp_nav_menu($defaults);
		?> 
	</header>
