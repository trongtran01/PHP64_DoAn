<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>404 - Không tìm thấy trang</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/css/404.css') }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('frontend/images/icon.svg') }}">
</head>

<body>
    <main class="error-card">
        <section class="error-visual" aria-label="Lỗi 404">
            <svg class="coffee-icon" viewBox="0 0 420 300" role="img"
                aria-label="Lỗi 404 với số không là một cốc cà phê bị thất lạc">
                <circle cx="210" cy="140" r="134" fill="#fff" opacity="0.08" />

                {{-- Hai số 4 và cốc cà phê tạo thành 404 --}}
                <text x="20" y="190" fill="#fff" font-family="Poppins, sans-serif" font-size="150"
                    font-weight="700">4</text>
                <text x="310" y="190" fill="#fff" font-family="Poppins, sans-serif" font-size="150"
                    font-weight="700">4</text>

                {{-- Hơi cà phê tạo dấu hỏi, gợi ý trang bị thất lạc --}}
                <path d="M208 68 C176 45 240 28 211 2 C198 -10 205 -22 221 -27" fill="none" stroke="#fff"
                    stroke-width="7" stroke-linecap="round" opacity="0.85">
                    <animate attributeName="d"
                        values="M208 68 C176 45 240 28 211 2 C198 -10 205 -22 221 -27;M208 68 C240 45 176 28 211 2 C224 -10 217 -22 201 -27;M208 68 C176 45 240 28 211 2 C198 -10 205 -22 221 -27"
                        dur="3s" repeatCount="indefinite" />
                </path>
                <circle cx="211" cy="79" r="4" fill="#fff" opacity="0.9" />

                {{-- Cốc cà phê đóng vai trò số 0 --}}
                <path d="M148 91 H261 L251 194 C249 215 232 229 210 229 H196 C174 229 157 215 155 194 Z" fill="#fff" />
                <ellipse cx="204.5" cy="92" rx="56.5" ry="14" fill="#f4f2ff" />
                <ellipse cx="204.5" cy="93" rx="46" ry="8.5" fill="#8b4513" />
                <path d="M260 119 H277 C303 119 309 158 286 173 C279 178 269 179 256 176" fill="none" stroke="#fff"
                    stroke-width="13" stroke-linecap="round" />
                <path
                    d="M190 146 C190 136 202 132 210 141 C218 132 230 136 230 146 C230 158 210 169 210 169 C210 169 190 158 190 146Z"
                    fill="#764ba2" />

                {{-- Đường dẫn bị đứt --}}
                <path d="M82 252 H162 M258 252 H338" fill="none" stroke="#fff" stroke-width="5" stroke-linecap="round"
                    stroke-dasharray="8 12" opacity="0.7" />
                <path d="M188 242 L203 257 L218 242 L233 257" fill="none" stroke="#ffd76a" stroke-width="6"
                    stroke-linecap="round" stroke-linejoin="round" />
                <circle cx="62" cy="252" r="8" fill="#ffd76a" />
                <path d="M340 252 L326 243 V261 Z" fill="#ffd76a" />
            </svg>

            <p class="error-number">404</p>
            <p class="visual-message">Đường dẫn tới trang này đã bị gián đoạn.</p>
        </section>

        <section class="error-content">
            <p class="eyebrow">Lỗi 404</p>
            <h1>Không tìm thấy trang</h1>
            <p class="description">
                Rất tiếc, trang bạn đang tìm không tồn tại, đã được di chuyển hoặc đường dẫn không còn chính xác.
            </p>

            <div class="actions">
                <a class="button button-primary" href="{{ url('/') }}">Về trang chủ</a>
            </div>
        </section>
    </main>
</body>

</html>