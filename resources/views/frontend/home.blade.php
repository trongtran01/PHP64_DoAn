@extends("frontend.layout_home")
@section("do-du-lieu-vao-layout")
@include("frontend.slide")

<div class="page-content-wrapper">
    <!-- =================== STORY CARD =================== -->
    <section class="story-card">
        <!-- TOP IMAGE -->
        <div class="story-top-image">
            <img src="{{ asset('frontend/images/top-story.png') }}">
        </div>

        <!-- BOTTOM CONTENT -->
        <div class="story-bottom">

            <!-- LEFT IMAGE -->
            <div class="story-left-image">
                <img src="{{ asset('frontend/images/left-story.png') }}">
            </div>

            <!-- RIGHT TEXT CONTENT -->
            <div class="story-text">
                <h2 class="story-title">Không có bí quyết nào<br>để có cà phê ngon…</h2>

                <p>
                    …ngoài việc từng bước trong quy trình từ hạt giống đến tách cà phê 
                    cần được thực hiện với kỹ thuật, sự tỉ mỉ và niềm đam mê. 
                    Từng quả cà phê chín mọng được hái bằng tay và sản xuất trong ngày 
                    để đạt chất lượng tốt nhất.
                </p>

                <p>
                    Từng mẻ cà phê được thổi hồn từ tình yêu của những người thợ lành nghề. 
                    Chúng tôi tôn trọng khẩu vị khách hàng bằng cách chăm chút cho quá trình làm cà phê của mình.
                </p>

                <p>
                    Với chúng tôi, không có cà phê đặc biệt, chỉ có những con người đặc biệt làm cà phê 
                    với cả lòng tận tâm.
                </p>
            </div>

        </div>

    </section>
    <!-- =================== SẢN PHẨM BÁN CHẠY =================== -->
    <section class="our-products-area osr-products-latest-area ptb-50 background-sliding-image">
        <div class="container">
            <div class="section-title">
                <i class="fa-solid fa-fire-flame-curved style-icon"></i>
                <h2 class="section-title__title">Sản phẩm bán chạy</h2>
            </div>

            @php
                $hotProducts = \App\Http\Controllers\Frontend\HomeController::hotProducts();
            @endphp
            <div class="product-slider-container">
                <button class="slider-btn prev-btn"><i class="fa-solid fa-chevron-left"></i></button>

                <div class="product-slider">
                    <div class="product-track">
                        @foreach($hotProducts as $row)
                        <div class="product-card-modern">

                            @if($row->discount > 0)
                            <span class="tag-sale">-{{ $row->discount }}%</span>
                            @endif

                            <a href="{{ url('products/detail/'.$row->id) }}" class="product-img-box">
                                <img src="{{ asset('upload/products/'.$row->photo) }}" alt="{{ $row->name }}">
                            </a>

                            <h4 class="product-name">{{ $row->name }}</h4>

                            <div class="price-box">
                                <p class="new-price">
                                    {{ number_format($row->price - ($row->price * $row->discount)/100) }}đ
                                </p>

                                @if($row->discount > 0)
                                <p class="old-price">{{ number_format($row->price) }}đ</p>
                                @endif
                            </div>

                            <a href="{{ url('cart/buy/'.$row->id) }}" class="btn-add-cart">Thêm vào giỏ</a>
                        </div>
                        @endforeach
                    </div>
                </div>

                <button class="slider-btn next-btn"><i class="fa-solid fa-chevron-right"></i></button>
            </div>
            <div class="slider-dots"></div>
            <div class="best-seller-dots"></div>
        </div>
    </section>

    <div class="section-divider"></div>

    <!-- =================== TIN TỨC ĐÁNG CHÚ Ý =================== -->
    <div class="news-wrapper-full">
        <section class="section-block news-featured-section full-width-news">
            <h2 class="section-title"><i class="fa-solid fa-newspaper"></i> Tin tức đáng chú ý</h2>

            <div class="news-layout-grid">
                @php
                    $news = \App\Http\Controllers\Frontend\HomeController::hotNews();
                    $featuredNews = $news->shift();
                @endphp

                @if($featuredNews)
                <div class="featured-news-post">
                    <a href="{{ url('news/detail/'.$featuredNews->id) }}">
                        <div class="news-image-lg-container">
                            <img src="{{ asset('upload/news/'.$featuredNews->photo) }}" alt="{{ $featuredNews->name }}">
                        </div>
                        <h3 class="news-title-lg">{{ $featuredNews->name }}</h3>
                    </a>

                    <div class="news-description-lg">
                        {!! \Illuminate\Support\Str::limit(strip_tags($featuredNews->description), 200) !!}
                    </div>

                    <a href="{{ url('news/detail/'.$featuredNews->id) }}" class="read-more-btn">Xem chi tiết &raquo;</a>
                </div>
                @endif

                <div class="small-news-list">
                    @foreach($news->take(3) as $row)
                    <div class="small-news-item">
                        <a href="{{ url('news/detail/'.$row->id) }}" class="small-news-link">
                            <div class="news-image-sm-container">
                                <img src="{{ asset('upload/news/'.$row->photo) }}" alt="{{ $row->name }}">
                            </div>
                            <h4 class="news-title-sm">{{ $row->name }}</h4>
                        </a>
                    </div>
                    @endforeach
                </div>

            </div>
        </section>
    </div>

    <div class="banner-footer">
        <img src="{{ asset('frontend/images/banner_footer.png') }}">
    </div>
