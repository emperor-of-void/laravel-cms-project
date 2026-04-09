@extends('layouts.master')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="text-pink"><i class="fa-solid fa-book-open me-2"></i>Khóa học hiện có</h2>
            <p class="text-pink-light mb-0">Tìm khóa học theo danh mục, tag và mức giá phù hợp.</p>
        </div>
        @auth
            <a href="{{ auth()->user()->isStudent() ? route('student.courses') : route('courses.index') }}" class="btn btn-secondary">Quay lại</a>
        @else
            <a href="{{ route('login') }}" class="btn btn-secondary">Đăng nhập</a>
        @endauth
    </div>

    @include('components.alert')

    <div class="card mb-4 border-0">
        <div class="card-body pb-0">
            <form action="{{ route('catalog.index') }}" method="GET" class="row g-3 mb-3">
                <div class="col-md-4">
                    <input type="text" name="search_title" class="form-control rounded-pill px-3" placeholder="Tìm theo tên..." value="{{ request('search_title') }}">
                </div>
                <div class="col-md-3">
                    <select name="search_category" class="form-select rounded-pill px-3">
                        <option value="">-- Chọn danh mục --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('search_category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="text" name="search_tag" class="form-control rounded-pill px-3" placeholder="Tag, ví dụ Laravel" value="{{ request('search_tag') }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-dark w-100 rounded-pill"><i class="fa-solid fa-magnifying-glass me-2"></i>Lọc</button>
                </div>
            </form>
        </div>
    </div>

    <div class="row g-4">
        @forelse($courses as $course)
            <div class="col-md-6">
                <div class="card p-4 h-100 shadow-sm">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h5 class="fw-bold mb-2">{{ $course->title }}</h5>
                            <div class="mb-2">
                                <span class="badge badge-pink me-1">{{ number_format($course->price) }}đ</span>
                                @if($course->category)
                                    <span class="badge bg-secondary text-white">{{ $course->category->name }}</span>
                                @endif
                            </div>
                        </div>
                        <span class="badge {{ $course->status == 'published' ? 'badge-pink' : 'bg-secondary' }} rounded-pill py-2">{{ strtoupper($course->status) }}</span>
                    </div>
                    <p class="text-muted">{{ \Illuminate\Support\Str::limit($course->description, 120, '...') }}</p>
                    <div class="mb-3">
                        @foreach($course->tags as $tag)
                            <span class="badge badge-pink-light border border-pink me-1">{{ $tag->name }}</span>
                        @endforeach
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-auto pt-2 border-top">
                        <small class="text-secondary"><i class="fa-solid fa-book-bookmark me-1"></i>{{ $course->lessons->count() }} bài học</small>
                        <a href="{{ route('catalog.show', $course->id) }}" class="btn btn-sm btn-primary">Xem chi tiết</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card p-5 text-center text-secondary">
                    <h5>Chưa có khóa học phù hợp.</h5>
                    <p class="mb-0">Hãy thử thay đổi tìm kiếm hoặc thêm khóa học mới.</p>
                </div>
            </div>
        @endforelse
    </div>

    <div class="mt-4">{{ $courses->links('pagination::bootstrap-5') }}</div>
@endsection
