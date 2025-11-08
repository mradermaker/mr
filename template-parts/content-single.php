<?php
/**
 * Template part for displaying single
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package mr
 */

// Post
$post_id = get_the_ID() ?? null;

$default_cat_name = get_cat_name( get_option('default_category') );
$cat_names = wp_list_pluck( (array) get_the_category(), 'name' );
$cat_names_filtered = array_diff( $cat_names, [ $default_cat_name ] );

// Content
$color = get_field('color') ?: '#7f7f7f';
$image = get_field('image') ?? [];
$headline = get_field('headline') ?? null;
$text = get_field('text') ?? null;
$technologies = get_field('technology') ?? [];
$roles = get_field('role') ?? [];
$link = get_field('link') ?? [];

$screenshots = [];
for ($i = 1; $i <= 5; $i++) {
    $screenshot_field = get_field("screenshot_{$i}") ?? [];
    $screenshot_image = $screenshot_field['image'] ?? [];

    if (!empty($screenshot_image['url'])) {
        $screenshots["screenshot_{$i}"] = [
            'image' => $screenshot_image,
            'type'  => $screenshot_field['type'] ?? null,
        ];
    }
}

$screens = [];
$fulls = [];
foreach ($screenshots as $screenshot) {
    if (!empty($screenshot['type']) && $screenshot['type'] === 'screen') {
        $screens[] = $screenshot;
    } else {
        $fulls[] = $screenshot;
    }
}
?>

<article class="c-post" style="--color-project: <?php echo $color; ?>;">
    <?php if (!empty($image['image']['url'])) { ?>
        <div class="c-post__header <?php echo !empty($image['type']) ? '--' . esc_attr($image['type']) : ''; ?> o-container-fluid">
            <?php
            get_picture($image['image'], [
                'additionalPictureClass' => 'c-post__header-picture',
                'additionalImageClass'   => 'c-post__header-image'
            ]);
            ?>
        </div>
    <?php } ?>

    <div class="c-post__container o-container">
        <div class="c-post__row o-row --position-center">
            <div class="c-post__content o-col-12 o-col-md-7">
                <?php if (!empty($headline)) { ?>
                    <h1 class="c-post__headline c-headline"><?php echo $headline; ?></h1>
                <?php } ?>
                <?php
                if (!empty($cat_names_filtered) && is_array($cat_names_filtered)) {
                    echo '<ul class="c-post__categories c-categories">';
                    foreach ($cat_names_filtered as $category) {
                        
                            printf(
                                '<li class="c-categories__category --category-%1$s">%1$s</li>',
                                $category
                            );
                    }
                    echo '</ul>';
                }
                ?>
            </div>

            <div class="c-post__content o-col-12 o-col-md-5">
                <?php if (!empty($text)) { ?>
                    <div class="c-post__text c-wysiwyg"><?php echo $text; ?></div>
                <?php } ?>
                <div class="c-post__infos">
                    <dl class="c-post__info">
                        <dt class="c-post__info-label">Technologien</dt>
                        <dd class="c-post__info-value"><?php echo implode( ', ', $technologies ); ?></dd>
                    </dl>
                    <dl class="c-post__info">
                        <dt class="c-post__info-label">Rolle</dt>
                        <dd class="c-post__info-value"><?php echo implode( ', ', $roles ); ?></dd>
                    </dl>
                </div>
                <?php if (!empty($link['url'])) { ?>
                    <a class="c-post__link c-button" href="<?php echo esc_url($link['url']); ?>" target="_blank" rel="noopener noreferrer">Link zum Projekt</a>
                <?php } ?>
            </div>
        </div>

        <?php if (!empty($screenshots)) { ?>
            <div class="c-post__visuals o-row --position-center">
                <?php while (!empty($screens) || !empty($fulls)) {
                    if (!empty($screens)) {
                        $screenshot = array_shift($screens);
                        ?>
                        <div class="c-post__visual-wrapper --screen o-col-12">
                            <div class="c-post__visual">
                                <?php
                                get_picture($screenshot['image'], [
                                    'additionalPictureClass' => 'c-post__visual-picture',
                                    'additionalImageClass'   => 'c-post__visual-image'
                                ]);
                                ?>
                            </div>
                        </div>
                    <?php } ?>

                    <?php for ($i = 0; $i < 2; $i++) {
                        if (empty($fulls)) break;
                        $screenshot = array_shift($fulls);
                        ?>
                        <div class="c-post__visual-wrapper --full o-col-12 o-col-md-6">
                            <div class="c-post__visual">
                                <?php
                                get_picture($screenshot['image'], [
                                    'additionalPictureClass' => 'c-post__visual-picture',
                                    'additionalImageClass'   => 'c-post__visual-image'
                                ]);
                                ?>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</article>