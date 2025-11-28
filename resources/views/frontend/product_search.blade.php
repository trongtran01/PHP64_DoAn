<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    <!-- Load font awsome online -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('frontend/images/caphe.png') }}" type="image/png" class="favicon-image">
    <style type="text/css">
        .favicon-image {
            width: 80px;
        }

        /* ============================
           MODERN SEARCH PAGE STYLES
        ============================ */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8f9fa;
        }

        .page-wrapper {
            max-width: 1400px;
            margin: 30px auto;
            padding: 0 15px;
        }

        /* ========== BREADCRUMB ========== */
        .breadcrumb-section {
            background: #fff;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .breadcrumb-list {
            list-style: none;
            display: flex;
            gap: 8px;
            align-items: center;
            flex-wrap: wrap;
        }

        .breadcrumb-list li {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .breadcrumb-list a {
            color: #666;
            text-decoration: none;
            transition: color 0.3s;
        }

        .breadcrumb-list a:hover {
            color: #242052;
        }

        .breadcrumb-list .active {
            color: #242052;
            font-weight: 600;
        }

        /* ========== MAIN LAYOUT ========== */
        .main-layout {
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 30px;
        }

        /* ========== SIDEBAR ========== */
        .sidebar {
            background: #fff;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            height: fit-content;
            position: sticky;
            top: 20px;
        }

        .sidebar-title {
            font-size: 20px;
            color: #242052;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 3px solid #242052;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar-menu {
            list-style: none;
        }

        .sidebar-menu li {
            margin-bottom: 12px;
        }

        .sidebar-menu a {
            display: block;
            padding: 12px 15px;
            color: #333;
            text-decoration: none;
            border-radius: 6px;
            transition: all 0.3s;
            font-size: 15px;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: #242052;
            color: #fff;
            transform: translateX(5px);
        }

        /* Support Box */
        .support-box {
            margin-top: 30px;
            background: linear-gradient(135deg, #242052 0%, #3a3478 100%);
            padding: 25px;
            border-radius: 10px;
            text-align: center;
            color: #fff;
        }

        .support-box h3 {
            font-size: 18px;
            margin-bottom: 15px;
        }

        .support-box .fb-icon {
            font-size: 50px;
            color: #3B5998;
            background: #fff;
            width: 70px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin: 15px auto;
        }

        .support-box a {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px;
            background: #fff;
            color: #242052;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            transition: 0.3s;
        }

        .support-box a:hover {
            transform: scale(1.05);
        }

        /* News Widget */
        .news-widget {
            margin-top: 30px;
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        }

        .news-widget h3 {
            font-size: 18px;
            color: #242052;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 2px solid #242052;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .news-item {
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }

        .news-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .news-item img {
            width: 100%;
            border-radius: 6px;
            margin-bottom: 12px;
        }

        .news-item a {
            color: #242052;
            font-weight: 600;
            text-decoration: none;
            display: block;
            margin-bottom: 8px;
            transition: 0.3s;
        }

        .news-item a:hover {
            color: #918af7ff;
        }

        .news-item p {
            font-size: 14px;
            color: #666;
            line-height: 1.5;
        }

        /* ========== CONTENT AREA ========== */
        .content-area {
            background: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        }

        /* Search Header */
        .search-header {
            margin-bottom: 30px;
            padding: 20px;
            background: linear-gradient(135deg, #242052 0%, #3a3478 100%);
            border-radius: 10px;
            color: #fff;
        }

        .search-info {
            display: flex;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .search-icon {
            font-size: 36px;
            color: #fff;
        }

        .search-text h1 {
            font-size: 24px;
            margin-bottom: 8px;
        }

        .search-keyword {
            background: rgba(255,255,255,0.2);
            padding: 4px 12px;
            border-radius: 4px;
            font-weight: bold;
        }

        .search-count {
            font-size: 14px;
            opacity: 0.9;
        }

        /* No Results */
        .no-results {
            text-align: center;
            padding: 60px 20px;
        }

        .no-results-icon {
            font-size: 80px;
            color: #ddd;
            margin-bottom: 20px;
        }

        .no-results h2 {
            color: #242052;
            margin-bottom: 15px;
        }

        .no-results p {
            color: #666;
            font-size: 16px;
            margin-bottom: 25px;
        }

        .back-home-btn {
            display: inline-block;
            padding: 12px 30px;
            background: #242052;
            color: #fff;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            transition: 0.3s;
        }

        .back-home-btn:hover {
            background: #3a3478;
            transform: translateY(-2px);
        }

        /* Products Grid */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }

        .product-card {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            border: 1px solid #ececec;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            transition: all 0.3s;
            position: relative;
            text-align: center;
        }

        .product-card:hover {
            box-shadow: 0 8px 25px rgba(0,0,0,0.12);
            transform: translateY(-5px);
        }

        .discount-tag {
            position: absolute;
            top: 15px;
            left: 0;
            background: #242052;
            color: #fff;
            padding: 6px 14px;
            font-size: 14px;
            font-weight: bold;
            border-radius: 0 10px 10px 0;
            z-index: 1;
        }

        .product-image {
            display: block;
            height: 200px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 15px;
        }

        .product-image img {
            max-height: 100%;
            max-width: 100%;
            object-fit: contain;
        }

        .product-name {
            font-size: 16px;
            color: #242052;
            margin-bottom: 12px;
            min-height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            font-weight: 600;
            transition: 0.3s;
        }

        .product-name:hover {
            color: #CD2626;
        }

        .price-container {
            margin-bottom: 15px;
            min-height: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .current-price {
            font-size: 20px;
            color: #242052;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .original-price {
            font-size: 15px;
            color: #999;
            text-decoration: line-through;
        }

        .add-to-cart-btn {
            display: block;
            width: 100%;
            padding: 12px;
            background: #242052;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            text-align: center;
        }

        .add-to-cart-btn:hover {
            background: #fff;
            color: #242052;
            border: 2px solid #242052;
        }

        /* Pagination */
        .pagination-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 40px;
        }

        /* ========== RESPONSIVE ========== */
        @media (max-width: 1200px) {
            .main-layout {
                grid-template-columns: 250px 1fr;
                gap: 20px;
            }
        }

        @media (max-width: 992px) {
            .main-layout {
                grid-template-columns: 1fr;
            }

            .sidebar {
                position: relative;
                top: 0;
            }

            .products-grid {
                grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
                gap: 20px;
            }

            .news-widget {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 20px;
            }

            .news-widget h3 {
                grid-column: 1 / -1;
            }
        }

        @media (max-width: 768px) {
            .page-wrapper {
                padding: 0 10px;
            }

            .search-header {
                padding: 15px;
            }

            .search-text h1 {
                font-size: 20px;
            }

            .search-icon {
                font-size: 28px;
            }

            .products-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 15px;
            }

            .content-area {
                padding: 20px;
            }

            .sidebar {
                padding: 20px;
            }
        }

        @media (max-width: 576px) {
            .products-grid {
                grid-template-columns: 1fr;
            }

            .product-card {
                padding: 15px;
            }

            .product-image {
                height: 180px;
            }

            .search-text h1 {
                font-size: 18px;
            }

            .breadcrumb-section {
                padding: 12px 15px;
            }

            .breadcrumb-list {
                font-size: 14px;
            }

            .no-results-icon {
                font-size: 60px;
            }

            .no-results h2 {
                font-size: 20px;
            }
        }

        /* Mobile Menu Toggle */
        .mobile-menu-toggle {
            display: none;
            background: #242052;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            margin-bottom: 15px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            font-weight: 600;
        }

        @media (max-width: 992px) {
            .mobile-menu-toggle {
                display: block;
            }

            .sidebar {
                display: none;
            }

            .sidebar.active {
                display: block;
            }
        }
    </style>
</head>
<body>
    <!-- Load header của trang web vào đây -->
    @include("frontend.header")

    <!-- Đổ dữ liệu của product vào đây -->
    @yield("do-du-lieu-vao-layout")

    <div class="page-wrapper">
        <!-- Breadcrumb -->
        <div class="breadcrumb-section">
            <ul class="breadcrumb-list">
                <li><a href="{{ asset('') }}"><i class="fa-solid fa-house"></i> Trang chủ</a></li>
                <li><i class="fa-solid fa-chevron-right"></i></li>
                <li class="active">Kết quả tìm kiếm</li>
            </ul>
        </div>

        <!-- Mobile Menu Toggle -->
        <button class="mobile-menu-toggle" onclick="toggleSidebar()">
            <i class="fa-solid fa-bars"></i> Menu & Tin tức
        </button>

        <!-- Main Layout -->
        <div class="main-layout">
            <!-- Sidebar -->
            <aside class="sidebar" id="sidebar">
                <h2 class="sidebar-title">
                    <i class="fa-solid fa-list"></i>
                    DANH MỤC
                </h2>
                <ul class="sidebar-menu">
                    <li><a href="{{ asset('') }}"><i class="fa-solid fa-house"></i> Trang chủ</a></li>
                    <li><a href="#"><i class="fa-solid fa-info-circle"></i> Giới thiệu</a></li>
                    <li><a href="#" class="active"><i class="fa-solid fa-shopping-bag"></i> Sản phẩm</a></li>
                    <li><a href="{{ asset('news') }}"><i class="fa-solid fa-newspaper"></i> Tin tức</a></li>
                    <li><a href="{{ asset('contact') }}"><i class="fa-solid fa-phone"></i> Liên hệ</a></li>
                </ul>

                <!-- Support Box -->
                <div class="support-box">
                    <h3>Hỗ trợ trực tuyến</h3>
                    <p style="margin-bottom: 10px;">Hỗ trợ bán hàng</p>
                    <div class="fb-icon">
                        <i class="fa-brands fa-facebook-f"></i>
                    </div>
                    <a href="#">Chat ngay để được tư vấn</a>
                </div>

                <!-- News Widget -->
                <div class="news-widget">
                    <h3><i class="fa-solid fa-newspaper"></i> Tin hot</h3>
                    @php
                        $news = \App\Http\Controllers\Frontend\HomeController::hotNews();
                    @endphp
                    @foreach($news->take(3) as $row)
                    <div class="news-item">
                        <img src="{{ asset('storage/news/'.$row->photo) }}" alt="{{ $row->name }}">
                        <a href="{{ url('news/detail/'.$row->id) }}">{{ $row->name }}</a>
                        <p>{!! \Illuminate\Support\Str::limit(strip_tags($row->description), 100) !!}</p>
                    </div>
                    @endforeach
                </div>
            </aside>

            <!-- Content Area -->
            <main class="content-area">
                <!-- Search Header -->
                <div class="search-header">
                    <div class="search-info">
                        <i class="fa-solid fa-magnifying-glass search-icon"></i>
                        <div class="search-text">
                            <h1>Kết quả tìm kiếm cho: <span class="search-keyword">"{{ $key }}"</span></h1>
                            <p class="search-count">Tìm thấy {{ $data->total() }} sản phẩm</p>
                        </div>
                    </div>
                </div>

                @if($data->count() > 0)
                    <!-- Products Grid -->
                    <div class="products-grid">
                        @foreach($data as $row)
                        <div class="product-card">
                            @if($row->discount > 0)
                            <span class="discount-tag">-{{$row->discount}}%</span>
                            @endif

                            <a href="{{ url('products/detail/'.$row->id) }}" class="product-image">
                                <img src="{{asset('storage/products/'.$row->photo)}}" alt="{{ $row->name }}">
                            </a>

                            <a href="{{ url('products/detail/'.$row->id) }}" class="product-name">
                                {{ $row->name }}
                            </a>

                            <div class="price-container">
                                <p class="current-price">{{ number_format($row->price - ($row->price * $row->discount)/100) }}đ</p>
                                @if($row->discount > 0)
                                <p class="original-price">{{ number_format($row->price) }}đ</p>
                                @endif
                            </div>

                            <a href="{{ asset('cart/buy/'.$row->id) }}" class="add-to-cart-btn">
                                <i class="fa-solid fa-cart-plus"></i> Thêm vào giỏ hàng
                            </a>
                        </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="pagination-wrapper">
                        {{ $data->render() }}
                    </div>
                @else
                    <!-- No Results -->
                    <div class="no-results">
                        <i class="fa-solid fa-face-sad-tear no-results-icon"></i>
                        <h2>Không tìm thấy sản phẩm nào</h2>
                        <p>Rất tiếc, chúng tôi không tìm thấy sản phẩm nào phù hợp với từ khóa "<strong>{{ $key }}</strong>"</p>
                        <p>Vui lòng thử lại với từ khóa khác hoặc xem các sản phẩm khác của chúng tôi.</p>
                        <a href="{{ asset('') }}" class="back-home-btn">
                            <i class="fa-solid fa-house"></i> Về trang chủ
                        </a>
                    </div>
                @endif
            </main>
        </div>
    </div>

    <!-- Footer -->
    @include("frontend.footer")

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('active');
        }

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            if (window.innerWidth <= 992) {
                const sidebar = document.getElementById('sidebar');
                const toggleBtn = document.querySelector('.mobile-menu-toggle');
                
                if (!sidebar.contains(event.target) && !toggleBtn.contains(event.target)) {
                    sidebar.classList.remove('active');
                }
            }
        });
    </script>
</body>
</html>