<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Đăng Nhập / Đăng Ký</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    padding: 20px;
}

.container {
    position: relative;
    width: 900px;
    max-width: 100%;
    min-height: 550px;
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    overflow: hidden;
}

/* Form Containers */
.form-container {
    position: absolute;
    top: 0;
    height: 100%;
    width: 50%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 0 40px;
    transition: all 0.6s ease-in-out;
}

.sign-in-container {
    left: 0;
    z-index: 2;
}

.sign-up-container {
    left: 0;
    z-index: 1;
    opacity: 0;
}

/* Active State */
.container.right-panel-active .sign-in-container {
    transform: translateX(100%);
    opacity: 0;
    z-index: 1;
}

.container.right-panel-active .sign-up-container {
    transform: translateX(100%);
    opacity: 1;
    z-index: 2;
}

/* Form Styles */
form {
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
}

h1 {
    font-size: 32px;
    font-weight: 700;
    color: #333;
    margin-bottom: 30px;
    animation: fadeInDown 0.8s ease;
}

.input-group {
    position: relative;
    width: 100%;
    margin-bottom: 20px;
}

input {
    width: 100%;
    padding: 15px 20px;
    border: 2px solid #e0e0e0;
    border-radius: 50px;
    font-size: 14px;
    font-family: 'Poppins', sans-serif;
    transition: all 0.3s ease;
    background: #f8f8f8;
}

input:focus {
    outline: none;
    border-color: #667eea;
    background: #fff;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.2);
}

.btn {
    width: 100%;
    padding: 15px 40px;
    border: none;
    border-radius: 50px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #fff;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-top: 10px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
}

.btn:active {
    transform: translateY(-1px);
}

a {
    color: #667eea;
    text-decoration: none;
    font-size: 14px;
    margin-top: 15px;
    transition: all 0.3s ease;
}

a:hover {
    color: #764ba2;
    text-decoration: underline;
}

/* Overlay Container */
.overlay-container {
    position: absolute;
    top: 0;
    left: 50%;
    width: 50%;
    height: 100%;
    overflow: hidden;
    transition: transform 0.6s ease-in-out;
    z-index: 100;
}

.container.right-panel-active .overlay-container {
    transform: translateX(-100%);
}

.overlay {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    background-size: cover;
    color: #fff;
    position: relative;
    left: -100%;
    height: 100%;
    width: 200%;
    transform: translateX(0);
    transition: transform 0.6s ease-in-out;
}

.container.right-panel-active .overlay {
    transform: translateX(50%);
}

.overlay-panel {
    position: absolute;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 0 40px;
    text-align: center;
    top: 0;
    height: 100%;
    width: 50%;
    transform: translateX(0);
    transition: transform 0.6s ease-in-out;
}

.overlay-left {
    transform: translateX(-20%);
}

.container.right-panel-active .overlay-left {
    transform: translateX(0);
}

.overlay-right {
    right: 0;
    transform: translateX(0);
}

.container.right-panel-active .overlay-right {
    transform: translateX(20%);
}

.overlay-panel h1 {
    color: #fff;
    font-size: 36px;
    margin-bottom: 20px;
}

.overlay-panel p {
    font-size: 16px;
    font-weight: 300;
    line-height: 1.6;
    margin-bottom: 30px;
    opacity: 0.9;
}

.icon-welcome {
    width: 150px;
    height: 150px;
    margin-bottom: 30px;
    animation: float 3s ease-in-out infinite;
}

@keyframes float {
    0%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-20px);
    }
}

.btn-ghost {
    background: transparent;
    border: 2px solid #fff;
    color: #fff;
    padding: 12px 50px;
    border-radius: 50px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.btn-ghost:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: scale(1.05);
    box-shadow: 0 5px 20px rgba(255, 255, 255, 0.3);
}

@keyframes fadeInDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive */
@media (max-width: 768px) {
    .container {
        min-height: 600px;
        flex-direction: column;
    }
    
    .form-container {
        width: 100%;
        padding: 30px;
    }
    
    .sign-in-container {
        top: 0;
    }
    
    .sign-up-container {
        top: 0;
    }
    
    .container.right-panel-active .sign-in-container {
        transform: translateY(-100%);
    }
    
    .container.right-panel-active .sign-up-container {
        transform: translateY(0);
    }
    
    .overlay-container {
        width: 100%;
        height: 50%;
        top: 50%;
        left: 0;
    }
    
    .container.right-panel-active .overlay-container {
        transform: translateY(-100%);
    }
    
    .overlay {
        left: 0;
        width: 100%;
        height: 200%;
        top: -100%;
    }
    
    .overlay-panel {
        width: 100%;
        padding: 20px;
    }
    
    .overlay-left,
    .overlay-right {
        transform: translateX(0);
        height: 50%;
    }
    
    .overlay-right {
        top: 0;
    }
    
    .overlay-left {
        top: 50%;
    }
    
    .icon-welcome {
        width: 100px;
        height: 100px;
        margin-bottom: 20px;
    }
}
</style>
</head>
<body>

