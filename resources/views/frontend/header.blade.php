<!-- Phần trên cùng -->
<div class="top-bar">
    <div class="container">
        <div class="top-bar-content">
            <div class="opening-hours">
                <i class="far fa-clock"></i>
                <span>Giờ mở cửa: 8:00 - 20:00</span>
            </div>
            
            <div class="search-container">
                <div class="search-wrapper">
                    <input type="text" 
                           id="key" 
                           class="search-input" 
                           placeholder="Tìm kiếm sản phẩm..."
                           onkeyup="ajaxSearch();" 
                           onkeypress="searchForm(event);">
                    <button class="search-btn" 
                            onclick="location.href='{{ url('products/search') }}?key='+document.getElementById('key').value;">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
                <div id="searchResults" class="search-results"></div>
            </div>
        </div>
    </div>
</div>

<!-- Header chính -->
<header class="main-header">
    <div class="container">
        <div class="header-content">
            <!-- MOBILE MENU -->
            <div class="mobile-menu" id="mobileMenu">

                <div class="mobile-menu-header">
                    <span>MENU</span>
                    <button id="closeMobileMenu"><i class="fas fa-times"></i></button>
                </div>

                @php
                    // nếu bạn đã load $categories ở chỗ khác thì đoạn này sẽ trả về cùng dữ liệu,
                    // nếu chưa thì nó sẽ query trực tiếp (tạm thời ok, nhưng nên đưa vào controller)
                    $categories = isset($categories) ? $categories : DB::table('categories')
                        ->where('parent_id', 0)
                        ->orderBy('id', 'desc')
                        ->get();
                @endphp

                <ul class="mobile-menu-list">

                    <li><a href="{{ asset('') }}">Trang chủ</a></li>
                    <li><a href="{{ asset('introduce') }}">Về chúng tôi</a></li>

                    <li class="mobile-has-dropdown">
                        <a class="dropdown-toggle-mobile">Sản phẩm <i class="fas fa-chevron-down"></i></a>

                        @if(isset($categories) && $categories->count() > 0)
                        <ul class="mobile-submenu">
                            @foreach($categories as $row)
                                <li>
                                    <a href="{{ url('products/category/'.$row->id) }}">{{ $row->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                        @endif
                    </li>

                    <li><a href="{{ asset('news') }}">Tin tức</a></li>
                    <li><a href="{{ asset('contact') }}">Tìm hiểu thêm</a></li>

                    <!-- User section -->
                    @if(isset($customer_email))
                    <li><a href="{{ url('customers/profile') }}">Tài khoản</a></li>
                    <li><a href="{{ url('customers/logout') }}">Đăng xuất</a></li>
                    @else
                    <li><a href="{{ url('customers/login') }}">Đăng nhập</a></li>
                    @endif

                </ul>
            </div>

            <!-- Logo -->
            <div class="logo">
                <img src="{{ asset('frontend/images/logo.png') }}" alt="Logo">
            </div>

            <!-- Navigation -->
            <nav class="main-nav">
                <ul class="nav-list">
                    <li class="nav-item">
                        <a href="{{ asset('') }}" class="nav-link">TRANG CHỦ</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ asset('introduce') }}" class="nav-link">VỀ CHÚNG TÔI</a>
                    </li>
                    <li class="nav-item has-dropdown">
                        <a href="#" class="nav-link">
                            SẢN PHẨM
                            <i class="fas fa-chevron-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                            @php
                                $categories = DB::table("categories")->where("parent_id","=",0)->orderBy("id", "desc")->get();
                            @endphp
                            @foreach($categories as $row)
                            <li class="dropdown-item has-submenu">
                                <a href="{{ url('products/category/'.$row->id) }}">{{ $row->name }}</a>
                                @php
                                    $subCategories = DB::table("categories")->where("parent_id","=",$row->id)->orderBy("id", "desc")->get();
                                @endphp
                                @if(isset($subCategories) && count($subCategories) > 0)
                                    <ul class="submenu">
                                        @foreach($subCategories as $subRow)
                                            <li><a href="{{ url('products/category/'.$subRow->id) }}">{{ $subRow->name }}</a></li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ asset('news') }}" class="nav-link">TIN TỨC</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ asset('contact') }}" class="nav-link">TÌM HIỂU THÊM</a>
                    </li>
                </ul>
            </nav>

            <!-- User Actions -->
            <div class="header-actions">
                <div class="mobile-burger">
                    <button id="burgerBtn"><i class="fas fa-bars"></i></button>
                </div>

                @php
                    $customer_email = session()->get('customer_email');
                    $customer_name = session()->get('customer_name');
                @endphp
                
                <div class="user-menu">
                    @if(isset($customer_email))
                        <div class="user-dropdown">
                            <button class="user-btn">
                                <i class="far fa-user-circle"></i>
                                <span>{{ $customer_name ?? $customer_email }}</span>
                            </button>
                            <div class="user-dropdown-content">
                                <a href="{{ url('customers/profile') }}">Tài khoản</a>
                                <a href="{{ url('customers/logout') }}">Đăng xuất</a>
                            </div>
                        </div>
                    @else
                        <a href="{{ url('customers/login') }}" class="auth-btn">
                            <i class="far fa-user"></i>
                            <span>Đăng nhập</span>
                        </a>
                    @endif
                </div>

                <?php use App\Http\ShoppingCart\Cart; ?>
                @if(Cart::cartNumber() > 0)
                <div class="cart-menu">
                    <a href="{{ asset('cart') }}" class="cart-btn">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="cart-badge">{{ Cart::cartNumber() }}</span>
                    </a>
                    <div class="cart-dropdown">
                        <div class="cart-header">
                            <h3>Giỏ hàng của bạn</h3>
                        </div>
                        <div class="cart-items">
                            @php $cart = Cart::cartList(); @endphp
                            @foreach($cart as $product)
                            <div class="cart-item">
                                <div class="cart-item-image">
                                    <img src="{{ asset('upload/products/'.$product['photo']) }}" 
                                         alt="{{ $product['name'] }}">
                                </div>
                                <div class="cart-item-info">
                                    <a href="{{ url('products/detail/'.$product['id']) }}" class="cart-item-name">
                                        {{ $product['name'] }}
                                    </a>
                                    <p class="cart-item-price">
                                        {{ $product['quantity'] }} × {{ number_format($product['price']) }}₫
                                    </p>
                                </div>
                                <a href="{{ url('cart/delete/'.$product['id']) }}" class="cart-item-remove">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                            @endforeach
                        </div>
                        <div class="cart-footer">
                            <a href="{{ url('cart/order') }}" class="checkout-btn">Thanh toán</a>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</header>

