<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package mr
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class('o-body'); ?>>
	<?php wp_body_open(); ?>
	<a class="c-skip-link u-screen-reader-only" href="#main"><?php esc_html_e( 'Zum Inhalt springen', 'mr' ); ?></a>

	<header class="c-header">
		<div class="c-header__logo"></div>

		<nav id="main-nav" class="o-container c-header__nav c-main-nav" aria-label="<?php echo esc_html_e('Haupt-Navigation', 'mr',); ?>" role="navigation">
			<button class="c-main-nav__button c-icon-button" aria-controls="main-nav" aria-expanded="false"><?php esc_html_e( 'Hauptmenü öffnen', 'mr' ); ?></button>
				<?php wp_nav_menu([
					'theme_location'	=> 'main-nav',
					'menu_class'		=> 'c-main-nav__list',
					'container'			=> false,
					'before'			=> '',
					'after'				=> '',
					'link_before'		=> '',
					'link_after'		=> '',
					'items_wrap'		=>'<ul id="%1$s" class="%2$s" role="menu">%3$s</ul>',
					'walker'			=> '',
				]); ?>
		</nav>
	</header>
