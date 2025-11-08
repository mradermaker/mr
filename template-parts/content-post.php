<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package mr
 */
 
// Post
$post_id = get_the_ID() ?? null;
$post_link = esc_url(get_permalink($post_id)) ?? null;

$default_cat_name = get_cat_name( get_option('default_category') );
$cat_names = wp_list_pluck( (array) get_the_category(), 'name' );
$cat_names_filtered = array_diff( $cat_names, [ $default_cat_name ] );
$cat_names_lower = array_map( 'mb_strtolower', $cat_names );
array_unshift($cat_names_lower, 'alle');
$cat_names_lower = array_unique($cat_names_lower);

$role = $args['role'] ?? null;

// Content
$color = get_field('color') ?: '#7f7f7f';
$image = get_field('image') ?? [];
$headline = get_field('headline') ?? null;
$text = get_field('text') ?? null;
?>

<article class="c-post-card o-col-12 o-col-md-6" data-category="<?php echo implode( ',', $cat_names_lower ); ?>" <?php echo $role ? 'role="' . esc_attr($role) . '"' : ''; ?>>
    <?php if (!empty($post_link)) { ?>
        <a class="c-post-card__image-wrapper" href="<?php echo $post_link; ?>" style="--color-project: <?php echo $color; ?>;">
    <?php } ?>
        <?php if (!empty($image['image']['url'])) { ?>
            <?php
            get_picture($image['image'], [
                'additionalPictureClass' => 'c-post-card__picture',
                'additionalImageClass'   => 'c-post-card__image'
            ]);
            ?>
        <?php } ?>
    <?php if (!empty($post_link)) { ?>
        </a>
    <?php } ?>
    <div class="c-post-card__content">
        <?php if (!empty($headline)) { ?>
            <h3 class="c-post-card__headline c-headline"><?php echo $headline; ?></h3>
        <?php } ?>
        <?php if (!empty($text)) { ?>
            <div class="c-post-card__text c-wysiwyg"><?php echo $text; ?></div>
        <?php } ?>
        <?php
        if (!empty($cat_names_filtered) && is_array($cat_names_filtered)) {
            echo '<ul class="c-post-card__categories c-categories">';
            foreach ($cat_names_filtered as $category) {
                
                    printf(
                        '<li class="c-categories__category c-categories">%1$s</li>',
                        $category
                    );
            }
            echo '</ul>';
        }
        ?>
        <?php if (!empty($post_link)) { ?><a class="c-post-card__link" href="<?php echo $post_link; ?>">Projekt ansehen</a><?php } ?>
    </div>
</article>