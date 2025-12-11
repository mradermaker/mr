<?php
/**
 * Template part for login
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package mr
 */

$redirect_url = home_url( add_query_arg( null, null ) ) . '#status';
?>

<form class="c-form" name="loginform" id="loginform" action="<?php echo esc_url(wp_login_url()); ?>" method="post" novalidate>
    <input type="hidden" name="redirect_to" value="<?php echo esc_url( $redirect_url ); ?>">

    <div class="c-input-group">
        <label for="user_login" class="c-input-group__label c-label">Benutzername oder E-Mail <span class="c-label__required">* (Pflichtfeld)</span></label>
        <input type="text" name="log" id="user_login" class="c-input-group__field c-input" autocapitalize="off" autocomplete="username" required="required" aria-describedby="username-error">
        <div id="username-error" class="c-input-group__error" hidden>
            <?php get_icon('error', true, ['class' => 'c-input-group__error-icon']); ?>
            <span class="c-input-group__error-text">Bitte gib deinen Benutzernamen oder deine E-Mail Adresse ein.</span>
        </div>
    </div>

    <div class="c-input-group">
        <label for="user_pass" class="c-input-group__label c-label">Passwort <span class="c-label__required">* (Pflichtfeld)</span></label>
        <input type="password" name="pwd" id="user_pass" class="c-input-group__field c-input" autocomplete="current-password" spellcheck="false" required="required" aria-describedby="password-error">
        <div id="password-error" class="c-input-group__error" hidden>
            <?php get_icon('error', true, ['class' => 'c-input-group__error-icon']); ?>
            <span class="c-input-group__error-text">Bitte gib dein Passwort ein.</span>
        </div>
    </div>

    <div class="c-control">
        <input class="c-control__input --checkbox" type="checkbox" name="rememberme" id="rememberme" value="forever">
        <label class="c-control__label" for="rememberme">Angemeldet bleiben</label>
    </div>

    <input type="submit" name="wp-submit" class="c-button" value="Anmelden">

    <a class="c-button --link" href="mailto:<?php echo antispambot('hallo@monika-radermaker.de'); ?>?subject=Zugang%20anfragen">Zugang anfragen</a>
</form>