<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    protected $fillable = [
        'student_id', 'course_id'
    ];

    // N-1: Thuộc về Học viên nào
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    // N-1: Thuộc về Khóa học nào
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}