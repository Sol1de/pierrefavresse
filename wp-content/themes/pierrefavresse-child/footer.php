<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package pierrefavresse
 */

?>

	<footer id="colophon" class="footer">
		<!-- menu -->
		<img class='footer-logo' src="http://pierrefavresse.test/pierre-favresse/" alt="Logo-footer">

		<!-- navigation -->
		<div class="footer-container">
			<p class="footer-container-paragraph">Copyright © 2025 Agence Pierre Favresse | Tout droits réservés</p>
			<?php wp_nav_menu([
				'theme_location' => 'footer',
				'container' => 'nav',
				'container_class' => 'footer-container-nav',
				'menu_class' => false,
				'before' => '<span class="separator">|</span>',
			]) ?>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>