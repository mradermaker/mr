<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package mr
 */

get_header();
?>

	<main id="main" class="o-main">

		<section class="c-search o-section o-container">
			<div class="c-search__row o-row">
				<div class="c-search__content o-col-12 o-col-xl-8">
					<h1 class="c-search__headline c-headline">Suchergebnisse für: <?php echo esc_html(get_search_query());?></h1>
				</div>
			</div>
           
			<div class="c-search__results">
				<?php
				while ( have_posts() ) :
					the_post();

					get_template_part( 'template-parts/content', 'search' );
				endwhile;
				?>
			</div>
		

		</section>

	</main>

<?php
get_footer();
