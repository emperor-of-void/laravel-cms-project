@extends('layouts.master')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="text-pink"><i class="fa-solid fa-book-open me-2"></i>{{ $course->title }}</h2>
            <div class="text-secondary">
                @if($course->category)
                    <span class="badge bg-secondary text-white me-2">{{ $course->category->name }}</span>
                @endif
                @foreach($course->tags as $tag)
                    <span class="badge badge-pink-light border border-pink me-1">{{ $tag->name }}</span>
                @endforeach
            </div>
        </div>
        <a href="{{ route('catalog.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <div class="row g-4">
                <div class="col-md-8">
                    <p class="text-muted">{{ $course->description }}</p>
                </div>
                <div class="col-md-4">
                    <div class="p-4 rounded-4" style="background: linear-gradient(135deg, rgba(255,117,140,0.15), rgba(255,197,204,0.30));">
                        <p class="mb-2 text-secondary">Giá khóa học</p>
                        <h4 class="fw-bold text-pink-text">{{ number_format($course->price) }}đ</h4>
                        <p class="mb-2 mt-3 text-secondary">Số bài học</p>
                        <h5 class="fw-bold">{{ $course->lessons->count() }}</h5>
                        <p class="mb-1 text-secondary">Trạng thái</p>
                        <span class="badge {{ $course->status == 'published' ? 'badge-pink' : 'bg-secondary' }} rounded-pill py-2">{{ strtoupper($course->status) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h4 class="mb-4">Danh sách bài học</h4>

            @if($course->lessons->isEmpty())
                <div class="text-center text-secondary py-5">Khóa học chưa có bài học.</div>
            @else
                <div class="list-group">
                    @foreach($course->lessons as $lesson)
                        <div class="list-group-item list-group-item-action mb-2 rounded-4 shadow-sm">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">{{ $lesson->title }}</h6>
                                    <small class="text-secondary">Thứ tự: {{ $lesson->order }}</small>
                                </div>
                                <span class="badge badge-pink py-2">{{ $lesson->created_at->format('d/m/Y') }}</span>
                            </div>
                            <p class="mb-0 text-muted mt-2">{{ \Illuminate\Support\Str::limit($lesson->content, 120, '...') }}</p>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
