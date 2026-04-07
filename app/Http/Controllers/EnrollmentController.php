<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    // Hiển thị Danh sách học viên (Yêu cầu: Hiện theo từng khóa)
    public function index()
    {
        // Lấy tất cả khóa học, kèm theo danh sách học viên và đếm số lượng
        $courses = Course::with('students')->withCount('students')->get();
        return view('enrollments.index', compact('courses'));
    }

    // Hiển thị Form đăng ký
    public function create()
    {
        // Lấy các khóa học đang "Published" để cho phép đăng ký
        $courses = Course::published()->get();
        return view('enrollments.create', compact('courses'));
    }

    // Xử lý lưu thông tin đăng ký
    public function store(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'name'      => 'required|string|max:255',
            'email'     => 'required|email'
        ]);

        // Tìm học viên theo Email (nếu chưa có thì tự động tạo mới vào bảng students)
        $student = Student::firstOrCreate(
            ['email' => $request->email],
            ['name'  => $request->name]
        );

        // Kiểm tra xem học viên đã đăng ký khóa này chưa
        if ($student->courses()->where('course_id', $request->course_id)->exists()) {
            return back()->with('error', 'Học viên này đã đăng ký khóa học này rồi!');
        }

        // Lưu vào bảng trung gian enrollments
        $student->courses()->attach($request->course_id);

        return redirect()->route('enrollments.index')->with('success', 'Đăng ký khóa học thành công!');
    }
}