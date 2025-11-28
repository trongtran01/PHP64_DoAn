<footer class="footer two-tone-footer">
  <div class="footer-top">
    <div class="footer-container">
      
      <div class="footer-column footer-brand-info">
        <h2>CÔNG TY TNHH CÀ PHÊ LÀ VIỆT</h2>
        <div class="contact-block">
          <strong>Số ĐKKD 5801206347 do Sở KHĐT Tp.Đà Lạt Cấp Ngày 29/08/2013</strong>
          <strong>Địa chỉ: Số 95b Hai Bà Trưng, P6, Tp. Đà Lạt, Lâm Đồng</strong>
          <strong>Điện thoại: 0263 3981 189</strong>
        </div>
      </div>

      <div class="footer-column">
        <h2>THÔNG TIN & HỖ TRỢ</h2>
        <ul class="link-list">
          <li><a href="#">Trang chủ</a></li>
          <li><a href="#">Giới thiệu</a></li>
          <li><a href="#">Sản phẩm</a></li>
          <li><a href="#">Tin tức</a></li>
          <li><a href="#">Liên hệ</a></li>
        </ul>
        <h2 class="mt-20">CHÍNH SÁCH</h2>
        <ul class="link-list">
          <li><a href="#">Chính sách bảo mật</a></li>
          <li><a href="#">Điều khoản sử dụng</a></li>
          <li><a href="#">Phương thức thanh toán</a></li>
        </ul>
      </div>

      <div class="footer-column">
        <h2>DỊCH VỤ KHÁCH HÀNG</h2>
        <ul class="link-list">
          <li><a href="#">Hướng dẫn mua hàng</a></li>
          <li><a href="#">Chính sách đổi trả</a></li>
          <li><a href="#">Bảo hành & bảo trì</a></li>
          <li><a href="#">Câu hỏi thường gặp</a></li>
          <li><a href="#">Liên hệ hỗ trợ</a></li>
        </ul>
        <h2 class="mt-20">PHÁP LÝ</h2>
        <ul class="link-list">
          <li><a href="#">Vận chuyển & giao hàng</a></li>
          <li><a href="#">Khuyến mãi & ưu đãi</a></li>
        </ul>
      </div>
      
      <div class="footer-column footer-social-cert">
        <h2>KẾT NỐI VỚI CHÚNG TÔI</h2>
        <div class="footer-socials">
          <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
          <a href="#" aria-label="Twitter"><i class="fa-brands fa-twitter"></i></a>
          <a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
          <a href="#" aria-label="Youtube"><i class="fa-brands fa-youtube"></i></a>
        </div>
        
        <div class="footer-cert">
          <img src="{{ asset('frontend/images/bct.png') }}" alt="Chứng nhận Bộ Công Thương">
        </div>
      </div>
    </div>
  </div>
  
  <div class="footer-bottom-bar">
    <div class="footer-container">
        <p>LAVIET.COFFEE PRIVACY POLICY ©2017 LAVIET CORPORATION. ALL RIGHTS RESERVED. | DESIGN WITH LOVE BY DVH</p>
    </div>
  </div>
</footer>

<style>
/* Màu sắc */
/* #242052: Tím đậm (Màu nền bottom) */
/* #ffffff: Trắng */
/* #efeeff: Tím nhạt (Màu nền top) */

.two-tone-footer {
  padding: 0; 
}

/* ----------------- PHẦN TRÊN: MÀU NHẠT (#efeeff) ----------------- */
.footer-top {
  background: #efeeff; /* Màu nền nhạt */
  color: #242052; /* Màu chữ đậm để tương phản */
  padding: 60px 20px;
}

.footer-container {
  display: grid;
  /* Bố cục desktop: 1.5fr + 1fr + 1fr + 1fr */
  grid-template-columns: 1.5fr repeat(3, 1fr); 
  gap: 30px;
  max-width: 1200px;
  margin: 0 auto;
}

