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
