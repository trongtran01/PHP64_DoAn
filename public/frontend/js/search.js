/**
 * Search dropdown ở header.
 * - Debounce 250ms, hủy request cũ khi gõ tiếp (không bị kết quả "nhảy lùi")
 * - Cache kết quả theo từ khóa
 * - Điều hướng bằng bàn phím: ↑ ↓ Enter Esc
 * - Server trả về HTML đã render từ search-results.blade.php
 */
document.addEventListener('DOMContentLoaded', () => {
    const container = document.querySelector('.search-container');
    const input = document.getElementById('key');
    const results = document.getElementById('searchResults');
    const searchBtn = document.getElementById('searchBtn');

    if (!container || !input || !results) return;

    const searchUrl = container.dataset.searchUrl;
    const ajaxSearchUrl = container.dataset.ajaxSearchUrl;
    const DEBOUNCE_MS = 250;
    const CACHE_LIMIT = 30;

    const cache = new Map();
    let debounceTimer = null;
    let controller = null;
    let activeIndex = -1;

    const getItems = () => Array.from(results.querySelectorAll('.sr-item, .sr-footer'));

    const setActive = (index) => {
        const items = getItems();
        items.forEach((el) => el.classList.remove('is-active'));
        activeIndex = index;
        if (index >= 0 && items[index]) {
            items[index].classList.add('is-active');
            items[index].scrollIntoView({ block: 'nearest' });
        }
    };

    const open = () => {
        results.style.display = 'block';
    };

    const close = () => {
        results.style.display = 'none';
        setActive(-1);
    };

    const render = (html) => {
        results.innerHTML = html;
        activeIndex = -1;
        open();
    };

    const goToSearchPage = () => {
        const key = input.value.trim();
        if (key !== '') {
            window.location.href = `${searchUrl}?key=${encodeURIComponent(key)}`;
        }
    };

    const runSearch = async () => {
        const key = input.value.trim();

        if (key === '') {
            if (controller) controller.abort();
            results.innerHTML = '';
            close();
            return;
        }

        if (cache.has(key)) {
            render(cache.get(key));
            return;
        }

        if (controller) controller.abort();
        const currentController = new AbortController();
        controller = currentController;

        results.classList.add('is-loading');
        if (results.innerHTML.trim() === '') {
            results.innerHTML = '<div class="sr-state"><i class="fas fa-spinner fa-spin"></i>Đang tìm kiếm...</div>';
        }
        open();

        try {
            const res = await fetch(`${ajaxSearchUrl}?key=${encodeURIComponent(key)}`, {
                signal: currentController.signal,
                headers: { 'X-Requested-With': 'XMLHttpRequest' },
            });
            if (!res.ok) throw new Error(`HTTP ${res.status}`);

            const html = await res.text();
            if (cache.size >= CACHE_LIMIT) cache.clear();
            cache.set(key, html);
            render(html);
        } catch (err) {
            if (err.name === 'AbortError') return;
            console.error('Search error:', err);
            close();
        } finally {
            if (controller === currentController) {
                results.classList.remove('is-loading');
            }
        }
    };

    // Gõ / dán / xóa (cũng chạy đúng với bộ gõ tiếng Việt)
    input.addEventListener('input', () => {
        clearTimeout(debounceTimer);
        if (input.value.trim() === '') {
            runSearch();
            return;
        }
        debounceTimer = setTimeout(runSearch, DEBOUNCE_MS);
    });

    input.addEventListener('keydown', (e) => {
        const isOpen = results.style.display === 'block';
        const items = getItems();

        switch (e.key) {
            case 'ArrowDown':
                if (!isOpen || items.length === 0) return;
                e.preventDefault();
                setActive(activeIndex + 1 >= items.length ? 0 : activeIndex + 1);
                break;

            case 'ArrowUp':
                if (!isOpen || items.length === 0) return;
                e.preventDefault();
                setActive(activeIndex <= 0 ? items.length - 1 : activeIndex - 1);
                break;

            case 'Enter':
                // Đang gõ dở bộ gõ tiếng Việt thì không submit
                if (e.isComposing) return;
                e.preventDefault();
                if (isOpen && activeIndex >= 0 && items[activeIndex]) {
                    window.location.href = items[activeIndex].href;
                } else {
                    goToSearchPage();
                }
                break;

            case 'Escape':
                close();
                break;
        }
    });

    // Bấm lại vào ô tìm kiếm thì mở lại kết quả đang có
    input.addEventListener('focus', () => {
        if (input.value.trim() !== '' && results.innerHTML.trim() !== '') {
            open();
        }
    });

    searchBtn?.addEventListener('click', goToSearchPage);

    document.addEventListener('click', (e) => {
        if (!container.contains(e.target)) {
            close();
        }
    });
});