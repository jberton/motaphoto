<div class=line-top-footer></div>
		<footer>
			<!-- menu footer -->
			<?php
				$defaults = array(
				'theme_location' => 'footer-menu', 
				'container' => '', 
				'menu_class' => 'my-footer-menu', 
				'menu' => 'footer'
				);
				wp_nav_menu($defaults);

			?>
			<p>TOUS DROITS RÉSERVÉS</p>
		</footer>
		<?php wp_footer(); ?>
	</body>
</html>