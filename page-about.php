<?php
/**
 * Template Name: Über mich
 */

get_header();
?>

<main id="main" class="o-main">

    <section class="c-profile o-section o-container">
        <div class="c-profile__row o-row --position-center">
            <figure class="c-profile__image c-figure --circle o-col-6 o-col-xl-2 u-position-relative">
                <div class="c-figure__placeholder" aria-hidden="true">
                    <?php get_icon('placeholder', true, ['class' => 'c-figure__icon --image',]); ?>
                </div>
                <figcaption class="c-figure__caption c-handwritten --profile">
                    <?php get_icon('handwritten-arrow-down', true, ['class' => 'c-handwritten__icon',]); ?>
                    <span class="c-handwritten__text">Portraitfoto, lächelnd <span class="u-screen-reader-only">(Platzhalter)</span></span>
                </figcaption>
            </figure>
            <div class="c-profile__content o-col-12 o-col-xl-6">
                <h1 class="c-profile__headline c-headline">Über mich</h1>
                <div class="c-profile__text c-wysiwyg">
                    <p>Ich bin Monika Radermaker, leidenschaftliche Frontend Entwicklerin mit einem Bachelor in Design und <strong>über 10 Jahren Erfahrung in Webdesign und Webentwicklung</strong>.</p>
                    <p>Durch meine <strong>Kombination aus Designverständnis und technischer Umsetzung</strong> entwickle ich Websites, die nicht nur funktionieren, sondern auch überzeugen: klar strukturiert, barrierefrei, performant und bis ins Detail durchdacht.</p>
                    <p>Ich lege Wert auf ein <strong>stimmiges Gesamtbild</strong> und eine <strong>technisch saubere Umsetzung</strong>, damit Layout, Usability und Technik pixelgenau ineinandergreifen.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="c-skills o-section o-container">
        <div class="c-skills__row o-row">
            <div class="c-skills__content o-col-12 o-col-xl-8">
                <p class="c-timeline__subheadline c-subheadline">Fähigkeiten</p>
                <h2 class="c-skills__headline c-headline">Skills & Tools</h2>
            </div>
        </div>

        <div class="c-skills__cards o-row">
            <div class="c-skills__card c-skill-card">
                <div class="c-skill-card__header o-col-12">
                    <?php get_icon('code', true, ['class' => 'c-skill-card__icon --code']); ?>
                    <h3 class="c-skill-card__headline c-headline">Code</h3>
                </div>
                <div class="c-skill-card__wrapper o-col-12 o-col-md-6 o-col-xl-5">
                    <h4 class="c-skill-card__subheadline c-headline">Technologien</h4>
                    <ul class="c-skill-card__list --pills">
                        <li class="c-skill-card__list-item">HTML5</li>
                        <li class="c-skill-card__list-item">CSS3 / SCSS (Sass)</li>
                        <li class="c-skill-card__list-item">BEM / ITCSS</li>
                        <li class="c-skill-card__list-item">JavaScript</li>
                        <li class="c-skill-card__list-item">jQuery</li>
                        <li class="c-skill-card__list-item">PHP</li>
                    </ul>
                </div>
                <div class="c-skill-card__wrapper o-col-12 o-col-md-6 o-col-xl-7">
                    <h4 class="c-skill-card__subheadline c-headline">Tools</h4>
                    <ul class="c-skill-card__list">
                        <li class="c-skill-card__list-item">WordPress</li>
                        <li class="c-skill-card__list-item">ACF / ACF Blocks (Advanced Custom Fields)</li>
                        <li class="c-skill-card__list-item">Git / GitHub</li>
                        <li class="c-skill-card__list-item">DevTools (Debugging, Performance, Accessibility-Checks)</li>
                        <li class="c-skill-card__list-item">CLI (Grundkenntnisse)</li>
                        <li class="c-skill-card__list-item">Visual Studio Code</li>
                        <li class="c-skill-card__list-item">Barrierefreiheit (BFSG / WCAG-konforme Umsetzung)</li>
                        <li class="c-skill-card__list-item">Testing & Performance-Optimierung</li>
                        <li class="c-skill-card__list-item">Interesse an modernen Frameworks</li>
                        <!-- <li>Vue (Grundkenntnisse)</li> -->
                    </ul>
                </div>
            </div>

            <div class="c-skills__card c-skill-card">
                <div class="c-skill-card__header o-col-12">
                    <?php get_icon('design', true, ['class' => 'c-skill-card__icon --image']); ?>
                    <h3 class="c-skill-card__headline c-headline">Design</h3>
                </div>
                <div class="c-skill-card__wrapper o-col-12 o-col-md-6 o-col-xl-5">
                    <h4 class="c-skill-card__subheadline c-headline">Tools</h4>
                    <ul class="c-skill-card__list --pills">
                        <li class="c-skill-card__list-item">Adobe XD</li>
                        <li class="c-skill-card__list-item">Axure</li>
                        <li class="c-skill-card__list-item">Adobe Photoshop</li>
                        <li class="c-skill-card__list-item">Adobe Illustrator</li>
                        <li class="c-skill-card__list-item">Adobe InDesign</li>
                    </ul>
                </div>
                <div class="c-skill-card__wrapper o-col-12 o-col-md-6 o-col-xl-7">
                    <h4 class="c-skill-card__subheadline c-headline">Schwerpunkte</h4>
                    <ul class="c-skill-card__list">
                        <li class="c-skill-card__list-item">Webdesign (Screendesigns, Landingpages, E-Mail-Design)</li>
                        <li class="c-skill-card__list-item">Corporate Design (Logo, Farben, Typografie, Stilrichtlinien)</li>
                        <li class="c-skill-card__list-item">Printdesign (Broschüren, Flyer, Plakate, Geschäftsausstattung)</li>
                        <li class="c-skill-card__list-item">Barrierefreie Gestaltung (BFSG / WCAG-konform)</li>
                        <li class="c-skill-card__list-item">Prototyping & Interaktionsdesign</li>
                        <li class="c-skill-card__list-item">UI- & UX-Design</li>
                        <li class="c-skill-card__list-item">Bachelor in Design</li>
                    </ul>
                </div>

            </div>
        </div>
    </section>

    <section class="c-timeline o-section o-container">
        <div class="c-timeline__row o-row --position-center">
            <div class="c-timeline__content o-col-12 o-col-xl-8">
                <p class="c-timeline__subheadline c-subheadline">Lebenslauf</p>
                <h2 class="c-timeline__headline c-headline">Berufserfahrung & Ausbildung</h2>
            </div>
        </div>

        <div class="c-timeline__row o-row --position-center">
            <div class="c-timeline__cards o-col-12 o-col-xl-8">
                <article class="c-timeline-card --future u-position-relative">
                    <?php
                    $current_user = wp_get_current_user();
                    $user_id = get_current_user_id();
                    $job = get_field('job', 'user_' . $user_id) ?? null;
                    $company = get_field('company', 'user_' . $user_id) ?? null;
                    ?>
                    <div class="c-handwritten --timeline">
                        <?php get_icon('handwritten-arrow-top', true, ['class' => 'c-handwritten__icon',]); ?>
                        <span class="c-handwritten__text">Nächster Karriereschritt</span>
                    </div>
                    <p class="c-timeline-card__date">ab sofort / nach Vereinbarung</p>
                    <h3 class="c-timeline-card__job-title"><?php echo !empty($job) ? esc_html($job) : 'Frontend Developer / Designerin'; ?></h3>
                    <p class="c-timeline-card__company"><?php echo !empty($company) ? esc_html($company) : 'Mein nächstes Team'; ?></p>
                </article>

                <article class="c-timeline-card">
                    <p class="c-timeline-card__date">12/2023 - heute</p>
                    <h3 class="c-timeline-card__job-title">Senior Webdeveloper</h3>
                    <p class="c-timeline-card__company">onOffice GmbH</p>
                </article>

                <article class="c-timeline-card">
                    <p class="c-timeline-card__date">07/2023 - 11/2023</p>
                    <h3 class="c-timeline-card__job-title">Professional Webdeveloper</h3>
                    <p class="c-timeline-card__company">onOffice GmbH</p>
                </article>

                <article class="c-timeline-card">
                    <p class="c-timeline-card__date">10/2020 - 06/2023</p>
                    <h3 class="c-timeline-card__job-title">Professional Webdesigner</h3>
                    <p class="c-timeline-card__company">onOffice GmbH</p>
                </article>

                <article class="c-timeline-card">
                    <p class="c-timeline-card__date">04/2009 - 09/2020</p>
                    <h3 class="c-timeline-card__job-title">Grafik- und Webdesignerin / Webentwicklerin</h3>
                    <p class="c-timeline-card__company">motoin GmbH</p>
                </article>

                <article class="c-timeline-card">
                    <p class="c-timeline-card__date">01/2008 - 09/2020</p>
                    <h3 class="c-timeline-card__job-title">Grafik- und Webdesignerin / Webentwicklerin</h3>
                    <p class="c-timeline-card__company">visions active media</p>
                </article>

                <article class="c-timeline-card">
                    <p class="c-timeline-card__date">2007</p>
                    <h3 class="c-timeline-card__job-title">Praktikum</h3>
                    <p class="c-timeline-card__company">visions active media</p>
                </article>

                <article class="c-timeline-card">
                    <p class="c-timeline-card__date">2006</p>
                    <h3 class="c-timeline-card__job-title">Praktikum</h3>
                    <p class="c-timeline-card__company">CS-Design Studio</p>
                </article>

                <article class="c-timeline-card">
                    <p class="c-timeline-card__date">2003 - 2006</p>
                    <h3 class="c-timeline-card__job-title">Graduat Grafikdesign (BAC+3)</h3>
                    <p class="c-timeline-card__company">Ecole Supérieure des Arts Saint-Luc (Belgien)</p>
                </article>

                <article class="c-timeline-card">
                    <p class="c-timeline-card__date">2003</p>
                    <h3 class="c-timeline-card__job-title">Praktikum</h3>
                    <p class="c-timeline-card__company">Fotolabor Andreas Borowy</p>
                </article>

                <article class="c-timeline-card">
                    <p class="c-timeline-card__date">1996 - 2002</p>
                    <h3 class="c-timeline-card__job-title">Abitur</h3>
                    <p class="c-timeline-card__company">Robert-Schuman-Institut (Belgien)</p>
                </article>
            </div>
        </div>
    </section>

</main>

<?php
get_footer();