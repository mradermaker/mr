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
    <a class="c-skip-link u-screen-reader-only" href="#menu-haupt">Zum Navigation wechseln</a>
	<a class="c-skip-link u-screen-reader-only" href="#main">Zum Inhalt wechseln</a>
    <a class="c-skip-link u-screen-reader-only" href="#footer">Zum Footer wechseln</a>

	<?php if (!is_page_template( 'page-login.php' ) ) { ?>
		<header class="c-header">
			<div class="c-header__container o-container">
            	<div class="c-header__row o-row">
                	<div class="c-header__content o-col-12">
						<div class="c-header__logo u-position-relative">
                            <a class="c-header__logo-link" href="<?php echo esc_url(home_url('/')); ?>"><span class="c-header__logo-text">MR</span></a>
                            <div class="c-handwritten --logo">
                                <?php get_icon('handwritten-arrow-straight-short', true, ['class' => 'c-handwritten__icon',]); ?>
                                <span class="c-handwritten__text">Logo <span class="u-screen-reader-only">(Platzhalter)</span></span>
                            </div>
                        </div>

                        <nav id="main-nav" class="c-header__nav c-main-nav" aria-label="Haupt-Navigation">
                            <button class="c-main-nav__button c-icon-button" aria-controls="menu-haupt" aria-expanded="false">
                                <?php echo get_icon('menu', true, ['class' => 'c-main-nav__button-icon c-icon-button__icon --open']); ?>
                                <?php echo get_icon('close', true, ['class' => 'c-main-nav__button-icon c-icon-button__icon --close']); ?>
                                <span class="c-main-nav__button-label c-icon-button__text u-screen-reader-only" data-open-text="Hauptmenü öffnen" data-close-text="Hauptmenü schließen">Hauptmenü öffnen</span>
                            </button>
                            <?php wp_nav_menu([
                                'theme_location'	=> 'main-nav',
                                'menu_class'		=> 'c-main-nav__list',
                                'container'			=> false,
                                'before'			=> '',
                                'after'				=> '',
                                'link_before'		=> '',
                                'link_after'		=> '',
                                'items_wrap'		=>'<ul id="%1$s" class="%2$s" role="menubar">%3$s</ul>',
                                'walker'			=> '',
                            ]); ?>
                        </nav>
                    </div>
                </div>
            </div>
		</header>
	<?php } ?>
