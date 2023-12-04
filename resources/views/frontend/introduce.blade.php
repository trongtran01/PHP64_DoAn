<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Giới thiệu</title>
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
@extends("frontend.layout_home")
@section("do-du-lieu-vao-layout")
    <div class="row">
        <div>
            <h1 class="introduce-header">
                Your Supplement - Thương hiệu thực phẩm bổ sung uy tín số 1 Việt Nam.
            </h1>
            <p class="introduce-text">
                Được biết đến như một trong những hệ thống phân phối các sản phẩm thực phẩm bổ sung và dinh dưỡng thể thao nhập khẩu chính đầu tiên ở Việt Nam, Your Supplement.vn đã ghi dấu ấn đậm nét trong lòng bao thế hệ gymer Việt với những sản phẩm cao cấp, đáp ứng đúng nhu cầu thực tế của người chơi thể hình.
            </p>
            <div class="intro-image">
                <img src="frontend/images/sub_banner1.jpg" alt="">
            </div>
            <p class="introduce-text">
                Thị trường thực phẩm bổ sung với đặc tính 100% nhập khẩu nước ngoài vốn có rất nhiều các loại hàng giả hàng nhái kém chất lượng, khó khăn trong việc xác định nguồn gốc xuất xứ nên cần phải có một địa chỉ đáng tin cậy để khách hàng yên tâm mua sắm, tạo dựng niềm tin cho người tiêu dùng. Do đó Your Supplement đã ra đời với mong muốn trở thành cầu nối giúp gymer tiếp cận được gần hơn với xác sản phẩm nâng cao tầm vóc và hình thể chất lượng cao.
            </p>
            <div class="intro-image">
                <img src="frontend/images/sub_banner2.jpg" alt="">
            </div>
            <h1 class="introduce-header">
                Tại sao bạn nên mua hàng tại Your Supplement
            </h1>
            <div class="intro-image">
                <img src="frontend/images/banner3.jpg" alt="">
            </div>
            <p class="introduce-text">
                100% sản phẩm đều là hàng nhập khẩu chính hãng từ các thương hiệu nổi tiếng ở các quốc gia như Mỹ, Úc, Canada, Balan,… Nhiều sản phẩm có tem mác chống giả do nhà sản xuất và đơn vị nhập khẩu niêm phong mà bạn hoàn toàn có thể đối chiếu thông tin trên website. Khi nhà sản xuất có điều chỉnh giá cả hay mẫu mã cũng được chúng tôi thông báo kịp thời để khách hàng nắm bắt thông tin. Theo Your Supplement, đây là cách đơn giản và bền vững nhất để thu hút khách hàng, cũng là điều mà khách hàng cần nhất khi tìm đến Your Supplement.
            </p>
            <br>
            <br>
            <p class="last-text"><i><b> -Theo báo Fitness Việt Nam 2023- </b></i></p>
        </div>
    </div>
    <style>
        .row {
            width: 900px;
            margin: auto;
        }
        .introduce-header {
            text-align: center;
            font-size: 30px;
            color: #cd2626;
            font-weight: bolder;
            margin-top: 50px;
        }
        .introduce-text {
            color: #3C4858;
            margin-top: 15px;
            font-size: 20px;
        }
        .intro-image img{
            width: 900px;
            margin-top: 20px;
        }
        .last-text {
            float: right;
            padding-bottom: 20px;
        }
    </style>
@endsection

</body>
</html>
