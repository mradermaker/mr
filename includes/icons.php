<?php

/**
 * Generate Icon
 *
 * @param string  $name                  The name of the icon to be loaded. Example: 'arrow-left'.
 *                                       This will look for a file named 'arrow-left.svg'.
 * @param bool    $default_accessibility Whether to apply default accessibility attributes like
 *                                       'aria-hidden="true"' and 'focusable="false"'. Default is true.
 * @param array   $attributes            (optional) An associative array of attributes to add to the SVG element.
 *                                       Example: ['aria-hidden' => 'true', 'role' => 'img', 'class' => 'my-icon'].
 *                                       If not provided or if $default_accessibility is true, default attributes will be merged.
 * @return void                          This function outputs the SVG markup or the icon's name if no SVG file is found.
 * @use get_icon('file_name');
 */

if (!function_exists('get_icon')) {
    function get_icon(
        string $name,
        bool $default_accessibility = true,
        array $attributes = [],
    ) {

        // If no name is provided, return nothing
        if (empty($name)) {
            return;
        }

        // Match the icon name to the correct file
        $icon = match ($name) {
            'menu' => 'menu',
            'close' => 'close',
            'error' => 'error',
            'success' => 'check',
            'warning' => 'triangle-alert',
            'info' => 'info',
            'handwritten-arrow-down' => 'handwritten-arrow-down-curvy',
            'handwritten-arrow-top' => 'handwritten-arrow-top-curved',
            'handwritten-arrow-right' => 'handwritten-arrow-right-curved',
            'handwritten-arrow-straight' => 'handwritten-arrow-straight',
            'handwritten-arrow-straight-short' => 'handwritten-arrow-straight-short',
            'placeholder' => 'image',
            'code' => 'app-window',
            'design' => 'pencil-ruler',
            'accessibility' => 'person-standing',
            'learning' => 'sparkles',
            'github' => 'github',
            'codepen' => 'codepen',
            'linkedin' => 'linkedin',
            'xing' => 'xing',
            default => null,
        };

        // If no matching icon was found, return the name
        if (!$icon) {
            echo esc_html($name);
            return;
        }

        $file_path = get_template_directory() . '/images/icons/' . $icon . '.svg';

        // If no file was found, return the icon name
        if (!$file_path) {
            echo esc_html($name);
            return;
        }

        // Load the SVG file content as a string
        $svg_content = file_get_contents($file_path);
        if (!$svg_content) {
            echo esc_html($name);
            return;
        }

        // Create SimpleXMLElement from the SVG content
        $svg = new SimpleXMLElement($svg_content);

        // Merge default accessibility attributes if requested
        if ($default_accessibility) {
            $attributes = array_merge(
                [
                    'aria-hidden' => 'true',
                    'focusable' => 'false',
                ],
                $attributes,
            );
        }
        // Add or overwrite attributes in the SVG element
        foreach ($attributes as $key => $value) {
            $svg->addAttribute($key, $value); // This will overwrite existing attributes if they exist
        }

        // Output the SVG as XML
        echo preg_replace('/<\?xml.*?\?>\s*/', '', $svg->asXML());
    }
}