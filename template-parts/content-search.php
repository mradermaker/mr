<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package mr
 */

$post_id = get_the_ID() ?? null;
$post_link = esc_url(get_permalink($post_id)) ?? null;
$post_title = get_the_title() ?? null;

$role = $args['role'] ?? null;
?>

<article class="c-search-card" <?php echo $role ? 'role="' . esc_attr($role) . '"' : ''; ?>>
    <?php if (!empty($post_link)) { ?>
		<h2 class="c-search-card__title"><a class="c-search-card__link" href="<?php echo $post_link; ?>"><?php echo esc_html($post_title); ?></a></h2>
		<p class="c-search-card__type c-categories"><span class="c-categories__category"><?php echo get_post_type_object( get_post_type() )->labels->singular_name; ?></span></p>
	<?php } ?>
</article>