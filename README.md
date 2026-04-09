# 🎓 Course Management System (CMS)

Đây là một hệ thống quản lý khóa học nhỏ xây dựng bằng Laravel, phù hợp cho bài tập nhóm hoặc dự án học tập.

## 🌟 Mục tiêu dự án
- Quản lý khóa học, danh mục và tag.
- Quản lý bài học theo từng khóa học.
- Phân quyền người dùng Admin và Student.
- Trang catalog khóa học công khai.
- Trang admin để quản lý khóa học, bài học và học viên.

## 🚀 Tính năng chính
- Quản lý khóa học: thêm, sửa, xóa, phục hồi (soft delete).
- Quản lý bài học: thêm bài học thuộc khóa học.
- Quản lý học viên: xem học viên đã đăng ký.
- Phân quyền: admin quản lý, student xem và đăng ký.
- UI/UX: giao diện tone hồng pastel, layout gọn, dễ dùng.

## 🧰 Công nghệ sử dụng
- Laravel
- PHP
- Blade Templates
- Bootstrap 5
- MySQL
- Eloquent ORM

## ⚙️ Hướng dẫn cài đặt và chạy dự án

### Bước 1: Clone repository
```bash
git clone <đường-dẫn-repo-github-của-bạn>
cd cms_project
```

### Bước 2: Cài đặt dependencies
```bash
composer install
```

### Bước 3: Cấu hình môi trường
```bash
copy .env.example .env
```
- Mở file `.env` và chỉnh thông tin kết nối database.
- Tạo database trống trong MySQL / phpMyAdmin.

### Bước 4: Tạo app key
```bash
php artisan key:generate
```

### Bước 5: Chạy migration
```bash
php artisan migrate
```

### Bước 6: Tạo symbolic link cho storage
```bash
php artisan storage:link
```

### Bước 7: Khởi động ứng dụng
```bash
php artisan serve
```
Mở trình duyệt và truy cập: `http://127.0.0.1:8000`

## 🔐 Tài khoản mẫu
Nếu bạn muốn thử admin nhanh, có thể tạo user rồi gán `role = admin` trong database.

## 📦 Cấu trúc chính
- `app/Http/Controllers/`: controller
- `app/Models/`: model dữ liệu
- `database/migrations/`: định nghĩa cấu trúc bảng
- `resources/views/`: giao diện Blade
- `routes/web.php`: route web

## 📌 Hướng dẫn đẩy code lên GitHub
### Nếu remote đã được cấu hình
```bash
git add -A
git commit -m 'Hoàn thiện project CMS Laravel'
git push origin main
```

### Nếu bạn muốn đổi remote sang repo mới
```bash
git remote set-url origin https://github.com/<tên-user>/<tên-repo>.git
git push -u origin main
```

## ✅ Kiểm tra trước khi push
- `git status` để xem file thay đổi.
- `git diff` để xem nội dung thay đổi.
- `git log --oneline` để kiểm tra commit.

---

Chúc bạn upload và hoàn thiện project thành công! Nếu cần mình có thể hướng dẫn tiếp cách tạo repository trên GitHub và liên kết từ đầu.
