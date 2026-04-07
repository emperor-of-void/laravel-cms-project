<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use App\Models\Enrollment;
use App\Http\Requests\CourseRequest;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    // ==========================================
    // 2.7. DASHBOARD THỐNG KÊ (Trang chủ Admin)
    // ==========================================
    public function dashboard()
    {
        $totalCourses = Course::count();
        $totalStudents = Student::count();
        
        // Tổng doanh thu (Join bảng enrollments và courses)
        $totalRevenue = Enrollment::join('courses', 'enrollments.course_id', '=', 'courses.id')
                                  ->sum('courses.price');
                                  
        // Khóa học có nhiều học viên nhất
        $topCourse = Course::withCount('students')->orderBy('students_count', 'desc')->first();
        
        // 5 khóa học mới nhất
        $recentCourses = Course::latest()->take(5)->get();

        return view('dashboard', compact('totalCourses', 'totalStudents', 'totalRevenue', 'topCourse', 'recentCourses'));
    }

    // ==========================================
    // 2.1. DANH SÁCH KHÓA HỌC & TÌM KIẾM
    // ==========================================
    public function index(Request $request)
    {
        // Yêu cầu 3.4: Tối ưu truy vấn (Fix N+1 Query) bằng with() và withCount()
        $query = Course::with(['lessons', 'enrollments'])->withCount('lessons');

        // Yêu cầu 3.1: Tìm kiếm nâng cao
        if ($request->filled('search_title')) {
            $query->where('title', 'like', '%' . $request->search_title . '%');
        }
        if ($request->filled('search_status')) {
            $query->where('status', $request->search_status);
        }

        // Yêu cầu: Phân trang (paginate)
        $courses = $query->latest()->paginate(10);
        
        return view('courses.index', compact('courses'));
    }

    // ==========================================
    // HIỂN THỊ FORM THÊM MỚI
    // ==========================================
    public function create()
    {
        return view('courses.create');
    }

    // ==========================================
    // XỬ LÝ LƯU KHÓA HỌC (CREATE)
    // ==========================================
    public function store(CourseRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($request->title); // Tự sinh Slug từ Title

        // Xử lý upload ảnh
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('courses', 'public');
        }

        Course::create($data);
        return redirect()->route('courses.index')->with('success', 'Thêm khóa học thành công!');
    }

    // ==========================================
    // HIỂN THỊ FORM SỬA (Lấy dữ liệu cũ)
    // ==========================================
    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    // ==========================================
    // XỬ LÝ CẬP NHẬT (UPDATE)
    // ==========================================
    public function update(CourseRequest $request, Course $course)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('courses', 'public');
        }

        $course->update($data);
        return redirect()->route('courses.index')->with('success', 'Cập nhật thông tin thành công!');
    }

    // ==========================================
    // XÓA KHÓA HỌC (SOFT DELETE)
    // ==========================================
    public function destroy(Course $course)
    {
        $course->delete(); // Sẽ thực hiện Soft Delete vì Model đã khai báo
        return redirect()->route('courses.index')->with('success', 'Đã xóa khóa học (vào thùng rác)!');
    }
    
    // ==========================================
    // KHÔI PHỤC KHÓA HỌC (RESTORE)
    // ==========================================
    public function restore($id)
    {
        Course::withTrashed()->where('id', $id)->restore();
        return redirect()->route('courses.index')->with('success', 'Khôi phục khóa học thành công!');
    }
    // ==========================================
    // HIỂN THỊ THÙNG RÁC (Các khóa học đã xóa mềm)
    // ==========================================
    public function trash()
    {
        // Dùng onlyTrashed() để chỉ lấy những dữ liệu đã bị xóa
        $courses = Course::onlyTrashed()->paginate(10);
        return view('courses.trash', compact('courses'));
    }
}