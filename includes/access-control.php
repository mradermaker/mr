<?php
/**
 * Content protection and redirects
 *
 * @package mr
 */

/**
 * Config (page IDs & paths) 
 */
if (!defined('MR_LOGIN_ID'))   define('MR_LOGIN_ID', 14);
if (!defined('MR_IMPRINT_ID'))    define('MR_IMPRINT_ID', 19);
if (!defined('MR_DATA_PROTECTION_ID'))  define('MR_DATA_PROTECTION_ID', 3);

/**
 * Check if current user has the "portfolio" role.
 *
 * @return bool
 */
if (!function_exists('mr_is_portfolio_user')) {
    function mr_is_portfolio_user(): bool {
        $user = wp_get_current_user();
        return $user && in_array('portfolio', (array) $user->roles, true);
    }
}

/**
 * Restrict all content except configured public pages.
 */
if (!function_exists('mr_protect_all_pages')) {
    function mr_protect_all_pages(): void {
        // Allow logged-in users, admin area, AJAX, REST requests
        if (is_user_logged_in() || is_admin() || wp_doing_ajax() || ( defined('REST_REQUEST') && REST_REQUEST)) {
            return;
        }

        // Allow feeds publicly
        // if (is_feed() ) {
        // 	return;
        // }

        $allowed_pages = array(MR_LOGIN_ID, MR_IMPRINT_ID, MR_DATA_PROTECTION_ID);

        if (!is_page($allowed_pages)) {
            $target = get_permalink(MR_LOGIN_ID);

            // Fallback if login page doesn't exist
            if (!$target) {
                $target = wp_login_url();
            }

            wp_safe_redirect($target);
            exit;
        }
    }
    add_action('template_redirect', 'mr_protect_all_pages', 0);
}

/**
 * Block wp-admin for "portfolio" users
 */
if (!function_exists('mr_block_admin_for_portfolio')) {
	function mr_block_admin_for_portfolio(): void {
		if (!is_user_logged_in() ) return;

		// Let admins (or anyone with manage_options) in
		if (current_user_can('manage_options')) return;

		// Block only "portfolio" users (allow AJAX)
		if (mr_is_portfolio_user() && !(defined('DOING_AJAX') && DOING_AJAX)) {
			wp_safe_redirect(
				add_query_arg('noaccess', 'admin', get_permalink(MR_LOGIN_ID))
			);
			exit;
		}
	}
	add_action('admin_init', 'mr_block_admin_for_portfolio');
}

/**
 * Hide admin bar on the frontend for "portfolio" users
 *
 * @param bool $show Whether to show the admin bar.
 * @return bool
 */
if (!function_exists('mr_hide_admin_bar_for_portfolio')) {
	function mr_hide_admin_bar_for_portfolio( $show ): bool {
		if (current_user_can('manage_options')) {
			return $show;
		}
		if (mr_is_portfolio_user() ) {
			return false;
		}
		return $show;
	}
	add_filter('show_admin_bar', 'mr_hide_admin_bar_for_portfolio');
}

/**
 * Redirects after login/logout
 */
if (!function_exists('mr_login_redirect')) {
	function mr_login_redirect( $redirect_to, $requested_redirect_to, $user ) {
		return $requested_redirect_to ?: home_url('/');
	}
	add_filter('login_redirect', 'mr_login_redirect', 10, 3);
}

if (!function_exists('mr_logout_redirect')) {
	function mr_logout_redirect( $redirect_to, $requested_redirect_to, $user ) {
		// return home_url('/login');
        return add_query_arg( 'loggedout', 'true', get_permalink(MR_LOGIN_ID) );
	}
	add_filter('logout_redirect', 'mr_logout_redirect', 10, 3);
}

// Bei Login-FEHLER zurück auf /login mit Kennzeichen
if (!function_exists( 'mr_redirect_on_failed_login')) :
    function mr_redirect_on_failed_login( $username ) {
        // Optional: ursprüngliche Ziel-URL weiterreichen, falls gesetzt
        $args = array( 'login' => 'failed' );
        if (!empty( $_REQUEST['redirect_to'] ) ) {
            $args['redirect_to'] = esc_url_raw( $_REQUEST['redirect_to'] );
        }
        wp_safe_redirect( add_query_arg( $args, get_permalink(MR_LOGIN_ID) ) );
        exit;
    }
    add_action('wp_login_failed', 'mr_redirect_on_failed_login');
endif;

// Leere Felder abfangen → freundliche Meldung auf /login
if (!function_exists( 'mr_redirect_on_empty_login')) :
    function mr_redirect_on_empty_login( $user, $username, $password ) {
        if (isset( $_POST['log'], $_POST['pwd'] ) && ( $username === '' || $password === '')) {
            wp_safe_redirect( add_query_arg( 'login', 'empty', get_permalink(MR_LOGIN_ID) ) );
            exit;
        }
        return $user;
    }
    add_filter('authenticate', 'mr_redirect_on_empty_login', 5, 3);
endif;