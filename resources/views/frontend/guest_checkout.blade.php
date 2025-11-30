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
.page-wrapper {
    max-width: 1440px;
    margin: 0 auto;
    padding: 2rem 1rem;
    min-height: 100vh;
}

/* Breadcrumb */
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

/* Checkout Header */
.checkout-header {
    display: flex;
    align-items: center;
    gap: 1.5rem;
    margin-bottom: 2.5rem;
    padding: 2rem;
    background: #ffffff;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(36, 32, 82, 0.08);
}

.cart-icon {
    font-size: 3rem;
    color: #242052;
    background: #efeeff;
    width: 80px;
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 16px;
    flex-shrink: 0;
}

.checkout-header h1 {
    color: #242052;
    font-size: 1.75rem;
    margin: 0 0 0.5rem 0;
    font-weight: 700;
}

.checkout-header p {
    color: #666;
    margin: 0;
    font-size: 0.95rem;
}

/* Card Block */
.card-block {
    background: #ffffff;
    border-radius: 16px;
    padding: 2.5rem;
    box-shadow: 0 4px 20px rgba(36, 32, 82, 0.08);
    transition: box-shadow 0.3s ease;
}

.card-block:hover {
    box-shadow: 0 8px 30px rgba(36, 32, 82, 0.12);
}

/* Alerts */
.alert {
    padding: 1rem 1.25rem;
    border-radius: 12px;
    border: none;
    margin-bottom: 1.5rem;
}

.alert-danger {
    background: #fff0f0;
    color: #d63031;
}

.alert-danger ul {
    margin: 0;
    padding-left: 1.25rem;
}

.alert-danger li {
    margin: 0.25rem 0;
}

/* Form Styling */
.form-group {
    margin-bottom: 1.75rem;
}

.form-group label {
    display: block;
    color: #242052;
    font-weight: 600;
    margin-bottom: 0.6rem;
    font-size: 0.95rem;
}

.form-control {
    width: 100%;
    padding: 0.875rem 1.125rem;
    border: 2px solid #efeeff;
    border-radius: 12px;
    font-size: 1rem;
    color: #242052;
    background: #ffffff;
    transition: all 0.3s ease;
    font-family: inherit;
    box-sizing: border-box;
}

.form-control:focus {
    outline: none;
    border-color: #242052;
    background: #fafbff;
    box-shadow: 0 0 0 4px rgba(36, 32, 82, 0.08);
}

.form-control::placeholder {
    color: #aaa;
}

textarea.form-control {
    min-height: 120px;
    resize: vertical;
    line-height: 1.6;
}

/* Button Styling */
.btn-primary {
    background: linear-gradient(135deg, #242052 0%, #3a3578 100%);
    color: #ffffff;
    border: none;
    padding: 1rem 2.5rem;
    font-size: 1rem;
    font-weight: 600;
    border-radius: 12px;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(36, 32, 82, 0.25);
    width: 100%;
    justify-content: center;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 25px rgba(36, 32, 82, 0.35);
    background: linear-gradient(135deg, #1a1740 0%, #2d2960 100%);
}

.btn-primary:active {
    transform: translateY(0);
    box-shadow: 0 2px 10px rgba(36, 32, 82, 0.25);
}

.btn-primary i {
    font-size: 1.1rem;
}

.mt-3 {
    margin-top: 2rem;
}

.mb-3 {
    margin-bottom: 1.5rem;
}

.mb-0 {
    margin-bottom: 0;
}

/* Responsive Design */
@media (max-width: 768px) {
    .page-wrapper {
        padding: 1rem;
    }

    .checkout-header {
        flex-direction: column;
        text-align: center;
        padding: 1.5rem;
    }

    .cart-icon {
        width: 70px;
        height: 70px;
        font-size: 2.5rem;
    }

    .checkout-header h1 {
        font-size: 1.5rem;
    }

    .card-block {
        padding: 1.5rem;
    }

    .btn-primary {
        padding: 0.875rem 2rem;
    }
}

@media (max-width: 480px) {
    .checkout-header h1 {
        font-size: 1.25rem;
    }

    .card-block {
        padding: 1.25rem;
    }

    .form-control {
        padding: 0.75rem 1rem;
    }
}
</style>
</head>
<body>
    @include("frontend.header")
    <!-- Thêm vào sau checkout-header -->
    <div class="page-wrapper">
        <!-- Breadcrumb -->
        <div class="breadcrumb-section">
            <ul class="breadcrumb-list">
                <li><a href="{{ asset('') }}"><i class="fa-solid fa-house"></i> Trang chủ</a></li>
                <li><i class="fa-solid fa-chevron-right"></i></li>
                <li class="active">Thanh toán</li>
            </ul>
        </div>

        <!-- Checkout Header -->
        <div class="checkout-header">
            <i class="fa-solid fa-credit-card cart-icon"></i>
            <div>
                <h1>Thông tin thanh toán</h1>
                <p>Hoàn tất thông tin để đặt hàng</p>
            </div>
        </div>
        <div class="card-block mb-3">
            <h3 class="block-title"><i class="fa-solid fa-shipping-fast"></i> Phương thức vận chuyển đã chọn</h3>
            <div class="alert alert-info">
                <strong>{{ $shipping_method == 'fast' ? 'Nhanh (Vận chuyển trong ngày)' : 'Tiêu chuẩn (2-3 ngày)' }}</strong>
                <br>
                Phí vận chuyển: {{ number_format($shipping_price) }}₫
            </div>
        </div>

        <!-- Checkout Form -->
        <div class="checkout-section card-block">

            @if ($errors->any())
                <div class="alert alert-danger mb-3">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger mb-3">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('guest.order.post') }}" method="post">
                @csrf

                <div class="form-group">
                    <label>Họ tên *</label>
                    <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                </div>

                <div class="form-group">
                    <label>Số điện thoại *</label>
                    <input type="text" name="phone" class="form-control" required value="{{ old('phone') }}">
                </div>

                <div class="form-group">
                    <label>Email (không bắt buộc)</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                </div>

                <div class="form-group">
                    <label>Địa chỉ giao hàng *</label>
                    <textarea name="address" class="form-control" required>{{ old('address') }}</textarea>
                </div>

                <button type="submit" class="btn-primary mt-3">
                    <i class="fa-solid fa-check"></i>
                    Hoàn tất đặt hàng
                </button>
            </form>
        </div>
    </div>
    @include("frontend.footer")

</body>
