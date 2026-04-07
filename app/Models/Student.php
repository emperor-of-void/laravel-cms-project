<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name', 'email'
    ];

    // Quan hệ 1-N: 1 Học viên có nhiều lượt đăng ký
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    // Quan hệ N-N: Học viên đăng ký nhiều Khóa học
    public function courses()
    {
        // Đã thêm ->withTimestamps() ở đây
        return $this->belongsToMany(Course::class, 'enrollments')->withTimestamps();
    }
}