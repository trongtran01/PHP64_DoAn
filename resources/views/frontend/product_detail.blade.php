<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail</title>
    <!-- Load font awsome online -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/shop.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/product_detail.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        <br>
        <div class="line1"></div>
    	<br>
    	@php
        	function getCategoryName($category_id){
        		$record = DB::table("categories")->where("id", "=", $category_id)->select("name")->first();
        		return isset($record->name) ? $record->name : "";
        	}
        @endphp
        <!-- Product detail -->
        <div class="product-detail">
            <div class="product-images">
                <div class="box">
                    <img id="show-image" src="{{ asset('upload/products/'.$record->photo) }}">
                </div>
            </div>

            <div class="product-name">
                <h1>{{ $record->name }}</h1>
                <div class="category-name">
                    <p class="text1">Loại: </p>
                    <p class="text2">{{ getCategoryName($record->category_id) }}</p>
                </div>
                <div class="product-cost">
                    <p class="text3">{{ number_format($record->price - ($record->price * $record->discount)/100) }}₫</p>
                    <p class="text4">{{ number_format($record->price) }}₫</p>
                </div>
                <div class="description">
                    <p><b>Mô tả :</b></p>
                    <p>{!! $record->description !!}</p>
                </div>

                <div class="add-button">
                    <a href="{{ asset('cart/buy/'.$record->id) }}"><input class="add-cart-button" type="button" value="THÊM VÀO GIỎ HÀNG"></a>
                </div>
            </div>
            <div class="product-service">
                <ul class="service-item">
                    <h3>Đánh giá của khách hàng</h3>
                    <div class="stars">
                        <form action="">
                          <input class="star star-5" id="star-5" type="radio" name="star"/>
                          <label class="star star-5" for="star-5"></label>
                          <input class="star star-4" id="star-4" type="radio" name="star"/>
                          <label class="star star-4" for="star-4"></label>
                          <input class="star star-3" id="star-3" type="radio" name="star"/>
                          <label class="star star-3" for="star-3"></label>
                          <input class="star star-2" id="star-2" type="radio" name="star"/>
                          <label class="star star-2" for="star-2"></label>
                          <input class="star star-1" id="star-1" type="radio" name="star"/>
                          <label class="star star-1" for="star-1"></label>
                        </form>
                      </div>

                </ul>
                <ul class="service-item">
                    <i class="fa-sharp fa-solid fa-truck-fast fa-beat fa-2xl"></i>
                    <h3 >Miễn phí vận chuyển với đơn hàng lớn hơn 1.000.000₫</h3>
                </ul>
                <ul class="service-item">
                    <i class="fa-solid fa-check fa-bounce fa-2xl"></i>
                    <h3 >Giao ngày sau khi đặt hàng với Hà Nội Và TP. Hồ Chí Minh</h3>
                </ul>
                <ul class="service-item">
                    <i class="fa-solid fa-rotate fa-spin fa-2xl"></i>
                    <h3 >Đổi trả trong vòng 3 ngày, thủ tục đơn giản</h3>
                </ul>
            </div>
        </div>
        <!-- /Product detail -->
        <div class="content-product">
            <div class="content-product-title">
                <p class="title-product">Chi tiết sản phẩm</p>
            </div>
            <div class="content-product-body">
                <p>{!! $record->content !!}</p>
            </div>
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

</body>
</html>
