<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Liên hệ</title>
    <!-- Load font awsome online -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('frontend/images/logo_title.png') }}" type="image/png" class="favicon-image">
    <style type="text/css">
        .favicon-image{
            width: 80px;
        }
        .main-text {
            margin-top: 50px;
            font-size: 30px;
            color: #cd2626;
            font-weight: bolder;
        }
        .sub-text {
            margin-top: 15px;
            margin-bottom: 15px;
            font-size: 20px;
            color: #cd2626;
            font-weight: bolder;
        }
    </style>
</head>
<body>
@extends("frontend.layout_home")
@section("do-du-lieu-vao-layout")
    <h1 class="main-text">Trụ sở chính</h1>
    <p>
        <h2 class="sub-text">CÔNG TY TNHH SUPLEMENT HOME</h2>
        <p>Trụ sở chính : Toà Nhà Tasco Building, Mễ Trì, Nam Từ Liêm, Hà Nội, Việt Nam
        </p>
        <br>
        <p>Điện thoại : (+84) 966 370 255</p>
    </p>
    <div class="row">
        <div>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.440631355371!2d105.78086327479576!3d21.015048188250248!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab665b246041%3A0x9ad1900e23a69865!2sC%C3%B4ng%20Ty%20Tasco!5e0!3m2!1svi!2s!4v1702348120702!5m2!1svi!2s" style="border:0; width: 100%; height: 500px; margin-top: 50px" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
@endsection
</body>
</html>
