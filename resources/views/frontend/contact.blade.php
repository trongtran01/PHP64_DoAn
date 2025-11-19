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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('frontend/images/caphe.png') }}" type="image/png" class="favicon-image">
</head>
<body>
@extends("frontend.layout_home")
@section("do-du-lieu-vao-layout")
<style>
    .contact_container {
        margin-top: 40px;
        margin-bottom: 40px;
    }
    /* Header Section */
    .profile-header {
        background: #ffffff;
        border-radius: 20px;
        padding: 50px;
        margin-bottom: 30px;
        box-shadow: 0 5px 20px rgba(36, 32, 82, 0.08);
    }
    
    .profile-top {
        display: flex;
        align-items: center;
        gap: 40px;
        margin-bottom: 30px;
    }
    
    .profile-picture {
        position: relative;
        width: 150px;
        height: 150px;
    }
    
    .logo-circle {
        width: 150px;
        height: 150px;
        background: #ffffff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-weight: bold;
        font-size: 28px;
        letter-spacing: 2px;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        border: 1px solid darkblue;
    }
    .logo-circle img {
        width: 100%;
    }
    
    .logo-text {
        transition: opacity 0.3s ease;
    }
    
    .instagram-icon {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        opacity: 0;
        transition: opacity 0.3s ease;
        font-size: 50px;
    }
    
    .logo-circle:hover .logo-text {
        opacity: 0;
    }
    
    .logo-circle:hover .instagram-icon {
        opacity: 1;
    }
    
    .logo-circle:hover {
        transform: scale(1.05);
        box-shadow: 0 10px 30px rgba(36, 32, 82, 0.3);
    }
    
    .profile-info {
        flex: 1;
    }
    
    .username {
        font-size: 28px;
        font-weight: 300;
        color: #242052;
        margin-bottom: 20px;
    }
    
    .profile-stats {
        display: flex;
        gap: 40px;
        margin-bottom: 20px;
    }
    
    .stat {
        font-size: 16px;
    }
    
    .stat strong {
        font-weight: 600;
        color: #242052;
    }
    
    .profile-bio {
        margin-top: 20px;
    }
    
    .bio-title {
        font-weight: 600;
        font-size: 16px;
        color: #242052;
        margin-bottom: 8px;
        letter-spacing: 1px;
    }
    
    .bio-text {
        font-size: 14px;
        line-height: 1.6;
        color: #242052;
        white-space: pre-line;
    }
    
    /* Posts Grid */
    .posts-section {
        background: #ffffff;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 5px 20px rgba(36, 32, 82, 0.08);
    }
    
    .posts-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }
    
    .post-item {
        position: relative;
        aspect-ratio: 1;
        background: linear-gradient(135deg, #242052, #4a4299);
        border-radius: 10px;
        overflow: hidden;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .post-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(36, 32, 82, 0.2);
    }
    
    .post-item:hover .post-overlay {
        opacity: 1;
    }
    
    .post-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 14px;
        text-align: center;
        padding: 20px;
        font-weight: 500;
    }
    
    .post-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(36, 32, 82, 0.85);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 20px;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .overlay-stat {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #ffffff;
        font-weight: 600;
        font-size: 16px;
    }
    
    .overlay-stat svg {
        width: 24px;
        height: 24px;
        fill: #ffffff;
    }
    
    /* Instagram SVG Icons */
    .ig-icon {
        width: 50px;
        height: 50px;
    }
    
    @media (max-width: 768px) {
        .profile-header {
            padding: 30px 20px;
        }
        
        .profile-top {
            flex-direction: column;
            text-align: center;
            gap: 20px;
        }
        
        .profile-stats {
            justify-content: center;
        }
        
        .posts-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }
        
        .posts-section {
            padding: 20px;
        }
        .logo-circle img {
        width: 75%;
    }
    }
    
    @media (max-width: 480px) {
        .posts-grid {
            grid-template-columns: 1fr;
        }
        
        .logo-circle {
            width: 120px;
            height: 120px;
            font-size: 22px;
        }
        
        .profile-picture {
            width: 120px;
            height: 120px;
        }
    }