<!-- Features Section -->
<section class="features-section">
    <div class="container">
        <div class="features-grid">
            <div class="feature-item">
                <div class="feature-icon">
                    <i class="fas fa-shipping-fast"></i>
                </div>
                <div class="feature-content">
                    <h3>Miễn phí vận chuyển</h3>
                    <p>Trong bán kính 50km</p>
                </div>
            </div>
            
            <div class="feature-item">
                <div class="feature-icon">
                    <i class="fas fa-sync-alt"></i>
                </div>
                <div class="feature-content">
                    <h3>Đổi trả miễn phí</h3>
                    <p>Trong vòng 24 giờ</p>
                </div>
            </div>
            
            <div class="feature-item">
                <div class="feature-icon">
                    <i class="fas fa-credit-card"></i>
                </div>
                <div class="feature-content">
                    <h3>Thanh toán đa dạng</h3>
                    <p>Đa dạng phương thức thanh toán</p>
                </div>
            </div>
            
            <div class="feature-item">
                <div class="feature-icon">
                    <i class="fas fa-headset"></i>
                </div>
                <div class="feature-content">
                    <h3>Hỗ trợ 24/7</h3>
                    <p>Hotline:</p>
                    <strong>0965 814 299</strong>
                </div>
            </div>
        </div>
    </div>
</section>


<style>
  /* Import Google Fonts */
@import url('https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@300;400;500;600;700&display=swap');

/* Hoặc Inter */
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

/* Áp dụng */
* {
    font-family: 'Be Vietnam Pro', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
}
:root {
    --primary-color: #242052;
    --secondary-color: #5B4FE0;
    --accent-color: #7C71FF;
    --light-purple: #E8E6FF;
    --success-color: #10B981;
    --text-dark: #1F2937;
    --text-light: #6B7280;
    --border-color: #E5E7EB;
    --white: #FFFFFF;
    --shadow-sm: 0 2px 4px rgba(36, 32, 82, 0.05);
    --shadow-md: 0 4px 12px rgba(36, 32, 82, 0.1);
    --shadow-lg: 0 10px 30px rgba(36, 32, 82, 0.15);
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

/* Top Bar */
.top-bar {
    background: var(--primary-color);
    color: var(--white);
    padding: 10px 0;
    font-size: 14px;
}

.top-bar-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
}

.opening-hours {
    display: flex;
    align-items: center;
    gap: 8px;
}

