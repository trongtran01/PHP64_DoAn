<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Liên hệ</title>
    <!-- Load font awsome online -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('frontend/images/icon.svg') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/contact.css') }}">
</head>

<body>
    @extends('frontend.layout_home')

    @section('do-du-lieu-vao-layout')
        <link rel="stylesheet" href="{{ asset('frontend/css/contact-instagram.css') }}">

        @php
            $instagramUrl = 'https://www.instagram.com/lavietcoffee/';
        @endphp

        <main class="instagram-page">
            <section class="instagram-hero">
                <div class="instagram-hero__glow instagram-hero__glow--one"></div>
                <div class="instagram-hero__glow instagram-hero__glow--two"></div>

                <div class="instagram-hero__content">
                    <a class="instagram-profile" href="{{ $instagramUrl }}" target="_blank" rel="noopener noreferrer"
                        aria-label="Mở trang Instagram của La Viet Coffee">
                        <span class="instagram-profile__ring">
                            <span class="instagram-profile__avatar">
                                <img src="{{ asset('frontend/images/logo.png') }}" alt="La Viet Coffee">
                            </span>
                        </span>

                        <span class="instagram-profile__name">
                            <strong>@lavietcoffee</strong>
                            <small>Instagram chính thức</small>
                        </span>

                        <span class="instagram-profile__check" aria-hidden="true">
                            <i class="fas fa-check"></i>
                        </span>
                    </a>

                    <p class="instagram-hero__eyebrow">
                        <i class="fab fa-instagram" aria-hidden="true"></i>
                        Chuyện cà phê mỗi ngày
                    </p>

                    <h1>Good coffee<br><span>shares happiness.</span></h1>

                    <p class="instagram-hero__description">
                        Theo dõi hành trình từ những hạt Arabica Đà Lạt đến từng tách
                        cà phê được rang và pha bằng sự chỉn chu tại La Viet Coffee.
                    </p>

                    <div class="instagram-hero__actions">
                        <a class="instagram-button instagram-button--primary" href="{{ $instagramUrl }}" target="_blank"
                            rel="noopener noreferrer">
                            <i class="fab fa-instagram" aria-hidden="true"></i>
                            Xem trên Instagram
                            <i class="fas fa-arrow-up-right-from-square" aria-hidden="true"></i>
                        </a>

                        <a class="instagram-button instagram-button--secondary" href="{{ url('/') }}">
                            Về trang chủ
                        </a>
                    </div>
                </div>

                <div class="instagram-hero__visual" aria-hidden="true">
                    <div class="phone-card">
                        <div class="phone-card__header">
                            <span class="phone-card__avatar">
                                <img src="{{ asset('frontend/images/logo.png') }}" alt="">
                            </span>
                            <span>
                                <strong>lavietcoffee</strong>
                                <small>Da Lat, Vietnam</small>
                            </span>
                            <i class="fas fa-ellipsis"></i>
                        </div>

                        <div class="coffee-art">
                            <span class="coffee-art__label">Vietnam Arabica</span>
                            <svg viewBox="0 0 360 330">
                                <ellipse cx="180" cy="278" rx="112" ry="18" fill="#281a3c" opacity=".15" />
                                <path d="M93 111H251L237 242C234 270 213 286 181 286H164C133 286 111 270 108 242Z"
                                    fill="#fff" />
                                <ellipse cx="172" cy="112" rx="79" ry="22" fill="#f7f4ff" />
                                <ellipse cx="172" cy="114" rx="66" ry="13" fill="#70401e" />
                                <path d="M250 145H273C312 145 319 203 286 224C275 231 260 232 242 227" fill="none"
                                    stroke="#fff" stroke-width="18" stroke-linecap="round" />
                                <path
                                    d="M146 158C146 143 164 136 175 150C187 136 205 143 205 158C205 176 175 192 175 192C175 192 146 176 146 158Z"
                                    fill="#f1d8c4" />
                                <g fill="none" stroke="#fff" stroke-width="7" stroke-linecap="round" opacity=".75">
                                    <path d="M145 87C123 63 162 51 143 25" />
                                    <path d="M178 82C157 58 196 46 177 20" />
                                    <path d="M211 87C190 63 229 51 210 25" />
                                </g>
                            </svg>
                        </div>

                        <div class="phone-card__footer">
                            <div class="phone-card__icons">
                                <span><i class="far fa-heart"></i></span>
                                <span><i class="far fa-comment"></i></span>
                                <span><i class="far fa-paper-plane"></i></span>
                                <span class="phone-card__save"><i class="far fa-bookmark"></i></span>
                            </div>
                            <strong>Mỗi tách cà phê là một câu chuyện.</strong>
                            <p>#lavietcoffee &nbsp; #vietnamarabica</p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="instagram-highlights" aria-label="Khám phá La Viet Coffee">
                <header class="instagram-highlights__header">
                    <div>
                        <p>Khám phá thêm</p>
                        <h2>Từ nông trại đến tách cà phê</h2>
                    </div>
                    <a href="{{ $instagramUrl }}" target="_blank" rel="noopener noreferrer">
                        Theo dõi @lavietcoffee
                        <i class="fas fa-arrow-right" aria-hidden="true"></i>
                    </a>
                </header>

                <div class="instagram-highlights__grid">
                    <a class="highlight-card highlight-card--farm" href="{{ $instagramUrl }}" target="_blank"
                        rel="noopener noreferrer">
                        <span class="highlight-card__icon"><i class="fas fa-seedling"></i></span>
                        <span class="highlight-card__number">01</span>
                        <span class="highlight-card__content">
                            <strong>Hạt cà phê Đà Lạt</strong>
                            <small>Khám phá nguồn gốc Arabica Việt Nam</small>
                        </span>
                    </a>

                    <a class="highlight-card highlight-card--roast" href="{{ $instagramUrl }}" target="_blank"
                        rel="noopener noreferrer">
                        <span class="highlight-card__icon"><i class="fas fa-fire-flame-curved"></i></span>
                        <span class="highlight-card__number">02</span>
                        <span class="highlight-card__content">
                            <strong>Rang và pha chế</strong>
                            <small>Kỹ thuật tạo nên hương vị đặc trưng</small>
                        </span>
                    </a>

                    <a class="highlight-card highlight-card--space" href="{{ $instagramUrl }}" target="_blank"
                        rel="noopener noreferrer">
                        <span class="highlight-card__icon"><i class="fas fa-mug-hot"></i></span>
                        <span class="highlight-card__number">03</span>
                        <span class="highlight-card__content">
                            <strong>Không gian La Viet</strong>
                            <small>Những khoảnh khắc bên tách cà phê</small>
                        </span>
                    </a>
                </div>
            </section>

            <section class="instagram-cta">
                <div>
                    <span class="instagram-cta__icon"><i class="fab fa-instagram"></i></span>
                    <div>
                        <p>Kết nối cùng La Viet Coffee</p>
                        <h2>Ghé Instagram để xem những câu chuyện mới nhất.</h2>
                    </div>
                </div>

                <a href="{{ $instagramUrl }}" target="_blank" rel="noopener noreferrer">
                    Mở Instagram
                    <i class="fas fa-arrow-up-right-from-square" aria-hidden="true"></i>
                </a>
            </section>
        </main>
    @endsection
</body>

</html>