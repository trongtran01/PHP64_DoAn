<!-- Menu-main -->
<div class="menu-main" style="margin-bottom:100px">
    <div class="home-banners">
        <div class="slides-wrapper">
            @foreach($banners as $banner)
            <div class="slide banner-item">
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
        <!-- Pagination -->
        <div class="pagination"></div>
    </div>
</div>

<style>
.home-banners {
    position: relative;
    width: 100%;
    max-width: 1200px;
    height: 700px;
    margin: 0 auto;
    overflow: hidden;
    margin-top: 50px;
}

.slides-wrapper {
    display: flex;
    width: 100%;
    height: 100%;
    transition: transform 0.5s ease-in-out;
}

.slide {
    min-width: 100%;
    height: 100%;
    position: relative;
}

.slide img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.banner-content {
    position: absolute;
    bottom: 20%;
    left: 10%;
    color: #fff;
    background: rgba(0,0,0,0.4);
    padding: 20px;
    border-radius: 8px;
    max-width: 50%;
}

.banner-content h3 {
    font-size: 2rem;
    margin-bottom: 10px;
}

.banner-content p {
    font-size: 1.2rem;
    margin-bottom: 15px;
}

.banner-content .btn {
    padding: 10px 20px;
}

/* Pagination bullets */
.pagination {
    position: absolute;
    bottom: 15px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 10px;
}

.pagination span {
    width: 12px;
    height: 12px;
    background: #efeeff;
    border-radius: 50%;
    cursor: pointer;
}

.pagination .active {
    background: #242052;
}
@media (max-width:768px) {
    .home-banners {
        margin-top: 0;
        height: auto;
    }
    .slides-wrapper {
        height: auto;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const slides = document.querySelectorAll('.slide');
    const slidesWrapper = document.querySelector('.slides-wrapper');
    const paginationContainer = document.querySelector('.pagination');
    let currentIndex = 0;
    const total = slides.length;

    // Tạo pagination
    slides.forEach((_, idx) => {
        const dot = document.createElement('span');
        if(idx === 0) dot.classList.add('active');
        dot.addEventListener('click', () => {
            currentIndex = idx;
            updateSlider();
            resetInterval();
        });
        paginationContainer.appendChild(dot);
    });
    const dots = paginationContainer.querySelectorAll('span');

    function updateSlider() {
        slidesWrapper.style.transform = `translateX(-${currentIndex * 100}%)`;
        dots.forEach(dot => dot.classList.remove('active'));
        dots[currentIndex].classList.add('active');
    }

    // Tự động slide
    let slideInterval = setInterval(() => {
        currentIndex = (currentIndex + 1) % total;
        updateSlider();
    }, 4000);

    function resetInterval() {
        clearInterval(slideInterval);
        slideInterval = setInterval(() => {
            currentIndex = (currentIndex + 1) % total;
            updateSlider();
        }, 4000);
    }
});
</script>
