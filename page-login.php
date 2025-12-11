<?php
/**
 * Template Name: Login
 */

get_header();
?>

<main id="main" class="o-main">

    <section class="c-login o-section o-container">
        <div class="c-login__row o-row --position-center">
            <div class="c-login__content o-col-12 o-col-xl-6">
                <?php get_template_part( 'template-parts/content', 'info-messages' ); ?>
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
                        <h1>Hallo <?php echo esc_html(!empty($first_name) && !empty($last_name) ? $first_name . ' ' . $last_name : (!empty($company) ? $company : $username)); ?>!</h1>
                        <p>Du bist angemeldet und siehst vertrauliche Arbeitsproben. Bitte nicht weiterleiten oder öffentlich teilen.</p>
                    </div>
                    <div class="c-login__button-group c-button-group">
                        <a class="c-button" href="<?php echo esc_url(home_url('/')); ?>">Zur Startseite</a>
                        <a class="c-button --link" href="<?php echo esc_url($logout_url); ?>">Abmelden</a>
                    </div>
                <?php } else { ?>
                    <h1 class="c-login__headline">Login</h1>
                    <?php get_template_part( 'template-parts/content', 'login' ); ?>
                <?php } ?>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();