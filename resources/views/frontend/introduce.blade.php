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
    <link rel="icon" href="{{ asset('frontend/images/caphe.png') }}" type="image/png" class="favicon-image">
</head>
<body>
@extends("frontend.layout_home")
@section("do-du-lieu-vao-layout")
<style>
    .introduce_container {
        margin-top: 40px;
        margin-bottom: 40px;
    }
    /* Hero Section */
    .hero {
        display: grid;
        grid-template-columns: 45% 55%;
        gap: 60px;
        margin-bottom: 80px;
        background: #ffffff;
        padding: 60px;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(36, 32, 82, 0.08);
    }
    
    /* Image Grid */
    .image-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        grid-template-rows: repeat(2, 200px);
        gap: 15px;
    }
    
    .image-box {
        background: linear-gradient(135deg, #242052, #4a4299);
        border-radius: 15px;
        overflow: hidden;
        position: relative;
        transition: transform 0.3s ease;
    }
    
    .image-box:hover {
        transform: translateY(-5px);
    }
    
    .image-box:first-child {
        grid-column: 1 / 2;
        grid-row: 1 / 3;
    }
    
    .image-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .image-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 14px;
        text-align: center;
    }
    
    /* Content Section */
    .content {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    
    .intro-text {
        font-size: 18px;
        color: #242052;
        margin-top: 40px;
        margin-bottom: 40px;
        line-height: 1.8;
        width: 500px;
    }
    
    .brand-name {
        font-size: 32px;
        font-weight: bold;
        color: #242052;
        margin-bottom: 25px;
        letter-spacing: 1px;
    }
    
    .contact-info {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }
    
    .contact-item {
        display: flex;
        align-items: center;
        gap: 12px;
        color: #242052;
        font-size: 16px;
    }
    
    .contact-item::before {
        content: "●";
        color: #242052;
        font-size: 20px;
    }
    
    /* Tabs Section */
    .tabs-section {
        background: #ffffff;
        border-radius: 20px;
        padding: 50px;
        box-shadow: 0 10px 40px rgba(36, 32, 82, 0.08);
    }
    
    .tabs-header {
        display: flex;
        gap: 15px;
        margin-bottom: 40px;
        flex-wrap: wrap;
        border-bottom: 2px solid #efeeff;
        padding-bottom: 20px;
    }
    
    .tab-button {
        padding: 15px 30px;
        background: #efeeff;
        border: none;
        border-radius: 10px;
        color: #242052;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
    }
    
    .tab-button:hover {
        background: #242052;
        color: #ffffff;
        transform: translateY(-2px);
    }
    
    .tab-button.active {
        background: #242052;
        color: #ffffff;
        box-shadow: 0 5px 15px rgba(36, 32, 82, 0.3);
    }
    
    .tab-content {
        display: none;
        animation: fadeIn 0.5s ease;
    }
    
    .tab-content.active {
        display: block;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .location-banner {
        width: 100%;
        height: 400px;
        background: linear-gradient(135deg, #242052, #4a4299);
        border-radius: 15px;
        margin-bottom: 30px;
        overflow: hidden;
        position: relative;
    }
    
    .banner-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 32px;
        font-weight: bold;
    }
    .banner-placeholder img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .location-title {
        font-size: 28px;
        font-weight: bold;
        color: #242052;
        margin-bottom: 30px;
    }
    
    .address-list {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
    }
    
    .address-item {
        background: #efeeff;
        padding: 20px;
        border-radius: 10px;
        border-left: 4px solid #242052;
        transition: all 0.3s ease;
    }
    
    .address-item:hover {
        transform: translateX(5px);
        box-shadow: 0 5px 15px rgba(36, 32, 82, 0.1);
    }
    
    .address-item strong {
        color: #242052;
        font-size: 16px;
        display: block;
        margin-bottom: 8px;
    }
    
    .address-item small {
        color: #4a4299;
        font-size: 14px;
    }
    
    @media (max-width: 968px) {
        .hero {
            grid-template-columns: 1fr;
            padding: 40px;
        }
        
        .tabs-section {
            padding: 30px;
        }
        
        .tabs-header {
            justify-content: center;
        }
        
        .address-list {
            grid-template-columns: 1fr;
        }
    }
    @media (max-width: 768px) {
        .hero {
            display: block;
        }
        .hero .content p.intro-text{
            width: auto;
        }
        .hero .content .logo{
            margin-top: 40px;
        }
    }
</style>
<div class="container introduce_container">
    <!-- Hero Section -->
    <div class="hero">
        <div class="image-grid">
            <div class="image-box">
                <div class="image-placeholder">
                    <img src="{{ asset('frontend/images/intro1.jpg') }}" alt="Logo">
                </div>
            </div>
            <div class="image-box">
                <div class="image-placeholder">
                    <img src="{{ asset('frontend/images/intro2.jpg') }}" alt="Logo">
                </div>
            </div>
            <div class="image-box">
                <div class="image-placeholder">
                    <img src="{{ asset('frontend/images/intro3.jpg') }}" alt="Logo">
                </div>
            </div>
        </div>
        
        <div class="content">
            <div class="logo">
                <img src="{{ asset('frontend/images/logo.png') }}" alt="Logo">
            </div>
            <p class="intro-text">
                Từ làn hương đến mùi vị, từ câu chuyện tại nông trại đến bối cảnh địa phương, 
                mỗi cách thưởng thức cà phê là một câu chuyện đầy. Câu chuyện ấy, với bạn, có thể 
                thân thương hay ngộ nghĩnh, thú vị hay lạ lùng. Dù cho cảm xúc ấy là gì, hãy đón 
                nhận tất cả. Để rồi từ đấy, bạn sẽ có cảm nhận cà phê của riêng mình.
            </p>
            <div class="brand-name">HELLO LAVIET</div>
            <div class="contact-info">
                <div class="contact-item">Hotline: 0866 10 6989</div>
                <div class="contact-item">coffee.laviet@gmail.com</div>
            </div>
        </div>
    </div>
    
    <!-- Tabs Section -->
    <div class="tabs-section">
        <div class="tabs-header">
            <button class="tab-button active" onclick="showTab('hcm')">Hồ Chí Minh</button>
            <button class="tab-button" onclick="showTab('dalat')">Đà Lạt</button>
            <button class="tab-button" onclick="showTab('hanoi')">Hà Nội</button>
            <button class="tab-button" onclick="showTab('quynhon')">Quy Nhơn</button>
            <button class="tab-button" onclick="showTab('nhatrang')">Nha Trang</button>
        </div>
        
        <!-- HCM Tab -->
        <div id="hcm" class="tab-content active">
            <div class="location-banner">
                <div class="banner-placeholder">
                    <img src="{{ asset('frontend/images/hcm.jpg') }}" alt="Logo">
                </div>
            </div>
            <h2 class="location-title">Hồ Chí Minh</h2>
            <div class="address-list">
                <div class="address-item">
                    <strong>Takashimaya – B2</strong>
                    <small>Tel: 033 8184 600 | 09:30–21:30</small>
                </div>
                <div class="address-item">
                    <strong>60 Phó Đức Chính</strong>
                    <small>Tel: 035 5454 600 | 07:00–17:00</small>
                </div>
                <div class="address-item">
                    <strong>191 Hai Bà Trưng</strong>
                    <small>Tel: 088 920 9977 | 07:00–22:00</small>
                </div>
                <div class="address-item">
                    <strong>57A Tú Xương</strong>
                    <small>Tel: 034 256 5748 | 07:00–22:00</small>
                </div>
                <div class="address-item">
                    <strong>16 Bà Huyện Thanh Quan</strong>
                    <small>Tel: 032 518 8818 | 07:00–22:00</small>
                </div>
            </div>
            <div class="row">
                <div>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.497847148615!2d106.69803087576813!3d10.773130059253065!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f611eda33fd%3A0x469b4bc8801a4aa8!2sLa%20Viet%20Coffee%20(Takashimaya)!5e0!3m2!1sen!2s!4v1763569473410!5m2!1sen!2s" style="border:0; width: 100%; height: 500px; margin-top: 50px" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
        
        <!-- Da Lat Tab -->
        <div id="dalat" class="tab-content">
            <div class="location-banner">
                <div class="banner-placeholder">
                    <img src="{{ asset('frontend/images/dl.jpg') }}" alt="Logo">
                </div>
            </div>
            <h2 class="location-title">Đà Lạt</h2>
            <div class="address-list">
                <div class="address-item">
                    <strong>4D Trần Quý Cáp</strong>
                    <small>Tel: 02633 989 919 | 08:00–22:00</small>
                </div>
                <div class="address-item">
                    <strong>Kiosk 01 – Khu Hoà Bình</strong>
                    <small>Tel: 0989 520 749 | 07:00–21:00</small>
                </div>
                <div class="address-item">
                    <strong>Đại diện Đà Lạt</strong>
                    <small>Tel: 0989 520 749 | 08:00–22:00</small>
                </div>
            </div>
            <div class="row">
                <div>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3903.25559149303!2d108.43251717577792!3d11.956797736312433!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317112d0ec679cb9%3A0x69dd101b15161e40!2sLa%20Viet%20Coffee!5e0!3m2!1sen!2s!4v1763569582214!5m2!1sen!2s" style="border:0; width: 100%; height: 500px; margin-top: 50px" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
        
        <!-- Hanoi Tab -->
        <div id="hanoi" class="tab-content">
            <div class="location-banner">
                <div class="banner-placeholder">
                    <img src="{{ asset('frontend/images/hn.jpg') }}" alt="Logo">
                </div>
            </div>
            <h2 class="location-title">Hà Nội</h2>
            <div class="address-list">
                <div class="address-item">
                    <strong>VP Đại Diện – Ngõ 57 Láng Hạ</strong>
                    <small>Tel: 086 885 0659 | 08:00–17:00</small>
                </div>
                <div class="address-item">
                    <strong>103 ngõ 6 Lê Thánh Tông</strong>
                    <small>Tel: 086 577 0989 | 08:00–17:00</small>
                </div>
                <div class="address-item">
                    <strong>7 Vọng Đức – Hoàn Kiếm</strong>
                    <small>Tel: 086 959 5769 | 07:00–22:00</small>
                </div>
                <div class="address-item">
                    <strong>Lotte Mall Tây Hồ – Food Hall Tầng 3</strong>
                    <small>Tel: 098 660 7375 | 09:30–22:00</small>
                </div>
            </div>
            <div class="row">
                <div>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3722.9352498916114!2d105.81057377590392!3d21.07524818617893!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135abc762689b55%3A0x2c0e92803a68cc86!2sLa%20Viet%20Coffee%20(Lotte%20West%20Lake)!5e0!3m2!1sen!2s!4v1763569600745!5m2!1sen!2s" style="border:0; width: 100%; height: 500px; margin-top: 50px" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
        
        <!-- Quy Nhon Tab -->
        <div id="quynhon" class="tab-content">
            <div class="location-banner">
                <div class="banner-placeholder">
                    <img src="{{ asset('frontend/images/qn.jpg') }}" alt="Logo">
                </div>
            </div>
            <h2 class="location-title">Quy Nhơn</h2>
            <div class="address-list">
                <div class="address-item">
                    <strong>25 Lê Xuân Trữ – Trần Phú</strong>
                    <small>VP đại diện Tel: 0866 106 989</small>
                </div>
            </div>
            <div class="row">
                <div>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3875.152987863833!2d109.22069447579578!3d13.769646096878747!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x316f6d17b7cab3b1%3A0x46e7b0a940872da!2zTMOgIFZp4buHdCBDb2ZmZWUgKFZQIMSR4bqhaSBkaeG7h24gdOG6oWkgUXVpIE5oxqFuKQ!5e0!3m2!1sen!2s!4v1763569645874!5m2!1sen!2s" style="border:0; width: 100%; height: 500px; margin-top: 50px" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
        
        <!-- Nha Trang Tab -->
        <div id="nhatrang" class="tab-content">
            <div class="location-banner">
                <div class="banner-placeholder">
                    <img src="{{ asset('frontend/images/nt.jpg') }}" alt="Logo">
                </div>
            </div>
            <h2 class="location-title">Nha Trang</h2>
            <div class="address-list">
                <div class="address-item">
                    <strong>Vinpearl Hòn Tre – SGA-05 & Harbour L1K2</strong>
                    <small>09:00–21:00</small>
                </div>
                <div class="address-item">
                    <strong>Chợ Đầm – 8 Lê Lợi</strong>
                    <small>Tel: 0355 511 809 | 07:00–22:00</small>
                </div>
            </div>
            <div class="row">
                <div>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3898.920183560348!2d109.19071697578056!3d12.253680530209932!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317067003f230bf1%3A0x5f4462abec3a92dc!2sLa%20Viet%20Coffee%20(Nha%20Trang%20-%208%20Le%20Loi)!5e0!3m2!1sen!2s!4v1763569621727!5m2!1sen!2s" style="border:0; width: 100%; height: 500px; margin-top: 50px" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function showTab(tabId) {
        // Hide all tabs
        const tabs = document.querySelectorAll('.tab-content');
        tabs.forEach(tab => tab.classList.remove('active'));
        
        // Remove active from all buttons
        const buttons = document.querySelectorAll('.tab-button');
        buttons.forEach(btn => btn.classList.remove('active'));
        
        // Show selected tab
        document.getElementById(tabId).classList.add('active');
        
        // Add active to clicked button
        event.target.classList.add('active');
    }
    </script>
@endsection

</body>
</html>
