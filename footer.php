<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package mr
 */

?>

    <footer class="c-footer">
        <div class="c-footer__container o-container">
            <div class="c-footer__top">
                <div class="c-footer__logo u-position-relative">
                    <span class="c-header__text">MR</span>
                    <div class="c-handwritten --footer">
                        <?php get_icon('handwritten-arrow-right', true, ['class' => 'c-handwritten__icon --arrow-down',]); ?>
                        <span class="c-handwritten__text">Logo <span class="u-screen-reader-only">(Platzhalter)</span></span>
                    </div>
                </div>
            </div>
            <div class="c-footer__bottom">
                <p class="c-footer__copyright">
                    monika-radermaker.de &copy; <?php echo date('Y',); ?>
                </p>
                <nav id="footer-nav" class="c-footer__nav c-footer-nav" aria-label="<?php echo esc_html_e('Footer-Navigation', 'mr',); ?>" role="navigation">
                    <?php wp_nav_menu([
                        'theme_location'	=> 'footer-nav',
                        'menu_class'		=> 'c-footer-nav__list',
                        'container'			=> false,
                        'before'			=> '',
                        'after'				=> '',
                        'link_before'		=> '',
                        'link_after'		=> '',
                        'items_wrap'		=>'<ul id="%1$s" class="%2$s" role="menu">%3$s</ul>',
                        'walker'			=> '',
                    ]); ?>
                </nav>
            </div>
        </div>
    </footer>

<?php wp_footer(); ?>

</body>
</html>
