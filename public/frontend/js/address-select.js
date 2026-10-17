document.addEventListener('DOMContentLoaded', () => {
    const root = document.querySelector('[data-address-select]');

    if (!root) {
        return;
    }

    const WARD_PLACEHOLDER = 'Phường / Xã';

    const provinceSelect = root.querySelector('[data-province-select]');
    const wardSelect = root.querySelector('[data-ward-select]');
    const wardsUrlTemplate = root.dataset.wardsUrl;

    // Chống race condition khi người dùng đổi tỉnh liên tục
    let latestRequest = 0;

    const setWardOptions = (wards, selectedCode = '') => {
        wardSelect.replaceChildren(new Option(WARD_PLACEHOLDER, ''));

        wards.forEach(({ code, name }) => {
            const isSelected = String(code) === String(selectedCode);

            wardSelect.add(new Option(name, code, false, isSelected));
        });
    };

    const resetWards = () => {
        latestRequest++;
        setWardOptions([]);
        wardSelect.disabled = true;
    };

    const loadWards = async (provinceCode, selectedCode = '') => {
        const requestId = ++latestRequest;

        wardSelect.disabled = true;
        wardSelect.replaceChildren(new Option('Đang tải...', ''));

        try {
            const response = await fetch(
                wardsUrlTemplate.replace('__CODE__', provinceCode),
                { headers: { Accept: 'application/json' } }
            );

            if (!response.ok) {
                throw new Error(`HTTP ${response.status}`);
            }

            const wards = await response.json();

            if (requestId !== latestRequest) {
                return;
            }

            setWardOptions(wards, selectedCode);
            wardSelect.disabled = false;
        } catch (error) {
            if (requestId !== latestRequest) {
                return;
            }

            wardSelect.replaceChildren(
                new Option('Không tải được, vui lòng thử lại', '')
            );
        }
    };

    provinceSelect.addEventListener('change', () => {
        if (provinceSelect.value) {
            loadWards(provinceSelect.value);
        } else {
            resetWards();
        }
    });

    // Khôi phục lựa chọn khi form bị lỗi validate và trang load lại
    if (provinceSelect.value) {
        loadWards(provinceSelect.value, wardSelect.dataset.old);
    }
});