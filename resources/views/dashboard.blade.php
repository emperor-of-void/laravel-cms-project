@extends('layouts.master')

@section('content')
    <style>
        /* CSS Tùy chỉnh màu sắc cho Dashboard Tone Hồng */
        .card-courses { background: linear-gradient(135deg, #ffb88c 0%, #ff8c7f 100%); color: white; }
        .card-students { background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%); color: #8a3f4b; }
        .card-revenue { background: linear-gradient(135deg, #ff758c 0%, #ff7eb3 100%); color: white; }
        
        .header-soft { background-color: #ffe4e8; color: #d6336c; font-weight: bold; }
        .text-pink-dark { color: #d6336c !important; }
        .badge-pink { background-color: #ff8fa3; color: white; }
        .list-group-item { background-color: transparent; } /* Trong suốt để tệp với nền trắng của Card */
    </style>

    <h2 class="mb-4 fw-bold text-pink-dark"><i class="fa-solid fa-chart-line me-2"></i>Bảng Điều Khiển</h2>

    <div class="row text-center mb-4">
        <!-- Khối Tổng Khóa Học (Cam đào) -->
        <div class="col-md-4">
            <div class="card card-courses shadow-lg rounded-4 border-0 mb-3">
                <div class="card-body p-4">
                    <i class="fa-solid fa-book-open fa-3x mb-3 opacity-75"></i>
                    <h5 class="fw-light">Tổng Khóa Học</h5>
                    <h2 class="fw-bold mb-0">{{ $totalCourses }}</h2>
                </div>
            </div>
        </div>
        
        <!-- Khối Tổng Học Viên (Hồng phấn nhạt) -->
        <div class="col-md-4">
            <div class="card card-students shadow-lg rounded-4 border-0 mb-3">
                <div class="card-body p-4">
                    <i class="fa-solid fa-users fa-3x mb-3 opacity-75"></i>
                    <h5 class="fw-light">Tổng Học Viên</h5>
                    <h2 class="fw-bold mb-0">{{ $totalStudents }}</h2>
                </div>
            </div>
        </div>
        
        <!-- Khối Doanh Thu (Hồng đậm) -->
        <div class="col-md-4">
            <div class="card card-revenue shadow-lg rounded-4 border-0 mb-3">
                <div class="card-body p-4">
                    <i class="fa-solid fa-wallet fa-3x mb-3 opacity-75"></i>
                    <h5 class="fw-light">Tổng Doanh Thu</h5>
                    <h2 class="fw-bold mb-0">{{ number_format($totalRevenue) }} VNĐ</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Bảng xếp hạng -->
        <div class="col-md-6">
            <div class="card shadow rounded-4 border-0">
                <div class="card-header header-soft rounded-top-4 py-3 border-0">
                    <i class="fa-solid fa-crown text-warning me-2"></i>Top Khóa học (Hot nhất)
                </div>
                <div class="card-body">
                    @if($topCourse)
                        <h5 class="text-pink-dark fw-bold">{{ $topCourse->title }}</h5>
                        <p class="text-muted mb-0">
                            <i class="fa-solid fa-fire text-danger me-1"></i> Số lượng đăng ký: <strong>{{ $topCourse->students_count }}</strong> học viên
                        </p>
                    @else
                        <p class="text-muted mb-0">Chưa có dữ liệu</p>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Danh sách mới nhất -->
        <div class="col-md-6">
            <div class="card shadow rounded-4 border-0">
                <div class="card-header header-soft rounded-top-4 py-3 border-0">
                    <i class="fa-solid fa-clock-rotate-left text-pink-dark me-2"></i>5 Khóa học mới nhất
                </div>
                <ul class="list-group list-group-flush rounded-bottom-4">
                    @forelse($recentCourses as $course)
                        <li class="list-group-item d-flex justify-content-between align-items-center py-3 border-light">
                            <span class="text-secondary"><i class="fa-solid fa-caret-right text-pink-dark me-2"></i> {{ $course->title }}</span>
                            <span class="badge badge-pink rounded-pill shadow-sm px-3 py-2">{{ number_format($course->price) }}đ</span>
                        </li>
                    @empty
                        <li class="list-group-item text-muted">Chưa có khóa học nào.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
@endsection