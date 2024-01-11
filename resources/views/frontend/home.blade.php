@extends("frontend.layout_home")
@section("do-du-lieu-vao-layout")
@include("frontend.slide")

	<!-- product -->
        <div class="product">
            <!-- Best seller -->
            <div  class="best-seller">
                <ul style="margin-left: 2px;"><h3 style="width: 200px;">Sản phẩm bán chạy
                </h3 >
                    @php
                        // Gọi hàm trong controller để lấy kết quả. Do hàm hotProducts là hàm static nên có thể truy cập từ tên class mà không cần khởi tạo đối tượng
                        $hotProducts = \App\Http\Controllers\Frontend\HomeController::hotProducts();
                    @endphp
                    @foreach($hotProducts as $row)
                    <li>
                        <img style="width: 80px; margin-top: 10px" src="{{ asset('upload/products/'.$row->photo) }}" alt="">
                        <a style="width: 100px" href="{{ url('products/detail/'.$row->id) }}">{{ $row->name }}
                            <p class="p1">{{ number_format($row->price - ($row->price * $row->discount)/100) }}đ</p>
                            <p class="p3">{{ number_format($row->price) }}đ</p>
                        </a>
                    </li>
                    @endforeach
                </ul>

            </div>
            <div style="margin-left: -30px; margin-top: 100px;" class="support">
                <ul>
                    <h3>Hỗ trợ trực tuyến</h3>
                    <li><b>Hỗ trợ bán hàng</b></li>
                    <br>
                    <div class="logo-fb">
                        <i class="fa-brands fa-square-facebook fa-2xl" style="color: #3B5998;"></i>
                    </div>
                    <li class="box-chat"><a href="https://www.facebook.com/nnthai0762/" target="_blank">Chat ngay để được tư vấn</a></li>
                </ul>
            </div>

            <div style="margin-left: -30px; margin-top: 100px;" class="blog">
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
            <!-- /Best seller -->

            <!-- Discout -->
            <div class="discout">
                <!-- Categories 2 -->
                <div style="margin-left: 10px; margin-top: 25px;" class="cate1">
                    @php
                    $categories = \App\Http\Controllers\Frontend\HomeController::getCategories();
                    @endphp
                    @foreach($categories as $rowCategory)
                    <h3 style="border-bottom: 3px solid #cd2626; padding-bottom: 5px; margin-top: 30px">
                        {{ $rowCategory->name }}
                    </h3>
                    <ul>
                        @php
                        $products = \App\Http\Controllers\Frontend\HomeController::getProductsInCategory($rowCategory->id);
                        @endphp
                        @foreach($products as $row)
                        <li style="height: 230px">
                            <div class="tag">-{{ $row->discount }}%</div>
                            <img style="width: 140px; margin-top: -30px;" src="{{ asset('upload/products/'.$row->photo) }}" alt="">
                            <a class="link-product" href="{{ url('products/detail/'.$row->id) }}">
                                <h4>{{ $row->name }}</h4>
                                <p class="p1">{{ number_format($row->price - ($row->price * $row->discount)/100) }}đ</p>
                                <p class="p3">{{ number_format($row->price) }}đ</p>
                                <a href="{{ asset('cart/buy/'.$row->id) }}"><input class="add-to-cart" type="button" submit="" value="Thêm vào giỏ hàng"></a>
                            </a>
                        </li>
                        <style type="text/css">
                            .cate1 ul li a:hover{
                                color: #cd2626;
                            }
                            .cate1 ul li p{
                                display: inline;
                                margin-left: 10px;
                            }
                            .cate1 ul li{
                                border: 1px solid #ccc;
                                border-radius: 5px;
                            }
                            .cate1 ul li:hover{
                                border: 1px solid #CD2626;
                            }
                            .cate1 ul li .link-product{
                                width: 170px;
                            }
                            .discout ul li a{
                                position: unset;
                            }
                            .add-to-cart{
                                margin-top: 10px;
                                height: 30px;
                                width: 180px;
                                border: #fff 1px solid;
                                background: #CD2626;
                                color: #fff;
                                font-size: 16px;
                                border-radius: 8px;
                            }
                            .add-to-cart:hover{
                                border: #CD2626 1px solid;
                                background: #fff;
                                color: #CD2626;
                            }
                        </style>
                        @endforeach
                    </ul>
                    @endforeach
                </div>
                <!-- Banner cuối -->
                <div class="sub-banner-next">
                    <img src="frontend/images/sub_banner3.webp" alt="">
                </div>
                <!-- /Banner cuối -->

                <!-- /Categories 2 -->

            </div>
        </div>
        <!-- /Product -->
@endsection
