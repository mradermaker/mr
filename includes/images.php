<?php
/**
 * Removed scaled for images
 */
add_filter('big_image_size_threshold', '__return_false');
// add_filter('big_image_size_threshold', function () {
//     return 3840; // max Kantenlänge in Pixel
// });

/**
 * Image sizes
 * add_image_size( string $name, int $width, int $height, bool|array $crop = false );
 * add_image_size( 'custom-size', 220, 220, array( 'left', 'top' ) );
 */
add_image_size('image-half-xs', '543');
add_image_size('image-half-sm', '512');
add_image_size('image-half-md', '331');
add_image_size('image-half-lg', '448');
add_image_size('image-half-xl', '544');
add_image_size('image-half-xxl', '640');
add_image_size('image-half-xxxl', '706');
add_image_size('image-xxs', '400');
add_image_size('image-xs', '576');
add_image_size('image-sm', '768');
add_image_size('image-md', '992');
add_image_size('image-lg', '1200');
add_image_size('image-xl', '1400');
add_image_size('image-xxl', '1600');
add_image_size('image-xxxl', '1920');

/**
 * Generate a responsive <picture> element
 *
 * @param array $img   ACF image array (must contain ['sizes'] and ['url'])
 * @param array $args  Optional:
 *                     'loading'      => 'lazy' (default) or 'eager'
 *                     'pictureClass' => additional CSS class(es) for the <picture>
 *                     'imageClass'   => additional CSS class(es) for the <img>
 * @param bool  $echo  true = echo output, false = return string
 * @return string|null
 * @use get_picture($image, [
 *     'loading'      => 'eager',
 *     'additionalPictureClass' => 'c-hero__picture',
 *     'additionalImageClass'   => 'c-hero__image',
 * ]);
 */

if (!function_exists('get_picture')) {
    function get_picture(array $img, array $args = [], bool $echo = true) {

        // Default arguments
        $defaults = [
            'loading'      => 'lazy',
            'additionalPictureClass' => '',
            'additionalImageClass'   => '',
        ];
        $args = wp_parse_args($args, $defaults);

        // Base + optional additional classes
        $pictureClass = 'c-picture' . ($args['additionalPictureClass'] ? ' ' . $args['additionalPictureClass'] : '');
        $imageClass   = 'c-image'   . ($args['additionalImageClass']   ? ' ' . $args['additionalImageClass']   : '');
        $loading      = ($args['loading'] === 'eager') ? 'eager' : 'lazy';
        $size         = $args['size'] ?? 'half';

        // Collect URLs with fallback chain
        $base = $img['url'] ?? '';
        if ($size === 'half') {
            $xs   = $img['sizes']['image-half-xs'] ?? $img['sizes']['image-xs'] ?? $base;
            $sm   = $img['sizes']['image-half-sm'] ?? $img['sizes']['image-xs'] ?? $base;
            $md   = $img['sizes']['image-half-md'] ?? $img['sizes']['image-xxs'] ?? $base; 
            $lg   = $img['sizes']['image-half-lg'] ?? $img['sizes']['image-xs'] ?? $base; 
            $xl   = $img['sizes']['image-half-xl'] ?? $img['sizes']['image-xs'] ?? $base;
            $xxl  = $img['sizes']['image-half-xxl'] ?? $img['sizes']['image-sm'] ?? $base;
            $xxxl = $img['sizes']['image-half-xxxl'] ?? $img['sizes']['image-sm'] ?? $base;
        } else {
            $xs   = $img['sizes']['image-xs'] ?? $base;
            $sm   = $img['sizes']['image-sm'] ?? $xs;
            $md   = $img['sizes']['image-md'] ?? $sm;
            $lg   = $img['sizes']['image-lg'] ?? $md;
            $xl   = $img['sizes']['image-xl'] ?? $lg;
            $xxl  = $img['sizes']['image-xxl'] ?? $xl;
            $xxxl = $img['sizes']['image-xxxl'] ?? $xxl;
        }

        // Dimensions from largest size (reduces CLS)
        $w = $img['sizes']['image-xxxl-width']  ?? null;
        $h = $img['sizes']['image-xxxl-height'] ?? null;
        $alt = $img['alt'] ?? 'Bild';

        // Map min-width breakpoints (largest first)
        $breakpoints = [
            1600 => $xxxl,
            1400 => $xxl,
            1200 => $xl,
            992  => $lg,
            768  => $md,
            576  => $sm,
        ];

        // Build HTML output
        $html  = '<picture class="' . esc_attr($pictureClass) . '">';

        // XS (max-width: 575px)
        $html .= '<source media="(max-width: 575px)" srcset="' . esc_url($xs) . '">';

        // All others (min-width)
        foreach ($breakpoints as $breakpoint => $src) {
            $html .= '<source media="(min-width: ' . (int)$breakpoint . 'px)" srcset="' . esc_url($src) . '">';
        }

        // Fallback <img> (largest version)
        $html .= '<img decoding="async" loading="' . esc_attr($loading) . '" class="' . esc_attr($imageClass) . '" src="' . esc_url($xxxl) . '"'
            . ($w ? ' width="' . esc_attr($w) . '"' : '')
            . ($h ? ' height="' . esc_attr($h) . '"' : '')
            . ' alt="' . esc_attr($alt) . '">';

        $html .= '</picture>';

        // Echo or return
        if ($echo) {
            echo $html;
            return null;
        }

        return $html;
    }
}