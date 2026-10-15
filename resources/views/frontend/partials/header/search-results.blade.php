@php
    // Escape trước rồi mới bọc <mark> để in đậm phần khớp từ khóa (an toàn XSS)
    $highlight = function ($text) use ($key) {
        $safe = e($text);
        if ($key === '') {
            return $safe;
        }
        return preg_replace('/(' . preg_quote(e($key), '/') . ')/iu', '<mark>$1</mark>', $safe) ?? $safe;
    };
@endphp

@if(empty($groups))
    <div class="sr-state">
        <i class="far fa-face-frown"></i>
        <p>Không tìm thấy sản phẩm cho "<strong>{{ $key }}</strong>"</p>
    </div>
@else
    <div class="sr-body">
        @foreach($groups as $group)
            <section class="sr-group">
                @if($group['url'])
                    <a href="{{ $group['url'] }}" class="sr-group-head">
                        <span class="sr-group-name">{{ $group['name'] }}</span>
                        <span class="sr-group-more">Xem danh mục <i class="fas fa-angle-right"></i></span>
                    </a>
                @else
                    <div class="sr-group-head">
                        <span class="sr-group-name">{{ $group['name'] }}</span>
                    </div>
                @endif

                <ul class="sr-list">
                    @foreach($group['products'] as $product)
                        <li>
                            <a href="{{ $product['url'] }}" class="sr-item">
                                @if($product['photo'])
                                    <img src="{{ $product['photo'] }}" alt="" loading="lazy">
                                @else
                                    <span class="sr-noimg"><i class="far fa-image"></i></span>
                                @endif
                                <span class="sr-name">{!! $highlight($product['name']) !!}</span>
                                <span class="sr-price">{{ $product['price'] }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </section>
        @endforeach
    </div>

    <a href="{{ route('products.search') }}?key={{ urlencode($key) }}" class="sr-footer">
        Xem tất cả {{ $total }} kết quả cho "{{ $key }}" <i class="fas fa-arrow-right"></i>
    </a>
@endif