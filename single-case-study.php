<?php
/**
 * Template Name: Case Study
 * Template Post Type: post
 */

get_header();
?>

    <main id="main" class="o-main">

        <?php
        while ( have_posts() ) :
            the_post();

            get_template_part( 'template-parts/content', 'single-case-study' );
        endwhile;
        ?>
    </main>

<?php
get_footer();