</div>
@endsection
<style>
/* ============================
   1. WRAPPER CHUNG
============================ */
.page-content-wrapper {
    max-width: 1200px;
    margin: 30px auto;
    padding: 0 15px;
}

.section-block {
    background: #fff;
    padding: 20px;
    margin-bottom: 40px;
}

.section-title {
    font-size: 1.5rem;
    color: #242052;
    border-bottom: 3px solid #242052;
    padding-bottom: 10px;
    margin-bottom: 25px;
    display: flex;
    gap: 10px;
    align-items: center;
}
.section-title__title {
    font-size: 24px;
}

.section-divider { height: 1px; background: #efeeff; margin: 30px 0; }

/* ====================
    STORY CARD
==================== */
.story-card {
    width: 100%;
    margin: 40px auto;
    background: #fff;
}

/* TOP IMAGE */
.story-top-image {
    width: 100%;
    overflow: hidden;
    border-radius: 10px;
    display: flex;
    justify-content: center;
    margin-bottom: 60px;
}

/* BOTTOM BLOCK */
.story-bottom {
    margin-top: 30px;
    display: grid;
    grid-template-columns: 1fr 1.3fr;
    gap: 30px;
    align-items: center;
}

/* LEFT IMAGE */
.story-left-image img {
    width: 100%;
    border-radius: 10px;
    object-fit: cover;
}

/* TEXT SECTION */
.story-text {
    color: #333;
}
.story-title {
    font-size: 28px;
    font-weight: 700;
    color: #242052;
    margin-bottom: 20px;
}
.story-text p {
    line-height: 1.6;
    margin-bottom: 15px;
    font-size: 16px;
}

@media(max-width: 992px) {
    .story-bottom {
        grid-template-columns: 1fr;
    }
    .story-left-image {
        text-align: center;
    }
    .story-left-image img {
        width: 80%;
    }
}

@media(max-width: 576px) {
    .story-top-image {
        height: auto;
    }
    .story-top-image img {
        width: 100%;
    }
    .story-left-image img {
        width: 100%;
    }
    .story-title {
        font-size: 22px;
        text-align: center;
    }
    .story-card {
        padding: 20px;
    }
}

/* =======================
   PRODUCT SLIDER MODERN
======================= */
.product-slider-container {
    position: relative;
    width: 100%;
    margin-top: 20px;
}

.product-slider {
    overflow: hidden;
    width: 100%;
}

.product-track {
    display: flex;
    gap: 20px;
    transition: transform .45s ease;
}

.product-card-modern {
    flex: 0 0 calc(25% - 20px);
    background: #fff;
    border-radius: 10px;
    padding: 15px;
    border: 1px solid #ececec;
    box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    transition: .3s;
    position: relative;
    text-align: center;
}

.product-card-modern:hover {
    box-shadow: 0 8px 25px rgba(0,0,0,0.12);
    transform: translateY(-4px);
}

.product-img-box {
    display: block;
    height: 180px;
    display: flex;
    justify-content: center;
    align-items: center;
}
.product-img-box img {
    max-height: 100%;
    object-fit: contain;
}

.tag-sale {
    background: #242052;
    color: #fff;
    padding: 6px 12px;
    font-size: 14px;
    font-weight: bold;
    border-radius: 0 10px 10px 0;
    position: absolute;
    top: 10px;
    left: 0;
}

.price-box {
    margin-top: 10px;
    height: 40px;
}
.new-price {
    color: #242052;
    font-size: 18px;
    font-weight: bold;
}
.old-price {
    color: #999;
    text-decoration: line-through;
    font-size: 14px;
}

.btn-add-cart {
    display: block;
    margin-top: 12px;
    padding: 10px;
    background: #242052;
    color: white;
    border-radius: 6px;
    font-size: 14px;
}
.btn-add-cart:hover {
    background: #fff;
    color: #242052;
    border: 1px solid #242052;
}

/* Buttons */
.slider-btn {
    position: absolute;
    top: 45%;
    transform: translateY(-50%);
    background: white;
    border: 1px solid #ddd;
    width: 44px;
    height: 44px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    z-index: 2;
    transition: .3s;
}
.slider-btn:hover {
    background: #242052;
    color: white;
}
.prev-btn { left: -10px; }
.next-btn { right: -10px; }

/* Dots */
.slider-dots {
    text-align: center;
    margin-top: 15px;
}
.slider-dots button {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    border: none;
    background: #ccc;
    margin: 5px;
}
.slider-dots button.active {
    background: #242052;
}
/* banner-footer */
.banner-footer {
    display: flex;
    justify-content: center;
}
.banner-footer img {
    width: 40%;
}

/* Responsive */
@media (max-width:1024px) {
    .product-card-modern { flex: 0 0 calc(33.33% - 20px); }
}
@media (max-width:768px) {
    .product-card-modern { flex: 0 0 calc(50% - 20px); }
}
@media (max-width:480px) {
    .product-card-modern { flex: 0 0 100%; }
    .prev-btn, .next-btn { display:none; }
    .banner-footer img {
        width: 100%;
    }
    .product-track {
        gap: 0;
    }
}

/* ============================
   NEWS – GIỮ NGUYÊN
============================ */
.news-layout-grid {
    display: grid;
    grid-template-columns: 1.5fr 1fr;
    gap: 20px;
}
@media (max-width:768px){
    .news-layout-grid { grid-template-columns: 1fr; }
}
.featured-news-post { padding-right: 20px; border-right: 1px solid #efeeff; }
@media (max-width:768px){
    .featured-news-post { padding-right:0; border-right:0; padding-bottom:20px; border-bottom:1px solid #efeeff; }
}
.news-image-lg-container {
    height: 300px;
    overflow: hidden;
    border-radius: 8px;
    margin-bottom: 20px;
}
.news-image-lg-container img {
    width:100%;
    height:100%;
}

.small-news-list { display:flex; flex-direction:column; gap:15px; }
.small-news-item { border-bottom:1px solid #efeeff; padding-bottom:15px; }
.small-news-link { display:flex; gap:10px; text-decoration:none; }
.news-image-sm-container { width:100px; height:80px; overflow:hidden; border-radius:4px; }
.news-image-sm-container img { width:100%; height:100%; object-fit:cover; }

.news-title-sm, .news-title-lg {
    color:#242052;
    margin-bottom: 10px;
}
</style>
<script>
document.addEventListener("DOMContentLoaded", () => {

    const track = document.querySelector(".product-track");
    const cards = document.querySelectorAll(".product-card-modern");
    const dotsContainer = document.querySelector(".slider-dots");

    const btnPrev = document.querySelector(".prev-btn");
    const btnNext = document.querySelector(".next-btn");

    let currentSlide = 0;
    let itemsPerSlide = 4;

    const updateItemsPerSlide = () => {
        if (window.innerWidth <= 480) itemsPerSlide = 1;
        else if (window.innerWidth <= 768) itemsPerSlide = 2;
        else if (window.innerWidth <= 1024) itemsPerSlide = 3;
        else itemsPerSlide = 4;
    };
    updateItemsPerSlide();
    window.addEventListener("resize", () => {
        updateItemsPerSlide();
        goToSlide(0);
    });

    const totalSlides = Math.ceil(cards.length / itemsPerSlide);

    // create dots
    for (let i = 0; i < totalSlides; i++) {
        const btn = document.createElement("button");
        if (i === 0) btn.classList.add("active");
        btn.addEventListener("click", () => goToSlide(i));
        dotsContainer.appendChild(btn);
    }

    const dots = dotsContainer.querySelectorAll("button");

    function goToSlide(index) {
        currentSlide = index;
        const slideWidth = track.clientWidth;
        track.style.transform = `translateX(-${index * slideWidth}px)`;

        dots.forEach(d => d.classList.remove("active"));
        dots[index].classList.add("active");
    }

    btnPrev.addEventListener("click", () => {
        if (currentSlide === 0) return;
        goToSlide(currentSlide - 1);
    });

    btnNext.addEventListener("click", () => {
        if (currentSlide >= totalSlides - 1) return;
        goToSlide(currentSlide + 1);
    });
});
</script>

