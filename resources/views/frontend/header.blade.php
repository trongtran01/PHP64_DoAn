    <!-- phần trên cùng -->
     <div class="top">
        <div class="top-1">
            <div class="time"> <p>Giờ mở cửa: 8:00 - 20:00</p></div>
            <div class="wrap" style="position: absolute; left: 1000px; top: -5px;">
            <div class="header-search" style="margin-top: 0px"></div>
              <input style="color: #fff; font-family: monospace" type="text" onkeyup="ajaxSearch();" onkeypress="searchForm(event);" value="" placeholder="Nhập từ khóa tìm kiếm..." id="key" class="searchTerm">
              <button style="margin-top:5px;" type="submit" class="searchButton" onclick="location.href='{{ url('products/search') }}?key='+document.getElementById('key').value;">
                <i class="fa fa-search"></i>
              </button>
            </div>
            <div id="searchResults" class="search-result" style="list-style: none;">
              <ul></ul>
            </div>
         </div>
        </div>

        <style type="text/css">
          .header-search{
            position: relative;
        }
        .search-result {
          width: 359px;
          position: absolute;
          left: 1000px;
          top: 35px;
          z-index: 10;
          visibility: hidden;
          background-color: #fff;
          border: 3px solid #000;
          border-radius: 5px;
          max-height: 250px;
          overflow-y: auto;
        }

        .search-result ul {
          padding: 0;
          margin: 0;
          list-style: none;
        }

        .search-result ul li {
          padding: 10px;
          border-bottom: 1px solid #ddd;
          display: flex;
          align-items: center;
        }

        .search-result img {
          width: 40px;
          margin: 5px;
          left: 6px;
          border: 1px solid #000;
          border-radius: 10px;
        }

        .search-result a {
          font-size: 16px;
          text-decoration: none;
          color: #000;
          line-height: 40px;
          position: relative;
          top: -20px;
        }

        .search-result a:hover {
          text-decoration: underline;
        }

        /* Thanh cuộn */
        .search-result::-webkit-scrollbar {
          width: 8px;
        }

        .search-result::-webkit-scrollbar-track {
          background-color: #f1f1f1;
        }

        .search-result::-webkit-scrollbar-thumb {
          background-color: #888;
        }

        .search-result::-webkit-scrollbar-thumb:hover {
          background-color: #555;
        }
        .search-result .info {
          flex-grow: 1;
        }
        </style>

        <script type="text/javascript">
          function searchForm(event){
            if (event.which == 13) {
              searchProducts();
            }
          }

          function searchProducts() {
            let key = document.getElementById('key').value;
            if (key != '') {
              location.href = '{{ url('products/search') }}?key=' + key;
            }
          }

          function ajaxSearch() {
            let key = document.getElementById('key').value;
            if (key != '') {
              $(".search-result").css('visibility', 'visible');
              $.ajax({
                url: "{{ url('products/ajax-search') }}?key=" + key,
                success: function(result) {
                  $('#searchResults').empty();
                  $('#searchResults').append(result);
                }
              });
            } else {
              $(".search-result").css('visibility', 'hidden');
            }
          }
        </script>

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
                        $customer_name = session()->get('customer_name');
                        // Có thể dùng cách khác: customer_email = Session::get('customer_email');
                    @endphp
                    @if(isset($customer_email))
                    <li style="margin-left: -150px"><a href="#"> Xin chào {{ $customer_email }}</a>&nbsp;&nbsp;<a href="{{ url('customers/logout') }}">Đăng xuất</a></li>
                    @else
                    <li><a href="{{ url('customers/login') }}"> Đăng nhập</a></li>&nbsp; &nbsp; &nbsp;||
                    <li><a href="{{ url('customers/register') }}"> Đăng ký</a></li>
                    @endif

                    <?php
                        // Load file Cart.php vào đây để sử dụng
                        use App\Http\ShoppingCart\Cart;
                    ?>
                    @if(Cart::cartNumber() > 0)
                      <li class="cart-lite">
                        <a href="{{ asset('cart') }}"><i class="fas fa-shopping-basket">&nbsp;</i>Giỏ hàng</a>
                        @php
                          $cart = Cart::cartList();
                        @endphp
                        <div class="cart-dropdown">
                          <div class="cart-items">
                            @foreach($cart as $product)
                              <div class="cart-item">
                                <div style="width: 100px; text-align: center;" class="product-name-cart"><a href="{{ url('products/detail/'.$product['id']) }}">{{ $product['name'] }}</a></div>
                                <a href="{{ url('products/detail/'.$product['id']) }}">
                                    <img class="img-cart"
                                        alt="{{ $product['name'] }}"
                                        src="{{ asset('upload/products/'.$product['photo']) }}"
                                        title="{{ $product['name'] }}" class="img-responsive">
                                </a>
                                <div class="info">
                                  <p>{{ $product['quantity'] }} x {{ number_format($product['price']) }}₫</p>
                                </div>
                                <div><a href="{{ url('cart/delete/'.$product['id']) }}"><i class="fa fa-times"></i></a></div>
                              </div>
                            @endforeach
                          </div>
                          <a href="{{ url('cart/order') }}" class="checkout-button">Thanh toán</a>
                        </div>
                      </li>
                    @endif


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
                        z-index: 1;
                      }

                      .cart-lite:hover .cart-dropdown {
                        display: block;
                      }

                      .cart-items {
                        max-height: 280px;
                        overflow-y: auto;
                      }

                      .cart-item {
                        display: flex;
                        align-items: center;
                        justify-content: space-between;
                        margin-bottom: 10px;
                      }

                      .cart-item img {
                        width: 50px;
                        height: 50px;
                      }

                      .cart-item .info {
                        flex-grow: 1;
                        margin-left: 10px;
                      }

                      .cart-item .product-name-cart {
                        margin: 0;
                        word-wrap: break-word;
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

                      .checkout-button:hover {
                        color: #CD2626 !important;
                        background-color: #fff;
                      }
                      .img-cart {
                          margin-top: 10px;
                          margin-left: 10px;
                          border-radius: 10px;
                      }
                      .info p{
                          font-family: monospace !important;
                          font-weight: bold;
                          color: #CD2626;
                      }
                    </style>




                </ul>
            </div>

            <div class="menu clearfix">
                <ul>
                    <li><a href="{{ asset('') }}">TRANG CHỦ</a></li>
                    <li><a href="{{ asset('introduce') }}">GIỚI THIỆU</a></li>
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
                    <h2>Tư vấn 24/7</h2><br>Hotline:<p style="color: #CD2626; font-weight: bold; position: absolute; right: -8px; top: 185px;">0965 814 299</p>
                </li>
            </ul>
        </div>
        <!-- /under-top -->
