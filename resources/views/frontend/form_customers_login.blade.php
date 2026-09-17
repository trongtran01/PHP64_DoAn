<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập / Đăng Ký</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/css/login.css') }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('frontend/images/icon.svg') }}">
</head>

<body>
    <div class="container {{
    session('active_form') === 'register'
    || $errors->getBag('register')->any()
    ? 'right-panel-active'
    : ''
    }}" id="container">
        <!-- ĐĂNG NHẬP (BÊN TRÁI) -->
        <div class="form-container sign-in-container">
            <form method="post" action="{{ url('customers/login-post') }}">
                @csrf

                <h1>Đăng Nhập</h1>

                @error('credentials', 'login')
                    <div class="form-alert form-alert--error">
                        {{ $message }}
                    </div>
                @enderror

                @if (session('success'))
                    <div class="form-alert form-alert--success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="input-group">
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Email"
                        class="@error('email', 'login') input-error @enderror">

                    @error('email', 'login')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group">
                    <input type="password" name="password" placeholder="Mật khẩu"
                        class="@error('password', 'login') input-error @enderror">

                    @error('password', 'login')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <a href="#">Quên mật khẩu?</a>

                <button type="submit" class="btn">
                    Đăng Nhập
                </button>
            </form>
        </div>

        <!-- ĐĂNG KÝ (BÊN TRÁI KHI ACTIVE) -->
        <div class="form-container sign-up-container">
            <form method="post" action="{{ url('customers/register-post') }}">
                @csrf

                <h1>Đăng Ký</h1>

                <div class="input-group">
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Họ và tên"
                        class="@error('name', 'register') input-error @enderror">

                    @error('name', 'register')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group">
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Email"
                        class="@error('email', 'register') input-error @enderror">

                    @error('email', 'register')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group">
                    <input type="text" name="address" value="{{ old('address') }}" placeholder="Địa chỉ"
                        class="@error('address', 'register') input-error @enderror">

                    @error('address', 'register')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group">
                    <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Số điện thoại"
                        class="@error('phone', 'register') input-error @enderror">

                    @error('phone', 'register')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group">
                    <input type="password" name="password" placeholder="Mật khẩu"
                        class="@error('password', 'register') input-error @enderror">

                    @error('password', 'register')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group">
                    <input type="password" name="password_confirmation" placeholder="Nhập lại mật khẩu">
                </div>

                <button type="submit" class="btn">
                    Đăng Ký
                </button>
            </form>
        </div>

        <!-- OVERLAY (BÊN PHẢI - TRƯỢT QUA TRÁI) -->
        <div class="overlay-container">
            <div class="overlay">
                <!-- Panel hiển thị khi ở trang Đăng Ký -->
                <div class="overlay-panel overlay-left">
                    <svg class="icon-welcome" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                        <!-- Khói -->
                        <path d="M 90 40 Q 85 30 90 20" stroke="#fff" stroke-width="3" fill="none" opacity="0.7"
                            stroke-linecap="round">
                            <animate attributeName="d"
                                values="M 90 40 Q 85 30 90 20;M 90 40 Q 95 30 90 20;M 90 40 Q 85 30 90 20" dur="2s"
                                repeatCount="indefinite" />
                        </path>
                        <path d="M 100 45 Q 95 35 100 25" stroke="#fff" stroke-width="3" fill="none" opacity="0.7"
                            stroke-linecap="round">
                            <animate attributeName="d"
                                values="M 100 45 Q 95 35 100 25;M 100 45 Q 105 35 100 25;M 100 45 Q 95 35 100 25"
                                dur="2s" repeatCount="indefinite" begin="0.3s" />
                        </path>
                        <path d="M 110 40 Q 105 30 110 20" stroke="#fff" stroke-width="3" fill="none" opacity="0.7"
                            stroke-linecap="round">
                            <animate attributeName="d"
                                values="M 110 40 Q 105 30 110 20;M 110 40 Q 115 30 110 20;M 110 40 Q 105 30 110 20"
                                dur="2s" repeatCount="indefinite" begin="0.6s" />
                        </path>
                        <!-- Cốc cà phê -->
                        <path d="M 70 60 L 75 140 Q 75 155 100 155 Q 125 155 125 140 L 130 60 Z" fill="#fff" />
                        <ellipse cx="100" cy="60" rx="30" ry="8" fill="#8B4513" />
                        <!-- Tay cầm -->
                        <path d="M 130 80 Q 150 80 150 100 Q 150 120 130 120" stroke="#fff" stroke-width="5"
                            fill="none" />
                        <!-- Đĩa -->
                        <ellipse cx="100" cy="155" rx="45" ry="8" fill="#fff" opacity="0.6" />
                    </svg>
                    <h1>Chào Mừng Trở Lại!</h1>
                    <p>Đã có tài khoản rồi? Đăng nhập ngay để tiếp tục trải nghiệm nhé!</p>
                    <button type="button" class="btn-ghost" id="signIn">Đăng Nhập</button>
                </div>

                <!-- Panel hiển thị khi ở trang Đăng Nhập -->
                <div class="overlay-panel overlay-right">
                    <svg class="icon-welcome" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                        <!-- Vòng tròn nền -->
                        <circle cx="100" cy="100" r="90" fill="#fff" opacity="0.2" />
                        <!-- Hạt cà phê 1 -->
                        <ellipse cx="80" cy="90" rx="25" ry="35" fill="#8B4513" transform="rotate(-20 80 90)" />
                        <path d="M 65 75 Q 80 90 65 105" stroke="#fff" stroke-width="4" fill="none"
                            stroke-linecap="round" />
                        <!-- Hạt cà phê 2 -->
                        <ellipse cx="120" cy="110" rx="25" ry="35" fill="#8B4513" transform="rotate(20 120 110)" />
                        <path d="M 105 95 Q 120 110 105 125" stroke="#fff" stroke-width="4" fill="none"
                            stroke-linecap="round" />
                        <!-- Tim nhỏ -->
                        <path
                            d="M 100 50 L 95 45 Q 90 40 85 45 Q 80 50 85 60 L 100 75 L 115 60 Q 120 50 115 45 Q 110 40 105 45 Z"
                            fill="#FFD700" />
                    </svg>
                    <h1>Xin Chào Bạn Mới!</h1>
                    <p>Chưa có tài khoản? Đăng ký ngay để khám phá những điều tuyệt vời!</p>
                    <button type="button" class="btn-ghost" id="signUp">Đăng Ký</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const signUpButton = document.getElementById('signUp');
        const signInButton = document.getElementById('signIn');
        const container = document.getElementById('container');

        signUpButton.addEventListener('click', () => {
            container.classList.add('right-panel-active');
        });

        signInButton.addEventListener('click', () => {
            container.classList.remove('right-panel-active');
        });
    </script>

</body>
</htm