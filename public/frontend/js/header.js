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

    // ---- Search (debounced ajax + submit) ----
    const searchContainer = document.querySelector('.search-container');
    const searchInput = document.getElementById('key');
    const searchResults = document.getElementById('searchResults');

    if (!searchContainer || !searchInput || !searchResults) return;

    const searchUrl = searchContainer.dataset.searchUrl;
    const ajaxSearchUrl = searchContainer.dataset.ajaxSearchUrl;
    let debounceTimer;

    const goToSearchPage = () => {
        const key = searchInput.value.trim();
        if (key !== '') {
            window.location.href = `${searchUrl}?key=${encodeURIComponent(key)}`;
        }
    };

    const runAjaxSearch = () => {
        const key = searchInput.value.trim();
        if (key === '') {
            searchResults.style.display = 'none';
            return;
        }
        searchResults.style.display = 'block';
        fetch(`${ajaxSearchUrl}?key=${encodeURIComponent(key)}`)
            .then((res) => res.text())
            .then((html) => { searchResults.innerHTML = html; })
            .catch((err) => {
                console.error('Search error:', err);
                searchResults.style.display = 'none';
            });
    };

    searchInput.addEventListener('keyup', (e) => {
        if (e.key === 'Enter') {
            goToSearchPage();
            return;
        }
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(runAjaxSearch, 300);
    });

    document.getElementById('searchBtn')?.addEventListener('click', goToSearchPage);

    document.addEventListener('click', (e) => {
        if (!searchContainer.contains(e.target)) {
            searchResults.style.display = 'none';
        }
    });
});