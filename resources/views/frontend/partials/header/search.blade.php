{{--
Ô tìm kiếm của header. Được include trong header.blade.php:
    @include('frontend.partials.header.search')

- data-* để search.js (JS thuần) lấy URL mà không cần nhúng Blade vào .js
- Kết quả dropdown được render từ search-results.blade.php (controller: ProductsController@ajax)
- Giữ nguyên các id: key, searchBtn, searchResults và class: search-container
--}}
<div class="search-container" data-search-url="{{ route('products.search') }}"
    data-ajax-search-url="{{ route('products.ajax-search') }}">
    <div class="search-wrapper" role="search">
        <input type="text" id="key" class="search-input" placeholder="Tìm kiếm sản phẩm..." autocomplete="off"
            aria-label="Tìm kiếm sản phẩm">
        <button class="search-btn" type="button" id="searchBtn" aria-label="Tìm kiếm">
            <i class="fa fa-search"></i>
        </button>
    </div>
    <div id="searchResults" class="search-results" style="display:none;"></div>
</div>