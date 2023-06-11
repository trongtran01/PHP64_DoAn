    <!-- phần trên cùng -->
     <div class="top">
        <div class="top-1">
            <div class="time"> <p>Giờ mở cửa: 8:00 - 20:00</p></div>
            <div class="wrap">
            <form action="" class="search" method="post">
               <input type="text" class="searchTerm" placeholder="Nhập từ khóa tìm kiếm...">
               <button type="Tìm" class="searchButton">
                <i class="fa-solid fa-magnifying-glass"></i>
              </button>
            </form>
         </div>
        </div>
    </div>
    <!-- Tạo box bao quanh -->
    <div class="wrapper">
        <!-- Menu-top -->
        <div class="menu-top">
            <!-- logo -->
            <div class="logo">
                <img src="{{ asset('frontend/images/logo.png') }}" alt="">
            </div>

            <!-- Login, logout, cart -->
            <div class="log">
                <ul>
                    @php
                        $customer_email = session()->get('customer_email');
                        // Có thể dùng cách khác: customer_email = Session::get('customer_email');
                    @endphp
                    @if(isset($customer_email))
                    <li style="margin-left: -150px"><a href="#"> xin chào {{ $customer_email }}</a>&nbsp;&nbsp;<a href="{{ url('customers/logout') }}">Đăng xuất</a></li>
                    @else
                    <li><a href="{{ url('customers/login') }}"> Đăng nhập</a></li>&nbsp; &nbsp; &nbsp;||
                    <li><a href="{{ url('customers/register') }}"> Đăng ký</a></li>
                    @endif
                    <li class="cart-lite">
                      <a href="{{ asset('cart') }}"><i class="fas fa-shopping-basket">&nbsp;</i>Giỏ hàng</a>
                      <div class="cart-dropdown">
                        <div class="cart-item">
                          <span class="product-name-cart">Sản phẩm 1</span>
                          <img src="{{ asset('frontend/images/logo_title.png') }}">
                          <span class="delete-button" onclick="removeItem(1)">&times;</span>
                        </div>
                        <a href="{{ asset('checkout') }}" class="checkout-button">Thanh toán</a>
                      </div>
                    </li>

                    <style>
                      .cart-lite {
                        position: relative;
                        display: inline-block;
                      }
                      
                      .cart-dropdown {
                        display: none;
                        position: absolute;
                        min-width: 200px;
                        max-height: 350px;
                        padding: 10px;
                        background-color: #f9f9f9;
                        border: 1px solid #CD2626;
                        border-radius: 5px;
                        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                        z-index: 1;
                      }
                      
                      .cart-lite:hover .cart-dropdown {
                        display: block;
                      }
                      
                      .cart-item {
                        display: flex;
                        align-items: center;
                        justify-content: space-between;
                        margin-bottom: 10px;
                      }
                      .cart-item img{
                        width: 50px;
                        height: 50px;
                      }
                      
                      .cart-item .product-name {
                        margin-right: 10px;
                      }
                      
                      .cart-item .delete-button {
                        color: red;
                        cursor: pointer;
                      }
                      
                      .checkout-button {
                        color: #fff !important;
                        display: block;
                        margin-top: 10px;
                        padding: 5px 10px;
                        background-color: #CD2626;
                        color: white;
                        border: 1px solid #CD2626;
                        border-radius: 5px;
                        cursor: pointer;
                      }
                      .checkout-button:hover{
                        color: #CD2626 !important;
                        background-color: #fff;
                      }
                    </style>

                    <script>
                      document.addEventListener("DOMContentLoaded", function() {
                        var cart = document.querySelector(".cart-lite");
                        var cartDropdown = document.querySelector(".cart-dropdown");
                        
                        cart.addEventListener("mouseover", function() {
                          cartDropdown.style.display = "block";
                        });
                        
                        cart.addEventListener("mouseout", function() {
                          cartDropdown.style.display = "none";
                        });
                      });
                    </script>

                </ul>
            </div>

            <div class="menu clearfix">
                <ul>
                    <li><a href="{{ asset('') }}">TRANG CHỦ</a></li>
                    <li><a href="#">GIỚI THIỆU</a></li>
                    <li><a href="#">SẢN PHẨM</a> <i class="fas fa-angle-down"></i>
                        <ul style="text-align: center;" class="sub-menu">
                            <!-- Truy vấn cơ sở dữ liệu trực tiếp -->
                            @php
                                $categories = DB::table("categories")->where("parent_id","=",0)->orderBy("id", "desc")->get();
                            @endphp
                            @foreach($categories as $row)
                            <li><a href="{{ url('products/category/'.$row->id) }}">{{ $row->name }}</a>
                                @php
                                    $subCategories = DB::table("categories")->where("parent_id","=",$row->id)->orderBy("id", "desc")->get();
                                @endphp
                                <!-- Hàm kiểm tra xem biến $subCategories đã được khởi tạo và không phải null, sau đó mới đếm số phần tử trong danh sách và hiển thị menu cấp 2  -->
                                @if(isset($subCategories) && count($subCategories) > 0)
                                    <ul class="sub-menu2">
                                        <!-- Lặp qua danh sách các danh mục con -->
                                        @foreach($subCategories as $subRow)
                                            <li><a href="{{ url('products/category/'.$subRow->id) }}">{{ $subRow->name }}</a></li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                            @endforeach
                        </ul>
                    </li>
                    <li><a href="{{ asset('news') }}">TIN TỨC</a></li>                 
                    <li><a href="{{ asset('contact') }}">LIÊN HỆ</a></li>
                </ul>
            </div>
        </div>
        <!-- /Menu-top -->  
        <div class="line1"></div>

        <!-- under-top -->
        <div class="under-top">
            <ul>
                
                <li>
                    <i class="fas fa-truck fa-2x"></i>
                    <h2>Miễn phí vận chuyển</h2><br>Trong bán kính 50km
                </li>
                <li>
                    <i class="fas fa-stopwatch fa-2x"></i>
                    <h2>Đổi trả miễn phí</h2><br>Đổi trả sản phẩm trong 24h
                </li>
                <li>
                    <i class="fas fa-credit-card fa-2x"></i>
                    <h2>Thanh toán đa dạng</h2><br>Tiền mặt, thẻ tín dụng...
                </li>
                <li>
                    <i class="fas fa-comment-dots fa-2x"></i>
                    <h2>Tư vấn 24/7</h2><br>Hotline:<p style="color: #CD2626; font-weight: bold;">1900 6750</p>
                </li>
            </ul>
        </div>
        <!-- /under-top -->
