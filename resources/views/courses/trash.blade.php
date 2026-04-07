@extends('layouts.master')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-danger"><i class="fa-solid fa-trash-can me-2"></i>Thùng rác (Khóa học)</h2>
        <a href="{{ route('courses.index') }}" class="btn btn-outline-secondary"><i class="fa-solid fa-arrow-left me-1"></i>Quay lại danh sách</a>
    </div>

    @include('components.alert')

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Tên Khóa Học</th>
                        <th>Giá</th>
                        <th>Ngày xóa</th>
                        <th class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($courses as $course)
                    <tr>
                        <td class="fw-bold text-muted">{{ $course->title }}</td>
                        <td class="text-danger">{{ number_format($course->price) }}đ</td>
                        <td>{{ $course->deleted_at->format('d/m/Y H:i') }}</td>
                        <td class="text-center">
                            <!-- Nút Khôi phục -->
                            <form action="{{ route('courses.restore', $course->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success"><i class="fa-solid fa-rotate-left me-1"></i>Khôi phục</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-muted">Thùng rác trống.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $courses->links('pagination::bootstrap-5') }}
    </div>
@endsection