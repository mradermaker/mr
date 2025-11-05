<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package mr
 */

// Content
$headline = get_field('headline') ?? null;
$text = get_field('text') ?? null;
?>

<?php if (!empty($headline) || !empty($text)) { ?>       
    <section class="c-text">
        <div class="c-text__container o-section o-container">
            <div class="c-text__row o-row">
                <div class="c-text__content o-col-12 o-col-xl-8">
                    <?php if (!empty($headline)) { ?>
                        <h1 class="c-text__headline c-headline"><?php echo $headline; ?></h1>
                    <?php } ?>
                    <?php if (!empty($text)) { ?>
                        <div class="c-text__text c-wysiwyg"><?php echo $text; ?></div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
<?php } ?>