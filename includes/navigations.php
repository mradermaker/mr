<?php
/**
 * Navigations
 *
 * @package mr
 */

/**
 * Register navigations
 */
register_nav_menus(
    array(
        'main-nav' => esc_html__('Haupt-Navigation', 'mr'),
        'footer-nav' => esc_html__('Footer-Navigation', 'mr'),
    )
);

/**
 * Filters the CSS classes applied to a menu item's list item element.
 *
 * @param string[] $classes Array of the CSS classes that are applied to the menu item's `<li>` element.
 * @param WP_Post  $item    The current menu item.
 * @param stdClass $args    An object of wp_nav_menu() arguments.
 * @param int      $depth   Depth of menu item. Used for padding.
 */
function mr_nav_menu_css_class($classes, $item, $args, $depth) {
    // Get theme location, fallback for `default`.
    $theme_location = $args->theme_location ? $args->theme_location : 'default';

    // Reset all default classes and start adding custom classes to array.
    $_classes = [''];

    // Add theme location class.
    $_classes[] = 'c-' . $theme_location . '__item';

    // Add a class if the menu item has children.
    if (in_array('menu-item-has-children', $classes, true)) {
        $_classes[] = ' --has-children';
    }

    // Add a class if the menu item is frontpage.
    if (in_array('menu-item-home', $classes, true)) {
        $_classes[] = '--home';
    }

    // Add `is-ancestor` class.
    if (in_array('current-page-ancestor', $classes, true) || in_array('current-menu-ancestor', $classes, true)) {
        $_classes[] = '--ancestor';
    }

    // Add `is-active` class.
    if (in_array('current-menu-item', $classes, true) || in_array('current_page_parent', $classes, true)) {
        $_classes[] = '--active';
    }

    // Add `is-top-level` example class using $depth parameter.
    if (0 === $depth) {
        $_classes[] = '--top-level';
    }

    // Return custom classes.
    return $_classes;
}
add_filter('nav_menu_css_class', 'mr_nav_menu_css_class', 10, 4);

/**
 * Filters the WP nav menu link attributes.
 *
 * @param array    $atts {
 *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
 *
 *     @type string $title  Title attribute.
 *     @type string $target Target attribute.
 *     @type string $rel    The rel attribute.
 *     @type string $href   The href attribute.
 * }
 * @param WP_Post  $item  The current menu item.
 * @param stdClass $args  An object of wp_nav_menu() arguments.
 * @param int      $depth Depth of menu item. Used for padding.
 * @return string  $attr
 */
function mr_nav_menu_link_attributes($atts, $item, $args, $depth) {
    // Get theme location, fallback for `default`.
    $theme_location = $args->theme_location ? $args->theme_location : 'default';

    // Start adding custom classes.
    $atts['class'] = 'c-' . $theme_location . '__link';

    // Return custom classes.
    return $atts;
}
add_filter('nav_menu_link_attributes', 'mr_nav_menu_link_attributes', 10, 4);


/**
 * Filters the CSS class(es) applied to a menu list element.
 *
 * @param string[] $classes Array of the CSS classes that are applied to the menu `<ul>` element.
 * @param stdClass $args    An object of `wp_nav_menu()` arguments.
 * @param int      $depth   Depth of menu item. Used for padding.
 * @return string[]
 */

function mr_nav_menu_submenu_css_class($classes, $args, $depth) {
    // Get theme location, fallback for `default`.
    $theme_location = $args->theme_location ? $args->theme_location : 'default';

    // Reset all default classes and start adding custom classes to array.
    $_classes = [''];

    // Add if the menu item has children.
    if (in_array('sub-menu', $classes, true)) {
        $_classes[] = 'c-' . $theme_location . '__sub-menu';
    }

    // Return custom classes.
    return $_classes;
}
add_filter('nav_menu_submenu_css_class', 'mr_nav_menu_submenu_css_class', 10, 4);