.footer-column h2 {
  font-size: 1.1rem;
  /* Màu tiêu đề nổi bật: Màu đậm */
  color: #242052; 
  margin-bottom: 18px;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

/* Thêm đường kẻ dưới hiện đại cho tiêu đề */
.footer-column h2::after {
  content: '';
  display: block;
  width: 30px;
  height: 2px;
  /* Màu đường kẻ: Màu đậm */
  background: #242052; 
  margin-top: 5px;
}

.link-list {
  list-style: none;
  padding: 0;
}

.link-list li {
  margin-bottom: 8px;
}

.link-list li a {
  /* Màu liên kết mờ hơn */
  color: rgba(36, 32, 82, 0.7); /* Màu tím đậm mờ */
  text-decoration: none;
  font-size: 0.95rem;
  transition: color 0.2s, padding-left 0.2s;
  display: inline-block;
}

.link-list li a:hover {
  /* Màu nhấn phụ khi hover: Màu đậm hơn */
  color: #242052; 
  padding-left: 5px;
}

/* Style cho cột thông tin thương hiệu */
.footer-brand-info h2 {
    font-size: 1.4rem;
    color: #242052;
    margin-bottom: 10px;
}
.footer-brand-info h2::after {
    display: none;
}

.brand-description {
    font-size: 0.95rem;
    color: rgba(36, 32, 82, 0.7);
    margin-bottom: 25px;
    line-height: 1.6;
}

.contact-block {
    margin-top: 15px;
    font-size: 0.9rem;
    color: rgba(36, 32, 82, 0.7);
}
.contact-block strong {
    /* Màu nổi bật cho tiêu đề phụ: Màu đậm nhất */
    color: #242052; 
    display: block;
    margin-bottom: 25px;
}
.contact-block p {
    margin: 0;
}

/* Style cho mạng xã hội */
.footer-socials {
  display: flex;
  gap: 15px;
  margin-top: 20px;
  margin-bottom: 30px;
}

.footer-socials a {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 40px;
  height: 40px;
  /* Viền đậm mờ */
  border: 1px solid rgba(36, 32, 82, 0.3); 
  color: #242052; /* Màu icon đậm */
  font-size: 1.1rem;
  border-radius: 50%;
  transition: background-color 0.3s, color 0.3s, transform 0.3s;
}

.footer-socials a:hover {
  /* Đổi sang màu nhấn khi hover: Màu đậm */
  background-color: #242052; 
  color: #ffffff; /* Màu chữ đổi sang trắng */
  border-color: #242052;
  transform: translateY(-3px);
}

.footer-cert img {
  max-width: 150px;
  opacity: 0.8; /* Giữ mờ nhẹ, nhưng dễ thấy hơn trên nền sáng */
  transition: opacity 0.3s;
}
.footer-cert img:hover {
    opacity: 1;
}

.mt-20 {
    margin-top: 20px;
}

/* ----------------- PHẦN DƯỚI: MÀU ĐẬM (#242052) ----------------- */
.footer-bottom-bar {
    background: #242052; /* Màu nền đậm */
    color: #ffffff; /* Màu chữ trắng để tương phản */
    padding: 20px 20px;
    text-align: center;
    border-top: 1px solid rgba(255, 255, 255, 0.1); /* Đường kẻ phân cách nhẹ */
    font-size: 0.9rem;
}

.footer-bottom-bar .footer-container {
    /* Thiết lập lại grid 1 cột để căn giữa */
    grid-template-columns: 1fr;
    padding: 0;
}

.footer-bottom-bar p {
    margin: 0;
}

.footer-bottom-bar strong {
    color: #ffffff;
}

.footer-bottom-bar .brand-link {
  /* Liên kết nổi bật: Màu nhạt (#efeeff) */
  color: #efeeff; 
  font-weight: 500;
  text-decoration: none;
  transition: color 0.3s, border-bottom 0.3s;
  border-bottom: 1px solid transparent; 
}
.footer-bottom-bar .brand-link:hover {
  color: #ffffff; /* Đổi sang trắng khi hover */
  border-bottom: 1px solid #ffffff; 
}

/* ----------------- RESPONSIVE ----------------- */

/* Tablet (Từ 768px đến 1024px) */
@media (min-width: 768px) and (max-width: 1024px) {
  .footer-container {
    /* Chuyển sang bố cục 2 cột */
    grid-template-columns: repeat(2, 1fr); 
    gap: 40px 20px;
  }
}

/* Mobile (Dưới 767px) */
@media (max-width: 767px) {
  .footer-top {
    padding: 40px 20px;
  }
  .footer-container {
    /* Chuyển sang bố cục 1 cột */
    grid-template-columns: 1fr;
    gap: 30px;
  }

  /* Thay đổi thứ tự cột trên Mobile */
  .footer-brand-info {
    order: 4; 
  }
  .footer-socials {
    justify-content: center; 
  }
  .footer-cert {
    display: flex;
    justify-content: center;
  }
}
</style>