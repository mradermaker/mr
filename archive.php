<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package mr
 */

get_header();
?>

	<main id="main" class="o-main">

		<section class="c-portfolio o-section o-container">
            <div class="c-portfolio__row o-row --position-center">
                <div class="c-portfolio__content o-col-12 o-col-xl-8">
                    <p class="c-portfolio__subheadline c-subheadline">Portfolio</p>
                    <h1 class="c-portfolio__headline c-headline"><?php echo get_the_archive_title(); ?></h1>
                </div>
            </div>
            
            <?php
			$category = get_queried_object();
            $args = array(
                'post_type'      => 'post',
                'posts_per_page' => -1,
                'tag__not_in' => array(8),
				'tax_query'      => array(
					array(
						'taxonomy' => 'category',
						'field'    => 'term_id',
						'terms'    => $category->term_id,
					),
				),
            );
            $blog_query = new WP_Query( $args );

            if ($blog_query->have_posts() ) :
                $total_posts = (int) $blog_query->found_posts;
                ?>

                <div class="c-portfolio__navigation">
                    <?php printf(
                    '<p class="c-portfolio__status u-screen-reader-only" aria-live="polite">%s</p>',
                    sprintf(
                        _n('%s Eintrag angezeigt', '%s Einträge angezeigt', $total_posts),
                        $total_posts
                    )
                    );?>
                </div>
                
                <div id="portfolio-grid" class="c-portfolio__cards o-row --position-center" role="list">
                    <?php
                        while ( $blog_query->have_posts() ) : $blog_query->the_post();
                            get_template_part( 'template-parts/content', get_post_type(), ['role' => 'listitem'] );
                        endwhile;
                    ?>
                </div>
                <?php
                wp_reset_postdata();
            endif;
            ?>
        </section>

	</main>

<?php
get_footer();
