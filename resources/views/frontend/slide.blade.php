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

        <!-- Navigation -->
        <button class="prev">&#10094;</button>
        <button class="next">&#10095;</button>

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

/* Navigation buttons */
.prev, .next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    font-size: 2rem;
    background: rgba(0,0,0,0.4);
    color: #fff;
    border: none;
    padding: 10px 15px;
    cursor: pointer;
    border-radius: 5px;
    z-index: 10;
}
.prev { left: 10px; }
.next { right: 10px; }

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
    background: rgba(255,255,255,0.5);
    border-radius: 50%;
    cursor: pointer;
}

.pagination .active {
    background: #fff;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const slides = document.querySelectorAll('.slide');
    const slidesWrapper = document.querySelector('.slides-wrapper');
    const prevBtn = document.querySelector('.prev');
    const nextBtn = document.querySelector('.next');
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

    prevBtn.addEventListener('click', () => {
        currentIndex = (currentIndex - 1 + total) % total;
        updateSlider();
        resetInterval();
    });

    nextBtn.addEventListener('click', () => {
        currentIndex = (currentIndex + 1) % total;
        updateSlider();
        resetInterval();
    });

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
