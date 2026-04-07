@extends('layouts.master')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fa-solid fa-play-circle me-2"></i>Danh sách Bài học</h2>
        <a href="{{ route('lessons.create') }}" class="btn btn-primary shadow-sm">+ Thêm Bài học mới</a>
    </div>

    @include('components.alert')

    @foreach($courses as $course)
        <div class="card mb-4 border-0">
            <div class="card-header header-soft py-3 d-flex justify-content-between align-items-center border-0">
                <h5 class="mb-0 fw-bold"><i class="fa-solid fa-book-open text-danger me-2"></i>{{ $course->title }}</h5>
                <span class="badge badge-pink rounded-pill px-3 py-2 shadow-sm">Tổng: {{ $course->lessons->count() }} bài</span>
            </div>
            <div class="card-body p-0">
                @if($course->lessons->count() > 0)
                    <table class="table mb-0 table-hover">
                        <thead class="table-light text-muted">
                            <tr>
                                <th class="text-center py-3" width="80">Thứ tự</th>
                                <th class="py-3">Tiêu đề bài học</th>
                                <th class="py-3">Video URL</th>
                                <th class="text-center py-3" width="150">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($course->lessons as $lesson)
                                <tr>
                                    <td class="text-center align-middle fw-bold text-muted">#{{ $lesson->order }}</td>
                                    <td class="fw-bold align-middle text-secondary">{{ $lesson->title }}</td>
                                    <td class="align-middle">
                                        @if($lesson->video_url)
                                            <a href="{{ $lesson->video_url }}" target="_blank" class="text-decoration-none fw-bold text-danger">
                                                <i class="fa-brands fa-youtube me-1"></i>Xem Video
                                            </a>
                                        @else
                                            <span class="text-muted"><i class="fa-solid fa-link-slash me-1"></i>Không có</span>
                                        @endif
                                    </td>
                                    <td class="text-center align-middle">
                                        <a href="{{ route('lessons.edit', $lesson->id) }}" class="btn btn-sm btn-warning shadow-sm"><i class="fa-solid fa-pen"></i></a>
                                        <form action="{{ route('lessons.destroy', $lesson->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Xóa bài học này?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger shadow-sm"><i class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="p-5 text-muted text-center bg-light">
                        <i class="fa-regular fa-folder-open mb-3 fa-3x opacity-50"></i><br>
                        Khóa học này chưa có bài học nào.
                    </div>
                @endif
            </div>
        </div>
    @endforeach
@endsection