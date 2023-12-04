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
        <p>Trụ sở chính : Tầng 14-16-18-19 Tòa nhà Viwaseen, 48 P. Tố Hữu, Trung Văn, Nam Từ Liêm, Hà Nội, Việt Nam
        </p>
        <br>
        <p>Điện thoại : (09) 65 814 299</p>
    </p>
    <div class="row">
        <div>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.8621076129175!2d105.79173647504788!3d20.998163888829104!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135acceab97eb83%3A0x4f8b021cef05e348!2zQ8O0bmcgVHkgxJDhuqd1IFTGsCBDw7RuZyBOZ2jhu4cgVGjDoG5oIEPDtG5n!5e0!3m2!1svi!2sus!4v1701663957942!5m2!1svi!2sus" style="border:0; width: 100%; height: 500px; margin-top: 50px" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
@endsection
</body>
</html>
