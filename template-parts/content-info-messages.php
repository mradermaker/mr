<?php
/**
 * Template part for info messages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package mr
 */
?>

<?php
$messages = get_login_messages();

foreach ($messages as $message) {
    $type = $message['type']; // error | success | info
    $text = $message['text'];
    $role = ($type === 'error') ? 'alert' : 'status';
    $aria = ($type === 'error') ? 'assertive' : 'polite';
    ?>
    <!--
    <p class="c-info-messages --is-error" role="alert" aria-live="assertive" hidden></p>
    <p class="c-info-messages" role="status" aria-live="polite" hidden></p>
    -->
    <p id="status" class="c-info-messages --is-<?php echo esc_attr($type); ?>" role="<?php echo esc_attr($role); ?>" aria-live="<?php echo esc_attr($aria); ?>">
        <?php get_icon($type, true, ['class' => 'c-info-messages__icon']); ?>
        <?php echo esc_html($text); ?>
    </p>
<?php } ?>