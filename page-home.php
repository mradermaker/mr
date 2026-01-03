<?php
/**
 * Template Name: Startseite
 */

get_header();
?>

<main id="main" class="o-main">

    <section class="c-hero">
        <div class="c-hero__container o-container">
            <div class="c-hero__row o-row">
                <div class="c-hero__content o-col-12 o-col-xl-6">
                    <h1 class="c-hero__headline c-headline">Hallo! Ich bin Monika, Frontend Developer & Designerin.</h1>
                    <p class="c-hero__text c-wysiwyg">Ich bin eine Frontend-Entwicklerin und Designerin aus Aachen. Meine Stärken liegen in der Gestaltung und Umsetzung von Websites, Corporate Design und vielem mehr.</p>
                    <div class="c-hero__button-group c-button-group">
                        <a class="c-hero__button c-button" role="button" href="/portfolio">Projekte ansehen</a>
                        <div class="c-hero__button-wrapper u-position-relative">
                            <a class="c-hero__button c-button --ghost" role="button" href="mailto:<?php echo antispambot('hallo@monika-radermaker.de'); ?>">Kontakt aufnehmen</a>
                            <div class="c-handwritten --hero">
                                <?php get_icon('handwritten-arrow-top', true, ['class' => 'c-handwritten__icon',]); ?>
                                <span class="c-handwritten__text">E-Mail Programm öffnet sich</span>
                            </div>
                        </div>
                    </div>
                </div>
                <figure class="c-hero__image c-figure">
                    <div class="c-figure__placeholder" aria-hidden="true">
                        <?php get_icon('placeholder', true, ['class' => 'c-figure__icon --image',]); ?>
                    </div>
                </figure>
            </div>
        </div>
    </section>

    <section class="c-skills-teaser o-section o-container">
        <div class="c-skills-teaser__row o-row --position-center">
            <div class="c-skills-teaser__content o-col-12 o-col-md-7">
                <p class="c-skills-teaser__subheadline c-subheadline">Über mich</p>
                <h2 class="c-skills-teaser__headline c-headline">Von Pixeln bis Performance: Design trifft auf sauberen Code.</h2>
                <p class="c-skills-teaser__text c-wysiwyg">Ich entwickle Websites mit klarer Struktur, durchdachtem Design und sauberer Umsetzung: zugänglich, performant und mit Blick fürs Detail.</p>
                <a class="c-skills-teaser__button c-button" role="button" href="/ueber-mich">Mehr über mich</a>
            </div>

            <div class="c-skills-teaser__cards o-col-12 o-col-md-5">
                <div class="c-skill-teaser-card">
                    <div class="c-skill-teaser-card__header">
                        <?php get_icon('code', true, ['class' => 'c-skill-teaser-card__icon']); ?>
                        <h3 class="c-skill-teaser-card__headline c-headline">Code & Umsetzung</h3>
                    </div>
                    <p class="c-skill-teaser-card__content c-wysiwyg">WordPress mit eigenen Themes und ACF, HTML/SCSS, JavaScript und PHP. Strukturierter Code mit BEM/ITCSS, responsive und performanceorientiert umgesetzt.</p>
                </div>

                <div class="c-skill-teaser-card">
                    <div class="c-skill-teaser-card__header">
                        <?php get_icon('design', true, ['class' => 'c-skill-teaser-card__icon']); ?>
                        <h3 class="c-skill-teaser-card__headline c-headline">Design & Gestaltung</h3>
                    </div>
                    <p class="c-skill-teaser-card__content c-wysiwyg">Bachelor in Design mit Erfahrung in Screendesigns, Corporate Design und Print. Gestaltung und Prototyping mit Adobe Creative Cloud und Axure.</p>
                </div>

                <div class="c-skill-teaser-card">
                    <div class="c-skill-teaser-card__header">
                        <?php get_icon('accessibility', true, ['class' => 'c-skill-teaser-card__icon']); ?>
                        <h3 class="c-skill-teaser-card__headline c-headline">Barrierefreiheit</h3>
                    </div>
                    <p class="c-skill-teaser-card__content c-wysiwyg">BFSG- und WCAG-konforme Umsetzung mit semantischem HTML, Unterstützung für assistive Technologien und sinnvollen ARIA-Attributen.</p>
                </div>

                <div class="c-skill-teaser-card">
                    <div class="c-skill-teaser-card__header">
                        <?php get_icon('learning', true, ['class' => 'c-skill-teaser-card__icon']); ?>
                        <h3 class="c-skill-teaser-card__headline c-headline">Arbeitsweise & Soft Skills</h3>
                    </div>
                    <p class="c-skill-teaser-card__content c-wysiwyg">Git, DevTools, Testing/QA. Strukturiert, eigenständig, qualitätsorientiert und teamfähig.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="c-portfolio o-section o-container">
        <div class="c-portfolio__row o-row --position-center">
            <div class="c-portfolio__content o-col-12 o-col-xl-8">
                <p class="c-portfolio__subheadline c-subheadline">Portfolio</p>
                <h2 class="c-portfolio__headline c-headline">Einblicke in meine Projekte.</h2>
                <p class="c-portfolio__text c-wysiwyg">Ausgewählte Arbeiten von Design bis Frontend.</p>
            </div>
        </div>
        

            <?php
            if (!is_user_logged_in()) {
                $args = array(
                    'post_type'      => 'post',
                    'posts_per_page' => -1,
                    'tax_query' => array(
                        'relation' => 'AND',
                        array(
                            'taxonomy' => 'post_tag',
                            'field'    => 'term_id',
                            'terms'    => array(8),
                        ),
                        array(
                            'taxonomy' => 'post_tag',
                            'field'    => 'term_id',
                            'terms'    => array(9),
                        ),
                    ),
                    'meta_key' => 'sort',
                    'orderby'  => 'meta_value_num',
                    'order'    => 'DESC',
                );
            } else {
                $args = array(
                    'post_type'         => 'post',
                    'posts_per_page'    => -1,
                    'tag__in'           => array(9),
                    'meta_key'          => 'sort',
                    'orderby'           => 'meta_value_num',
                    'order'             => 'DESC',
                );
            }
            $blog_query = new WP_Query( $args );

            if ($blog_query->have_posts() ) : ?>
                <div class="c-portfolio__cards o-row --position-center">
                    <?php
                        while ( $blog_query->have_posts() ) : $blog_query->the_post(); 
                            get_template_part( 'template-parts/content', get_post_type() );
                        endwhile;
                    ?>
                </div>
                <?php
                wp_reset_postdata();
            endif;
            ?>

            <?php if (is_user_logged_in()) { ?>
                <div class="c-portfolio__row o-row --position-center">
                    <div class="c-portfolio__content o-col-12 o-col-xl-8">
                        <a class="c-portfolio__button c-button" role="button" href="/portfolio">Alle Projekte ansehen</a>
                    </div>
                </div>
            <?php } ?>
        
            <?php if (!is_user_logged_in()) { ?>
                <div class="c-portfolio__row o-row --position-center">
                    <div class="c-portfolio__content o-col-12 o-col-xl-8">
                        <h2 class="c-portfolio__headline c-headline">Login</h2>
                        <p class="c-portfolio__text c-wysiwyg --balanced">Einige meiner Projekte sind aus Datenschutzgründen geschützt. Das Passwort erhalten Sie auf Anfrage oder aus meiner Bewerbung.</p>
                    </div>
                </div>
                <div class="c-login">
                    <div class="c-login__row o-row --position-center">
                        <div class="c-login__content o-col-12 o-col-xl-6">
                            <?php get_template_part( 'template-parts/content', 'info-messages' ); ?>
                            <?php get_template_part( 'template-parts/content', 'login' ); ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
    </section>

</main>

<?php
get_footer();