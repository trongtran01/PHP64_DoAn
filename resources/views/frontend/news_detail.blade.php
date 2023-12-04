
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tin tức</title>
    <!-- Load font awsome online -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/css/new.css') }}">
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
<div class="news-detail-container">
    <!-- Load header của trang web vào đây -->
    @include("frontend.header")
    <div class="menu-main-left">
        <ul><h2>DANH MỤC TIN TỨC</h2>
            <li><a href="#">Trang chủ</a></li>
            <li><a href="#">Giới thiệu</a></li>
            <li><a href="#">Sản phẩm</a></li>
            <li><a style="color: #CD2626;" href="#"><b>Tin tức</b></a></li>
            <li><a href="#">Liên hệ</a></li>
        </ul>
    </div>
    <!-- Product detail -->
    <h1 class="news-title" style="color: #cd2626; font-weight: bold">{!! $record->name !!}</h1>

    <div class="new-detail">
        <div class="new-description">
            <div class="description">
                <p>{!! $record->description !!}</p>
            </div>
        </div>
        <div class="new-content">
            <div class="content">
                <p>{!! $record->content !!}</p>
            </div>
        </div>
    </div>
    <style>
        .new-detail {
            width: 900px;
            color: #3C4858;
            margin-top: 300px;
            margin-left: 304px;
        }
        .new-detail img {
            width: 700px;
        }
        .new-description {
            margin-top: -650px;
        }
        .new-content {
            position: relative;
            font-weight: lighter;
        }
        .image {
            text-align: center;
        }
    </style>

    <div class="support1">
        <ul>
            <h3>Hỗ trợ trực tuyến</h3>
            <li><b>Hỗ trợ bán hàng</b></li>
            <br>
            <div class="logo-fb-1">
                <i class="fa-brands fa-square-facebook fa-2xl" style="color: #3B5998;"></i>
            </div>
            <li class="box-chat"><a href="#">Chat ngay để được tư vấn</a></li>
        </ul>
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
                <div class="logo-footer logo-footer__logo-bct"><img src="{{ asset('frontend/images/bct.png') }}" alt=""></div>

        </div>
        <div class="raw-company">
            <ul><h2>CÔNG TY TNHH SUPLEMENT BROTHERS</h2>
                <li>Trụ sở chính : Tầng 4 - Tòa nhà Hanoi Group - 442 Đội Cấn - Ba Đình - Hà Nội <br> Điện thoại : (04) 6674 2332 - (04) 3786 8904</li>
                <li>Văn phòng đại diện : Lầu 3 - Tòa nhà Lữ Gia - Số 70 Lữ Gia - P.15 - Q.11 - TP. HCM <br> Điện thoại : (08) 6680 9686 - (04) 3866 6276</li>
            </ul>
        </div>

        <div class="last-footer">
            © Bản quyền thuộc về Suplement Brothers | Cung cấp bởi <a href="#" style="color: #CD2626;">SUPLEMENT HOME</a>
        </div>
    </div>
</div>
</body>
</html>
