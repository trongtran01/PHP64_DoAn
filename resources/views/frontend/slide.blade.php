        <!-- Menu-main -->
        <div style="margin-bottom:100px" class="menu-main">
          <!-- Menu-main-left -->
          <div class="menu-main-left">
            <ul>
              <h2 style="margin-top: 8px;">DANH MỤC</h2>
              <li><a href="{{ asset('') }}">Trang chủ</a></li>
              <li><a href="#">Giới thiệu</a></li>
              <li><a href="#">Sản phẩm</a></li>
              <!-- Truy vấn cơ sở dữ liệu trực tiếp -->
                            @php
                                $categories = DB::table("categories")->where("parent_id","=",0)->orderBy("id", "desc")->get();
                            @endphp
                            @foreach($categories as $row)
                            <li><a style="margin-left: 20px" href="{{ url('products/category/'.$row->id) }}">- {{ $row->name }}</a>
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
              <li><a href="#">Tin tức</a></li>
              <li><a href="{{ asset('contact') }}">Liên hệ</a></li>
            </ul>
          </div>
          <!-- /Menu-main-left -->
          <div class="home-banners">
              @foreach($banners as $banner)
              <div class="banner-item">
                  <img src="{{ asset('storage/banner/'.$banner->photo) }}" alt="{{ $banner->title }}">
                  @if($banner->title || $banner->short_description)
                  <div class="banner-content">
                      <h3>{{ $banner->title }}</h3>
                      <p>{{ $banner->short_description }}</p>
                      @if($banner->button_url)
                          <a href="{{ $banner->button_url }}" class="btn btn-primary">Xem ngay</a>
                      @endif
                  </div>
                  @endif
              </div>
              @endforeach
          </div>
        </div>
        <!-- /Menu-main -->
