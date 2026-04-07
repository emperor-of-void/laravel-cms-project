@extends('layouts.master')

@section('content')
    <h2 class="mb-4">Sửa Bài học: {{ $lesson->title }}</h2>

    <div class="card shadow-sm col-md-8 rounded-4 border-0">
        <div class="card-body p-4">
            <form action="{{ route('lessons.update', $lesson->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Thuộc khóa học</label>
                    <select name="course_id" class="form-control @error('course_id') is-invalid @enderror">
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}" {{ old('course_id', $lesson->course_id) == $course->id ? 'selected' : '' }}>{{ $course->title }}</option>
                        @endforeach
                    </select>
                    @error('course_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="row">
                    <div class="col-md-9 mb-3">
                        <label class="form-label fw-bold">Tiêu đề bài học</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $lesson->title) }}">
                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-bold">Thứ tự (Order)</label>
                        <input type="number" name="order" class="form-control @error('order') is-invalid @enderror" value="{{ old('order', $lesson->order) }}">
                        @error('order') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Video URL (Tùy chọn)</label>
                    <input type="text" name="video_url" class="form-control @error('video_url') is-invalid @enderror" value="{{ old('video_url', $lesson->video_url) }}">
                    @error('video_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Nội dung bài học</label>
                    <textarea name="content" class="form-control @error('content') is-invalid @enderror" rows="5">{{ old('content', $lesson->content) }}</textarea>
                    @error('content') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <button type="submit" class="btn btn-warning px-4 shadow-sm">Cập nhật Bài Học</button>
                <a href="{{ route('lessons.index') }}" class="btn btn-secondary shadow-sm">Hủy</a>
            </form>
        </div>
    </div>
@endsection