</style>
<div class="container contact_container">
    <!-- Profile Header -->
    <div class="profile-header">
        <div class="profile-top">
            <div class="profile-picture">
                <a href="https://www.instagram.com/lavietcoffee/" target="_blank" rel="noopener noreferrer">
                    <div class="logo-circle">
                        <span class="logo-text">
                            <img src="{{ asset('frontend/images/logo.png') }}" alt="Logo">
                        </span>
                        <div class="instagram-icon">
                            <svg viewBox="0 0 24 24" class="ig-icon" fill="darkblue">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </div>
                    </div>
                </a>
            </div>
            
            <div class="profile-info">
                <h1 class="username">lavietcoffee</h1>
                <div class="profile-stats">
                    <div class="stat"><strong>294</strong> bài viết</div>
                    <div class="stat"><strong>14K</strong> người theo dõi</div>
                    <div class="stat"><strong>115</strong> đang theo dõi</div>
                </div>
            </div>
        </div>
        
        <div class="profile-bio">
            <div class="bio-title">𝐆𝐎𝐎𝐃 𝐂𝐎𝐅𝐅𝐄𝐄 𝐒𝐇𝐀𝐑𝐄𝐒 𝐇𝐀𝐏𝐏𝐈𝐍𝐄𝐒𝐒</div>
            <div class="bio-text">We process, roast and brew Vietnam Arabica beans from Da Lat, with special concentration on technique and sharing.</div>
        </div>
    </div>
    
    <!-- Posts Grid -->
    <div class="posts-section">
        <div class="posts-grid">
            <!-- Post 1 -->
            <a href="https://www.instagram.com/lavietcoffee/" target="_blank" rel="noopener noreferrer" class="post-item">
                <div class="post-placeholder">Cà Phê Phin</div>
                <div class="post-overlay">
                    <div class="overlay-stat">
                        <svg viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                        245
                    </div>
                    <div class="overlay-stat">
                        <svg viewBox="0 0 24 24"><path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H6l-2 2V4h16v12z"/></svg>
                        18
                    </div>
                </div>
            </a>
            
            <!-- Post 2 -->
            <a href="https://www.instagram.com/lavietcoffee/" target="_blank" rel="noopener noreferrer" class="post-item">
                <div class="post-placeholder">Không Gian Quán</div>
                <div class="post-overlay">
                    <div class="overlay-stat">
                        <svg viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                        312
                    </div>
                    <div class="overlay-stat">
                        <svg viewBox="0 0 24 24"><path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H6l-2 2V4h16v12z"/></svg>
                        24
                    </div>
                </div>
            </a>
            
            <!-- Post 3 -->
            <a href="https://www.instagram.com/lavietcoffee/" target="_blank" rel="noopener noreferrer" class="post-item">
                <div class="post-placeholder">Hạt Cà Phê Đà Lạt</div>
                <div class="post-overlay">
                    <div class="overlay-stat">
                        <svg viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                        428
                    </div>
                    <div class="overlay-stat">
                        <svg viewBox="0 0 24 24"><path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H6l-2 2V4h16v12z"/></svg>
                        35
                    </div>
                </div>
            </a>
            
            <!-- Post 4 -->
            <a href="https://www.instagram.com/lavietcoffee/" target="_blank" rel="noopener noreferrer" class="post-item">
                <div class="post-placeholder">Latte Art</div>
                <div class="post-overlay">
                    <div class="overlay-stat">
                        <svg viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                        567
                    </div>
                    <div class="overlay-stat">
                        <svg viewBox="0 0 24 24"><path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H6l-2 2V4h16v12z"/></svg>
                        42
                    </div>
                </div>
            </a>
            
            <!-- Post 5 -->
            <a href="https://www.instagram.com/lavietcoffee/" target="_blank" rel="noopener noreferrer" class="post-item">
                <div class="post-placeholder">Nông Trại Cà Phê</div>
                <div class="post-overlay">
                    <div class="overlay-stat">
                        <svg viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                        391
                    </div>
                    <div class="overlay-stat">
                        <svg viewBox="0 0 24 24"><path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H6l-2 2V4h16v12z"/></svg>
                        28
                    </div>
                </div>
            </a>
            
            <!-- Post 6 -->
            <a href="https://www.instagram.com/lavietcoffee/" target="_blank" rel="noopener noreferrer" class="post-item">
                <div class="post-placeholder">Cold Brew</div>
                <div class="post-overlay">
                    <div class="overlay-stat">
                        <svg viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                        478
                    </div>
                    <div class="overlay-stat">
                        <svg viewBox="0 0 24 24"><path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H6l-2 2V4h16v12z"/></svg>
                        31
                    </div>
                </div>
            </a>
            
            <!-- Post 7 -->
            <a href="https://www.instagram.com/lavietcoffee/" target="_blank" rel="noopener noreferrer" class="post-item">
                <div class="post-placeholder">Espresso</div>
                <div class="post-overlay">
                    <div class="overlay-stat">
                        <svg viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                        523
                    </div>
                    <div class="overlay-stat">
                        <svg viewBox="0 0 24 24"><path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H6l-2 2V4h16v12z"/></svg>
                        47
                    </div>
                </div>
            </a>
            
            <!-- Post 8 -->
            <a href="https://www.instagram.com/lavietcoffee/" target="_blank" rel="noopener noreferrer" class="post-item">
                <div class="post-placeholder">Bánh Ngọt</div>
                <div class="post-overlay">
                    <div class="overlay-stat">
                        <svg viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                        289
                    </div>
                    <div class="overlay-stat">
                        <svg viewBox="0 0 24 24"><path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H6l-2 2V4h16v12z"/></svg>
                        22
                    </div>
                </div>
            </a>
            
            <!-- Post 9 -->
            <a href="https://www.instagram.com/lavietcoffee/" target="_blank" rel="noopener noreferrer" class="post-item">
                <div class="post-placeholder">Barista</div>
                <div class="post-overlay">
                    <div class="overlay-stat">
                        <svg viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                        612
                    </div>
                    <div class="overlay-stat">
                        <svg viewBox="0 0 24 24"><path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H6l-2 2V4h16v12z"/></svg>
                        53
                    </div>
                </div>
            </a>
            
            <!-- Post 10 -->
            <a href="https://www.instagram.com/lavietcoffee/" target="_blank" rel="noopener noreferrer" class="post-item">
                <div class="post-placeholder">Pha Chế</div>
                <div class="post-overlay">
                    <div class="overlay-stat">
                        <svg viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                        445
                    </div>
                    <div class="overlay-stat">
                        <svg viewBox="0 0 24 24"><path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H6l-2 2V4h16v12z"/></svg>
                        38
                    </div>
                </div>
            </a>
            
            <!-- Post 11 -->
            <a href="https://www.instagram.com/lavietcoffee/" target="_blank" rel="noopener noreferrer" class="post-item">
                <div class="post-placeholder">Cappuccino</div>
                <div class="post-overlay">
                    <div class="overlay-stat">
                        <svg viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                        534
                    </div>
                    <div class="overlay-stat">
                        <svg viewBox="0 0 24 24"><path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H6l-2 2V4h16v12z"/></svg>
                        45
                    </div>
                </div>
            </a>
            
            <!-- Post 12 -->
            <a href="https://www.instagram.com/lavietcoffee/" target="_blank" rel="noopener noreferrer" class="post-item">
                <div class="post-placeholder">Coffee Beans</div>
                <div class="post-overlay">
                    <div class="overlay-stat">
                        <svg viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                        378
                    </div>
                    <div class="overlay-stat">
                        <svg viewBox="0 0 24 24"><path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H6l-2 2V4h16v12z"/></svg>
                        29
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
</body>
</html>
