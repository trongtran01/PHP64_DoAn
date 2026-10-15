{{--
Giao diện phân trang riêng (không phụ thuộc Tailwind/Bootstrap).
Đăng ký làm mặc định trong AppServiceProvider::boot():
    Paginator::defaultView('vendor.pagination.custom');
CSS: public/frontend/css/pagination.css
--}}
@if ($paginator->hasPages())
    <nav class="pg-nav" role="navigation" aria-label="Phân trang">
        <ul class="pg-list">
            {{-- Trang trước --}}
            @if ($paginator->onFirstPage())
                <li class="pg-item is-disabled" aria-disabled="true">
                    <span class="pg-link" aria-hidden="true"><i class="fas fa-chevron-left"></i></span>
                </li>
            @else
                <li class="pg-item">
                    <a class="pg-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Trang trước">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                </li>
            @endif

            {{-- Các số trang --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="pg-item is-disabled" aria-disabled="true"><span class="pg-link">{{ $element }}</span></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="pg-item is-active" aria-current="page"><span class="pg-link">{{ $page }}</span></li>
                        @else
                            <li class="pg-item"><a class="pg-link" href="{{ $url }}"
                                    aria-label="Trang {{ $page }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Trang sau --}}
            @if ($paginator->hasMorePages())
                <li class="pg-item">
                    <a class="pg-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Trang sau">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </li>
            @else
                <li class="pg-item is-disabled" aria-disabled="true">
                    <span class="pg-link" aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
                </li>
            @endif
        </ul>

        @if (method_exists($paginator, 'total'))
            <p class="pg-summary">
                Hiển thị {{ $paginator->firstItem() }} - {{ $paginator->lastItem() }} trong {{ $paginator->total() }} sản phẩm
            </p>
        @endif
    </nav>
@endif