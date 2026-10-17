document.addEventListener('click', (event) => {
    const toggle = event.target.closest('[data-password-toggle]');

    if (!toggle) {
        return;
    }

    const input = toggle
        .closest('.password-wrapper')
        ?.querySelector('input');

    if (!input) {
        return;
    }

    const shouldShow = input.type === 'password';

    input.type = shouldShow ? 'text' : 'password';

    toggle.classList.toggle('is-visible', shouldShow);
    toggle.setAttribute('aria-pressed', String(shouldShow));
    toggle.setAttribute(
        'aria-label',
        shouldShow ? 'Ẩn mật khẩu' : 'Hiện mật khẩu'
    );
});