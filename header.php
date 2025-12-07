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

$hide_header_pages = array(MR_IMPRINT_ID, MR_DATA_PROTECTION_ID);
$hide_header = is_page(MR_LOGIN_ID) || ( is_page($hide_header_pages) && !is_user_logged_in() );
?>

<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

    <link rel="icon" href="/favicon.ico" sizes="any">

    <link rel="icon" type="image/svg+xml" href="/favicon-light.svg" media="(prefers-color-scheme: light)">
    <link rel="icon" type="image/svg+xml" href="/favicon-dark.svg"  media="(prefers-color-scheme: dark)">

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">

    <link rel="icon" type="image/png" sizes="192x192" href="/web-app-manifest-192x192.png">
    <link rel="icon" type="image/png" sizes="512x512" href="/web-app-manifest-512x512.png">

    <link rel="manifest" href="/site.webmanifest">

    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#111111">

	<?php wp_head(); ?>
</head>

<body <?php body_class('o-body'); ?>>
    <?php if (!$hide_header) { ?>
        <a class="c-skip-link u-screen-reader-only" href="#menu-haupt">Zur Navigation</a>
    <?php } ?>
	<a class="c-skip-link u-screen-reader-only" href="#main">Zum Inhalt</a>
    <a class="c-skip-link u-screen-reader-only" href="#footer">Zum Footer</a>

    <?php wp_body_open(); ?>

	<?php if (!$hide_header) { ?>
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
                                'items_wrap'		=>'<ul id="%1$s" class="%2$s">%3$s</ul>',
                                'walker'			=> '',
                            ]); ?>
                        </nav>
                    </div>
                </div>
            </div>
		</header>
	<?php } ?>
