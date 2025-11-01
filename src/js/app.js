// Menu
(() => {
    const btn = document.querySelector('.c-main-nav__button');
    const nav = document.querySelector('.c-main-nav');
    const menu = document.querySelector('.c-main-nav__list');

    if (!btn || !nav || !menu) return;

    const label = btn.querySelector('.c-main-nav__button-label');
    const openText = label?.dataset.openText  || 'Hauptmenü öffnen';
    const closeText = label?.dataset.closeText || 'Hauptmenü schließen';

    const mqMobile = window.matchMedia('(max-width: 991.98px)');

    const menuFocusability = () => {
        const isOpen = nav.classList.contains('--open');
        if (!isOpen && mqMobile.matches) {
            menu.setAttribute('inert', '');
        } else {
            menu.removeAttribute('inert');
        }
    };

    const openMenu = () => {
        nav.classList.add('--open');
        btn.setAttribute('aria-expanded', 'true');
        if (label) label.textContent = closeText;
        document.body.classList.add('u-overflow-hidden');
        document.querySelectorAll('body > *:not(.c-header)').forEach(el => el.setAttribute('inert', ''));
        menuFocusability();
        const firstLink = menu.querySelector('a, button, [tabindex]:not([tabindex="-1"])');
        firstLink?.focus({ preventScroll: true });
    };

    const closeMenu = () => {
        nav.classList.remove('--open');
        btn.setAttribute('aria-expanded', 'false');
        if (label) label.textContent = openText;
        document.body.classList.remove('u-overflow-hidden');
        document.querySelectorAll('body > *[inert]').forEach(el => el.removeAttribute('inert'));
        btn.focus({ preventScroll: true });
        menuFocusability();
    };

    btn.addEventListener('click', () => {
        nav.classList.contains('--open') ? closeMenu() : openMenu();
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && nav.classList.contains('--open')) {
            e.preventDefault();
            closeMenu();
        }
    });

    mqMobile.addEventListener('change', menuFocusability);
    window.addEventListener('resize', closeMenu);
    window.addEventListener('orientationchange', closeMenu);

    menuFocusability();
})();
