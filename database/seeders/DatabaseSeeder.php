<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Course;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $categoryData = [
            'Backend',
            'Frontend',
            'Design',
            'English',
        ];

        $categories = collect($categoryData)->mapWithKeys(function ($name) {
            return [Str::slug($name) => Category::firstOrCreate([
                'slug' => Str::slug($name),
            ], [
                'name' => $name,
            ])];
        });

        $courses = [
            [
                'title'       => 'Lập trình Laravel 11 từ A-Z',
                'description' => 'Khóa học tuyệt vời nhất để trở thành Backend Developer.',
                'price'       => 1500000,
                'status'      => 'published',
                'category'    => 'backend',
                'tags'        => ['Laravel', 'PHP', 'Backend'],
            ],
            [
                'title'       => 'ReactJS Thực chiến',
                'description' => 'Làm chủ Frontend với ReactJS qua các dự án thực tế.',
                'price'       => 1200000,
                'status'      => 'published',
                'category'    => 'frontend',
                'tags'        => ['ReactJS', 'JavaScript', 'Frontend'],
            ],
            [
                'title'       => 'Tiếng Anh IT cho Lập trình viên',
                'description' => 'Đọc hiểu tài liệu tiếng Anh trôi chảy.',
                'price'       => 500000,
                'status'      => 'published',
                'category'    => 'english',
                'tags'        => ['English', 'IT', 'Communication'],
            ],
            [
                'title'       => 'Cấu trúc dữ liệu và Giải thuật',
                'description' => 'Nền tảng bắt buộc để pass phỏng vấn các công ty lớn.',
                'price'       => 800000,
                'status'      => 'draft',
                'category'    => 'backend',
                'tags'        => ['Algorithms', 'Data Structures'],
            ],
            [
                'title'       => 'Thiết kế UI/UX với Figma',
                'description' => 'Học thiết kế giao diện web và app đẹp mắt.',
                'price'       => 950000,
                'status'      => 'published',
                'category'    => 'design',
                'tags'        => ['Figma', 'Design', 'UI/UX'],
            ],
        ];

        foreach ($courses as $course) {
            $courseModel = Course::firstOrCreate(
                ['slug' => Str::slug($course['title'])],
                [
                    'title'       => $course['title'],
                    'description' => $course['description'],
                    'price'       => $course['price'],
                    'status'      => $course['status'],
                    'image'       => null,
                    'category_id' => $categories[$course['category']]->id,
                ]
            );

            $tagIds = [];
            foreach ($course['tags'] as $tagName) {
                $tagIds[] = Tag::firstOrCreate([
                    'slug' => Str::slug($tagName),
                ], [
                    'name' => $tagName,
                ])->id;
            }
            $courseModel->tags()->sync($tagIds);
        }

        User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin CMS',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );
    }
}