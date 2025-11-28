<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tin tức</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="icon" href="{{ asset('frontend/images/caphe.png') }}" type="image/png" class="favicon-image">
    <style>
        .favicon-image {
            width: 80px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8f9fa;
        }

        .page-wrapper {
            max-width: 1400px;
            margin: 30px auto;
            padding: 0 15px;
        }

        /* Breadcrumb */
        .breadcrumb-section {
            background: #fff;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .breadcrumb-list {
            list-style: none;
            display: flex;
            gap: 8px;
            align-items: center;
            flex-wrap: wrap;
        }

        .breadcrumb-list li {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .breadcrumb-list a {
            color: #666;
            text-decoration: none;
            transition: color 0.3s;
        }

        .breadcrumb-list a:hover {
            color: #242052;
        }

        .breadcrumb-list .active {
            color: #242052;
            font-weight: 600;
        }

        /* Main Layout */
        .main-layout {
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 30px;
        }

        /* Sidebar */
        .sidebar {
            background: #fff;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            height: fit-content;
            position: sticky;
            top: 20px;
        }

        .sidebar-title {
            font-size: 20px;
            color: #242052;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 3px solid #242052;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar-menu {
            list-style: none;
        }

        .sidebar-menu li {
            margin-bottom: 12px;
        }

        .sidebar-menu a {
            display: block;
            padding: 12px 15px;
            color: #333;
            text-decoration: none;
            border-radius: 6px;
            transition: all 0.3s;
            font-size: 15px;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: #242052;
            color: #fff;
            transform: translateX(5px);
        }

        /* Support Box */
        .support-box {
            margin-top: 30px;
            background: linear-gradient(135deg, #242052 0%, #3a3478 100%);
            padding: 25px;
            border-radius: 10px;
            text-align: center;
            color: #fff;
        }

        .support-box h3 {
            font-size: 18px;
            margin-bottom: 15px;
        }

        .support-box .fb-icon {
            font-size: 50px;
            color: #3B5998;
            background: #fff;
            width: 70px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin: 15px auto;
        }

        .support-box a {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px;
            background: #fff;
            color: #242052;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            transition: 0.3s;
        }

        .support-box a:hover {
            transform: scale(1.05);
        }

        /* Content Area */
        .content-area {
            background: #fff;
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        }

        .page-title {
            font-size: 32px;
            color: #242052;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid #242052;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        /* News Grid */
        .news-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 30px;
        }

        .news-card {
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid #eee;
            transition: all 0.3s;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        }

        .news-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.15);
        }

        .news-image {
            width: 100%;
            height: 250px;
            overflow: hidden;
        }

        .news-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: 0.5s;
        }

        .news-card:hover .news-image img {
            transform: scale(1.1);
        }

        .news-content {
            padding: 25px;
        }

        .news-title {
            font-size: 20px;
            color: #242052;
            margin-bottom: 15px;
            font-weight: 700;
            text-decoration: none;
            display: block;
            transition: 0.3s;
            line-height: 1.4;
        }

        .news-title:hover {
            color: #918af7ff;
        }

        .news-meta {
            display: flex;
            gap: 20px;
            margin-bottom: 15px;
            color: #666;
            font-size: 14px;
        }

        .news-meta i {
            color: #242052;
            margin-right: 5px;
        }

        .news-description {
            color: #666;
            line-height: 1.7;
            margin-bottom: 20px;
            font-size: 15px;
        }

        .read-more-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: #242052;
            color: #fff;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            transition: 0.3s;
            font-size: 14px;
        }

        .read-more-btn:hover {
            background: #3a3478;
            transform: translateX(5px);
        }

        /* Mobile Menu Toggle */
        .mobile-menu-toggle {
            display: none;
            background: #242052;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            margin-bottom: 15px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            font-weight: 600;
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .main-layout {
                grid-template-columns: 250px 1fr;
                gap: 20px;
            }
        }

        @media (max-width: 992px) {
            .main-layout {
                grid-template-columns: 1fr;
            }

            .sidebar {
                position: relative;
                top: 0;
            }

            .mobile-menu-toggle {
                display: block;
            }

            .sidebar {
                display: none;
            }

            .sidebar.active {
                display: block;
            }

            .news-grid {
                grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
                gap: 25px;
            }
        }

        @media (max-width: 768px) {
            .page-wrapper {
                padding: 0 10px;
            }

            .content-area {
                padding: 25px;
            }

            .page-title {
                font-size: 26px;
            }

            .news-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
        }

        @media (max-width: 576px) {
            .content-area {
                padding: 20px;
            }

            .page-title {
                font-size: 22px;
            }

            .breadcrumb-section {
                padding: 12px 15px;
            }
        }
    </style>
