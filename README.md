<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
# 🎓 Course Management System (CMS)

Đây là Mini Project Quản lý Khóa học trực tuyến được xây dựng bằng Laravel, bao gồm các chức năng quản lý Khóa học, Bài học và Học viên đăng ký.

## 🚀 Các chức năng chính
* **Quản lý Khóa học:** Thêm, sửa, xóa (Soft Delete), tìm kiếm, sắp xếp nâng cao (theo giá, số học viên, mới nhất).
* **Quản lý Bài học:** Thêm bài học, URL video theo từng khóa học.
* **Quản lý Học viên:** Xem danh sách học viên đăng ký theo khóa học.
* **UI/UX:** Giao diện quản trị (Admin Dashboard) tone màu Pink Pastel.
* **Kỹ thuật áp dụng:** Eloquent ORM (Relationships 1-N, N-N), Form Request Validation, Eager Loading (`withCount`) để tối ưu hiệu năng.

## ⚙️ Hướng dẫn cài đặt và chạy dự án

Vui lòng làm theo các bước dưới đây để chạy project trên máy cá nhân:

**Bước 1:** Clone source code từ GitHub về máy
\`\`\`bash
git clone <đường-dẫn-repo-github-của-bạn>
cd <tên-thư-mục-project>
\`\`\`

**Bước 2:** Cài đặt các thư viện cần thiết (Vendor)
\`\`\`bash
composer install
\`\`\`

**Bước 3:** Cấu hình file môi trường
* Copy file `.env.example` và đổi tên thành `.env`.
* Mở file `.env` lên, tìm đến phần `DB_DATABASE` và đổi tên database thành `cms_db` (hoặc tên database của bạn trong phpMyAdmin).
* *Lưu ý: Bạn cần tạo sẵn một database trống có tên tương ứng trong phpMyAdmin (MySQL).*

**Bước 4:** Tạo mã bảo mật (Generate Key)
\`\`\`bash
php artisan key:generate
\`\`\`

**Bước 5:** Chạy Migration để tạo các bảng trong Database
\`\`\`bash
php artisan migrate
\`\`\`

**Bước 6:** Link thư mục chứa ảnh (Storage Link)
Vì hệ thống có chức năng upload ảnh đại diện khóa học, bạn cần chạy lệnh này để ảnh hiển thị được:
\`\`\`bash
php artisan storage:link
\`\`\`

**Bước 7:** Khởi động Server ảo
\`\`\`bash
php artisan serve
\`\`\`
Mở trình duyệt và truy cập vào: `http://127.0.0.1:8000`