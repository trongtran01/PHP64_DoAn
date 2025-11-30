<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="{{ asset('frontend/css/cart.css') }}">
    <link rel="icon" href="{{ asset('frontend/images/caphe.png') }}" type="image/png">
</head>
<body>
    @include("frontend.header")

    @php use \App\Http\ShoppingCart\Cart; @endphp

    <div class="page-wrapper">
        <!-- Breadcrumb -->
        <div class="breadcrumb-section">
            <ul class="breadcrumb-list">
                <li><a href="{{ url('') }}"><i class="fa-solid fa-house"></i> Trang chủ</a></li>
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

        <!-- ====================== Form cập nhật giỏ hàng ====================== -->
        <form action="{{ url('cart/update') }}" method="post">
            @csrf
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

                <div class="cart-actions">
                    <div class="cart-actions-left">
                        <a href="{{ url('cart/destroy') }}" class="btn-outline danger">
                            <i class="fa-solid fa-trash-can"></i> Xóa toàn bộ
                        </a>
                        <a href="{{ url('') }}" class="btn-outline">
                            <i class="fa-solid fa-arrow-left"></i> Tiếp tục mua hàng
                        </a>
                    </div>
                    <button type="submit" class="btn-primary">
                        <i class="fa-solid fa-rotate"></i> Cập nhật giỏ hàng
                    </button>
                </div>
            </div>
        </form>

        <!-- ====================== Form checkout / tiến hành thanh toán ====================== -->
        <form action="{{ url('cart/order') }}" method="post" id="checkout-form">
            @csrf
            <input type="hidden" name="shipping_method" id="checkout-shipping-method">
            <input type="hidden" name="shipping_price" id="checkout-shipping-price">

            <!-- Payment Method Block -->
            <div class="payment-method-block card-block">
                <h3 class="block-title"><i class="fa-solid fa-credit-card"></i> Chọn phương thức thanh toán</h3>
                <div class="options">
                    <label class="option-item">
                        <input type="radio" name="payment_method" value="cod" required checked>
                        <i class="fa-solid fa-truck"></i> Thanh toán khi nhận hàng
                    </label>
                    <label class="option-item disabled" title="Tính năng đang phát triển">
                        <input type="radio" name="payment_method" value="stripe" disabled>
                        <i class="fa-brands fa-stripe-s"></i> Stripe
                        <span class="badge-coming-soon">Coming Soon...</span>
                    </label>
                    <label class="option-item disabled" title="Tính năng đang phát triển">
                        <input type="radio" name="payment_method" value="paypal" disabled>
                        <i class="fa-brands fa-paypal"></i> PayPal
                        <span class="badge-coming-soon">Coming Soon...</span>
                    </label>
                </div>
            </div>

            <!-- Shipping Method Block -->
            <div class="shipping-method-block card-block">
                <h3 class="block-title"><i class="fa-solid fa-shipping-fast"></i> Chọn phương thức vận chuyển</h3>
                <div class="options">
                    <label class="option-item">
                        <input type="radio" name="shipping_method_radio" value="fast" data-price="70000" required>
                        <i class="fa-solid fa-bolt"></i> Nhanh (Vận chuyển trong ngày)
                    </label>
                    <label class="option-item">
                        <input type="radio" name="shipping_method_radio" value="standard" data-price="30000" required>
                        <i class="fa-solid fa-clock"></i> Tiêu chuẩn (2-3 ngày)
                    </label>
                </div>
            </div>

            <!-- Cart Summary -->
            <div class="cart-summary card-block">
                <div class="summary-row">
                    <span>Tạm tính:</span>
                    <span id="cart-subtotal">{{ number_format(Cart::cartTotal()) }}₫</span>
                </div>
                <div class="summary-row">
                    <span>Phí vận chuyển:</span>
                    <span id="shipping-price">0₫</span>
                </div>
                <div class="summary-total">
                    <span>Tổng cộng:</span>
                    <span id="total-price">{{ number_format(Cart::cartTotal()) }}₫</span>
                </div>

                <button type="submit" class="checkout-btn">
                    <i class="fa-solid fa-credit-card"></i> Tiến hành thanh toán
                </button>
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
                    <i class="fa-solid fa-shopping-bag"></i> Khám phá sản phẩm
                </a>
            </div>
        </div>
        @endif

    </div>

    @include("frontend.footer")
</body>
</html>
<script>
$(document).ready(function() {
    function updateTotal() {
        let subtotal = 0;
        $('.cart-table tbody tr').each(function() {
            let qty = parseInt($(this).find('.quantity-input').val()) || 0;
            let priceText = $(this).find('.price-cell').text().replace(/₫|,/g,'');
            let price = parseFloat(priceText);
            subtotal += qty * price;
        });

        // Lấy shipping đang chọn
        let shippingInput = $('input[name="shipping_method_radio"]:checked');
        let shippingPrice = parseInt(shippingInput.data('price')) || 0;

        // Cập nhật hiển thị
        $('#cart-subtotal').text(subtotal.toLocaleString() + '₫');
        $('#shipping-price').text(shippingPrice.toLocaleString() + '₫');
        $('#total-price').text((subtotal + shippingPrice).toLocaleString() + '₫');
    }

    // Khi chọn phương thức vận chuyển - LƯU NGAY VÀO SESSION
    $('input[name="shipping_method_radio"]').change(function() {
        let shippingMethod = $(this).val();
        let shippingPrice = $(this).data('price');

        // Gửi AJAX để lưu vào session
        $.ajax({
            url: "{{ route('cart.setShippingSession') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                shipping_method: shippingMethod,
                shipping_price: shippingPrice
            },
            success: function(response) {
                console.log('Shipping saved to session');
                updateTotal();
            }
        });
    });

    // Khi thay đổi quantity
    $('.quantity-input').on('input', updateTotal);

    // Xử lý submit form checkout
    $('form#checkout-form').submit(function(e) {
        e.preventDefault();
        
        let shippingInput = $('input[name="shipping_method_radio"]:checked');
        
        if(!shippingInput.length) {
            alert("Vui lòng chọn phương thức vận chuyển!");
            return false;
        }

        let paymentInput = $('input[name="payment_method"]:checked');
        if(!paymentInput.length) {
            alert("Vui lòng chọn phương thức thanh toán!");
            return false;
        }

        let shippingMethod = shippingInput.val();
        let shippingPrice = shippingInput.data('price');

        // Gửi AJAX để đảm bảo session được lưu
        $.ajax({
            url: "{{ route('cart.setShippingSession') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                shipping_method: shippingMethod,
                shipping_price: shippingPrice
            },
            async: false, // Đồng bộ để đảm bảo session kịp lưu
            success: function() {
                // Submit form thật
                $('form#checkout-form')[0].submit();
            }
        });
    });

    // Cập nhật lần đầu
    updateTotal();
});
</script>
