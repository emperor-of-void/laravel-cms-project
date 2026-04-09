<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Course;
use App\Http\Requests\LessonRequest;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function __construct()
    {
        if (! auth()->check() || ! auth()->user()->isAdmin()) {
            abort(403, 'Bạn không có quyền truy cập.');
        }
    }

    // =====================================
    // DANH SÁCH BÀI HỌC (Nhóm theo khóa học)
    // =====================================
    public function index()
    {
        // Lấy các khóa học, kèm theo bài học được sắp xếp theo 'order' tăng dần
        $courses = Course::with(['lessons' => function($query) {
            $query->orderBy('order', 'asc');
        }])->get();

        return view('lessons.index', compact('courses'));
    }

    // =====================================
    // FORM THÊM MỚI BÀI HỌC
    // =====================================
    public function create()
    {
        $courses = Course::all(); // Lấy danh sách khóa học để đưa vào Select Box
        return view('lessons.create', compact('courses'));
    }

    // =====================================
    // LƯU BÀI HỌC
    // =====================================
    public function store(LessonRequest $request)
    {
        Lesson::create($request->validated());
        return redirect()->route('lessons.index')->with('success', 'Thêm bài học thành công!');
    }

    // =====================================
    // FORM SỬA BÀI HỌC
    // =====================================
    public function edit(Lesson $lesson)
    {
        $courses = Course::all();
        return view('lessons.edit', compact('lesson', 'courses'));
    }

    // =====================================
    // CẬP NHẬT BÀI HỌC
    // =====================================
    public function update(LessonRequest $request, Lesson $lesson)
    {
        $lesson->update($request->validated());
        return redirect()->route('lessons.index')->with('success', 'Cập nhật bài học thành công!');
    }

    // =====================================
    // XÓA BÀI HỌC (SOFT DELETE)
    // =====================================
    public function destroy(Lesson $lesson)
    {
        $lesson->delete(); // Sẽ đưa vào thùng rác vì đã dùng SoftDeletes
        return redirect()->route('lessons.index')->with('success', 'Đã xóa bài học!');
    }
}