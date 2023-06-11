<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="{{ asset('Frontend/css/login.css') }}">
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('frontend/images/logo_title.png') }}" type="image/png" class="favicon-image">
    <style type="text/css">
        .favicon-image{
            width: 80px;
        }
    </style>
</head>
<body>
    <!-- Form log in -->
    <div class="container" id="container">
        <div class="form-container sign-up-container">
        </div>
        <div class="form-container sign-in-container">
            <form method="post" action="{{ url('customers/login-post') }}">

                @csrf
                <h1>Đăng nhập</h1>
                <!-- <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <span>or use your account</span> -->
                <input type="email" placeholder="Email" class="input-control" name="email" required="" />
                <input type="password" placeholder="Password" class="input-control" name="password" required="" />
                <a href="#">Quên mật khẩu?</a>
                <input style="background-color: #FF4B2B; color: #fff ; font-size: 15px; cursor: pointer; border: 1px solid #FF4B2B; border-radius: 20px" type="submit" class="button" value="Đăng nhập">
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Chào mừng bạn đã trở lại!</h1>
                    <button class="ghost" id="signIn">Đăng nhập</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Xin chào ^^!</h1>
                    <p>Hãy điền các thông tin của bạn và gia nhập với chúng tôi nào</p>
                    <a  href="{{ url('customers/register') }}"><button style="background-color: #CC3300; color: #fff; font-size: 20px; line-height: 20px; cursor: pointer; border: 1px solid #FF4B2B; border-radius: 20px" class="ghost" id="signUp">Đăng kí tài khoản</button></a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>