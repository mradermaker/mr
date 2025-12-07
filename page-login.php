<?php
/**
 * Template Name: Login
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
                <h1 class="c-profile__headline c-headline">Hallo! Ich bin Monika, Frontend Developer & Designerin.</h1>
                <p class="c-profile__text c-wysiwyg">Einige meiner Projekte sind aus Datenschutzgründen geschützt. Das Passwort erhalten Sie auf Anfrage oder aus meiner Bewerbung.</p>
            </div>
        </div>
    </section>

    <section class="c-login o-section o-container">
        <div class="c-login__row o-row --position-center">
            <div class="c-login__content o-col-12 o-col-xl-6">
                <?php
                $messages = get_login_messages();

                foreach ($messages as $message) {
                    $type = $message['type']; // error | success | info
                    $text = $message['text'];
                    $role = ($type === 'error') ? 'alert' : 'status';
                    $aria = ($type === 'error') ? 'assertive' : 'polite';
                    ?>
                    <!--
                    <p class="c-info-messages --is-error" role="alert" aria-live="assertive" hidden></p>
                    <p class="c-info-messages" role="status" aria-live="polite" hidden></p>
                    -->
                    <p class="c-login__info-messages c-info-messages --is-<?php echo esc_attr($type); ?>" role="<?php echo esc_attr($role); ?>" aria-live="<?php echo esc_attr($aria); ?>">
                        <?php get_icon($type, true, ['class' => 'c-info-messages__icon']); ?>
                        <?php echo esc_html($text); ?>
                    </p>
                <?php } ?>
                <?php if (is_user_logged_in()) { ?>
                    <?php
                    $current_user = wp_get_current_user();
                    $user_id = get_current_user_id();
                    $username = $current_user->user_login ?? null;
                    $first_name = $current_user->user_firstname ?? null;
                    $last_name = $current_user->user_lastname ?? null;
                    $company = get_field('company', 'user_' . $user_id) ?? null;
                    $logout_url   = wp_logout_url(get_permalink(MR_LOGIN_ID));
                    ?>
                    <div class="c-login__logged-in c-wysiwyg">
                        <h2>Hallo <?php echo esc_html(!empty($first_name) && !empty($last_name) ? $first_name . ' ' . $last_name : (!empty($company) ? $company : $username)); ?>!</h2>
                        <p>Du bist angemeldet und siehst vertrauliche Arbeitsproben. Bitte nicht weiterleiten oder öffentlich teilen.</p>
                    </div>
                    <div class="c-login__button-group c-button-group">
                        <a class="c-button" href="<?php echo esc_url(home_url('/')); ?>">Zum Portfolio</a>
                        <a class="c-button --link" href="<?php echo esc_url($logout_url); ?>">Abmelden</a>
                    </div>
                <?php } else { ?>
                    <form class="c-login__form c-form" name="loginform" id="loginform" action="<?php echo esc_url(wp_login_url()); ?>" method="post" novalidate>
                        <input type="hidden" name="redirect_to" value="<?php echo esc_url(home_url('/')); ?>" />

                        <div class="c-input-group">
                            <label for="user_login" class="c-input-group__label c-label">Benutzername oder E-Mail <span class="c-label__required">* (Pflichtfeld)</span></label>
                            <input type="text" name="log" id="user_login" class="c-input-group__field c-input" autocapitalize="off" autocomplete="username" required="required" aria-describedby="username-error" />
                            <div id="username-error" class="c-input-group__error" hidden>
                                <?php get_icon('error', true, ['class' => 'c-input-group__error-icon']); ?>
                                <span class="c-input-group__error-text">Bitte gib deinen Benutzernamen oder deine E-Mail Adresse ein.</span>
                            </div>
                        </div>

                        <div class="c-input-group">
                            <label for="user_pass" class="c-input-group__label c-label">Passwort <span class="c-label__required">* (Pflichtfeld)</span></label>
                            <input type="password" name="pwd" id="user_pass" class="c-input-group__field c-input" autocomplete="current-password" spellcheck="false" required="required" aria-describedby="password-error" />
                            <div id="password-error" class="c-input-group__error" hidden>
                                <?php get_icon('error', true, ['class' => 'c-input-group__error-icon']); ?>
                                <span class="c-input-group__error-text">Bitte gib dein Passwort ein.</span>
                            </div>
                        </div>

                        <div class="c-control">
                            <input class="c-control__input --checkbox" type="checkbox" name="rememberme" id="rememberme" value="forever">
                            <label class="c-control__label" for="rememberme">Angemeldet bleiben</label>
                        </div>

                        <input type="submit" name="wp-submit" class="c-button" value="Anmelden" />
                    </form>

                    <a class="c-button --link" href="mailto:<?php echo antispambot('hallo@monika-radermaker.de'); ?>?subject=Zugang%20anfragen">Zugang anfragen</a>
                <?php } ?>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();