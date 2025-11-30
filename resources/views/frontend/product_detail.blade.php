<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail</title>
    <!-- Load font awsome online -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('frontend/images/caphe.png') }}" type="image/png" class="favicon-image">
    <style type="text/css">
        .favicon-image {
            width: 80px;
        }

        /* ============================
           MODERN PRODUCT DETAIL - HYVA/SHOPIFY STYLE
        ============================ */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: #ffffff;
            color: #1a1a1a;
            line-height: 1.6;
        }

        .page-wrapper {
            max-width: 1440px;
            margin: 0 auto;
            padding: 0 24px;
        }

        /* ========== BREADCRUMB ========== */
        .breadcrumb-section {
            padding: 16px 0;
            margin-bottom: 32px;
        }

        .breadcrumb-list {
            list-style: none;
            display: flex;
            gap: 8px;
            align-items: center;
            flex-wrap: wrap;
            font-size: 14px;
        }

        .breadcrumb-list li {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .breadcrumb-list a {
            color: #737373;
            text-decoration: none;
            transition: color 0.2s;
        }

        .breadcrumb-list a:hover {
            color: #242052;
        }

        .breadcrumb-list .active {
            color: #1a1a1a;
        }

        .breadcrumb-list i {
            font-size: 12px;
            color: #d1d1d1;
        }

        /* ========== MAIN PRODUCT SECTION ========== */
        .product-main-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 64px;
            margin-bottom: 80px;
        }

        /* ========== IMAGE GALLERY ========== */
        .product-gallery {
            display: flex;
            gap: 16px;
        }

        .thumbnail-item {
            width: 80px;
            height: 80px;
            border: 2px solid #e5e5e5;
            border-radius: 8px;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.2s;
        }

        .thumbnail-item:hover,
        .thumbnail-item.active {
            border-color: #242052;
        }

        .thumbnail-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .main-image-wrapper {
            flex: 1;
            position: sticky;
            top: 24px;
            height: fit-content;
        }

        .main-image-container {
            width: 100%;
            aspect-ratio: 1/1;
            background: #fafafa;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        .main-image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s;
        }

        .main-image-container:hover img {
            transform: scale(1.05);
        }

        .image-badge {
            position: absolute;
            top: 16px;
            right: 16px;
            background: #242052;
            color: #fff;
            padding: 8px 16px;
            border-radius: 24px;
            font-size: 14px;
            font-weight: 600;
            z-index: 10;
        }

        /* ========== PRODUCT INFO ========== */
        .product-info-wrapper {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .product-header {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .category-tag {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            color: #fff;
            background: #242052;
            border-radius: 25px;
            padding: 5px 10px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            width: fit-content;
        }

        .product-title {
            font-size: 36px;
            font-weight: 600;
            color: #1a1a1a;
            line-height: 1.2;
            margin: 0;
        }

        /* ========== RATING ========== */
        .rating-wrapper {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .star-rating {
            display: flex;
            gap: 4px;
        }

        .star-rating i {
            color: #ffc107;
            font-size: 18px;
        }

        .star-rating i.empty {
            color: #e5e5e5;
        }

        .rating-count {
            color: #737373;
            font-size: 14px;
        }

        .rating-count a {
            color: #242052;
            text-decoration: none;
        }

        .rating-count a:hover {
            text-decoration: underline;
        }

        /* ========== PRICE ========== */
        .price-wrapper {
            display: flex;
            align-items: baseline;
            gap: 12px;
            padding: 24px 0;
            border-top: 1px solid #e5e5e5;
            border-bottom: 1px solid #e5e5e5;
        }

        .current-price {
            font-size: 40px;
            font-weight: 700;
            color: #242052;
        }

        .original-price {
            font-size: 24px;
            color: #a3a3a3;
            text-decoration: line-through;
        }

        .save-badge {
            background: #dcfce7;
            color: #16a34a;
            padding: 4px 12px;
            border-radius: 16px;
            font-size: 13px;
            font-weight: 600;
        }

        /* ========== DESCRIPTION ========== */
        .short-description {
            color: #525252;
            font-size: 15px;
            line-height: 1.7;
        }

        /* ========== QUANTITY & ACTIONS ========== */
        .quantity-section {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .quantity-label {
            font-size: 14px;
            font-weight: 600;
            color: #1a1a1a;
        }

        .quantity-selector {
            display: inline-flex;
            align-items: center;
            border: 2px solid #e5e5e5;
            border-radius: 8px;
            width: fit-content;
        }

        .quantity-btn {
            width: 44px;
            height: 44px;
            border: none;
            background: transparent;
            cursor: pointer;
            font-size: 18px;
            color: #525252;
            transition: all 0.2s;
        }

        .quantity-btn:hover {
            background: #f5f5f5;
            color: #242052;
        }

        .quantity-input {
            width: 60px;
            height: 44px;
            border: none;
            text-align: center;
            font-size: 16px;
            font-weight: 600;
            color: #1a1a1a;
        }

        .action-buttons {
            display: flex;
            gap: 12px;
            margin-top: 8px;
        }

        .btn-primary {
            flex: 1;
            padding: 16px 32px;
            background: #242052;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-primary:hover {
            background: #1a1740;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(36, 32, 82, 0.2);
        }

        .btn-secondary {
            flex: 1;
            padding: 16px 32px;
            background: #fff;
            color: #242052;
            border: 2px solid #242052;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-secondary:hover {
            background: #242052;
            color: #fff;
        }

        /* ========== FEATURES ========== */
        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            padding: 24px 0;
            border-top: 1px solid #e5e5e5;
        }

        .feature-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .feature-icon {
            width: 40px;
            height: 40px;
            background: #f5f5f5;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .feature-icon i {
            font-size: 20px;
            color: #fff;
        }

        .feature-text {
            flex: 1;
        }

        .feature-text strong {
            display: block;
            font-size: 13px;
            color: #1a1a1a;
            margin-bottom: 2px;
        }

        .feature-text span {
            font-size: 12px;
            color: #737373;
        }

        /* ========== COLLAPSIBLE SECTIONS ========== */
        .collapsible-sections {
            margin-top: 24px;
        }

        .collapsible-item {
            border-top: 1px solid #e5e5e5;
        }

        .collapsible-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
            cursor: pointer;
            user-select: none;
        }

        .collapsible-header h3 {
            font-size: 16px;
            font-weight: 600;
            color: #1a1a1a;
            margin: 0;
        }

        .collapsible-header i {
            font-size: 14px;
            color: #525252;
            transition: transform 0.2s;
        }

        .collapsible-item.active .collapsible-header i {
            transform: rotate(180deg);
        }

        .collapsible-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }

        .collapsible-item.active .collapsible-content {
            max-height: 995px;
            padding-bottom: 20px;
        }

        .collapsible-content-inner {
            color: #525252;
            font-size: 14px;
            line-height: 1.7;
        }

        /* ========== FULL WIDTH CONTENT SECTION ========== */
        .full-width-section {
            background: #fafafa;
            padding: 64px 0;
            margin-top: 80px;
        }

        .content-container {
            max-width: 1440px;
            margin: 0 auto;
            padding: 0 24px;
        }

        .content-header {
            text-align: center;
            margin-bottom: 48px;
        }

        .content-header h2 {
            font-size: 32px;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 12px;
        }

        .content-header p {
            font-size: 16px;
            color: #737373;
        }

        .content-body {
            background: #fff;
            border-radius: 12px;
            padding: 48px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }

        .content-body h3 {
            font-size: 24px;
            font-weight: 600;
            color: #1a1a1a;
            margin: 32px 0 16px 0;
        }

        .content-body h3:first-child {
            margin-top: 0;
        }

        .content-body p {
            color: #525252;
            line-height: 1.8;
            margin-bottom: 16px;
        }

        .content-body img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin: 24px 0;
        }

        .content-body ul,
        .content-body ol {
            margin: 16px 0;
            padding-left: 24px;
            color: #525252;
        }

        .content-body li {
            margin-bottom: 8px;
        }

        /* ========== RESPONSIVE ========== */
        @media (max-width: 1024px) {
            .product-main-section {
                gap: 48px;
            }

            .features-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .product-main-section {
                grid-template-columns: 1fr;
                gap: 32px;
            }

            .product-gallery {
                flex-direction: column-reverse;
            }

            .thumbnail-item {
                width: 70px;
                height: 70px;
                flex-shrink: 0;
            }

            .main-image-wrapper {
                position: relative;
                top: 0;
            }

            .product-title {
                font-size: 28px;
            }

            .current-price {
                font-size: 32px;
            }

            .action-buttons {
                flex-direction: column;
            }

            .features-grid {
                grid-template-columns: 1fr;
            }

            .content-body {
                padding: 32px 24px;
            }

            .full-width-section {
                padding: 48px 0;
            }
        }

        @media (max-width: 576px) {
            .page-wrapper {
                padding: 0 16px;
            }

            .product-title {
                font-size: 24px;
            }

            .current-price {
                font-size: 28px;
            }

            .original-price {
                font-size: 20px;
            }

            .content-header h2 {
                font-size: 24px;
            }

            .content-body {
                padding: 24px 16px;
            }
        }
    </style>
