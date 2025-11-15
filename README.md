# 🏬 Goods Shop – Laravel Admin Panel

[![Laravel Version](https://img.shields.io/badge/Laravel-10.x-red.svg)](https://laravel.com/)
[![PHP Version](https://img.shields.io/badge/PHP-8.x-777.svg)](https://www.php.net/)
[![License](https://img.shields.io/badge/License-MIT-blue.svg)](LICENSE)



Dự án **Goods Shop Admin Panel** là một hệ thống quản trị cửa hàng hoàn chỉnh, được xây dựng trên nền tảng **PHP Laravel 10.x**. Hệ thống này cung cấp giao diện quản trị chuyên nghiệp (được tự xây dựng, không sử dụng template bên ngoài) với đầy đủ các chức năng **CRUD** để quản lý người dùng, danh mục sản phẩm (hỗ trợ danh mục đa cấp) và banner quảng cáo.

## ✨ Tính năng chính

* **🔐 Authentication (Backend):**
    * Trang đăng nhập Admin **riêng biệt**.
    * Sử dụng **Middleware** (`check_login`) để bảo vệ toàn bộ các route trong khu vực `/backend`.
* **🗂️ Quản lý Users (CRUD):**
    * Xem danh sách User với **phân trang 5 user/trang**.
    * Tạo mới User (có **Validate** và sử dụng **Laravel Hash** để mã hóa mật khẩu).
    * Sửa thông tin User (không bắt buộc đổi mật khẩu).
    * Xóa User.
    * Sử dụng **Eloquent Model** `App\Models\User`.
* **🏷️ Quản lý Categories (CRUD + Danh mục con):**
    * Hỗ trợ danh mục đa cấp (parent/child).
    * Hiển thị dưới dạng **cây (tree view)** trong bảng danh sách.
    * Tối ưu bằng **Eloquent Relationship**.
    * Tự động **xóa các danh mục con** khi xóa danh mục cha.
    * Có trường `display_at_home_page` để kiểm soát hiển thị.
    * Sử dụng **Eloquent Model** `App\Models\Categories`.
* **6. Quản lý Banner:**
    * Hỗ trợ **Upload** hình ảnh banner.
    * Chức năng **CRUD** đầy đủ.
* **7. Layout Admin:**
    * Layout quản trị đồng nhất, tự xây dựng, kế thừa qua file `resources/views/layouts/admin.blade.php`.

---

## ⚙️ Công nghệ sử dụng

| Công nghệ | Phiên bản | Mô tả |
| :--- | :--- | :--- |
| **PHP** | 8.x | Ngôn ngữ lập trình chính. |
| **Laravel Framework** | 10.x | Khung phát triển Backend. |
| **Database** | MySQL / MariaDB | Cơ sở dữ liệu. |
| **Containerization** | Docker / Docker Compose | Môi trường phát triển và triển khai nhất quán. |
| **Frontend** | Blade Template | Template Engine mặc định của Laravel. |
| **Data Access** | Laravel Eloquent + Query Builder | Tối ưu hóa truy vấn CSDL. |
| **UI** | Admin Panel tự xây dựng | Không phụ thuộc vào bất kỳ theme/template bên ngoài nào. |

---

## 🏗️ Cấu trúc thư mục quan trọng

Dự án tuân theo cấu trúc chuẩn của Laravel, với các thư mục chính tập trung vào logic Admin:
src/
 ├── app/
 │    ├── Http/
 │    │     ├── Controllers/
 │    │     │      └── Admin/
 │    │     │           ├── HomeController.php
 │    │     │           ├── UsersController.php
 │    │     │           ├── CategoriesController.php
 │    │     │           └── BannerController.php
 │    │     └── Middleware/check_login.php
 │    ├── Models/
 │    │     ├── User.php
 │    │     └── Categories.php
 │    └── …
 ├── resources/
 │    └── views/
 │          ├── admin/
 │          │      ├── layout.blade.php
 │          │      ├── home/
 │          │      │     └── index.blade.php
 │          │      ├── users/
 │          │      │     ├── index.blade.php
 │          │      │     └── create_update.blade.php
 │          │      ├── categories/
 │          │      │     ├── index.blade.php
 │          │      │     └── form.blade.php
 │          │      └── banners/
 │          │            ├── index.blade.php
 │          │            └── form.blade.php
 │          └── layouts/
 │                └── admin.blade.php
 ├── docker/
 │      ├── docker-compose.yml
 │      └── php-nginx configs
 └── routes/
        └── web.php

# 🚀 Hướng dẫn chạy dự án Laravel bằng Docker

Dự án sử dụng **Docker** và **Docker Compose** để tạo môi trường phát triển bao gồm: PHP/Laravel, MySQL, Nginx.

---

## 📦 Yêu cầu hệ thống
- Docker bản mới nhất  
- Docker Compose bản mới nhất  

---

# ▶️ Khởi động dự án

### 1. Build & chạy containers
docker compose up -d

### 2. Tắt containers
docker compose down

### 3. Tắt + xóa volumes (mất database!)
docker compose down -v

---

# 🐘 Các lệnh Laravel trong Docker

### 1. Vào container PHP (Laravel)
Container có thể tên là `app` hoặc `php`:
docker compose exec app bash 

### 2. Artisan commands
docker compose exec app php artisan migrate
docker compose exec app php artisan cache:clear
docker compose exec app php artisan config:clear
docker compose exec app php artisan route:clear
docker compose exec app php artisan optimize

### 3. Composer
docker compose exec app composer install
docker compose exec app composer update

### 4. NPM/Yarn (nếu chạy trong container)
docker compose exec node npm install
docker compose exec node npm run dev

---

# 🗄️ Làm việc với MySQL

### 1. Truy cập container MySQL
docker compose exec mysql bash

### 2. Đăng nhập MySQL
mysql -u root -p

### 3. Import database
docker compose exec mysql bash -c "mysql -u root -pYOURPASS database_name < /var/www/database.sql"

---

# 🧹 Dọn dẹp Docker

### Xóa containers không dùng
docker container prune

### Xóa images không dùng
docker image prune -a

---

# 🔧 Lỗi thường gặp

### 1. Lỗi quyền storage/cache
docker compose exec app chmod -R 777 storage
docker compose exec app chmod -R 777 bootstrap/cache

### 2. Clone dự án mới – chưa setup Laravel
docker compose exec app cp .env.example .env
docker compose exec app composer install
docker compose exec app php artisan key:generate

---