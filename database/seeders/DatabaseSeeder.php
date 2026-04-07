<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Tạo danh sách các khóa học mẫu
        $courses = [
            [
                'title'       => 'Lập trình Laravel 11 từ A-Z',
                'description' => 'Khóa học tuyệt vời nhất để trở thành Backend Developer.',
                'price'       => 1500000,
                'status'      => 'published',
            ],
            [
                'title'       => 'ReactJS Thực chiến',
                'description' => 'Làm chủ Frontend với ReactJS qua các dự án thực tế.',
                'price'       => 1200000,
                'status'      => 'published',
            ],
            [
                'title'       => 'Tiếng Anh IT cho Lập trình viên',
                'description' => 'Đọc hiểu tài liệu tiếng Anh trôi chảy.',
                'price'       => 500000,
                'status'      => 'published',
            ],
            [
                'title'       => 'Cấu trúc dữ liệu và Giải thuật',
                'description' => 'Nền tảng bắt buộc để pass phỏng vấn các công ty lớn.',
                'price'       => 800000,
                'status'      => 'draft', // Cố tình để draft để test bộ lọc
            ],
            [
                'title'       => 'Thiết kế UI/UX với Figma',
                'description' => 'Học thiết kế giao diện web và app đẹp mắt.',
                'price'       => 950000,
                'status'      => 'published',
            ],
        ];

        // Lặp qua mảng và thêm vào Database
        foreach ($courses as $course) {
            Course::create([
                'title'       => $course['title'],
                'slug'        => Str::slug($course['title']), // Tự động tạo slug từ title
                'description' => $course['description'],
                'price'       => $course['price'],
                'status'      => $course['status'],
                'image'       => null, // Mặc định chưa có ảnh
            ]);
        }
    }
}