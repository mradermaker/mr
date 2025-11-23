<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package mr
 */

get_header();
?>

	<main id="main" class="o-main">
		<section class="c-text">
			<div class="c-text__container o-section o-container">
				<div class="c-text__row o-row">
					<div class="c-text__content o-col-12 o-col-xl-8">
						<p class="c-text__subheadline c-subheadline">Seite nicht gefunden</p>
						<h1 class="c-text__headline c-headline">Fehler 404</h1>
						<p class="c-text__text c-wysiwyg">Diese Seite kann nicht gefunden werden. Es scheint als hätten Sie einen nicht mehr aktuellen Link aufgerufen.</p>
						<a class="c-text__button c-button" href="<?php echo esc_url(home_url('/')); ?>">Zum Portfolio</a>
					</div>
				</div>
			</div>
		</section>
	</main>

<?php
get_footer();
