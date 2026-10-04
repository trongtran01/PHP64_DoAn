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
    <link rel="stylesheet" href="{{ asset('frontend/css/introduce.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('frontend/images/icon.svg') }}">
</head>
<body>
@extends("frontend.layout_home")
@section("do-du-lieu-vao-layout")
<div class="container introduce_container">
    <!-- Hero Section: giữ nguyên như file cũ -->
    <div class="hero">
        <div class="image-grid">
            <div class="image-box"><div class="image-placeholder"><img src="{{ asset('frontend/images/intro1.jpg') }}" alt="Hello Laviet"></div></div>
            <div class="image-box"><div class="image-placeholder"><img src="{{ asset('frontend/images/intro2.jpg') }}" alt="Hello Laviet"></div></div>
            <div class="image-box"><div class="image-placeholder"><img src="{{ asset('frontend/images/intro3.jpg') }}" alt="Hello Laviet"></div></div>
        </div>
        <div class="content">
            <div class="logo"><img src="{{ asset('frontend/images/logo.png') }}" alt="Logo"></div>
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

    <!-- Tabs Section: đọc từ DB -->
    @if ($regions->isNotEmpty())
    <div class="tabs-section">
        <div class="tabs-header">
            @foreach ($regions as $region)
                <button type="button" class="tab-button {{ $loop->first ? 'active' : '' }}"
                        data-tab="tab-{{ $region->slug }}">{{ $region->name }}</button>
            @endforeach
        </div>

        @foreach ($regions as $region)
            <div id="tab-{{ $region->slug }}" class="tab-content {{ $loop->first ? 'active' : '' }}">
                @if ($region->banner_image)
                    <div class="location-banner">
                        <div class="banner-placeholder">
                            <img src="{{ asset('storage/' . $region->banner_image) }}" alt="{{ $region->name }}">
                        </div>
                    </div>
                @endif

                <h2 class="location-title">{{ $region->name }}</h2>

               <div class="address-list">
                    @foreach ($region->stores as $store)
                        <div class="address-item" style="cursor:pointer"
                            data-map="{{ $store->map_embed_url }}">
                            @if ($store->ward)
                                <div class="address-ward"><strong>{{ $store->ward }}</strong></div>
                            @endif
                            <div class="address-name">{{ $store->name }}</div>
                            @if ($store->address)
                                <div class="address-detail">
                                    <small><i class="fa-solid fa-location-dot"></i> {{ $store->address }}</small>
                                </div>
                            @endif
                            @if ($store->note)
                                <div class="address-detail"><small>{{ $store->note }}</small></div>
                            @endif
                            @if ($store->phone)
                                <div class="address-detail">
                                    <small><i class="fa-solid fa-phone"></i> Tel:
                                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $store->phone) }}">{{ $store->phone }}</a>
                                    </small>
                                </div>
                            @endif
                            @if ($store->opening_hours)
                                <div class="address-detail">
                                    <small><i class="fa-regular fa-clock"></i> Giờ mở cửa: {{ $store->opening_hours }}</small>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>

                @if ($region->map_embed_url)
                    <div class="row">
                        <div>
                            <iframe class="region-map"
                                    src="{{ $region->map_embed_url }}"
                                    data-default="{{ $region->map_embed_url }}"
                                    style="border:0; width: 100%; height: 500px; margin-top: 50px"
                                    allowfullscreen loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
    @endif
</div>

<script>
    document.querySelectorAll('.tab-button').forEach(function (btn) {
        btn.addEventListener('click', function () {
            document.querySelectorAll('.tab-content').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.tab-button').forEach(b => b.classList.remove('active'));
            document.getElementById(btn.dataset.tab).classList.add('active');
            btn.classList.add('active');
        });
    });

    document.querySelectorAll('.address-item').forEach(function (item) {
        item.addEventListener('click', function (e) {
            if (e.target.closest('a')) return;

            const tab = item.closest('.tab-content');
            const iframe = tab.querySelector('.region-map');
            if (!iframe) return;

            tab.querySelectorAll('.address-item').forEach(i => i.classList.remove('active'));
            item.classList.add('active');

            const url = item.dataset.map || iframe.dataset.default;
            if (iframe.getAttribute('src') !== url) iframe.setAttribute('src', url);
        });
    });
</script>
@endsection

</body>
</html>
