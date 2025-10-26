<?php
/**
 * User roles
 *
 * @package mr
 */

// Add portfolio role
if (!function_exists('mr_create_portfolio_role')) {
    function mr_create_portfolio_role() {
        add_role('portfolio', 'Portfolio', [
            'read' => true,
            'level_0' => true,
        ]);
    }
    add_action('init', 'mr_create_portfolio_role');
}