<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/search.css') }}">
    <script src="{{ asset('frontend/js/header.js') }}" defer></script>
    <script src="{{ asset('frontend/js/search.js') }}" defer></script>
</head>

<body>
    {{--
    $rootCategories, $categoriesByParent, $customerEmail, $customerName, $cartCount, $cartItems
    được App\View\Composers\HeaderComposer tự động cung cấp (đăng ký trong ViewServiceProvider).
    --}}

    {{-- TOP BAR: desktop = thanh thông báo mỏng. Mobile = giữ nguyên như cũ (giờ mở cửa + ô tìm kiếm). --}}
    <div class="top-bar">
        <div class="container">
            <div class="top-bar-content">
                <div class="opening-hours">
                    <i class="far fa-clock"></i>
                    <span>Giờ mở cửa: 8:00 - 20:00</span>
                </div>

                {{-- Chỉ hiện trên desktop --}}
                <div class="top-bar-info">
                    <span><i class="fas fa-shipping-fast"></i>Miễn phí vận chuyển trong bán kính 50km</span>
                    <span><i class="fas fa-headset"></i>Hotline: <strong>0965 814 299</strong></span>
                </div>

                {{-- Chỗ chứa ô tìm kiếm trên mobile (script bên dưới tự chuyển ô tìm kiếm vào đây khi < 993px) --}}
                <div class="top-bar-search-slot" id="topBarSearchSlot"></div>
            </div>
        </div>
    </div>

    <header class="main-header">
        <div class="container">
            <div class="header-content">

                {{-- Lớp phủ mờ phía sau menu, bấm vào để đóng (xử lý trong header.js) --}}
                <div class="mobile-menu-backdrop" id="mobileMenuBackdrop"></div>

                {{-- MOBILE MENU (giữ nguyên) --}}
                <div class="mobile-menu" id="mobileMenu">
                    <div class="mobile-menu-header">
                        <span>MENU</span>
                        <button id="closeMobileMenu" type="button"><i class="fas fa-times"></i></button>
                    </div>

                    @if($customerEmail)
                        <div class="mobile-menu-user">
                            <div class="mobile-menu-user-avatar"><i class="far fa-user"></i></div>
                            <div class="mobile-menu-user-info">
                                <div class="mobile-menu-user-greeting">Xin chào</div>
                                <div class="mobile-menu-user-name">{{ $customerName }}</div>
                            </div>
                        </div>
                    @endif

                    <ul class="mobile-menu-list">
                        <li><a href="{{ route('home') }}"><i class="fas fa-house menu-icon"></i>Trang chủ</a></li>
                        <li><a href="{{ route('introduce') }}"><i class="fas fa-circle-info menu-icon"></i>Về chúng
                                tôi</a></li>

                        <li class="mobile-has-dropdown">
                            <a class="dropdown-toggle-mobile" href="#">
                                <span class="toggle-label"><i class="fas fa-box menu-icon"></i>Sản phẩm</span>
                                <i class="fas fa-chevron-down chevron"></i>
                            </a>

                            @if($rootCategories->isNotEmpty())
                                <ul class="mobile-submenu">
                                    @foreach($rootCategories as $category)
                                        <li><a href="{{ route('products.category', $category->id) }}">{{ $category->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>

                        <li><a href="{{ route('news.index') }}"><i class="fas fa-newspaper menu-icon"></i>Tin tức</a>
                        </li>
                        <li><a href="{{ route('contact') }}"><i class="fas fa-envelope menu-icon"></i>Tìm hiểu thêm</a>
                        </li>

                        @if($customerEmail)
                            <li class="mobile-menu-divider"><a href="{{ route('customers.profile') }}"><i
                                        class="far fa-id-card menu-icon"></i>Tài khoản</a></li>
                            <li><a href="{{ route('customers.logout') }}"><i
                                        class="fas fa-arrow-right-from-bracket menu-icon"></i>Đăng xuất</a></li>
                        @else
                            <li class="mobile-menu-divider"><a href="{{ route('customers.login') }}"><i
                                        class="far fa-user menu-icon"></i>Đăng nhập</a></li>
                        @endif
                    </ul>
                </div>

                <div class="logo">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('frontend/images/logo.png') }}" alt="Logo">
                    </a>
                </div>

                {{-- DESKTOP NAV + MEGA MENU --}}
                <nav class="main-nav">
                    <ul class="nav-list">
                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link">TRANG CHỦ</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('introduce') }}" class="nav-link">VỀ CHÚNG TÔI</a>
                        </li>
                        <li class="nav-item has-dropdown">
                            <a href="#" class="nav-link">
                                SẢN PHẨM <i class="fas fa-chevron-down"></i>
                            </a>

                            @if($rootCategories->isNotEmpty())
                                <div class="mega-menu">
                                    <div class="container">
                                        <div class="mega-menu-grid">
                                            @foreach($rootCategories as $category)
                                                @php $subCategories = $categoriesByParent->get($category->id, collect()); @endphp
                                                <div class="mega-col">
                                                    <a href="{{ route('products.category', $category->id) }}"
                                                        class="mega-col-title">{{ $category->name }}</a>
                                                    @if($subCategories->isNotEmpty())
                                                        <ul class="mega-col-list">
                                                            @foreach($subCategories as $sub)
                                                                <li><a href="{{ route('products.category', $sub->id) }}">{{ $sub->name }}</a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('news.index') }}" class="nav-link">TIN TỨC</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('contact') }}" class="nav-link">TÌM HIỂU THÊM</a>
                        </li>
                    </ul>
                </nav>

                {{-- Ô tìm kiếm: mặc định nằm ở header (desktop). Markup nằm trong partial riêng. --}}
                <div class="header-search-slot" id="headerSearchSlot">
                    @include('frontend.partials.header.search')
                </div>

                <div class="header-actions">
                    <div class="mobile-burger">
                        <button id="burgerBtn" type="button"><i class="fas fa-bars"></i></button>
                    </div>

                    <div class="user-menu">
                        @if($customerEmail)
                            <div class="user-dropdown">
                                <button class="user-btn" type="button">
                                    <i class="far fa-user-circle"></i>
                                    <span>Hi, {{ $customerName }}</span>
                                </button>
                                <div class="user-dropdown-content">
                                    <a href="{{ route('customers.profile') }}">Tài khoản</a>
                                    <a href="{{ route('customers.logout') }}">Đăng xuất</a>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('customers.login') }}" class="auth-btn">
                                <i class="far fa-user"></i>
                                <span>Đăng nhập</span>
                            </a>
                        @endif
                    </div>

                    @if($cartCount > 0)
                        <div class="cart-menu">
                            <a href="{{ route('cart.index') }}" class="cart-btn">
                                <i class="fas fa-shopping-cart"></i>
                                <span class="cart-badge">{{ $cartCount }}</span>
                            </a>
                            <div class="cart-dropdown">
                                <div class="cart-header-1">
                                    <h3>Giỏ hàng của bạn</h3>
                                </div>
                                <div class="cart-items">
                                    @foreach($cartItems as $product)
                                        <div class="cart-item">
                                            <div class="cart-item-image">
                                                <img src="{{ asset('storage/products/' . $product['photo']) }}"
                                                    alt="{{ $product['name'] }}">
                                            </div>
                                            <div class="cart-item-info">
                                                <a href="{{ route('products.detail', $product['id']) }}" class="cart-item-name">
                                                    {{ $product['name'] }}
                                                </a>
                                                <p class="cart-item-price">
                                                    {{ $product['quantity'] }} × {{ number_format($product['price']) }}₫
                                                </p>
                                            </div>
                                            <a href="{{ route('cart.delete', $product['id']) }}" class="cart-item-remove">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="cart-footer">
                                    <a href="{{ route('cart.index') }}" class="checkout-btn">Thanh toán</a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </header>

    {{--
    Script nhỏ chạy ngay (không defer) để:
    1) Đưa ô tìm kiếm vào header (desktop >= 993px) hoặc top-bar (mobile) - dùng chính node cũ nên listener
       của header.js vẫn hoạt động bình thường.
    2) Thêm class is-scrolled cho header khi cuộn (thu gọn + đổ bóng trên desktop).
    --}}
    <script>
        (function () {
            var mq = window.matchMedia('(min-width: 993px)');
            var search = document.querySelector('.search-container');
            var deskSlot = document.getElementById('headerSearchSlot');
            var mobSlot = document.getElementById('topBarSearchSlot');

            function placeSearch() {
                var target = mq.matches ? deskSlot : mobSlot;
                if (search && target && search.parentNode !== target) target.appendChild(search);
            }
            placeSearch();
            if (mq.addEventListener) mq.addEventListener('change', placeSearch);
            else mq.addListener(placeSearch);

            var header = document.querySelector('.main-header');
            var ticking = false;
            function update() {
                var y = window.pageYOffset || document.documentElement.scrollTop;
                // Hysteresis để header không bị giật khi chiều cao thay đổi
                if (y > 70) header.classList.add('is-scrolled');
                else if (y < 20) header.classList.remove('is-scrolled');
                ticking = false;
            }
            window.addEventListener('scroll', function () {
                if (!ticking) { ticking = true; requestAnimationFrame(update); }
            }, { passive: true });
            update();
        })();
    </script>

    <section class="features-section">
        <div class="container">
            <div class="features-grid">
                <div class="feature-item">
                    <div class="feature-icon"><i class="fas fa-shipping-fast"></i></div>
                    <div class="feature-content">
                        <h3>Miễn phí vận chuyển</h3>
                        <p>Trong bán kính 50km</p>
                    </div>
                </div>
                <div class="feature-item">
                    <div class="feature-icon"><i class="fas fa-sync-alt"></i></div>
                    <div class="feature-content">
                        <h3>Đổi trả miễn phí</h3>
                        <p>Trong vòng 24 giờ</p>
                    </div>
                </div>
                <div class="feature-item">
                    <div class="feature-icon"><i class="fas fa-credit-card"></i></div>
                    <div class="feature-content">
                        <h3>Thanh toán đa dạng</h3>
                        <p>Đa dạng phương thức thanh toán</p>
                    </div>
                </div>
                <div class="feature-item">
                    <div class="feature-icon"><i class="fas fa-headset"></i></div>
                    <div class="feature-content">
                        <h3>Hỗ trợ 24/7</h3>
                        <p>Hotline:</p>
                        <strong>0965 814 299</strong>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script src="{{ asset('frontend/js/header.js') }}" defer></script>
    @endpush
</body>