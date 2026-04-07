<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Thêm dòng này

class Lesson extends Model
{
    use SoftDeletes; // Bật tính năng Xóa mềm

    protected $fillable = [
        'course_id', 'title', 'content', 'video_url', 'order'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}