.opening-hours i {
    color: var(--accent-color);
}

/* Search Container */
.search-container {
    position: relative;
    flex: 0 0 400px;
}

.search-wrapper {
    display: flex;
    background: rgba(255, 255, 255, 0.15);
    border-radius: 25px;
    overflow: hidden;
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: all 0.3s ease;
}

.search-wrapper:focus-within {
    background: rgba(255, 255, 255, 0.25);
    border-color: var(--accent-color);
    box-shadow: 0 0 0 3px rgba(124, 113, 255, 0.2);
}

.search-input {
    flex: 1;
    padding: 10px 20px;
    border: none;
    background: transparent;
    color: var(--white);
    font-size: 14px;
    outline: none;
}

.search-input::placeholder {
    color: rgba(255, 255, 255, 0.6);
}

.search-btn {
    padding: 0 20px;
    background: var(--secondary-color);
    border: none;
    color: var(--white);
    cursor: pointer;
    transition: all 0.3s ease;
}

.search-btn:hover {
    background: var(--accent-color);
}

/* Search Results */
.search-results {
    position: absolute;
    top: calc(100% + 10px);
    left: 0;
    right: 0;
    background: var(--white);
    border-radius: 12px;
    box-shadow: var(--shadow-lg);
    max-height: 400px;
    overflow-y: auto;
    z-index: 1000;
    display: none;
}

.search-results:not(:empty) {
    display: block;
}

.search-results ul {
    list-style: none;
}

.search-results li {
    padding: 12px 16px;
    border-bottom: 1px solid var(--border-color);
    display: flex;
    align-items: center;
    gap: 12px;
    transition: background 0.2s ease;
}

.search-results li:hover {
    background: var(--light-purple);
}

.search-results img {
    width: 50px;
    height: 50px;
    object-fit: cover;
    border-radius: 8px;
}

.search-results a {
    color: var(--text-dark);
    text-decoration: none;
    font-size: 14px;
    flex: 1;
}

/* Main Header */
.main-header {
    background: var(--white);
    box-shadow: var(--shadow-lg);
    position: sticky;
    top: 0;
    z-index: 999;
}

.header-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 20px 0;
    gap: 40px;
}

.logo img {
    height: 50px;
    width: auto;
}

/* Navigation */
.main-nav {
    flex: 1;
}

.nav-list {
    display: flex;
    list-style: none;
    gap: 5px;
}

.nav-item {
    position: relative;
}

