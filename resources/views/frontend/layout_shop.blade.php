<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <!-- Load font awsome online -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/shop.css') }}">
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
        	<!-- Menu-main-left -->
        	<div class="menu-main">
	          <div class="menu-main-left">
	            <ul>
	              <h2 style="margin-top: 8px;">DANH MỤC</h2>
	              <li><a href="{{ asset('') }}">Trang chủ</a></li>
	              <li><a href="{{ asset('introduce') }}">Giới thiệu</a></li>
	              <li><a style="color: #CD2626;" href="#"><b>Sản phẩm</b></a></li>
	              <li><a href="{{ asset('news') }}">Tin tức</a></li>
	              <li><a href="{{ asset('contact') }}">Liên hệ</a></li>
	            </ul>
	          </div>
	          <!-- /Menu-main-left -->
            <!-- main-product -->
            <div class="main-product">
                @php
                	function getCategoryName($category_id){
                		$record = DB::table("categories")->where("id", "=", $category_id)->select("name")->first();
                		return isset($record->name) ? $record->name : "";
                	}
                @endphp
                <ul>
                    <h1>{{ getCategoryName($category_id) }}

                        <div class="col-lg-3 pull-right text-right">
                        	<i class="fa-solid fa-layer-group" style="color: #CD2626;"></i>
			                <select style="width: 120px; border: 2px solid #CD2626; border-radius: 3px" class="form-control" onchange="location.href = '{{ url('products/category/'.$category_id.'?order=') }}'+this.value;">
			                  <option value="0">Sắp xếp</option>
			                  <option @if($order=='priceAsc') selected @endif value="priceAsc">Giá tăng dần</option>
			                  <option @if($order=='priceDesc') selected @endif value="priceDesc">Giá giảm dần</option>
			                  <option @if($order=='nameAsc') selected @endif value="nameAsc">Sắp xếp A-Z</option>
			                  <option @if($order=='nameDesc') selected @endif value="nameDesc">Sắp xếp Z-A</option>
			                </select>
			              </div>
                    </h1>
                    @foreach($data as $row)
                    <li>
                        <div class="tag">-{{$row->discount}}%</div>
                        <img src="{{asset('upload/products/'.$row->photo)}}" title="{{ $row->name }}">
                        <a href="{{ url('products/detail/'.$row->id) }}"><h3>{{ $row->name }}</h3>
                            <p class="p1">{{ number_format($row->price - ($row->price * $row->discount)/100) }}đ</p>
                            <p class="p3">{{ number_format($row->price) }}đ</p>
                            <a href="{{ asset('cart/buy/'.$row->id) }}"><input class="add-to-cart" type="button" submit="" value="Thêm vào giỏ hàng"></a>
                        </a>
                    </li>
                    @endforeach
                    <div>
                    	{{ $data->render() }}
                    </div>
                </ul>
            </div>
            <!-- /main-product -->

            <div style="margin-top: -600px;" class="support">
                <ul>
                    <h3>Hỗ trợ trực tuyến</h3>
                    <li><b>Hỗ trợ bán hàng</b></li>
                    <br>
                    <div class="logo-fb">
                        <i class="fa-brands fa-square-facebook fa-2xl" style="color: #3B5998;"></i>
                    </div>
                    <li class="box-chat"><a href="https://www.facebook.com/nnthai0762/" target="_blank">Chat ngay để được tư vấn</a></li>
                </ul>
            </div>

            <div style="margin-top: -620px;" class="blog">
                <div class="blog-title">
                    <ul><h3>Tin tức đáng chú ý</h3>
                         @php
                            $news = \App\Http\Controllers\Frontend\HomeController::hotNews();
                        @endphp
                        @foreach($news as $row)
                        <li style="border: none; height: 350px; overflow: hidden;">
                            <img style="width: 215px;" src="{{ asset('upload/news/'.$row->photo) }}" alt="{{ $row->name }}" title="{{ $row->name }}">
                            <a href="{{ url('news/detail/'.$row->id) }}">{{ $row->name }}</a>
                            <br>
                            <a href="{{ url('news/detail/'.$row->id) }}" class="blog-detail"></a>
                                <!-- Liên quan đến ck editor dùng tag sau -->
                                {!! $row->description !!}
                            </li>
                            @endforeach

                        </ul>
                </div>
            </div>

        </div>

        <!-- Footer -->
    <div style="margin-top:1000px" class="footer">
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
