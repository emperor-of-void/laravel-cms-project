<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes; // Yêu cầu 5: Sử dụng Soft Delete

    protected $fillable = [
        'title', 'slug', 'price', 'description', 'image', 'status', 'category_id'
    ];

    // Quan hệ 1-N: 1 Khóa học có nhiều Bài học
    public function lessons()
    {
        return $this->hasMany(Lesson::class)->orderBy('order');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'course_tag')->withTimestamps();
    }

    // Quan hệ 1-N: 1 Khóa học có nhiều Đăng ký
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    // Quan hệ N-N: Khóa học và Học viên (thông qua bảng enrollments)
    public function students()
    {
        // Đã thêm ->withTimestamps() ở đây
        return $this->belongsToMany(Student::class, 'enrollments')->withTimestamps();
    }

    // Yêu cầu 3.5: Scope nâng cao
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopePriceBetween($query, $min, $max)
    {
        return $query->whereBetween('price', [$min, $max]);
    }
}