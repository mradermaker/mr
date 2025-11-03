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

// Validation
(() => {
    const forms = document.querySelectorAll('.c-form');

    if (!forms.length) return;

    const getErrorEl = (input) => {
        const id = input.getAttribute('aria-describedby');
        return id ? document.getElementById(id) : null;
    };

    const showError = (input) => {
        const errorEl = getErrorEl(input);
        if (!errorEl) return;
        errorEl.hidden = false;
        // errorEl.setAttribute('role', 'alert');
        errorEl.setAttribute('aria-live', 'polite');
        input.setAttribute('aria-invalid', 'true');
        input.classList.add('--error');
        input.classList.remove('--success');
    };

    const hideError = (input) => {
        const errorEl = getErrorEl(input);
        if (!errorEl) return;
        errorEl.hidden = true;
        // errorEl.removeAttribute('role');
        errorEl.removeAttribute('aria-live');
        input.removeAttribute('aria-invalid');
        input.classList.remove('--error');
        input.classList.add('--success');
    };

    const validateInput = (input) => {
        if (!input.checkValidity()) {
            showError(input);
            return false;
        }
        hideError(input);
        return true;
    };

    const jumpToFirstInvalid = (form) => {
        const firstInvalid = form.querySelector(':invalid');
        if (firstInvalid) {
            firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
            firstInvalid.focus({ preventScroll: true });
        }
    };

    forms.forEach((form) => {
        const inputs = form.querySelectorAll('input[required], textarea[required], select[required]');

        inputs.forEach((input) => {
            input.addEventListener('blur', () => validateInput(input));

            input.addEventListener('input', () => {
                if (input.checkValidity()) {
                    hideError(input);
                } else {
                    input.classList.remove('--success');
                }
            });

            if (input.checkValidity()) {
                input.classList.add('--success');
            }
        });

        form.addEventListener('submit', (e) => {
            let allValid = true;
            inputs.forEach((input) => {
                if (!validateInput(input)) allValid = false;
            });

            if (!allValid) {
                e.preventDefault();
                e.stopPropagation();
                jumpToFirstInvalid(form);
            }
        });
    });
})();