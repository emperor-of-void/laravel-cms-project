@extends('layouts.master')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fa-solid fa-book-open me-2"></i>Danh sách Khóa học</h2>
        <div>
            <a href="{{ route('courses.trash') }}" class="btn btn-secondary me-2"><i class="fa-solid fa-trash-can me-1"></i>Thùng rác</a>
            <a href="{{ route('courses.create') }}" class="btn btn-primary">+ Thêm Khóa học</a>
        </div>
    </div>

    @include('components.alert')

    <!-- Form Tìm kiếm -->
    <div class="card mb-4 border-0">
        <div class="card-body pb-0">
            <form action="{{ route('courses.index') }}" method="GET" class="row g-3 mb-3">
                <div class="col-md-5">
                    <input type="text" name="search_title" class="form-control rounded-pill px-3" placeholder="Tìm theo tên..." value="{{ request('search_title') }}">
                </div>
                <div class="col-md-4">
                    <select name="search_status" class="form-select rounded-pill px-3">
                        <option value="">-- Tất cả trạng thái --</option>
                        <option value="published" {{ request('search_status') == 'published' ? 'selected' : '' }}>Published</option>
                        <option value="draft" {{ request('search_status') == 'draft' ? 'selected' : '' }}>Draft</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-dark w-100 rounded-pill"><i class="fa-solid fa-magnifying-glass me-2"></i>Tìm kiếm</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bảng Dữ liệu -->
    <div class="card border-0">
        <div class="card-body p-0">
            <table class="table table-hover table-pink mb-0">
                <thead>
                    <tr>
                        <th class="py-3 px-4">Ảnh</th>
                        <th class="py-3">Tên Khóa Học</th>
                        <th class="py-3">Giá</th>
                        <th class="py-3">Trạng thái</th>
                        <th class="py-3 text-center">Số Bài Học</th>
                        <th class="py-3 text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($courses as $course)
                    <tr>
                        <td class="px-4">
                            @if($course->image)
                                <img src="{{ asset('storage/' . $course->image) }}" width="50" class="rounded shadow-sm">
                            @else
                                <span class="badge bg-light text-muted border"><i class="fa-regular fa-image"></i> Trống</span>
                            @endif
                        </td>
                        <td class="fw-bold align-middle text-secondary">{{ $course->title }}</td>
                        <td class="text-danger fw-bold align-middle">{{ number_format($course->price) }}đ</td>
                        <td class="align-middle">
                            <span class="badge {{ $course->status == 'published' ? 'badge-pink' : 'bg-secondary' }} px-3 py-2 rounded-pill">
                                {{ strtoupper($course->status) }}
                            </span>
                        </td>
                        <td class="text-center align-middle fw-bold">{{ $course->lessons_count }}</td>
                        <td class="text-center align-middle">
                            <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-sm btn-warning shadow-sm"><i class="fa-solid fa-pen"></i></a>
                            <form action="{{ route('courses.destroy', $course->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Xóa khóa học này?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger shadow-sm"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center py-4 text-muted">Không có khóa học nào.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">{{ $courses->links('pagination::bootstrap-5') }}</div>
@endsection