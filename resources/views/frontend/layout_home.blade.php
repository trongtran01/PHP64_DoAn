<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
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
    </style>
</head>
<body>
        <!-- Load header của trang web vào đây -->
        @include("frontend.header")

        <!-- Đổ dữ liệu của product vào đây -->
        @yield("do-du-lieu-vao-layout")

    </div>
    <!-- Footer -->
    <div class="footer">
        <div class="info">
            <ul><h2>THÔNG TIN CÔNG TY</h2>
                <li><a href="#">Trang chủ</a></li>
                <li><a href="#">Giới thiệu</a></li>
                <li><a href="#">Sản phẩm</a></li>
                <li><a href="#">Tin tức</a></li>
                <li><a href="#">Liên hệ</a></li>
            </ul>

            <ul><h2>HỖ TRỢ KHÁCH HÀNG</h2>
                <li><a href="#">Trang chủ</a></li>
                <li><a href="#">Giới thiệu</a></li>
                <li><a href="#">Sản phẩm</a></li>
                <li><a href="#">Tin tức</a></li>
                <li><a href="#">Liên hệ</a></li>
            </ul>

            <ul><h2>CHÍNH SÁCH MUA HÀNG</h2>
                <li><a href="#">Trang chủ</a></li>
                <li><a href="#">Giới thiệu</a></li>
                <li><a href="#">Sản phẩm</a></li>
                <li><a href="#">Tin tức</a></li>
                <li><a href="#">Liên hệ</a></li>
            </ul>

            <ul class="footer4"><h2>KÊNH THÔNG TIN</h2>
                <li>Suplement Brothers là thương hiệu cung cấp <br> thực phẩm bổ sung nổi tiếng tại Hà Nội và <br> TP Hồ Chí Minh</li>
                <div class="logo-footer"><a href="#"><i class="fa-brands fa-square-facebook fa-2xl" style="color: #346fd5;"></i></a></div>
                <div class="logo-footer"><a href="#"><i class="fa-brands fa-square-google-plus fa-2xl" style="color: #d83b3b;"></i></a></div>
                <div class="logo-footer"><a href="#"><i class="fa-brands fa-square-twitter fa-2xl" style="color: #0ea2e1;"></i></a></div>
                <div class="logo-footer logo-footer__logo-bct"><img src="frontend/images/bct.png" alt=""></div>
  
        </div>
        <div class="raw-company">
            <ul><h2>CÔNG TY TNHH SUPLEMENT BROTHERS</h2>
            <li>Trụ sở chính : Tầng 4 - Tòa nhà Hanoi Group - 442 Đội Cấn - Ba Đình - Hà Nội <br> Điện thoại : (04) 6674 2332 - (04) 3786 8904</li>
            <li>Văn phòng đại diện : Lầu 3 - Tòa nhà Lữ Gia - Số 70 Lữ Gia - P.15 - Q.11 - TP. HCM <br> Điện thoại : (08) 6680 9686 - (04) 3866 6276</li>
            </ul>
        </div>

        <div class="last-footer">
            © Bản quyền thuộc về Suplement Brothers | Cung cấp bởi <a href="#" style="color: #CD2626;">Trần Bình Trọng</a>
        </div>
    </div>

</body>
</html>