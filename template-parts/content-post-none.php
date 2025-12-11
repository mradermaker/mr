<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package mr
 */
 
// Post
$default_cat_name = get_cat_name( get_option('default_category') );
$default_cat_name_lower = mb_strtolower($default_cat_name);

$role = $args['role'] ?? null;
?>

<article class="c-post-card o-col-12 o-col-md-6" data-category="<?php echo $default_cat_name_lower; ?>" <?php echo $role ? 'role="' . esc_attr($role) . '"' : ''; ?>>
    <figure class="c-post-card__image-wrapper --placeholder c-figure u-position-relative">
        <div class="c-figure__placeholder" aria-hidden="true">
            <?php get_icon('placeholder', true, ['class' => 'c-figure__icon --image',]); ?>
        </div>
        <figcaption class="c-figure__caption c-handwritten --post">
            <?php get_icon('handwritten-arrow-down', true, ['class' => 'c-handwritten__icon',]); ?>
            <span class="c-handwritten__text">Projektbild <span class="u-screen-reader-only">(Platzhalter)</span></span>
        </figcaption>
    </figure>
    <div class="c-post-card__content">
        <?php if (!empty($headline)) { ?>
            <h3 class="c-post-card__headline c-headline">Lorem ipsum dolor</h3>
        <?php } ?>
        <?php if (!empty($text)) { ?>
            <div class="c-post-card__text c-wysiwyg">
                <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</p>
            </div>
        <?php } ?>
    </div>
</article>