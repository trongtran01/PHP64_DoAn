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
                    <div class="password-wrapper">
                        <input type="password" name="password" placeholder="Mật khẩu"
                            autocomplete="current-password"
                            class="@error('password', 'login') input-error @enderror">

                        @include('frontend.partials.password_toggle')
                    </div>

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

                @include('frontend.partials.address_fields')

                <div class="input-group">
                    <input type="text" name="address" value="{{ old('address') }}" placeholder="Số nhà, tên đường"
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

                <div class="input-group password-field">
                    <div class="password-wrapper">
                        <input type="password" name="password" placeholder="Mật khẩu"
                            data-password-input autocomplete="new-password"
                            class="@error('password', 'register') input-error @enderror">

                        @include('frontend.partials.password_toggle')
                    </div>

                    <div class="password-strength" data-password-strength>
                        <div class="password-strength__bar">
                            <div class="password-strength__progress" data-level="empty"></div>
                        </div>

                        <div class="password-strength__content">
                            <span class="password-strength__text"></span>
                            <span class="password-strength__suggestion"></span>
                        </div>
                    </div>

                    @error('password', 'register')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group">
                    <div class="password-wrapper">
                        <input type="password" name="password_confirmation"
                            placeholder="Nhập lại mật khẩu" autocomplete="new-password">

                        @include('frontend.partials.password_toggle')
                    </div>
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
                    <svg class="icon-welcome" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <circle cx="100" cy="100" r="82" fill="#fff" opacity="0.18" />
                        <path d="M48 72h15l12 61h66l15-45H70" fill="none" stroke="#fff" stroke-width="7" stroke-linecap="round" stroke-linejoin="round" />
                        <circle cx="88" cy="151" r="8" fill="#fff" />
                        <circle cx="137" cy="151" r="8" fill="#fff" />
                        <path d="M91 91h39M91 108h27" stroke="#fff" stroke-width="5" stroke-linecap="round" opacity="0.9" />
                    </svg>
                    <h1>Chào Mừng Trở Lại!</h1>
                    <p>Đăng nhập để theo dõi đơn hàng và tiếp tục mua sắm dễ dàng.</p>
                    <button type="button" class="btn-ghost" id="signIn">Đăng Nhập</button>
                </div>

                <!-- Panel hiển thị khi ở trang Đăng Nhập -->
                <div class="overlay-panel overlay-right">
                    <svg class="icon-welcome" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <circle cx="100" cy="100" r="82" fill="#fff" opacity="0.18" />
                        <path d="M100 48l15 31 34 5-25 24 6 34-30-16-30 16 6-34-25-24 34-5z" fill="#fff" opacity="0.95" />
                        <circle cx="145" cy="55" r="8" fill="#FFD166" />
                        <circle cx="52" cy="128" r="6" fill="#FFD166" />
                    </svg>
                    <h1>Xin Chào Bạn Mới!</h1>
                    <p>Tạo tài khoản để lưu thông tin, theo dõi đơn hàng và nhận ưu đãi mới.</p>
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

        document.querySelectorAll('[data-password-input]').forEach((passwordInput) => {
            const passwordField = passwordInput.closest('.password-field');

            if (!passwordField) {
                return;
            }

            const strengthContainer = passwordField.querySelector(
                '[data-password-strength]'
            );

            if (!strengthContainer) {
                return;
            }

            const progress = strengthContainer.querySelector(
                '.password-strength__progress'
            );

            const strengthText = strengthContainer.querySelector(
                '.password-strength__text'
            );

            const suggestionText = strengthContainer.querySelector(
                '.password-strength__suggestion'
            );

            const rules = [
                {
                    test: (value) => value.length >= 8,
                    message: 'ít nhất 8 ký tự',
                },
                {
                    test: (value) => /[a-z]/.test(value),
                    message: 'chữ thường',
                },
                {
                    test: (value) => /[A-Z]/.test(value),
                    message: 'chữ hoa',
                },
                {
                    test: (value) => /\d/.test(value),
                    message: 'số',
                },
                {
                    test: (value) => /[^A-Za-z0-9]/.test(value),
                    message: 'ký tự đặc biệt',
                },
            ];

            passwordInput.addEventListener('input', () => {
                const value = passwordInput.value;

                if (!value) {
                    strengthContainer.classList.remove('is-visible');
                    progress.style.width = '0';
                    progress.dataset.level = 'empty';
                    strengthText.textContent = '';
                    suggestionText.textContent = '';

                    return;
                }

                strengthContainer.classList.add('is-visible');

                const missingRules = rules.filter((rule) => {
                    return !rule.test(value);
                });

                const score = rules.length - missingRules.length;
                const percentage = (score / rules.length) * 100;

                progress.style.width = `${percentage}%`;

                if (score <= 2) {
                    strengthText.textContent = 'Mật khẩu yếu';
                    progress.dataset.level = 'weak';
                    strengthText.dataset.level = 'weak';
                } else if (score <= 4) {
                    strengthText.textContent = 'Mật khẩu trung bình';
                    progress.dataset.level = 'medium';
                    strengthText.dataset.level = 'medium';
                } else {
                    strengthText.textContent = 'Mật khẩu mạnh';
                    progress.dataset.level = 'strong';
                    strengthText.dataset.level = 'strong';
                }

                if (missingRules.length > 0) {
                    const missingMessages = missingRules.map((rule) => {
                        return rule.message;
                    });

                    suggestionText.textContent =
                        `Cần thêm: ${missingMessages.join(', ')}.`;
                } else {
                    suggestionText.textContent =
                        'Mật khẩu đã đáp ứng đầy đủ yêu cầu.';
                }
            });
        });
    </script>
    
    <script src="{{ asset('frontend/js/address-select.js') }}" defer></script>
    <script src="{{ asset('frontend/js/password-toggle.js') }}" defer></script>
</body>
</html>