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
$text_more = get_field('text_more') ?? null;
$technologies = get_field('technology') ?? [];
$design = get_field('design') ?? [];
$roles = get_field('role') ?? [];
$link = get_field('link') ?? [];
$links = [];
for ($i = 1; $i <= 5; $i++) {
    $links_field = get_field("links_{$i}") ?? [];
    
    if (!empty($links_field['url'])) {
        $links["links_{$i}"] = [
            'link' => $links_field
        ];
    }
}
$up_to_date = get_field('up-to-date') ?? true;

// Mockup & Screenshots
$mockups = get_field('mockup');
$mockup_mobile = $mockups['mobile'];
$mockup_tablet = $mockups['tablet'];
$mockup_desktop = $mockups['desktop'];

$screenshots = [];
for ($i = 1; $i <= 10; $i++) {
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

// Case Studies
$case_studies = [];
for ($i = 1; $i <= 3; $i++) {
    $case_study_field = get_field("case_study_{$i}") ?? [];
    $case_study_headline = $case_study_field['headline'] ?? null;
    $case_study_text = $case_study_field['text'] ?? null;
    $case_study_images = [];
    for ($j = 1; $j <= 4; $j++) {
        if (!empty($case_study_field["screenshot_{$j}"]['image']['url'])) {
            $case_study_images["image_{$j}"] = $case_study_field["screenshot_{$j}"];
        }
    }

    $case_studies["case_study_{$i}"] = [
        'headline' => $case_study_headline,
        'text' => $case_study_text,
        'images' => $case_study_images,
    ];
}
?>

<article class="c-post" style="--color-project: <?php echo $color; ?>;">
    <div class="c-post__container o-container">
        <div class="c-post__row o-row --position-center">
            <div class="c-post__content o-col-12 o-col-md-6 o-col-xl-5">
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

            <div class="c-post__content o-col-12 o-col-md-6 o-col-xl-7">
                <?php if (!empty($text)) { ?>
                    <div class="c-post__text c-wysiwyg"><?php echo $text; ?></div>
                <?php } ?>
                <div class="c-post__infos">
                    <?php if (!empty($technologies)) { ?>
                        <dl class="c-post__info">
                            <dt class="c-post__info-label">Technologien</dt>
                            <dd class="c-post__info-value"><?php echo implode( ', ', $technologies ); ?></dd>
                        </dl>
                    <?php } ?>
                    <?php if (!empty($design)) { ?>
                        <dl class="c-post__info">
                            <dt class="c-post__info-label">Design</dt>
                            <dd class="c-post__info-value"><?php echo implode( ', ', $design ); ?></dd>
                        </dl>
                    <?php } ?>
                    <?php if (!empty($roles)) { ?>
                        <dl class="c-post__info">
                            <dt class="c-post__info-label">Rolle</dt>
                            <dd class="c-post__info-value"><?php echo implode( ', ', $roles ); ?></dd>
                        </dl>
                    <?php } ?>
                </div>
                <?php if (!empty($link['url'])) { ?>
                    <a class="c-post__link c-button" href="<?php echo esc_url($link['url']); ?>" target="_blank" rel="noopener noreferrer"><?php if (!empty($link['title'])) { echo $link['title']; } else { echo 'Link zur Website'; } ?></a>
                <?php } ?>

                <?php if (!$up_to_date) { ?>
                    <p class="c-post__disclaimer"><?php get_icon('info', true, ['class' => 'c-post__disclaimer-icon']); ?> <small class="c-post__disclaimer-text">Live-Version kann vom ursprünglichen Stand abweichen.</small></p>
                <?php } ?>
            </div>
        </div>

        <?php if (!empty($image['image']['url'])) { ?>
            <div class="c-post__visuals o-row">
                <div class="c-post__visual-wrapper --screen o-col-12">
                    <div class="c-post__visual">
                        <?php
                        get_picture($image['image'], [
                            'additionalPictureClass' => 'c-post__visual-picture',
                            'additionalImageClass'   => 'c-post__visual-image',
                            'size' => 'full',
                        ]);
                        ?>
                    </div>
                </div>
            </div>
        <?php } ?>
        
        <!-- <?php if (!empty($text_more)) { ?>
            <div class="c-post__row o-row --position-center">
                <div class="c-post__content o-col-12 o-col-xl-8">
                    <div class="c-post__text c-wysiwyg"><?php echo $text_more; ?></div>
                </div>
            </div>
        <?php } ?> -->

        <?php foreach ($case_studies as $case_study) { ?>
            <div class="c-post__case-studies o-row">
                <div class="c-post__content o-col-12 o-col-xl-8">
                    <?php if (!empty($case_study['headline'])) { ?>
                        <h2 class="c-post__headline c-headline"><?php echo $case_study['headline']; ?></h2>
                    <?php } ?>
                    <?php if (!empty($case_study['text'])) { ?>
                        <div class="c-post__text c-wysiwyg"><?php echo $case_study['text']; ?></div>
                    <?php } ?>
                </div>

                <div class="c-post__case-studies-wrapper o-col-12">
                    <?php
                    foreach ($case_study['images'] as $case) { ?>
                        <figure class="c-post__case-study">
                            <?php 
                            get_picture($case['image'], [
                                'additionalPictureClass' => 'c-post__case-study-picture',
                                'additionalImageClass'   => 'c-post__case-study-image'
                            ]);
                            ?>
                            <?php if (!empty($case['image']['description'])) { ?>
                                <figcaption class="c-post__visual-description"><?php echo $case['image']['description']; ?></figcaption>
                            <?php } ?>
                        </figure>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>

        <?php if (!empty($screenshots) || !empty($mockup_mobile['url']) || !empty($mockup_tablet['url']) || !empty($mockup_desktop['url'])) { ?>
            <div class="c-post__visuals o-row">
                <?php while (!empty($screens) || !empty($fulls)) {
                    for ($i = 0; $i < 2; $i++) {
                        if (empty($fulls)) break;
                        $screenshot = array_shift($fulls);
                        ?>
                        <figure class="c-post__visual-wrapper --full o-col-12 o-col-md-6">
                            <div class="c-post__visual">
                                <?php
                                get_picture($screenshot['image'], [
                                    'additionalPictureClass' => 'c-post__visual-picture',
                                    'additionalImageClass' => 'c-post__visual-image',
                                ]);
                                ?>
                            </div>
                            <?php if (!empty($screenshot['image']['description'])) { ?>
                                <figcaption class="c-post__visual-description"><?php echo $screenshot['image']['description']; ?></figcaption>
                            <?php } ?>
                        </figure>
                    <?php }

                    if (!empty($screens)) {
                        $screenshot = array_shift($screens);
                        ?>
                        <div class="c-post__visual-wrapper --screen o-col-12">
                            <figure class="c-post__visual">
                                <?php
                                get_picture($screenshot['image'], [
                                    'additionalPictureClass' => 'c-post__visual-picture',
                                    'additionalImageClass'   => 'c-post__visual-image',
                                    'size' => 'full',
                                ]);
                                ?>
                                <?php if (!empty($screenshot['image']['description'])) { ?>
                                    <figcaption class="c-post__visual-description"><?php echo $screenshot['image']['description']; ?></figcaption>
                                <?php } ?>
                            </figure>
                        </div>
                    <?php } ?>
                <?php } ?>

                <?php if (!empty($mockup_mobile['url']) || !empty($mockup_tablet['url']) || !empty($mockup_desktop['url'])) { ?>
                    <div class="c-post__mockups-wrapper o-col-12">
                        <div class="c-post__mockups">
                            <?php if (!empty($mockup_desktop['url'])) { ?>
                                <div class="c-post__mockup --desktop">
                                    <?php
                                    get_picture($mockup_desktop, [
                                        'additionalPictureClass' => 'c-post__mockup-picture',
                                        'additionalImageClass'   => 'c-post__mockup-image'
                                    ]);
                                    ?>
                                </div>
                            <?php } ?>
                            <?php if (!empty($mockup_mobile['url'])) { ?>
                                <div class="c-post__mockup --mobile">
                                    <?php
                                    get_picture($mockup_mobile, [
                                        'additionalPictureClass' => 'c-post__mockup-picture',
                                        'additionalImageClass'   => 'c-post__mockup-image'
                                    ]);
                                    ?>
                                </div>
                            <?php } ?>
                            <?php if (!empty($mockup_tablet['url'])) { ?>
                                <div class="c-post__mockup --tablet">
                                    <?php
                                    get_picture($mockup_tablet, [
                                        'additionalPictureClass' => 'c-post__mockup-picture',
                                        'additionalImageClass'   => 'c-post__mockup-image'
                                    ]);
                                    ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</article>