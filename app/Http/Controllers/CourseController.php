<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Tag;
use App\Models\Student;
use App\Http\Requests\CourseRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    // ==========================================
    // 2.7. DASHBOARD THỐNG KÊ (Trang chủ Admin)
    // ==========================================
    public function dashboard()
    {
        if (! auth()->check()) {
            return redirect()->route('login');
        }

        if (auth()->user()->isStudent()) {
            return redirect()->route('student.courses');
        }

        $totalCourses = Course::count();
        $totalStudents = Student::count();
        
        $totalRevenue = Enrollment::join('courses', 'enrollments.course_id', '=', 'courses.id')
                                  ->sum('courses.price');
                                  
        $topCourse = Course::withCount('students')->orderBy('students_count', 'desc')->first();
        
        $recentCourses = Course::latest()->take(5)->get();

        return view('dashboard', compact('totalCourses', 'totalStudents', 'totalRevenue', 'topCourse', 'recentCourses'));
    }

    public function catalog(Request $request)
    {
        $query = Course::published()->with(['category', 'tags', 'lessons']);

        if ($request->filled('search_title')) {
            $query->where('title', 'like', '%' . $request->search_title . '%');
        }

        if ($request->filled('search_category')) {
            $query->where('category_id', $request->search_category);
        }

        if ($request->filled('search_tag')) {
            $searchTag = $request->search_tag;
            $query->whereHas('tags', function ($query) use ($searchTag) {
                $query->where('name', 'like', '%' . $searchTag . '%');
            });
        }

        $courses = $query->latest()->paginate(12)->withQueryString();
        $categories = Category::all();

        return view('courses.catalog', compact('courses', 'categories'));
    }

    public function show(Course $course)
    {
        if (! auth()->check() || auth()->user()->isStudent()) {
            abort_if($course->status !== 'published', 404);
        }

        $course->load(['category', 'tags', 'lessons']);
        return view('courses.show', compact('course'));
    }

    private function ensureAdmin(): void
    {
        if (! auth()->check() || ! auth()->user()->isAdmin()) {
            abort(403, 'Bạn không có quyền truy cập.');
        }
    }

    // ==========================================
    // 2.1. DANH SÁCH KHÓA HỌC & TÌM KIẾM
    // ==========================================
    public function index(Request $request)
    {
        $this->ensureAdmin();

        $query = Course::with(['lessons', 'enrollments', 'category', 'tags'])->withCount('lessons');

        if ($request->filled('search_title')) {
            $query->where('title', 'like', '%' . $request->search_title . '%');
        }

        if ($request->filled('search_status')) {
            $query->where('status', $request->search_status);
        }

        if ($request->filled('search_category')) {
            $query->where('category_id', $request->search_category);
        }

        if ($request->filled('search_tag')) {
            $searchTag = $request->search_tag;
            $query->whereHas('tags', function ($query) use ($searchTag) {
                $query->where('name', 'like', '%' . $searchTag . '%');
            });
        }

        $courses = $query->latest()->paginate(10);
        $categories = Category::all();
        
        return view('courses.index', compact('courses', 'categories'));
    }

    // ==========================================
    // HIỂN THỊ FORM THÊM MỚI
    // ==========================================
    public function create()
    {
        $this->ensureAdmin();
        $categories = Category::all();
        return view('courses.create', compact('categories'));
    }

    // ==========================================
    // XỬ LÝ LƯU KHÓA HỌC (CREATE)
    // ==========================================
    public function store(CourseRequest $request)
    {
        $this->ensureAdmin();
        $data = $request->validated();
        $data['slug'] = Str::slug($request->title); // Tự sinh Slug từ Title

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('courses', 'public');
        }

        $course = Course::create($data);

        if ($request->filled('tags')) {
            $course->tags()->sync($this->resolveTagIds($request->tags));
        }

        return redirect()->route('courses.index')->with('success', 'Thêm khóa học thành công!');
    }

    // ==========================================
    // HIỂN THỊ FORM SỬA (Lấy dữ liệu cũ)
    // ==========================================
    public function edit(Course $course)
    {
        $this->ensureAdmin();
        $categories = Category::all();
        return view('courses.edit', compact('course', 'categories'));
    }

    // ==========================================
    // XỬ LÝ CẬP NHẬT (UPDATE)
    // ==========================================
    public function update(CourseRequest $request, Course $course)
    {
        $this->ensureAdmin();
        $data = $request->validated();
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('courses', 'public');
        }

        $course->update($data);
        $course->tags()->sync($this->resolveTagIds($request->tags));

        return redirect()->route('courses.index')->with('success', 'Cập nhật thông tin thành công!');
    }

    // ==========================================
    // XÓA KHÓA HỌC (SOFT DELETE)
    // ==========================================
    public function destroy(Course $course)
    {
        $this->ensureAdmin();
        $course->delete(); // Sẽ thực hiện Soft Delete vì Model đã khai báo
        return redirect()->route('courses.index')->with('success', 'Đã xóa khóa học (vào thùng rác)!');
    }
    
    // ==========================================
    // KHÔI PHỤC KHÓA HỌC (RESTORE)
    // ==========================================
    public function restore($id)
    {
        $this->ensureAdmin();
        Course::withTrashed()->where('id', $id)->restore();
        return redirect()->route('courses.index')->with('success', 'Khôi phục khóa học thành công!');
    }

    // ==========================================
    // HIỂN THỊ THÙNG RÁC (Các khóa học đã xóa mềm)
    // ==========================================
    public function trash()
    {
        $this->ensureAdmin();
        $courses = Course::onlyTrashed()->paginate(10);
        return view('courses.trash', compact('courses'));
    }

    private function resolveTagIds(string $tags): array
    {
        $tagNames = array_filter(array_map('trim', explode(',', $tags)));

        return collect($tagNames)->map(function ($name) {
            return Tag::firstOrCreate([
                'slug' => Str::slug($name),
            ], [
                'name' => $name,
            ])->id;
        })->unique()->values()->all();
    }
}
