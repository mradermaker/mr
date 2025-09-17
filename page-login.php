<?php
/**
 * Template Name: Login
 */

get_header();
?>

<main id="main" class="o-main">

    <section class="o-section">
        <div class="o-container">
            <div class="o-row c-profile">
                <figure class="c-profile__image o-figure o-col-6 o-col-xl-2 u-position-relative">
                    <div class="o-figure__placeholder --circle" aria-hidden="true"></div>
                    <figcaption class="o-figure__caption c-handwritten">
                        <?php get_icon('handwritten-arrow-down', true, ['class' => 'c-handwritten__icon --arrow-down',]); ?>
                        <span class="c-handwritten__text">Portraitfoto, lächelnd <span class="u-screen-reader-only">(Platzhalter)</span></span>
                    </figcaption>
                </figure>
                <div class="c-profile__content o-col-12 o-col-xl-6">
                    <h1 class="c-profile__headline o-headline">Hallo! Ich bin Monika, Frontend Developer & Webdesignerin.</h1>
                    <p class="c-profile__text">Einige meiner Projekte sind aus Datenschutzgründen geschützt. Das Passwort erhalten Sie auf Anfrage oder direkt aus meiner Bewerbung.</p>
                </div>
            </div>
        </div>
    </section>

</main>

<?php
get_footer();