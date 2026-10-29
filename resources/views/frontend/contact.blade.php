<!doctype html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Về Việt Hưng Ecom - Chất lượng tạo nên giá trị bền vững</title>

    <meta name="description" content="Khám phá Việt Hưng Ecom - nền tảng mua sắm trực tuyến hướng đến sản phẩm chất lượng, dịch vụ tận tâm và trải nghiệm mua sắm thuận tiện.">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <link rel="icon" type="image/svg+xml" href="{{ asset('frontend/images/icon.svg') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/contact.css') }}">
</head>

<body>
    @extends('frontend.layout_home')

    @section('do-du-lieu-vao-layout')
        <link rel="stylesheet" href="{{ asset('frontend/css/contact-instagram.css') }}">

        @php
            $homeUrl = url('/');
            $productUrl = url('/products/category/7');
            $contactUrl = url('/contact');
        @endphp

        <main class="instagram-page">
            <section class="instagram-hero">
                <div class="instagram-hero__glow instagram-hero__glow--one"></div>
                <div class="instagram-hero__glow instagram-hero__glow--two"></div>

                <div class="instagram-hero__content">
                    <a class="instagram-profile"
                       href="{{ $homeUrl }}"
                       aria-label="Về trang chủ Việt Hưng Ecom">

                        <span class="instagram-profile__ring">
                            <span class="instagram-profile__avatar">
                                <img src="{{ asset('frontend/images/logo.png') }}" alt="Việt Hưng Ecom">
                            </span>
                        </span>

                        <span class="instagram-profile__name">
                            <strong>Việt Hưng Ecom</strong>
                            <small>Mua sắm trực tuyến</small>
                        </span>

                        <span class="instagram-profile__check" aria-hidden="true">
                            <i class="fas fa-check"></i>
                        </span>
                    </a>

                    <p class="instagram-hero__eyebrow">
                        <i class="fas fa-shopping-bag" aria-hidden="true"></i>
                        Đồng hành cùng khách hàng
                    </p>

                    <h1>Chất lượng<br><span>tạo nên giá trị.</span></h1>

                    <p class="instagram-hero__description">
                        Việt Hưng Ecom hướng đến trải nghiệm mua sắm trực tuyến
                        thuận tiện với sản phẩm được lựa chọn kỹ lưỡng, dịch vụ
                        tận tâm và sự cải thiện không ngừng để đáp ứng nhu cầu
                        của khách hàng.
                    </p>

                    <div class="instagram-hero__actions">
                        <a class="instagram-button instagram-button--primary"
                           href="{{ $productUrl }}">
                            <i class="fas fa-store" aria-hidden="true"></i>
                            Khám phá sản phẩm
                            <i class="fas fa-arrow-right" aria-hidden="true"></i>
                        </a>

                        <a class="instagram-button instagram-button--secondary"
                           href="{{ $contactUrl }}">
                            Liên hệ với chúng tôi
                        </a>
                    </div>
                </div>

                <!-- <div class="instagram-hero__visual" aria-hidden="true">
                    <div class="phone-card">
                        <div class="phone-card__header">
                            <span class="phone-card__avatar">
                                <img src="{{ asset('frontend/images/logo.png') }}" alt="">
                            </span>

                            <span>
                                <strong>viethungecom</strong>
                                <small>Mua sắm thông minh</small>
                            </span>

                            <i class="fas fa-ellipsis"></i>
                        </div>

                        <div class="coffee-art">
                            <span class="coffee-art__label">VIỆT HƯNG ECOM</span>

                            <svg viewBox="0 0 360 330">
                                <ellipse cx="180" cy="278" rx="112" ry="18"
                                         fill="#281a3c" opacity=".15" />

                                <path d="M93 111H251L237 242C234 270 213 286 181 286H164C133 286 111 270 108 242Z"
                                      fill="#fff" />

                                <ellipse cx="172" cy="112" rx="79" ry="22"
                                         fill="#f7f4ff" />

                                <ellipse cx="172" cy="114" rx="66" ry="13"
                                         fill="#70401e" />

                                <path d="M250 145H273C312 145 319 203 286 224C275 231 260 232 242 227"
                                      fill="none"
                                      stroke="#fff"
                                      stroke-width="18"
                                      stroke-linecap="round" />

                                <path d="M146 158C146 143 164 136 175 150C187 136 205 143 205 158C205 176 175 192 175 192C175 192 146 176 146 158Z"
                                      fill="#b9a5ff" />

                                <g fill="none"
                                   stroke="#fff"
                                   stroke-width="7"
                                   stroke-linecap="round"
                                   opacity=".75">
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
                                <span><i class="fas fa-box"></i></span>
                                <span class="phone-card__save">
                                    <i class="far fa-bookmark"></i>
                                </span>
                            </div>

                            <strong>Chất lượng tạo nên giá trị bền vững.</strong>
                            <p>#VietHungEcom &nbsp; #MuaSamTrucTuyen</p>
                        </div>
                    </div>
                </div> -->
            </section>

            <section class="instagram-highlights" aria-label="Giá trị Việt Hưng Ecom">
                <header class="instagram-highlights__header">
                    <div>
                        <p>Giá trị cốt lõi</p>
                        <h2>Trải nghiệm mua sắm tốt hơn mỗi ngày</h2>
                    </div>

                    <a href="{{ $productUrl }}">
                        Khám phá sản phẩm
                        <i class="fas fa-arrow-right" aria-hidden="true"></i>
                    </a>
                </header>

                <div class="instagram-highlights__grid">
                    <a class="highlight-card highlight-card--farm"
                       href="{{ $productUrl }}">
                        <span class="highlight-card__icon">
                            <i class="fas fa-shield-halved"></i>
                        </span>

                        <span class="highlight-card__number">01</span>

                        <span class="highlight-card__content">
                            <strong>Chú trọng chất lượng</strong>
                            <small>Quan tâm đến việc lựa chọn và cung cấp sản phẩm phù hợp</small>
                        </span>
                    </a>

                    <a class="highlight-card highlight-card--roast"
                       href="{{ $productUrl }}">
                        <span class="highlight-card__icon">
                            <i class="fas fa-cart-shopping"></i>
                        </span>

                        <span class="highlight-card__number">02</span>

                        <span class="highlight-card__content">
                            <strong>Mua sắm thuận tiện</strong>
                            <small>Hướng đến quy trình mua sắm trực tuyến đơn giản, dễ sử dụng</small>
                        </span>
                    </a>

                    <a class="highlight-card highlight-card--space"
                       href="{{ $contactUrl }}">
                        <span class="highlight-card__icon">
                            <i class="fas fa-headset"></i>
                        </span>

                        <span class="highlight-card__number">03</span>

                        <span class="highlight-card__content">
                            <strong>Dịch vụ tận tâm</strong>
                            <small>Lắng nghe phản hồi và không ngừng cải thiện trải nghiệm khách hàng</small>
                        </span>
                    </a>
                </div>
            </section>

            <section class="instagram-cta">
                <div>
                    <span class="instagram-cta__icon">
                        <i class="fas fa-handshake"></i>
                    </span>

                    <div>
                        <p>Kết nối cùng Việt Hưng Ecom</p>
                        <h2>Cùng xây dựng trải nghiệm mua sắm đáng tin cậy.</h2>
                    </div>
                </div>

                <a href="{{ $contactUrl }}">
                    Liên hệ ngay
                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                </a>
            </section>
        </main>
    @endsection
</body>

</html>