<?php
/**
 * ACF settings
 *
 * @package mr
 */

/**
 * Save json files in custom folder
 */
add_filter('acf/settings/save_json', 'mr_acf_json_save_point');
function mr_acf_json_save_point( $path ) {
    
    // update path
    $path = get_stylesheet_directory() . '/acf';
    
    // return
    return $path;
}

/**
 * Load json files from custom folder
 */
add_filter('acf/settings/load_json', 'mr_acf_json_load_point');
function mr_acf_json_load_point( $paths ) {
    
    // remove original path (optional)
    unset($paths[0]);
    
    // append path
    $paths[] = get_stylesheet_directory() . '/acf';
    
    // return
    return $paths;
}