<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
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
                    <h1 class="c-portfolio__headline c-headline">Einblicke in meine Projekte.</h1>
                    <p class="c-portfolio__text c-wysiwyg">Ausgewählte Arbeiten von Design bis Frontend.</p>
                </div>
            </div>
            
            <?php
            $args = array(
                'post_type'      => 'post',
                'posts_per_page' => -1,
                'tag__not_in' => array(8),
            );
            $blog_query = new WP_Query( $args );

            if ($blog_query->have_posts() ) :

                $categories = get_categories();
                $default_cat_id = (int) get_option('default_category');
                $total_posts = (int) $blog_query->found_posts;
                ?>

                <div class="c-portfolio__navigation">
                    <?php if (!empty($categories) && is_array($categories)) { ?>
                        <ul class="c-portfolio__categories c-button-group --full-width --position-center" aria-label="Portfolio filtern">
                            <?php foreach ($categories as $category) {
                                $cat_slug = esc_attr( $category->slug ?? '' );
                                $cat_name = esc_html( $category->name ?? '' );
                                $is_active = ($category->term_id === $default_cat_id) ? '' : '--ghost';
                                $is_pressed = ($category->term_id === $default_cat_id) ? 'true' : 'false';
        

                                if ($cat_slug && $cat_name) {
                                    printf(
                                        '<li class="c-button-group__list-item"><button class="c-button-group__item c-button %1$s" aria-pressed="%2$s" aria-controls="portfolio-grid" data-category="%3$s">%4$s</button></li>',
                                        esc_attr($is_active),
                                        esc_attr($is_pressed),
                                        $cat_slug,
                                        $cat_name
                                    );
                                }
                            } ?>
                        </ul>
                    <?php } ?>
                    
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
