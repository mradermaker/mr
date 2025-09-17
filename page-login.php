<?php
/**
 * Template Name: Login
 */

get_header();
?>

<main id="main" class="o-main">

    <section class="o-section">
        <div class="o-container">
            <div class="o-row --position-center c-profile">
                <figure class="c-profile__image c-figure o-col-6 o-col-xl-2 u-position-relative">
                    <div class="c-figure__placeholder --circle" aria-hidden="true"></div>
                    <figcaption class="c-figure__caption c-handwritten">
                        <?php get_icon('handwritten-arrow-down', true, ['class' => 'c-handwritten__icon --arrow-down',]); ?>
                        <span class="c-handwritten__text">Portraitfoto, lächelnd <span class="u-screen-reader-only">(Platzhalter)</span></span>
                    </figcaption>
                </figure>
                <div class="c-profile__content o-col-12 o-col-xl-6">
                    <h1 class="c-profile__headline c-headline">Hallo! Ich bin Monika, Frontend Developer & Webdesignerin.</h1>
                    <p class="c-profile__text c-text">Einige meiner Projekte sind aus Datenschutzgründen geschützt. Das Passwort erhalten Sie auf Anfrage oder direkt aus meiner Bewerbung.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="o-section">
        <div class="o-container">
            <div class="o-row --position-center c-login">
                <form class="c-login__form o-form o-col-12 o-col-xl-8" name="loginform" id="loginform" action="<?php echo esc_url( wp_login_url() ); ?>" method="post">
                    <p class="c-info-messages --is-error" role="alert" aria-live="assertive" hidden></p>
                    <p class="c-info-messages" role="status" aria-live="polite" hidden></p>

                    <input type="hidden" name="redirect_to" value="<?php echo esc_url( home_url('/portfolio') ); ?>" />

                    <div class="c-input-group">
                        <label for="user_login" class="c-input-group__label c-label">Benutzername oder E-Mail <span class="c-label__required">* (Pflichtfeld)</span></label>
                        <input type="text" name="user_login" id="user_login" class="c-input-group__field c-input" />
                        <div class="c-input-group__error" hidden></div>
                    </div>

                    <div class="c-input-group">
                        <label for="user_password" class="c-input-group__label c-label">Passwort <span class="c-label__required">* (Pflichtfeld)</span></label>
                        <input type="password" name="user_password" id="user_password" class="c-input-group__field c-input" />
                        <div class="c-input-group__error" hidden></div>
                    </div>

                    <input type="submit" name="wp-submit" class="c-button" value="Anmelden" />
                </form>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();