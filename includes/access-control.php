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
if (!defined('MR_PORTFOLIO_OVERVIEW_ID')) define('MR_PORTFOLIO_OVERVIEW_ID', 68);

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
 * Check if the current page is a post.
 */
if (!function_exists('mr_is_portfolio_post')) {
    function mr_is_portfolio_post(): bool {
        if (is_single()) {
            return true;
        }

        return false;
    }
}

/**
 * Get the base URL to redirect back to after a login attempt.
 *
 * @return string
 */
if (!function_exists('mr_get_login_redirect_base_url')) :
    function mr_get_login_redirect_base_url(): string {

        // Redirect_to parameter (GET/POST/REQUEST)
        if (!empty($_REQUEST['redirect_to'])) {
            $url = $_REQUEST['redirect_to'];
        } else {
            // Referer, if available
            $url = wp_get_referer();
            if (!$url) {
                // Fallback to home URL
                $url = home_url('/');
            }
        }

        return esc_url_raw($url);
    }
endif;

/**
 * Strip all login-related status query parameters and anchor from URL.
 */
if (!function_exists('mr_strip_login_status_params')) {
    function mr_strip_login_status_params(string $url): string {
        // Remove known status query parameters
        $url = remove_query_arg(
            array(
                'login',
                'loggedout',
                'noaccess',
                'checkemail',
                'resetpass',
                'reauth',
                'expiredkey',
                'invalidkey',
            ),
            $url
        );

        // Remove anchor if present
        $url = preg_replace('/#status$/', '', $url);

        return $url;
    }
}


/**
 * Redirect portfolio posts when the user is not logged in.
 */
if (!function_exists('mr_protect_portfolio_posts')) {
    function mr_protect_portfolio_posts(): void {
        // Allow logged-in users, admin area, AJAX, REST requests
        if (is_user_logged_in() || is_admin() || wp_doing_ajax() || ( defined('REST_REQUEST') && REST_REQUEST)) {
            return;
        }

        // only portfolio posts
        if (!mr_is_portfolio_post()) {
            return;
        }

        $target = get_permalink(MR_PORTFOLIO_OVERVIEW_ID);

        // Fallback if portfolio overwiew page doesn't exist
        if (!$target) {
            $target = home_url('/');
        }

        wp_safe_redirect($target);
        exit;
    }
    add_action('template_redirect', 'mr_protect_portfolio_posts', 0);
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
 * Block wp-admin for "portfolio" users
 */
if (!function_exists('mr_block_admin_for_portfolio')) {
	function mr_block_admin_for_portfolio(): void {
		if (!is_user_logged_in() ) return;

		// Let admins (or anyone with manage_options) in
		if (current_user_can('manage_options')) return;

		// Block only "portfolio" users (allow AJAX)
		if (mr_is_portfolio_user() && !(defined('DOING_AJAX') && DOING_AJAX)) {
			// Base URL: login page
			$target = get_permalink(MR_LOGIN_ID);

            // Fallback
            if (!$target) {
                $target = home_url('/');
            }

			// Add status flag
			$target = add_query_arg('noaccess', 'admin', $target);

			// Add anchor for auto-scroll
			$target .= '#status';

            wp_safe_redirect($target);
            exit;
		}
	}
	add_action('admin_init', 'mr_block_admin_for_portfolio');
}

/**
 * Redirects after login/logout
 */
if (!function_exists('mr_login_redirect')) {
	function mr_login_redirect( $redirect_to, $requested_redirect_to, $user ) {

        // Use the requested redirect URL or fallback to home
        $target = $requested_redirect_to ?: home_url('/');

        // If redirect target is the login page, send to home instead
        $login_url = get_permalink(MR_LOGIN_ID);
        if ($login_url && strpos($target, trailingslashit($login_url)) === 0) {
            $target = home_url('/');
        }

        // Strip any existing status flags first
        $target = mr_strip_login_status_params($target);

		return $target;
	}
	add_filter('login_redirect', 'mr_login_redirect', 10, 3);
}

if (!function_exists('mr_logout_redirect')) {
    function mr_logout_redirect( $redirect_to, $requested_redirect_to, $user ) {
        // Base URL: login page
        $target = get_permalink(MR_LOGIN_ID);

        // Fallback
        if (!$target) {
            $target = home_url('/');
        }

        // Add status flag
        $target = add_query_arg('loggedout', 'true', $target);

        // Add anchor
        $target .= '#status';
        
        return $target;
    }
	add_filter('logout_redirect', 'mr_logout_redirect', 10, 3);
}

/**
 * If a logout action is called while not logged in, redirect
 */
if (!function_exists('mr_block_logout_when_logged_out')) :
    function mr_block_logout_when_logged_out(): void {

        // Only care about visitors that are NOT logged in
        if ( is_user_logged_in() ) {
            return;
        }

        // If someone hits a logout action while logged out
        if ( isset($_GET['action']) && $_GET['action'] === 'logout' ) {

            // Start from base URL (redirect_to or referer)
            $redirect_url = mr_get_login_redirect_base_url();

            // Strip any existing status flags first
            $redirect_url = mr_strip_login_status_params($redirect_url);

            // Add login status flag
            $redirect_url = add_query_arg('loggedout', 'true', $redirect_url);

            // Add anchor
            $redirect_url .= '#status';

            wp_safe_redirect($redirect_url);
            exit;
        }
    }
    add_action('init', 'mr_block_logout_when_logged_out');
endif;

/**
 * Redirect back to the originating page on login failure.
 */
if (!function_exists('mr_redirect_on_failed_login')) :
    function mr_redirect_on_failed_login( $username ) {

        // Start from base URL (redirect_to or referer)
        $redirect_url = mr_get_login_redirect_base_url();

        // Strip any existing status flags first
        $redirect_url = mr_strip_login_status_params($redirect_url);

        // Add login status flag
        $redirect_url = add_query_arg('login', 'failed', $redirect_url);

        // Add anchor
        $redirect_url .= '#status';

        wp_safe_redirect($redirect_url);
        exit;
    }
    add_action('wp_login_failed', 'mr_redirect_on_failed_login');
endif;

/**
 * Redirect back to the originating page when login fields are empty.
 */
if (!function_exists('mr_redirect_on_empty_login')) :
    function mr_redirect_on_empty_login( $user, $username, $password ) {

        if (isset($_POST['log'], $_POST['pwd']) && ($username === '' || $password === '')) {

            // Start from base URL (redirect_to or referer)
            $redirect_url = mr_get_login_redirect_base_url();

            // Strip any existing status flags first
            $redirect_url = mr_strip_login_status_params($redirect_url);

            // Add login status flag
            $redirect_url = add_query_arg('login', 'empty', $redirect_url);

            // Add anchor
            $redirect_url .= '#status';

            wp_safe_redirect($redirect_url);
            exit;
        }

        return $user;
    }
    add_filter('authenticate', 'mr_redirect_on_empty_login', 5, 3);
endif;
