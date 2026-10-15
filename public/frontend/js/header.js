// Header: chỉ còn phần mobile menu.
// Logic tìm kiếm đã được tách sang search.js
document.addEventListener('DOMContentLoaded', () => {
    // ---- Mobile menu ----
    const burgerBtn = document.getElementById('burgerBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    const closeBtn = document.getElementById('closeMobileMenu');
    const backdrop = document.getElementById('mobileMenuBackdrop');

    const openMobileMenu = () => {
        mobileMenu.classList.add('active');
        backdrop?.classList.add('active');
        document.body.classList.add('mobile-menu-open');
    };

    const closeMobileMenu = () => {
        mobileMenu.classList.remove('active');
        backdrop?.classList.remove('active');
        document.body.classList.remove('mobile-menu-open');
    };

    burgerBtn?.addEventListener('click', openMobileMenu);
    closeBtn?.addEventListener('click', closeMobileMenu);
    backdrop?.addEventListener('click', closeMobileMenu);

    document.querySelectorAll('.mobile-has-dropdown').forEach((item) => {
        item.querySelector('.dropdown-toggle-mobile')?.addEventListener('click', (e) => {
            e.preventDefault();
            item.classList.toggle('open');
        });
    });
});