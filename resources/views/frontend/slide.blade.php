        <!-- Menu-main -->
        <div class="menu-main">
          <!-- Menu-main-left -->
          <div class="menu-main-left">
            <ul>
              <h2 style="margin-top: 8px;">DANH MỤC</h2>
              <li><a href="{{ asset('') }}">Trang chủ</a></li>
              <li><a href="#">Giới thiệu</a></li>
              <li><a href="#">Sản phẩm</a></li>
              <li><a href="{{ asset('news') }}">Tin tức</a></li>
              <li><a href="{{ asset('contact') }}">Liên hệ</a></li>
            </ul>
          </div>
          <!-- /Menu-main-left -->

          <!-- Banner -->
          <div class="banner">
            <img src="{{ asset('frontend/images/banner.webp') }}" class="banner-show">
            <div class="next"><i class="fa-solid fa-circle-right"></i></div>
            <div class="prev"><i class="fa-solid fa-circle-left"></i></div>
          </div>
          <script>
            $(document).ready(function() {
              let arr_banner = [];
              arr_banner[0] = "frontend/images/banner.webp";
              arr_banner[1] = "frontend/images/banner1.webp";
              arr_banner[2] = "frontend/images/banner2.webp";
              arr_banner[3] = "frontend/images/banner3.webp";
              let n = 0;

              // Hàm chuyển đổi hình ảnh trong banner
              function changeBanner() {
                $(".banner-show").fadeOut(function() {
                  $(".banner-show").attr("src", arr_banner[n]);
                  $(".banner-show").fadeIn();
                });

                n++;
                if (n == arr_banner.length) {
                  n = 0;
                }
              }

              // Gọi hàm chuyển đổi sau mỗi 3 giây (hoặc thời gian mong muốn)
              setInterval(changeBanner, 3000);

              $(".next").on('click', function() {
                n++;
                if (n == arr_banner.length) {
                  n = 0;
                }
                $(".banner-show").fadeOut(function() {
                  $(".banner-show").attr("src", arr_banner[n]);
                  $(".banner-show").fadeIn();
                });
              });

              $(".prev").on('click', function() {
                n--;
                if (n < 0) {
                  n = arr_banner.length - 1;
                }
                $(".banner-show").fadeOut(function() {
                  $(".banner-show").attr("src", arr_banner[n]);
                  $(".banner-show").fadeIn();
                });
              });
            });
          </script>
          <!-- /Banner -->
        </div>
        <!-- /Menu-main -->
