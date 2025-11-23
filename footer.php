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

    <footer id="footer" class="c-footer">
        <div class="c-footer__container o-container">
            <div class="c-footer__top">
                <div class="c-footer__social-media u-position-relative">
                    <div class="c-handwritten --footer">
                        <?php get_icon('handwritten-arrow-right', true, ['class' => 'c-handwritten__icon',]); ?>
                        <span class="c-handwritten__text">Links zu CodePen, GitHub, LinkedIn,...</span>
                    </div>
                    <ul class="c-footer__links c-button-group">
                        <li class="c-button-group__list-item">
                            <a class="c-button-group__item c-icon-button" href="https://codepen.io/mradermaker/" target="_blank" rel="noopener noreferrer">
                                <?php get_icon('codepen', true, ['class' => 'c-icon-button__icon']); ?>
                                <span class="c-icon-button__text u-screen-reader-only">CodePen</span>
                            </a>
                        </li>
                        <li class="c-button-group__list-item">
                            <a class="c-button-group__item c-icon-button" href="https://github.com/mradermaker/" target="_blank" rel="noopener noreferrer">
                                <?php get_icon('github', true, ['class' => 'c-icon-button__icon']); ?>
                                <span class="c-icon-button__text u-screen-reader-only">GitHub</span>
                            </a>
                        </li>
                        <li class="c-button-group__list-item">
                            <a class="c-button-group__item c-icon-button" href="https://www.xing.com/profile/Monika_Radermaker" target="_blank" rel="noopener noreferrer">
                                <?php get_icon('linkedin', true, ['class' => 'c-icon-button__icon']); ?>
                                <span class="c-icon-button__text u-screen-reader-only">linkedin</span>
                            </a>
                        </li>
                        <li class="c-button-group__list-item">
                            <a class="c-button-group__item c-icon-button" href="https://www.linkedin.com/in/monika-radermaker/" target="_blank" rel="noopener noreferrer">
                                <?php get_icon('xing', true, ['class' => 'c-icon-button__icon']); ?>
                                <span class="c-icon-button__text u-screen-reader-only">Xing</span>
                            </a>
                        </li>
                    </ul>
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
                        'items_wrap'		=>'<ul id="%1$s" class="%2$s">%3$s</ul>',
                        'walker'			=> '',
                    ]); ?>
                </nav>
            </div>
        </div>
    </footer>

<?php wp_footer(); ?>

</body>
</html>