</head>
<body>
    <!-- Load header của trang web vào đây -->
    @include("frontend.header")

    @php
        function getCategoryName($category_id){
            $record = DB::table("categories")->where("id", "=", $category_id)->select("name")->first();
            return isset($record->name) ? $record->name : "";
        }
    @endphp

    <div class="page-wrapper">
        <!-- Breadcrumb -->
        <div class="breadcrumb-section">
            <ul class="breadcrumb-list">
                <li><a href="{{ asset('') }}"><i class="fa-solid fa-house"></i> Trang chủ</a></li>
                <li><i class="fa-solid fa-chevron-right"></i></li>
                <li><a href="#">{{ getCategoryName($record->category_id) }}</a></li>
                <li><i class="fa-solid fa-chevron-right"></i></li>
                <li class="active">{{ $record->name }}</li>
            </ul>
        </div>

        <!-- Main Product Section -->
        <div class="product-main-section">
            <!-- Product Gallery -->
            <div class="product-gallery">
                <div class="main-image-wrapper">
                    <div class="main-image-container">
                        @if($record->discount > 0)
                        <div class="image-badge">-{{ $record->discount }}%</div>
                        @endif
                        <img id="show-image" src="{{ asset('storage/products/'.$record->photo) }}" alt="{{ $record->name }}">
                    </div>
                </div>
            </div>

            <!-- Product Info -->
            <div class="product-info-wrapper">
                <div class="product-header">
                    <div class="category-tag">
                        <i class="fa-solid fa-tag"></i>
                        {{ getCategoryName($record->category_id) }}
                    </div>
                    <h1 class="product-title">{{ $record->name }}</h1>
                </div>

                <!-- Rating -->
                <div class="rating-wrapper">
                    <div class="star-rating">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <span class="rating-count">4.99 | <a href="#reviews">128 đánh giá</a></span>
                </div>

                <!-- Price -->
                <div class="price-wrapper">
                    <div class="current-price">
                        {{ number_format($record->price - ($record->price * $record->discount)/100) }}₫
                    </div>
                    @if($record->discount > 0)
                    <div class="original-price">{{ number_format($record->price) }}₫</div>
                    <div class="save-badge">Tiết kiệm {{ $record->discount }}%</div>
                    @endif
                </div>

                <!-- Short Description -->
                <div class="short-description">
                    <p>{!! $record->description !!}</p>
                </div>

                <!-- Quantity & Actions -->
                <form method="GET" action="{{ asset('cart/buy/'.$record->id) }}">
                    <div class="quantity-section">
                        <label class="quantity-label">Số lượng</label>
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn" onclick="decreaseQty()">−</button>
                            <input type="number" class="quantity-input" value="1" min="1" id="qty" name="quantity">
                            <button type="button" class="quantity-btn" onclick="increaseQty()">+</button>
                        </div>
                    </div>

                    <div class="action-buttons">
                        <button type="submit" class="btn-primary">
                            <i class="fa-solid fa-cart-plus"></i>
                            Thêm vào giỏ hàng
                        </button>
                        <button type="submit" class="btn-secondary">
                            <i class="fa-solid fa-bolt"></i>
                            Mua ngay
                        </button>
                    </div>
                </form>

                <!-- Features -->
                <div class="features-grid">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fa-solid fa-truck-fast"></i>
                        </div>
                        <div class="feature-text">
                            <strong>Miễn phí vận chuyển</strong>
                            <span>Đơn hàng trên 1.000.000₫</span>
                        </div>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fa-solid fa-circle-check"></i>
                        </div>
                        <div class="feature-text">
                            <strong>Giao hàng nhanh</strong>
                            <span>HN & HCM trong ngày</span>
                        </div>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fa-solid fa-rotate"></i>
                        </div>
                        <div class="feature-text">
                            <strong>Đổi trả dễ dàng</strong>
                            <span>Trong vòng 3 ngày</span>
                        </div>
                    </div>
                </div>

                <!-- Collapsible Sections -->
                <div class="collapsible-sections">
                    <div class="collapsible-item active">
                        <div class="collapsible-header" onclick="toggleCollapse(this)">
                            <h3>Chi tiết sản phẩm</h3>
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>
                        <div class="collapsible-content">
                            <div class="collapsible-content-inner">
                                {!! $record->content !!}
                            </div>
                        </div>
                    </div>

                    <div class="collapsible-item">
                        <div class="collapsible-header" onclick="toggleCollapse(this)">
                            <h3>Chính sách vận chuyển</h3>
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>
                        <div class="collapsible-content">
                            <div class="collapsible-content-inner">
                                <p>Miễn phí vận chuyển cho đơn hàng trên 1.000.000₫. Giao hàng nhanh trong ngày tại Hà Nội và TP. Hồ Chí Minh.</p>
                            </div>
                        </div>
                    </div>

                    <div class="collapsible-item">
                        <div class="collapsible-header" onclick="toggleCollapse(this)">
                            <h3>Chính sách đổi trả</h3>
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>
                        <div class="collapsible-content">
                            <div class="collapsible-content-inner">
                                <p>Đổi trả miễn phí trong vòng 3 ngày với sản phẩm còn nguyên tem, chưa qua sử dụng.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Full Width Content Section -->
    <div class="full-width-section">
        <div class="content-container">
            <div class="content-header">
                <h2>Mô tả chi tiết về sản phẩm</h2>
            </div>
            <div class="content-body">
                {!! $record->content !!}
            </div>
        </div>
    </div>

    <!-- Footer -->
    @include("frontend.footer")

    <script>
        // Quantity Controls
        function increaseQty() {
            const input = document.getElementById('qty');
            input.value = parseInt(input.value) + 1;
        }

        function decreaseQty() {
            const input = document.getElementById('qty');
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
            }
        }

        // Collapsible Sections
        function toggleCollapse(header) {
            const item = header.parentElement;
            item.classList.toggle('active');
        }

        // Thumbnail Click
        document.addEventListener('DOMContentLoaded', function() {
            const thumbnails = document.querySelectorAll('.thumbnail-item');
            const mainImage = document.getElementById('show-image');

            thumbnails.forEach(thumb => {
                thumb.addEventListener('click', function() {
                    thumbnails.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');
                    mainImage.src = this.querySelector('img').src;
                });
            });
        });
    </script>
</body>
</html>