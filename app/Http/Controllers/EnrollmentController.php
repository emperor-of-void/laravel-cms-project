<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    // Hiển thị Danh sách học viên (Yêu cầu: Hiện theo từng khóa)
    public function index()
    {
        if (! auth()->check() || ! auth()->user()->isAdmin()) {
            abort(403, 'Bạn không có quyền truy cập.');
        }

        // Lấy tất cả khóa học, kèm theo danh sách học viên và đếm số lượng
        $courses = Course::with('students')->withCount('students')->get();
        return view('enrollments.index', compact('courses'));
    }

    // Hiển thị Form đăng ký
    public function create()
    {
        // Lấy các khóa học đang "Published" để cho phép đăng ký
        $courses = Course::published()->get();
        $currentUser = Auth::user();

        return view('enrollments.create', compact('courses', 'currentUser'));
    }

    // Xử lý lưu thông tin đăng ký
    public function store(Request $request)
    {
        // Validate dữ liệu
        $rules = [
            'course_id' => 'required|exists:courses,id',
        ];

        if (! Auth::check() || Auth::user()->isAdmin()) {
            $rules['name'] = 'required|string|max:255';
            $rules['email'] = 'required|email';
        }

        $request->validate($rules);

        if (Auth::check() && Auth::user()->isStudent()) {
            $student = Student::firstOrCreate(
                ['email' => Auth::user()->email],
                ['name'  => Auth::user()->name]
            );
        } else {
            $student = Student::firstOrCreate(
                ['email' => $request->email],
                ['name'  => $request->name]
            );
        }

        // Kiểm tra xem học viên đã đăng ký khóa này chưa
        if ($student->courses()->where('course_id', $request->course_id)->exists()) {
            return back()->with('error', 'Học viên này đã đăng ký khóa học này rồi!');
        }

        // Lưu vào bảng trung gian enrollments
        $student->courses()->attach($request->course_id);

        $redirect = Auth::check() && Auth::user()->isStudent() ? 'student.courses' : 'enrollments.index';
        return redirect()->route($redirect)->with('success', 'Đăng ký khóa học thành công!');
    }
}