<div class="container" id="container">
    <!-- ĐĂNG NHẬP (BÊN TRÁI) -->
    <div class="form-container sign-in-container">
        <form method="post" action="{{ url('customers/login-post') }}">
            @csrf
            <h1>Đăng Nhập</h1>
            <div class="input-group">
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class="input-group">
                <input type="password" name="password" placeholder="Mật khẩu" required>
            </div>
            <a href="#">Quên mật khẩu?</a>
            <button type="submit" class="btn">Đăng Nhập</button>
        </form>
    </div>

    <!-- ĐĂNG KÝ (BÊN TRÁI KHI ACTIVE) -->
    <div class="form-container sign-up-container">
        <form method="post" action="{{ url('customers/register-post') }}">
            @csrf
            <h1>Đăng Ký</h1>
            <div class="input-group">
                <input type="text" name="name" placeholder="Họ và tên" required>
            </div>
            <div class="input-group">
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class="input-group">
                <input type="text" name="address" placeholder="Địa chỉ">
            </div>
            <div class="input-group">
                <input type="text" name="phone" placeholder="Số điện thoại">
            </div>
            <div class="input-group">
                <input type="password" name="password" placeholder="Mật khẩu" required>
            </div>
            <button type="submit" class="btn">Đăng Ký</button>
        </form>
    </div>

    <!-- OVERLAY (BÊN PHẢI - TRƯỢT QUA TRÁI) -->
    <div class="overlay-container">
        <div class="overlay">
            <!-- Panel hiển thị khi ở trang Đăng Ký -->
            <div class="overlay-panel overlay-left">
                <svg class="icon-welcome" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                    <!-- Khói -->
                    <path d="M 90 40 Q 85 30 90 20" stroke="#fff" stroke-width="3" fill="none" opacity="0.7" stroke-linecap="round">
                        <animate attributeName="d" values="M 90 40 Q 85 30 90 20;M 90 40 Q 95 30 90 20;M 90 40 Q 85 30 90 20" dur="2s" repeatCount="indefinite"/>
                    </path>
                    <path d="M 100 45 Q 95 35 100 25" stroke="#fff" stroke-width="3" fill="none" opacity="0.7" stroke-linecap="round">
                        <animate attributeName="d" values="M 100 45 Q 95 35 100 25;M 100 45 Q 105 35 100 25;M 100 45 Q 95 35 100 25" dur="2s" repeatCount="indefinite" begin="0.3s"/>
                    </path>
                    <path d="M 110 40 Q 105 30 110 20" stroke="#fff" stroke-width="3" fill="none" opacity="0.7" stroke-linecap="round">
                        <animate attributeName="d" values="M 110 40 Q 105 30 110 20;M 110 40 Q 115 30 110 20;M 110 40 Q 105 30 110 20" dur="2s" repeatCount="indefinite" begin="0.6s"/>
                    </path>
                    <!-- Cốc cà phê -->
                    <path d="M 70 60 L 75 140 Q 75 155 100 155 Q 125 155 125 140 L 130 60 Z" fill="#fff"/>
                    <ellipse cx="100" cy="60" rx="30" ry="8" fill="#8B4513"/>
                    <!-- Tay cầm -->
                    <path d="M 130 80 Q 150 80 150 100 Q 150 120 130 120" stroke="#fff" stroke-width="5" fill="none"/>
                    <!-- Đĩa -->
                    <ellipse cx="100" cy="155" rx="45" ry="8" fill="#fff" opacity="0.6"/>
                </svg>
                <h1>Chào Mừng Trở Lại!</h1>
                <p>Đã có tài khoản rồi? Đăng nhập ngay để tiếp tục trải nghiệm nhé!</p>
                <button class="btn-ghost" id="signIn">Đăng Nhập</button>
            </div>
            
            <!-- Panel hiển thị khi ở trang Đăng Nhập -->
            <div class="overlay-panel overlay-right">
                <svg class="icon-welcome" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                    <!-- Vòng tròn nền -->
                    <circle cx="100" cy="100" r="90" fill="#fff" opacity="0.2"/>
                    <!-- Hạt cà phê 1 -->
                    <ellipse cx="80" cy="90" rx="25" ry="35" fill="#8B4513" transform="rotate(-20 80 90)"/>
                    <path d="M 65 75 Q 80 90 65 105" stroke="#fff" stroke-width="4" fill="none" stroke-linecap="round"/>
                    <!-- Hạt cà phê 2 -->
                    <ellipse cx="120" cy="110" rx="25" ry="35" fill="#8B4513" transform="rotate(20 120 110)"/>
                    <path d="M 105 95 Q 120 110 105 125" stroke="#fff" stroke-width="4" fill="none" stroke-linecap="round"/>
                    <!-- Tim nhỏ -->
                    <path d="M 100 50 L 95 45 Q 90 40 85 45 Q 80 50 85 60 L 100 75 L 115 60 Q 120 50 115 45 Q 110 40 105 45 Z" fill="#FFD700"/>
                </svg>
                <h1>Xin Chào Bạn Mới!</h1>
                <p>Chưa có tài khoản? Đăng ký ngay để khám phá những điều tuyệt vời!</p>
                <button class="btn-ghost" id="signUp">Đăng Ký</button>
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