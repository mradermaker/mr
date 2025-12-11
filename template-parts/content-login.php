<?php
/**
 * Template part for login
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package mr
 */

$section = $args['section'] ?? false;

$redirect_url = home_url( add_query_arg( null, null ) ) . '#login';
?>

<?php if($section) { ?>
    <section class="c-login o-section o-container">
<?php } ?>
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

                <h2 class="c-login__headline u-screen-reader-only">Login</h2>
                <form id="login" class="c-login__form c-form" name="loginform" id="loginform" action="<?php echo esc_url(wp_login_url()); ?>" method="post" novalidate>
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
                </form>

                <a class="c-button --link" href="mailto:<?php echo antispambot('hallo@monika-radermaker.de'); ?>?subject=Zugang%20anfragen">Zugang anfragen</a>

            </div>
        </div>
<?php if ($section) { ?>
    </section>
<?php } ?>
