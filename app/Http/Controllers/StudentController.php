<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index()
    {
        if (! Auth::check() || ! Auth::user()->isStudent()) {
            abort(403, 'Bạn không có quyền truy cập.');
        }

        $student = Student::firstOrCreate(
            ['email' => Auth::user()->email],
            ['name' => Auth::user()->name]
        );

        $courses = $student->courses()->withCount('lessons')->get();

        return view('students.courses', compact('courses'));
    }

    public function show(Course $course)
    {
        if (! Auth::check() || ! Auth::user()->isStudent()) {
            abort(403, 'Bạn không có quyền truy cập.');
        }

        $student = Student::firstOrCreate(
            ['email' => Auth::user()->email],
            ['name' => Auth::user()->name]
        );

        if (! $student->courses()->where('course_id', $course->id)->exists()) {
            abort(403, 'Bạn chưa đăng ký khóa học này.');
        }

        $lessons = $course->lessons()->orderBy('order')->get();

        return view('students.course_detail', compact('course', 'lessons'));
    }
}
