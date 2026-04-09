@extends('layouts.master')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2><i class="fa-solid fa-graduation-cap me-2"></i>Khóa của tôi</h2>
            <p class="text-secondary">Danh sách khóa bạn đã đăng ký và đang học.</p>
        </div>
        <a href="{{ route('enrollments.create') }}" class="btn btn-primary">+ Đăng ký Khóa mới</a>
    </div>

    @include('components.alert')

    <div class="row g-4">
        @forelse($courses as $course)
            <div class="col-md-6">
                <div class="card p-4 h-100">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h5 class="fw-bold mb-2">{{ $course->title }}</h5>
                            <span class="badge badge-pink">{{ number_format($course->price) }}đ</span>
                        </div>
                        <span class="badge bg-secondary rounded-pill py-2">{{ strtoupper($course->status) }}</span>
                    </div>
                    <p class="text-muted mb-4">{{ $course->description }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-secondary">
                            <small><i class="fa-solid fa-book-bookmark me-1"></i>{{ $course->lessons_count }} bài học</small>
                        </div>
                        <a href="{{ route('student.courses.show', $course->id) }}" class="btn btn-sm btn-dark">Xem chi tiết</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card p-5 text-center text-secondary">
                    <h5>Chưa có khóa học nào.</h5>
                    <p class="mb-0">Bạn có thể đăng ký khóa mới ngay bên trên.</p>
                </div>
            </div>
        @endforelse
    </div>
@endsection