</head>
<body>
    @include("frontend.header")

    <div class="page-wrapper">
        <!-- Breadcrumb -->
        <div class="breadcrumb-section">
            <ul class="breadcrumb-list">
                <li><a href="{{ asset('') }}"><i class="fa-solid fa-house"></i> Trang chủ</a></li>
                <li><i class="fa-solid fa-chevron-right"></i></li>
                <li class="active">Tin tức</li>
            </ul>
        </div>

        <!-- Mobile Menu Toggle -->
        <button class="mobile-menu-toggle" onclick="toggleSidebar()">
            <i class="fa-solid fa-bars"></i> Menu
        </button>

        <!-- Main Layout -->
        <div class="main-layout">
            <!-- Sidebar -->
            <aside class="sidebar" id="sidebar">
                <h2 class="sidebar-title">
                    <i class="fa-solid fa-list"></i>
                    DANH MỤC
                </h2>
                <ul class="sidebar-menu">
                    <li><a href="{{ asset('') }}"><i class="fa-solid fa-house"></i> Trang chủ</a></li>
                    <li><a href="#"><i class="fa-solid fa-info-circle"></i> Về chúng tôi</a></li>
                    <li><a href="#"><i class="fa-solid fa-shopping-bag"></i> Sản phẩm</a></li>
                    <li><a href="{{ asset('news') }}" class="active"><i class="fa-solid fa-newspaper"></i> Tin tức</a></li>
                    <li><a href="{{ asset('contact') }}"><i class="fa-solid fa-phone"></i> Tìm hiểu thêm</a></li>
                </ul>

                <!-- Support Box -->
                <div class="support-box">
                    <h3>Hỗ trợ trực tuyến</h3>
                    <p style="margin-bottom: 10px;">Hỗ trợ bán hàng</p>
                    <div class="fb-icon">
                        <i class="fa-brands fa-facebook-f"></i>
                    </div>
                    <a href="#">Chat ngay để được tư vấn</a>
                </div>
            </aside>

            <!-- Content Area -->
            <main class="content-area">
                <h1 class="page-title">
                    <i class="fa-solid fa-newspaper"></i>
                    TIN TỨC
                </h1>

                <!-- News Grid -->
                <div class="news-grid">
                    @php
                        $news = \App\Http\Controllers\Frontend\NewsController::getAllNews();
                    @endphp
                    @foreach($news as $row)
                    <article class="news-card">
                        <div class="news-image">
                            <a href="{{ url('news/detail/'.$row->id) }}">
                                <img src="{{ asset('storage/news/'.$row->photo) }}" alt="{{ $row->name }}">
                            </a>
                        </div>
                        <div class="news-content">
                            <a href="{{ url('news/detail/'.$row->id) }}" class="news-title">{{ $row->name }}</a>
                            <div class="news-meta">
                                <span><i class="fas fa-user"></i>Tác giả</span>
                                <span><i class="fas fa-calendar"></i>{{ date('d/m/Y') }}</span>
                            </div>
                            <div class="news-description">
                                {!! \Illuminate\Support\Str::limit(strip_tags($row->description), 150) !!}
                            </div>
                            <a href="{{ url('news/detail/'.$row->id) }}" class="read-more-btn">
                                Đọc thêm <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    </article>
                    @endforeach
                </div>
            </main>
        </div>
    </div>

    @include("frontend.footer")

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('active');
        }

        document.addEventListener('click', function(event) {
            if (window.innerWidth <= 992) {
                const sidebar = document.getElementById('sidebar');
                const toggleBtn = document.querySelector('.mobile-menu-toggle');
                
                if (!sidebar.contains(event.target) && !toggleBtn.contains(event.target)) {
                    sidebar.classList.remove('active');
                }
            }
        });
    </script>
</body>
</html>