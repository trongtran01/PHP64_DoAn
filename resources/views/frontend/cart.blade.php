<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="{{ asset('Frontend/css/style.css') }}">
    <link rel="icon" href="{{ asset('frontend/images/caphe.png') }}" type="image/png" class="favicon-image">
    <style type="text/css">
        .favicon-image { width: 80px; }

        /* ============================
           MODERN CART STYLES
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

        /* ========== CART HEADER ========== */
        .cart-header {
            background: linear-gradient(135deg, #242052 0%, #3a3478 100%);
            padding: 30px;
            border-radius: 10px;
            margin-bottom: 30px;
            color: #fff;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .cart-icon {
            font-size: 48px;
        }

        .cart-header h1 {
            font-size: 32px;
            margin-bottom: 5px;
        }

        .cart-count {
            font-size: 16px;
            opacity: 0.9;
        }

        /* ========== CART TABLE ========== */
        .cart-section {
            background: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            margin-bottom: 30px;
        }

        .cart-table {
            width: 100%;
            border-collapse: collapse;
        }

        .cart-table thead {
            background: #f8f9fa;
        }

        .cart-table th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: #242052;
            border-bottom: 2px solid #242052;
        }

        .cart-table td {
            padding: 20px 15px;
            border-bottom: 1px solid #eee;
            vertical-align: middle;
        }

        .product-image-cell img {
            width: 100px;
            height: 100px;
            object-fit: contain;
            border-radius: 8px;
            border: 1px solid #eee;
        }

        .product-name-cell a {
            color: #242052;
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
            transition: 0.3s;
        }

        .product-name-cell a:hover {
            color: #CD2626;
        }

        .price-cell {
            color: #333;
            font-weight: 600;
        }

        .quantity-input {
            width: 70px;
            padding: 8px;
            border: 2px solid #242052;
            border-radius: 6px;
            text-align: center;
            font-size: 16px;
            font-weight: 600;
        }

        .total-cell {
            color: #242052;
            font-size: 18px;
            font-weight: bold;
        }

        .delete-btn {
            color: #e74c3c;
            font-size: 20px;
            transition: 0.3s;
            cursor: pointer;
        }

        .delete-btn:hover {
            color: #c0392b;
            transform: scale(1.2);
        }

        /* ========== CART ACTIONS ========== */
        .cart-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 25px;
            padding-top: 25px;
            border-top: 2px solid #eee;
            flex-wrap: wrap;
            gap: 15px;
        }

        .cart-actions-left {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .btn-outline {
            padding: 12px 25px;
            border: 2px solid #242052;
            background: #fff;
            color: #242052;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            transition: 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-outline:hover {
            background: #242052;
            color: #fff;
        }

        .btn-outline.danger {
            border-color: #e74c3c;
            color: #e74c3c;
        }

        .btn-outline.danger:hover {
            background: #e74c3c;
            color: #fff;
        }

        .btn-primary {
            padding: 12px 25px;
            background: #242052;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary:hover {
            background: #3a3478;
            transform: translateY(-2px);
        }

        /* ========== CART SUMMARY ========== */
        .cart-summary {
            background: linear-gradient(135deg, #242052 0%, #3a3478 100%);
            padding: 30px;
            border-radius: 10px;
            color: #fff;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            font-size: 16px;
        }

        .summary-total {
            display: flex;
            justify-content: space-between;
            font-size: 28px;
            font-weight: bold;
            padding-top: 20px;
            border-top: 2px solid rgba(255,255,255,0.3);
            margin-top: 20px;
        }

        .checkout-btn {
            width: 100%;
            padding: 18px;
            background: #fff;
            color: #242052;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 25px;
            transition: 0.3s;
            text-decoration: none;
            display: block;
            text-align: center;
        }

        .checkout-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }

        /* ========== EMPTY CART ========== */
        .empty-cart {
            text-align: center;
            padding: 80px 20px;
        }

        .empty-cart-icon {
            font-size: 100px;
            color: #ddd;
            margin-bottom: 25px;
        }

        .empty-cart h2 {
            color: #242052;
            margin-bottom: 15px;
            font-size: 28px;
        }

        .empty-cart p {
            color: #666;
            font-size: 16px;
            margin-bottom: 30px;
        }

        /* ========== RESPONSIVE ========== */
        @media (max-width: 1024px) {
            .cart-table {
                font-size: 14px;
            }

            .product-image-cell img {
                width: 80px;
                height: 80px;
            }
        }

        @media (max-width: 768px) {
            .cart-header {
                padding: 20px;
            }

            .cart-header h1 {
                font-size: 24px;
            }

            .cart-icon {
                font-size: 36px;
            }

            .cart-section {
                padding: 20px;
                overflow-x: auto;
            }

            .cart-table {
                min-width: 600px;
            }

            .cart-actions {
                flex-direction: column;
                align-items: stretch;
            }

            .cart-actions-left {
                flex-direction: column;
            }

            .btn-outline,
            .btn-primary {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 576px) {
            .page-wrapper {
                padding: 0 10px;
            }

            .cart-summary {
                padding: 20px;
            }

            .summary-total {
                font-size: 22px;
            }
        }
        .payment-method-block,
        .shipping-method-block {
            background: #fff;
            border: none;
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 25px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
        }

        .payment-method-block:hover,
        .shipping-method-block:hover {
            box-shadow: 0 8px 30px rgba(36, 32, 82, 0.15);
            transform: translateY(-2px);
        }

        .block-title {
            font-size: 1.375rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: #242052;
            padding-bottom: 15px;
            border-bottom: 3px solid #f3f4f6;
        }

        .block-title i {
            font-size: 1.5rem;
            color: #242052;
            background: linear-gradient(135deg, #242052 0%, #3a3478 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .options {
            display: grid;
            gap: 15px;
        }

        .option-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1.25rem 1.5rem;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: #fff;
            position: relative;
            overflow: hidden;
        }

        .option-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background: linear-gradient(135deg, #242052 0%, #3a3478 100%);
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }

        .option-item:hover {
            background: linear-gradient(135deg, rgba(36, 32, 82, 0.05) 0%, rgba(58, 52, 120, 0.05) 100%);
            border-color: #242052;
            transform: translateX(5px);
        }

        .option-item:hover::before {
            transform: scaleY(1);
        }

        .option-item input[type="radio"] {
            width: 22px;
            height: 22px;
            accent-color: #242052;
            cursor: pointer;
            flex-shrink: 0;
        }

        .option-item i {
            font-size: 1.5rem;
            color: #666;
            transition: all 0.3s ease;
            flex-shrink: 0;
        }

        .option-item:hover i {
            color: #242052;
            transform: scale(1.1);
        }

        .option-item input[type="radio"]:checked ~ i,
        .option-item:has(input[type="radio"]:checked) i {
            color: #242052;
        }

        .option-item label,
        .option-item > span:not(i) {
            font-size: 1rem;
            font-weight: 600;
            color: #333;
            cursor: pointer;
            user-select: none;
            flex: 1;
        }

        /* Style khi option được chọn */
        .option-item:has(input[type="radio"]:checked) {
            background: linear-gradient(135deg, rgba(36, 32, 82, 0.1) 0%, rgba(58, 52, 120, 0.1) 100%);
            border-color: #242052;
            box-shadow: 0 4px 15px rgba(36, 32, 82, 0.15);
        }

        .option-item:has(input[type="radio"]:checked)::before {
            transform: scaleY(1);
        }

        .option-item:has(input[type="radio"]:checked) label,
        .option-item:has(input[type="radio"]:checked) > span:not(i) {
            color: #242052;
        }

        /* Icon đặc biệt cho từng phương thức */
        .option-item:has([value="cod"]) i.fa-truck {
            color: #27ae60;
        }

        .option-item:has([value="stripe"]) i.fa-stripe-s {
            color: #635bff;
        }

        .option-item:has([value="paypal"]) i.fa-paypal {
            color: #0070ba;
        }

        .option-item:has([value="fast"]) i.fa-bolt {
            color: #f39c12;
        }

        .option-item:has([value="standard"]) i.fa-clock {
            color: #3498db;
        }

        /* Responsive cho mobile */
        @media (max-width: 768px) {
            .payment-method-block,
            .shipping-method-block {
                padding: 20px;
            }

            .block-title {
                font-size: 1.125rem;
            }

            .block-title i {
                font-size: 1.25rem;
            }

            .option-item {
                padding: 1rem 1.25rem;
            }

            .option-item i {
                font-size: 1.25rem;
            }

            .option-item label,
            .option-item > span:not(i) {
                font-size: 0.9375rem;
            }
        }

        @media (max-width: 576px) {
            .payment-method-block,
            .shipping-method-block {
                padding: 15px;
            }

            .option-item {
                padding: 0.875rem 1rem;
                gap: 0.75rem;
            }

            .option-item input[type="radio"] {
                width: 20px;
                height: 20px;
            }
        }
    </style>
</head>
<body>
    @include("frontend.header")

    @php
        use \App\Http\ShoppingCart\Cart;
    @endphp

    <div class="page-wrapper">
        <!-- Breadcrumb -->
        <div class="breadcrumb-section">
            <ul class="breadcrumb-list">
                <li><a href="{{ asset('') }}"><i class="fa-solid fa-house"></i> Trang chủ</a></li>
                <li><i class="fa-solid fa-chevron-right"></i></li>
                <li class="active">Giỏ hàng</li>
            </ul>
        </div>

        <!-- Cart Header -->
        <div class="cart-header">
            <i class="fa-solid fa-shopping-cart cart-icon"></i>
            <div>
                <h1>Giỏ hàng của bạn</h1>
                <p class="cart-count">{{ Cart::cartNumber() }} sản phẩm</p>
            </div>
        </div>

        @if(isset($cart) && Cart::cartNumber() > 0)
        <form action="{{ url('cart/update') }}" method="post">
            @csrf
            <!-- Cart Table -->
            <div class="cart-section">
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>Ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Tổng</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cart as $product)
                        <tr>
                            <td class="product-image-cell">
                                <img src="{{ asset('storage/products/'.$product['photo']) }}" alt="{{ $product['name'] }}">
                            </td>
                            <td class="product-name-cell">
                                <a href="{{ url('products/detail/'.$product['id']) }}">{{ $product['name'] }}</a>
                            </td>
                            <td class="price-cell">{{ number_format($product['price']) }}₫</td>
                            <td>
                                <input type="number" class="quantity-input" min="1" value="{{ $product['quantity'] }}" name="product_{{ $product['id'] }}" required>
                            </td>
                            <td class="total-cell">
                                {{ number_format($product['quantity'] * ($product['price'] - ($product['price'] * $product['discount'])/100)) }}₫
                            </td>
                            <td>
                                <a href="{{ url('cart/delete/'.$product['id']) }}" class="delete-btn">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Cart Actions -->
                <div class="cart-actions">
                    <div class="cart-actions-left">
                        <a href="{{ url('cart/destroy') }}" class="btn-outline danger">
                            <i class="fa-solid fa-trash-can"></i>
                            Xóa toàn bộ
                        </a>
                        <a href="{{ url('') }}" class="btn-outline">
                            <i class="fa-solid fa-arrow-left"></i>
                            Tiếp tục mua hàng
                        </a>
                    </div>
                    <button type="submit" class="btn-primary">
                        <i class="fa-solid fa-rotate"></i>
                        Cập nhật giỏ hàng
                    </button>
                </div>
            </div>

            <!-- Payment Method Block -->
            <div class="payment-method-block card-block">
                <h3 class="block-title"><i class="fa-solid fa-credit-card"></i> Chọn phương thức thanh toán</h3>
                <div class="options">
                    <label class="option-item">
                        <input type="radio" name="payment_method" value="cod">
                        <i class="fa-solid fa-truck"></i> Thanh toán khi nhận hàng
                    </label>
                    <label class="option-item">
                        <input type="radio" name="payment_method" value="stripe">
                        <i class="fa-brands fa-stripe-s"></i> Stripe
                    </label>
                    <label class="option-item">
                        <input type="radio" name="payment_method" value="paypal">
                        <i class="fa-brands fa-paypal"></i> PayPal
                    </label>
                </div>
            </div>

            <!-- Shipping Method Block -->
            <div class="shipping-method-block card-block">
                <h3 class="block-title"><i class="fa-solid fa-shipping-fast"></i> Chọn phương thức vận chuyển</h3>
                <div class="options">
                    <label class="option-item">
                        <input type="radio" name="shipping_method" value="fast">
                        <i class="fa-solid fa-bolt"></i> Nhanh
                    </label>
                    <label class="option-item">
                        <input type="radio" name="shipping_method" value="standard">
                        <i class="fa-solid fa-clock"></i> Tiêu chuẩn
                    </label>
                </div>
            </div>

            <!-- Cart Summary -->
            <div class="cart-summary card-block">
                <div class="summary-row">
                    <span>Tạm tính:</span>
                    <span>{{ number_format(Cart::cartTotal()) }}₫</span>
                </div>
                <div class="summary-row">
                    <span>Phí vận chuyển:</span>
                    <span>Miễn phí</span>
                </div>
                <div class="summary-total">
                    <span>Tổng cộng:</span>
                    <span>{{ number_format(Cart::cartTotal()) }}₫</span>
                </div>

                <a href="{{ url('cart/order') }}" class="checkout-btn">
                    <i class="fa-solid fa-credit-card"></i>
                    Tiến hành thanh toán
                </a>
            </div>

        </form>
        @else
        <!-- Empty Cart -->
        <div class="cart-section">
            <div class="empty-cart">
                <i class="fa-solid fa-cart-shopping empty-cart-icon"></i>
                <h2>Giỏ hàng trống</h2>
                <p>Bạn chưa có sản phẩm nào trong giỏ hàng. Hãy tiếp tục mua sắm nhé!</p>
                <a href="{{ url('') }}" class="btn-primary">
                    <i class="fa-solid fa-shopping-bag"></i>
                    Khám phá sản phẩm
                </a>
            </div>
        </div>
        @endif
    </div>

    @include("frontend.footer")
</body>
</html>