.nav-link {
    display: flex;
    align-items: center;
    gap: 5px;
    padding: 10px 18px;
    color: var(--text-dark);
    text-decoration: none;
    font-weight: 600;
    font-size: 14px;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.nav-link:hover {
    background: var(--light-purple);
    color: var(--primary-color);
}

.nav-link i {
    font-size: 10px;
}

/* Dropdown Menu */
.dropdown-menu {
    position: absolute;
    top: 100%;
    left: 0;
    min-width: 300px;
    background: var(--white);
    border-radius: 12px;
    box-shadow: var(--shadow-lg);
    padding: 8px;
    list-style: none;
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: all 0.3s ease;
}

.has-dropdown:hover .dropdown-menu {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.dropdown-item {
    position: relative;
}

.dropdown-item > a {
    display: block;
    padding: 10px 16px;
    color: var(--text-dark);
    text-decoration: none;
    border-radius: 8px;
    transition: all 0.2s ease;
}

.dropdown-item > a:hover {
    background: var(--light-purple);
    color: var(--primary-color);
}

.submenu {
    position: absolute;
    left: 100%;
    top: 0;
    min-width: 200px;
    background: var(--white);
    border-radius: 12px;
    box-shadow: var(--shadow-lg);
    padding: 8px;
    list-style: none;
    opacity: 0;
    visibility: hidden;
    transform: translateX(-10px);
    transition: all 0.3s ease;
}

.has-submenu:hover .submenu {
    opacity: 1;
    visibility: visible;
    transform: translateX(0);
}

/* Header Actions */
.header-actions {
    display: flex;
    align-items: center;
    gap: 20px;
}

.auth-btn,
.user-btn {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    background: var(--primary-color);
    color: var(--white);
    border: none;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 600;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.auth-btn:hover,
.user-btn:hover {
    background: var(--secondary-color);
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

/* User Dropdown */
.user-dropdown {
    position: relative;
}

.user-dropdown-content {
    position: absolute;
    top: calc(100% + 10px);
    right: 0;
    min-width: 180px;
    background: var(--white);
    border-radius: 12px;
    box-shadow: var(--shadow-lg);
    padding: 8px;
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: all 0.3s ease;
}

.user-dropdown:hover .user-dropdown-content {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.user-dropdown-content a {
    display: block;
    padding: 10px 16px;
    color: var(--text-dark);
    text-decoration: none;
    border-radius: 8px;
    transition: all 0.2s ease;
}

.user-dropdown-content a:hover {
    background: var(--light-purple);
    color: var(--primary-color);
}

/* Cart Menu */
.cart-menu {
    position: relative;
}

.cart-btn {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 45px;
    height: 45px;
    background: var(--light-purple);
    color: var(--primary-color);
    border-radius: 50%;
    text-decoration: none;
    transition: all 0.3s ease;
}

.cart-btn:hover {
    background: var(--primary-color);
    color: var(--white);
    transform: scale(1.1);
}

.cart-badge {
    position: absolute;
    top: -5px;
    right: -5px;
    width: 22px;
    height: 22px;
    background: var(--accent-color);
    color: var(--white);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 11px;
    font-weight: bold;
    border: 2px solid var(--white);
}

/* Cart Dropdown */
.cart-dropdown {
    position: absolute;
    top: calc(100% + 15px);
    right: 0;
    width: 380px;
    background: var(--white);
    border-radius: 16px;
    box-shadow: var(--shadow-lg);
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: all 0.3s ease;
}

.cart-menu:hover .cart-dropdown {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.cart-header {
    padding: 20px;
    border-bottom: 2px solid var(--light-purple);
}

.cart-header h3 {
    color: var(--primary-color);
    font-size: 16px;
}

.cart-items {
    max-height: 350px;
    overflow-y: auto;
    padding: 10px;
}

.cart-item {
    display: flex;
    gap: 12px;
    padding: 12px;
    border-radius: 12px;
    transition: background 0.2s ease;
    margin-bottom: 8px;
}

.cart-item:hover {
    background: var(--light-purple);
}

.cart-item-image img {
    width: 70px;
    height: 70px;
    object-fit: cover;
    border-radius: 10px;
}

.cart-item-info {
    flex: 1;
}

.cart-item-name {
    display: block;
    color: var(--text-dark);
    text-decoration: none;
    font-weight: 600;
    font-size: 14px;
    margin-bottom: 5px;
    line-height: 1.4;
}

.cart-item-name:hover {
    color: var(--primary-color);
}

.cart-item-price {
    color: var(--secondary-color);
    font-weight: 700;
    font-size: 13px;
}

.cart-item-remove {
    display: flex;
    align-items: flex-start;
    justify-content: center;
    width: 30px;
    height: 30px;
    color: var(--text-light);
    transition: all 0.2s ease;
}

.cart-item-remove:hover {
    color: #EF4444;
}

.cart-footer {
    padding: 16px 20px;
    border-top: 2px solid var(--light-purple);
}

.checkout-btn {
    display: block;
    width: 100%;
    padding: 14px;
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    color: var(--white);
    text-align: center;
    text-decoration: none;
    border-radius: 12px;
    font-weight: 700;
    font-size: 15px;
    transition: all 0.3s ease;
}

.checkout-btn:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

/* Features Section */
.features-section {
    background: linear-gradient(135deg, var(--light-purple) 0%, rgba(232, 230, 255, 0.5) 100%);
    padding: 50px 0;
    margin-top: 1px;
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
}

.feature-item {
    display: flex;
    align-items: center;
    gap: 20px;
    padding: 25px;
    background: var(--white);
    border-radius: 16px;
    box-shadow: var(--shadow-sm);
    transition: all 0.3s ease;
}

.feature-item:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-md);
}

.feature-icon {
    flex-shrink: 0;
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    color: var(--white);
    border-radius: 50%;
    font-size: 24px;
}

.feature-content h3 {
    color: var(--primary-color);
    font-size: 16px;
    margin-bottom: 5px;
}

.feature-content p {
    color: var(--text-light);
    font-size: 13px;
    line-height: 1.5;
}

.feature-content strong {
    color: var(--secondary-color);
}

/* Scrollbar */
.cart-items::-webkit-scrollbar,
.search-results::-webkit-scrollbar {
    width: 6px;
}

.cart-items::-webkit-scrollbar-track,
.search-results::-webkit-scrollbar-track {
    background: var(--light-purple);
    border-radius: 10px;
}

.cart-items::-webkit-scrollbar-thumb,
.search-results::-webkit-scrollbar-thumb {
    background: var(--secondary-color);
    border-radius: 10px;
}

/* Responsive */
@media (max-width: 1024px) {
    .header-content {
        flex-wrap: wrap;
    }
    
    .main-nav {
        order: 3;
        flex: 1 1 100%;
    }
    
    .nav-list {
        justify-content: center;
    }
}

@media (max-width: 768px) {
    .top-bar-content {
        flex-direction: column;
        gap: 15px;
    }
    
    .search-container {
        flex: 1 1 100%;
        width: 100%;
    }
    
    .features-grid {
        grid-template-columns: 1fr;
    }
    
    .nav-list {
        flex-direction: column;
        text-align: center;
    }
    .features-section {
        padding: 20px 0;
    }
    .feature-item {
        gap: 10px;
        padding: 10px;
    }
}
/* =============== BURGER BUTTON =============== */
.mobile-burger {
    display: none;
}
.mobile-burger button {
    background: none;
    border: none;
    font-size: 26px;
    color: #242052;
    cursor: pointer;
}

/* SHOW BURGER ON MOBILE */
@media(max-width: 992px) {
    .main-nav,
    .header-actions .user-menu,
    .header-actions .cart-menu {
        display: none;
    }
    .mobile-burger {
        display: block;
    }
}

/* =============== MOBILE MENU =============== */
.mobile-menu {
    position: fixed;
    top: 0;
    left: -90%;
    width: 90%;
    height: 100vh;
    background: #ffffff;
    padding: 20px;
    transition: left .35s ease;
    z-index: 9999;
    border-right: 1px solid #000;
}
.mobile-menu.active {
    left: 0;
}

.mobile-menu-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
}
.mobile-menu-header span {
    font-size: 20px;
    font-weight: bold;
}
.mobile-menu-header button {
    background: none;
    border: none;
    font-size: 24px;
    cursor: pointer;
}

/* LINKS */
.mobile-menu-list {
    list-style: none;
    padding: 0;
    margin: 0;
}
.mobile-menu-list li {
    margin: 12px 0;
}
.mobile-menu-list a {
    font-size: 17px;
    text-decoration: none;
    color: #242052;
    display: block;
}

/* DROPDOWN */
.mobile-has-dropdown .dropdown-toggle-mobile {
    display: flex;
    justify-content: space-between;
    align-items: center;
    cursor: pointer;
}
.mobile-submenu {
    display: none;
    margin-left: 10px;
    list-style: none;
}
.mobile-submenu li a {
    font-size: 15px;
    color: #444;
}
.mobile-has-dropdown.open .mobile-submenu {
    display: block;
}

</style>

<script>
function searchForm(event) {
    if (event.which == 13 || event.keyCode == 13) {
        searchProducts();
    }
}

function searchProducts() {
    let key = document.getElementById('key').value.trim();
    if (key !== '') {
        location.href = '{{ url('products/search') }}?key=' + encodeURIComponent(key);
    }
}

function ajaxSearch() {
    let key = document.getElementById('key').value.trim();
    const searchResults = document.getElementById('searchResults');
    
    if (key !== '') {
        searchResults.style.display = 'block';
        
        fetch("{{ url('products/ajax-search') }}?key=" + encodeURIComponent(key))
            .then(response => response.text())
            .then(result => {
                searchResults.innerHTML = result;
            })
            .catch(error => {
                console.error('Search error:', error);
                searchResults.style.display = 'none';
            });
    } else {
        searchResults.style.display = 'none';
    }
}

// Close search results when clicking outside
document.addEventListener('click', function(event) {
    const searchContainer = document.querySelector('.search-container');
    const searchResults = document.getElementById('searchResults');
    
    if (searchContainer && !searchContainer.contains(event.target)) {
        searchResults.style.display = 'none';
    }
});
</script>
<script>
document.addEventListener("DOMContentLoaded", () => {

    const burgerBtn = document.getElementById("burgerBtn");
    const mobileMenu = document.getElementById("mobileMenu");
    const closeBtn = document.getElementById("closeMobileMenu");

    // mở menu
    burgerBtn.addEventListener("click", () => {
        mobileMenu.classList.add("active");
        document.body.style.overflow = "hidden"; // khóa scroll
    });

    // đóng menu
    closeBtn.addEventListener("click", () => {
        mobileMenu.classList.remove("active");
        document.body.style.overflow = "auto";
    });

    // dropdown cho mobile
    document.querySelectorAll(".mobile-has-dropdown").forEach(item => {
        item.querySelector(".dropdown-toggle-mobile").addEventListener("click", () => {
            item.classList.toggle("open");
        });
    });

});
</script>
