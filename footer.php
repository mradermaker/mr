<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package mr
 */

?>

	<footer class="c-footer">
		<nav id="footer-nav" class="c-footer__nav c-footer-nav" aria-label="<?php echo esc_html_e('Footer-Navigation', 'mr',); ?>" role="navigation">
			<?php wp_nav_menu([
				'theme_location'	=> 'footer-nav',
				'menu_class'		=> 'c-footer-nav__list',
				'container'			=> false,
				'before'			=> '',
				'after'				=> '',
				'link_before'		=> '',
				'link_after'		=> '',
				'items_wrap'		=>'<ul id="%1$s" class="%2$s" role="menu">%3$s</ul>',
				'walker'			=> '',
			]); ?>
		</nav>
	</footer>

<?php wp_footer(); ?>

</body>
</html>
